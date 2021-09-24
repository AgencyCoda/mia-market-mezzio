<?php

namespace Mia\Market\Handler\Product;

use Mia\Market\Model\MiaProduct;
use Mia\Market\Model\MiaProductFavorite;

/**
 * Description of FetchHandler
 * 
 * @OA\Get(
 *     path="/mia-market/product/fetch/{id}",
 *     summary="Product Fetch By ID",
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
        $item = MiaProduct::with(['store', 'childs'])->where('id', $itemId)->first();
        // verificar si existe
        if($item === null){
            return new \Mia\Core\Diactoros\MiaJsonErrorResponse(1, 'This element is not exist.');
        }
        // Process Data
        $data = $item->toArray();

        // Verify if user logged
        $user = $this->getUser($request);
        if($user !== null && MiaProductFavorite::where('user_id', $user->id)->where('product_id', $itemId)->first()->first() !== null){
            $data['is_favorite'] = 1;
        }else {
            $data['is_favorite'] = 0;
        }

        // Devolvemos respuesta
        return new \Mia\Core\Diactoros\MiaJsonResponse($data);
    }
}