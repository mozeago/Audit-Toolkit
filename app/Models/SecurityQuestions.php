<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SecurityQuestions extends BaseModel
{
    use HasFactory;
    use HasUuids;
    use SoftDeletes;
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = ['text', 'security_sub_sections_id'];
    public function belongsToSubsection()
    {
        return $this->belongsTo(SecuritySubSections::class, 'security_sub_sections_id');
    }
    public function hasOneInformation()
    {
        return $this->hasOne(SecurityInformations::class);
    }
    public function hasOneRecommendation()
    {
        return $this->hasOne(SecurityRecommendations::class);
    }
    public function recommendation()
    {
        return $this->hasOne(SecurityRecommendations::class, 'security_questions_id');
    }
}
