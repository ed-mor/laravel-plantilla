<?php

namespace App\Models;

use App\Models\Account;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasRoles;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use SoftDeletes;

    /**
     * Atributos con asignación masiva.
     */
    protected $fillable = [
        'name',
        'account_id',
        'email',
        'status',
        'password',
    ];

    /**
     * Valores predeterminados de los Atributos.
     */
    protected $attributes = [
        'account_id' => 1,
        'status' => false,
    ];

    /**
     * Para Setear el password
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::needsRehash($password) ? Hash::make($password) : $password;
    }

    /**
     * Para la foto del Usuario
     */
    public function photoUrl(array $attributes)
    {
        if ($this->photo_path) {
            return URL::to(App::make(Server::class)->fromPath($this->photo_path, $attributes));
        }
    }

    /**
     * Para ordenar por nombre
     */
    public function scopeOrderByName($query)
    {
        $query->orderBy('name');
    }

    /**
     * Para ordenar por status
     */
    public function scopeOrderByStatus($query)
    {
        $query->orderBy('status', 'DESC');
    }

    /**
     * Para filtrar por status
     */
    public function scopeWhereStatus($query, $status)
    {
        switch ($status) {
            case 'Activo': return $query->where('status', true);
            case 'Inactivo': return $query->where('status', false);
        }
    }

    /**
     * Los atributos que deben ser OCULTOS.
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * Para Filtrar los Usuarios
     */
    public function scopeFilter($query, array $filters)
    {
        $query

        ->when($filters['buscar'] ?? null, function ($query, $buscar) {
            $query->where(function ($query) use ($buscar) {
                $query->where('name', 'like', '%'.$buscar.'%')
                    //->orWhere('last_name', 'like', '%'.$buscar.'%')
                    ->orWhere('email', 'like', '%'.$buscar.'%');
            });

        })->when($filters['status'] ?? null, function ($query, $status) {
            $query->where('status', $status);

        })->when($filters['eliminados'] ?? null, function ($query, $eliminados) {
            if ($eliminados === 'with') {
                $query->withTrashed();
            } elseif ($eliminados === 'only') {
                $query->onlyTrashed();
            }
        });
        //dd($filters);
    }


    /**
     * Los atributos que se deben convertir a tipos nativos.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'status' => 'boolean'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

}
