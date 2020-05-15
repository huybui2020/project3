<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;


class Product extends Model
{
    use LogsActivity;
    use Sluggable;
    use SluggableScopeHelpers;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'products';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [ 'product_slug', 'product_name', 'content', 'price', 'discount', 'product_views','catalog_id'];

    

    /**
     * Change activity log event description
     *
     * @param string $eventName
     *
     * @return string
     */
    public function getDescriptionForEvent($eventName)
    {
        return __CLASS__ . " model has been {$eventName}";
    }


    public function cata()
    {
        return $this->belongsTo('App\Catalog', 'catalog_id','id');
    }

    public function sluggable()
    {
        return [
            'product_slug' => [
                'source' => 'product_temp_slug'
            ]
        ];
    }
}
