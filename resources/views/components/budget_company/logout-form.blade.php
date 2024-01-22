<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="tracking-widest myTextColor2">
        Logout
    </button>
</form>
