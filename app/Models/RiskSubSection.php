<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
    public function hasManyRiskInformation()
    {
        return $this->hasMany(RiskInformation::class);
    }
}
