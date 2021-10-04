<?php

namespace Mia\Market\Middleware;

use Mia\Auth\Middleware\MiaAuthMiddleware;
use Mia\Market\Model\MiaStore;
use Mia\Market\Model\MiaStorePermission;

/**
 * Description of MiaAuthMiddleware
 *
 * @author matiascamiletti
 */
class StoreByIdMiddleware extends MiaAuthMiddleware
{

    public function process(\Psr\Http\Message\ServerRequestInterface $request, \Psr\Http\Server\RequestHandlerInterface $handler) : \Psr\Http\Message\ResponseInterface
    {
        // Get Store Id
        $storeId = $this->getParam($request, 'store_id', '');
        // Obtener usuario
        $user = $this->getUser($request);
        // Obtener cuenta del usuario
        $permission = MiaStorePermission::where('store_id', $storeId)->where('user_id', $user->id)->first();
        // Verificar si existe
        if($permission == null){
            return new \Mia\Core\Diactoros\MiaJsonErrorResponse(-100, 'Your store not exist.');
        }
        // Devolver account
        return $handler->handle($request->withAttribute(MiaStore::class, $permission->store));
    }
}