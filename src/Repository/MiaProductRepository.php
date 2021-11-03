<?php

namespace Mia\Market\Repository;

use \Illuminate\Database\Capsule\Manager as DB;
use Mia\Auth\Model\MIAUser;

/**
 * Description of MiaProductRepository
 *
 * @author matiascamiletti
 */
class MiaProductRepository 
{
    /**
     * 
     * @param \Mia\Database\Query\Configure $configure
     * @return \Illuminate\Pagination\Paginator
     */
    public static function fetchByConfigure(\Mia\Database\Query\Configure $configure, MIAUser $user)
    {
        $query = \Mia\Market\Model\MiaProduct::select('mia_product.*');

        // Verify if has_favorite with
        if($configure->isExistWith('has_favorite') && $user != null){
            $configure->removeWith('has_favorite');
            $configure->addSelectRaw('COALESCE((SELECT 1 FROM mia_product_favorite WHERE mia_product_favorite.product_id = mia_product.id AND mia_product_favorite.user_id = ' . $user->id . '), 0) as is_favorite');
        }
        
        if(!$configure->hasOrder()){
            $query->orderByRaw('id DESC');
        }
        $search = $configure->getSearch();
        if($search != ''){
            //$values = $search . '|' . implode('|', explode(' ', $search));
            //$query->whereRaw('(firstname REGEXP ? OR lastname REGEXP ? OR email REGEXP ?)', [$values, $values, $values]);
        }
        
        // Procesar parametros
        $configure->run($query);

        return $query->paginate($configure->getLimit(), ['*'], 'page', $configure->getPage());
    }
}
