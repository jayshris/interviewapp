<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InterviewsAnswer extends Model
{
    protected $fillable = [
        'interview_id',
        'user_id',
        'answer_audio_file' 
    ];
}
