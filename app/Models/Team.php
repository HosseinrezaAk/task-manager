<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Relations\BelongsToMany;

/**
 * @property string name
 */
class Team extends Model
{
    use HasFactory;

    protected $collection = 'tm_teams';
    protected $fillable = [
      'name',
    ];


    /**
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, null,'teams_ids','users_ids');
    }

    /**
     * @return BelongsTo
     */
    public function project() : BelongsTo
    {
        return $this->belongsTo(Project::class,'projectID');
    }
}
