<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'description',
    ];

    public function sharedWith()
    {
        return $this->belongsToMany(User::class, 'task_user', 'task_id', 'user_id')->withPivot('permission')->withTimestamps();
    }
}
