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

    .retro-card {
        border: none;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        margin-bottom: 20px;
        background: transparent; /* keine Hintergrundfarbe für die gesamte Karte */
    }

    .retro-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.12);
    }

    .card-header {
        position: relative;
        height: 180px;
        overflow: hidden;
    }

    .card-header .card-bg {
        position: absolute;
        top:0; left:0; right:0; bottom:0;
        background-position: center;
        background-size: cover;
        filter: blur(3px);
        /* Kein z-index: -1 hier */
    }

    .card-header .logo {
        position: absolute;
        top:50%; left:50%;
        transform: translate(-50%,-50%);
        max-width: 80%;
        max-height: 80%;
        z-index: 1; /* Logo liegt über dem geblurten Hintergrund */
    }

    .card-content {
        padding: 15px;
        background: #fff; /* Weißer Hintergrund nur im unteren Bereich */
    }

    .card-title {
        font-size: 1.4rem;
        font-weight: 600;
        margin-bottom: 10px;
    }

    .user-tag {
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
        padding: 8px 15px;
        background: #1565c0;
        color: #fff;
        text-decoration: none;
        border-radius: 8px;
        font-weight: 500;
        transition: background 0.3s ease;
    }

    .hotel-btn:hover {
        background: #0d47a1;
    }
</style>

<div class="sort-links">
    <span>Sortierung:</span>
    <a href="{{ route('retroliste', ['sort'=>'asc']) }}">Aufsteigend</a> |
    <a href="{{ route('retroliste', ['sort'=>'desc']) }}">Absteigend</a>
</div>

<div class="row">
    @foreach($retrohotels as $r)
    <div class="col s12 m4">
        <div class="card retro-card">
            <div class="card-header">
                <!-- Hintergrundbild jetzt über .card-bg ohne z-index Probleme -->
                <div class="card-bg" style="background-image: url('{{ $r->background_url ?? "https://habborator.org/hotels/view_es_wide.gif" }}');"></div>
                <img src="{{ $r->logo_url }}" alt="{{ $r->name }}" class="logo">
            </div>
            <div class="card-content">
                <span class="card-title">{{ $r->name }}</span>
                <span class="user-tag">{{ $r->user_count }} User</span>
                @if($r->hotel_link)
                    <div>
                        <a href="{{ $r->hotel_link }}" class="hotel-btn" target="_blank" rel="noopener noreferrer">Ins {{ $r->name }}</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
