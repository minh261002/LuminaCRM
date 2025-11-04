<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit">
        Logoout
    </button>
</form>
