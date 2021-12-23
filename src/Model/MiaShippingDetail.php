<?php

namespace App\Model;

/**
 * Description of Model
 * @property int $id ID of item
 * @property mixed $shipping_id Description for variable
 * @property mixed $status Description for variable
 * @property mixed $caption Description for variable
 * @property mixed $created_at Description for variable
 * @property mixed $updated_at Description for variable

 *
 * @OA\Schema()
 * @OA\Property(
 *  property="id",
 *  type="integer",
 *  description=""
 * )
 * @OA\Property(
 *  property="shipping_id",
 *  type="integer",
 *  description=""
 * )
 * @OA\Property(
 *  property="status",
 *  type="integer",
 *  description=""
 * )
 * @OA\Property(
 *  property="caption",
 *  type="string",
 *  description=""
 * )
 * @OA\Property(
 *  property="created_at",
 *  type="",
 *  description=""
 * )
 * @OA\Property(
 *  property="updated_at",
 *  type="",
 *  description=""
 * )

 *
 * @author matiascamiletti
 */
class MiaShippingDetail extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'mia_shipping_detail';
    
    //protected $casts = ['data' => 'array'];
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    //public $timestamps = false;

    /**
    * 
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function shipping()
    {
        return $this->belongsTo(MiaShipping::class, 'shipping_id');
    }


    
}