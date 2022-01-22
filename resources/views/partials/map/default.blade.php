<section>
    <div id="map" style="width:900px;height:676px;margin:auto;"></div>
</section>
<section>
    @if(!session()->has('discord_id') || !session()->has('discord_nickname'))
        <a href="{{ route('discord.login')}}">Login with Discord!</a>
    @else
        Bienvenido, {{ session()->get('discord_nickname') }}!
    @endif
</section>
