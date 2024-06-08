<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuestionsAdmin extends Model
{
    use HasFactory;
    protected $table = 'question_admins';
    use SoftDeletes;

    public function user()
    {
        return $this->belongsTo(Users::class);
    }
    public function level()
    {
        return $this->belongsTo(Levels::class);
    }
    public function topic()
    {
        return $this->belongsTo(Topics::class);
    }
    public function question_type()
    {
        return $this->belongsTo(QuestionTypes::class);
    }
}
