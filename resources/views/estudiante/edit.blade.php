<form method="post" action="{{ route('estudiante.update',['estudiante'=>$estudiante->id]) }}">
    @csrf
    {{ method_field('PUT') }}
    <input type="number" name="documento" value="{{ $estudiante->documento }}"/>
    <input type="text" name="nombre"  value="{{ $estudiante->nombre }}"/>
    <input type="text" name="email"  value="{{ $estudiante->email }}"/>
    <input type="number" name="celular"  value="{{ $estudiante->celular }}"/>
    <button type="submit">Enviar</button>
    <input type="submit" value="Enviar 2" />
</form>