<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\RiskSubSection;
use App\Models\RiskRecommendation;
use Illuminate\Database\Eloquent\SoftDeletes;

class RiskInformation extends Model
{
    use HasFactory;
    use HasUuids;
    use SoftDeletes;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = ['text', 'risk_sub_section_id'];
    public function belongsToRiskSubSection()
    {
        return $this->belongsTo(RiskSubSection::class);
    }
    public function hasManyRiskRecommendation()
    {
        return $this->hasMany(RiskRecommendation::class);
    }
}
