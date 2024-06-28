<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;

class RiskAnalysisResponse extends Model
{
    use HasFactory;
    use HasUuids;
    use SoftDeletes;
    protected $fillable = ['answer', 'user_id', 'risk_sub_section_id', 'organization', 'department'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function riskQuestion()
    {
        return $this->belongsTo(RiskSubSection::class, 'risk_sub_section_id');
    }
    public function riskRecommendation(): HasOne
    {
        return $this->hasOne(RiskRecommendation::class, 'risk_sub_section_id', 'risk_sub_section_id');
    }
}
