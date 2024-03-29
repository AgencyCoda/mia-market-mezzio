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
    public static function fetchByConfigure(\Mia\Database\Query\Configure $configure, MIAUser $user = null)
    {
        $query = \Mia\Market\Model\MiaProduct::select('mia_product.*');

        // Verify if has_favorite with
        if($configure->isExistWith('has_favorite') && $user != null){
            $configure->removeWith('has_favorite');
            $configure->addSelectRaw('COALESCE((SELECT 1 FROM mia_product_favorite WHERE mia_product_favorite.product_id = mia_product.id AND mia_product_favorite.user_id = ' . $user->id . '), 0) as is_favorite');
        }

        // Verify if store is valid
        if($configure->isExistWith('store_is_valid')){
            $configure->removeWith('store_is_valid');
            $configure->addJoin('mia_store', 'mia_store.id', 'mia_product.store_id');
            $configure->addWhere('mia_store.deleted', '0');
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
    /**
     * Return total
     *
     * @param [type] $from
     * @param [type] $to
     * @param [type] $status
     * @return int
     */
    public static function totals($from, $to)
    {
        $row = \Mia\Market\Model\MiaProduct::
                selectRaw('COUNT(*) as total')
                ->whereRaw('DATE(created_at) >= DATE(?) AND DATE(created_at) <= DATE(?)', [$from, $to])
                ->first();
        if($row === null||$row->total == null){
            return 0;
        }
        return $row->total;
    }
}
