<div class="tab-pane fade show active" id="salida" role="tabpanel" aria-labelledby="salida-tab">
    @if( isset($entrada->salida) )
    <div class="form-group">
        <label class="small">Transportadora</label>
        <div class="form-control"></div>
    </div>
    <div class="form-group">
        <label class="small">Rastreo</label>
        <div class="form-control"></div>
    </div>
    <div class="form-group">
        <label class="small">Confirmación</label>
        <div class="form-control"></div>
    </div>
    <div class="form-group">
        <label class="small">Cobertura</label>
        <div class="form-control"></div>
    </div>
    <div class="form-group">
        <label class="small">Status</label>
        <div class="form-control"></div>
    </div>
    <div class="form-group">
        <label class="small">Incidentes</label>
        <div class="form-control"></div>
    </div>
    <div class="form-group">
        <label class="small">Notas</label>
        <div class="border rounded-sm p-3"></div>
    </div>
    <div class="form-group">
        <label class="small">Actualizado</label>
        <div class="form-control"></div>
    </div>
    <p class="text-right">
        <a href="#1" class="btn btn-warning btn-sm">Editar salida</a>
    </p>

    @elseif( is_object($entrada->destinatario) && $entrada->hasVerificacion )
    <p class="text-center">
        <a href="#!" class="btn btn-primary btn-sm">Crear salida</a>
    </p>

    @elseif( is_object($entrada->destinatario) && !$entrada->hasVerificacion  )
    <form action="{{ route('entradas.update', $entrada) }}" method="post" autocomplete="off" class="text-center">
        @method('put')
        @csrf
        <input type="hidden" name="actualizar" value="verificacion">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="verificacion" value="yes" id="checkbox-verificacion" required>
            <label class="form-check-label" for="checkbox-verificacion">He verificado la dirección y el envio con el destinatario.</label>
        </div>
        <br>
        <button class="btn btn-success btn-sm" type="submit">Guardar verificación</button>
    </form>

    @else
    <p class="text-center">Require agregar un destinatario</p>

    @endif
</div>