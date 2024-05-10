<div>
    <x-shared.container :breadcrumbs="$breadcrumbs">
        <div class="relative overflow-hidden bg-white dark:bg-gray-800 sm:rounded-lg">
            <div class="flex-row items-center justify-between p-4 space-y-3 sm:flex sm:space-y-0 sm:space-x-4">
                <div>
                    <h5 class="mr-3 text-lg font-bold dark:text-white">
                        {{ $publication->titulo }} -
                        <x-shared.badge color="blue" :message="$publication->estado" />
                    </h5>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Datos de la publicacion</p>
                </div>
                <div class="flex items-center space-x-3">
                    <x-shared.button-header title="Volver" route="publication.show" :params="$publication->id" />
                    <x-shared.button-header title="Descargar base" route="resource.download" :params="[$resource->id]" />
                    <a href="{{ $newImage . '&dl' }}" target="_blank"
                        class="flex items-center justify-center px-4 py-2 text-sm font-medium text-white rounded-lg bg-fondo hover:bg-primary-900 focus:ring-4 focus:ring-primary-300 dark:bg-fondo dark:hover:bg-primary-900 focus:outline-none dark:focus:ring-primary-900">
                        Descargar nueva imagen
                    </a>
                </div>
            </div>
        </div>
        <!-- component -->
        <div class="px-4">
            <div class="flex flex-col">
                <div class="mt-2 items-center bg-gray-50">
                    <div class="flex flex-col justify-start items-start px-10 pt-4">
                        <p class="font-bold text-xl text-gray-600 dark:text-white">
                            Nueva Imagen
                        </p>
                    </div>
                    <div class="flex flex-col justify-center items-center">
                        <div class="sm:p-auto py-5 px-10 ">
                            <img class="w-auto h-auto" src="{{ $newImage }}" alt="image1" />
                        </div>
                    </div>
                </div>
                <div class="flex flex-col justify-center mt-4">
                    <div class="w-full mb-4">
                        <h2 class="text-lg font-bold text-start">
                            Configuraciones de la imagen
                        </h2>
                    </div>
                    <div class="grid grid-cols-6 gap-2">
                        <div class="mb-5 col-span-2">
                            <label for="format" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Ajuste automático
                            </label>
                            <select id="format" wire:model="options.f"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="">Selecciona un ajuste</option>
                                @foreach ($autoOptions as $auto)
                                    <option value="{{ $auto }}">{{ $auto }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-5">
                            <label for="height" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Altura
                            </label>
                            <input type="number" id="height" wire:model="options.h"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                        </div>
                        <div class="mb-5">
                            <label for="width" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Ancho
                            </label>
                            <input type="number" id="width" wire:model="options.w"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                        </div>
                        <div class="mb-5">
                            <label for="quality" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Calidad
                            </label>
                            <input type="number" id="quality" wire:model="options.q" min="1" max="100"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                        </div>
                        <div class="mb-5 col-span-2">
                            <label for="format" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Formato de la imagen
                            </label>
                            <select id="format" wire:model="options.fm"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="">Selecciona un formato</option>
                                @foreach ($formatOptions as $format)
                                    <option value="{{ $format }}">{{ $format }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class=" mb-5">
                            <label for="format" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Agregar marca de agua
                            </label>
                            <select id="format" wire:model="options.mark"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="null">No</option>
                                <option value="si">Si</option>
                            </select>
                        </div>
                        <div class="mb-5 col-span-2">
                            <label for="format" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Ajuste
                            </label>
                            <select id="format" wire:model="options.fit"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="">Selecciona un ajuste</option>
                                @foreach ($fitOptions as $fit)
                                    <option value="{{ $fit }}">{{ $fit }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-5">
                            <label for="quality" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Contraste
                            </label>
                            <input type="number" id="quality" wire:model="options.con" min="-100" max="100"
                                placeholder="0"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                        </div>
                        <div class="mb-5">
                            <label for="quality" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Exposicion
                            </label>
                            <input type="number" id="quality" wire:model="options.exp" min="-100" max="100"
                                placeholder="0"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                        </div>
                        <div class="mb-5">
                            <label for="quality"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Saturacion
                            </label>
                            <input type="number" id="quality" wire:model="options.sat" min="-100"
                                max="100" placeholder="0"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                        </div>
                        <div class="mb-5">
                            <label for="quality"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Vibrance
                            </label>
                            <input type="number" id="quality" wire:model="options.vib" min="-100"
                                max="100" placeholder="0"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                        </div>
                        <div class="mb-5">
                            <label for="quality"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Blur
                            </label>
                            <input type="number" id="quality" wire:model="options.blur" min="0"
                                max="2000" placeholder="0"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                        </div>
                        <div class=" mb-5">
                            <label for="format"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Transparencia
                            </label>
                            <select id="format" wire:model="options.transparency"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="null">No</option>
                                <option value="grid">Si</option>
                            </select>
                        </div>

                        <div class="flex items-start mb-5 col-span-6">
                            <button wire:click="generate" wire:loading.attr="disabled"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Actualizar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </x-shared.container>
</div>
