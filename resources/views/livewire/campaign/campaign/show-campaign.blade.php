<div>
    <x-shared.container :breadcrumbs="$breadcrumbs">
        <div class="relative overflow-hidden bg-white  dark:bg-gray-800 sm:rounded-lg">
            <div class="flex-row items-center justify-between p-4 space-y-3 sm:flex sm:space-y-0 sm:space-x-4">
                <div>
                    <h5 class="mr-3 text-lg font-bold dark:text-white">
                        @if ($campaign->codigo)
                            {{ $campaign->codigo }} -
                            <span
                                class="text-sm font-semibold text-black bg-blue-200 dark:bg-gray-700 dark:text-gray-300 px-2 py-1 rounded-full">
                                {{ $campaign->estado }}
                            </span>
                        @endif
                    </h5>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Datos de la campaña</p>
                </div>
                <div class="flex items-center space-x-3">
                    <x-shared.button-header title="Volver" route="campaign.list" />
                    <x-shared.button-header title="Editar" route="campaign.edit" :params="[$campaign->id]" />
                    @if ($campaign->estado == 'Activo')
                        <x-shared.button-header title="Activo" type='button' clickAction="toggleState" />
                    @else
                        <x-shared.button-header title="Inactivo" type='button' clickAction="toggleState" />
                    @endif
                </div>
            </div>
        </div>

        <div class="max-w px-4 py-8 mx-auto">
            <section>
                <div class="grid gap-4 mb-4 sm:grid-cols-3 sm:gap-6 sm:mb-5">
                    <x-shared.input-readonly title="Tematica" :value="$campaign->tematica" col='2' />
                    <x-shared.input-readonly title="Audiencia" :value="$campaign->audiencia" col='1' />

                    <x-shared.input-readonly title="Fecha Inicio" :value="$campaign->fecha_inicio" />
                    <x-shared.input-readonly title="Fecha Final" :value="$campaign->fecha_final" />
                    @if ($campaign->intervalo)
                        <x-shared.input-readonly title="Intervalo" :value="$campaign->invervalo" col='1' />
                    @endif
                    <x-shared.input-readonly title="Presupuesto" :value="$campaign->presupuesto" col='1' />
                    <x-shared.input-readonly title="Objetivo" :value="$campaign->objetivo" col='2' />

                    <x-shared.text-area-readonly title="Descripcion" :value="$campaign->descripcion" col='3' />
                </div>

                <div class="flex items-center justify-between mt-5">
                    <h5 class="text-lg font-bold dark:text-white uppercase">Publicaciones</h5>
                    <x-shared.button-header title="Nuevo" route="contract.new" :params="[$campaign->id]" />
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
                                        @if ($publication->estado == 'Finalizado')
                                            <span
                                                class="px-2 py-1 font-semibold leading-tight text-white bg-green-400 rounded-full dark:bg-green-500 dark:text-green-300">
                                                Finalizado
                                            </span>
                                        @elseif ($publication->estado == 'Cancelado')
                                            <span
                                                class="px-2 py-1 font-semibold leading-tight text-white bg-red-400 rounded-full dark:bg-red-500 dark:text-red-300">
                                                Cancelado
                                            </span>
                                        @else
                                            <span
                                                class="px-2 py-1 font-semibold leading-tight text-white bg-blue-400 rounded-full dark:bg-blue-500 dark:text-blue-300">
                                                En proceso
                                            </span>
                                        @endif
                                    </td>
                                    <td
                                        class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white flex items-center justify-end">
                                        <x-shared.button icon="show" route="campaign.show" color="green"
                                            type="a" :hover="600" :params="$publication->id" tonality="400" />
                                        <x-shared.button icon="edit" route="campaign.edit" color="blue"
                                            type="a" :hover="600" :params="$publication->id" />
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <nav class="px-1 py-3">
                        {{ $publications->links() }}
                    </nav>
                </div>

            </section>
        </div>
    </x-shared.container>
</div>
