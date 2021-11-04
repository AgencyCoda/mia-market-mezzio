<?php

namespace Mia\Market\Handler\Store;

use Mia\Market\Handler\BaseStoreHandler;
use Mia\Market\Model\MiaStore;

/**
 * Description of FetchHandler
 * 
 * @OA\Get(
 *     path="/mia-market/store/me",
 *     summary="Store Me",
 *     tags={"MiaMarket"},
 *     @OA\Parameter(
 *         name="id",
 *         description="Id of Item",
 *         required=true,
 *         in="path"
 *     ),
 *     @OA\Response(
 *          response=200,
 *          description="successful operation",
 *          @OA\JsonContent(ref="#/components/schemas/MiaProduct")
 *     ),
 *     security={
 *         {"bearerAuth": {}}
 *     }
 * )
 *
 * @author matiascamiletti
 */
class MeHandler extends BaseStoreHandler
{
    /**
     * 
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function handle(\Psr\Http\Message\ServerRequestInterface $request): \Psr\Http\Message\ResponseInterface
    {
        // Init Store
        $this->initStore($request);
        // Devolvemos respuesta
        return new \Mia\Core\Diactoros\MiaJsonResponse($this->store->toArray());
    }
}