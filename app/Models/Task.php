<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Relations\BelongsTo;
use Jenssegers\Mongodb\Eloquent\Model;
class Task extends Model
{
    use HasFactory;

    protected $collection = 'tm_tasks';
    protected $fillable = [
        'name',
        'creator'
    ];


    /**
     * @return BelongsTo
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class,'projectID');
    }


    public function assignee(){
        return $this->belongsTo(User::class , 'assigneeID');
    }

    public function creator(){
        return $this->belongsTo(User::class, 'creatorID');
    }

}
