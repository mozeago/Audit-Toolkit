<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RiskRecommendation extends BaseModel
{
    use HasFactory;
    use HasUuids;
    use SoftDeletes;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = ['text', 'risk_sub_section_id', 'question_response'];
    public function riskResponse(): BelongsTo
    {
        return $this->belongsTo(RiskAnalysisResponse::class, 'risk_sub_section_id');
    }
}
