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
