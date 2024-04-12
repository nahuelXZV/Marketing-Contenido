<div>
    <x-shared.container :breadcrumbs="$breadcrumbs">
        <div class="relative overflow-hidden bg-white  dark:bg-gray-800 sm:rounded-lg">
            <div class="flex-row items-center justify-between p-4 space-y-3 sm:flex sm:space-y-0 sm:space-x-4">
                <div>
                    <h5 class="mr-3 text-lg font-bold dark:text-white uppercase">Crear</h5>
                </div>
                <button wire:click="save" type="button"
                    class="w-min flex items-center justify-center px-4 py-2 text-sm font-medium text-white rounded-lg bg-fondo hover:bg-primary-900 focus:ring-4 focus:ring-fondo dark:bg-fondo dark:hover:bg-primary-900 focus:outline-none dark:focus:ring-primary-800">
                    Guardar
                </button>
            </div>
        </div>

        <div class="max-w px-4 py-8 mx-auto">
            <section>
                <div class="grid gap-4 mb-4 sm:grid-cols-3 sm:gap-6 sm:mb-5">
                    <div class="col-span-3 sm:col-span-1">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Codigo
                        </label>
                        <input type="text" wire:model="contractArray.codigo" readonly
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Codigo.." required>
                        @error('contractArray.codigo')
                            <x-shared.validate-error :message="$message" />
                        @enderror
                    </div>
                    <div class="col-span-3 sm:col-span-1">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Costo
                        </label>
                        <input type="text" wire:model="contractArray.costo"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Costo.." required="">
                        @error('contractArray.costo')
                            <x-shared.validate-error :message="$message" />
                        @enderror
                    </div>
                    <x-shared.space />

                    <div class="col-span-3 sm:col-span-1">
                        <label for="rol" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Tipo de contrato
                        </label>
                        <select id="rol" wire:model="contractArray.tipo_contrato"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option selected="">Seleccione una tipo de contrato</option>
                            @foreach ($contractType as $type)
                                <option value="{{ $type }}">{{ $type }}</option>
                            @endforeach
                        </select>
                        @error('contractArray.tipo_contrato')
                            <x-shared.validate-error :message="$message" />
                        @enderror
                    </div>
                    <div class="col-span-3 sm:col-span-1">
                        <label for="rol" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Detalle de pago
                        </label>
                        <select id="rol" wire:model="contractArray.detalle_pago"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option selected="">Seleccione un detalle de pago</option>
                            @foreach ($paymentDetail as $detail)
                                <option value="{{ $detail }}">{{ $detail }}</option>
                            @endforeach
                        </select>
                        @error('contractArray.detalle_pago')
                            <x-shared.validate-error :message="$message" />
                        @enderror
                    </div>
                    <div class="col-span-3 sm:col-span-1">
                        <label for="rol" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Estado de pago
                        </label>
                        <select id="rol" wire:model="contractArray.estado_pago"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option selected="">Seleccione un estado de pago</option>
                            @foreach ($paymentStatus as $status)
                                <option value="{{ $status }}">{{ $status }}</option>
                            @endforeach
                        </select>
                        @error('contractArray.estado_pago')
                            <x-shared.validate-error :message="$message" />
                        @enderror
                    </div>


                    <div class="col-span-3 sm:col-span-1">
                        <label for="rol" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Estado de contrato
                        </label>
                        <select id="rol" wire:model="contractArray.estado_contrato"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option selected="">Seleccione un estado de contrato</option>
                            @foreach ($contractStatus as $status)
                                <option value="{{ $status }}">{{ $status }}</option>
                            @endforeach
                        </select>
                        @error('contractArray.estado_contrato')
                            <x-shared.validate-error :message="$message" />
                        @enderror
                    </div>
                    <div class="col-span-3 sm:col-span-1">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Fecha Inicio
                        </label>
                        <input type="date" wire:model.blur="contractArray.fecha_inicio"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Fecha Inicio" required="">
                        @error('contractArray.fecha_inicio')
                            <x-shared.validate-error :message="$message" />
                        @enderror
                    </div>
                    <div class="col-span-3 sm:col-span-1">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Fecha Final
                        </label>
                        <input type="date" wire:model.blur="contractArray.fecha_final"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Fecha Final" required="">
                        @error('contractArray.fecha_final')
                            <x-shared.validate-error :message="$message" />
                        @enderror
                    </div>


                    <div class="sm:col-span-3">
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Descripción
                        </label>
                        <textarea id="description" rows="3" wire:model="contractArray.descripcion"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Descripcion..."></textarea>
                        @error('contractArray.descripcion')
                            <x-shared.validate-error :message="$message" />
                        @enderror
                    </div>
                    <div class="sm:col-span-3">
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Condiciones
                        </label>
                        <textarea id="description" rows="3" wire:model="contractArray.condiciones"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Condiciones..."></textarea>
                        @error('contractArray.condiciones')
                            <x-shared.validate-error :message="$message" />
                        @enderror
                    </div>

                    <div class="col-span-3 sm:col-span-1">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Subir documento
                        </label>
                        <input type="file" wire:model="documento"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        @error('documento')
                            <x-shared.validate-error :message="$message" />
                        @enderror
                    </div>


                </div>
            </section>
        </div>
    </x-shared.container>
</div>
