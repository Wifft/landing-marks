<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Map extends Model
{
    use HasFactory;

    /**
     * @inheritDoc
     */
    protected $fillable = [
        'title',
        'uuid'
    ];

    public function discordUsers() : BelongsToMany
    {
        return $this->belongsToMany(DiscordUser::class, 'discord_users_maps')->withPivot(['marker_data']);
    }

    public function activities() : HasMany
    {
        return $this->hasMany(DiscordUserActivity::class);
    }
}
