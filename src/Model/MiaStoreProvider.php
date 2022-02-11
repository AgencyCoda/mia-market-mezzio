<?php

namespace Mia\Market\Model;

use Mia\Auth\Model\MIAUser;

/**
 * Description of Model
 * @property int $id ID of item
 * @property mixed $user_id Description for variable
 * @property mixed $store_id Description for variable
 * @property mixed $role Description for variable

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
 *  property="store_id",
 *  type="integer",
 *  description=""
 * )
 * @OA\Property(
 *  property="role",
 *  type="integer",
 *  description=""
 * )

 *
 * @author matiascamiletti
 */
class MiaStoreProvider extends \Illuminate\Database\Eloquent\Model
{
    const TYPE_MERCADOPAGO = 0;

    const STATUS_PENDING = 0;
    const STATUS_ACTIVE = 1;

    protected $table = 'mia_store_provider';
    
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
}