<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Accesses
 *
 * @property int $id
 * @property int $user_id
 * @property string $publisher_data_name
 * @property int $creates
 * @property int $reads
 * @property int $updates
 * @property int $deletes
 * @property int $subscribes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\AccessesFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Accesses newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Accesses newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Accesses query()
 * @method static \Illuminate\Database\Eloquent\Builder|Accesses whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Accesses whereCreates($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Accesses whereDeletes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Accesses whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Accesses wherePublisherDataName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Accesses whereReads($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Accesses whereSubscribes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Accesses whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Accesses whereUpdates($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Accesses whereUserId($value)
 * @mixin \Eloquent
 */
class Accesses extends Model
{
    use HasFactory;
    protected $table = "accesses";
    public function accesses()
    {
        return $this->hasMany(PublisherData::class);
    }
}
