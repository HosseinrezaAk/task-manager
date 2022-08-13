<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;


/**
 * @property string _id
 * @property string name
 */
class Team extends Model
{
    use HasFactory;

    protected $collection = "tm_teams";

    protected $fillable = [
        "name"
    ];

    public function users(){
        return $this->belongsToMany(User::class,"tm_team_user_pivot", "team_id","user_id");
    }
}
