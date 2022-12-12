@bind($user)
<x-form-input name="name" id="name" label="Nombre completo" required autofocus>
    @slot('prepend')
    <i class="fas fa-user"></i>
    @endslot
</x-form-input>
<x-form-input type="email" name="email" id="email" label="Correo electrónico" required>
    @slot('prepend')
    <i class="fas fa-at"></i>
    @endslot
</x-form-input>
<x-form-input type="password" name="password" id="password" label="Contraseña de acceso" :bind="false">
    @slot('prepend')
    <i class="fas fa-lock"></i>
    @endslot
</x-form-input>
<x-form-input type="password" name="password_confirmation" id="password_confirmation" label="Repetir contraseña de acceso">
    @slot('prepend')
    <i class="fas fa-lock"></i>
    @endslot
</x-form-input>
<x-form-select name="role" id="role" label="Selecciona el perfil del usuario">
    @foreach ($roles as $role)
        <option>{{ $role }}</option>
    @endforeach
</x-form-select>
@endbind