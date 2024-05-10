<!-- component -->
<div class="flex  w-full flex-wrap justify-center p-5 ">
    <div class="w-full mb-4">
        <h2 class="text-lg font-bold text-start">
            Selecciona la imagen que deseas agregar a la publicacion
        </h2>
    </div>
    <div class="grid grid-cols-4 gap-3">
        @foreach ($resources as $resource)
            <div class="w-auto bg-white p-1">
                <a href="{{ route('publication.image', $resource->id) }}">
                    <img class="h-auto w-full object-cover" src="{{ $resource->url_imagen }}" />
                </a>
                <ul class="mt-3 flex flex-wrap">
                    <li class="mr-auto">
                        <a class="flex text-gray-400 hover:text-gray-600"
                            href="{{ route('resource.download', $resource->id) }}" target="_blank">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                style="width:24px;height:24px" class="mr-0.5">
                                <path fill-rule="evenodd"
                                    d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm-.53 14.03a.75.75 0 0 0 1.06 0l3-3a.75.75 0 1 0-1.06-1.06l-1.72 1.72V8.25a.75.75 0 0 0-1.5 0v5.69l-1.72-1.72a.75.75 0 0 0-1.06 1.06l3 3Z"
                                    clip-rule="evenodd" />
                            </svg>
                            Descargar
                        </a>
                    </li>
                    <li>
                        <button class="flex text-gray-400 hover:text-gray-600" wire:loading.attr="disabled"
                            wire:click="selectedResource({{ $resource->id }})">
                            @if ($resource->selected == true)
                                <svg class="mr-0.5 text-red-900" style="width:24px;height:24px" viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="M12,21.35L10.55,20.03C5.4,15.36 2,12.27 2,8.5C2,5.41 4.42,3 7.5,3C9.24,3 10.91,3.81 12,5.08C13.09,3.81 14.76,3 16.5,3C19.58,3 22,5.41 22,8.5C22,12.27 18.6,15.36 13.45,20.03L12,21.35Z" />
                                </svg>
                            @else
                                <svg class="mr-0.5" style="width:24px;height:24px" viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="M12,21.35L10.55,20.03C5.4,15.36 2,12.27 2,8.5C2,5.41 4.42,3 7.5,3C9.24,3 10.91,3.81 12,5.08C13.09,3.81 14.76,3 16.5,3C19.58,3 22,5.41 22,8.5C22,12.27 18.6,15.36 13.45,20.03L12,21.35Z" />
                                </svg>
                            @endif
                        </button>
                    </li>
                </ul>
            </div>
        @endforeach

    </div>
</div>
