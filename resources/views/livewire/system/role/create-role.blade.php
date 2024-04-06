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
                    <div class="col-span-3 sm:col-span-2">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre
                            del rol
                        </label>
                        <input type="text" wire:model="nameRole"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Rol" required="">
                        @error('nameRole')
                            <x-shared.validate-error :message="$message" />
                        @enderror
                    </div>
                </div>

                <div class="grid gap-4 mb-4 sm:grid-cols-3 sm:gap-6 sm:mb-5">
                    <div class="col-span-3 sm:col-span-3">
                        <label class="block mb-2 text-lg font-medium text-gray-900 dark:text-white">
                            Listado de todos permisos
                        </label>
                        @error('selectedPermissions')
                            <x-shared.validate-error :message="$message" />
                        @enderror
                        <div class="grid gap-4 sm:grid-cols-3 mt-5">
                            <label class="md:col-span-3 block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Permisos Administrativos
                            </label>
                            @foreach ($permissionsAdministrative as $administrative)
                                <div class="flex items center">
                                    <input type="checkbox"
                                        wire:model.live='selectedPermissions.{{ $administrative->id }}'
                                        value="{{ $administrative->id }}" id="{{ $administrative->id }}"
                                        class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-600 dark:focus:ring-primary-500 dark:border-gray-600 dark:text-primary-500 dark:checked:bg-primary-600 dark:checked:border-primary-600 dark:checked:text-white">
                                    <label for="{{ $administrative->id }}"
                                        class="ml-2 text-sm font-medium text-gray-900 dark:text-white">{{ $administrative->description }}</label>

                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </x-shared.container>
</div>
