@extends('layouts.app')

@section('content')
<h4>Retrohotel bearbeiten</h4>

<form action="{{ route('admin.retrohotels.update', $retrohotel) }}" method="POST">
@csrf
@method('PUT')
<div class="input-field">
  <input type="text" name="name" id="name" value="{{ old('name',$retrohotel->name) }}">
  <label for="name" class="active">Name</label>
</div>
<div class="input-field">
    <input type="text" name="background_url" id="background_url" value="{{ old('background_url', $retrohotel->background_url) }}">
    <label for="background_url" class="active">Background URL</label>
</div>
<div class="input-field">
    <input type="text" name="hotel_link" id="hotel_link" value="{{ old('hotel_link', $retrohotel->hotel_link) }}">
    <label for="hotel_link" class="active">Hotel Link</label>
</div>
<div class="input-field">
  <input type="text" name="logo_url" id="logo_url" value="{{ old('logo_url',$retrohotel->logo_url) }}">
  <label for="logo_url" class="active">Logo URL</label>
</div>
<div class="input-field">
  <input type="number" name="user_count" id="user_count" value="{{ old('user_count',$retrohotel->user_count) }}">
  <label for="user_count" class="active">User Count</label>
</div>
<button class="btn" type="submit">Aktualisieren</button>
@endsection
