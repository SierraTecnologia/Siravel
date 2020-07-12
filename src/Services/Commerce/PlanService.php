<?php

namespace Siravel\Services\Commerce;

use App\Models\UserMeta;
use Facilitador\Services\UserService;
use Exception;
use Illuminate\Support\Facades\Schema;
use SierraTecnologia\Cashier\Subscription;
use Siravel\Models\Commerce\Plan;
use Siravel\Services\SiravelService;

class PlanService
{
    public function __construct(
        Plan $plan,
        SierraTecnologiaService $sitecpaymentService,
        UserService $userService
    ) {
        $this->model = $plan;
        $this->sitecpaymentService = $sitecpaymentService;
        $this->userService = $userService;
    }

    /**
     * Get all Plans.
     *
     * @return Collection
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Get all enabled plans.
     *
     * @return Collection
     */
    public function allEnabled()
    {
        return $this->model->where('enabled', true)->get();
    }

    /**
     * Collect the new plans.
     */
    public function collectNewPlans()
    {
        $sitecpaymentPlans = $this->sitecpaymentService->collectSierraTecnologiaPlans()->data;
        foreach ($sitecpaymentPlans as $plan) {
            $localPlan = $this->model->getPlansBySierraTecnologiaId($plan->id);

            if (!$localPlan) {
                $this->model->create([
                    'uuid' => crypto_uuid(),
                    'name' => $plan->id,
                    'price' => $plan->amount,
                    'interval' => $plan->interval,
                    'currency' => $plan->currency,
                    'sitecpayment_name' => $plan->id,
                    'subscription_name' => $plan->id,
                    'descriptor' => $plan->statement_descriptor,
                    'description' => $plan->statement_descriptor,
                ]);
            }
        }
    }

    /**
     * Get paginated plans.
     *
     * @return Collection
     */
    public function paginated()
    {
        return $this->model->paginate(config('siravel.pagination', 25));
    }

    /**
     * Search all the plans.
     *
     * @param array $payload
     *
     * @return Collection
     */
    public function search($payload)
    {
        $query = $this->model->orderBy('created_at', 'desc');

        $columns = Schema::getColumnListing('plans');

        foreach ($columns as $attribute) {
            $query->orWhere($attribute, 'LIKE', '%'.$payload.'%');
        }

        return $query->paginate(config('siravel.pagination', 25));
    }

    /**
     * Create a plan.
     *
     * @param array $payload
     *
     * @return Plan
     */
    public function create($payload)
    {
        try {
            $name = app(SiravelService::class)->convertToURL($payload['name']);

            $payload['sitecpayment_id'] = $name;
            $payload['uuid'] = crypto_uuid();
            $payload['sitecpayment_name'] = $name;
            $payload['subscription_name'] = $name;

            $this->sitecpaymentService->createPlan($payload);

            return $this->model->create($payload);
        } catch (Exception $e) {
            dd($e->getMessage());
            throw new Exception('Could not generate new plan', 1);
        }

        return false;
    }

    /**
     * Find a plan.
     *
     * @param int $id
     *
     * @return Plan
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
     * Find a plan by uuid.
     *
     * @param string $uuid
     *
     * @return Plan
     */
    public function findByUuid($uuid)
    {
        return $this->model->where('uuid', $uuid)->first();
    }

    /**
     * Get plans by sitecpayment ID.
     *
     * @param int $id
     *
     * @return Plan
     */
    public function getPlansBySierraTecnologiaId($id)
    {
        return $this->model->getPlansBySierraTecnologiaId($id);
    }

    /**
     * Update a plan.
     *
     * @param int   $id
     * @param array $payload
     *
     * @return mixed
     */
    public function update($id, $payload)
    {
        try {
            if (!isset($payload['is_featured'])) {
                $payload['is_featured'] = false;
            } else {
                $payload['is_featured'] = true;
            }

            return $this->model->find($id)->update($payload);
        } catch (Exception $e) {
            throw new Exception('Could not update your plan', 1);
        }

        return false;
    }

    /**
     * Change the state of a plan.
     *
     * @param int  $id
     * @param bool $state
     *
     * @return bool
     */
    public function stateChange($id, $state)
    {
        $payload = [
            'enabled' => true,
        ];

        if ($state == 'disable') {
            $payload['enabled'] = false;
        }

        return $this->model->find($id)->update($payload);
    }

    /**
     * Get subscribers.
     *
     * @param Siravel\Models\Commerce\Plan $plan
     *
     * @return Illuminate\Support\Collection
     */
    public function getSubscribers($plan)
    {
        $userCollection = collect();
        $subscriptions = Subscription::where('sitecpayment_plan', $plan->sitecpayment_name)->get();

        foreach ($subscriptions as $subscription) {
            $userCollection->push(UserMeta::find($subscription->user_meta_id));
        }

        return $userCollection;
    }

    /**
     * Cancel a subscription.
     *
     * @param int $planId
     * @param int $userMetaId
     *
     * @return bool
     */
    public function cancelSubscription($planId, $userMetaId)
    {
        $plan = $this->find($planId);
        $userMeta = UserMeta::find($userMetaId);

        return $userMeta->subscription($plan->subscription_name)->cancel();
    }

    /**
     * Destroy a plan.
     *
     * @param int $id
     *
     * @return bool
     */
    public function destroy($id)
    {
        try {
            $localPlan = $this->model->find($id);

            try {
                $planIsDeleted = $this->sitecpaymentService->deletePlan($localPlan->sitecpayment_name);
            } catch (\SierraTecnologia\Error\InvalidRequest $e) {
                $localPlan->delete();

                return true;
            }

            // We need to unaubscribe our users
            if ($planIsDeleted) {
                $subscriptions = Subscription::where('sitecpayment_plan', $localPlan->sitecpayment_name)->get();
                foreach ($subscriptions as $subscription) {
                    $user = UserMeta::find($subscription->user_meta_id);
                    $meta->subscription($localPlan->subscription_name)->cancel();
                }
            }

            return $this->model->destroy($id);
        } catch (Exception $e) {
            throw new Exception('Could not delete your plan', 1);
        }

        return false;
    }
}
