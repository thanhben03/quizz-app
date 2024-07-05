<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'desc', 'password', 'point', 'status', 'password', 'duration','user_id', 'type', 'start_time', 'end_time'];
    public $timestamps = false;

    public function questions()
    {
        return $this->hasMany(Question::class,'exam_id', 'id');
    }
}
