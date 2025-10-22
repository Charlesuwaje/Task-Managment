<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class Project extends Model
{
    use HasFactory, HasUlids;

     protected $fillable = ['name'];

    public function tasks()
    {
        return $this->hasMany(Task::class)->orderBy('priority');
    }
}
