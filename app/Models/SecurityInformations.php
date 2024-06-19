<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SecurityInformations extends Model
{
    use HasFactory;
    use HasUuids;
    use SoftDeletes;
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = ['name', 'security_questions_id'];
    public function securityQuestion()
    {
        return $this->belongsTo(SecurityQuestions::class, 'security_sub_sections_id');
    }
}
