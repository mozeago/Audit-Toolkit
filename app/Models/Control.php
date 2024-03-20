<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Control extends BaseModel
{
    use HasFactory;
    use HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = ['name'];

    public function belongsToSection()
    {
        return $this->belongsTo(Section::class);
    }
    public function hasManyQuestions()
    {
        return $this->hasMany(Question::class);
    }
}
