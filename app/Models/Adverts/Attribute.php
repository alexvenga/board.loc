<?php

namespace App\Models\Adverts;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Adverts\Attribute
 * @property int $id
 * @property int $category_id
 * @property string $name
 * @property string $type
 * @property string $default
 * @property boolean $required
 * @property array $variants
 * @property integer $sort
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Adverts\Attribute newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Adverts\Attribute newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Adverts\Attribute query()
 * @mixin \Eloquent
 */
class Attribute extends Model
{

    public const TYPE_STRING = 'string';
    public const TYPE_INTEGER = 'integer';
    public const TYPE_FLOAT = 'float';

    protected $table = 'advert_attributes';

    public $timestamps = false;

    protected $fillable = [
        'name', 'type', 'required', 'default', 'variants', 'sort'
    ];

    protected $casts = [
        'variants' => 'array',
    ];

    public static function typesList(): array
    {
        return [
            self::TYPE_STRING,
            self::TYPE_INTEGER,
            self::TYPE_FLOAT,
        ];
    }

    public function isString()
    {
        return $this->type === self::TYPE_STRING;
    }

    public function isFloat()
    {
        return $this->type === self::TYPE_FLOAT;
    }

    public function isInteger()
    {
        return $this->type === self::TYPE_INTEGER;
    }

    public function isSelect()
    {
        return \count($this->variants) > 0;
    }

}
