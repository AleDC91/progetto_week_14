<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "description" ,
        "project_id",
        "start_date",
        "end_date",
        "status",
        "priority",
        "estimated_hours",
    ];




    public function users() : BelongsToMany {
        return $this->belongsToMany(User::class, 'activity_users');
    }

    public function project() : BelongsTo {
        return $this->belongsTo(Project::class);
    }
}
