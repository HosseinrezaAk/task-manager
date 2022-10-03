<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Relations\BelongsTo;

/**
 * @property string name
 *
 */
class Project extends Model
{
    use HasFactory;
    protected $collection = 'tm_projects';
    protected $fillable = [
        'name',

    ];

    /**
     * @return BelongsTo
     */
    public function assigneeTeam(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'assigneeTeamID');
    }

    /**
     * @return BelongsTo
     */
    public function assigneeUser() : BelongsTo
    {
        return $this->belongsTo(User::class, "assigneeUserID");

    }

    public function creatorUser()
    {

    }



}
