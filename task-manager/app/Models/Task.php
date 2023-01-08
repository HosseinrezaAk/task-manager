<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Relations\BelongsTo;
use Jenssegers\Mongodb\Eloquent\Model;


/**
 * @property    string     name
 */
class Task extends Model
{
    use HasFactory;

    protected $collection = 'tm_tasks';
    protected $fillable = [
        'name',
    ];


    /**
     * @return BelongsTo
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class,'projectID');
    }

    /**
     * @return BelongsTo
     */
    public function assigneeUser(): BelongsTo
    {
        return $this->belongsTo(User::class , 'assigneeUserID');
    }

    /**
     * @return BelongsTo
     */
    public function creatorUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creatorUserID');
    }



}
