<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Remitente extends Model
{
    protected $fillable = array(
        'entrada_id',
        'nombre',
        'direccion',
        'codigo_postal',
        'ciudad',
        'estado',
        'pais',
        'telefono',
        'created_by_user',
        'updated_by_user',
    );

    public function getLocalidadAttribute()
    {
        $localidad = array_map(function ($attr) {

            if( isset($this->$attr) )
                return $this->$attr;
                
        }, ['ciudad','estado','pais',]);

        return implode(', ', $localidad);
    }
    
    public function creater()
    {
        return $this->belongsTo(User::class, 'created_by_user');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by_user');
    }
}
