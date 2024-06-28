<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class RiskSubSection extends BaseModel
{
    use HasFactory;
    use HasUuids;
    use SoftDeletes;
    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = ['text', 'risk_section_id', 'subtitle'];
    public function belongsToRiskSection()
    {
        return $this->belongsTo(RiskSection::class);
    }
    public function riskInformation(): HasOne
    {
        return $this->hasOne(RiskInformation::class, 'risk_sub_section_id');
    }
    public function riskRecommendation(): HasOne
    {
        return $this->hasOne(RiskRecommendation::class, 'risk_sub_section_id');
    }
    public function riskAnalysysResponse(): HasMany
    {
        return $this->hasMany(RiskAnalysisResponse::class, 'risk_sub_section_id');
    }
}
