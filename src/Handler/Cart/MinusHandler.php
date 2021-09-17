<?php

namespace Mia\Market\Handler\Cart;

use Mia\Market\Model\MiaCart;

/**
 * Description of SaveHandler
 * 
 * @OA\Post(
 *     path="/cart/minus",
 *     summary="Cart Minus",
 *     tags={"Cart"},
*      @OA\RequestBody(
 *         description="Object",
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Cart")
 *         )
 *     ),
 *     @OA\Response(
 *          response=200,
 *          description="successful operation",
 *          @OA\JsonContent(ref="#/components/schemas/Cart")
 *     ),
 *     security={
 *         {"bearerAuth": {}}
 *     },
 * )
 *
 * @author matiascamiletti
 */
class MinusHandler extends \Mia\Auth\Request\MiaAuthRequestHandler
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
        // Obtener item a procesar
        $item = new MiaCart();
        // Guardamos data
        $item->user_id = $user->id;
        $item->product_id = intval($this->getParam($request, 'product_id', ''));
        $item->child_id = intval($this->getParam($request, 'child_id', ''));
        $item->quantity = intval($this->getParam($request, 'quantity', 0));
        
        $exist = MiaCart::where('user_id', $user->id)->where('product_id', $item->product_id)->where('child_id', $item->child_id)->first();
        if($exist !== null){
            $exist->quantity -= $item->quantity;
            $exist->save();
        }
        
        // Devolvemos respuesta
        return new \Mia\Core\Diactoros\MiaJsonResponse(true);
    }
}