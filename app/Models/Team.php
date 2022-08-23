<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;
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



    public function users()
    {
        return $this->belongsToMany(User::class, null,'teams_ids','users_ids');
    }
}
