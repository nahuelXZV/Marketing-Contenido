<div>
    <x-shared.container :breadcrumbs="$breadcrumbs">
        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 p-4 gap-4">
            <div
                class="bg-gray-100 dark:bg-gray-800 shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-gray-800 dark:border-white text-gray-800 dark:text-white font-medium group">
                <div class="flex justify-center items-center w-14 h-14 bg-white rounded-full">
                    <svg class="h-8 w-8 text-gray-800" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polygon points="12 2 2 7 12 12 22 7 12 2" />
                        <polyline points="2 17 12 22 22 17" />
                        <polyline points="2 12 12 17 22 12" />
                    </svg>
                </div>
                <div class="text-right">
                    <p class="text-2xl">{{ $cantCampaigns }}</p>
                    <p>Campañas</p>
                </div>
            </div>
            <div
                class="bg-gray-100 dark:bg-gray-800 shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-gray-800 dark:border-white text-gray-800 dark:text-white font-medium group">
                <div class="flex justify-center items-center w-14 h-14 bg-white rounded-full">
                    <svg class="h-8 w-8 text-gray-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2" />
                    </svg>

                </div>
                <div class="text-right">
                    <p class="text-2xl">{{ $cantPublications }}</p>
                    <p>Publicaciones</p>
                </div>
            </div>
            <div
                class="bg-gray-100 dark:bg-gray-800 shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-gray-800 dark:border-white text-gray-800 dark:text-white font-medium group">
                <div class="flex justify-center items-center w-14 h-14 bg-white rounded-full">
                    <svg width="30" height="30" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        class="stroke-current text-black transform transition-transform duration-500 ease-in-out">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                        </path>
                    </svg>
                </div>
                <div class="text-right">
                    <p class="text-2xl">{{ $cantUsers }}</p>
                    <p>Usuarios</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-1 lg:grid-cols-2">
            {{-- Table Users --}}
            <div class="p-4">
                <div class="mx-auto bg-gray-100 shadow rounded-lg">
                    <div class="flex flex-wrap items-center p-4 bg-gray-100 shadow-lg rounded">
                        <div class="relative w-full max-w-full flex-grow flex-1">
                            <h3 class="text-xl text-gray-800 font-bold leading-tight">Usuarios</h3>
                        </div>
                    </div>
                    <div class="block w-full overflow-x-auto">
                        <table class="items-center w-full bg-transparent border-collapse">
                            <thead>
                                <tr>
                                    <th
                                        class="px-4 bg-white dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                        Rol</th>
                                    <th
                                        class="px-4 bg-white dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                        Cantidad</th>
                                    <th
                                        class="px-4 bg-white dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left min-w-140-px">
                                        Porcentaje</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $rol)
                                    <tr class="text-gray-700">
                                        <th
                                            class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap text-left">
                                            {{ $rol['rol'] }}</th>
                                        <td
                                            class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap">
                                            {{ $rol['cantidad_usuarios'] }}</td>
                                        <td
                                            class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                            <div class="flex items-center">
                                                <span class="mr-2">{{ $rol['porcentaje_usuarios'] }}%</span>
                                                <div class="relative w-full">
                                                    <div
                                                        class="overflow-hidden h-2 text-xs flex rounded bg-gray-200 shadow-sm">
                                                        <div style="width: {{ $rol['porcentaje_usuarios'] }}%"
                                                            class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-gray-800">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- BarChart --}}
            <div class="px-4">
                <div class="mx-auto py-4">
                    <div class="shadow p-6 rounded-lg bg-gray-100">
                        <div class="md:flex md:justify-between md:items-center">
                            <div>
                                <h2 class="text-xl text-gray-800 font-bold leading-tight">Campañas</h2>
                                <p class="mb-2 text-gray-600 text-sm">Estados de las campañas</p>
                            </div>

                            <!-- Legends -->
                            <div class="mb-4">
                                <div class="flex items-center">
                                    <div class="w-2 h-2 bg-gray-800 mr-2 rounded-full"></div>
                                    <div class="text-sm text-gray-700">Cantidad</div>
                                </div>
                            </div>
                        </div>


                        <div class="my-8 relative"
                            style="background: repeating-linear-gradient(to bottom, #eee, #eee 1px, #fff 1px, #fff 10%) ">
                            <!-- Bar Chart -->
                            <div class="flex -mx-2 items-end">
                                @foreach ($campaigns['counts'] as $data)
                                    <div class="px-2 w-1/4">
                                        <div style="height: {{ $data * 10 }}px"
                                            class="transition ease-in duration-200 bg-gray-800 hover:bg-gray-600 relative">
                                            <div
                                                class="text-center absolute top-0 left-0 right-0 -mt-6 text-gray-800 text-sm">
                                                {{ $data }}</div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Labels -->
                            <div class="border-t border-gray-400 mx-auto"
                                style="height: 1px; width: {{ 100 - (1 / count($campaigns['labels'])) * 100 + 3 }}%">
                            </div>
                            <div class="flex -mx-2 items-end">
                                @foreach ($campaigns['labels'] as $label)
                                    <div class="px-2 w-1/4">
                                        <div class="bg-gray-600 relative">
                                            <div class="text-center absolute top-0 left-0 right-0 h-2 -mt-px bg-gray-400 mx-auto"
                                                style="width: 1px"></div>
                                            <div
                                                class="text-center absolute top-0 left-0 right-0 mt-3 text-gray-700 text-sm">
                                                {{ $label }}</div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- PieChart --}}
            <div class="px-4">
                <div class="mx-auto py-4">
                    <div class="shadow p-4 rounded-lg bg-gray-100 overflow-hidden">
                        <div>
                            <h2 class="text-xl text-gray-800 font-bold leading-tight">Publicaciones</h2>
                            <p class="mb-2 text-gray-600 text-sm">Estados de las publicaciones</p>
                        </div>
                        <canvas class="p-1 ml-24 mr-24" id="chartPie"></canvas>
                    </div>
                    <!-- Required chart.js -->
                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


                    <script>
                        const dataPie = {
                            labels: @json($publications['labels']),
                            datasets: [{
                                label: "My First Dataset",
                                data: @json($publications['counts']),
                                backgroundColor: [
                                    "rgb(37, 33, 32)",
                                    "rgb(101, 88, 86)",
                                    "rgb(152, 136, 132)",
                                    "rgb(197, 181, 178)",
                                ],
                                hoverOffset: 4,
                            }, ],
                        };

                        const configPie = {
                            type: "pie",
                            data: dataPie,
                            options: {},
                        };

                        var chartBar = new Chart(document.getElementById("chartPie"), configPie);
                    </script>
                </div>
            </div>

            {{-- BarChart --}}
            <div class="px-4">
                <div class="mx-auto py-4">
                    <div class="shadow p-6 rounded-lg bg-gray-100">
                        <div class="md:flex md:justify-between md:items-center">
                            <div>
                                <h2 class="text-xl text-gray-800 font-bold leading-tight">Contratos</h2>
                                <p class="mb-2 text-gray-600 text-sm">Estados de los contratos</p>
                            </div>

                            <!-- Legends -->
                            <div class="mb-4">
                                <div class="flex items-center">
                                    <div class="w-2 h-2 bg-gray-800 mr-2 rounded-full"></div>
                                    <div class="text-sm text-gray-700">Cantidad</div>
                                </div>
                            </div>
                        </div>


                        <div class="my-8 relative"
                            style="background: repeating-linear-gradient(to bottom, #eee, #eee 1px, #fff 1px, #fff 10%) ">
                            <!-- Bar Chart -->
                            <div class="flex -mx-2 items-end">
                                @foreach ($contracts['counts'] as $data)
                                    <div class="px-2 w-1/4">
                                        <div style="height: {{ $data * 10 }}px"
                                            class="transition ease-in duration-200 bg-gray-800 hover:bg-gray-600 relative">
                                            <div
                                                class="text-center absolute top-0 left-0 right-0 -mt-6 text-gray-800 text-sm">
                                                {{ $data }}</div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Labels -->
                            <div class="border-t border-gray-400 mx-auto"
                                style="height: 1px; width: {{ 100 - (1 / count($contracts['labels'])) * 100 + 3 }}%">
                            </div>
                            <div class="flex -mx-2 items-end">
                                @foreach ($contracts['labels'] as $label)
                                    <div class="px-2 w-1/4">
                                        <div class="bg-gray-600 relative">
                                            <div class="text-center absolute top-0 left-0 right-0 h-2 -mt-px bg-gray-400 mx-auto"
                                                style="width: 1px"></div>
                                            <div
                                                class="text-center absolute top-0 left-0 right-0 mt-3 text-gray-700 text-sm">
                                                {{ $label }}</div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </x-shared.container>
</div>
