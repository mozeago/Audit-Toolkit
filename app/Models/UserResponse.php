<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserResponse extends BaseModel
{
    use HasFactory;
    use HasUuids;
    use SoftDeletes;

    protected $table = 'user_responses';
    protected $fillable = ['answer', 'user_id', 'question_id', 'organization', 'department'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }
    public function recommendation(): HasOne
    {
        return $this->hasOne(Recommendation::class, 'question_id', 'question_id');
    }
}
