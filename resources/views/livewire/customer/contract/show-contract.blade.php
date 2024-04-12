<div>
    <x-shared.container :breadcrumbs="$breadcrumbs">
        <div class="relative overflow-hidden bg-white  dark:bg-gray-800 sm:rounded-lg">
            <div class="flex-row items-center justify-between p-4 space-y-3 sm:flex sm:space-y-0 sm:space-x-4">
                <div>
                    <h5 class="mr-3 text-lg font-bold dark:text-white uppercase">
                        {{ $customer->nombre . ' ' . $customer->apellido }}
                    </h5>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Datos del contrato</p>
                </div>
                <div class="flex items-center space-x-3">
                    <x-shared.button-header title="Volver" route="customer.show" :params="[$customer->id]" />
                    <x-shared.button-header title="Editar" route="contract.edit" :params="[$contract->id]" />
                    @if ($contract->documento)
                        <x-shared.button-header title="Descargar documento" :route="$contract->documento" type='download' />
                    @endif
                </div>
            </div>
        </div>

        <div class="max-w px-4 py-8 mx-auto">
            <section>
                <div class="grid gap-4 mb-4 sm:grid-cols-3 sm:gap-6 sm:mb-5">
                    <x-shared.input-readonly title="Codigo" :value="$contract->codigo" col='1' />
                    <x-shared.input-readonly title="Costo" :value="$contract->costo" col='1' />

                    <x-shared.input-readonly title="Tipo de contrato" :value="$contract->tipo_contrato" />
                    <x-shared.input-readonly title="Detalle de pago" :value="$contract->detalle_pago" />
                    <x-shared.input-readonly title="Estado de pago" :value="$contract->estado_pago" />

                    <x-shared.input-readonly title="Estado de contrato" :value="$contract->estado_contrato" />
                    <x-shared.input-readonly title="Fecha de inicio" :value="\Carbon\Carbon::parse($contract->fecha_inicio)->format('d/m/Y')" />
                    <x-shared.input-readonly title="Fecha de final" :value="\Carbon\Carbon::parse($contract->fecha_final)->format('d/m/Y')" />
                    @if ($contract->condiciones)
                        <x-shared.text-area-readonly title="Condiciones" :value="$contract->condiciones" col='3' />
                    @endif
                    @if ($contract->descripcion)
                        <x-shared.text-area-readonly title="Descripcion" :value="$contract->descripcion" col='3' />
                    @endif

                </div>
            </section>
        </div>
    </x-shared.container>
</div>
