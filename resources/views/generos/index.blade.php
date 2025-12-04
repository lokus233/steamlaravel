
<x-app-layout>
    <div class="w-full max-w-sm mx-auto">
        <form action="{{route('generos.index')}}" method="GET">
            <div class="flex gap-3">
            <label for="buscar" class="floating-label">
                <span>Buscar:</span>
                <input class="input"type="text" name="buscar" id="buscar"
                    value="{{$buscar}}">
            </label>
            <button class="btn btn-active" type="submit">Buscar</button>
            <a class="btn btn-ghost" href="{{route('generos.index')}}">Limpiar </a>
            </div>
        </form>
        <table class="table">
            <thead>
                <th>
                    @php
                        $sentido = $sentido == 'asc' ? 'desc' : 'asc';
                        $flecha = $sentido == 'asc' ? '↑' : '↓';
                    @endphp
                <th>
                    <a class="btn btn-ghost"
                    href="{{request()-> fullUrlWithQuery(['sentido'=>$sentido])}}">Género{{ $flecha}}</a>
                </th>
            </thead>
            <tbody>
                @foreach ($generos as $genero)
                    <tr>
                        <td>{{ $genero->genero }}</td>
                        <td>
                                <form
                                action="{{route('generos.destroy', $genero) }}"
                                method="POST"
                            >
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-square btn-ghost">🗑</button>
                        </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{$generos->links()}}
    </div>
</x-app-layout>
