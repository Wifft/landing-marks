@extends('layouts.app')

@push('styles')
    <link rel="stylesheet"
        href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin=""/>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css"/>
@endpush

@section('page')
    <main class="grid grid-cols-[20%_80%] mx-auto justify-items-center">
        @include('partials.map.aside')
        @include('partials.map.default')
    </main>
@endsection
