<div>
    <x-shared.container :breadcrumbs="$breadcrumbs">
        <div class="relative overflow-hidden bg-white  dark:bg-gray-800 sm:rounded-lg">
            <div class="flex-row items-center justify-between p-4 space-y-3 sm:flex sm:space-y-0 sm:space-x-4">
                <div>
                    <h5 class="mr-3 text-lg font-bold dark:text-white">
                        @if ($campaign->codigo)
                            {{ $campaign->codigo }} -
                            <x-shared.badge color="blue" :message="$campaign->estado" />
                        @endif
                    </h5>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Datos de la campaña</p>
                </div>
                <div class="flex items-center space-x-3">
                    <x-shared.button-header title="Volver" route="campaign.list" />
                    <x-shared.button-header title="Editar" route="campaign.edit" :params="[$campaign->id]" />
                </div>
            </div>
        </div>

        <div class="max-w px-4 py-8 mx-auto">
            <section>
                <div class="grid gap-4 mb-4 sm:grid-cols-3 sm:gap-6 sm:mb-5">
                    <x-shared.input-readonly title="Tematica" :value="$campaign->tematica" col='2' />
                    <x-shared.input-readonly title="Audiencia" :value="$campaign->audiencia" col='1' />

                    <x-shared.input-readonly title="Fecha Inicio" :value="$campaign->fecha_inicio" />
                    <x-shared.input-readonly title="Fecha Final" :value="$campaign->fecha_final" />
                    @if ($campaign->intervalo)
                        <x-shared.input-readonly title="Intervalo" :value="$campaign->invervalo" col='1' />
                    @endif
                    <x-shared.input-readonly title="Presupuesto" :value="$campaign->presupuesto" col='1' />
                    <x-shared.input-readonly title="Objetivo" :value="$campaign->objetivo" col='2' />

                    <x-shared.text-area-readonly title="Descripcion" :value="$campaign->descripcion" col='3' />
                </div>

                <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-styled-tab"
                        data-tabs-toggle="#default-styled-tab-content"
                        data-tabs-active-classes="text-purple-600 hover:text-purple-600 dark:text-purple-500 dark:hover:text-purple-500 border-purple-600 dark:border-purple-500"
                        data-tabs-inactive-classes="dark:border-transparent text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300"
                        role="tablist">
                        <li class="me-2" role="presentation">
                            <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-styled-tab"
                                data-tabs-target="#styled-profile" type="button" role="tab"
                                aria-controls="estadisticas" aria-selected="false">
                                Linea de tiempo
                            </button>
                        </li>
                        <li class="me-2" role="presentation">
                            <button
                                class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                                id="dashboard-styled-tab" data-tabs-target="#styled-dashboard" type="button"
                                role="tab" aria-controls="dashboard" aria-selected="false">
                                Estadisticas
                            </button>
                        </li>
                        <li class="me-2" role="presentation">
                            <button
                                class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                                id="report-styled-tab" data-tabs-target="#styled-report" type="button" role="tab"
                                aria-controls="report" aria-selected="false">
                                Reportes
                            </button>
                        </li>
                        <li class="me-2" role="presentation">
                            <button
                                class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                                id="settings-styled-tab" data-tabs-target="#styled-settings" type="button"
                                role="tab" aria-controls="settings" aria-selected="false">
                                Publicaciones
                            </button>
                        </li>
                    </ul>
                </div>
                <div id="default-styled-tab-content">
                    <div class="hidden p-2 rounded-lg dark:bg-gray-800" id="styled-profile" role="tabpanel"
                        aria-labelledby="profile-tab">
                        <livewire:campaign.campaign.components.timeline :campaign="$campaign->id" />
                    </div>
                    <div class="hidden p-2 rounded-lg dark:bg-gray-800" id="styled-dashboard" role="tabpanel"
                        aria-labelledby="dashboard-tab">
                        <livewire:campaign.campaign.components.statistics :campaign="$campaign->id" />
                    </div>
                    <div class="hidden p-2 rounded-lg dark:bg-gray-800" id="styled-report" role="tabpanel"
                        aria-labelledby="report-tab">
                        <livewire:campaign.campaign.components.statistics :campaign="$campaign->id" />
                    </div>
                    <div class="hidden p-2 rounded-lg  dark:bg-gray-800" id="styled-settings" role="tabpanel"
                        aria-labelledby="settings-tab">
                        <livewire:campaign.campaign.components.publications :campaign="$campaign->id" />
                    </div>
                </div>
            </section>
        </div>
    </x-shared.container>
</div>
