<?php

namespace Mia\Market\Repository;

use \Illuminate\Database\Capsule\Manager as DB;

/**
 * Description of MiaStoreRepository
 *
 * @author matiascamiletti
 */
class MiaStoreRepository 
{
    /**
     * 
     * @param \Mia\Database\Query\Configure $configure
     * @return \Illuminate\Pagination\Paginator
     */
    public static function fetchByConfigure(\Mia\Database\Query\Configure $configure)
    {
        $query = \Mia\Market\Model\MiaStore::select('mia_store.*');
        
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

    public static function totals($from, $to)
    {
        $row = \Mia\Market\Model\MiaStore::
                selectRaw('COUNT(*) as total')
                ->whereRaw('DATE(created_at) >= DATE(?) AND DATE(created_at) <= DATE(?)', [$from, $to])
                ->first();
        if($row === null||$row->total == null){
            return 0;
        }
        return $row->total;
    }
}
