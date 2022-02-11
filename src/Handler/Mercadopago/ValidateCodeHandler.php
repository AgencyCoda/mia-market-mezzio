<?php

namespace Mia\Market\Handler\Mercadopago;

use Mia\Market\Handler\BaseStoreHandler;
use Mia\Market\Model\MiaStoreProvider;
use Mia\Mercadopago\Helper\MercadopagoHelper;

/**
 * Description of FetchHandler
 *
 * @author matiascamiletti
 */
class ValidateCodeHandler extends BaseStoreHandler
{
    /**
     * @var MercadopagoHelper
     */
    protected $service;

    public function __construct(MercadopagoHelper $service)
    {
        $this->service = $service;
    }
    /**
     * 
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function handle(\Psr\Http\Message\ServerRequestInterface $request): \Psr\Http\Message\ResponseInterface
    {
        $this->initStore($request);
        // Get Current User
        $user = $this->getUser($request);
        // get Code
        $code = $this->getParam($request, 'code', '');
        // Validate code
        $data = $this->service->validateAuthorizationCode($code, getenv('MERCADOPAGO_REDIRECT_URL') ? getenv('MERCADOPAGO_REDIRECT_URL') : '/mercadopago/connect');
        // Save data
        $provider = MiaStoreProvider::where('store_id', $this->store->id)->where('type', MiaStoreProvider::TYPE_MERCADOPAGO)->first();
        if($provider === null){
            $provider = new MiaStoreProvider();
            $provider->type = MiaStoreProvider::TYPE_MERCADOPAGO;
        }
        $provider->access_token = $data->access_token;
        $provider->token_type = $data->token_type;
        $provider->expires_in = $data->expires_in;
        $provider->refresh_token = $data->refresh_token;
        $provider->scope = $data->scope;
        $provider->status = MiaStoreProvider::STATUS_ACTIVE;
        $provider->save();
        
        // Devolvemos respuesta
        return new \Mia\Core\Diactoros\MiaJsonResponse(true);
    }
}