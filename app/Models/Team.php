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

    protected $collection = "tm_team";

    protected $fillable = [
        "name"
    ];
    protected $primaryKey = "_id";


}
