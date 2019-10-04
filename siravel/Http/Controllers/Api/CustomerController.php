<?php

namespace Siravel\Http\Controllers\Api;

use Siravel\Http\Resources\CustomerTokenResource;
use Siravel\Models\Customer;
use Siravel\Http\Resources\CustomerResource;
use Siravel\Http\Requests\CustomerRequest; 
use Siravel\Http\Requests\CustomerFindRequest;
use Siravel\Models\CustomerToken;
use Illuminate\Http\Request;
use Siravel\Services\Gateway;
use Siravel\Services\FraudAnalysi;
use Siravel\Sitec\Filter;
use Illuminate\Support\Facades\Log;

class CustomerController extends Controller
{
    /**
     * Recebe dados do usuário. Retorna token de usuário
     * Se o token recebido->success = true ele att o token passepague do usuário. 
     * 
     * Método: POST
     * 
     * @paramApi string $name
     * @paramApi string $cpf
     * @paramApi string $email
     * @paramApi string $role_id
     * @paramApi string $token Company token
     * 
     * @returnApi json
     * data['success'] Boolean
     * data['message'] Caso de success false
     * data['data']['user_token'] Uma string com token unico do Usuário
     *
     * @param CustomerRequest $request Requisição do Laravel
     * @return CustomerResource
     */
    public function register(CustomerRequest $request)
    {
        $companyToken = $request->input('token');
        $cpf = Filter::cpf($request->input('cpf'));
        $email = $request->input('email');

        if(empty($companyToken)) {
            return response()->json(
                array(
                    'success' => false,
                    'message' => 'Você precisa enviar o company token'
                ),
                422
            );
        }
        if(empty($cpf)) {
            return response()->json(
                array(
                    'success' => false,
                    'message' => 'Você precisa informar o cpf.'
                ),
                422
            );
        }
        if(empty($email)) {
            return response()->json(
                array(
                    'success' => false,
                    'message' => 'Você precisa informar o email.'
                ),
                422
            );
        }

        $customerFindByCpf = Customer::where('cpf', $cpf)->first();
        $customerFindByEmail = Customer::where('email', $email)->first();

        if(
            ($customerFindByCpf && 
            CustomerToken::where('company_token', $companyToken)->
            where('customer_id', $customerFindByCpf->id)->first()) || 
            ($customerFindByEmail && 
            CustomerToken::where('company_token', $companyToken)->
            where('customer_id', $customerFindByEmail->id)->first())
            
        ) {
            return response()->json(
                array(
                    'success' => false,
                    'message' => 'Usuário já registrado!'
                ),
                409
            );
        }

        if (!$customerFindByCpf && $customerFindByEmail && $customerFindByEmail->cpf!==$cpf) {
            // @Todo Capturar Ação Suspeita para Pontuacao Negativa
            Log::warning('[Alerta Fraude] Email registrado para dois cpfs. '.$cpf.' - '.$email);
            return response()->json(
                array(
                    'success' => false,
                    'message' => 'Email registrado para outro cpf!'
                ),
                409
            );
        }

        if (!$customer = $customerFindByEmail) {
            $customer = $customerFindByCpf;
        }

        if (!$customer) {
            $customer = Customer::create(
                CustomerRequest::filterParams($request->all())
            );
        }

        // Registrando Customer no Anti Fraude
        $fraudAnalysiService = new FraudAnalysi($this->getBusiness());
        if (!$fraudAnalysiService->registerCustomer($customer)) {
            Log::critical(
                '[Fraud Analysis] Consumidor não autorizado pelo anti fraude'
            );
            return response()->json(
                $this->responseWithErrorMessage($fraudAnalysiService->getError()),
                406
            );
        }

        // Registrando Customer no Gateway
        $service = new Gateway($this->getBusiness());
        if (!$registerCustomer = $service->registerCustomer($customer)) {
            // return abort(404, 'Usuário não registrado.');
            return response()->json(
                $this->responseWithErrorMessage('Usuário não registrado.'),
                406
            );
        }

        // Cria token da MundiPagg caso a tenha
        if (isset($params['gateway_mundipagg']) && !empty($params['gateway_mundipagg'])) {
            $gatewayCustomer = new GatewayCustomer();
            $gatewayCustomer->token = $params['gateway_mundipagg'];
            $gatewayCustomer->customer_id = $customer->id;
            $gatewayCustomer->gateway_id = Mundipagg::$id;
            $gatewayCustomer->user_id = $this->getBusiness()->id;
            $customer->gatewayCustomers()->save($gatewayCustomer);
        }

        $customerToken = new CustomerToken();
        $customerToken->company_token = $companyToken;
        $customerToken->customer_id = $customer->id;
        $customerToken->is_active = 1;
        $customerToken->user_id = $this->getBusiness()->id;
        $customer->customerTokens()->save($customerToken);

        return new CustomerTokenResource($customerToken);
    }

    /**
     * Recebe cpf e token da empresa. Retorna token de usuário.
     * Se o token recebido->success = true ele att o token passepague do usuário. 
     * Se não for true, ele chama a API '/user/register'
     * 
     * Método: POST
     * 
     * @paramApi string $cpf
     * @paramApi string $token Company token da produtora
     * 
     * @returnApi json
     * data['success'] Boollean
     * data['data'] Uma string com token unico do Usuário
     * 
     * @param CustomerRequest $request Requisição do Laravel
     * @return CustomerResource
     */
    public function userToken(CustomerFindRequest $request)
    {
        $companyToken = $request->input('token');
        $cpf = Filter::cpf($request->input('cpf'));

        if(empty($companyToken)) {
            return response()->json(
                $this->responseWithErrorMessage('Você precisa enviar o company token'),
                422
            );
        }

        if(empty($cpf)) {
            return response()->json(
                $this->responseWithErrorMessage('Você precisa informar o cpf.'),
                422
            );
        }

        if (!$customer = Customer::where('cpf', $cpf)->first()){
            return response()->json(
                $this->responseWithErrorMessage('Usuário não encontrado'),
                422
            );
        }

        $where = [
            ['company_token', '=', $companyToken],
            ['customer_id', '=', $customer->id],
        ];

        if(!$customerToken = CustomerToken::where($where)->first()) {
            return response()->json(
                $this->responseWithErrorMessage('Usuário não encontrado'),
                422
            );
        }

        return response()->json(
            $this->responseWithData($customerToken->token),
            200
        );
    }
}