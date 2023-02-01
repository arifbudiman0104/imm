<?php

namespace App\Models;

use App\Models\Organization;
use App\Models\OrganizationPosition;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        // 'user',
        'organization',
        'organization_position'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function organization_position()
    {
        return $this->belongsTo(OrganizationPosition::class);
    }
}
