<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'title',
        'description',
    ];

    public $statusEnum = [
        '0' => 'Created',
        '1' => 'In Progress',
        '2' => 'Completed',
    ];

    public function status(){
        return $this->statuses()->orderby('created_at', 'desc')->first();
    }
    public function currentStatus(){
        return $this->statusEnum[$this->status()->status];
    }

    public function statuses(){
        return $this->hasMany(StatusHistory::class);
    }
}
