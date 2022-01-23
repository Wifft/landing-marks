<script>
    const user = JSON.parse(`{!! $user !!}`);
</script>
<script src="{{ asset('js/app.js')}}"></script>
@stack('scripts')
