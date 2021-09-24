<?php

namespace App;

use App\Ahex\Fake\Domain\Fakeuser;
use App\Ahex\Salida\Domain\AttributesTrait as Attributes;
use App\Ahex\Salida\Domain\RelationshipsTrait as Relationships;
use App\Ahex\Salida\Domain\ScopesTrait as Scopes;
use App\Ahex\Salida\Domain\ValidationsTrait as Validations;
use App\Ahex\Salida\Domain\UpdatesDescriptionsTrait as UpdatesDescriptions;
use App\Ahex\Zkeleton\Domain\UpdateDescriptionCallableTrait as UpdateDescriptionCallable;
use App\Ahex\Zkeleton\Domain\ModifiersTrait as Modifiers;
use App\Ahex\GuiaImpresion\Application\ModelAttributesPrintableInterface as ModelAttributesPrintable;
use Illuminate\Database\Eloquent\Model;

class Salida extends Model implements ModelAttributesPrintable
{
    use Attributes, 
        Relationships, 
        Scopes, 
        Validations,
        UpdateDescriptionCallable, 
        UpdatesDescriptions, 
        Modifiers;
    
    protected $fillable = [
        'rastreo',
        'confirmacion',
        'cobertura',
        'direccion',
        'postal',
        'ciudad',
        'estado',
        'pais',
        'notas',
        'status',
        'transportadora_id',
        'entrada_id',
        'created_by',
        'updated_by',
    ];

    public static $all_status = [
        'en espera' => [
            'color' => '#0E6FFD',
            'descripcion' => 'Recopilando información para el envio',
        ],
        'en ruta' => [
            'color' => '#FFC108',
            'descripcion' => 'Envio en proceso hacia su destino',
        ],
        'arribo' => [
            'color' => '#198754',
            'descripcion' => 'Finalizo en el envio a su destino',
        ],
        'entregado' => [
            'color' => '#212529',
            'descripcion' => 'Paquete recibido por el destinatario',
        ],
    ];

    public static $all_coberturas = [
        'domicilio' => [
            'descripcion' => 'Dirección del destinatario',
        ],
        'ocurre'    => [
            'descripcion' => 'Dirección de la transportadora',
        ],
    ];

    public static function prepare($validated)
    {
        $prepared = [
            'rastreo'      => $validated['rastreo'] ?? null,
            'confirmacion' => $validated['confirmacion'] ?? null,
            'cobertura'    => $validated['cobertura'],
            'direccion'    => isset($validated['direccion']) ? capitalize($validated['direccion']) : null,
            'postal'       => $validated['postal'] ?? null,
            'ciudad'       => isset($validated['ciudad']) ? capitalize($validated['ciudad']) : null,
            'estado'       => isset($validated['estado']) ? capitalize($validated['estado']) : null,
            'pais'         => $validated['pais'] ?? null,
            'notas'        => $validated['notas'] ?? null,
            'status'       => $validated['status'] ?? array_key_first( static::getAllStatus() ),
            'transportadora_id' => $validated['transportadora'] ?? null,
            'updated_by'   => Fakeuser::live(),
        ];

        if( request()->isMethod('post') )
        {
            $prepared = array_merge($prepared, [
                'entrada_id' => $validated['entrada'],
                'created_by' => Fakeuser::live(),
            ]);
        }

        return $prepared;
    }

    public static function attributesToPrint(): array
    {
        return [
            'rastreo' => 'Rastreo',
            'confirmacion' => 'Confirmación',
            'cobertura' => 'Cobertura',
            'direccion' => 'Dirección',
            'postal' => 'Postal',
            'ciudad' => 'Ciudad',
            'estado' => 'Estado',
            'pais' => 'Pais',
            'notas' => 'Notas',
        ];
    }
}
