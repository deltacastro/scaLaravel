<div class="input-field col s12">
    <select id="municipio_id" name="municipio_id">
        <option value="" disabled selected>Elige una opción</option>
        @foreach ($municipios as $municipio)
            <option value="{{ $municipio->id }}">{{ $municipio->nombre }}</option>
        @endforeach
    </select>
    <label>Municipio</label>
</div>