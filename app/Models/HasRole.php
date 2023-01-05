<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\HasRole
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $role_id
 * @property int $user_id
 * @method static \Database\Factories\HasRoleFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|HasRole newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HasRole newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HasRole query()
 * @method static \Illuminate\Database\Eloquent\Builder|HasRole whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HasRole whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HasRole whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HasRole whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HasRole whereUserId($value)
 * @mixin \Eloquent
 */
class HasRole extends Model
{
    use HasFactory;
    protected $table = "has_roles";
}
