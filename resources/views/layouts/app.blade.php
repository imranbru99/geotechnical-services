<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'StratumForge Geotech') — Puget Sound Geotechnical Engineering</title>
    <meta name="description" content="@yield('meta_description', 'StratumForge Geotech delivers subsurface explorations, foundation recommendations, slope stability, and construction observation across Seattle, Bellevue, Tacoma, Everett & the Puget Sound.')">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700&family=Syne:wght@600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --navy: #1B2A41;
            --granite: #3D5A80;
            --mist: #E0E7EF;
            --ink: #0D1520;
            --copper: #B87333;
            --copper-bright: #C98A4A;
            --font-display: "Syne", sans-serif;
            --font-body: "Manrope", sans-serif;
        }
        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            margin: 0; font-family: var(--font-body); color: var(--ink);
            background:
                radial-gradient(1000px 480px at 95% -5%, rgba(184,115,51,.14), transparent 55%),
                radial-gradient(780px 420px at 0% 20%, rgba(61,90,128,.16), transparent 50%),
                linear-gradient(180deg, #f4f7fa 0%, var(--mist) 45%, #d5deea 100%);
            min-height: 100vh;
        }
        a { color: inherit; text-decoration: none; }
        .wrap { width: min(1120px, calc(100% - 2rem)); margin-inline: auto; }
        .site-header { position: sticky; top: 0; z-index: 40; backdrop-filter: blur(12px); background: rgba(27,42,65,.94); border-bottom: 1px solid rgba(184,115,51,.28); }
        .nav { display: flex; align-items: center; justify-content: space-between; padding: .95rem 0; gap: 1rem; }
        .brand { font-family: var(--font-display); font-size: 1.25rem; letter-spacing: -0.02em; font-weight: 800; color: #fff; }
        .brand span { color: var(--copper); }
        .nav-links { display: flex; flex-wrap: wrap; gap: .9rem 1.1rem; align-items: center; }
        .nav-links a { color: rgba(255,255,255,.82); font-size: .95rem; font-weight: 500; }
        .nav-links a:hover { color: #fff; }
        .btn { display: inline-flex; align-items: center; justify-content: center; gap: .4rem; padding: .8rem 1.25rem; border-radius: .45rem; font-weight: 700; border: 0; cursor: pointer; transition: transform .2s ease, background .2s ease; }
        .btn:hover { transform: translateY(-2px); }
        .btn-primary { background: var(--copper); color: #fff; box-shadow: 0 10px 28px rgba(184,115,51,.28); }
        .btn-primary:hover { background: #9a6029; }
        .btn-ghost { background: transparent; color: #fff; border: 1px solid rgba(255,255,255,.35); }
        .btn-dark { background: var(--ink); color: #fff; }
        .hero { min-height: calc(100vh - 68px); display: grid; align-items: end; position: relative; overflow: hidden; color: #fff;
            background: linear-gradient(105deg, rgba(13,21,32,.92) 0%, rgba(27,42,65,.72) 48%, rgba(13,21,32,.35) 100%),
                url('https://images.unsplash.com/photo-1541888946425-d81bb19240f5?auto=format&fit=crop&w=2000&q=80') center/cover no-repeat; }
        .hero-inner { padding: 5rem 0 3.75rem; max-width: 640px; animation: rise .85s ease both; }
        .hero h1 { font-family: var(--font-display); font-size: clamp(2.6rem, 6vw, 4.3rem); line-height: 1.02; margin: 0 0 1rem; letter-spacing: -0.03em; }
        .hero p { font-size: 1.08rem; line-height: 1.6; color: rgba(255,255,255,.9); margin: 0 0 1.5rem; max-width: 36rem; }
        .hero-ctas { display: flex; flex-wrap: wrap; gap: .75rem; }
        .eyebrow { color: var(--copper); font-weight: 700; letter-spacing: .08em; text-transform: uppercase; font-size: .75rem; }
        .section { padding: 4.5rem 0; }
        .section h2 { font-family: var(--font-display); font-size: clamp(1.9rem, 3.5vw, 2.7rem); margin: 0 0 .75rem; letter-spacing: -.02em; }
        .lede { color: var(--granite); max-width: 40rem; line-height: 1.6; margin: 0 0 2rem; }
        .grid-3 { display: grid; gap: 1.25rem; grid-template-columns: repeat(3, minmax(0, 1fr)); }
        .grid-2 { display: grid; gap: 1.5rem; grid-template-columns: repeat(2, minmax(0, 1fr)); }
        .service-tile { position: relative; overflow: hidden; min-height: 280px; color: #fff; isolation: isolate; border-radius: .55rem; }
        .service-tile img { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; z-index: -2; transition: transform .6s ease; }
        .service-tile:hover img { transform: scale(1.06); }
        .service-tile::after { content: ""; position: absolute; inset: 0; z-index: -1; background: linear-gradient(180deg, transparent 25%, rgba(13,21,32,.92)); }
        .service-tile .pad { position: absolute; left: 0; right: 0; bottom: 0; padding: 1.3rem; }
        .service-tile h3 { margin: 0 0 .35rem; font-family: var(--font-display); }
        .service-tile p { margin: 0; color: rgba(255,255,255,.85); font-size: .92rem; }
        .panel { background: rgba(255,255,255,.78); border: 1px solid rgba(13,21,32,.06); padding: 1.4rem; border-radius: .55rem; }
        .panel h3 { margin: 0 0 .5rem; font-family: var(--font-display); }
        .dash-preview { display: grid; gap: 1rem; grid-template-columns: 1.2fr .8fr; background: var(--ink); color: #fff; padding: 1.5rem; border-radius: .65rem; overflow: hidden; }
        .metric { padding: 1rem; background: rgba(255,255,255,.05); border: 1px solid rgba(255,255,255,.08); border-radius: .45rem; }
        .metric strong { display: block; font-size: 1.6rem; color: var(--copper-bright); font-family: var(--font-display); }
        .bars { display: flex; align-items: end; gap: .45rem; height: 140px; margin-top: 1rem; }
        .bars span { flex: 1; border-radius: 4px 4px 0 0; background: linear-gradient(180deg, var(--copper-bright), var(--granite)); animation: grow .9s ease both; }
        form.stack { display: grid; gap: .85rem; }
        label { font-weight: 600; font-size: .9rem; }
        input, textarea, select { width: 100%; padding: .8rem .9rem; border: 1px solid rgba(13,21,32,.14); background: #fff; font: inherit; border-radius: .45rem; }
        .flash { background: rgba(61,90,128,.12); border: 1px solid rgba(61,90,128,.35); color: var(--navy); padding: .9rem 1rem; margin-bottom: 1rem; border-radius: .45rem; }
        .site-footer { background: var(--ink); color: rgba(255,255,255,.78); padding: 2.5rem 0; margin-top: 2rem; }
        .wa-float { position: fixed; right: 1.1rem; bottom: 1.1rem; z-index: 50; width: 56px; height: 56px; border-radius: 999px; display: grid; place-items: center; background: #25d366; color: #fff; font-weight: 800; box-shadow: 0 12px 28px rgba(0,0,0,.25); animation: pulse 2.4s ease infinite; }
        .chat-widget { position: fixed; left: 1.1rem; bottom: 1.1rem; z-index: 50; width: min(360px, calc(100vw - 2rem)); }
        .chat-toggle { background: var(--navy); color: #fff; border: 0; padding: .8rem 1rem; font-weight: 700; cursor: pointer; width: 100%; border-radius: .45rem; }
        .chat-panel { display: none; background: #fff; border: 1px solid rgba(13,21,32,.1); box-shadow: 0 18px 40px rgba(13,21,32,.18); overflow: hidden; border-radius: .55rem; margin-bottom: .55rem; }
        .chat-panel.open { display: block; animation: rise .25s ease; }
        .chat-log { height: 240px; overflow: auto; padding: .9rem; background: var(--mist); }
        .bubble { margin: .4rem 0; padding: .65rem .75rem; border-radius: .5rem; max-width: 90%; font-size: .9rem; line-height: 1.4; white-space: pre-wrap; }
        .bubble.bot { background: #fff; border: 1px solid rgba(13,21,32,.08); }
        .bubble.user { background: var(--ink); color: #fff; margin-left: auto; }
        .chat-form { display: flex; gap: .4rem; padding: .65rem; }
        .chat-form input { flex: 1; }
        .page-hero { padding: 3.5rem 0 1.5rem; background: linear-gradient(135deg, #c9d5e4, var(--mist) 55%, #e8d9c8); }
        @keyframes rise { from { opacity: 0; transform: translateY(16px); } to { opacity: 1; transform: none; } }
        @keyframes grow { from { transform: scaleY(.2); transform-origin: bottom; } to { transform: scaleY(1); } }
        @keyframes pulse { 0%,100% { transform: scale(1); } 50% { transform: scale(1.05); } }
        @media (max-width: 900px) {
            .grid-3, .grid-2, .dash-preview { grid-template-columns: 1fr; }
            .nav-links { display: none; }
            .hero { min-height: 78vh; }
        }
    </style>
    @stack('head')
</head>
<body>
<header class="site-header">
    <div class="wrap nav">
        <a class="brand" href="{{ route('home') }}">Stratum<span>Forge</span> Geotech</a>
        <nav class="nav-links">
            <a href="{{ route('services') }}">Services</a>
            <a href="{{ route('about') }}">About</a>
            <a href="{{ route('blog') }}">Journal</a>
            <a href="{{ route('knowledge') }}">Knowledge</a>
            <a href="{{ route('contact') }}">Contact</a>
            <a class="btn btn-primary" href="{{ route('contact') }}">Request a boring</a>
        </nav>
    </div>
</header>
<main>@yield('content')</main>
<footer class="site-footer">
    <div class="wrap">
        <div class="brand" style="color:#fff;margin-bottom:.5rem;">Stratum<span>Forge</span> Geotech</div>
        <p>Seattle · Bellevue · Tacoma · Everett — geotechnical engineering across the Puget Sound.</p>
        <p style="margin-top:1rem;font-size:.9rem;">(206) 555-0177 · hello@stratumforgegeotech.com · <a href="/admin" style="color:var(--copper-bright)">Admin ERP</a></p>
    </div>
</footer>
<a class="wa-float" href="https://wa.me/12065550177" target="_blank" rel="noopener" aria-label="WhatsApp">WA</a>
<div class="chat-widget" id="sf-chat">
    <div class="chat-panel" id="chat-panel">
        <div class="chat-log" id="chat-log">
            <div class="bubble bot">Hi — ask StratumForge about soil borings, foundation recommendations, slope stability, retaining walls, or booking a Puget Sound site visit.</div>
        </div>
        <form class="chat-form" id="chat-form">
            <input type="text" id="chat-input" placeholder="Ask about geotech services…" required maxlength="2000">
            <button class="btn btn-primary" type="submit">Send</button>
        </form>
    </div>
    <button class="chat-toggle" type="button" id="chat-toggle">AI Geotech Concierge</button>
</div>
<script>
(() => {
    const panel = document.getElementById('chat-panel');
    const toggle = document.getElementById('chat-toggle');
    const form = document.getElementById('chat-form');
    const input = document.getElementById('chat-input');
    const log = document.getElementById('chat-log');
    const sessionId = 'sf-' + Math.random().toString(36).slice(2);
    toggle.addEventListener('click', () => panel.classList.toggle('open'));
    const add = (text, who) => { const el = document.createElement('div'); el.className = 'bubble ' + who; el.textContent = text; log.appendChild(el); log.scrollTop = log.scrollHeight; };
    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        const message = input.value.trim();
        if (!message) return;
        add(message, 'user');
        input.value = '';
        try {
            const res = await fetch(@json(route('ai.chat')), {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'Accept': 'application/json' },
                body: JSON.stringify({ message, session_id: sessionId }),
            });
            const data = await res.json();
            add(data.reply || 'Something went wrong.', 'bot');
        } catch (err) {
            add('Network error — please try again or call (206) 555-0177.', 'bot');
        }
    });
})();
</script>
@stack('scripts')
</body>
</html>