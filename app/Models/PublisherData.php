<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PublisherData
 *
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $building_id
 * @property int $floor_id
 * @property mixed $view
 * @property string $ip_range
 * @method static \Database\Factories\PublisherDataFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|PublisherData newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PublisherData newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PublisherData query()
 * @method static \Illuminate\Database\Eloquent\Builder|PublisherData whereBuildingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublisherData whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublisherData whereFloorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublisherData whereIpRange($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublisherData whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublisherData whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublisherData whereView($value)
 * @mixin \Eloquent
 */
class PublisherData extends Model
{
    use HasFactory;
    protected $table = "publisher_data";
    protected $primaryKey = "name";
    protected $keyType = 'string';
    public $incrementing = false;
}
