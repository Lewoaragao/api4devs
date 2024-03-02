<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @OA\Schema(
 *  schema="User",
 *  type="object",
 *  description="Schema of Model User",
 *  @OA\Property(
 *      property="id",
 *      type="integer",
 *      description="Identification of User",
 *      example=1
 *  ),
 *  @OA\Property(
 *      property="name",
 *      type="string",
 *      description="Name of User",
 *      example="John Doe"
 *  ),
 *  @OA\Property(
 *      property="email",
 *      type="string",
 *      description="Email of User",
 *      example="john@doe.com"
 *  )
 * )
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}