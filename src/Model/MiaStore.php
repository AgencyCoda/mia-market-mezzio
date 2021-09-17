<?php

namespace Mia\Market\Model;

use Mia\Category\Model\MiaCategory;
use Mia\Location\Model\MiaCity;

/**
 * Description of Model
 * @property int $id ID of item
 * @property mixed $title Description for variable
 * @property mixed $slug Description for variable
 * @property mixed $category_id Description for variable
 * @property mixed $caption Description for variable
 * @property mixed $photos Description for variable
 * @property mixed $address Description for variable
 * @property mixed $address_number Description for variable
 * @property mixed $city_id Description for variable
 * @property mixed $zip_code Description for variable
 * @property mixed $photo_featured Description for variable
 * @property mixed $website Description for variable
 * @property mixed $facebook Description for variable
 * @property mixed $instagram Description for variable
 * @property mixed $twitter Description for variable
 * @property mixed $vision Description for variable
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
 *  property="slug",
 *  type="string",
 *  description=""
 * )
 * @OA\Property(
 *  property="category_id",
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
 *  property="address",
 *  type="string",
 *  description=""
 * )
 * @OA\Property(
 *  property="address_number",
 *  type="string",
 *  description=""
 * )
 * @OA\Property(
 *  property="city_id",
 *  type="integer",
 *  description=""
 * )
 * @OA\Property(
 *  property="zip_code",
 *  type="string",
 *  description=""
 * )
 * @OA\Property(
 *  property="photo_featured",
 *  type="string",
 *  description=""
 * )
 * @OA\Property(
 *  property="website",
 *  type="string",
 *  description=""
 * )
 * @OA\Property(
 *  property="facebook",
 *  type="string",
 *  description=""
 * )
 * @OA\Property(
 *  property="instagram",
 *  type="string",
 *  description=""
 * )
 * @OA\Property(
 *  property="twitter",
 *  type="string",
 *  description=""
 * )
 * @OA\Property(
 *  property="vision",
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
 * @OA\Property(
 *  property="deleted",
 *  type="integer",
 *  description=""
 * )

 *
 * @author matiascamiletti
 */
class MiaStore extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'mia_store';
    
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
    public function category()
    {
        return $this->belongsTo(MiaCategory::class, 'category_id');
    }
    /**
    * 
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function city()
    {
        return $this->belongsTo(MiaCity::class, 'city_id');
    }


    /**
    * Configurar un filtro a todas las querys
    * @return void
    */
    protected static function boot(): void
    {
        parent::boot();
        
        static::addGlobalScope('exclude', function (\Illuminate\Database\Eloquent\Builder $builder) {
            $builder->where('mia_store.deleted', 0);
        });
    }
}