<?php

namespace Mia\Market\Handler\Product;

use Mia\Core\Helper\StringHelper;
use Mia\Market\Handler\BaseStoreHandler;
use Mia\Market\Model\MiaProduct;

/**
 * Description of SaveHandler
 * 
 * @OA\Post(
 *     path="/mia_product/save",
 *     summary="MiaProduct Save",
 *     tags={"MiaProduct"},
*      @OA\RequestBody(
 *         description="Object",
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/MiaProduct")
 *         )
 *     ),
 *     @OA\Response(
 *          response=200,
 *          description="successful operation",
 *          @OA\JsonContent(ref="#/components/schemas/MiaProduct")
 *     ),
 *     security={
 *         {"bearerAuth": {}}
 *     },
 * )
 *
 * @author matiascamiletti
 */
class SaveHandler extends BaseStoreHandler
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
        // Obtener item a procesar
        $item = $this->getForEdit($request);
        // Guardamos data
        $item->title = $this->getParam($request, 'title', '');
        $item->sku = $this->getParam($request, 'sku', '');
        $item->slug = StringHelper::createSlug($item->store_id . '-' . $item->title);
        $item->photo_main = $this->getParam($request, 'photo_main', '');
        $item->caption = $this->getParam($request, 'caption', '');
        $item->price = $this->getParam($request, 'price', 0);
        $item->category_id = $this->getParam($request, 'category_id', null);
        $item->photos = $this->getParam($request, 'photos', []);

        $childs = $this->getParam($request, 'childs', []);
        
        try {
            $item->save();
        } catch (\Exception $exc) {
            return new \Mia\Core\Diactoros\MiaJsonErrorResponse(-2, $exc->getMessage());
        }

        // Devolvemos respuesta
        return new \Mia\Core\Diactoros\MiaJsonResponse($item->toArray());
    }
    
    /**
     * 
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @return \App\Model\MiaProduct
     */
    protected function getForEdit(\Psr\Http\Message\ServerRequestInterface $request)
    {
        $store = $this->getStore($request);
        // Obtenemos ID si fue enviado
        $itemId = $this->getParam($request, 'id', '');
        // Buscar si existe el item en la DB
        $item = MiaProduct::where('store_id', $store->id)->where('id', $itemId)->first();
        // verificar si existe
        if($item === null){
            return new MiaProduct([
                'store_id' => $store->id
            ]);
        }
        // Devolvemos item para editar
        return $item;
    }
}