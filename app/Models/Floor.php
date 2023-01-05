<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Floor
 *
 * @property int $id
 * @property string $name
 * @property int $building_id
 * @property string|null $created_at
 * @property string|null $updated_at
 * @method static \Database\Factories\FloorFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Floor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Floor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Floor query()
 * @method static \Illuminate\Database\Eloquent\Builder|Floor whereBuildingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Floor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Floor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Floor whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Floor whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Floor extends Model
{
    use HasFactory;
    protected $table = "floors";
    protected $primaryKey = "id";
    public $timestamps = false;
}
