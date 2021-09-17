<?php

namespace Mia\Market\Repository;

use \Illuminate\Database\Capsule\Manager as DB;

/**
 * Description of MiaCartRepository
 *
 * @author matiascamiletti
 */
class MiaCartRepository 
{
    /**
     * 
     * @param \Mia\Database\Query\Configure $configure
     * @return \Illuminate\Pagination\Paginator
     */
    public static function fetchByConfigure(\Mia\Database\Query\Configure $configure)
    {
        $query = \Mia\Market\Model\MiaCart::select('mia_cart.*');
        
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
