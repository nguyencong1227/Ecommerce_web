<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
  use Notifiable;
  public $table = "nguoidung";

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
      'Ten', 'DiaChi', 'SDT', 'VaiTro', 'HoatDong', 'password', 'email', 'remember_token', 'NgayTao', 'NgayCN', 'NgayXoa'
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
      'email_verified_at' => 'datetime'
  ];

  public static $role = [
        0 => 'Khách hàng',
        1 => 'Quản trị viên',
        2 => 'Nhân viên kho',
        3 => 'Nhân viên giao hàng',
    ];

  public $timestamps = false;
}
