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
            background-image:
                radial-gradient(ellipse at 15% 30%, rgba(236, 137, 27, 0.12) 0%, transparent 55%),
                radial-gradient(ellipse at 85% 70%, rgba(171, 11, 55, 0.08) 0%, transparent 55%);
            min-height: 100vh;
            overflow-x: hidden;
        }

        #doodle-bg {
            position: fixed;
            inset: 0;
            z-index: 0;
            pointer-events: none;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(16px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ── Layout ── */
        .admin-wrap {
            display: flex;
            min-height: 100vh;
            position: relative;
            z-index: 1;
            animation: fadeIn 0.4s ease both;
        }

        /* ── Sidebar ── */
        .sidebar {
            width: 220px;
            flex-shrink: 0;
            background: linear-gradient(160deg, #1a0a05 0%, #2d0d18 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            padding: 28px 0;
            position: sticky;
            top: 0;
            height: 100vh;
            z-index: 10;
        }

        .sidebar-logo {
            padding: 0 24px 24px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.07);
        }

        .sidebar-logo-box {
            height: 44px;
            background: linear-gradient(135deg, var(--orange), var(--maroon));
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
            
            width: fit-content;
            padding: 6px 14px;
        }

        .sidebar-logo-box span {
            color: white;
            font-weight: 700;
            font-size: 15px;
            letter-spacing: 0.1em;
        }

        .sidebar-brand {
            font-size: 13px;
            font-weight: 700;
            color: white;
        }

        .sidebar-brand-logo {
            width: 35px;
            object-fit: contain;
        }

        

        .sidebar-sub {
            font-size: 9px;
            color: rgba(255, 255, 255, 0.3);
            letter-spacing: 0.1em;
            text-transform: uppercase;
            margin-top: 2px;
        }

        .sidebar-nav {
            padding: 20px 12px;
            display: flex;
            flex-direction: column;
            gap: 4px;
            flex: 1;
        }

        .nav-label {
            font-size: 8.5px;
            font-weight: 600;
            letter-spacing: 0.22em;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.2);
            padding: 0 12px;
            margin: 12px 0 6px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 12px;
            border-radius: 10px;
            font-size: 12px;
            font-weight: 500;
            color: rgba(255, 255, 255, 0.5);
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
            border: none;
            background: none;
            font-family: "Poppins", sans-serif;
            width: 100%;
            text-align: left;
        }

        .nav-item:hover {
            background: rgba(255, 255, 255, 0.06);
            color: rgba(255, 255, 255, 0.8);
        }

        .nav-item.active {
            background: rgba(236, 137, 27, 0.15);
            color: var(--orange);
        }

        .nav-icon {
            font-size: 15px;
            width: 20px;
            text-align: center;
        }

        .sidebar-footer {
            padding: 16px 24px;
            border-top: 1px solid rgba(255, 255, 255, 0.07);
        }

        .logout-btn {
            font-family: "Poppins", sans-serif;
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.3);
            background: none;
            border: none;
            cursor: pointer;
            transition: color 0.2s;
            padding: 0;
        }

        .logout-btn:hover {
            color: var(--maroon);
        }

        /* ── Main ── */
        .main-area {
            flex: 1;
            position: relative;
            z-index: 1;
            padding: 36px 32px;
            display: flex;
            flex-direction: column;
            gap: 28px;
            overflow-y: auto;
        }

        /* ── Header ── */
        .main-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
        }

        .main-eyebrow {
            font-size: 9.5px;
            font-weight: 600;
            letter-spacing: 0.22em;
            text-transform: uppercase;
            color: var(--orange);
            margin-bottom: 4px;
        }

        .main-title {
            font-size: 24px;
            font-weight: 700;
            color: var(--text-primary);
        }

        .main-sub {
            font-size: 11.5px;
            color: var(--text-muted);
            margin-top: 3px;
        }

        .header-actions {
            display: flex;
            gap: 10px;
            align-items: center;
            flex-shrink: 0;
        }

        .btn-add {
            font-family: "Poppins", sans-serif;
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: white;
            background: linear-gradient(90deg, var(--maroon), var(--orange));
            border: none;
            border-radius: 10px;
            padding: 10px 18px;
            cursor: pointer;
            white-space: nowrap;
            display: flex;
            align-items: center;
            gap: 7px;
            transition: opacity 0.2s, transform 0.15s;
        }

        .btn-add:hover {
            opacity: 0.88;
            transform: translateY(-1px);
        }

        .btn-outline {
            font-family: "Poppins", sans-serif;
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: var(--text-muted);
            background: var(--card-bg);
            border: 1.5px solid rgba(0, 0, 0, 0.12);
            border-radius: 10px;
            padding: 10px 18px;
            cursor: pointer;
            white-space: nowrap;
            display: flex;
            align-items: center;
            gap: 7px;
            transition: all 0.2s;
        }

        .btn-outline:hover {
            border-color: var(--orange);
            color: var(--orange);
        }

        /* ── Stats ── */
        .stats-row {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 14px;
        }

        .stat-card {
            background: var(--card-bg);
            border-radius: 14px;
            border: 1px solid rgba(0, 0, 0, 0.06);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            padding: 18px 20px;
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .stat-icon {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 17px;
            flex-shrink: 0;
        }

        .stat-icon.orange {
            background: rgba(236, 137, 27, 0.12);
        }

        .stat-icon.maroon {
            background: rgba(171, 11, 55, 0.08);
        }

        .stat-icon.blue {
            background: rgba(45, 106, 143, 0.10);
        }

        .stat-num {
            font-size: 22px;
            font-weight: 700;
            color: var(--text-primary);
            line-height: 1;
        }

        .stat-label {
            font-size: 10px;
            color: var(--text-muted);
            margin-top: 2px;
            font-weight: 500;
        }

        /* ── Flash ── */
        .flash {
            padding: 10px 16px;
            border-radius: 10px;
            font-size: 12px;
            font-weight: 500;
            background: #e8f5e9;
            color: #2e7d32;
            border: 1px solid #c8e6c9;
        }

        /* ── Section Cards ── */
        .section-card {
            background: var(--card-bg);
            border-radius: 18px;
            border: 1px solid rgba(0, 0, 0, 0.06);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            overflow: hidden;
        }

        .section-card-header {
            padding: 16px 22px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.06);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .section-card-title {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-icon {
            font-size: 18px;
        }

        .section-name {
            font-size: 13px;
            font-weight: 700;
            color: var(--text-primary);
        }

        .section-card-badge {
            font-size: 9px;
            font-weight: 600;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            padding: 3px 9px;
            border-radius: 999px;
            color: white;
        }

        .badge-asana {
            background: linear-gradient(90deg, #e04a8c, #f06292);
        }

        .badge-webapp {
            background: linear-gradient(90deg, var(--maroon), var(--orange));
        }

        .badge-resource {
            background: linear-gradient(90deg, #2d6a8f, #4ea8de);
        }

        .badge-other {
            background: linear-gradient(90deg, #5c5c5c, #999);
        }

        .section-head-actions {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .btn-sm {
            font-family: "Poppins", sans-serif;
            font-size: 9px;
            font-weight: 600;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            border-radius: 8px;
            padding: 6px 12px;
            cursor: pointer;
            border: none;
            transition: all 0.2s;
        }

        .btn-sm.outline {
            background: none;
            border: 1.5px solid rgba(0, 0, 0, 0.12);
            color: var(--text-muted);
        }

        .btn-sm.outline:hover {
            border-color: var(--orange);
            color: var(--orange);
        }

        .btn-sm.danger {
            background: #fdecea;
            color: #c62828;
        }

        .btn-sm.danger:hover {
            background: #ffcdd2;
        }

        .btn-sm.edit-btn {
            background: #f0f0f0;
            color: #444;
        }

        .btn-sm.edit-btn:hover {
            background: #e0e0e0;
        }

        /* ── Link Rows ── */
        .link-rows {
            display: flex;
            flex-direction: column;
        }

        .link-row {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 13px 22px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            transition: background 0.15s;
        }

        .link-row:last-child {
            border-bottom: none;
        }

        .link-row:hover {
            background: rgba(236, 137, 27, 0.03);
        }

        .row-drag {
            cursor: grab;
            color: rgba(0, 0, 0, 0.2);
            font-size: 13px;
            flex-shrink: 0;
        }

        .row-icon {
            width: 34px;
            height: 34px;
            border-radius: 9px;
            background: rgba(236, 137, 27, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            flex-shrink: 0;
        }

        .row-info {
            flex: 1;
            min-width: 0;
        }

        .row-name {
            font-size: 12.5px;
            font-weight: 600;
            color: var(--text-primary);
        }

        .row-url {
            font-size: 10.5px;
            color: var(--text-muted);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 340px;
            margin-top: 1px;
        }

        .row-desc {
            font-size: 10.5px;
            color: var(--text-muted);
            margin-top: 1px;
        }

        .row-actions {
            display: flex;
            gap: 6px;
            flex-shrink: 0;
        }

        .action-btn {
            width: 30px;
            height: 30px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            cursor: pointer;
            font-size: 13px;
            transition: all 0.2s;
            background: rgba(0, 0, 0, 0.05);
        }

        .action-btn.edit:hover {
            background: rgba(236, 137, 27, 0.15);
        }

        .action-btn.del:hover {
            background: rgba(171, 11, 55, 0.12);
        }

        /* ── Modals shared ── */
        .modal-overlay {
            position: fixed;
            inset: 0;
            z-index: 999;
            background: rgba(0, 0, 0, 0);
            display: flex;
            align-items: center;
            justify-content: center;
            pointer-events: none;
            transition: background 0.3s;
            padding: 20px;
        }

        .modal-overlay.active {
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(4px);
            pointer-events: all;
        }

        .modal {
            background: var(--card-bg);
            border-radius: 22px;
            width: 100%;
            max-width: 520px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 24px 80px rgba(0, 0, 0, 0.35);
            transform: scale(0.9) translateY(20px);
            opacity: 0;
            transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1), opacity 0.3s;
        }

        .modal-overlay.active .modal {
            transform: scale(1) translateY(0);
            opacity: 1;
        }

        .modal-top {
            background: linear-gradient(150deg, #1a0a05 0%, #2d0d18 100%);
            padding: 22px 26px 18px;
            position: relative;
            overflow: hidden;
            border-radius: 22px 22px 0 0;
        }

        .modal-top::before {
            content: '';
            position: absolute;
            top: -40px;
            right: -40px;
            width: 130px;
            height: 130px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(236, 137, 27, 0.2) 0%, transparent 70%);
        }

        .modal-eyebrow {
            font-size: 9px;
            font-weight: 600;
            letter-spacing: 0.22em;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.3);
            position: relative;
            z-index: 1;
            margin-bottom: 3px;
        }

        .modal-title {
            font-size: 18px;
            font-weight: 700;
            color: white;
            position: relative;
            z-index: 1;
        }

        .modal-divider {
            width: 28px;
            height: 2px;
            background: linear-gradient(90deg, var(--orange), var(--maroon));
            border-radius: 2px;
            margin-top: 10px;
            position: relative;
            z-index: 1;
        }

        .modal-body {
            padding: 24px 26px;
            display: flex;
            flex-direction: column;
            gap: 18px;
        }

        .modal-footer {
            padding: 0 26px 24px;
            display: flex;
            gap: 10px;
            justify-content: flex-end;
        }

        /* ── Form fields ── */
        .field-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .field-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
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
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .field-input:focus {
            border-color: var(--orange);
            box-shadow: 0 0 0 3px rgba(236, 137, 27, 0.12);
        }

        .error-msg {
            font-size: 11px;
            color: var(--maroon);
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
            padding: 10px 22px;
            cursor: pointer;
            transition: opacity 0.2s, transform 0.15s;
        }

        .btn-primary:hover {
            opacity: 0.88;
            transform: translateY(-1px);
        }

        .btn-cancel {
            font-family: "Poppins", sans-serif;
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            padding: 10px 18px;
            border-radius: 10px;
            border: 1.5px solid rgba(0, 0, 0, 0.12);
            background: none;
            color: var(--text-muted);
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-cancel:hover {
            border-color: var(--maroon);
            color: var(--maroon);
        }

        /* ── Icon Picker ── */
        .icon-picker-label {
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: var(--text-muted);
            margin-bottom: 8px;
        }

        .selected-icon-preview {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            background: #faf8f5;
            border: 1.5px solid rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            margin-bottom: 10px;
        }

        .preview-icon {
            font-size: 22px;
        }

        .preview-label {
            font-size: 11px;
            color: var(--text-muted);
        }

        .icon-search {
            font-family: "Poppins", sans-serif;
            font-size: 12px;
            padding: 8px 12px;
            border: 1.5px solid rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            width: 100%;
            background: #faf8f5;
            margin-bottom: 10px;
            outline: none;
            transition: border-color 0.2s;
        }

        .icon-search:focus {
            border-color: var(--orange);
        }

        .icon-cats {
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
            margin-bottom: 10px;
        }

        .icon-cat-btn {
            font-family: "Poppins", sans-serif;
            font-size: 9px;
            font-weight: 600;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            padding: 4px 10px;
            border-radius: 999px;
            border: 1.5px solid rgba(0, 0, 0, 0.1);
            background: none;
            color: var(--text-muted);
            cursor: pointer;
            transition: all 0.2s;
        }

        .icon-cat-btn.active,
        .icon-cat-btn:hover {
            border-color: var(--orange);
            color: var(--orange);
        }

        .icon-grid {
            display: grid;
            grid-template-columns: repeat(8, 1fr);
            gap: 6px;
            max-height: 200px;
            overflow-y: auto;
            padding: 4px 2px;
        }

        .icon-opt {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            cursor: pointer;
            border: 1.5px solid rgba(0, 0, 0, 0.07);
            background: #faf8f5;
            transition: all 0.15s;
        }

        .icon-opt:hover {
            border-color: var(--orange);
            background: rgba(236, 137, 27, 0.08);
            transform: scale(1.1);
        }

        .icon-opt.selected {
            border-color: var(--orange);
            background: rgba(236, 137, 27, 0.15);
            box-shadow: 0 0 0 2px rgba(236, 137, 27, 0.3);
        }

        /* ── Color options (category modal) ── */
        .color-opts {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .color-opt {
            padding: 6px 14px;
            border-radius: 999px;
            color: white;
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            cursor: pointer;
            border: 2px solid transparent;
            transition: all 0.15s;
            opacity: 0.65;
        }

        .color-opt.selected {
            border-color: var(--text-primary);
            opacity: 1;
            transform: scale(1.05);
        }

        .color-opt[data-color="webapp"] {
            background: linear-gradient(90deg, var(--maroon), var(--orange));
        }

        .color-opt[data-color="asana"] {
            background: linear-gradient(90deg, #e04a8c, #f06292);
        }

        .color-opt[data-color="resource"] {
            background: linear-gradient(90deg, #2d6a8f, #4ea8de);
        }

        .color-opt[data-color="other"] {
            background: linear-gradient(90deg, #5c5c5c, #999);
        }

        @media (max-width: 680px) {
            .sidebar {
                display: none;
            }

            .stats-row {
                grid-template-columns: 1fr;
            }

            .field-row {
                grid-template-columns: 1fr;
            }

            .main-area {
                padding: 20px 16px;
            }

            .icon-grid {
                grid-template-columns: repeat(6, 1fr);
            }

            .header-actions {
                flex-direction: column;
            }
        }
    </style>
@endsection

@section('content')
    <div class="admin-wrap">

        {{-- ── Sidebar ── --}}
        <aside class="sidebar">
            <div class="sidebar-logo">
                <div class="sidebar-logo-box"><img src="{{ asset('img/BFC-White.png') }}" alt="Logo" class="sidebar-brand-logo"></div>
                <div class="sidebar-brand">Links Hub</div>
                <div class="sidebar-sub">Admin Panel</div>
            </div>
            <nav class="sidebar-nav">
                <div class="nav-label">Manage</div>
                <a class="nav-item active" href="{{ route('admin.index') }}">
                    <span class="nav-icon">🔗</span> All Links
                </a>
                <div class="nav-label">View</div>
                <a class="nav-item" href="{{ route('hub') }}" target="_blank">
                    <span class="nav-icon">👁️</span> Preview Hub
                </a>
            </nav>
            <div class="sidebar-footer">
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn">← Sign Out</button>
                </form>
            </div>
        </aside>

        {{-- ── Main ── --}}
        <div class="main-area">

            {{-- Header --}}
            <div class="main-header">
                <div>
                    <div class="main-eyebrow">Admin Panel</div>
                    <div class="main-title">Links & Resources</div>
                    <div class="main-sub">Manage categories and links shown on the hub.</div>
                </div>
                <div class="header-actions">
                    <button class="btn-outline" onclick="openCategoryModal()">
                        <span>＋</span> Add Category
                    </button>
                    <button class="btn-add" onclick="openLinkModal()">
                        <span>＋</span> Add Link
                    </button>
                </div>
            </div>

            {{-- Flash --}}
            @if (session('success'))
                <div class="flash">✓ &nbsp;{{ session('success') }}</div>
            @endif

            {{-- Stats --}}
            <div class="stats-row">
                <div class="stat-card">
                    <div class="stat-icon orange">🔗</div>
                    <div>
                        <div class="stat-num">{{ $categories->sum(fn($c) => $c->links->count()) }}</div>
                        <div class="stat-label">Total Links</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon maroon">🗂️</div>
                    <div>
                        <div class="stat-num">{{ $categories->count() }}</div>
                        <div class="stat-label">Categories</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon blue">👁️</div>
                    <div>
                        <div class="stat-num">—</div>
                        <div class="stat-label">Hub Views</div>
                    </div>
                </div>
            </div>

            {{-- Category Sections --}}
            @foreach ($categories as $category)
                <div class="section-card" id="cat-{{ $category->id }}">
                    <div class="section-card-header">
                        <div class="section-card-title">
                            <span class="section-icon">{{ $category->icon }}</span>
                            <span class="section-name">{{ $category->name }}</span>
                            <span class="section-card-badge badge-{{ $category->color }}">{{ $category->color }}</span>
                        </div>
                        <div class="section-head-actions">
                            <button class="btn-sm outline" onclick="openLinkModal({{ $category->id }})">+ Add Link</button>
                            <button class="btn-sm edit-btn"
                                onclick="openEditCategoryModal(
            {{ $category->id }},
            '{{ addslashes($category->name) }}',
            '{{ $category->color }}',
            '{{ $category->icon }}'
          )">Edit</button>
                            <form method="POST" action="{{ route('admin.categories.destroy', $category) }}"
                                onsubmit="return confirm('Delete {{ addslashes($category->name) }} and all its links?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-sm danger">Delete</button>
                            </form>
                        </div>
                    </div>

                    <div class="link-rows" id="sortable-{{ $category->id }}">
                        @forelse($category->links as $link)
                            <div class="link-row" data-id="{{ $link->id }}">
                                <span class="row-drag">⠿</span>
                                <div class="row-icon">{{ $link->icon }}</div>
                                <div class="row-info">
                                    <div class="row-name">{{ $link->name }}</div>
                                    <div class="row-url">{{ $link->url }}</div>
                                    @if ($link->description)
                                        <div class="row-desc">{{ $link->description }}</div>
                                    @endif
                                </div>
                                <div class="row-actions">
                                    <button class="action-btn edit" title="Edit"
                                        onclick="openEditLinkModal(
              {{ $link->id }},
              {{ $link->category_id }},
              '{{ addslashes($link->name) }}',
              '{{ addslashes($link->url) }}',
              '{{ addslashes($link->description ?? '') }}',
              '{{ $link->icon }}'
            )">✏️</button>
                                    <form method="POST" action="{{ route('admin.links.destroy', $link) }}"
                                        onsubmit="return confirm('Delete {{ addslashes($link->name) }}?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="action-btn del" title="Delete">🗑️</button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div style="padding:18px 22px;font-size:12px;color:var(--text-muted);">
                                No links yet — add one above.
                            </div>
                        @endforelse
                    </div>
                </div>
            @endforeach

        </div>{{-- /main-area --}}
    </div>{{-- /admin-wrap --}}

    {{-- ════════════════════════════════════
     ADD / EDIT LINK MODAL
════════════════════════════════════ --}}
    <div class="modal-overlay" id="linkModal">
        <div class="modal">
            <div class="modal-top">
                <div class="modal-eyebrow" id="linkModalEyebrow">New Entry</div>
                <div class="modal-title" id="linkModalTitle">Add Link</div>
                <div class="modal-divider"></div>
            </div>
            <div class="modal-body">
                <form method="POST" id="linkForm">
                    @csrf
                    <input type="hidden" name="_method" id="linkMethod" value="POST">
                    <input type="hidden" name="icon" id="linkIconVal" value="📋">
                    <div style="display:flex;flex-direction:column;gap:18px;">

                        <div class="field-row">
                            <div class="field-group">
                                <label class="field-label">Link Name</label>
                                <input class="field-input" type="text" name="name" id="linkName"
                                    placeholder="e.g. IT Request Form" required>
                            </div>
                            <div class="field-group">
                                <label class="field-label">Category</label>
                                <select class="field-input" name="category_id" id="linkCategory"
                                    style="cursor:pointer;">
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="field-group">
                            <label class="field-label">URL</label>
                            <input class="field-input" type="url" name="url" id="linkUrl"
                                placeholder="https://..." required>
                        </div>

                        <div class="field-group">
                            <label class="field-label">Short Description</label>
                            <input class="field-input" type="text" name="description" id="linkDesc"
                                placeholder="e.g. Submit IT support tickets">
                        </div>

                        <div>
                            <div class="icon-picker-label">Choose Icon</div>
                            <div class="selected-icon-preview">
                                <span class="preview-icon" id="linkPreviewIcon">📋</span>
                                <span class="preview-label">Selected icon — click any below to change</span>
                            </div>
                            <input class="icon-search" type="text" placeholder="Search icons…"
                                oninput="filterIcons(this.value, 'linkIconGrid')" id="linkIconSearch">
                            <div class="icon-cats" id="linkIconCats">
                                <button type="button" class="icon-cat-btn active"
                                    onclick="setCat('all', this, 'linkIconGrid')">All</button>
                                <button type="button" class="icon-cat-btn"
                                    onclick="setCat('work', this, 'linkIconGrid')">Work</button>
                                <button type="button" class="icon-cat-btn"
                                    onclick="setCat('files', this, 'linkIconGrid')">Files</button>
                                <button type="button" class="icon-cat-btn"
                                    onclick="setCat('comm', this, 'linkIconGrid')">Comms</button>
                                <button type="button" class="icon-cat-btn"
                                    onclick="setCat('tools', this, 'linkIconGrid')">Tools</button>
                                <button type="button" class="icon-cat-btn"
                                    onclick="setCat('misc', this, 'linkIconGrid')">Misc</button>
                            </div>
                            <div class="icon-grid" id="linkIconGrid"></div>
                        </div>

                        <div class="modal-footer" style="padding:0;">
                            <button type="button" class="btn-cancel" onclick="closeLinkModal()">Cancel</button>
                            <button type="submit" class="btn-primary">Save Link</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ════════════════════════════════════
     ADD / EDIT CATEGORY MODAL
════════════════════════════════════ --}}
    <div class="modal-overlay" id="categoryModal">
        <div class="modal">
            <div class="modal-top">
                <div class="modal-eyebrow" id="catModalEyebrow">New Category</div>
                <div class="modal-title" id="catModalTitle">Add Category</div>
                <div class="modal-divider"></div>
            </div>
            <div class="modal-body">
                <form method="POST" id="categoryForm">
                    @csrf
                    <input type="hidden" name="_method" id="catMethod" value="POST">
                    <input type="hidden" name="icon" id="catIconVal" value="📋">
                    <input type="hidden" name="color" id="catColorVal" value="webapp">
                    <div style="display:flex;flex-direction:column;gap:18px;">

                        <div class="field-group">
                            <label class="field-label">Category Name</label>
                            <input class="field-input" type="text" name="name" id="catName"
                                placeholder="e.g. Web Apps" required>
                        </div>

                        <div class="field-group">
                            <label class="field-label">Color Theme</label>
                            <div class="color-opts">
                                <div class="color-opt selected" data-color="webapp"
                                    onclick="selectColor('webapp', this)">Webapp</div>
                                <div class="color-opt" data-color="asana" onclick="selectColor('asana', this)">Asana
                                </div>
                                <div class="color-opt" data-color="resource" onclick="selectColor('resource', this)">
                                    Resource</div>
                                <div class="color-opt" data-color="other" onclick="selectColor('other', this)">Other
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="icon-picker-label">Choose Icon</div>
                            <div class="selected-icon-preview">
                                <span class="preview-icon" id="catPreviewIcon">📋</span>
                                <span class="preview-label">Selected icon — click any below to change</span>
                            </div>
                            <input class="icon-search" type="text" placeholder="Search icons…"
                                oninput="filterIcons(this.value, 'catIconGrid')">
                            <div class="icon-cats" id="catIconCats">
                                <button type="button" class="icon-cat-btn active"
                                    onclick="setCat('all', this, 'catIconGrid')">All</button>
                                <button type="button" class="icon-cat-btn"
                                    onclick="setCat('work', this, 'catIconGrid')">Work</button>
                                <button type="button" class="icon-cat-btn"
                                    onclick="setCat('files', this, 'catIconGrid')">Files</button>
                                <button type="button" class="icon-cat-btn"
                                    onclick="setCat('comm', this, 'catIconGrid')">Comms</button>
                                <button type="button" class="icon-cat-btn"
                                    onclick="setCat('tools', this, 'catIconGrid')">Tools</button>
                                <button type="button" class="icon-cat-btn"
                                    onclick="setCat('misc', this, 'catIconGrid')">Misc</button>
                            </div>
                            <div class="icon-grid" id="catIconGrid"></div>
                        </div>

                        <div class="modal-footer" style="padding:0;">
                            <button type="button" class="btn-cancel" onclick="closeCategoryModal()">Cancel</button>
                            <button type="submit" class="btn-primary">Save Category</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.2/Sortable.min.js"></script>
    <script>
        // ══════════════════════════════════════
        // ICON DATA
        // ══════════════════════════════════════
        const ICONS = [{
                e: '📋',
                t: 'clipboard form',
                cat: 'work'
            },
            {
                e: '📝',
                t: 'note write',
                cat: 'work'
            },
            {
                e: '📊',
                t: 'chart analytics',
                cat: 'work'
            },
            {
                e: '📈',
                t: 'growth chart',
                cat: 'work'
            },
            {
                e: '🗂️',
                t: 'category folder',
                cat: 'work'
            },
            {
                e: '📌',
                t: 'pin task',
                cat: 'work'
            },
            {
                e: '🔖',
                t: 'bookmark save',
                cat: 'work'
            },
            {
                e: '🗓️',
                t: 'calendar schedule',
                cat: 'work'
            },
            {
                e: '📅',
                t: 'calendar date',
                cat: 'work'
            },
            {
                e: '⏰',
                t: 'alarm clock time',
                cat: 'work'
            },
            {
                e: '🔐',
                t: 'lock auth secure',
                cat: 'work'
            },
            {
                e: '🔑',
                t: 'key access',
                cat: 'work'
            },
            {
                e: '🛒',
                t: 'cart purchase',
                cat: 'work'
            },
            {
                e: '💼',
                t: 'briefcase business',
                cat: 'work'
            },
            {
                e: '🧾',
                t: 'receipt invoice',
                cat: 'work'
            },
            {
                e: '💰',
                t: 'money finance',
                cat: 'work'
            },
            {
                e: '💳',
                t: 'card payment',
                cat: 'work'
            },
            {
                e: '📁',
                t: 'folder files',
                cat: 'files'
            },
            {
                e: '📂',
                t: 'open folder',
                cat: 'files'
            },
            {
                e: '📄',
                t: 'document page',
                cat: 'files'
            },
            {
                e: '📃',
                t: 'page curl',
                cat: 'files'
            },
            {
                e: '📜',
                t: 'scroll document',
                cat: 'files'
            },
            {
                e: '🗒️',
                t: 'notepad notes',
                cat: 'files'
            },
            {
                e: '📰',
                t: 'newspaper article',
                cat: 'files'
            },
            {
                e: '📎',
                t: 'paperclip attach',
                cat: 'files'
            },
            {
                e: '💾',
                t: 'disk save',
                cat: 'files'
            },
            {
                e: '🗄️',
                t: 'file cabinet archive',
                cat: 'files'
            },
            {
                e: '💬',
                t: 'chat message',
                cat: 'comm'
            },
            {
                e: '📧',
                t: 'email mail',
                cat: 'comm'
            },
            {
                e: '📨',
                t: 'envelope incoming',
                cat: 'comm'
            },
            {
                e: '📤',
                t: 'outbox send',
                cat: 'comm'
            },
            {
                e: '📥',
                t: 'inbox receive',
                cat: 'comm'
            },
            {
                e: '📣',
                t: 'megaphone announce',
                cat: 'comm'
            },
            {
                e: '🔔',
                t: 'bell notification',
                cat: 'comm'
            },
            {
                e: '📞',
                t: 'phone call',
                cat: 'comm'
            },
            {
                e: '📱',
                t: 'mobile phone',
                cat: 'comm'
            },
            {
                e: '🖥️',
                t: 'desktop computer',
                cat: 'comm'
            },
            {
                e: '💻',
                t: 'laptop computer',
                cat: 'comm'
            },
            {
                e: '🌐',
                t: 'globe web internet',
                cat: 'comm'
            },
            {
                e: '⚙️',
                t: 'gear settings',
                cat: 'tools'
            },
            {
                e: '🔧',
                t: 'wrench tool fix',
                cat: 'tools'
            },
            {
                e: '🔨',
                t: 'hammer build',
                cat: 'tools'
            },
            {
                e: '🛠️',
                t: 'tools build',
                cat: 'tools'
            },
            {
                e: '🧰',
                t: 'toolbox kit',
                cat: 'tools'
            },
            {
                e: '🧪',
                t: 'test tube lab',
                cat: 'tools'
            },
            {
                e: '🔬',
                t: 'microscope research',
                cat: 'tools'
            },
            {
                e: '🖱️',
                t: 'mouse click',
                cat: 'tools'
            },
            {
                e: '⌨️',
                t: 'keyboard type',
                cat: 'tools'
            },
            {
                e: '🪪',
                t: 'id card badge',
                cat: 'misc'
            },
            {
                e: '🎨',
                t: 'palette design art',
                cat: 'misc'
            },
            {
                e: '✨',
                t: 'sparkle new',
                cat: 'misc'
            },
            {
                e: '🌟',
                t: 'star featured',
                cat: 'misc'
            },
            {
                e: '🔗',
                t: 'link chain url',
                cat: 'misc'
            },
            {
                e: '🔍',
                t: 'search magnify',
                cat: 'misc'
            },
            {
                e: '📦',
                t: 'box package inventory',
                cat: 'misc'
            },
            {
                e: '🏆',
                t: 'trophy award',
                cat: 'misc'
            },
            {
                e: '🎯',
                t: 'target goal',
                cat: 'misc'
            },
            {
                e: '🚀',
                t: 'rocket launch',
                cat: 'misc'
            },
            {
                e: '💡',
                t: 'bulb idea',
                cat: 'misc'
            },
            {
                e: '🧩',
                t: 'puzzle piece',
                cat: 'misc'
            },
            {
                e: '📷',
                t: 'camera photo',
                cat: 'misc'
            },
            {
                e: '🏢',
                t: 'office building',
                cat: 'misc'
            },
        ];

        // ══════════════════════════════════════
        // ICON PICKER ENGINE
        // ══════════════════════════════════════
        let activeCats = {
            linkIconGrid: 'all',
            catIconGrid: 'all'
        };
        let selectedIcons = {
            linkIconGrid: '📋',
            catIconGrid: '📋'
        };

        function renderIcons(gridId, filter = '') {
            const cat = activeCats[gridId];
            const list = ICONS.filter(i =>
                (cat === 'all' || i.cat === cat) &&
                (filter === '' || i.t.includes(filter.toLowerCase()) || i.e.includes(filter))
            );
            const grid = document.getElementById(gridId);
            grid.innerHTML = '';
            list.forEach(item => {
                const el = document.createElement('div');
                el.className = 'icon-opt' + (item.e === selectedIcons[gridId] ? ' selected' : '');
                el.title = item.t;
                el.textContent = item.e;
                el.onclick = () => selectIcon(item.e, el, gridId);
                grid.appendChild(el);
            });
        }

        function selectIcon(emoji, el, gridId) {
            selectedIcons[gridId] = emoji;
            document.querySelectorAll(`#${gridId} .icon-opt`).forEach(o => o.classList.remove('selected'));
            el.classList.add('selected');
            if (gridId === 'linkIconGrid') {
                document.getElementById('linkIconVal').value = emoji;
                document.getElementById('linkPreviewIcon').textContent = emoji;
            } else {
                document.getElementById('catIconVal').value = emoji;
                document.getElementById('catPreviewIcon').textContent = emoji;
            }
        }

        function filterIcons(q, gridId) {
            renderIcons(gridId, q);
        }

        function setCat(cat, btn, gridId) {
            activeCats[gridId] = cat;
            const container = btn.closest('.icon-cats');
            container.querySelectorAll('.icon-cat-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            renderIcons(gridId);
        }

        // ══════════════════════════════════════
        // LINK MODAL
        // ══════════════════════════════════════
        function openLinkModal(preselectedCategoryId = null) {
            document.getElementById('linkModalEyebrow').textContent = 'New Entry';
            document.getElementById('linkModalTitle').textContent = 'Add Link';
            document.getElementById('linkForm').action = '{{ route('admin.links.store') }}';
            document.getElementById('linkMethod').value = 'POST';
            document.getElementById('linkName').value = '';
            document.getElementById('linkUrl').value = '';
            document.getElementById('linkDesc').value = '';
            document.getElementById('linkIconVal').value = '📋';
            document.getElementById('linkPreviewIcon').textContent = '📋';
            selectedIcons['linkIconGrid'] = '📋';
            if (preselectedCategoryId) {
                document.getElementById('linkCategory').value = preselectedCategoryId;
            }
            renderIcons('linkIconGrid');
            document.getElementById('linkModal').classList.add('active');
        }

        function openEditLinkModal(id, categoryId, name, url, desc, icon) {
            document.getElementById('linkModalEyebrow').textContent = 'Edit Entry';
            document.getElementById('linkModalTitle').textContent = 'Edit Link';
            document.getElementById('linkForm').action = `/admin/links/${id}`;
            document.getElementById('linkMethod').value = 'PUT';
            document.getElementById('linkName').value = name;
            document.getElementById('linkUrl').value = url;
            document.getElementById('linkDesc').value = desc;
            document.getElementById('linkCategory').value = categoryId;
            document.getElementById('linkIconVal').value = icon;
            document.getElementById('linkPreviewIcon').textContent = icon;
            selectedIcons['linkIconGrid'] = icon;
            renderIcons('linkIconGrid');
            document.getElementById('linkModal').classList.add('active');
        }

        function closeLinkModal() {
            document.getElementById('linkModal').classList.remove('active');
        }

        // ══════════════════════════════════════
        // CATEGORY MODAL
        // ══════════════════════════════════════
        function openCategoryModal() {
            document.getElementById('catModalEyebrow').textContent = 'New Category';
            document.getElementById('catModalTitle').textContent = 'Add Category';
            document.getElementById('categoryForm').action = '{{ route('admin.categories.store') }}';
            document.getElementById('catMethod').value = 'POST';
            document.getElementById('catName').value = '';
            document.getElementById('catIconVal').value = '📋';
            document.getElementById('catPreviewIcon').textContent = '📋';
            selectedIcons['catIconGrid'] = '📋';
            selectColor('webapp', document.querySelector('.color-opt[data-color="webapp"]'));
            renderIcons('catIconGrid');
            document.getElementById('categoryModal').classList.add('active');
        }

        function openEditCategoryModal(id, name, color, icon) {
            document.getElementById('catModalEyebrow').textContent = 'Edit Category';
            document.getElementById('catModalTitle').textContent = 'Edit Category';
            document.getElementById('categoryForm').action = `/admin/categories/${id}`;
            document.getElementById('catMethod').value = 'PUT';
            document.getElementById('catName').value = name;
            document.getElementById('catIconVal').value = icon;
            document.getElementById('catPreviewIcon').textContent = icon;
            selectedIcons['catIconGrid'] = icon;
            const colorEl = document.querySelector(`.color-opt[data-color="${color}"]`);
            if (colorEl) selectColor(color, colorEl);
            renderIcons('catIconGrid');
            document.getElementById('categoryModal').classList.add('active');
        }

        function closeCategoryModal() {
            document.getElementById('categoryModal').classList.remove('active');
        }

        function selectColor(color, el) {
            document.getElementById('catColorVal').value = color;
            document.querySelectorAll('.color-opt').forEach(o => o.classList.remove('selected'));
            el.classList.add('selected');
        }

        // ══════════════════════════════════════
        // CLOSE ON OVERLAY CLICK / ESC
        // ══════════════════════════════════════
        ['linkModal', 'categoryModal'].forEach(id => {
            document.getElementById(id).addEventListener('click', function(e) {
                if (e.target === this) this.classList.remove('active');
            });
        });
        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') {
                ['linkModal', 'categoryModal'].forEach(id =>
                    document.getElementById(id).classList.remove('active')
                );
            }
        });

        // ══════════════════════════════════════
        // SORTABLE
        // ══════════════════════════════════════
        @foreach ($categories as $category)
            Sortable.create(document.getElementById('sortable-{{ $category->id }}'), {
                handle: '.row-drag',
                animation: 150,
                onEnd() {
                    const ids = [...document.querySelectorAll('#sortable-{{ $category->id }} .link-row[data-id]')]
                        .map(r => r.dataset.id);
                    fetch('{{ route('admin.links.reorder') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            order: ids
                        })
                    });
                }
            });
        @endforeach

        // ══════════════════════════════════════
        // DOODLE CANVAS
        // ══════════════════════════════════════
        const canvas = document.getElementById("doodle-bg");
        const ctx = canvas.getContext("2d");
        let mouseX = -9999,
            mouseY = -9999;
        const PR = 100;
        window.addEventListener("mousemove", e => {
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
