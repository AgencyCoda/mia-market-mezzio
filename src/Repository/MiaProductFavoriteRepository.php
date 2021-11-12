<?php

namespace Mia\Market\Repository;

use \Illuminate\Database\Capsule\Manager as DB;

/**
 * Description of MiaProductFavoriteRepository
 *
 * @author matiascamiletti
 */
class MiaProductFavoriteRepository 
{
    /**
     * 
     * @param \Mia\Database\Query\Configure $configure
     * @return \Illuminate\Pagination\Paginator
     */
    public static function fetchByConfigure(\Mia\Database\Query\Configure $configure)
    {
        $query = \Mia\Market\Model\MiaProductFavorite::select('mia_product_favorite.*');
        
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

    /**
     * Return total
     *
     * @param [type] $from
     * @param [type] $to
     * @param [type] $status
     * @return void
     */
    public static function totals($from, $to)
    {
        $row = \Mia\Market\Model\MiaProductFavorite::
                selectRaw('COUNT(*) as total')
                ->selectRaw('SUM(total) as sum_total')
                ->whereRaw('DATE(created_at) >= DATE(?) AND DATE(created_at) <= DATE(?)', [$from, $to])
                ->first();
        if($row === null||$row->total == null){
            return [0, 0];
        }
        return [$row->total, $row->sum_total];
    }
}
