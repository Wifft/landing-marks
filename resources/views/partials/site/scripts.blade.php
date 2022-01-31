<script>
    const user = {!! json_encode($user) !!};
    const mapId = {{ $map->id }};
    const saveMarkUri = "{{ route('api.maps.storeUserMark') }}";
    const deleteMarkUri = "{{ route('api.maps.deleteUserMark') }}";
    const storeUserActivityUri = "{{ route('api.userActivities.store') }}";
    const mapUsersData = {!! json_encode($map->discordUsers) !!};
</script>
<script src="{{ asset('js/app.js')}}"></script>
@stack('scripts')
