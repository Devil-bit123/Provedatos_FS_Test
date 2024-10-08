<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    static $rules = [
        'nombres' => 'required|string|max:255',
        'apellidos' => 'required|string|max:255',
        'cedula' => 'required|digits:10|unique:users,cedula',
        'provincia' => 'required|numeric|exists:provincias,id',
        'fecha_nacimiento' => 'required|date_format:Y-m-d|before:today',
        'email' => 'required|email|unique:users,email',
        'observaciones' => 'nullable|string',
        'fotografia' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'fecha_ingreso' => 'required|date_format:Y-m-d|after_or_equal:today',
        'cargo' => 'required|string|max:255',
        'departamento' => 'required|string|max:100',
        'provincia_laboral' => 'required|numeric|exists:provincias,id',
        'sueldo' => 'required|numeric|min:0',
        'jornada_parcial' => 'required|boolean',
        'observaciones_laborales' => 'nullable|string',
    ];


    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'nombres',
        'apellidos',
        'cedula',
        'provincia',
        'fecha_nacimiento',
        'email',
        'observaciones',
        'fotografia',
        'fecha_ingreso',
        'cargo',
        'departamento',
        'provincia_laboral',
        'sueldo',
        'jornada_parcial',
        'observaciones_laborales',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

// En el modelo User

public function provincia()
    {
        return $this->hasOne(Provincia::class,'id','provincia');
    }

    public function provinciaLaboral()
    {
        return $this->hasOne(Provincia::class,'id','provincia_laboral');
    }


}
