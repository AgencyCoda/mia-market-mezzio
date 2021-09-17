<?php

namespace Mia\Market\Model;

use Mia\Auth\Model\MIAUser;

/**
 * Description of Model
 * @property int $id ID of item
 * @property mixed $user_id Description for variable
 * @property mixed $product_id Description for variable
 * @property mixed $child_id Description for variable
 * @property mixed $quantity Description for variable
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
 *  property="user_id",
 *  type="integer",
 *  description=""
 * )
 * @OA\Property(
 *  property="product_id",
 *  type="integer",
 *  description=""
 * )
 * @OA\Property(
 *  property="child_id",
 *  type="integer",
 *  description=""
 * )
 * @OA\Property(
 *  property="quantity",
 *  type="integer",
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
class MiaCart extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'mia_cart';
    
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
    public function child()
    {
        return $this->belongsTo(MiaProductChild::class, 'child_id');
    }
    /**
    * 
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function product()
    {
        return $this->belongsTo(MiaProduct::class, 'product_id');
    }
    /**
    * 
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function user()
    {
        return $this->belongsTo(MIAUser::class, 'user_id');
    }


    
}