<x-app-layout>
<x-errores />

    <form action="/videojuegos/{{ $videojuego->id }}" method="POST">
        @method('PUT')
        @csrf

        <label for="nombre">Nombre:* </label>
        <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $videojuego->nombre) }}"><br>

        <label for="precio">Precio:* </label>
        <input type="text" id="precio" name="precio" value="{{ old('precio', $videojuego->precio) }}"><br>

        <label for="lanzamiento">Lanzamiento: </label>
        <input type="text" id="lanzamiento" name="lanzamiento" value="{{ old('lanzamiento', $videojuego->lanzamiento) }}"><br>

        <label for="desarrolladora_id">ID_Desarrolladora: </label>
        <input type="text" id="desarrolladora_id" name="desarrolladora_id" value="{{ old('desarrolladora_id', $videojuego->desarrolladora_id) }}"><br>

        <button type="submit">Modificar</button>
    </form>
</x-app-layout>
