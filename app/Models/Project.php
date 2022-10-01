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
    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'teamID');
    }

    public function assigneeUser()
    {
        return $this->belongsTo(User::class, "assigneeUserID");

    }

}
