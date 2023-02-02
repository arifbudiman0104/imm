<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationField extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function organization_histories()
    {
        return $this->hasMany(OrganizationHistory::class);
    }
}
