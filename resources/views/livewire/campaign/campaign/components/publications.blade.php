<div>
    <div class="flex items-center justify-between mt-5">
        <h5 class="text-lg font-bold dark:text-white uppercase">Publicaciones</h5>
        <x-shared.button-header title="Nuevo" route="publication.new" :params="[$campaign->id]" />
    </div>

    <div class="overflow-x-auto p-4  ">
        <table class="w-full text-sm text-left">
            <thead class="text-md text-white uppercase bg-fondo dark:bg-gray-700 dark:text-gray-300">
                <tr>
                    <th scope="col" class="px-4 py-3">Codigo</th>
                    <th scope="col" class="px-4 py-3">Titulo</th>
                    <th scope="col" class="px-4 py-3">Contenido</th>
                    <th scope="col" class="px-4 py-3">Fechas</th>
                    <th scope="col" class="px-4 py-3">Estado</th>
                    <th scope="col" class="px-4 py-3">
                        <span class="sr-only">Actions</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($publications as $publication)
                    <tr
                        class="border-b dark:border-gray-700 @if ($loop->even) bg-gray-100 dark:bg-gray-800 @endif">
                        <th scope="row"
                            class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $publication->codigo }}
                        </th>
                        <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $publication->titulo }}</td>
                        <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ strlen($publication->contenido) > 40
                                ? substr($publication->contenido, 0, 40) . '...'
                                : $publication->contenido }}
                        </td>
                        <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ \Carbon\Carbon::parse($publication->fecha_inicio)->format('d/m/Y') . ' a ' . \Carbon\Carbon::parse($publication->fecha_final)->format('d/m/Y') }}
                        </td>
                        <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            @if ($publication->estado == 'Aceptado')
                                <x-shared.badge color="green" message="Aceptado" />
                            @elseif ($publication->estado == 'Borrador')
                                <x-shared.badge color="pink" message="Borrador" />
                            @elseif ($publication->estado == 'Rechazado')
                                <x-shared.badge color="red" message="Rechazado" />
                            @else
                                <x-shared.badge color="blue" message="Pendiente" />
                            @endif
                        </td>
                        <td
                            class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white flex items-center justify-end">
                            <x-shared.button icon="show" route="publication.show" color="green" type="a"
                                :hover="600" :params="$publication->id" tonality="400" />
                            <x-shared.button icon="edit" route="publication.edit" color="blue" type="a"
                                :hover="600" :params="$publication->id" />
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <nav class="px-1 py-3">
            {{ $publications->links() }}
        </nav>
    </div>

</div>
