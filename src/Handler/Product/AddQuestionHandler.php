<?php

namespace Mia\Market\Handler\Product;

use Mia\Core\Exception\MiaException;
use Mia\Market\Model\MiaProduct;
use Mia\Market\Model\MiaProductQuestion;
use Mia\Market\Model\MiaProductReview;

/**
 * Description of FetchHandler
 * 
 * @OA\Post(
 *     path="/mia-market/product/add-question",
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
class AddQuestionHandler extends \Mia\Auth\Request\MiaAuthRequestHandler
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
        // Buscar si existe el en la DB
        $item = MiaProduct::where('id', $itemId)->first();
        // verificar si existe
        if($item === null){
            return new \Mia\Core\Diactoros\MiaJsonErrorResponse(1, 'This element is not exist.');
        }

        $row = new MiaProductQuestion();
        $row->product_id = $itemId;
        $row->user_id = $user->id;
        $row->caption = $this->getParam($request, 'caption', '');
        $row->status = MiaProductQuestion::STATUS_PENDING;
        $row->save();
        
        // Devolvemos respuesta
        return new \Mia\Core\Diactoros\MiaJsonResponse($row->toArray());
    }
}