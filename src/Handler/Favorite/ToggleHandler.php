<?php

namespace Mia\Market\Handler\Favorite;

use Mia\Market\Model\MiaProductFavorite;

/**
 * Description of FetchHandler
 * 
 * @OA\Get(
 *     path="/product/toggle-favorite/{id}",
 *     summary="Product Fetch",
 *     tags={"Product"},
 *     @OA\Parameter(
 *         name="id",
 *         description="Id of Item",
 *         required=true,
 *         in="path"
 *     ),
 *     @OA\Response(
 *          response=200,
 *          description="successful operation",
 *          @OA\JsonContent(ref="#/components/schemas/Product")
 *     ),
 *     security={
 *         {"bearerAuth": {}}
 *     }
 * )
 *
 * @author matiascamiletti
 */
class ToggleHandler extends \Mia\Auth\Request\MiaAuthRequestHandler
{
    /**
     * 
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function handle(\Psr\Http\Message\ServerRequestInterface $request): \Psr\Http\Message\ResponseInterface
    {
        // Get Current user
        $user = $this->getUser($request);
        // Obtenemos ID si fue enviado
        $itemId = $this->getParam($request, 'id', '');
        // Search exist favorite
        $item = MiaProductFavorite::where('user_id', $user->id)->where('product_id', $itemId)->first();
        if($item === null){
            $item = new MiaProductFavorite();
            $item->user_id = $user->id;
            $item->product_id = $itemId;
            $item->save();
        } else {
            $item->delete();
        }
        // Devolvemos respuesta
        return new \Mia\Core\Diactoros\MiaJsonResponse(true);
    }
}