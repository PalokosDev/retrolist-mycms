@extends('layouts.admin')

@section('content')
<h5>Neues Teammitglied</h5>

<form action="{{ route('admin.team_members.store') }}" method="POST">
@csrf
<div class="input-field">
    <input type="text" name="name" id="name" required value="{{ old('name') }}">
    <label for="name" class="active">Name</label>
</div>
<div class="input-field">
    <input type="text" name="title" id="title" value="{{ old('title') }}">
    <label for="title" class="active">Titel</label>
</div>
<div class="input-field">
    <input type="text" name="image_url" id="image_url" value="{{ old('image_url') }}">
    <label for="image_url" class="active">Bild URL</label>
</div>

<button class="btn green" type="submit">Speichern</button>
<a href="{{ route('admin.team_members.index') }}" class="btn grey">Abbrechen</a>
</form>
@endsection
