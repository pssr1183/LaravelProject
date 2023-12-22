<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Courseaaaa') }}
        </h2>
    </x-slot>
    <x-course :courses="$courses" @props="$courses->toArray()" />
</x-app-layout>