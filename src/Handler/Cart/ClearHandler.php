<?php

namespace Mia\Market\Handler\Cart;

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
class ClearHandler extends \Mia\Auth\Request\MiaAuthRequestHandler
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
        // Buscar si existe el item en la DB
        $item = MiaCart::where('user_id', $user->id)->delete();
        // Devolvemos respuesta
        return new \Mia\Core\Diactoros\MiaJsonResponse(true);
    }
}