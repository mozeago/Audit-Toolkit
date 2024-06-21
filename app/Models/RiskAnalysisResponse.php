<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
    public function riskquestion()
    {
        return $this->belongsTo(RiskSubSection::class, 'risk_sub_section_id');
    }
}
