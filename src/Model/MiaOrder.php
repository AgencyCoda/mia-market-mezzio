<?php

namespace Mia\Market\Model;

use Mia\Auth\Model\MIAUser;

/**
 * Description of Model
 * @property int $id ID of item
 * @property mixed $store_id Description for variable
 * @property mixed $user_id Description for variable
 * @property mixed $provider_id Description for variable
 * @property mixed $status Description for variable
 * @property mixed $caption Description for variable
 * @property mixed $amount Description for variable
 * @property mixed $additional Description for variable
 * @property mixed $shipping Description for variable
 * @property mixed $taxes Description for variable
 * @property mixed $discount Description for variable
 * @property mixed $total Description for variable
 * @property mixed $data_provider Description for variable
 * @property mixed $external_id Description for variable
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
 *  property="store_id",
 *  type="integer",
 *  description=""
 * )
 * @OA\Property(
 *  property="user_id",
 *  type="integer",
 *  description=""
 * )
 * @OA\Property(
 *  property="provider_id",
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
 *  property="amount",
 *  type="number",
 *  description=""
 * )
 * @OA\Property(
 *  property="additional",
 *  type="number",
 *  description=""
 * )
 * @OA\Property(
 *  property="taxes",
 *  type="number",
 *  description=""
 * )
 * @OA\Property(
 *  property="shipping",
 *  type="number",
 *  description=""
 * )
 * @OA\Property(
 *  property="discount",
 *  type="number",
 *  description=""
 * )
 * @OA\Property(
 *  property="total",
 *  type="number",
 *  description=""
 * )
 * @OA\Property(
 *  property="data_provider",
 *  type="string",
 *  description=""
 * )
 * @OA\Property(
 *  property="external_id",
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
class MiaOrder extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'mia_order';
    
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
    public function store()
    {
        return $this->belongsTo(MiaStore::class, 'store_id');
    }
    /**
    * 
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function user()
    {
        return $this->belongsTo(MIAUser::class, 'user_id');
    }
    /**
     * 
     *
     * @return HasMany
     */
    public function details()
    {
        return $this->hasMany(MiaOrderDetail::class, 'order_id');
    }

    
}