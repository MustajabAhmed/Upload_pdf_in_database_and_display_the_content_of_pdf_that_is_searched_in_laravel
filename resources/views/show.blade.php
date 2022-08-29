@if (Session::has('success'))
{{-- <x-success> --}}
    {{ session()->get('success') }}
    <br><br>
    {{--
</x-success> --}}
@endif

<form action="{{ url('find') }}">
    <input type="text" name="search" id="search" placeholder="Search Here">
    <input type="submit" value="Click Here to Search">
</form>