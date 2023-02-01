<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationPosition extends Model
{
    use HasFactory;

    // fillable
    protected $fillable = [
        'name',
    ];

    public function organization()
    {
        return $this->hasMany(OrganizationHistory::class);
    }
}
