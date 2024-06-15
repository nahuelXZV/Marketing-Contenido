<div>
    <x-shared.container :breadcrumbs="$breadcrumbs">
        <div class="relative overflow-hidden bg-white  dark:bg-gray-800 sm:rounded-lg">
            <div class="flex-row items-center justify-between p-4 space-y-3 sm:flex sm:space-y-0 sm:space-x-4">
                <div>
                    <h5 class="mr-3 text-lg font-bold dark:text-white uppercase">Datos de la empresa</h5>
                </div>
                <button wire:click="save" type="button"
                    class="w-min flex items-center justify-center px-4 py-2 text-sm font-medium text-white rounded-lg bg-fondo hover:bg-primary-900 focus:ring-4 focus:ring-fondo dark:bg-fondo dark:hover:bg-primary-900 focus:outline-none dark:focus:ring-primary-800">
                    Guardar
                </button>
            </div>
        </div>

        <div class="max-w px-4 py-8 mx-auto">
            <div class="grid gap-4 mb-4 sm:grid-cols-3 sm:gap-6 sm:mb-5">
                <div class="col-span-1">
                    <div class="flex items-center justify-center rounded-full font-bold mb-2">
                        <p class="text-black text-lg font-bold text-center uppercase">Recursos de la empresa</p>
                    </div>

                    <div class=" items center justify-center grid grid-rows-1 border border-sm p-2">
                        <div class="flex items-center justify-center  rounded-full font-bold mb-2">
                            <p class="text-black text-center">Foto de la empresa</p>
                        </div>
                        @if ($company->foto)
                            <img src="{{ asset($company->foto) }}" alt="foto" class="w-auto h-28 ">
                        @elseif ($foto)
                            <img src="{{ $foto->temporaryUrl() }}" alt="foto" class="w-auto h-28 ">
                        @endif
                    </div>
                    <br>
                    <div class=" items center justify-center grid grid-rows-1  border border-sm p-2">
                        <div class="flex items-center justify-center rounded-full font-bold mb-2">
                            <p class="text-black text-center">Logo de la empresa</p>
                        </div>
                        @if ($company->logo)
                            <img src="{{ asset($company->logo) }}" alt="logo" class="w-auto h-28 ">
                        @elseif ($logo)
                            <img src="{{ $logo->temporaryUrl() }}" alt="logo" class="w-auto h-28 ">
                        @endif
                    </div>
                </div>
                <section class="col-span-2">
                    <div class="grid gap-4 mb-4 sm:grid-cols-3 sm:gap-6 sm:mb-5">
                        <div class="col-span-3 sm:col-span-3">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre
                            </label>
                            <input type="text" wire:model="companyArray.nombre"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Nombre" required="">
                            @error('companyArray.nombre')
                                <x-shared.validate-error :message="$message" />
                            @enderror
                        </div>

                        <div class="col-span-3 sm:col-span-1">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Correo
                            </label>
                            <input type="email" wire:model="companyArray.correo"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Correo" required="">
                            @error('companyArray.correo')
                                <x-shared.validate-error :message="$message" />
                            @enderror
                        </div>
                        <div class="col-span-3 sm:col-span-1">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Telefono
                            </label>
                            <input type="text" wire:model="companyArray.telefono"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Telefono" required="">
                            @error('companyArray.telefono')
                                <x-shared.validate-error :message="$message" />
                            @enderror
                        </div>
                        <div class="col-span-3 sm:col-span-3">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Direccion
                            </label>
                            <input type="text" wire:model="companyArray.direccion"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Direccion" required="">
                            @error('companyArray.direccion')
                                <x-shared.validate-error :message="$message" />
                            @enderror
                        </div>

                        <div class="col-span-3 sm:col-span-1">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Subir Foto
                            </label>
                            <input type="file" wire:model.blur="foto" accept="image/*"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            @error('foto')
                                <x-shared.validate-error :message="$message" />
                            @enderror
                        </div>
                        <div class="col-span-3 sm:col-span-1">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Subir Logo
                            </label>
                            <input type="file" wire:model.blur="logo" accept="image/*"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            @error('foto')
                                <x-shared.validate-error :message="$message" />
                            @enderror
                        </div>
                        <x-shared.space />

                        <div class="col-span-3 sm:col-span-3">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Slogan de la
                                empresa
                            </label>
                            <input type="text" wire:model="companyArray.slogan"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Slogan..." required="">
                            @error('companyArray.slogan')
                                <x-shared.validate-error :message="$message" />
                            @enderror
                        </div>

                        <div class="sm:col-span-3">
                            <label for="description"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pequeña
                                descripcion
                                de
                                la empresa</label>
                            <textarea id="description" rows="3" wire:model="companyArray.descripcion"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Descripcion..."></textarea>
                            @error('companyArray.descripcion')
                                <x-shared.validate-error :message="$message" />
                            @enderror
                        </div>

                        <div class="rounded-full font-bold mb-2">
                            <p class="text-black text-lg font-bold uppercase">Credenciales Meta</p>
                        </div>

                        <div class="col-span-3 sm:col-span-3">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Token de acceso
                            </label>
                            <input type="password" wire:model="companyArray.meta_access_token"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="######################" required="">
                            @error('companyArray.meta_access_token')
                                <x-shared.validate-error :message="$message" />
                            @enderror
                        </div>

                        <div class="col-span-3 sm:col-span-3">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Identificador de
                                la pagina
                            </label>
                            <input type="text" wire:model="companyArray.meta_page_id_meta"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="##################" required="">
                            @error('companyArray.meta_page_id_meta')
                                <x-shared.validate-error :message="$message" />
                            @enderror
                        </div>

                        <div class="col-span-3 sm:col-span-3">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Identificador
                                de la aplicacion
                            </label>
                            <input type="text" wire:model="companyArray.meta_app_id_meta"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="######################" required="">
                            @error('companyArray.meta_app_id_meta')
                                <x-shared.validate-error :message="$message" />
                            @enderror
                        </div>
                        <div class="col-span-3 sm:col-span-3">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Codigo secreto
                                de la aplicacion
                            </label>
                            <input type="password" wire:model="companyArray.meta_app_secret"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="######################" required="">
                            @error('companyArray.meta_app_secret')
                                <x-shared.validate-error :message="$message" />
                            @enderror
                        </div>

                    </div>
                </section>

            </div>
        </div>
    </x-shared.container>
</div>
