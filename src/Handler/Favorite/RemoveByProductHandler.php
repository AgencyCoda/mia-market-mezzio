<?php

namespace Mia\Market\Handler\Favorite;

use Mia\Core\Exception\MiaException;
use Mia\Market\Model\MiaProductFavorite;

/**
 * Description of RemoveHandler
 * 
 * @OA\Get(
 *     path="/product_favorite/remove-by-product/{id}",
 *     summary="ProductFavorite Revove",
 *     tags={"ProductFavorite"},
 *     @OA\Parameter(
 *         name="id",
 *         description="Id of Item",
 *         required=true,
 *         in="path"
 *     ),
 *     @OA\Response(
 *          response=200,
 *          description="successful operation",
 *          @OA\JsonContent(ref="#/components/schemas/MiaJsonResponse")
 *     ),
 *     security={
 *         {"bearerAuth": {}}
 *     },
 * )
 *
 * @author matiascamiletti
 */
class RemoveByProductHandler extends \Mia\Auth\Request\MiaAuthRequestHandler
{
    /**
     * 
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function handle(\Psr\Http\Message\ServerRequestInterface $request): \Psr\Http\Message\ResponseInterface 
    {
        // Get Current User
        $user = $this->getUser($request);
        // Obtenemos ID si fue enviado
        $itemId = $this->getParam($request, 'id', '');
        // Buscar si existe el item en la DB
        //return $itemId;
        $item = MiaProductFavorite::where('product_id', $itemId)->where('user_id', $user->id)->first();
        // verificar si existe
        if($item === null){
            throw new MiaException('Not exist');
        }
        $item->delete();
        // Devolvemos respuesta
        return new \Mia\Core\Diactoros\MiaJsonResponse(true);
    }
}