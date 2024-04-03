<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\RiskSubSection;

class RiskSection extends BaseModel
{
    use HasFactory;
    use HasUuids;
    use SoftDeletes;
    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = ['name'];
    public function hasManySubSections()
    {
        return $this->hasMany(RiskSubSection::class);
    }
}
