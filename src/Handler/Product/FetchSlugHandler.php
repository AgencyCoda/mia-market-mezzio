<?php

namespace Mia\Market\Handler\Product;

use Mia\Market\Model\MiaProduct;
use Mia\Market\Model\MiaProductFavorite;

/**
 * Description of FetchHandler
 * 
 * @OA\Get(
 *     path="/mia-market/product/fetch-slug/{slug}",
 *     summary="Product Fetch By Slug",
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
class FetchSlugHandler extends \Mia\Auth\Request\MiaAuthRequestHandler
{
    /**
     * 
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function handle(\Psr\Http\Message\ServerRequestInterface $request): \Psr\Http\Message\ResponseInterface
    {
        // Obtenemos ID si fue enviado
        $itemSlug = $this->getParam($request, 'slug', '');
        // Buscar si existe el en la DB
        $item = MiaProduct::with(['store', 'childs'])->where('slug', $itemSlug)->first();
        // verificar si existe
        if($item === null){
            return new \Mia\Core\Diactoros\MiaJsonErrorResponse(1, 'This element is not exist.');
        }
        // Process Data
        $data = $item->toArray();

        // Verify if user logged
        $user = $this->getUser($request);
        if($user !== null && MiaProductFavorite::where('user_id', $user->id)->where('product_id', $item->id)->first() !== null){
            $data['is_favorite'] = 1;
        }else {
            $data['is_favorite'] = 0;
        }
        // Devolvemos respuesta
        return new \Mia\Core\Diactoros\MiaJsonResponse($data);
    }
}