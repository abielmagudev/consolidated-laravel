<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Ahex\Zkeleton\Domain\ModifiersTrait as Modifiers;

class Incidente extends Model
{
    use HasFactory, Modifiers;

    protected $fillable = [
        'nombre',
        'descripcion',
        'created_by',
        'updated_by',
    ];

    public static function prepare($validated)
    {
        $prepared = [
            'nombre' => $validated['nombre'],
            'descripcion' => $validated['descripcion'] ?? null,
            'updated_by' => mt_rand(1,10),
        ];

        if( request()->isMethod('post') )
            $prepared['created_by'] = $prepared['updated_by'];

        return $prepared;
    }
}
