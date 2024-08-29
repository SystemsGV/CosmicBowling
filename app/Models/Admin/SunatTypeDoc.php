<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SunatTypeDoc extends Model
{
    use HasFactory;
    protected $table = 'sunat_typedoc';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $primaryKey = 'id_doc';
    public $timestamps = true;
    protected $fillable = [
        'id_doc',
        'name_doc',
        'description_doc'
    ];
}
