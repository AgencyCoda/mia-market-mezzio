<?php

namespace Mia\Market\Handler\Cart;

use Mia\Core\Exception\MiaException;
use Mia\Market\Model\MiaCart;

/**
 * Description of RemoveHandler
 * 
 * @OA\Get(
 *     path="/cart/remove/{id}",
 *     summary="Cart Revove",
 *     tags={"Cart"},
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
class RemoveHandler extends \Mia\Auth\Request\MiaAuthRequestHandler
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
        $productId = $this->getParam($request, 'id', '');
        $childId = $this->getParam($request, 'child_id', '');
        // Buscar si existe el item en la DB
        $item = MiaCart::where('user_id', $user->id)->where('product_id', $productId)->where('child_id', $childId)->first();
        // verificar si existe
        if($item === null){
            throw new MiaException('not exist');
        }
        $item->delete();
        // Devolvemos respuesta
        return new \Mia\Core\Diactoros\MiaJsonResponse(true);
    }
}