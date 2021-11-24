<form method="post" action="{{ route('estudiante.store') }}">
    @csrf
    <input type="number" name="documento" />
    <input type="text" name="nombre" />
    <input type="text" name="email" />
    <input type="number" name="celular" />
    <button type="submit">Enviar</button>
    <input type="submit" value="Enviar 2" />
</form>