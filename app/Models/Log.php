<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Log
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $log_level
 * @property string $log_component
 * @property string $log_message
 * @property int|null $user_id
 * @method static \Database\Factories\LogFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Log newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Log newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Log query()
 * @method static \Illuminate\Database\Eloquent\Builder|Log whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Log whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Log whereLogComponent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Log whereLogLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Log whereLogMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Log whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Log whereUserId($value)
 * @mixin \Eloquent
 */
class Log extends Model
{
    use HasFactory;
    protected $table = "logs";
    protected $primaryKey = "id";
}
