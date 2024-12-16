@extends('layouts.app')
@section('content')
<style>
.form-group label {
    display: flex;
    align-items: center;
}
.form-group input[type="checkbox"] {
    margin-right: 10px;
}
</style>

<h4>Neues Retrohotel</h4>

<form action="{{ route('admin.retrohotels.store') }}" method="POST">
    @csrf
    <div class="input-field">
        <input type="text" name="name" id="name">
        <label for="name">Name</label>
    </div>
    <div class="input-field">
        <input type="text" name="logo_url" id="logo_url">
        <label for="logo_url">Logo URL</label>
    </div>
    <div class="input-field">
        <input type="number" name="user_count" id="user_count">
        <label for="user_count">User Count</label>
    </div>
    <div class="input-field">
        <input type="text" name="background_url" id="background_url" value="{{ old('background_url') }}">
        <label for="background_url" class="active">Background URL</label>
    </div>
    <div class="input-field">
        <input type="text" name="hotel_link" id="hotel_link" value="{{ old('hotel_link') }}">
        <label for="hotel_link" class="active">Hotel Link (z. B. https://habbo.de)</label>
    </div>
    <div class="form-group">
      <label>
        <input type="checkbox" name="is_retro_of_the_month" id="is_retro_of_the_month" value="1">
        <span>Retro des Monats</span>
      </label>
    </div>
    <div class="form-group">
        <label>
            <input type="checkbox" name="maintenance_mode" id="maintenance_mode" value="1">
            <span>Wartungsarbeiten aktivieren</span>
        </label>
    </div>
    <button class="btn" type="submit">Speichern</button>
</form>
@endsection

