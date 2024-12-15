@extends('layouts.app')

@section('content')
<h3>Retrohotels verwalten</h3>
<a href="{{ route('admin.retrohotels.create') }}" class="btn">Neu</a>
<table class="striped">
<thead>
<tr><th>Name</th><th>User Count</th><th>Aktionen</th></tr>
</thead>
<tbody>
@foreach($retrohotels as $r)
<tr>
  <td>{{ $r->name }}</td>
  <td>{{ $r->user_count }}</td>
  <td>
    <a href="{{ route('admin.retrohotels.edit', $r) }}" class="btn">Bearbeiten</a>
    <form action="{{ route('admin.retrohotels.destroy', $r) }}" method="POST" style="display:inline;">
      @csrf
      @method('DELETE')
      <button class="btn red" onclick="return confirm('Sicher löschen?')">Löschen</button>
    </form>
  </td>
</tr>
@endforeach
</tbody>
</table>
@endsection
