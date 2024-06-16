<div>
    <div class="w-full flex justify-between mb-2">
        <div class="grid grid-rows-2">
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200">
                Preview
            </h2>
            <p class="text-sm text-gray-500 dark:text-gray-300">
                Visualiza la publicacion antes de ser publicada
            </p>
        </div>
        <div class=" col-span-1">
            <label for="format" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                Formato de visualizacion
            </label>
            <select id="format" wire:model.live="formatSelected"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="">Selecciona un objetivo</option>
                @foreach ($formats as $format)
                    <option value="{{ $format }}">{{ $format }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="w-full h-full mt-4 flex justify-center items-center">
        @if ($inner == null)
            <div class="w-full h-full flex justify-center items-center">
                <p class="text-gray-500 dark:text-gray-400">
                    Necesitas guardar la Configuracion Meta para poder usar esta funcionalidad
                </p>
            </div>
        @else
            {!! $inner !!}
        @endif

    </div>

</div>
