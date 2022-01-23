<aside class="w-full">
    <section class="h-full bg-zinc-800">
        <div class="h-[535px]"></div>
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
                <p class="text-white">Bienvenido, {{ $user->nickname }}!</p>
            @endif
        </div>
    </section>
</aside>
