@extends('layouts.app')

@section('title', 'BFC Links & Resources')

@section('styles')
<style>
  :root {
    --orange: #ec891b;
    --maroon: #ab0b37;
    --bg: #f5f0eb;
    --card-bg: #ffffff;
    --text-primary: #1a1a1a;
    --text-muted: #a08060;
    --text-soft: #666;
  }
  *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }
  body {
    min-height: 100vh;
    padding: 40px 20px 60px;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 32px;
    font-family: "Poppins", sans-serif;
    background-color: var(--bg);
    background-image:
      radial-gradient(ellipse at 15% 30%, rgba(236,137,27,0.12) 0%, transparent 55%),
      radial-gradient(ellipse at 85% 70%, rgba(171,11,55,0.08) 0%, transparent 55%);
    overflow-x: hidden;
  }
  #doodle-bg { position: fixed; inset: 0; z-index: 0; pointer-events: none; }
  .page-wrapper {
    display: flex; flex-direction: column; align-items: center;
    gap: 28px; width: 100%; max-width: 860px;
    position: relative; z-index: 1;
    animation: fadeUp 0.7s ease both;
  }
  @keyframes fadeUp {
    from { opacity: 0; transform: translateY(20px); }
    to   { opacity: 1; transform: translateY(0); }
  }
  .company-header { text-align: center; }
  .logo-placeholder {
    width: 140px; height: 52px;
    background: linear-gradient(135deg, var(--orange), var(--maroon));
    border-radius: 10px;
    display: inline-flex; align-items: center; justify-content: center;
  }
  .logo-placeholder span { color: white; font-weight: 700; font-size: 18px; letter-spacing: 0.12em; }
  .company-tagline {
    font-size: 10px; font-weight: 500; letter-spacing: 0.2em;
    text-transform: uppercase; margin-top: 10px; color: var(--text-muted);
  }
  .hero { text-align: center; }
  .hero-eyebrow {
    font-size: 10px; font-weight: 600; letter-spacing: 0.25em;
    text-transform: uppercase; color: var(--orange); margin-bottom: 6px;
  }
  .hero-title { font-size: 28px; font-weight: 700; color: var(--text-primary); line-height: 1.15; }
  .hero-sub { font-size: 12px; color: var(--text-muted); margin-top: 6px; }
  .tab-row { display: flex; flex-wrap: wrap; gap: 8px; justify-content: center; width: 100%; }
  .tab {
    font-family: "Poppins", sans-serif;
    font-size: 10.5px; font-weight: 600; letter-spacing: 0.14em;
    text-transform: uppercase; padding: 7px 16px;
    border-radius: 999px; border: 1.5px solid rgba(0,0,0,0.1);
    background: transparent; color: var(--text-muted);
    cursor: pointer; transition: all 0.2s;
  }
  .tab:hover { border-color: var(--orange); color: var(--orange); }
  .tab.active {
    background: linear-gradient(90deg, var(--maroon), var(--orange));
    border-color: transparent; color: white;
  }
  .category-block { width: 100%; display: flex; flex-direction: column; gap: 14px; animation: fadeUp 0.4s ease both; }
  .category-block.hidden { display: none; }
  .category-header { display: flex; align-items: center; gap: 10px; }
  .category-badge {
    font-size: 9px; font-weight: 600; letter-spacing: 0.2em;
    text-transform: uppercase; padding: 4px 10px;
    border-radius: 999px; color: white;
  }
  .badge-asana    { background: linear-gradient(90deg, #e04a8c, #f06292); }
  .badge-webapp   { background: linear-gradient(90deg, var(--maroon), var(--orange)); }
  .badge-resource { background: linear-gradient(90deg, #2d6a8f, #4ea8de); }
  .badge-other    { background: linear-gradient(90deg, #5c5c5c, #999); }
  .category-divider { flex: 1; height: 1px; background: rgba(0,0,0,0.08); }
  .links-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
    gap: 12px;
  }
  .link-card {
    display: flex; align-items: center; gap: 14px;
    background: var(--card-bg);
    border: 1px solid rgba(0,0,0,0.06);
    border-radius: 16px;
    padding: 14px 16px;
    text-decoration: none; color: inherit;
    transition: box-shadow 0.2s, transform 0.2s;
    box-shadow: 0 1px 3px rgba(0,0,0,0.05);
  }
  .link-card:hover { box-shadow: 0 6px 24px rgba(0,0,0,0.1); transform: translateY(-2px); }
  .card-icon {
    width: 42px; height: 42px; border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    font-size: 20px; flex-shrink: 0;
  }
  .icon-asana    { background: linear-gradient(135deg, #fce4ef, #f8bbd0); }
  .icon-webapp   { background: linear-gradient(135deg, #fff0e0, #ffe0b2); }
  .icon-resource { background: linear-gradient(135deg, #e0f0ff, #b3d9f7); }
  .icon-other    { background: linear-gradient(135deg, #f0f0f0, #e0e0e0); }
  .card-info { flex: 1; min-width: 0; }
  .card-name { font-size: 13px; font-weight: 600; color: var(--text-primary); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
  .card-desc { font-size: 11px; color: var(--text-muted); margin-top: 2px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
  .card-arrow { color: var(--text-muted); flex-shrink: 0; }
  .page-footer { font-size: 11px; color: var(--text-muted); text-align: center; }
</style>
@endsection

@section('content')
<div class="page-wrapper">

  <div class="company-header">
    <div class="logo-placeholder"><span>BFC</span></div>
    <div class="company-tagline">Bounty Fresh Foods Inc.</div>
  </div>

  <div class="hero">
    <div class="hero-eyebrow">Internal Resources</div>
    <div class="hero-title">Links & Resources</div>
    <div class="hero-sub">Quick access to all your tools and platforms</div>
  </div>

  {{-- Filter Tabs --}}
  <div class="tab-row">
    <button class="tab active" onclick="filterCat('all', this)">All</button>
    @foreach($categories as $cat)
      <button class="tab" onclick="filterCat('{{ $cat->id }}', this)">{{ $cat->name }}</button>
    @endforeach
  </div>

  {{-- Category Blocks --}}
  @foreach($categories as $cat)
    <div class="category-block" data-cat="{{ $cat->id }}" id="cat-{{ $cat->id }}">
      <div class="category-header">
        <span class="category-badge badge-{{ $cat->color }}">{{ $cat->name }}</span>
        <div class="category-divider"></div>
      </div>
      <div class="links-grid">
        @foreach($cat->links as $link)
          <a class="link-card" href="{{ $link->url }}" target="_blank">
            <div class="card-icon icon-{{ $cat->color }}">{{ $link->icon }}</div>
            <div class="card-info">
              <div class="card-name">{{ $link->name }}</div>
              <div class="card-desc">{{ $link->description }}</div>
            </div>
            <svg class="card-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M5 12h14M12 5l7 7-7 7"/>
            </svg>
          </a>
        @endforeach
      </div>
    </div>
  @endforeach

  <div class="page-footer">BFC Internal Links Hub &nbsp;·&nbsp; What we do, we do best!</div>
</div>
@endsection

@section('scripts')
<script>
  function filterCat(cat, btn) {
    document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
    btn.classList.add('active');
    document.querySelectorAll('.category-block').forEach(block => {
      if (cat === 'all' || block.dataset.cat == cat) {
        block.classList.remove('hidden');
      } else {
        block.classList.add('hidden');
      }
    });
  }

  // Doodle canvas
  const canvas = document.getElementById("doodle-bg");
  const ctx    = canvas.getContext("2d");
  let mouseX = -9999, mouseY = -9999;
  const PROXIMITY_RADIUS = 100;
  window.addEventListener("mousemove", e => { mouseX = e.clientX; mouseY = e.clientY; drawDoodles(); });
  window.addEventListener("mouseleave", () => { mouseX = -9999; mouseY = -9999; drawDoodles(); });
  function resize() { canvas.width = window.innerWidth; canvas.height = window.innerHeight; drawDoodles(); }
  function drawDoodles() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    ctx.lineWidth = 1.4; ctx.lineCap = "round"; ctx.lineJoin = "round";
    const gap = 68, cols = Math.ceil(canvas.width / gap) + 2, rows = Math.ceil(canvas.height / gap) + 2;
    const icons = ["chicken","egg","chick","pig"]; let idx = 0;
    for (let r = 0; r < rows; r++) {
      for (let c = 0; c < cols; c++) {
        const ox = r % 2 === 0 ? 0 : gap / 2, x = c * gap + ox - gap, y = r * gap - gap;
        const icon = icons[idx % icons.length]; idx++;
        const dist = Math.sqrt((x - mouseX) ** 2 + (y - mouseY) ** 2);
        let op = 0.065;
        if (dist < PROXIMITY_RADIUS) { const t = 1 - dist / PROXIMITY_RADIUS; op = 0.065 + (0.28 - 0.065) * (t * t); }
        ctx.strokeStyle = `rgba(0,0,0,${op})`; ctx.fillStyle = `rgba(0,0,0,${op})`;
        ctx.save(); ctx.translate(x, y);
        const seed = (r * 1000 + c) % 7; ctx.rotate((seed - 3) * 0.08);
        drawIcon(ctx, icon, 36); ctx.restore();
      }
    }
  }
  function drawIcon(ctx, type, s) {
    const h = s * 0.5; ctx.beginPath();
    if (type === "egg") { ctx.save(); ctx.scale(1, 1.3); ctx.arc(0, 0, h * 0.72, 0, Math.PI * 2); ctx.restore(); ctx.stroke(); }
    else if (type === "chicken") { ctx.save(); ctx.scale(1.1, 1); ctx.arc(0, h * 0.15, h * 0.7, 0, Math.PI * 2); ctx.restore(); ctx.stroke(); ctx.beginPath(); ctx.arc(h * 0.45, -h * 0.55, h * 0.32, 0, Math.PI * 2); ctx.stroke(); ctx.beginPath(); ctx.moveTo(h*0.75,-h*0.55); ctx.lineTo(h*1.0,-h*0.45); ctx.lineTo(h*0.75,-h*0.38); ctx.stroke(); ctx.beginPath(); ctx.moveTo(h*0.3,-h*0.87); ctx.quadraticCurveTo(h*0.38,-h*1.1,h*0.45,-h*0.88); ctx.quadraticCurveTo(h*0.53,-h*1.05,h*0.6,-h*0.87); ctx.stroke(); ctx.beginPath(); ctx.moveTo(-h*0.6,-h*0.3); ctx.quadraticCurveTo(-h*1.1,-h*0.7,-h*0.9,-h*0.1); ctx.stroke(); ctx.beginPath(); ctx.moveTo(-h*0.6,-h*0.1); ctx.quadraticCurveTo(-h*1.2,-h*0.3,-h*0.85,h*0.1); ctx.stroke(); ctx.beginPath(); ctx.moveTo(-h*0.1,h*0.82); ctx.lineTo(-h*0.1,h*1.1); ctx.moveTo(-h*0.1,h*1.1); ctx.lineTo(-h*0.35,h*1.28); ctx.moveTo(-h*0.1,h*1.1); ctx.lineTo(h*0.1,h*1.3); ctx.moveTo(-h*0.1,h*1.1); ctx.lineTo(h*0.28,h*1.1); ctx.moveTo(h*0.3,h*0.82); ctx.lineTo(h*0.3,h*1.1); ctx.moveTo(h*0.3,h*1.1); ctx.lineTo(h*0.05,h*1.28); ctx.moveTo(h*0.3,h*1.1); ctx.lineTo(h*0.5,h*1.3); ctx.moveTo(h*0.3,h*1.1); ctx.lineTo(h*0.65,h*1.08); ctx.stroke(); }
    else if (type === "chick") { ctx.save(); ctx.scale(1, 0.95); ctx.arc(0, h*0.2, h*0.62, 0, Math.PI*2); ctx.restore(); ctx.stroke(); ctx.beginPath(); ctx.arc(0, -h*0.45, h*0.38, 0, Math.PI*2); ctx.stroke(); ctx.beginPath(); ctx.moveTo(h*0.36,-h*0.46); ctx.lineTo(h*0.6,-h*0.38); ctx.lineTo(h*0.36,-h*0.3); ctx.stroke(); ctx.beginPath(); ctx.moveTo(-h*0.55,h*0.1); ctx.quadraticCurveTo(-h*0.85,h*0.3,-h*0.5,h*0.5); ctx.stroke(); ctx.beginPath(); ctx.moveTo(-h*0.18,h*0.8); ctx.lineTo(-h*0.18,h*1.05); ctx.moveTo(-h*0.18,h*1.05); ctx.lineTo(-h*0.38,h*1.2); ctx.moveTo(-h*0.18,h*1.05); ctx.lineTo(h*0.05,h*1.22); ctx.moveTo(h*0.18,h*0.8); ctx.lineTo(h*0.18,h*1.05); ctx.moveTo(h*0.18,h*1.05); ctx.lineTo(-h*0.02,h*1.22); ctx.moveTo(h*0.18,h*1.05); ctx.lineTo(h*0.4,h*1.2); ctx.stroke(); }
    else if (type === "pig") { ctx.save(); ctx.scale(1.1, 0.95); ctx.arc(0, h*0.2, h*0.68, 0, Math.PI*2); ctx.restore(); ctx.stroke(); ctx.beginPath(); ctx.arc(h*0.38, -h*0.48, h*0.4, 0, Math.PI*2); ctx.stroke(); ctx.beginPath(); ctx.save(); ctx.scale(1.2, 0.85); ctx.arc(h*0.38, -h*0.28, h*0.22, 0, Math.PI*2); ctx.restore(); ctx.stroke(); ctx.beginPath(); ctx.moveTo(h*0.15,-h*0.82); ctx.quadraticCurveTo(h*0.05,-h*1.08,h*0.28,-h*0.88); ctx.stroke(); ctx.beginPath(); ctx.moveTo(h*0.5,-h*0.84); ctx.quadraticCurveTo(h*0.65,-h*1.08,h*0.52,-h*0.88); ctx.stroke(); ctx.beginPath(); ctx.moveTo(-h*0.72,h*0.05); ctx.bezierCurveTo(-h*1.05,-h*0.1,-h*1.1,h*0.3,-h*0.85,h*0.25); ctx.bezierCurveTo(-h*0.65,h*0.2,-h*0.7,h*0.0,-h*0.88,h*0.05); ctx.stroke(); ctx.beginPath(); ctx.moveTo(-h*0.3,h*0.85); ctx.lineTo(-h*0.3,h*1.15); ctx.moveTo(h*0.1,h*0.85); ctx.lineTo(h*0.1,h*1.15); ctx.moveTo(-h*0.55,h*0.78); ctx.lineTo(-h*0.55,h*1.08); ctx.moveTo(h*0.35,h*0.78); ctx.lineTo(h*0.35,h*1.08); ctx.moveTo(-h*0.38,h*1.15); ctx.lineTo(-h*0.22,h*1.15); ctx.moveTo(h*0.02,h*1.15); ctx.lineTo(h*0.18,h*1.15); ctx.moveTo(-h*0.63,h*1.08); ctx.lineTo(-h*0.47,h*1.08); ctx.moveTo(h*0.27,h*1.08); ctx.lineTo(h*0.43,h*1.08); ctx.stroke(); }
  }
  window.addEventListener("resize", resize);
  resize();
</script>
@endsection