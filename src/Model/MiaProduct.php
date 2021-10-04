<?php

namespace Mia\Market\Model;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Mia\Category\Model\MiaCategory;

/**
 * Description of Model
 * @property int $id ID of item
 * @property mixed $title Description for variable
 * @property mixed $sku Description for variable
 * @property mixed $slug Description for variable
 * @property mixed $photo_main Description for variable
 * @property mixed $stock Description for variable
 * @property mixed $caption Description for variable
 * @property mixed $photos Description for variable
 * @property mixed $store_id Description for variable
 * @property mixed $created_at Description for variable
 * @property mixed $updated_at Description for variable
 * @property mixed $deleted Description for variable

 *
 * @OA\Schema()
 * @OA\Property(
 *  property="id",
 *  type="integer",
 *  description=""
 * )
 * @OA\Property(
 *  property="title",
 *  type="string",
 *  description=""
 * )
 * @OA\Property(
 *  property="sku",
 *  type="string",
 *  description=""
 * )
 * @OA\Property(
 *  property="slug",
 *  type="string",
 *  description=""
 * )
 * @OA\Property(
 *  property="photo_main",
 *  type="string",
 *  description=""
 * )
 * @OA\Property(
 *  property="stock",
 *  type="integer",
 *  description=""
 * )
 * @OA\Property(
 *  property="caption",
 *  type="string",
 *  description=""
 * )
 * @OA\Property(
 *  property="photos",
 *  type="string",
 *  description=""
 * )
 * @OA\Property(
 *  property="store_id",
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
 * @OA\Property(
 *  property="deleted",
 *  type="integer",
 *  description=""
 * )

 *
 * @author matiascamiletti
 */
class MiaProduct extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'mia_product';
    
    protected $casts = ['photos' => 'array'];

    protected $fillable = ['store_id'];
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
    public function category()
    {
        return $this->belongsTo(MiaCategory::class, 'category_id');
    }
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
     *
     * @return HasMany
     */
    public function childs()
    {
        return $this->hasMany(MiaProductChild::class, 'product_id');
    }


    /**
    * Configurar un filtro a todas las querys
    * @return void
    */
    protected static function boot(): void
    {
        parent::boot();
        
        static::addGlobalScope('exclude', function (\Illuminate\Database\Eloquent\Builder $builder) {
            $builder->where('mia_product.deleted', 0);
        });
    }
}