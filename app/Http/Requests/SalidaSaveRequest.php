<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SalidaSaveRequest extends FormRequest
{
    private $coberturas;
    private $status;

    protected function prepareForValidation()
    {
        $this->coberturas = array_keys( config('system.salidas.cobertura') );
        $this->status = array_keys( config('system.salidas.status') );
    }

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $salida_id = $this->route('salida')->id ?? 0;

        return [
            'transportadora' => ['required','exists:transportadoras,id'],
            'rastreo'        => ['nullable','unique:salidas,rastreo,' . $salida_id],
            'confirmacion'   => ['nullable','unique:salidas,confirmacion,' . $salida_id],
            'cobertura'      => ['required','in:'.implode(',',$this->coberturas)],
            'direccion'      => ['nullable','required_if:cobertura,ocurre'],
            'postal'         => ['nullable','required_if:cobertura,ocurre'],
            'ciudad'         => ['nullable','required_if:cobertura,ocurre'],
            'estado'         => ['nullable','required_if:cobertura,ocurre'],
            'pais'           => ['nullable','required_if:cobertura,ocurre'],
            'status'         => ['required','in:'.implode(',',$this->status)],
            'incidentes'     => ['nullable','array'],
            'notas'          => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'transportadora.required' => __('Selecciona la transportadora'),
            'transportadora.exists' => __('Selecciona una transportadora válida'),
            'rastreo.unique'        => __('Escribe un código de rastreo diferente'),
            'confirmacion.unique'   => __('Escribe un códifo de confirmación diferente'),
            'cobertura.required'    => __('Selecciona el tipo de cobertura'),
            'cobertura.in'          => __('Selecciona un tipo válido de cobertura'),
            'direccion.required_if' => __('Escribe la dirección de ocurre'),
            'postal.required_if'    => __('Escribe la postal de ocurre'),
            'ciudad.required_if'    => __('Escribe la ciudad de ocurre'),
            'estado.required_if'    => __('Escribe el estado de ocurre'),
            'pais.required_if'      => __('Escribe el pais de ocurre'),
            'status.required'       => __('Selecciona el tipo de status'),
            'status.in'             => __('Selecciona un tipo válido de status'),
            'incidentes.array'      => __('Desactiva o selecciona incidentes válidos'),
        ];
    }
}
