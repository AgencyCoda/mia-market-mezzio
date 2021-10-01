<?php

namespace Mia\Market\Model;

/**
 * Description of Model
 * @property int $id ID of item
 * @property mixed $order_id Description for variable
 * @property mixed $product_id Description for variable
 * @property mixed $amount Description for variable
 * @property mixed $type_id Description for variable
 * @property mixed $group Description for variable

 *
 * @OA\Schema()
 * @OA\Property(
 *  property="id",
 *  type="integer",
 *  description=""
 * )
 * @OA\Property(
 *  property="order_id",
 *  type="integer",
 *  description=""
 * )
 * @OA\Property(
 *  property="product_id",
 *  type="integer",
 *  description=""
 * )
 * @OA\Property(
 *  property="amount",
 *  type="number",
 *  description=""
 * )
 * @OA\Property(
 *  property="type_id",
 *  type="integer",
 *  description=""
 * )
 * @OA\Property(
 *  property="group",
 *  type="string",
 *  description=""
 * )

 *
 * @author matiascamiletti
 */
class MiaOrderDetail extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'mia_order_detail';
    
    //protected $casts = ['data' => 'array'];
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
    * 
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function order()
    {
        return $this->belongsTo(MiaOrder::class, 'order_id');
    }
    /**
    * 
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function product()
    {
        return $this->belongsTo(MiaProduct::class, 'product_id');
    }


    
}