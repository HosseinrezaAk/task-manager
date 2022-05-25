<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * @property string _id
 * @property string status
 * @property string[] userIDs
 */

class Project extends Model
{
    use HasFactory;


    protected $collection = "tm_projects";

    protected $fillable = [
        "name",
        "status",

    ];

}
