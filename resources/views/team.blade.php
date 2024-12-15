@extends('layouts.app')

@section('content')
<style>
.team-container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
}
.team-card {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    width: 200px;
    padding:20px;
    text-align:center;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
body.dark-mode .team-card {
    background: #333;
    color: #ddd;
}
.team-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.12);
}
.team-card img {
    width:100px;
    height:100px;
    object-fit:cover;
    border-radius:50%;
    margin-bottom:10px;
}
.team-card .team-name {
    font-size:1.2rem;
    font-weight:600;
    margin-bottom:5px;
}
.team-card .team-title {
    font-size:0.9rem;
    color:#555;
}
body.dark-mode .team-card .team-title {
    color:#ccc;
}
</style>

<div class="team-container">
@foreach($members as $m)
    <div class="team-card">
        @if($m->image_url)
            <img src="{{ $m->image_url }}" alt="{{ $m->name }}">
        @else
            <img src="https://via.placeholder.com/100" alt="{{ $m->name }}">
        @endif
        <div class="team-name">{{ $m->name }}</div>
        @if($m->title)
            <div class="team-title">{{ $m->title }}</div>
        @endif
    </div>
@endforeach
</div>
@endsection
