@extends('layouts.admin')

@section('content')
<h5>Team verwalten</h5>
<a href="{{ route('admin.team_members.create') }}" class="btn">Neu</a>
<table class="striped" style="margin-top:20px;">
<thead>
<tr><th>Name</th><th>Titel</th><th>Bild</th><th>Aktionen</th></tr>
</thead>
<tbody>
@foreach($members as $m)
<tr>
    <td>{{ $m->name }}</td>
    <td>{{ $m->title }}</td>
    <td>
        @if($m->image_url)
            <img src="{{ $m->image_url }}" alt="{{ $m->name }}" style="width:50px;height:50px;object-fit:cover;border-radius:50%;">
        @endif
    </td>
    <td>
        <a href="{{ route('admin.team_members.edit',$m) }}" class="btn blue">Bearbeiten</a>
        <form action="{{ route('admin.team_members.destroy',$m) }}" method="POST" style="display:inline;">
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
