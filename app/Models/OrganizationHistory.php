<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'organization_id',
        'organization_position_id',
        'start_year',
        'end_year'
    ];

    protected $with = [
        'user',
        'organization',
        'organizationPosition'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function organizationPosition()
    {
        return $this->belongsTo(OrganizationPosition::class);
    }
}
