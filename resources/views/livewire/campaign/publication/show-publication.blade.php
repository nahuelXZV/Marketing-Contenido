<div>
    <x-shared.container :breadcrumbs="$breadcrumbs">
        <div class="relative overflow-hidden bg-white  dark:bg-gray-800 sm:rounded-lg">
            <div class="flex-row items-center justify-between p-4 space-y-3 sm:flex sm:space-y-0 sm:space-x-4">
                <div>
                    <h5 class="mr-3 text-lg font-bold dark:text-white">
                        {{ $publication->titulo }} -
                        <x-shared.badge color="blue" :message="$publication->estado" />
                    </h5>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Datos de la publicacion</p>
                </div>
                <div class="flex items-center space-x-3">
                    <x-shared.button-header title="Volver" route="campaign.show" :params="$campaign->id" />
                    <x-shared.button-header title="Editar" route="publication.edit" :params="[$publication->id]" />
                    <livewire:campaign.publication.components.generate-image-modal :publication="$publication->id"
                        :key="$publication->id" />
                </div>
            </div>
        </div>

        <div class="max-w px-4 py-8 mx-auto">
            <section>
                <div class="grid gap-4 mb-4 sm:grid-cols-3 sm:gap-6 sm:mb-5">
                    <x-shared.input-readonly title="Titulo" :value="$publication->titulo" col='2' />
                    @if ($publication->codigo)
                        <x-shared.input-readonly title="Codigo" :value="$publication->codigo" col='1' />
                    @endif
                    @if ($publication->presupuesto)
                        <x-shared.input-readonly title="Presupuesto" :value="$publication->presupuesto" col='1' />
                    @endif
                    @if ($publication->fecha_publicacion)
                        <x-shared.input-readonly title="Fecha Publicacion" :value="$publication->fecha_publicacion" />
                    @endif
                    @if ($publication->hora_publicacion)
                        <x-shared.input-readonly title="Hora Publicacion" :value="$publication->hora_publicacion" />
                    @endif
                    <x-shared.text-area-readonly title="Contenido" :value="$publication->contenido" col='3' />
                </div>

                <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-styled-tab"
                        data-tabs-toggle="#default-styled-tab-content"
                        data-tabs-active-classes="text-purple-600 hover:text-purple-600 dark:text-purple-500 dark:hover:text-purple-500 border-purple-600 dark:border-purple-500"
                        data-tabs-inactive-classes="dark:border-transparent text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300"
                        role="tablist">
                        <li class="me-2" role="presentation">
                            <button
                                class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                                id="dashboard-styled-tab" data-tabs-target="#styled-dashboard" type="button"
                                role="tab" aria-controls="dashboard" aria-selected="false">
                                Recursos
                            </button>
                        </li>
                        <li class="me-2" role="presentation">
                            <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-styled-tab"
                                data-tabs-target="#styled-profile" type="button" role="tab"
                                aria-controls="estadisticas" aria-selected="false">
                                Pre-Visualizacion
                            </button>
                        </li>
                        <li class="me-2" role="presentation">
                            <button
                                class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                                id="settings-styled-tab" data-tabs-target="#styled-settings" type="button"
                                role="tab" aria-controls="settings" aria-selected="false">
                                Configuracion Meta
                            </button>
                        </li>
                    </ul>
                </div>
                <div id="default-styled-tab-content">
                    <div class="hidden p-4 rounded-lg  dark:bg-gray-800" id="styled-dashboard" role="tabpanel"
                        aria-labelledby="dashboard-tab">
                        <livewire:campaign.publication.components.resources :publication="$publication->id" />
                    </div>
                    <div class="hidden p-4 rounded-lg  dark:bg-gray-800" id="styled-profile" role="tabpanel"
                        aria-labelledby="profile-tab">
                        <livewire:campaign.publication.components.statistics :publication="$publication->id" />
                    </div>
                    <div class="hidden p-4 rounded-lg  dark:bg-gray-800" id="styled-settings" role="tabpanel"
                        aria-labelledby="settings-tab">
                        <livewire:campaign.publication.components.setting :publication="$publication->id" />
                    </div>
                </div>
            </section>
        </div>
    </x-shared.container>
</div>
