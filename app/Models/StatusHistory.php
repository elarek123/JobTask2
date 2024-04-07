<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusHistory extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = ['id'];

    public function task(){
        return $this->belongsTo(Task::class);
    }
}
