<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string name
 */
class Team extends Model
{
    use HasFactory;

    protected $fillable = [
      'name',
    ];

    public function users()
    {
        return $this->belongsToMany(Team::class);
    }
}
