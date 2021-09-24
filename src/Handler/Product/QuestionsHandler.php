<?php

namespace Mia\Market\Handler\Product;

use Mia\Market\Model\MiaProduct;
use Mia\Market\Model\MiaProductQuestion;

/**
 * Description of FetchHandler
 * 
 * @OA\Get(
 *     path="/mia-market/product/questions/{id}",
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
class QuestionsHandler extends \Mia\Auth\Request\MiaAuthRequestHandler
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
        $item = MiaProduct::where('id', $itemId)->first();
        // verificar si existe
        if($item === null){
            return new \Mia\Core\Diactoros\MiaJsonErrorResponse(1, 'This element is not exist.');
        }
        // Buscar si existe el tour en la DB
        $items = MiaProductQuestion::with(['nestedChildren'])->where('product_id', $itemId)->whereNull('parent_id')->orderBy('id', 'desc')->get();
        // Devolvemos respuesta
        return new \Mia\Core\Diactoros\MiaJsonResponse($items->toArray());
    }
}