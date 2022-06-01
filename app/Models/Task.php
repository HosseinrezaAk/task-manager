<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * @property string _id
 * @property string name
 */
class Task extends Model
{
    use HasFactory;

    protected $collection = "tm_task";

    protected $fillable = [
        "name",
        "progress"
    ];
}
