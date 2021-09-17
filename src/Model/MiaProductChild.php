<?php

namespace Mia\Market\Model;

/**
 * Description of Model
 * @property int $id ID of item
 * @property mixed $product_id Description for variable
 * @property mixed $stock Description for variable
 * @property mixed $color_type Description for variable
 * @property mixed $group Description for variable

 *
 * @OA\Schema()
 * @OA\Property(
 *  property="id",
 *  type="integer",
 *  description=""
 * )
 * @OA\Property(
 *  property="product_id",
 *  type="integer",
 *  description=""
 * )
 * @OA\Property(
 *  property="stock",
 *  type="integer",
 *  description=""
 * )
 * @OA\Property(
 *  property="color_type",
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
class MiaProductChild extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'mia_product_child';
    
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
    public function product()
    {
        return $this->belongsTo(MiaProduct::class, 'product_id');
    }


    
}