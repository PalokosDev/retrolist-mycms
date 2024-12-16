@extends('layouts.app')

@section('content')
<style>
    .form-group label {
        display: flex;
        align-items: center;
    }
    .form-group input[type="checkbox"] {
        margin-right: 10px;
        width: 18px;
        height: 18px;
    }
</style>

<h4>Retrohotel bearbeiten</h4>

<form action="{{ route('admin.retrohotels.update', $retrohotel) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="input-field">
        <input type="text" name="name" id="name" value="{{ old('name', $retrohotel->name) }}">
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
        <input type="text" name="logo_url" id="logo_url" value="{{ old('logo_url', $retrohotel->logo_url) }}">
        <label for="logo_url" class="active">Logo URL</label>
    </div>
    <div class="form-group">
        <input type="hidden" name="is_retro_of_the_month" value="0">
        <label>
        <input type="checkbox" name="is_retro_of_the_month" id="is_retro_of_the_month" value="1"
               {{ old('is_retro_of_the_month', $retrohotel->is_retro_of_the_month) ? 'checked' : '' }}>
        <span>Retro des Monats</span>
        </label>
    </div>
    <div class="input-field">
        <input type="number" name="user_count" id="user_count" value="{{ old('user_count', $retrohotel->user_count) }}">
        <label for="user_count" class="active">User Count</label>
    </div>
    <div class="form-group">
        <!-- Hidden Input to handle unchecked checkbox -->
        <input type="hidden" name="maintenance_mode" value="0">
        <label>
            <input type="checkbox" name="maintenance_mode" id="maintenance_mode" value="1" 
                   {{ old('maintenance_mode', $retrohotel->maintenance_mode) ? 'checked' : '' }}>
            <span>Wartungsarbeiten aktivieren</span>
        </label>
    </div>
    <button class="btn" type="submit">Aktualisieren</button>
</form>
@endsection
