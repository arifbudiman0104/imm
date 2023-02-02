<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function organization_histories()
    {
        return $this->hasMany(OrganizationHistory::class);
    }
}
