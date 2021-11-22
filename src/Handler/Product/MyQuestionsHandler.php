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
class MyQuestionsHandler extends \Mia\Auth\Request\MiaAuthRequestHandler
{
    /**
     * 
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function handle(\Psr\Http\Message\ServerRequestInterface $request): \Psr\Http\Message\ResponseInterface
    {
        // Get current user
        $user = $this->getUser($request);
        // Buscar si existe el tour en la DB
        $items = MiaProductQuestion::with(['nestedChildren', 'product'])->where('user_id', $user->id)->whereNull('parent_id')->orderBy('id', 'desc')->get();
        // Devolvemos respuesta
        return new \Mia\Core\Diactoros\MiaJsonResponse($items->toArray());
    }
}