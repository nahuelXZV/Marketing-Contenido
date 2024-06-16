<div>
    <button data-modal-target="static-modal" data-modal-toggle="static-modal" wire:loading.remove
        wire:target="generateCampaign" wire:target="generateCampaign"
        class="block text-white bg-fondo hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-fondo font-medium rounded-lg text-sm px-3 py-2 text-center dark:bg-fondo dark:hover:bg-fondo dark:focus:ring-fondo"
        type="button">
        Generar Campaña
    </button>
    <div class="flex items-center space-x-2" wire:loading wire:target="generateCampaign">
        <li class="flex items-center">
            <div role="status">
                <x-icons.loading />
                <span class="sr-only">Loading...</span>
            </div>
            <span class="text-md font-bold text-gray-900 dark:text-white">
                Generando campaña...
            </span>
        </li>
    </div>
    <!-- Main modal -->
    <div id="static-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Generar Nueva Campaña
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="static-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-4">
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2 sm:col-span-4">
                            <label for="width"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre de la
                                campaña</label>
                            <input type="text" name="width" id="width"
                                wire:model="publicationConfigurationArray.name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                required>
                            @error('publicationConfigurationArray.name')
                                <x-shared.validate-error :message="$message" />
                            @enderror
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="style"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Objetivo</label>
                            <select id="style" name="style" required
                                wire:model="publicationConfigurationArray.objective"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="">Selecciona un objetivo</option>
                                @foreach ($objetives as $objetive)
                                    <option value="{{ $objetive }}">{{ $objetive }}</option>
                                @endforeach
                            </select>
                            @error('publicationConfigurationArray.objective')
                                <x-shared.validate-error :message="$message" />
                            @enderror
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="style" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Estado (Recomendado: PAUSED)
                            </label>
                            <select id="style" name="style" required
                                wire:model="publicationConfigurationArray.status"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="">Selecciona un estado</option>
                                @foreach ($statuses as $status)
                                    <option value="{{ $status }}">{{ $status }}</option>
                                @endforeach
                            </select>
                            @error('publicationConfigurationArray.status')
                                <x-shared.validate-error :message="$message" />
                            @enderror
                        </div>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button data-modal-hide="static-modal" type="button" wire:click="generateCampaign"
                        wire:loading.attr="disabled" wire:target="generateCampaign"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Generar
                    </button>
                    <button data-modal-hide="static-modal" type="button" wire:click="resetOptions"
                        wire:loading.attr="disabled" wire:target="resetOptions"
                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                        Cancelar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
