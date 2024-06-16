<div>
    @if ($publicationConfiguration)

        <div class="relative overflow-hidden bg-white  dark:bg-gray-800 sm:rounded-lg">
            <div class="flex-row items-center justify-between p-4 space-y-3 sm:flex sm:space-y-0 sm:space-x-4">
                <div>
                    <h5 class="mr-3 text-lg font-bold dark:text-white uppercase">Configuración de publicación</h5>
                </div>
                <div>
                    <button wire:click="saveAdSet" type="button" wire:loading.remove wire:target="saveAdSet"
                        class="w-min flex items-center justify-center px-4 py-2 text-sm font-medium text-white rounded-lg bg-fondo hover:bg-primary-900 focus:ring-4 focus:ring-fondo dark:bg-fondo dark:hover:bg-primary-900 focus:outline-none dark:focus:ring-primary-800">
                        Guardar
                    </button>
                    <div wire:loading wire:target="saveAdSet" class="flex items-center space-x-2">
                        <li class="flex items-center">
                            <div role="status">
                                <x-icons.loading />
                                <span class="sr-only">Loading...</span>
                            </div>
                            <span class="text-md font-bold text-gray-900 dark:text-white">
                                Guardando configuracion...
                            </span>
                        </li>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w px-4 py-4 mx-auto">
            <section class="grid grid-cols-3">
                <div class="w-auto bg-white px-10 dark:bg-gray-800">
                    <h2 class="text-lg font-bold text-start mb-3 dark:text-white">
                        Imagen seleccionada
                    </h2>
                    @if ($resourceSelected)
                        <img class="h-auto w-full object-cover" src="{{ $resourceSelected->url_imagen }}" />
                    @endif
                    @error('resourceSelected')
                        <x-shared.validate-error :message="$message" />
                    @enderror
                </div>

                <div class="col-span-2 grid gap-3 mb-4 sm:grid-cols-3 sm:gap-3 sm:mb-5">

                    @if ($adSetArray['identificador'])
                        <div class="col-span-3 sm:col-span-2">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Identificador
                            </label>
                            <input type="text" wire:model="adSetArray.identificador"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                readonly>
                        </div>
                    @endif
                    @if ($publication->identificador_anuncio)
                        <div class="col-span-3 sm:col-span-2">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Identificador
                                Anuncio
                            </label>
                            <input type="text" wire:model="adSetArray.identificador_anuncio"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                readonly>
                        </div>
                    @endif
                    <div class="col-span-3 sm:col-span-2">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre
                        </label>
                        <input type="text" wire:model="adSetArray.name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Nombre" required>
                        @error('adSetArray.name')
                            <x-shared.validate-error :message="$message" />
                        @enderror
                    </div>
                    <div class=" col-span-1">
                        <label for="format" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Objetivo de optimizacion
                        </label>
                        <select id="format" wire:model="adSetArray.optimization_goal"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="">Selecciona un objetivo</option>
                            @foreach ($objetives as $objetive)
                                <option value="{{ $objetive }}">{{ $objetive }}</option>
                            @endforeach
                        </select>
                        @error('adSetArray.optimization_goal')
                            <x-shared.validate-error :message="$message" />
                        @enderror
                    </div>
                    <div class="col-span-1">
                        <label for="format" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Evento de facturacion
                        </label>
                        <select id="format" wire:model="adSetArray.billing_event"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="">Selecciona un evento</option>
                            @foreach ($events as $event)
                                <option value="{{ $event }}">{{ $event }}</option>
                            @endforeach
                        </select>
                        @error('adSetArray.billing_event')
                            <x-shared.validate-error :message="$message" />
                        @enderror
                    </div>
                    <div class="col-span-3 sm:col-span-1">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Monto de oferta
                        </label>
                        <input type="number" wire:model="adSetArray.bid_amount" min="1" step="0.01"
                            max="9999999999"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Monto oferta" required>
                        @error('adSetArray.bid_amount')
                            <x-shared.validate-error :message="$message" />
                        @enderror
                    </div>
                    <div class="col-span-3 sm:col-span-1">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Presupuesto Diario
                        </label>
                        <input type="number" wire:model="adSetArray.daily_budget" min="10" step="0.01"
                            max="9999999999"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Presupuesto Diario" required>
                        @error('adSetArray.daily_budget')
                            <x-shared.validate-error :message="$message" />
                        @enderror
                    </div>

                    <div class="col-span-3 sm:col-span-3">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Link de redireccion
                            (URL)
                        </label>
                        <input type="text" wire:model="adSetArray.link_redirect"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Link" required>
                        @error('adSetArray.link_redirect')
                            <x-shared.validate-error :message="$message" />
                        @enderror
                    </div>

                    <div class="col-span-3 sm:col-span-1">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha de publicacion
                        </label>
                        <input type="datetime-local" wire:model.live="adSetArray.start_time"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            required>
                        @error('adSetArray.start_time')
                            <x-shared.validate-error :message="$message" />
                        @enderror
                    </div>

                    <div class="col-span-3 sm:col-span-1">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha final de
                            publicacion
                        </label>
                        <input type="datetime-local" wire:model="adSetArray.end_time"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            required>
                        @error('adSetArray.end_time')
                            <x-shared.validate-error :message="$message" />
                        @enderror
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <label for="style" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Estado (Recomendado: PAUSED)
                        </label>
                        <select id="style" name="style" required wire:model="adSetArray.status"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="">Selecciona un estado</option>
                            @foreach ($statuses as $status)
                                <option value="{{ $status }}">{{ $status }}</option>
                            @endforeach
                        </select>
                        @error('adSetArray.status')
                            <x-shared.validate-error :message="$message" />
                        @enderror
                    </div>

                </div>
            </section>
        </div>
    @else
        <div class="w-full h-full flex justify-center items-center">
            <p class="text-gray-500 dark:text-gray-400">
                Necesitas generar la campaña para poder usar esta funcionalidad
            </p>
        </div>
    @endif
</div>
