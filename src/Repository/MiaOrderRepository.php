<?php

namespace Mia\Market\Repository;

use \Illuminate\Database\Capsule\Manager as DB;
use Mia\Market\Model\MiaOrder;

/**
 * Description of MiaOrderRepository
 *
 * @author matiascamiletti
 */
class MiaOrderRepository 
{
    /**
     * 
     * @param \Mia\Database\Query\Configure $configure
     * @return \Illuminate\Pagination\Paginator
     */
    public static function fetchByConfigure(\Mia\Database\Query\Configure $configure)
    {
        $query = MiaOrder::select('mia_order.*');
        
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
     * Return total orders
     *
     * @param [type] $from
     * @param [type] $to
     * @param [type] $status
     * @return void
     */
    public static function totals($from, $to, $status = MiaOrder::STATUS_PAYOUT)
    {
        $row = MiaOrder::
                selectRaw('COUNT(*) as total')
                ->selectRaw('SUM(total) as sum_total')
                ->where('status', $status)
                ->whereRaw('DATE(created_at) >= DATE(?) AND DATE(created_at) <= DATE(?)', [$from, $to])
                ->first();
        if($row === null||$row->total == null){
            return [0, 0];
        }
        return [$row->total, $row->sum_total];
    }
    /**
     * Return total orders
     *
     * @param [type] $storeId
     * @param [type] $from
     * @param [type] $to
     * @param [type] $status
     * @return void
     */
    public static function totalsByStoreInRange($storeId, $from, $to, $status = MiaOrder::STATUS_PAYOUT)
    {
        $row = MiaOrder::
                selectRaw('COUNT(*) as total_count')
                ->selectRaw('SUM(total) as sum_total')
                ->where('status', $status)
                ->whereRaw('DATE(created_at) >= DATE(?) AND DATE(created_at) <= DATE(?)', [$from, $to])
                ->where('store_id', $storeId)
                ->first();
        if($row === null||$row->total_count == null){
            return [0, 0];
        }
        return [$row->total_count, $row->sum_total];
    }
}
