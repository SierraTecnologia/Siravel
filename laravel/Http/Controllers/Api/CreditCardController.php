<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CreditCardTokenResource;
use App\Models\CreditCardToken;
use App\Models\Customer;
use App\Models\CustomerToken;
use App\Models\CreditCard;
use App\Http\Resources\CreditCardResource;
use App\Http\Requests\CreditCardRequest;
use App\Http\Requests\CreditCardDeleteRequest;
use App\Http\Requests\CreditCardUserRequest;
use App\Http\Requests\CreditCardValidRequest;
use App\Http\Requests\CreditCardValidationRequest;
use App\Http\Requests\CreditCardValidateTokenRequest;
use App\Services\Gateway;
use App\Services\FraudAnalysi;
use App\Sitec\Filter;
use Illuminate\Support\Facades\Log;

class CreditCardController extends Controller
{

    /**
     * @api {post} /credit_cards/register register
     * @apiGroup CreditCards
     * @apiName register
     * 
     * @apiParam {Number} $cpf
     * @apiParam {String} $user_token Passepague token
     * @apiParam {String} $token Company token
     * @apiParam {String} $brand_id
     * @apiParam {String} $card_number
     * @apiParam {String} $exp_year
     * @apiParam {String} $exp_month
     * @apiParam {String} $card_name
     * @apiParam {String} $is_active hardcoded 1
     *
     * @apiDescription Registra dados do cartão no gateway de pagamento.
     * 
     * @apiSuccessExample Success 200
     *     HTTP/1.1 200 OK
     *      {
     *          "success": true,
     *          "message": "Cartão registrado com sucesso.",
     *          "data": {
     *              "card_id": 1
     *          }
     *      }
     *
     * @apiErrorExample Error 422
     *     HTTP/1.1 422 Not Found
     *     {
     *          "success": false,
     *          "message": "Bandeira não cadastrada."
     *     }
     *
     * @apiErrorExample Error 422
     *     HTTP/1.1 422 Not Found
     *     {
     *          "success": false,
     *          "message": "Usuário não encontrado."
     *     }
     *
     * @apiErrorExample Error 422
     *     HTTP/1.1 422 Not Found
     *     {
     *          "success": false,
     *          "message": "Você precisa informar o cpf."
     *     }
     *
     *  @apiErrorExample Error 422
     *     HTTP/1.1 422 Not Found
     *     {
     *          "success": false,
     *          "message": "Você precisa informar o token."
     *     }
     *
     *  @apiErrorExample Error 422
     *     HTTP/1.1 422 Not Found
     *     {
     *          "success": false,
     *          "message": "CPF e Token não conferem."
     *     }
     *
     *  @apiErrorExample Error 422
     *     HTTP/1.1 422 Not Found
     *     {
     *          "success": false,
     *          "message": "CPF não encontrado."
     *     }
     *
     * @apiVersion 0.0.1
     * 
     * @param CreditCardRequest $request
     */
    public function register(CreditCardRequest $request)
    {

        $params = $request->all();
        if(!is_array($params) || !isset($params['token'])) {
            return response()->json(array('success' => false, 'message' => 'Você precisa enviar o company token'), 422);
        }
        if(!isset($params['card_number'])) {
            return response()->json(array('success' => false, 'message' => 'Você precisa informar o número do cartão.'), 422);
        }
        if(!isset($params['cpf']) && !isset($params['user_token'])) {
            Log::notice('[Register Credit Card] Erro! Cpf ou User Token não informado!');
            return response()->json(array('success' => false, 'message' => 'Você precisa informar o cpf ou token do usuário.'), 422);
        }
        if(isset($params['cpf']) && !$customer = Customer::where('cpf', Filter::cpf($params['cpf']))->first()) {
            Log::notice('[Register Credit Card] Erro! Usuário não encontrado pelo cpf');
            return response()->json(array('success' => false, 'message' => 'Usuário não encontrado pelo cpf'), 422);
            return false;
        }
        $customerToken = false;
        if(isset($params['user_token']) && !$customerToken = CustomerToken::where('token', $params['user_token'])->first()) {
            if (!$customerToken = $this->registerNewCustomerViaCreditCard($params, $params['token'])) {
                Log::warning(
                    '[Register Credit Card] Erro! Usuário não encontrado pelo user token'
                );
                return response()->json(array('success' => false, 'message' => 'Usuário não encontrado pelo user token'), 422);
            }
        }
        if ($customerToken) {
            $customer = $customerToken->customer;
        }

        $creditCard = CreditCard::where('card_number', $params['card_number'])->first();
        if($creditCard && CreditCardToken::where('company_token', $params['token'])->where('credit_card_id', $creditCard->id)->first()) {
            return response()->json(array('success' => false, 'message' => 'Cartão já registrado!'), 409);
        }

        if (!$creditCard) {
            $creditCard = CreditCard::create(
                CreditCardRequest::filterParams($params)
            );
        }

        // Registrando Cartão de Cŕedito no Anti Fraude
        $fraudAnalysiService = new FraudAnalysi($this->getBusiness());
        if (!$fraudAnalysiService->registerCreditCard($creditCard)) {
            Log::critical(
                '[Fraud Analysis] Cartão não autorizado pelo anti fraude'
            );
            return response()->json(
                $this->responseWithErrorMessage($fraudAnalysiService->getError()),
                406
            );
        }

        // Registrando Cartão de Cŕedito no Gateway
        $service = new Gateway($this->getBusiness());
        if (!$registerCreditCard = $service->registerCreditCard($creditCard)) {
            return response()->json(
                $this->responseWithErrorMessage('Cartão não registrado.'),
                406
            );
        }

        if (isset($params['gateway_mundipagg']) && !empty($params['gateway_mundipagg'])) {
            $gatewayCreditCard = new GatewayCreditCard();
            $gatewayCreditCard->token = $params['gateway_mundipagg'];
            $gatewayCreditCard->customer_id = $customer->id;
            $gatewayCreditCard->credit_card_id = $creditCard->id;
            $gatewayCreditCard->gateway_id = Mundipagg::$id;
            $gatewayCreditCard->user_id = $this->getBusiness()->id;
            $customer->gatewayCreditCards()->save($gatewayCreditCard);
        }

        $creditCardToken = new CreditCardToken();
        $creditCardToken->customer_id = $customer->id;
        $creditCardToken->company_token = $params['token'];
        $creditCardToken->is_active = 1;
        $creditCardToken->credit_card_id = $creditCard->id;
        $creditCardToken->user_id = $this->getBusiness()->id;
        $creditCard->creditCardTokens()->save($creditCardToken);

        return (new CreditCardTokenResource($creditCardToken))
            ->additional([
                'message' => 'Cartao registrado com sucesso.',
            ]);
    }

    /**
     * API é chamada caso o token da passepague não seja null ou vazio
     * 
     * Método: POST
     * 
     * @paramApi string $user_token Passepague token
     * @paramApi string $token Company token
     * @paramApi string $card_id
     * @paramApi string $brand_id
     * @paramApi string $card_number
     * @paramApi string $exp_year
     * @paramApi string $exp_month
     * @paramApi string $card_name
     * @paramApi string $cpf
     * @paramApi string $is_active hardcoded 1
     * 
     * @returnApi json
     *
     * @param CreditCardRequest $request
     * @return CreditCardResource|void
     */
    public function edit(CreditCardRequest $request)
    {
        $userToken = $request->input('user_token');
        $companyToken = $request->input('token');
        $cardId = $request->input('card_id');

        if (!$creditCard = CreditCard::find($cardId)) {
            return abort(404, 'Cartão não encontrado.');
            // return response()->json(
            //     $this->responseWithErrorMessage('Cartão não encontrado.'),
            //     404
            // );
        }

        $creditCard->update($request->all());

        return new CreditCardResource($creditCard);
    }

    /**
     * API é chamada caso o token da passepague não seja null ou vazio
     * 
     * Método: POST
     * 
     * @paramApi string $user_token Passepague token
     * @paramApi string $token Company token
     * @paramApi string $card_id
     * 
     * @returnApi json
     *
     * @param CreditCardDeleteRequest $request
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function delete(CreditCardDeleteRequest $request)
    {
//        $userToken = $request->input('user_token');
        $companyToken = $request->input('token');
        $cardId = $request->input('card_id');

        if (!$creditCard = CreditCard::find($cardId)) {
            return abort(404, 'Cartão não encontrado.');
            // return response()->json(
            //     $this->responseWithErrorMessage('Cartão não encontrado.'),
            //     404
            // );
        }

        CreditCardToken::where('company_token', $companyToken)->where('credit_card_id', $creditCard->id)->delete();

        return response()->json(
            $this->responseWithMessage('Cartão deletado com sucesso.'),
            200
        );
    }

    /**
     * API refe-se a cards/get da api da passepague, usada para retornar um array 
     * com todos os cartões daquele usuário
     * 
     * Método: POST
     * 
     * @paramApi string $cpf
     * 
     * @returnApi json
     * 
     * @param CreditCardUserRequest $request
     */
    public function user(CreditCardUserRequest $request)
    {
        /** @todo Descobrir aonde essa url  é usada e fazer documentação */

        $companyToken = $request->input('token');
        $cpf = Filter::cpf($request->input('identity_document'));

        if (empty(Customer::where('cpf', $cpf)->get())) {
            return abort(404, 'Cliente não encontrado.');
        }

        $cards = CreditCard::where('cpf', $cpf)->get();

        $payload = array();

        $i = 0;
        foreach($cards as $card):
            $payload[$i]['id'] = $card['id'];
            $payload[$i]['brand_id'] = $card['brand_id'];
            $payload[$i]['card_number'] = $card['card_number'];
            $payload[$i]['card_name'] = $card['card_name'];
            // $payload[$i]['exp_year'] = $card['exp_year'];
            // $payload[$i]['exp_month'] = $card['exp_month'];
            // $payload[$i]['cvc'] = $card['cvc'];
            $i ++;
        endforeach;

        return $payload;
    }

    /**
     * API é chamada caso o token da passepague não seja null ou vazio
     * 
     * Método: POST
     * 
     * @paramApi string $user_token Passepague token
     * @paramApi string $token Company token
     * @paramApi string $brand_id
     * @paramApi string $card_number
     * @paramApi string $exp_year
     * @paramApi string $exp_month
     * @paramApi string $card_name
     * @paramApi string $cvc
     * @paramApi string $rede_token
     * @paramApi string $is_active hardcoded 1
     * 
     * @returnApi bool success
     * @returnApi string message
     * @returnApi string data->card_id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function validation(CreditCardValidationRequest $request) # aconselho mudar o nome dessa função
    {
        // @todo Fazer tbm o CreditCardValidationRequest de acordo  com a documentação

        // $params = $request->all();

        // $userToken = $request->input('user_token');
        // $cardNumber = $request->input('card_number');
        
        // if (!$creditCard = CreditCard::find($cardId)) {
        //     return abort(404, 'Cartão não encontrado.');
        //     return response()->json(
        //         $this->responseWithErrorMessage('Cartão não encontrado.'),
        //         404
        //     );
        // }

        // $creditCard->delete();
        // return response()->json(
        //     $this->responseWithMessage('Cartão deletado com sucesso.'),
        //     200
        // );

        return response()->json(
            $this->responseWithMessage('Validation Fazer'),
            200
        );
    }

    /**
     * API é chamada caso o token da passepague não seja null ou vazio
     * 
     * Método: POST
     * 
     * @paramApi string $user_token Passepague token
     * @paramApi string $token Company token
     * @paramApi string $card_id
     * @paramApi string $validation_token
     * @paramApi string $rede_token
     * 
     * @returnApi bool success
     * @returnApi string message
     */
    public function validateToken(CreditCardValidateTokenRequest $request)
    {
        // @todo Fazer Tbm o CreditCardValidateTokenRequest de acordo com a documentação
        return response()->json(
            $this->responseWithMessage('Validation Token Fazer'),
            200
        );
    }

    /**
     * API para retornar todos os cartões de um usuário.
     * 
     * Método: POST
     * 
     * @paramApi string $user_token Passepague token
     * @paramApi string $token Company token
     * @paramApi string $not_validaded Opcional Default: true (Retorna os cartões não validados)
     * 
     * @returnApi json
     *
     * @param CreditCardValidRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function valid(CreditCardValidRequest $request) # aconselho mudar o nome dessa função
    {
        $companyToken = $request->input('token');
        $userToken = $request->input('user_token');
        $params = $request->all();

        if(!$customerToken = CustomerToken::where('token', $userToken)->where('company_token', $companyToken)->first()) {
            return response()->json(array('success' => false, 'message' => 'Usuário não encontrado!'), 409);
        }

        $notValidated = false;
        if (isset($params['not_validated'])){
            $notValidated = $params['not_validated'];
        }

        $where = [
            'customer_id' => $customerToken->customer_id,
            'credit_cards.is_active' => !$notValidated
        ];
        
        return CreditCardTokenResource::collection(CreditCardToken::where($where)->with('creditCards')->get());
    }

    /**
     * Registrando um novo usuário com os dados do cartão de crédito caso não exista
     * Retorna customerToken para o pedido
     */
    protected function registerNewCustomerViaCreditCard($params, $companyToken)
    {
        if (
            !isset($params['email']) ||
            !isset($params['cpf'])
        ) {
            return false;
        }
        
        $cpf = Filter::cpf($params['cpf']);
        $email = $params['email'];
        $name = $params['name'];

        $customerFindByCpf = Customer::where('cpf', $cpf)->first();
        $customerFindByEmail = Customer::where('email', $email)->first();

        // Procura por Cpf
        if(
            $customerFindByCpf && 
            $customerToken = CustomerToken::where('company_token', $companyToken)->
            where('customer_id', $customerFindByCpf->id)->first()
        ) {
            return $customerToken;
        }

        // Procura por Email
        if(
            $customerFindByEmail && 
            $customerToken = CustomerToken::where('company_token', $companyToken)->
            where('customer_id', $customerFindByEmail->id)->first()
            
        ) {
            return $customerToken;
        }


        if (!$customer = $customerFindByEmail) {
            $customer = $customerFindByCpf;
        }

        if (!$customer) {
            $customer = Customer::create(
                CustomerRequest::filterParams(
                    [
                        'token' => $params,
                        'role_id' => 3,
                        'cpf' => $cpf,
                        'email' => $email,
                        'name' => $name
                    ]
                )
            );
            Log::info(
                '[RegisterCreditCard] Customer Adicionado durante cadastro de cartão: '.$cpf
            );

            // Registrando Usuário no Gateway
            $service = new Gateway($this->getBusiness());
            if (!$registerCustomer = $service->registerCustomer($customer)) {
                // return abort(404, 'Usuário não registrado.');
                return false;
            }
        }


        $customerToken = new CustomerToken();
        $customerToken->company_token = $companyToken;
        $customerToken->customer_id = $customer->id;
        $customerToken->is_active = 1;
        $customer->customerTokens()->save($customerToken);

        return $customerToken;
    }
}