<?php

namespace Mia\Market\Handler\Payment;

use Illuminate\Database\Eloquent\Collection;
use Mia\Auth\Model\MIAUser;
use Mia\Core\Exception\MiaException;
use Mia\Market\Model\MiaCart;
use Mia\Market\Model\MiaOrder;
use Mia\Market\Model\MiaOrderDetail;

/**
 * Description of ListHandler
 * 
 * @OA\Post(
 *     path="/product_favorite/list",
 *     summary="ProductFavorite List",
 *     tags={"ProductFavorite"},
 *     @OA\RequestBody(
 *         description="Object query",
 *         required=false,
 *         @OA\MediaType(
 *             mediaType="application/json",                 
 *             @OA\Schema(
 *                  @OA\Property(
 *                      property="page",
 *                      type="integer",
 *                      description="Number of pace",
 *                      example="1"
 *                  ),
 *                  @OA\Property(
 *                      property="where",
 *                      type="string",
 *                      description="Wheres | Searchs",
 *                      example=""
 *                  ),
 *                  @OA\Property(
 *                      property="withs",
 *                      type="array",
 *                      description="Array of strings",
 *                      example="[]"
 *                  ),
 *                  @OA\Property(
 *                      property="search",
 *                      type="string",
 *                      description="String of search",
 *                      example=""
 *                  ),
 *                  @OA\Property(
 *                      property="ord",
 *                      type="string",
 *                      description="Ord",
 *                      example=""
 *                  ),
 *                  @OA\Property(
 *                      property="asc",
 *                      type="integer",
 *                      description="Integer",
 *                      example="1"
 *                  ),
 *                  @OA\Property(
 *                      property="limit",
 *                      type="integer",
 *                      description="Limit",
 *                      example="50"
 *                  )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *          response=200,
 *          description="successful operation",
 *          @OA\JsonContent(
 *              allOf={
 *                  @OA\Property(ref="#/components/schemas/MiaJsonResponse"),
 *                  @OA\Property(
 *                      property="response",
 *                      type="array",
 *                      @OA\Items(type="object", ref="#/components/schemas/ProductFavorite")
 *                  )
 *              }
 *          )
 *     ),
 *     security={
 *         {"bearerAuth": {}}
 *     },
 * )
 *
 * @author matiascamiletti
 */
class TestHandler extends \Mia\Auth\Request\MiaAuthRequestHandler
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
        // Search Cart
        $cart = $this->getCart($user);
        // For each products
        $amount = 0;
        foreach($cart as $item) {
            $storeId = $item->product->store_id;
            $amount += $item->product->price * $item->quantity;
        }
        // Create order
        $order = new MiaOrder();
        $order->store_id = $storeId;
        $order->user_id = $user->id;
        $order->provider_id = MiaOrder::PROVIDER_TESTING;
        $order->status = MiaOrder::STATUS_PAYOUT;
        $order->amount = $amount;
        $order->total = $amount;
        $order->save();

        // Create detail
        foreach($cart as $item) {
            $detail = new MiaOrderDetail();
            $detail->order_id = $order->id;
            $detail->product_id = $item->product_id;
            $detail->type_id = $item->child_id;
            $detail->amount = $item->product->price;
            $detail->group = $item->child->group;
            $detail->quantity = $item->quantity;
            $detail->save();
        }

        // Clean Cart
        $this->cleanCart($user);
        
        // Devolvemos respuesta
        return new \Mia\Core\Diactoros\MiaJsonResponse(true);
    }
    /**
     * 
     *
     * @param MIAUser $user
     * @return Collection
     */
    protected function getCart(MIAUser $user)
    {
        $cart = MiaCart::with('product', 'child')->where('user_id', $user->id)->get();
        if($cart->count() == 0){
            throw new MiaException('The cart is empty');
        }
        return $cart;
    }
    /**
     *
     * @param MIAUser $user
     * @return void
     */
    protected function cleanCart(MIAUser $user)
    {
        MiaCart::where('user_id', $user->id)->delete();
    }
}