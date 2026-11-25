@extends('layouts.app')
@section('title', 'BedrockForge Services')
@section('content')
<section class="section">
    <div class="wrap">
        <h2>Services</h2>
        <p class="lede">From mid-rise foundations to bluff lots — exploration and analysis packages sized for developers, cities, and hillside homeowners.</p>
        <div class="grid-3">
            @foreach([
                ['foundation-investigation','Foundation Investigation','https://images.unsplash.com/photo-1541888946425-d81bb19240f5?auto=format&fit=crop&w=1600&q=80'],
                ['slope-stability','Slope Stability Analysis','https://images.unsplash.com/photo-1506905925346-21bda4d32df4?auto=format&fit=crop&w=1600&q=80'],
                ['retaining-wall-support','Retaining Wall Design Support','https://images.unsplash.com/photo-1590496793929-36417d3117b4?auto=format&fit=crop&w=1600&q=80'],
                ['pavement-subgrade','Pavement Subgrade Evaluation','https://images.unsplash.com/photo-1515162816999-a0c47dc590f2?auto=format&fit=crop&w=1600&q=80'],
                ['seismic-site-class','Seismic Site Classification','https://images.unsplash.com/photo-1487958449943-2429e8be8625?auto=format&fit=crop&w=1600&q=80'],
                ['construction-observation','Construction Observation','https://images.unsplash.com/photo-1581092162384-8987c1d64718?auto=format&fit=crop&w=1600&q=80'],
            ] as [$slug,$title,$img])
                <a class="service-tile" href="{{ route('services.show', $slug) }}">
                    <img src="{{ $img }}" alt="{{ $title }}">
                    <div class="pad"><h3>{{ $title }}</h3></div>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endsection