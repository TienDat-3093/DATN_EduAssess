<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tests extends Model
{
    use HasFactory;
    protected $table = 'tests';
    use SoftDeletes;
    protected $fillable = [
        'question_data',
        'name',
        'password',
        'topic_data',
        'tag_data',
        'done_count',
        'privacy',
        'deleted_at',
        'created_at',
        'updated_at',
        'user_id',
    ];
    public function user()
    {
        return $this->belongsTo(Users::class);
    }
}
