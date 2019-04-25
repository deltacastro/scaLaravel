<div class="form-group">
    <label for="name">Nombre</label>
    <input class="form-control" name="name" type="text" value="{{ $user->name }}">
</div>
<div class="form-group">
    <label for="email">Email</label>
    <input class="form-control" name="email" type="text" value="{{ $user->email }}">
</div>
<div class="form-group">
    <label for="tipoUsuario">Nivel usuario (tipo usuario)</label>
    <input class="form-control" name="tipoUsuario" type="text" value="{{ $user->tipoUsuario }}">
</div>
<div class="form-group">
    <label for="password">Password</label>
    <input class="form-control" name="password" type="text">
</div>

<button class="btn btn-success" type="submit">Guardar</button>