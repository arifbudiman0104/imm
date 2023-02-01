<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    // fillable
    protected $fillable = [
        'name',
        'description',
    ];

    public function organization()
    {
        return $this->hasMany(OrganizationHistory::class);
    }


}
