<!-- Modal -->
<div class="modal fade" id="entradaComentariosModal" tabindex="-1" aria-labelledby="entradaComentariosModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header border-0 m-0">
        <p class="modal-title d-none" id="entradaComentariosModalLabel">{{ $entrada->alias_numero ?? $entrada->numero }}</p>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="card-header bg-transparent">
        <ul class="nav nav-tabs nav-fill card-header-tabs" id="tabsComentarios" role="tablist">
          <li class="nav-item" role="presentation">
            <a class="nav-link {{ $comentarios->count() > 0 ? 'active' : 'disabled' }}" id="comentarios-tab" data-toggle="tab" href="#comentarios" role="tab" aria-controls="comentarios" aria-selected="true">Comentarios</a>
          </li>
          <li class="nav-item" role="presentation">
            <a class="nav-link {{ $comentarios->count() == 0 ? 'active' : '' }}" id="nueva-observacion-tab" data-toggle="tab" href="#nuevo-comentario" role="tab" aria-controls="nuevo-comentario" aria-selected="false">Nuevo comentario</a>
          </li>
        </ul>
      </div>

      <div class="modal-body">
        <div class="tab-content" id="tabsContentComentarios">

          <!-- Lista de comentarios -->
          <div class="tab-pane fade {{ $comentarios->count() > 0 ? 'show active' : '' }}" id="comentarios" role="tabpanel" aria-labelledby="comentarios-tab">
            <ul class="list-group list-group-flush">
                @foreach($comentarios as $comentario)
                <li class="list-group-item">
                    <div class="text-muted small">
                      <div class="float-right">{{ $comentario->created_at }}</div>
                      <div class="float-left">{{ $comentario->creator->name ?? 'Desconocido' }}</div>
                    </div>
                    <br>
                    <p class="text-monospace small">{{ $comentario->contenido }}</p>
                </li>
                @endforeach
            </ul>
          </div>
          
          <!-- Nuevo comentario -->
          <div class="tab-pane fade {{ $comentarios->count() == 0 ? 'show active' : '' }}" id="nuevo-comentario" role="tabpanel" aria-labelledby="nuevo-comentario-tab">
            <form action="{{ route('comentarios.store', $entrada) }}" method="post" atuocomplete="off" class="mt-3">
                @csrf
                <div class="form-group">
                    <label for="textarea-contenido" class="">
                      <small>Escribe el comentario</small>
                    </label>
                    <textarea name="contenido" id="textarea-contenido" cols="30" rows="5" class="form-control" required></textarea>
                </div>
                <button class="btn btn-success btn-block" type="submit">Guardar comentario</button>
            </form>
          </div>
        </div>
      </div>

      <div class="modal-footer d-none">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>