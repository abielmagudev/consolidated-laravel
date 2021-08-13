<h6>Formato</h6>
<div class="mb-3 row">
   <div class="col-sm">
      <?php $formato_ancho = $guia->formato->ancho ?? null ?>
      <label class="form-label small" for="input-formato-ancho">Ancho</label>
      <input type="number" min="0.01" step="0.01" id="input-formato-ancho" class="form-control" name="formato[ancho]" value="{{ old('formato.ancho', $formato_ancho) }}">
   </div>
   <div class="col-sm">
      <?php $formato_altura = $guia->formato->altura ?? null ?>
      <label class="form-label small" for="input-formato-altura">Altura</label>
      <input type="number" min="0.01" step="0.01" id="input-formato-altura" class="form-control" name="formato[altura]" value="{{ old('formato.altura', $formato_altura) }}">
   </div>
   <div class="col-sm">
      <?php $formato_medicion = $guia->formato->medicion ?? null ?>
      <label class="form-label small" for="select-formato-medicion">Medición</label>
      <select id="select-formato-medicion" class="form-select" name="formato[medicion]">
         @foreach ($mediciones['area'] as $value => $tag)
         <option value="{{ $value }}" {{ toggleSelected($value, old('formato.medicion', $formato_medicion)) }}>{{ ucfirst($tag) }}</option>
         @endforeach
      </select>
   </div>
</div>
<br>