@extends('layouts.app')

@php($user = null)

@section('page')
    <header class="text-center my-4">
        <h1 class="text-yellow-600 text-4xl font-bold">Landing Marks</h1>
    </header>
    <main class="m-8">
        <section class="grid md:grid-cols-4 grid-cols-1 gap-4">
            @foreach ($maps as $map)
                <article class="border-yellow-600 border-2 text-white text-center py-8 px-4 rounded font-bold">
                    <h2 class="pb-2">{{ $map->title }}</h2>
                    <hr class="border-yellow-600 my-4"/>
                    <span class="py-2">
                        {{ \Carbon\Carbon::parse($map->updated_at)->format('Y-m-d H:i:s') }}
                        |
                        {{ $map->discordUsers()->whereNotNull('marker_data')->count() }} markers
                    </span>
                    <a class="block border-yellow-600 border-2 hover:bg-yellow-600 p-2 my-4 rounded"
                        href="{{ route('map.show', ['uuid' => $map->uuid]) }}">
                        Go to map
                    </a>
                </article>
            @endforeach
        </section>
    </main>
@endsection
