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
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre
                        </label>
                        <input type="text" wire:model="customerArray.nombre"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Nombre" required="">
                        @error('customerArray.nombre')
                            <x-shared.validate-error :message="$message" />
                        @enderror
                    </div>
                    <div class="col-span-3 sm:col-span-1">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Apellido
                        </label>
                        <input type="text" wire:model="customerArray.apellido"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Apellido" required="">
                        @error('customerArray.apellido')
                            <x-shared.validate-error :message="$message" />
                        @enderror
                    </div>
                    <x-shared.space />

                    <div class="col-span-3 sm:col-span-1">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Correo
                        </label>
                        <input type="email" wire:model="customerArray.correo"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Correo" required="">
                        @error('customerArray.correo')
                            <x-shared.validate-error :message="$message" />
                        @enderror
                    </div>
                    <div class="col-span-3 sm:col-span-1">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Telefono
                        </label>
                        <input type="text" wire:model="customerArray.telefono"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Telefono" required="">
                        @error('customerArray.telefono')
                            <x-shared.validate-error :message="$message" />
                        @enderror
                    </div>
                    <x-shared.space />

                    <div class="col-span-3 sm:col-span-2">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Direccion
                        </label>
                        <input type="text" wire:model="customerArray.direccion"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Direccion" required="">
                        @error('customerArray.direccion')
                            <x-shared.validate-error :message="$message" />
                        @enderror
                    </div>
                </div>
            </section>
        </div>
    </x-shared.container>
</div>
