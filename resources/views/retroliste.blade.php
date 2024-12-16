@extends('layouts.app')

@section('content')
<style>
    .sort-links {
        text-align: center;
        margin-bottom: 30px;
    }
    .sort-links a {
        color: #1565c0;
        margin: 0 10px;
        font-weight: 500;
        transition: color 0.2s ease;
        text-decoration: none;
    }
    .sort-links a:hover {
        color: #0d47a1;
    }

    /* Retro des Monats Styling */
    .retro-feature {
        display: flex;
        align-items: center;
        background-size: cover;
        background-position: center;
        color: white;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.3);
        margin-bottom: 30px;
        height: 300px;
        position: relative;
        border: 5px solid gold; /* Goldene Umrandung */
    }

    .retro-feature .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.4);
        border-radius: 12px;
        z-index: 1; /* Hintergrund bleibt hinter den Inhalten */
    }

    .retro-feature .left,
    .retro-feature .right {
        position: relative;
        z-index: 2; /* Inhalte auf einer höheren Ebene */
    }

    .retro-feature .left {
        flex: 1;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .retro-feature .right {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: flex-start;
        padding-left: 20px;
    }

    .retro-feature .logo {
        max-width: 150px;
        max-height: 150px;
    }

    .retro-feature h2 {
        color: #f5f5f5; /* Heller Text */
        font-size: 1.8rem;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .retro-feature .user-tag {
        display: inline-block;
        background: #eee;
        color: #333;
        padding: 5px 10px;
        border-radius: 15px;
        font-size: 0.9rem;
        font-weight: 500;
        margin-top: 10px;
    }

    /* Tooltip für Retro des Monats */
    .retro-feature-tooltip {
        position: absolute;
        top: -10px;
        right: -10px;
        background: gold;
        color: black;
        padding: 5px 10px;
        border-radius: 15px;
        font-weight: bold;
        font-size: 0.8rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        z-index: 3; /* Tooltip ist immer sichtbar */
    }

    /* Kartenstil */
    .retro-cards .retro-card {
        border: none;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        margin-bottom: 20px;
        background: #fff;
        position: relative;
    }

    .retro-cards .retro-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.12);
    }

    .retro-cards .card-header {
        position: relative;
        height: 180px;
        background-size: cover;
        background-position: center;
    }

    .retro-cards .card-header .logo {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        max-width: 80%;
        max-height: 80%;
        z-index: 2; /* Logo bleibt sichtbar */
    }

    .retro-cards .user-tag {
        display: inline-block;
        background: #eee;
        padding: 5px 10px;
        border-radius: 15px;
        font-size: 0.9rem;
        font-weight: 500;
        color: #333;
        margin-top: 10px;
    }

    .hotel-btn {
        display: inline-block;
        margin-top: 15px;
        padding: 5px 10px;
        background: green;
        color: white;
        text-decoration: none;
        border-radius: 15px;
        font-weight: 500;
        font-size: 0.9rem;
        transition: background 0.3s ease;
    }

    .hotel-btn:hover {
        background: darkgreen;
    }
</style>

<div class="sort-links">
    <span>Sortierung:</span>
    <a href="{{ route('retroliste', ['sort'=>'asc']) }}">Aufsteigend</a> |
    <a href="{{ route('retroliste', ['sort'=>'desc']) }}">Absteigend</a>
</div>

{{-- Retro des Monats --}}
@php
    $retroOfTheMonth = $retrohotels->where('is_retro_of_the_month', true)->first();
@endphp

@if($retroOfTheMonth)
    <div class="retro-feature" style="background-image: url('{{ $retroOfTheMonth->background_url ?? "https://habborator.org/hotels/view_es_wide.gif" }}');">
        <div class="overlay"></div>
        <span class="retro-feature-tooltip">Retro des Monats</span>
        <div class="left">
            <img src="{{ $retroOfTheMonth->logo_url }}" alt="{{ $retroOfTheMonth->name }}" class="logo">
        </div>
        <div class="right">
            <h2>{{ $retroOfTheMonth->name }}</h2>
            <span class="user-tag">{{ $retroOfTheMonth->user_count }} User</span>
            <a href="{{ $retroOfTheMonth->hotel_link }}" class="hotel-btn" target="_blank" rel="noopener noreferrer">
                Ins {{ $retroOfTheMonth->name }}
            </a>
        </div>
    </div>
@endif

{{-- Alle anderen Hotels --}}
<div class="row retro-cards">
    @foreach($retrohotels->where('is_retro_of_the_month', false) as $r)
    <div class="col s12 m4">
        <div class="card retro-card">
            <div class="card-header" style="background-image: url('{{ $r->background_url ?? "https://habborator.org/hotels/view_es_wide.gif" }}');">
                <img src="{{ $r->logo_url }}" alt="{{ $r->name }}" class="logo">
            </div>
            <div class="card-content">
                <h3 class="card-title">{{ $r->name }}</h3>
                <span class="user-tag">{{ $r->user_count }} User</span>
                <a href="{{ $r->hotel_link }}" class="hotel-btn" target="_blank" rel="noopener noreferrer">
                    Ins {{ $r->name }}
                </a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
