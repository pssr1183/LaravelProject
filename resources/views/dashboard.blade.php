<x-app-layout>
    <x-course :courses="$courses" @props="$courses->toArray()" />
</x-app-layout>