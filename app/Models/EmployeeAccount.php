<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;


class EmployeeAccount extends Authenticatable
{
  use HasFactory, Notifiable, HasUuids;

  public function newUniqueId(): string
  {
    return (string) str()->orderedUuid();
  }

  protected $keyType = 'string';
  public $incrementing = false;
  protected $guarded = [];

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
   * Get the attributes that should be cast.
   *
   * @return array<string, string>
   */
  protected function casts(): array
  {
    return [
      'account_verified_at' => 'datetime',
      'password' => 'hashed',
    ];
  }

  public function employee()
  {
    return $this->belongsTo(Employee::class);
  }

  public function createApiToken($name = 'Manual Token', $abilities = ['*'])  
  {  
      // Generate a random token string  
      $tokenString = Str::random(60);  

      // Simpan token ke database  
      return $this->tokens()->create([  
          'tokenable_type' => Str::uuid(), 
          'tokenable_id' => Str::uuid(), 
          'token' => hash('sha256', $tokenString), // Hash token untuk keamanan  
          'name' => $name, // Anda bisa menyesuaikan nama  
          'abilities' => json_encode($abilities), // Set abilities jika diperlukan  
          'created_at' => now(),  
          'updated_at' => now(),  
      ]); 
  }  

  public function tokens()  
  {  
      return $this->morphMany(PersonalAccessToken::class, 'tokenable'); // Menggunakan relasi polymorphic  
  } 

}
