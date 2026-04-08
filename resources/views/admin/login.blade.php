@extends('layouts.app') 
@section('title', 'BFC Links Hub — Admin') 

@section('styles')
<style>
    :root {
        --orange: #ec891b;
        --maroon: #ab0b37;
        --bg: #f5f0eb;
        --card-bg: #ffffff;
        --text-primary: #1a1a1a;
        --text-muted: #a08060;
    }
    *,
    *::before,
    *::after {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    body {
        font-family: "Poppins", sans-serif;
        background-color: var(--bg);
        background-image: radial-gradient(ellipse at 15% 30%, rgba(236, 137, 27, 0.12) 0%, transparent 55%), radial-gradient(ellipse at 85% 70%, rgba(171, 11, 55, 0.08) 0%, transparent 55%);
        min-height: 100vh;
        overflow-x: hidden;
    }
    #doodle-bg {
        position: fixed;
        inset: 0;
        z-index: 0;
        pointer-events: none;
    }
    @keyframes fadeUp {
        from {
            opacity: 0;
            transform: translateY(18px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    #screen-login {
        position: relative;
        z-index: 1;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 28px;
        padding: 40px 20px;
        animation: fadeUp 0.6s ease both;
    }
    /* ── Header ── */
    .company-header {
        text-align: center;
    }

    .company-logo {
        width: 150px;
        height: auto;
        object-fit: contain;
    }

    .company-tagline {
        font-size: 10px;
        font-weight: 500;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        margin-top: -10px;
        color: var(--text-muted);
    }
    .logo-placeholder {
        width: 130px;
        height: 48px;
        background: linear-gradient(135deg, var(--orange), var(--maroon));
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    .logo-placeholder span {
        color: white;
        font-weight: 700;
        font-size: 17px;
        letter-spacing: 0.12em;
    }
    .login-tagline {
        font-size: 10px;
        font-weight: 500;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        margin-top: 10px;
        color: var(--text-muted);
    }
    .login-card {
        width: 100%;
        max-width: 400px;
        background: var(--card-bg);
        border-radius: 22px;
        border: 1px solid rgba(0, 0, 0, 0.07);
        box-shadow:
            0 2px 4px rgba(0, 0, 0, 0.04),
            0 12px 40px rgba(0, 0, 0, 0.12);
        overflow: hidden;
    }
    .login-card-top {
        background: linear-gradient(150deg, #1a0a05 0%, #2d0d18 100%);
        padding: 24px 28px 20px;
        position: relative;
        overflow: hidden;
    }
    .login-card-top::before {
        content: "";
        position: absolute;
        top: -40px;
        right: -40px;
        width: 140px;
        height: 140px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(236, 137, 27, 0.2) 0%, transparent 70%);
    }
    .login-card-top::after {
        content: "";
        position: absolute;
        bottom: -30px;
        left: -20px;
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(171, 11, 55, 0.25) 0%, transparent 70%);
    }
    .login-eyebrow {
        font-size: 9px;
        font-weight: 600;
        letter-spacing: 0.22em;
        text-transform: uppercase;
        color: rgba(255, 255, 255, 0.35);
        position: relative;
        z-index: 1;
        margin-bottom: 4px;
    }
    .login-title {
        font-size: 20px;
        font-weight: 700;
        color: white;
        position: relative;
        z-index: 1;
    }
    .login-divider {
        width: 32px;
        height: 2px;
        background: linear-gradient(90deg, var(--orange), var(--maroon));
        border-radius: 2px;
        margin-top: 12px;
        position: relative;
        z-index: 1;
    }
    .login-card-body {
        padding: 28px;
        display: flex;
        flex-direction: column;
        gap: 16px;
    }
    .field-group {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }
    .field-label {
        font-size: 10px;
        font-weight: 600;
        letter-spacing: 0.14em;
        text-transform: uppercase;
        color: var(--text-muted);
    }
    .field-input {
        font-family: "Poppins", sans-serif;
        font-size: 13px;
        padding: 10px 14px;
        border: 1.5px solid rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        background: #faf8f5;
        color: var(--text-primary);
        outline: none;
        transition:
            border-color 0.2s,
            box-shadow 0.2s;
    }
    .field-input:focus {
        border-color: var(--orange);
        box-shadow: 0 0 0 3px rgba(236, 137, 27, 0.12);
    }
    .field-input.is-invalid {
        border-color: var(--maroon);
    }
    .error-msg {
        font-size: 11px;
        color: var(--maroon);
        margin-top: 2px;
    }
    .btn-primary {
        font-family: "Poppins", sans-serif;
        font-size: 10.5px;
        font-weight: 600;
        letter-spacing: 0.14em;
        text-transform: uppercase;
        color: white;
        background: linear-gradient(90deg, var(--maroon), var(--orange));
        border: none;
        border-radius: 10px;
        padding: 12px 20px;
        cursor: pointer;
        transition:
            opacity 0.2s,
            transform 0.15s;
        width: 100%;
    }
    .btn-primary:hover {
        opacity: 0.88;
        transform: translateY(-1px);
    }
</style>
@endsection 

@section('content')
<div id="screen-login">
    <div class="company-header">
        <img src="{{ asset('img/BFC.png') }}" alt="Logo" class="company-logo">
        <div class="company-tagline">what we do, we do best</div>
    </div>

    <div class="login-card">
        <div class="login-card-top">
            <div class="login-eyebrow">Admin Portal</div>
            <div class="login-title">Links Hub Admin</div>
            <div class="login-divider"></div>
        </div>
        <div class="login-card-body">
            @if($errors->has('credentials'))
            <div class="error-msg">{{ $errors->first('credentials') }}</div>
            @endif

            <form method="POST" action="{{ route('admin.login.post') }}">
                @csrf
                <div style="display: flex; flex-direction: column; gap: 16px">
                    <div class="field-group">
                        <label class="field-label">Username</label>
                        <input class="field-input @error('username') is-invalid @enderror" type="text" name="username" value="{{ old('username') }}" autocomplete="username" />
                        @error('username')
                        <div class="error-msg">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="field-group">
                        <label class="field-label">Password</label>
                        <input class="field-input @error('password') is-invalid @enderror" type="password" name="password" autocomplete="current-password" />
                        @error('password')
                        <div class="error-msg">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn-primary">Sign In</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 

@section('scripts')
<script>
    // Doodle canvas
    const canvas = document.getElementById("doodle-bg");
    const ctx = canvas.getContext("2d");
    let mouseX = -9999,
        mouseY = -9999;
    const PR = 100;
    window.addEventListener("mousemove", (e) => {
        mouseX = e.clientX;
        mouseY = e.clientY;
        drawDoodles();
    });
    window.addEventListener("mouseleave", () => {
        mouseX = -9999;
        mouseY = -9999;
        drawDoodles();
    });
    function resize() {
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
        drawDoodles();
    }
    window.addEventListener("resize", resize);
    function drawDoodles() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        ctx.lineWidth = 1.4;
        ctx.lineCap = "round";
        ctx.lineJoin = "round";
        const gap = 68,
            cols = Math.ceil(canvas.width / gap) + 2,
            rows = Math.ceil(canvas.height / gap) + 2;
        const icons = ["chicken", "egg", "chick", "pig"];
        let idx = 0;
        for (let r = 0; r < rows; r++) {
            for (let c = 0; c < cols; c++) {
                const ox = r % 2 === 0 ? 0 : gap / 2,
                    x = c * gap + ox - gap,
                    y = r * gap - gap;
                const icon = icons[idx % icons.length];
                idx++;
                const dist = Math.sqrt((x - mouseX) ** 2 + (y - mouseY) ** 2);
                let op = 0.055;
                if (dist < PR) {
                    const t = 1 - dist / PR;
                    op = 0.055 + (0.25 - 0.055) * (t * t);
                }
                ctx.strokeStyle = `rgba(0,0,0,${op})`;
                ctx.fillStyle = `rgba(0,0,0,${op})`;
                ctx.save();
                ctx.translate(x, y);
                const seed = (r * 1000 + c) % 7;
                ctx.rotate((seed - 3) * 0.08);
                drawIcon(ctx, icon, 36);
                ctx.restore();
            }
        }
    }
    function drawIcon(ctx, type, s) {
        const h = s * 0.5;
        ctx.beginPath();
        if (type === "egg") {
            ctx.save();
            ctx.scale(1, 1.3);
            ctx.arc(0, 0, h * 0.72, 0, Math.PI * 2);
            ctx.restore();
            ctx.stroke();
        } else if (type === "chicken") {
            ctx.save();
            ctx.scale(1.1, 1);
            ctx.arc(0, h * 0.15, h * 0.7, 0, Math.PI * 2);
            ctx.restore();
            ctx.stroke();
            ctx.beginPath();
            ctx.arc(h * 0.45, -h * 0.55, h * 0.32, 0, Math.PI * 2);
            ctx.stroke();
            ctx.beginPath();
            ctx.moveTo(h * 0.75, -h * 0.55);
            ctx.lineTo(h * 1.0, -h * 0.45);
            ctx.lineTo(h * 0.75, -h * 0.38);
            ctx.stroke();
            ctx.beginPath();
            ctx.moveTo(h * 0.3, -h * 0.87);
            ctx.quadraticCurveTo(h * 0.38, -h * 1.1, h * 0.45, -h * 0.88);
            ctx.quadraticCurveTo(h * 0.53, -h * 1.05, h * 0.6, -h * 0.87);
            ctx.stroke();
            ctx.beginPath();
            ctx.moveTo(-h * 0.6, -h * 0.3);
            ctx.quadraticCurveTo(-h * 1.1, -h * 0.7, -h * 0.9, -h * 0.1);
            ctx.stroke();
            ctx.beginPath();
            ctx.moveTo(-h * 0.6, -h * 0.1);
            ctx.quadraticCurveTo(-h * 1.2, -h * 0.3, -h * 0.85, h * 0.1);
            ctx.stroke();
            ctx.beginPath();
            ctx.moveTo(-h * 0.1, h * 0.82);
            ctx.lineTo(-h * 0.1, h * 1.1);
            ctx.moveTo(-h * 0.1, h * 1.1);
            ctx.lineTo(-h * 0.35, h * 1.28);
            ctx.moveTo(-h * 0.1, h * 1.1);
            ctx.lineTo(h * 0.1, h * 1.3);
            ctx.moveTo(-h * 0.1, h * 1.1);
            ctx.lineTo(h * 0.28, h * 1.1);
            ctx.moveTo(h * 0.3, h * 0.82);
            ctx.lineTo(h * 0.3, h * 1.1);
            ctx.moveTo(h * 0.3, h * 1.1);
            ctx.lineTo(h * 0.05, h * 1.28);
            ctx.moveTo(h * 0.3, h * 1.1);
            ctx.lineTo(h * 0.5, h * 1.3);
            ctx.moveTo(h * 0.3, h * 1.1);
            ctx.lineTo(h * 0.65, h * 1.08);
            ctx.stroke();
        } else if (type === "chick") {
            ctx.save();
            ctx.scale(1, 0.95);
            ctx.arc(0, h * 0.2, h * 0.62, 0, Math.PI * 2);
            ctx.restore();
            ctx.stroke();
            ctx.beginPath();
            ctx.arc(0, -h * 0.45, h * 0.38, 0, Math.PI * 2);
            ctx.stroke();
            ctx.beginPath();
            ctx.moveTo(h * 0.36, -h * 0.46);
            ctx.lineTo(h * 0.6, -h * 0.38);
            ctx.lineTo(h * 0.36, -h * 0.3);
            ctx.stroke();
            ctx.beginPath();
            ctx.moveTo(-h * 0.55, h * 0.1);
            ctx.quadraticCurveTo(-h * 0.85, h * 0.3, -h * 0.5, h * 0.5);
            ctx.stroke();
            ctx.beginPath();
            ctx.moveTo(-h * 0.18, h * 0.8);
            ctx.lineTo(-h * 0.18, h * 1.05);
            ctx.moveTo(-h * 0.18, h * 1.05);
            ctx.lineTo(-h * 0.38, h * 1.2);
            ctx.moveTo(-h * 0.18, h * 1.05);
            ctx.lineTo(h * 0.05, h * 1.22);
            ctx.moveTo(h * 0.18, h * 0.8);
            ctx.lineTo(h * 0.18, h * 1.05);
            ctx.moveTo(h * 0.18, h * 1.05);
            ctx.lineTo(-h * 0.02, h * 1.22);
            ctx.moveTo(h * 0.18, h * 1.05);
            ctx.lineTo(h * 0.4, h * 1.2);
            ctx.stroke();
        } else if (type === "pig") {
            ctx.save();
            ctx.scale(1.1, 0.95);
            ctx.arc(0, h * 0.2, h * 0.68, 0, Math.PI * 2);
            ctx.restore();
            ctx.stroke();
            ctx.beginPath();
            ctx.arc(h * 0.38, -h * 0.48, h * 0.4, 0, Math.PI * 2);
            ctx.stroke();
            ctx.beginPath();
            ctx.save();
            ctx.scale(1.2, 0.85);
            ctx.arc(h * 0.38, -h * 0.28, h * 0.22, 0, Math.PI * 2);
            ctx.restore();
            ctx.stroke();
            ctx.beginPath();
            ctx.moveTo(h * 0.15, -h * 0.82);
            ctx.quadraticCurveTo(h * 0.05, -h * 1.08, h * 0.28, -h * 0.88);
            ctx.stroke();
            ctx.beginPath();
            ctx.moveTo(h * 0.5, -h * 0.84);
            ctx.quadraticCurveTo(h * 0.65, -h * 1.08, h * 0.52, -h * 0.88);
            ctx.stroke();
            ctx.beginPath();
            ctx.moveTo(-h * 0.72, h * 0.05);
            ctx.bezierCurveTo(-h * 1.05, -h * 0.1, -h * 1.1, h * 0.3, -h * 0.85, h * 0.25);
            ctx.bezierCurveTo(-h * 0.65, h * 0.2, -h * 0.7, h * 0.0, -h * 0.88, h * 0.05);
            ctx.stroke();
            ctx.beginPath();
            ctx.moveTo(-h * 0.3, h * 0.85);
            ctx.lineTo(-h * 0.3, h * 1.15);
            ctx.moveTo(h * 0.1, h * 0.85);
            ctx.lineTo(h * 0.1, h * 1.15);
            ctx.moveTo(-h * 0.55, h * 0.78);
            ctx.lineTo(-h * 0.55, h * 1.08);
            ctx.moveTo(h * 0.35, h * 0.78);
            ctx.lineTo(h * 0.35, h * 1.08);
            ctx.moveTo(-h * 0.38, h * 1.15);
            ctx.lineTo(-h * 0.22, h * 1.15);
            ctx.moveTo(h * 0.02, h * 1.15);
            ctx.lineTo(h * 0.18, h * 1.15);
            ctx.moveTo(-h * 0.63, h * 1.08);
            ctx.lineTo(-h * 0.47, h * 1.08);
            ctx.moveTo(h * 0.27, h * 1.08);
            ctx.lineTo(h * 0.43, h * 1.08);
            ctx.stroke();
        }
    }
    resize();
</script>
@endsection
