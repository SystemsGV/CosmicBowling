<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Http\Controllers\Frontend\Client;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;


class ClientSocio extends Model
{
    use HasFactory;

    protected $table = 'client_socio';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'client_id',
        'nTarjNumb',
        'cTarjActi',
        'dEmisDate',
        'dCaduDate',
        'validado',
        'affiliation',
        'status_magic',
        'user_new',
        'user_renew',
    ];

    // Relación con Client
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'id_client');
    }

    // Acceso directo al tipo de doc a través de client
    public function getTipoDocAttribute()
    {
        return optional($this->client)->sunatTypedoc;
    }
}
