<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
  use HasApiTokens, Notifiable, HasRoles;

  protected $table = 'admins';
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'name', 'email', 'password', 'active'
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'password', 'remember_token',
  ];

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  // Attribute
  public function getRoleNamesAttribute()
  {
    $roleName = '';
    $roles = $this->roles->pluck('display_name');
    foreach($roles as $role) {
      $roleName = ($roleName == '' ? '' : $roleName . ', ') . $role;
    }
    return $roleName;
  }
}
