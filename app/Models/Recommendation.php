<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Information;

class Recommendation extends Model
{
    use HasFactory;
    use HasUuids;
    protected $fillable = ['content', 'information_id'];
    public function belongsToInformations()
    {
        return $this->belongsToInformations(Information::class);
    }
}
