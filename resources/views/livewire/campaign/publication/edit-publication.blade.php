<div>
    <x-shared.container :breadcrumbs="$breadcrumbs">
        <div class="relative overflow-hidden bg-white  dark:bg-gray-800 sm:rounded-lg">
            <div class="flex-row items-center justify-between p-4 space-y-3 sm:flex sm:space-y-0 sm:space-x-4">
                <div>
                    <h5 class="mr-3 text-lg font-bold dark:text-white uppercase">Actualizar</h5>
                </div>
                <div>
                    <button wire:click="save" type="button" wire:loading.remove wire:target="save"
                        class="w-min flex items-center justify-center px-4 py-2 text-sm font-medium text-white rounded-lg bg-fondo hover:bg-primary-900 focus:ring-4 focus:ring-fondo dark:bg-fondo dark:hover:bg-primary-900 focus:outline-none dark:focus:ring-primary-800">
                        Guardar
                    </button>
                    <div wire:loading wire:target="save" class="flex items-center space-x-2">
                        <li class="flex items-center">
                            <div role="status">
                                <x-icons.loading />
                                <span class="sr-only">Loading...</span>
                            </div>
                            <span class="text-md font-bold text-gray-900 dark:text-white">
                                Actualizando publicacion...
                            </span>
                        </li>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w px-4 py-8 mx-auto">
            <section>
                <div class="grid gap-4 mb-4 sm:grid-cols-3 sm:gap-6 sm:mb-5">
                    <div class="col-span-3 sm:col-span-2">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Titulo
                        </label>
                        <input type="text" wire:model="publicationArray.titulo"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Titulo" required>
                        @error('publicationArray.titulo')
                            <x-shared.validate-error :message="$message" />
                        @enderror
                    </div>
                    <div class="col-span-3 sm:col-span-1">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Presupuesto
                        </label>
                        <input type="number" wire:model="publicationArray.presupuesto" min="0" step="0.01"
                            max="9999999999"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Presupuesto" required>
                        @error('publicationArray.presupuesto')
                            <x-shared.validate-error :message="$message" />
                        @enderror
                    </div>


                    <div class="col-span-3 sm:col-span-1">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha de publicacion
                        </label>
                        <input type="date" wire:model="publicationArray.fecha_publicacion" min="{{ date('Y-m-d') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            required>
                        @error('publicationArray.fecha_publicacion')
                            <x-shared.validate-error :message="$message" />
                        @enderror
                    </div>
                    <div class="col-span-3 sm:col-span-1">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Hora de publicacion
                        </label>
                        <input type="time" wire:model="publicationArray.hora_publicacion"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            required>
                        @error('publicationArray.hora_publicacion')
                            <x-shared.validate-error :message="$message" />
                        @enderror
                    </div>
                    <x-shared.space />

                    <div class="sm:col-span-3">
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Contenido
                        </label>
                        <textarea id="description" rows="3" wire:model="publicationArray.contenido"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Contenido..."></textarea>
                        @error('publicationArray.contenido')
                            <x-shared.validate-error :message="$message" />
                        @enderror
                    </div>
                    <div class="sm:col-span-3">
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Descripcion del recurso
                            <span>
                                <small class="text-gray-500 dark:text-gray-400">(Ingles)</small>
                            </span>
                        </label>
                        <textarea id="description" rows="3" wire:model="publicationArray.descripcion_recurso"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Descripcion..."></textarea>
                        @error('publicationArray.descripcion_recurso')
                            <x-shared.validate-error :message="$message" />
                        @enderror
                    </div>
                </div>
            </section>
        </div>
    </x-shared.container>
</div>
