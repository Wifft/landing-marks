<script>
    const user = {!! json_encode($user) !!};
    const mapId = {{ $map->id }};
    const saveMarkUri = "{{ route('api.maps.storeUserMark') }}";
    const mapUsersData = {!! json_encode($map->discordUsers) !!};
</script>
<script src="{{ asset('js/app.js')}}"></script>
@stack('scripts')
