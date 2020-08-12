<div class="input-field col s12">
    <select id="sucursal_id" name="sucursal_id">
        <option value="" disabled selected>Elige una opción</option>
        @foreach ($sucursales as $sucursal)
            <option value="{{ $sucursal->id }}">{{ $sucursal->nombre }}</option>
        @endforeach
    </select>
    <label>Sucursal</label>
</div>