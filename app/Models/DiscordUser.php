<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class DiscordUser extends Model
{
    use HasFactory;

    /**
     * @inheritDoc
     */
    protected $fillable = [
        'nickname'
    ];

    public function maps() : BelongsToMany
    {
        return $this->belongsToMany(Map::class, 'discord_user_maps')->withPivot(['marker_data']);
    }
}
