<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersMap extends Model
{
    use HasFactory;

    public $table = 'discord_users_maps';
    public $timestamps = false;
}
