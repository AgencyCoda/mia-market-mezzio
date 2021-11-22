<?php

namespace Mia\Market\Handler\Store;

use Mia\Core\Helper\StringHelper;
use Mia\Market\Model\MiaStore;

/**
 * Description of FetchHandler
 * 
 * @OA\Get(
 *     path="/mia-market/store/fetch/{id}",
 *     summary="Store Fetch By ID",
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
class SaveHandler extends \Mia\Auth\Request\MiaAuthRequestHandler
{
    /**
     * 
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function handle(\Psr\Http\Message\ServerRequestInterface $request): \Psr\Http\Message\ResponseInterface
    {
        // Obtener item a procesar
        $item = $this->getForEdit($request);
        // Guardamos data
        $item->title = $this->getParam($request, 'title', '');
        if($item->id == 0){
            $before = MiaStore::latest()->first();
            $item->slug = ($before !== null ? $before->id : 1) . '-' . StringHelper::createSlug($item->title);
        } else {
            $item->slug = $item->id . '-' . StringHelper::createSlug($item->title);
        }
        $item->category_id = $this->getParam($request, 'category_id', null);
        $item->caption = $this->getParam($request, 'caption', '');
        $item->photos = $this->getParam($request, 'photos', []);
        $item->address = $this->getParam($request, 'address', '');
        $item->address_number = $this->getParam($request, 'address_number', '');
        $item->city_id = intval($this->getParam($request, 'city_id', ''));
        $item->zip_code = $this->getParam($request, 'zip_code', '');
        $item->photo_featured = $this->getParam($request, 'photo_featured', ['url' => '']);
        $item->website = $this->getParam($request, 'website', '');
        $item->facebook = $this->getParam($request, 'facebook', '');
        $item->instagram = $this->getParam($request, 'instagram', '');
        $item->twitter = $this->getParam($request, 'twitter', '');
        $item->vision = $this->getParam($request, 'vision', '');
        $item->fullname = $this->getParam($request, 'fullname', '');
        $item->legal_number = $this->getParam($request, 'legal_number', '');
        $item->person_city_id = $this->getParam($request, 'person_city_id', null);
        $item->person_address = $this->getParam($request, 'person_address', '');
        $item->person_email = $this->getParam($request, 'person_email', '');
        $item->person_phone = $this->getParam($request, 'person_phone', '');
        
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
     * @return \App\Model\MiaCategory
     */
    protected function getForEdit(\Psr\Http\Message\ServerRequestInterface $request)
    {
        // Obtenemos ID si fue enviado
        $itemId = $this->getParam($request, 'id', '');
        // Buscar si existe el item en la DB
        $item = MiaStore::find($itemId);
        // verificar si existe
        if($item === null){
            return new MiaStore();
        }
        // Devolvemos item para editar
        return $item;
    }
}