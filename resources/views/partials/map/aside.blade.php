<aside class="w-full">
    <section class="h-full bg-zinc-800">
        <div class="h-[535px] overflow-auto">
            @forelse($map->activities as $activity)
                <p class="text-white py-2 px-4">
                    <b>{{ \Carbon\Carbon::parse($activity->created_at)->format('H:i:s') }}</b>
                    <span class="text-yellow-300">{{ $activity->user->nickname }}</span>
                    {{ $activity->message }}
                </p>
            @empty
                <p class="text-white text-center">This map hasn't activity yet.</p>
            @endforelse
        </div>
        <div class="bg-black text-center pt-2">
            @if(is_null($user))
                <a class="btn btn-red" href="{{ route('discord.login')}}">
                    <i class="fab fa-discord"></i>
                    Login with Discord!
                </a>
            @else
                <img class="h-20 m-auto rounded-full"
                    src="{{ $user->avatar}}"
                    alt="{{ $user->nickname }}"
                    name="{{ $user->nickname }}"/>
                <p class="text-white">Welcome, {{ $user->nickname }}!</p>
            @endif
        </div>
    </section>
</aside>
