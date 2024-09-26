<?php

namespace App\Models\Admin;

use App\Models\Frontend\Client;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'cart';
    protected $primaryKey = 'id_cart';

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function subcategory()
    {
        return $this->belongsTo(SubCategories::class, 'subcategory_id');
    }

    public function coupon()
    {
        return $this->belongsTo(Coupons::class, 'coupon_id');
    }

    public static function getAllBooking($startDate, $endDate, $column)
    {
        $query = self::query();

        if ($column === 'entrance') {
            if ($startDate && $endDate) {
                $query->whereBetween('date_reserved', [$startDate, $endDate]);
            }
        } elseif ($column === 'shop') {
            if ($startDate && $endDate) {
                $query->whereBetween('created_at', [$startDate, $endDate]);
            }
        }

        $booking = $query->orderByDesc('created_at')->get();

        $data = [];

        foreach ($booking as $row) {
            // Obtener el nmbre completo del cliente
            $clientFullName = trim(
                optional($row->client)->lastname_pat . ' ' .
                    optional($row->client)->lastname_mat . ' ' .
                    optional($row->client)->names_client
            );

            $createdAtLocal = Carbon::parse($row->created_at)->timezone('America/Lima')->format('d-m-Y H:i:s');
            $dateReserved = Carbon::parse($row->date_reserved)->format('d-m-Y');

            $data[] = [
                'id' => $row->id_cart,
                'code' => $row->reservation_code,
                'client' => $clientFullName,
                'coupon' => optional($row->coupon)->code,
                'description' => $row->description,
                'guests' => $row->quantity_guests,
                'price' => $row->amount,
                'shop' => $createdAtLocal,
                'date' => $dateReserved,
                'hour' => $row->hour_init,
                'status' => $row->status,
            ];
        }

        return $data;
    }

    public static function getBooking($code)
    {
        $data = self::where('reservation_code', $code)->first();

        // Verificamos que exista un registro antes de continuar
        if (!$data) {
            return null; // O manejar el error según sea necesario
        }

        // Obtener la fecha y hora en formato deseado
        $dateReserved = $data->date_reserved; // "2024-09-21"
        $hourInit = $data->hour_init;         // "20:00:00"
        $combinedDateTime = $dateReserved . ' ' . $hourInit;
        $formattedDate = date('d/m/Y h:i A', strtotime($combinedDateTime));

        // Preparar el resultado
        $result = [
            'id' => $data->id_cart,
            'code' => $data->reservation_code,
            'subcategory' => optional($data->subcategory)->name_subcategory,
            'client' => optional($data->client)->lastname_pat . " " . optional($data->client)->lastname_mat . " " . optional($data->client)->names_client,
            'typeDoc' => optional($data->client->sunatTypedoc)->name_doc, // Accedemos al tipo de documento desde sunat_typedoc
            'numberDoc' => optional($data->client)->number_doc,
            'coupon' => $data->coupon ? $data->coupon->code : null,
            'description' => $data->description,
            'quantity' => $data->quantity_lane,
            'guests' => $data->quantity_guests,
            'hours' => $data->quantity_hours,
            'price' => $data->amount,
            'shop' =>  $formattedDate,
            'status' => $data->status,
        ];

        return $result;
    }
}
