<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use App\Models\Post;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    // public function setDobAttribute($value)
    // {
    //     $this->attributes['dob'] = Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d');
    // }
    // make dob attribute to be a date with format dd mm yyyy

    protected $fillable = [
        'organization_id',
        'name',
        'username',
        'email',
        'hide_email',
        'password',
        'pob',
        'dob',
        'sid',
        'university',
        'faculty',
        'program_study',
        'gender',
        'phone',
        'address',
        'bio',
        'instagram',
        'facebook',
        'twitter',
        'youtube',
    ];

    protected $with = [
        // 'posts',
        // 'organizationHistory',
        // 'organization',
    ];

    protected $date = [
        'dob',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function organization_history()
    {
        return $this->hasMany(OrganizationHistory::class);
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
}
