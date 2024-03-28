<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends BaseModel
{
    use HasFactory;
    use HasUuids;
    use SoftDeletes;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = ['text', 'control_id'];

    public function belongsToControl()
    {
        return $this->belongsTo(Control::class);
    }
    public function hasOneInformation()
    {
        return $this->hasOne(Information::class);
    }
}
