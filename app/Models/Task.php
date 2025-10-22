<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
class Task extends Model
{
    use HasFactory,HasUlids;

     protected $fillable = ['project_id', 'name', 'priority'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
