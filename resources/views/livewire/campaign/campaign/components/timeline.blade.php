<div>
    <ol class="relative border-s border-gray-200 dark:border-gray-700">
        @foreach ($publications as $publication)
            <li class="mb-10 ms-4">
                <div
                    class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -start-1.5 border border-white dark:border-gray-900 dark:bg-gray-700">
                </div>
                <time class="mb-1 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">
                    @if ($publication->fecha_publicacion && $publication->hora_publicacion)
                        @if ($publication->fecha_publicacion == Carbon\Carbon::now()->format('d-m-Y'))
                            Hoy
                        @else
                            {{ Carbon\Carbon::parse($publication->fecha_publicacion)->format('d F Y') }} -
                            {{ $publication->hora_publicacion }}
                        @endif
                    @else
                        Sin fecha de publicación
                    @endif
                </time>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $publication->titulo }}</h3>
                <p class="mb-4 text-base font-normal text-gray-500 dark:text-gray-400">{{ $publication->contenido }}</p>
                <a href="{{ route('publication.show', $publication->id) }}"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:outline-none focus:ring-gray-100 focus:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700">
                    Ver Publicacion
                    <svg class="w-3 h-3 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 5h12m0 0L9 1m4 4L9 9" />
                    </svg>
                </a>
            </li>
        @endforeach

        {{-- <li class="mb-10 ms-4">
            <div
                class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -start-1.5 border border-white dark:border-gray-900 dark:bg-gray-700">
            </div>
            <time class="mb-1 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">March 2022</time>
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Marketing UI design in Figma</h3>
            <p class="text-base font-normal text-gray-500 dark:text-gray-400">All of the pages and components are first
                designed in Figma and we keep a parity between the two versions even as we update the project.</p>
        </li>
        <li class="ms-4">
            <div
                class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -start-1.5 border border-white dark:border-gray-900 dark:bg-gray-700">
            </div>
            <time class="mb-1 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">April 2022</time>
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">E-Commerce UI code in Tailwind CSS</h3>
            <p class="text-base font-normal text-gray-500 dark:text-gray-400">Get started with dozens of web components
                and interactive elements built on top of Tailwind CSS.</p>
        </li> --}}
    </ol>
</div>
