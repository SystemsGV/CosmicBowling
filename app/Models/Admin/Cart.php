<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'cart';
    protected $primaryKey = 'id_cart';

    /**
     * Obtiene todas las reservas de un cliente de forma estática.
     *
     * @param  int  $clientId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    static public function getReservationsByClient($clientId)
    {
        return self::where('client_id', $clientId)->orderByDesc('id_cart')->get();
    }
}
