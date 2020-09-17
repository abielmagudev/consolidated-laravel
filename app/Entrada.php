<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entrada extends Model
{
    protected $fillable = array(
        
        // Entrada
        'numero',
        'consolidado_id',
        'cliente_id',
        'cliente_alias_numero',

        // Trayectoria
        'destinatario_id',
        'remitente_id',

        // Cruce
        'vehiculo_id',
        'conductor_id',
        'vuelta',
        'cruce_fecha',
        'cruce_hora',

        // Reempaque
        'codigor_id',
        'reempacador_id',
        'reempacado_fecha',
        'reempacado_hora',

        // Verificacion
        'verificado_at',
        'verificado_by_user',

        // Log
        'created_by_user',
        'updated_by_user',
    );



    // Entrada

    public function consolidado()
    {
        return $this->belongsTo(Consolidado::class);
    }
    
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function medidas()
    {
        return $this->hasMany(Medida::class);
    }

    public function observaciones()
    {
        return $this->hasMany(Observacion::class);
    }



    // Trayectoria

    public function remitente()
    {
        return $this->belongsTo(Remitente::class);
    }

    public function destinatario()
    {
        return $this->belongsTo(Destinatario::class);
    }



    // Cruce

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class);
    }

    public function conductor()
    {
        return $this->belongsTo(Conductor::class);
    }



    // Reempaque

    public function codigor()
    {
        return $this->belongsTo(Codigor::class);
    }

    public function reempacador()
    {
        return $this->belongsTo(Reempacador::class);
    }



    // Verificacion

    public function verificador()
    {
        return $this->belongsTo(User::class, 'verificado_by_user');
    }



    // Log

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by_user');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by_user');
    }



    // Atributos

    public function getAliasNumeroAttribute()
    {
        if( $this->cliente_alias_numero )
            return $this->cliente->alias . $this->numero;
        
        return;
    }

    public function getCruceHorarioAttribute()
    {
        if( is_null($this->cruce_fecha) && is_null($this->cruce_hora) )
            return '';

        return date('h:i a', strtotime($this->cruce_hora)) . ', ' . date('d M,Y', strtotime($this->cruce_fecha));
    }

    public function getReempacadoHorarioAttribute()
    {
        if( is_null($this->reempacado_fecha) && is_null($this->reempacado_hora) )
            return '';

        return date('h:i a', strtotime($this->reempacado_hora)) . ', ' . date('d M,Y', strtotime($this->reempacado_fecha));
    }

    public function getHasVerificacionAttribute()
    {
        return is_string($this->verificado_at) && is_integer($this->verificado_by_user);
    }


    // Scopes
    
    public function scopeWithMedidas($query)
    {
        return $query->with([
            'medidas.medidor',
            'medidas.updater',
        ]);
    }

    public function scopeWithObservaciones($query)
    {
        return $query->with([
            'observaciones.creator',
        ]);
    }
}
