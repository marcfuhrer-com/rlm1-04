<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Building
 *
 * @property int $id
 * @property string $name
 * @property string|null $created_at
 * @property string|null $updated_at
 * @method static \Database\Factories\BuildingFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Building newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Building newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Building query()
 * @method static \Illuminate\Database\Eloquent\Builder|Building whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Building whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Building whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Building whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Building extends Model
{
    use HasFactory;
    protected $table = "buildings";
    protected $primaryKey = "id";
    public $timestamps = false;


}
