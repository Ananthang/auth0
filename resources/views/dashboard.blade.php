<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <img src="{{Auth::user()->avatar}}" alt="{{Auth::user()->name}}">
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h3>Hello {{Auth::user()->name}}</h3>
        </div>
    </div>
</x-app-layout>
