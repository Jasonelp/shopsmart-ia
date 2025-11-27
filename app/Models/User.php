<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',     // Agregado para soportar roles
        'address',  // Agregado por si guardas dirección
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // --- NUEVAS FUNCIONES PARA TU PROYECTO ---

    // Relación: Un usuario tiene muchas órdenes
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // Helpers para verificar rol rápidamente en las vistas
    public function isAdmin() {
        return $this->role === 'admin';
    }

    public function isSeller() {
        return $this->role === 'vendedor'; // Asegúrate que en BD guardas 'vendedor'
    }
}