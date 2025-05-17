<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Base class for authenticatable users
use Illuminate\Auth\Authenticatable as AuthenticatableTrait; // Trait for authentication methods
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract; // Interface for auth contract

class Admin extends Authenticatable implements AuthenticatableContract
{
    use AuthenticatableTrait; // Provides methods like getAuthIdentifier and getAuthPassword

    protected $fillable = ['username', 'password']; // Fields that can be mass-assigned
    protected $hidden = ['password']; // Hide password field for security
}