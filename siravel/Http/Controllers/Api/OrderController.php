<?php

namespace Siravel\Http\Controllers\Api;

use Siravel\Models\Order;
use Siravel\Models\CustomerToken;
use Siravel\Models\CreditCard;
use Siravel\Models\Role;
use Siravel\Http\Resources\OrderResource;
use Siravel\Http\Requests\OrderRequest;
use Siravel\Http\Requests\OrderFindRequest;
use Siravel\Http\Requests\CreditCardRequest;
use Siravel\Services\Gateway;
use Siravel\Services\FraudAnalysi;
use Siravel\Logic\Connections\Integrations\Gateways\Mundipagg;
use Siravel\Models\Customer;
use Siravel\Models\CreditCardToken;
use Illuminate\Support\Facades\Log;
use Siravel\Http\Requests\CustomerRequest;
use Siravel\Sitec\Validate;
use Siravel\Sitec\Filter;

class OrderController extends Controller
{
    /**
     * Método: POST
     * 
     * Array Recebido:
     * 
     * Origem do Pedido
     * Ex: app
     * @paramApi $data['origin']
     *
     * Token do Usuário
     * @paramApi $data['user_token']
     *
     * Token da Produtora/Organização/Company
     * @paramApi $data['token'] -> Equivalente a company_token
     *
     * Label da Fatura especifico para a Company
     * @paramApi $data['cardDescription']
     *
     * @paramApi $data['reference']
     * @paramApi $data['description']
     * 
     * Metodo de Pagamento: (O default é 2 (cartão de cŕedito))
     * @paramApi $data['payment_type_id']
     * @paramApi $data['installments'] Número de Parcelas: Default 1
     * 
     * Se está ativado (Default: 0)
     * @paramApi $data['is_active'] // integer
     * 
     * @paramApi $data['customer']
     * @paramApi $data['customer']['name'] = $customer->nome;
     * @paramApi $data['customer']['email'] = $customer->email;
     * @paramApi $data['customer']['address'] = [];
     * @paramApi $data['customer']['address']['street'] = $customer->rua;
     * @paramApi $data['customer']['address']['number'] = $customer->numero;
     * @paramApi $data['customer']['address']['complement'] = $customer->complemento;
     * @paramApi $data['customer']['address']['zipcode'] = $customer->cep;
     * @paramApi $data['customer']['address']['city'] = $customer_city;
     * @paramApi $data['customer']['address']['state'] = $customer->estado;
     * @paramApi $data['customer']['address']['country'] = "BRA";
     *
     * Informações Dispositivo
     * @paramApi $data['device_token']
     * @paramApi $data['device']
     * 
     * Cartão de Crédito
     * @paramApi $data['credit_card_id'] (Ou tras um ID ou as informações abaixo preenchidas até o cvv)
     * @paramApi $data['card_number']
     * @paramApi $data['exp_year']
     * @paramApi $data['exp_month']
     * @paramApi $data['brand_id']
     * @paramApi $data['card_name']
     * 
     * CVV
     * @paramApi $data['cvc'] // integer
     * 
     * Numeração Bancária
     * @paramApi $data['bank_slip_id']
     * 
     * Tokens
     * @paramApi $data['already_paid']
     * @paramApi $data['token_order_mundipagg']
     *
     * Adquirente de Pagamento
     * Ex: cielo
     * @paramApi $data['rede_token']
     * 
     * Analise de Fraude
     * @paramApi $data['fraud_analysis']
     * @paramApi $data['fraud_analysis']['cart']
     * @paramApi $data['fraud_analysis']['cart']['is_gift'] // Bollean Default: false
     * @paramApi $data['fraud_analysis']['cart']['returns_accepted'] // Bollean Default: false
     * @paramApi $data['fraud_analysis']['cart']['items'][]['gift_category'] // Default: Off
     * @paramApi $data['fraud_analysis']['cart']['items'][]['host_hedge'] // Default: Normal
     * @paramApi $data['fraud_analysis']['cart']['items'][]['non_sensical_hedge'] // Default: High
     * @paramApi $data['fraud_analysis']['cart']['items'][]['obscenities_hedge'] // Default: Normal
     * @paramApi $data['fraud_analysis']['cart']['items'][]['phone_hedge'] // Default: High
     * @paramApi $data['fraud_analysis']['cart']['items'][]['name'] // Default: Nome Evento - Nome Ingresso
     * @paramApi $data['fraud_analysis']['cart']['items'][]['quantity'] // Default: 1
     * @paramApi $data['fraud_analysis']['cart']['items'][]['sku'] // Default: NumeroUnicoEvento#NumeroUnicoIngresso
     * @paramApi $data['fraud_analysis']['cart']['items'][]['unit_price']
     * @paramApi $data['fraud_analysis']['cart']['items'][]['risk'] // Default: High
     * @paramApi $data['fraud_analysis']['cart']['items'][]['time_hedge'] // Default: High
     * @paramApi $data['fraud_analysis']['cart']['items'][]['type'] // Default: Default
     * @paramApi $data['fraud_analysis']['cart']['items'][]['velocity_hedge'] // Default: High
     * @paramApi $data['fraud_analysis']['shipping']['method'] // string 5 possibilidades (SameDay, OneDay, TwoDay, ThreeDay, Other)
     * 
     * Konduto
     * @paramApi $data['konduto'] // Bollean
     * 
     * Informações sobre Entrega (Obrigátório para Konduto e Antifraude)
     * @paramApi $data['tax_id'] = preg_replace('/[^0-9]/', '', $request->identity_document);
     * @paramApi $data['billing_name'] = mb_strtoupper($request->card_name, $encoding);
     * @paramApi $data['billing_address'] = $request->address;
     * @paramApi $data['billing_complement'] = $request->complement;
     * @paramApi $data['billing_city'] = $request->city;
     * @paramApi $data['billing_state'] = $request->state;
     * @paramApi $data['billing_zip'] = $request->zipcode;
     * @paramApi $data['billing_country'] = "BRA";
     * 
     * @returnApi json
     * data['success'] -> Bollean
     * data['data']['nsu'] -> Não sei Oq é
     * data['data']['tid'] -> Tambem não tenho ideia
     * data['data']['status'] -> Status de Pagamento (Segue Abaixo):
     * Caso Pendente cai sempre em status 0 
     * Caso Aprovado cai sempre em status 1 (Marca pedido como Pago)
     * Caso Bloqueado cai sempre em status 2
     * review (Caso Negado) -> 6 (Não Pago)
     * declined (Caso Negado)  -> 7 (Não Pago)
     * Caso negado e nao seja nem 6 e nem 7 então será status 8 (Não pago)
     *
     * @param OrderRequest $request
     * @return OrderResource
     */
    public function register(OrderRequest $request)
    {
        $companyToken = $request->input('token');
        $userToken = $request->input('user_token');
        $creditCardId = $request->input('credit_card_id');
        $params = $request->all();

        if(empty($companyToken)) {
            return response()->json(
                $this->responseWithErrorMessage(
                    '[Register Order] É necessário enviar o company token'
                ),
                422
            );
        }

        if(!$customerToken = CustomerToken::where('company_token', $companyToken)->where('token', $userToken)->first()) {
            if (!$customerToken = $this->registerNewCustomerViaOrder($params, $companyToken)) {
                Log::notice(
                    '[Register Order] Erro ao Criar pedido!'.
                    'Cliente não encontrado.'
                );
                return response()->json(
                    $this->responseWithErrorMessage(
                        'Cliente não encontrado'
                    ),
                    422
                );
            }
        }

        // @todo Tratar Quando tiver o id do cartão inves dos dados
        
        // Validate Cartão
        if(!Validate::month($params['exp_month'])) {
            return response()->json(
                $this->responseWithErrorMessage(
                    'Mẽs de vencimento inválido'
                ),
                422
            );
        }

        $creditCardAndToken = $this->createCreditCard($params, $companyToken);
        if(!$creditCardAndToken && !$creditCard = CreditCard::find($creditCardId)) {
            Log::notice(
                '[Register Order] Erro ao Criar pedido!'.
                'Cartão não encontrado.'
            );
            return response()->json(
                $this->responseWithErrorMessage(
                    'Cartão de Crédito ou usuário não encontrado'
                ),
                422
            );
        }
        $creditCard = $creditCardAndToken[0];
        $creditCardToken = $creditCardAndToken[1];
        
        $params['customer_id'] = $customerToken->customer_id;
        $params['customer_token_id'] = $customerToken->id;
        $params['credit_card_id'] = $creditCard->id;
        $params['credit_card_token_id'] = $creditCardToken->id;
        $params['user_id'] = $this->getBusiness()->id;
        $order = Order::create(OrderRequest::filterParams($params));

        // Caso tenha token da mundipagg, ja retorna como salvo
        if (isset($params['token_order_mundipagg'])){
            $order->gateway_id = Mundipagg::$id;
            $order->gateway_token_mundipagg = $params['token_order_mundipagg'];
            $order->status = Order::$STATUS_ANALYSIS;
            if (isset($data['already_paid']) && $data['already_paid'] == true) {
                $order->status = Order::$STATUS_APPROVED;
            }
            $order->save();
            return new OrderResource($order);
        }

        // Registrando Pedido no Anti Fraude
        $fraudAnalysiService = new FraudAnalysi($this->getBusiness());
        if (!$fraudAnalysiService->registerOrder($order)) {
            Log::critical(
                '[Fraud Analysis] Pedido não autorizado pelo anti fraude'
            );
            return response()->json(
                $this->responseWithErrorMessage($fraudAnalysiService->getError()),
                406
            );
        }

        // Registrando Pedido no Gateway
        $service = new Gateway($this->getBusiness());
        if (!$registerOrder = $service->registerOrder($order, $params)) {
            return response()->json(
                $this->responseWithErrorMessage($service->getError()),
                406
            );
        }
        
        return new OrderResource($order);
    }

    /**
     * Cria um novo cartão de credito em cima do pedido
     */
    private function createCreditCard($params, $companyToken)
    {
        if(!is_array($params) || !isset($params['token'])) {
            return false;
        }
        if(!isset($params['card_number'])) {
            return false;
        }
        if(!isset($params['cpf']) && !isset($params['user_token'])) {
            Log::warning('[Register Order] Erro ao Criar cartão de crédito durante pedido. Sem Cpf ou User Token');
            return false;
        }
        if(isset($params['cpf']) && !$customer = Customer::where('cpf', Filter::cpf($params['cpf']))->first()) {
            Log::warning(
                '[Register Order] Erro ao Criar cartão de crédito durante pedido. '.
                'Usuário não encontrado pelo cpf'
            );
            return false;
        }
        $customerToken = false;
        if(isset($params['user_token']) && !$customerToken = CustomerToken::where('token', $params['user_token'])->first()) {
            if (!$customerToken = $this->registerNewCustomerViaOrder($params, $companyToken)) {
                Log::warning(
                    '[Register Order] Erro ao Criar cartão de crédito durante pedido. '.
                    'Usuário não encontrado pelo user token'
                );
                return false;
            }
        }
        if ($customerToken) {
            $customer = $customerToken->customer;
        }

        $creditCard = CreditCard::where('card_number', $params['card_number'])->first();
        if($creditCard && $creditCardToken = CreditCardToken::where('company_token', $params['token'])->where('credit_card_id', $creditCard->id)->first()) {
            return [$creditCard, $creditCardToken];
        }


        if (!$creditCard) {
            $params['cpf'] = Filter::cpf($customer->cpf);
            $creditCard = CreditCard::create(
                CreditCardRequest::filterParams($params)
            );

            // Registrando Cartão de Cŕedito no Gateway
            $service = new Gateway($this->getBusiness());
            if (!$registerCreditCard = $service->registerCreditCard($creditCard)) {
                Log::info(
                    'Erro ao Criar cartão de crédito durante pedido.'.
                    'Cartão não registrado.'
                );
                return false;
            }
        }

        // @todo @fixme Sempre cria o Token ?? Vai dar ruim !
        $creditCardToken = new CreditCardToken();
        $creditCardToken->customer_id = $customer->id;
        $creditCardToken->company_token = $params['token'];
        $creditCardToken->is_active = 1;
        $creditCardToken->credit_card_id = $creditCard->id;
        $creditCardToken->user_id = $this->getBusiness()->id;
        $creditCard->creditCardTokens()->save($creditCardToken);

        return [$creditCard, $creditCardToken];
    }

    /**
     * Chamada p/retornar p/outras APIs o token (acredito tatar-se do company token)
     * 
     * Método: POST
     * 
     * @paramApi string $tid
     * @paramApi string $token Rede token
     * 
     * @returnApi json
     *
     * @param OrderFindRequest $request
     * @return OrderResource|void
     */
    public function find(OrderFindRequest $request)
    {
        $tid = (string) $request->input('tid');
        $token = (string) $request->input('token');

        // @todo Pesquisar pelo tid e pelo token
        if (!$order = Order::where('tid', $tid)->first()) {
            return abort(404, 'Pedido não encontrado.');
        }
        
        return new OrderResource($order);
    }

    /**
     * Registrando um novo usuário com os dados do pedido caso não exista
     * Retorna customerToken para o pedido
     */
    protected function registerNewCustomerViaOrder($params, $companyToken)
    {
        if (
            !isset($params['customer']) ||
            !isset($params['customer']['email']) ||
            !isset($params['customer']['cpf'])
        ) {
            return false;
        }
        
        $cpf = Filter::cpf($params['customer']['cpf']);
        $email = $params['customer']['email'];
        $name = $params['customer']['name'];

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
                        'role_id' => Role::$CUSTOMER,
                        'cpf' => $cpf,
                        'email' => $email,
                        'name' => $name
                    ]
                )
            );
            Log::info(
                '[RegisterOrder] Customer Adicionado durante pedido: '.$cpf
            );

            // Registrando Usuário no Gateway
            $service = new Gateway($this->getBusiness());
            if (!$registerCustomer = $service->registerCustomer($customer)) {
                return response()->json(
                    $this->responseWithErrorMessage($service->getError()),
                    406
                );
            }
        }


        $customerToken = new CustomerToken();
        $customerToken->company_token = $companyToken;
        $customerToken->customer_id = $customer->id;
        $customerToken->is_active = 1;
        $customerToken->user_id = $this->getBusiness()->id;
        $customer->customerTokens()->save($customerToken);

        return $customerToken;
    }
}