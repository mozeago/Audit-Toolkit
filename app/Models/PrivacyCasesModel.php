<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrivacyCasesModel extends Model
{
    use HasFactory;
    use HasUuids;
    protected $table = 'privacy_cases';
    protected $fillable = ['casename', 'casetitle', 'casenumber', 'caselink'];
}
