<div>
    <x-shared.container :breadcrumbs="$breadcrumbs">
        <div class="relative overflow-hidden bg-white  dark:bg-gray-800 sm:rounded-lg">
            <div class="flex-row items-center justify-between p-4 space-y-3 sm:flex sm:space-y-0 sm:space-x-4">
                <div>
                    <h5 class="mr-3 text-lg font-bold dark:text-white uppercase">
                        {{ $customer->nombre . ' ' . $customer->apellido }}
                    </h5>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Datos del cliente</p>
                </div>
                <div class="flex items-center space-x-3">
                    <x-shared.button-header title="Volver" route="customer.list" />
                    <x-shared.button-header title="Editar" route="customer.edit" :params="[$customer->id]" />
                    @if ($customer->estado == 'Activo')
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
                    <x-shared.input-readonly title="Nombre" :value="$customer->nombre" col='1' />
                    <x-shared.input-readonly title="Apellido" :value="$customer->apellido" col='1' />

                    <x-shared.input-readonly title="Telefono" :value="$customer->telefono" />
                    <x-shared.input-readonly title="Correo" :value="$customer->correo" />
                    <x-shared.input-readonly title="Direccion" :value="$customer->direccion" col='2' />
                </div>

                <div class="flex items-center justify-between mt-5">
                    <h5 class="text-lg font-bold dark:text-white uppercase">Contratos</h5>
                    <x-shared.button-header title="Nuevo" route="contract.new" :params="[$customer->id]" />
                </div>

                <div class="overflow-x-auto p-4  ">
                    <table class="w-full text-sm text-left">
                        <thead class="text-md text-white uppercase bg-fondo dark:bg-gray-700 dark:text-gray-300">
                            <tr>
                                <th scope="col" class="px-4 py-3">Codigo</th>
                                <th scope="col" class="px-4 py-3">Costo</th>
                                <th scope="col" class="px-4 py-3">Pago</th>
                                <th scope="col" class="px-4 py-3">Fecha</th>
                                <th scope="col" class="px-4 py-3">Estado</th>
                                <th scope="col" class="px-4 py-3">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contracts as $contract)
                                <tr
                                    class="border-b dark:border-gray-700 @if ($loop->even) bg-gray-100 dark:bg-gray-800 @endif">
                                    <th scope="row"
                                        class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $contract->codigo }}
                                    </th>
                                    <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $contract->costo }}</td>
                                    <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $contract->estado_pago }}</td>
                                    <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $contract->fecha_inicio . ' al ' . $contract->fecha_final }}
                                    </td>
                                    <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        @if ($contract->estado_contrato == 'Finalizado')
                                            <X-shared.badge color="green" message="Finalizado" />
                                        @elseif ($contract->estado_contrato == 'Cancelado')
                                            <X-shared.badge color="red" message="Cancelado" />
                                        @else
                                            <X-shared.badge color="blue" message="Activo" />
                                        @endif
                                    </td>
                                    <td
                                        class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white flex items-center justify-end">
                                        <x-shared.button icon="show" route="contract.show" color="green"
                                            type="a" :hover="600" :params="$contract->id" tonality="400" />
                                        <x-shared.button icon="edit" route="contract.edit" color="blue"
                                            type="a" :hover="600" :params="$contract->id" />
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <nav class="px-1 py-3">
                        {{ $contracts->links() }}
                    </nav>
                </div>

            </section>
        </div>
    </x-shared.container>
</div>
