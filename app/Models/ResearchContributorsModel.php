<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResearchContributorsModel extends BaseModel
{
    use HasFactory;
    use HasUuids;

    protected $keyType = 'string';
    protected $fillable = ['name', 'description', 'email'];
    protected $table = 'research_contributors';
}
