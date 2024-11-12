<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Jetstream\Jetstream;
use Laravel\Jetstream\TeamInvitation as JetstreamTeamInvitation;

/**
 * @mixin IdeHelperTeamInvitation
 */
class TeamInvitation extends JetstreamTeamInvitation
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'role',
    ];

    /**
     * Get the team that the invitation belongs to.
     *
     * @return BelongsTo<Model, $this>
     */
    public function team(): BelongsTo
    {
        /** @var class-string<Model> $teamModel */
        $teamModel = Jetstream::teamModel();

        return $this->belongsTo($teamModel);
    }
}
