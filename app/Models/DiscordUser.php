<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

use Illuminate\Database\Eloquent\Model;

class DiscordUser extends Model
{
    use HasFactory;

    /**
     * @inheritDoc
     */
    protected $fillable = [
        'discord_id',
        'nickname',
        'token',
        'avatar',
        'has_role'
    ];

    /**
     * @inheritDoc
     */
    protected $casts = [
        'discord_id' => 'int',
        'has_role' => 'boolean'
    ];

    /**
     * Maps relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function maps() : BelongsToMany
    {
        return $this->belongsToMany(Map::class, 'discord_user_maps')->withPivot(['marker_data']);
    }
}
