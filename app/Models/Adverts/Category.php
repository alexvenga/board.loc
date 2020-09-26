<?php

namespace App\Models\Adverts;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

/**
 * App\Models\Adverts\Category
 *
 * @property-read \Kalnoy\Nestedset\Collection|\App\Models\Adverts\Category[] $children
 * @property-read int|null $children_count
 * @property-read \App\Models\Adverts\Category $parent
 * @property-write mixed $parent_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Adverts\Category d()
 * @method static \Kalnoy\Nestedset\QueryBuilder|\App\Models\Adverts\Category newModelQuery()
 * @method static \Kalnoy\Nestedset\QueryBuilder|\App\Models\Adverts\Category newQuery()
 * @method static \Kalnoy\Nestedset\QueryBuilder|\App\Models\Adverts\Category query()
 * @mixin \Eloquent
 */
class Category extends Model
{

    use NodeTrait;

    public $timestamps = false;

    protected $table = 'advert_categories';

    protected $fillable = [
        'name', 'slug', 'parent_id'
    ];

}
