<?php

namespace Mia\Market\Handler\Order;

use Mia\Market\Handler\BaseStoreHandler;
use Mia\Market\Model\MiaOrder;
use Mia\Market\Repository\MiaOrderRepository;

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
class ChangeStatusByStoreHandler extends BaseStoreHandler
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
        // Obtenemos ID si fue enviado
        $itemId = $this->getParam($request, 'id', '');
        // Buscar si existe el en la DB
        $item = MiaOrder::where('store_id', $this->store->id)->where('id', $itemId)->first();
        // verificar si existe
        if($item === null){
            return new \Mia\Core\Diactoros\MiaJsonErrorResponse(1, 'This element is not exist.');
        }
        $item->status = $this->getParam($request, 'status', MiaOrder::STATUS_PENDING);
        $item->save();
        // Devolvemos respuesta
        return new \Mia\Core\Diactoros\MiaJsonResponse(true);
    }
}