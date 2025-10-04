<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\URL;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
  /** @use HasFactory<\Database\Factories\UserFactory> */
  use HasFactory, Notifiable;
  use HasRoles;
  use HasApiTokens;

  /**
   * The attributes that are mass assignable.
   *
   * @var list<string>
   */
  protected $fillable = [
    'name',
    'email',
    'password',
    'username',
    'image_url',
    'blocked',
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var list<string>
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * Get the attributes that should be cast.
   *
   * @return array<string, string>
   */
  protected function casts(): array
  {
    return [
      'email_verified_at' => 'datetime',
      'password' => 'hashed',
    ];
  }

  public function sendEmailVerificationNotification()
  {
    $this->notify(new \App\Notifications\VerifyEmailNotification($this->verificationUrl()));
  }

  protected function verificationUrl()
  {
    return URL::temporarySignedRoute(
      'verification.verify',
      now()->addMinutes(60),
      ['id' => $this->getKey(), 'hash' => sha1($this->getEmailForVerification())]
    );
  }

  public function sendPasswordResetNotification($token)
  {
    $this->notify(new \App\Notifications\ResetPasswordNotification($token));
  }

}
