<?php

namespace Mia\Market\Handler\Store;

use Mia\Market\Model\MiaStore;

/**
 * Description of FetchHandler
 * 
 * @OA\Get(
 *     path="/mia-market/store/fetch/{id}",
 *     summary="Store Fetch By ID",
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
class FetchHandler extends \Mia\Auth\Request\MiaAuthRequestHandler
{
    /**
     * 
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function handle(\Psr\Http\Message\ServerRequestInterface $request): \Psr\Http\Message\ResponseInterface
    {
        // Obtenemos ID si fue enviado
        $itemId = $this->getParam($request, 'id', '');
        // Buscar si existe el en la DB
        $item = MiaStore::with(['category', 'city'])->where('id', $itemId)->first();
        // verificar si existe
        if($item === null){
            return new \Mia\Core\Diactoros\MiaJsonErrorResponse(1, 'This element is not exist.');
        }
        // Devolvemos respuesta
        return new \Mia\Core\Diactoros\MiaJsonResponse($item->toArray());
    }
}