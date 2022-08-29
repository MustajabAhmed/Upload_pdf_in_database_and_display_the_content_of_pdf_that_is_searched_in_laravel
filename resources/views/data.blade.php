@foreach ($file as $file)
<h2>Content Find in File:</h2>
{{ $file->orig_filename }}
<h3>Content of file:</h3>
{{-- <a href="{{ url('highlighted') }}">{{ $file->orig_filename }}</a> --}}
{{ $file->content }}
<hr>
@endforeach