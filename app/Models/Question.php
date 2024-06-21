<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends BaseModel
{
    use HasFactory;
    use HasUuids;
    use SoftDeletes;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = ['text', 'control_id'];

    protected $table = 'questions';

    public function belongsToControl(): BelongsTo
    {
        return $this->belongsTo(Control::class, 'control_id');
    }
    public function hasOneInformation(): HasOne
    {
        return $this->hasOne(Information::class);
    }
    public function recommendation()
    {
        return $this->hasOne(Recommendation::class, 'question_id');
    }

    public function responses()
    {
        return $this->hasMany(UserResponse::class, 'question_id');
    }
}
