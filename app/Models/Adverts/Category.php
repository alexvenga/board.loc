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
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property int $_lft
 * @property int $_rgt
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Adverts\Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Adverts\Category whereLft($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Adverts\Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Adverts\Category whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Adverts\Category whereRgt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Adverts\Category whereSlug($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Adverts\Attribute[] $attributes
 * @property-read int|null $attributes_count
 */
class Category extends Model
{

    use NodeTrait;

    public $timestamps = false;

    protected $table = 'advert_categories';

    protected $fillable = [
        'name', 'slug', 'parent_id'
    ];

    public function parentAttributes(): array
    {
        return $this->parent ? $this->parent->allAttributes() : [];
    }

    public function allAttributes(): array
    {
        $parent = $this->parentAttributes();
        $own = $this->attributes()->orderBy('sort')->getModels();

        return array_merge($parent, $own);
    }

    public function attributes()
    {
        return $this->hasMany(Attribute::class, 'category_id', 'id');
    }

}
