<x-app-layout>

    <style>
        #iframecontainer {
            width: 100%;
            height: 80vh;
        }
    </style>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ivóvíz mintavételi pontok') }}
        </h2>
    </x-slot>

    <iframe id="iframecontainer" src="https://www.google.com/maps/d/embed?mid=1gD1S9UeSE7R5SlHLbLYXmrl3VR9BVA8&ehbc=2E312F"></iframe>

</x-app-layout>
