<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersMap extends Model
{
    use HasFactory;

    public $table = 'discord_users_maps';

    protected $fillable = [
        'discord_user_id',
        'map_id',
        'has_role',
        'is_admin'
    ];
}
