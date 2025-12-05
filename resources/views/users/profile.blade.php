<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pt-4">
        <table class="table">
            <thead>
                <th>Nombre</th>
                <th>Email</th>
                <th colspan="2">Acciones</th>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $usuario->name }}</td>
                    <td>{{ $usuario->email }}</td>
                    <td>
                </tr>
            </tbody>
        </table>
    </div>
</x-app-layout>
