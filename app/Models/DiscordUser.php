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
        'avatar'
    ];

    /**
     * @inheritDoc
     */
    protected $casts = [
        'discord_id' => 'int'
    ];

    /**
     * Maps relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function maps() : BelongsToMany
    {
        $pivotFields = [
            'marker_data',
            'has_role',
            'is_admin',
            'created_at'
        ];

        return $this->belongsToMany(Map::class, (new UsersMap)->table)->withPivot($pivotFields);
    }
}
