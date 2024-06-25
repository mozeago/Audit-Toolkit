<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Information;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recommendation extends Model
{
    use HasFactory;
    use HasUuids;
    use SoftDeletes;
    protected $fillable = ['content', 'information_id', 'question_id', 'question_response'];
    public function belongsToInformations()
    {
        return $this->belongsToInformations(Information::class);
    }
    protected $table = 'recommendations';

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }
    public function response()
    {
        return $this->belongsTo(UserResponse::class, 'question_id');
    }
    public function userResponse(): BelongsTo
    {
        return $this->belongsTo(UserResponse::class);
    }
}
