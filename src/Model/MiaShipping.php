<?php

namespace Mia\Market\Model;

/**
 * Description of Model
 * @property int $id ID of item
 * @property mixed $order_id Description for variable
 * @property mixed $status Description for variable
 * @property mixed $date_delivered Description for variable
 * @property mixed $origin_address Description for variable
 * @property mixed $origin_latitude Description for variable
 * @property mixed $origin_longitude Description for variable
 * @property mixed $destination_address Description for variable
 * @property mixed $destination_latitude Description for variable
 * @property mixed $destination_longitude Description for variable
 * @property mixed $provider Description for variable
 * @property mixed $code Description for variable
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
 *  property="order_id",
 *  type="integer",
 *  description=""
 * )
 * @OA\Property(
 *  property="status",
 *  type="integer",
 *  description=""
 * )
 * @OA\Property(
 *  property="date_delivered",
 *  type="",
 *  description=""
 * )
 * @OA\Property(
 *  property="origin_address",
 *  type="string",
 *  description=""
 * )
 * @OA\Property(
 *  property="origin_latitude",
 *  type="number",
 *  description=""
 * )
 * @OA\Property(
 *  property="origin_longitude",
 *  type="number",
 *  description=""
 * )
 * @OA\Property(
 *  property="destination_address",
 *  type="string",
 *  description=""
 * )
 * @OA\Property(
 *  property="destination_latitude",
 *  type="number",
 *  description=""
 * )
 * @OA\Property(
 *  property="destination_longitude",
 *  type="number",
 *  description=""
 * )
 * @OA\Property(
 *  property="provider",
 *  type="integer",
 *  description=""
 * )
 * @OA\Property(
 *  property="code",
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
class MiaShipping extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'mia_shipping';
    
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
    public function order()
    {
        return $this->belongsTo(MiaOrder::class, 'order_id');
    }
    /**
     * 
     *
     * @return HasMany
     */
    public function details()
    {
        return $this->hasMany(MiaShippingDetail::class, 'shipping_id');
    }


    
}