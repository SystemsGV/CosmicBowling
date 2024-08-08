<?php

namespace App\Models\Frontend;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class Client extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $primaryKey = 'id_client';
    protected $fillable = [
        'document_id', 'number_doc', 'lastname_pat', 'lastname_mat', 'names_client', 'email_client', 'phone_client', 'birthday_client', 'address_client','password_client'
    ];

    protected $hidden = [
        'password_client', 'remember_token'
    ];

    public function findForPassport($username)
    {
        return $this->where('number_doc', $username)->first();
    }

    public function validateForPassportPasswordGrant($password)
    {
        return Hash::check($password, $this->password_client);
    }
}
