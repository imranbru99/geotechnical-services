@extends('layouts.app')

@section('title', 'StratumForge Geotech')
@section('meta_description', 'StratumForge Geotech — Foundation investigations, slopes & seismic site class for Puget Sound projects')

@section('content')
<section class="hero">
    <div class="wrap hero-inner">
        <h1>StratumForge<br>Geotech</h1>
        <p>Foundation investigations, slope studies, and seismic site class — so Puget Sound structures sit on recommendations engineers can actually use.</p>
        <div class="hero-ctas">
            <a class="btn btn-primary" href="{{ route('contact') }}">Request investigation</a>
            <a class="btn btn-ghost" href="{{ route('services') }}">View geotech services</a>
        </div>
    </div>
</section>

<section class="section">
    <div class="wrap">
        <h2>Services</h2>
        <p class="lede">From mid-rise foundations to bluff lots — exploration and analysis packages sized for developers, cities, and hillside homeowners.</p>
        <div class="grid-3">
            @foreach([
                ['foundation-investigation','Foundation Investigation','Borings, CPT, and bearing recommendations for shallow and deep foundations.','https://images.unsplash.com/photo-1541888946425-d81bb19240f5?auto=format&fit=crop&w=1600&q=80'],
                ['slope-stability','Slope Stability Analysis','Limit-equilibrium and observational approaches for bluffs, cuts, and landslide-prone lots.','https://images.unsplash.com/photo-1506905925346-21bda4d32df4?auto=format&fit=crop&w=1600&q=80'],
                ['seismic-site-class','Seismic Site Classification','Vs30 estimates and ASCE site class for permitting and structural design.','https://images.unsplash.com/photo-1487958449943-2429e8be8625?auto=format&fit=crop&w=1600&q=80'],
            ] as [$slug,$title,$blurb,$img])
                <a class="service-tile" href="{{ route('services.show', $slug) }}">
                    <img src="{{ $img }}" alt="{{ $title }}">
                    <div class="pad">
                        <h3>{{ $title }}</h3>
                        <p>{{ $blurb }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

<section class="section" style="padding-top:0">
    <div class="wrap">
        <h2>Why StratumForge</h2>
        <p class="lede">Field engineers and analysts who treat subsurface data, design parameters, and construction notes as one deliverable.</p>
        <div class="grid-3">
            <div class="panel">
                <h3>Design-ready parameters</h3>
                <p>Reports include bearing, settlement, and construction notes — not just boring logs.</p>
            </div>
            <div class="panel">
                <h3>Puget Sound fluency</h3>
                <p>Bluffs, glacial soils, and wet-season groundwater are everyday conditions for our crews.</p>
            </div>
            <div class="panel">
                <h3>ERP-run project ops</h3>
                <p>Drilling days, lab tests, invoices, and observation appointments live in one stack.</p>
            </div>
        </div>
    </div>
</section>

<section class="section" style="padding-top:0">
    <div class="wrap">
        <h2>Ops dashboard preview</h2>
        <p class="lede">A glimpse of the StratumForge ERP used to schedule drilling, track lab tests, and close project invoices.</p>
        <div class="dash-preview">
            <div>
                <div class="grid-3" style="grid-template-columns:repeat(3,1fr)">
                    <div class="metric"><strong>19</strong> Active projects</div>
                    <div class="metric"><strong>$312k</strong> Pipeline</div>
                    <div class="metric"><strong>93%</strong> On-time reports</div>
                </div>
                <div class="bars">
                    <span style="height:45%"></span><span style="height:70%"></span><span style="height:55%"></span>
                    <span style="height:85%"></span><span style="height:60%"></span><span style="height:92%"></span>
                    <span style="height:68%"></span>
                </div>
            </div>
            <div>
                <h3 style="font-family:var(--font-display);margin-top:0;font-size:1.4rem">Live modules</h3>
                <ul style="line-height:1.9;padding-left:1.1rem;color:rgba(255,255,255,.86)">
                    <li>Exploration projects & scheduling</li>
                    <li>Lab & tube inventory</li>
                    <li>Invoices & retainers</li>
                    <li>AI content + troubleshooting</li>
                </ul>
                <a class="btn btn-primary" style="margin-top:1rem" href="/admin">Open admin ERP</a>
            </div>
        </div>
    </div>
</section>

<section class="section" style="padding-top:0">
    <div class="wrap">
        <h2>From the boring log</h2>
        <p class="lede">Practical notes for developers, structural engineers, and hillside owners.</p>
        <div class="grid-3">
            @forelse($posts as $post)
                <a class="panel" href="{{ route('blog.show', $post->slug) }}">
                    <h3>{{ $post->title }}</h3>
                    <p>{{ $post->excerpt }}</p>
                </a>
            @empty
                <div class="panel"><p>Blog posts will appear after seeding.</p></div>
            @endforelse
        </div>
    </div>
</section>
@endsection