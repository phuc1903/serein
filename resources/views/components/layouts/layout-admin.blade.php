@props(['title' => "Admin Page"])

<x-layouts.layout title="{{$title}}">

    <main class="main-admin container">
        <div class="grid wide">
            <div class="row">
                
                @include('sidebars.admin')

                {{ $slot }}
            </div>
        </div>
    </main>

</x-layouts.layout>