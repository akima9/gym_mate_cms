<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            GYM 등록
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-end">
                        <x-secondary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'mass-register-gym')">대량등록</x-secondary-button>
                    </div>
                    <x-modal name='mass-register-gym'>
                        <form action="{{route('gyms.massStore')}}" method="post" class="p-6" enctype="multipart/form-data">
                            @csrf
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('GYM 대량 등록') }}
                            </h2>
                            
                            <div class="mt-4">
                                <label class="block">
                                    <x-input-label for="csvUpload" :value="__('CSV 파일 업로드')" />
                                    <input type="file" name="csvUpload" id="csvUpload" accept=".csv" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100 mt-1"/>
                                </label>
                            </div>

                            <div class="mt-4 flex justify-end">
                                <x-primary-button>{{ __('등록') }}</x-primary-button>
                            </div>
                        </form>
                    </x-modal>
                    <form action="{{route('gyms.store')}}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <x-input-label for="title" :value="__('GYM 이름')" />
                            <x-text-input :value="old('title')" id="title" name="title" type="text" class="mt-1 block w-full" required autofocus autocomplete="title" />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>
                        <div class="mb-4">
                            <x-input-label for="address" :value="__('GYM 주소')" />
                            <x-text-input :value="old('address')" id="address" name="address" type="text" class="mt-1 block w-full" required autofocus autocomplete="address" />
                            <x-input-error class="mt-2" :messages="$errors->get('address')" />
                        </div>
                        <x-primary-button>{{ __('등록') }}</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
