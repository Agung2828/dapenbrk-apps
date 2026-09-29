@extends('layout.user.index')

@section('content')
    <!DOCTYPE html>
    <html lang="id">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>WBS - Dana Pensiun Bank Riau Kepri</title>
        <link rel="icon" type="image/png" href="{{ asset('image/logodapenbrk.png') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
            rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <style>
            :root {
                --navy: #1e3c72;
                --blue: #2a5298;
                --gold: #fbbf24;
                --amber: #f59e0b;
                --red: #dc3545;
                --red2: #b91c1c;
                --green: #10b981;
                --bg: #f5f7fa;
                --line: #e5e7eb;
                --muted: #6b7280;
                --ink: #333
            }

            .wbs-main,
            .wbs-main *,
            .wbs-main *::before,
            .wbs-main *::after {
                box-sizing: border-box
            }

            .wbs-main :where(h1, h2, h3, h4, p, ul, ol) {
                margin: 0;
                padding: 0
            }

            .wbs-main {
                padding-top: 1px;
                font-family: 'Plus Jakarta Sans', 'Segoe UI', Tahoma, sans-serif;
                background: radial-gradient(700px 320px at 92% 0, rgba(251, 191, 36, .12), transparent 60%), radial-gradient(700px 320px at 0 38%, rgba(220, 53, 69, .06), transparent 60%), var(--bg);
                color: var(--ink);
                line-height: 1.6
            }

            html {
                scroll-behavior: smooth
            }

            /* Loader & backsound */
            #loader-wrapper {
                position: fixed;
                inset: 0;
                z-index: 99999;
                background: rgba(0, 0, 0, .75);
                display: flex;
                justify-content: center;
                align-items: center;
                transition: opacity .2s ease-out, visibility .2s ease-out
            }

            #loader-wrapper.loader-hide {
                opacity: 0;
                visibility: hidden
            }

            .pulsing-logo {
                width: 100px;
                animation: pulse 2s ease-in-out infinite
            }

            @keyframes pulse {

                0%,
                100% {
                    transform: scale(1)
                }

                50% {
                    transform: scale(1.1)
                }
            }

            .backsound-toggle {
                position: fixed;
                bottom: 30px;
                left: 30px;
                z-index: 9999;
                width: 50px;
                height: 50px;
                border-radius: 50%;
                background: rgba(0, 0, 0, .7);
                color: #fff;
                border: none;
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                font-size: 1.3rem;
                box-shadow: 0 4px 15px rgba(0, 0, 0, .3);
                transition: .3s
            }

            .backsound-toggle:hover {
                transform: scale(1.1);
                background: rgba(0, 0, 0, .85)
            }

            /* Header buttons (selaras Profil/Kepesertaan) */
            .logo-section .logo {
                display: flex;
                align-items: center;
                gap: 10px
            }

            .logo-secondary {
                height: 45px;
                width: auto;
                object-fit: contain
            }

            .nav-download,
            .nav-kontak {
                border: 2px solid transparent;
                color: #fff !important;
                padding: 10px 18px;
                border-radius: 8px;
                margin-left: 10px;
                font-weight: 600;
                font-size: .95rem;
                display: inline-flex;
                align-items: center;
                gap: 8px;
                transition: .3s
            }

            .nav-download {
                background: rgba(234, 90, 12, .75);
                box-shadow: 0 2px 8px rgba(234, 90, 12, .35)
            }

            .nav-download:hover {
                background: #fff;
                color: #ea5a0c !important;
                border-color: #ea5a0c;
                transform: translateY(-2px)
            }

            .nav-kontak {
                background: rgba(186, 152, 2, .85);
                box-shadow: 0 2px 8px rgba(44, 82, 130, .25)
            }

            .nav-kontak:hover {
                background: #fff;
                color: #988904 !important;
                border-color: #82682c;
                transform: translateY(-2px)
            }

            @media(max-width:991px) {

                .main-nav .nav-download,
                .main-nav .nav-kontak {
                    display: none
                }
            }

            .container {
                max-width: 1200px;
                margin: 0 auto;
                padding: 0 2rem
            }

            #pageProgress {
                position: fixed;
                top: 0;
                left: 0;
                height: 3px;
                width: 0;
                background: linear-gradient(90deg, var(--red), var(--gold));
                z-index: 9998;
                transition: width .1s linear
            }

            /* ===== Kartu utama + tab (didesain ulang: segmented pill + sliding indicator) ===== */
            .wbs-card {
                position: relative;
                z-index: 2;
                margin: 0 auto 60px
            }

            .wbs-tabs {
                position: relative;
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 6px;
                max-width: 600px;
                margin: 40px auto 44px;
                background: #fff;
                border-radius: 22px;
                padding: 8px;
                box-shadow: 0 14px 34px rgba(30, 60, 114, .16)
            }

            .wbs-tab-bg {
                position: absolute;
                top: 8px;
                bottom: 8px;
                left: 8px;
                border-radius: 15px;
                background: linear-gradient(135deg, var(--red), var(--gold));
                box-shadow: 0 8px 18px rgba(220, 53, 69, .35);
                transition: transform .35s cubic-bezier(.4, 0, .2, 1), width .35s;
                z-index: 0
            }

            .wbs-tab {
                position: relative;
                z-index: 1;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                gap: 5px;
                padding: 15px 6px;
                border: none;
                border-radius: 15px;
                background: transparent;
                cursor: pointer;
                font-family: inherit;
                color: var(--muted);
                font-weight: 800;
                font-size: 13.5px;
                transition: color .3s
            }

            .wbs-tab i {
                font-size: 20px;
                transition: transform .3s
            }

            .wbs-tab.active {
                color: #fff
            }

            .wbs-tab.active i {
                transform: translateY(-2px) scale(1.05)
            }

            .tab-content {
                display: none
            }

            .tab-content.active {
                display: block;
                animation: tabIn .4s ease
            }

            @keyframes tabIn {
                from {
                    opacity: 0;
                    transform: translateY(10px)
                }

                to {
                    opacity: 1;
                    transform: none
                }
            }

            .h-title {
                text-align: center;
                font-size: clamp(24px, 4vw, 34px);
                font-weight: 800;
                color: var(--navy)
            }

            .h-title::after {
                content: '';
                display: block;
                width: 80px;
                height: 4px;
                margin: 10px auto 0;
                border-radius: 2px;
                background: linear-gradient(90deg, var(--red), var(--gold))
            }

            .h-sub {
                text-align: center;
                font-size: 14.5px;
                color: var(--muted);
                margin: 12px 0 22px
            }

            .pill-row {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                gap: 8px;
                margin: 0 0 34px
            }

            .pill-row span {
                display: inline-flex;
                align-items: center;
                gap: 7px;
                padding: 7px 14px;
                border-radius: 50px;
                background: #fff5f5;
                color: var(--red2);
                font-size: 12.5px;
                font-weight: 700;
                border: 1px solid #fecaca;
                transition: .25s
            }

            .pill-row span i {
                color: var(--amber)
            }

            .pill-row span:hover {
                background: var(--gold);
                border-color: var(--gold);
                color: var(--navy);
                transform: translateY(-2px)
            }

            .block-title {
                display: flex;
                flex-direction: column;
                align-items: center;
                gap: 8px;
                text-align: center;
                font-size: clamp(20px, 3vw, 26px);
                font-weight: 800;
                color: var(--navy);
                margin: 72px 0 28px
            }

            .block-title::before {
                content: '';
                order: 1;
                width: 70px;
                height: 4px;
                border-radius: 4px;
                background: linear-gradient(90deg, var(--red), var(--gold))
            }

            .spy-count {
                font-size: 12px;
                font-weight: 700;
                background: #fff5f5;
                color: var(--red2);
                padding: 4px 12px;
                border-radius: 50px
            }

            .scroll-hint {
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 8px;
                font-size: 13px;
                color: var(--muted);
                margin: -6px 0 18px
            }

            .scroll-hint i {
                color: var(--amber);
                animation: bob 1.4s ease-in-out infinite
            }

            @keyframes bob {

                0%,
                100% {
                    transform: translateY(-2px)
                }

                50% {
                    transform: translateY(4px)
                }
            }

            .quote-box {
                max-width: 860px;
                margin: 0 auto;
                text-align: center;
                font-size: 16px;
                color: #374151
            }

            .quote-box::before {
                content: '\f10d';
                font-family: 'Font Awesome 6 Free';
                font-weight: 900;
                display: block;
                font-size: 30px;
                color: var(--gold);
                margin-bottom: 12px
            }

            /* ===== Scroll-spy vertikal (Alur, Kategori, Prosedur) ===== */
            .spy {
                --dot: 54px;
                --pl: 84px;
                --dt: 14px;
                position: relative;
                max-width: 860px;
                margin: 0 auto
            }

            .spy.sm {
                --dot: 42px;
                --pl: 68px;
                --dt: 10px
            }

            .spy-rail {
                position: absolute;
                left: calc(var(--dot)/2 - 2px);
                top: 0;
                width: 4px;
                height: 0;
                border-radius: 4px;
                background: var(--line)
            }

            .spy-fill {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                height: 0;
                border-radius: 4px;
                background: linear-gradient(var(--red), var(--gold));
                box-shadow: 0 0 12px rgba(220, 53, 69, .4)
            }

            .spy-item {
                position: relative;
                padding: 0 0 20px var(--pl);
                cursor: pointer
            }

            .spy-item:last-child {
                padding-bottom: 0
            }

            .spy-dot {
                position: absolute;
                left: 0;
                top: var(--dt);
                width: var(--dot);
                height: var(--dot);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-weight: 800;
                font-size: calc(var(--dot)*.3);
                background: #fff;
                color: var(--muted);
                border: 3px solid var(--line);
                transition: .4s;
                z-index: 1
            }

            .spy-item.passed .spy-dot {
                background: linear-gradient(135deg, var(--navy), var(--blue));
                color: #fff;
                border-color: transparent
            }

            .spy-item.active .spy-dot {
                background: linear-gradient(135deg, var(--red), var(--gold));
                color: #fff;
                border-color: #fff;
                transform: scale(1.14);
                box-shadow: 0 0 0 6px rgba(220, 53, 69, .18)
            }

            .spy-card {
                position: relative;
                overflow: hidden;
                background: #fff;
                border: 2px solid var(--line);
                border-radius: 18px;
                padding: 22px 24px;
                opacity: .55;
                transform: scale(.97);
                transform-origin: left center;
                transition: .45s
            }

            .spy-item.passed .spy-card {
                opacity: .85;
                transform: scale(.985)
            }

            .spy-item.active .spy-card {
                opacity: 1;
                transform: scale(1);
                border-color: var(--gold);
                box-shadow: 0 16px 36px rgba(245, 158, 11, .18)
            }

            .spy-card::before {
                content: '';
                position: absolute;
                left: 0;
                top: 0;
                bottom: 0;
                width: 5px;
                background: linear-gradient(var(--red), var(--gold));
                transform: scaleY(0);
                transform-origin: top;
                transition: transform .5s
            }

            .spy-item.active .spy-card::before {
                transform: scaleY(1)
            }

            .spy-tag {
                display: inline-block;
                font-size: 11.5px;
                font-weight: 800;
                letter-spacing: .08em;
                text-transform: uppercase;
                color: var(--amber);
                margin-bottom: 4px
            }

            .spy-card h4 {
                color: var(--navy);
                font-size: 17px;
                margin-bottom: 6px
            }

            .spy-card p {
                font-size: 14px;
                color: #555
            }

            .spy-card .bgi {
                position: absolute;
                right: 18px;
                top: 50%;
                transform: translateY(-50%);
                font-size: 54px;
                color: var(--navy);
                opacity: .06;
                transition: .5s
            }

            .spy-item.active .bgi {
                opacity: .13;
                color: var(--amber);
                transform: translateY(-50%) rotate(-8deg) scale(1.1)
            }

            .spy.sm .spy-card {
                padding: 15px 20px;
                border-radius: 14px
            }

            .spy.sm .spy-card h4 {
                font-size: 15.5px;
                margin: 0
            }

            .spy.sm .spy-card p {
                font-size: 13.5px;
                margin-top: 4px
            }

            .ticket-note {
                display: flex;
                gap: 8px;
                align-items: center;
                margin-top: 10px;
                font-size: 12.5px;
                font-weight: 700;
                color: var(--navy)
            }

            .ticket-note i {
                color: var(--amber)
            }

            /* ===== Prosedur: alur zig-zag kecil, dengan garis "ular" ===== */
            .zig-wrap {
                position: relative;
                max-width: 560px;
                margin: 0 auto;
                padding: 6px 0
            }

            .zig-svg {
                position: absolute;
                inset: 0;
                width: 100%;
                height: 100%;
                overflow: visible;
                z-index: 0;
                pointer-events: none
            }

            .zig-svg path {
                fill: none;
                stroke: url(#zigGrad);
                stroke-width: 3;
                stroke-linecap: round;
                stroke-dasharray: 1;
                stroke-dashoffset: 1;
                transition: stroke-dashoffset .1s linear
            }

            .zig-item {
                position: relative;
                z-index: 1;
                display: flex;
                align-items: center;
                gap: 14px;
                max-width: 78%;
                margin: 0 0 34px;
                opacity: 0;
                transition: opacity .6s ease, transform .6s ease
            }

            .zig-item.L {
                margin-right: auto;
                flex-direction: row;
                transform: translateX(-16px)
            }

            .zig-item.R {
                margin-left: auto;
                flex-direction: row-reverse;
                text-align: right;
                transform: translateX(16px)
            }

            .zig-item.in {
                opacity: 1;
                transform: none
            }

            .zig-dot {
                position: relative;
                flex: 0 0 58px;
                width: 58px;
                height: 58px;
                border-radius: 50%;
                background: linear-gradient(135deg, var(--navy), var(--blue));
                border: 3px solid #fff;
                box-shadow: 0 6px 16px rgba(30, 60, 114, .28);
                overflow: hidden
            }

            .zig-dot img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                display: block
            }

            .zig-num {
                position: absolute;
                bottom: -4px;
                right: -4px;
                width: 20px;
                height: 20px;
                border-radius: 50%;
                background: linear-gradient(135deg, var(--red), var(--gold));
                color: #fff;
                font-size: 10.5px;
                font-weight: 800;
                display: flex;
                align-items: center;
                justify-content: center;
                border: 2px solid #fff;
                z-index: 1
            }

            .zig-card {
                background: #fff;
                border: 1.5px solid var(--line);
                border-radius: 14px;
                padding: 10px 14px;
                box-shadow: 0 6px 16px rgba(30, 60, 114, .07);
                transition: .25s
            }

            .zig-item:hover .zig-card {
                border-color: var(--gold);
                box-shadow: 0 10px 22px rgba(245, 158, 11, .15)
            }

            .zig-card h4 {
                color: var(--navy);
                font-size: 13.5px;
                margin-bottom: 2px
            }

            .zig-card p {
                font-size: 12px;
                color: #666;
                line-height: 1.45
            }

            .zig-tag {
                display: inline-flex;
                align-items: center;
                gap: 5px;
                margin-top: 6px;
                font-size: 10.5px;
                font-weight: 700;
                color: var(--amber)
            }

            .zig-branch {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                gap: 8px;
                margin: -14px 0 30px;
                position: relative;
                z-index: 1
            }

            .zig-mini {
                display: inline-flex;
                align-items: center;
                gap: 6px;
                padding: 5px 12px;
                border-radius: 50px;
                font-size: 11px;
                font-weight: 800
            }

            .zig-mini.no {
                background: #fef2f2;
                color: var(--red2);
                border: 1px solid #fecaca
            }

            .zig-mini.yes {
                background: #ecfdf5;
                color: #065f46;
                border: 1px solid #a7f3d0
            }

            @media(max-width:560px) {

                .zig-item.L,
                .zig-item.R {
                    max-width: 88%;
                    margin-left: auto;
                    margin-right: auto;
                    flex-direction: row;
                    text-align: left;
                    transform: translateY(16px)
                }
            }

            @media(max-width:768px) {
                .spy {
                    --dot: 44px;
                    --pl: 62px
                }

                .spy.sm {
                    --dot: 36px;
                    --pl: 52px
                }

                .spy-card {
                    padding: 16px
                }

                .spy-card .bgi {
                    font-size: 38px;
                    right: 12px
                }
            }

            /* Jaminan & Kontak */
            .safe-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
                gap: 16px;
                margin-top: 8px
            }

            .safe-item {
                display: flex;
                gap: 14px;
                padding: 18px;
                border-radius: 14px;
                background: #ecfdf5;
                border: 1px solid #a7f3d0;
                font-size: 13.5px;
                color: #065f46
            }

            .safe-item i {
                flex-shrink: 0;
                width: 38px;
                height: 38px;
                border-radius: 50%;
                background: var(--green);
                color: #fff;
                display: flex;
                align-items: center;
                justify-content: center
            }

            .contact-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
                gap: 14px;
                max-width: 760px;
                margin: 0 auto
            }

            .contact-card {
                display: flex;
                align-items: center;
                gap: 14px;
                padding: 16px 18px;
                border-radius: 14px;
                background: #f8fafc;
                border: 1px solid var(--line);
                text-decoration: none;
                color: var(--navy);
                transition: .25s
            }

            .contact-card:hover {
                border-color: var(--gold);
                transform: translateY(-3px);
                box-shadow: 0 10px 22px rgba(0, 0, 0, .08)
            }

            .contact-card .ic {
                width: 44px;
                height: 44px;
                border-radius: 12px;
                background: linear-gradient(135deg, var(--navy), var(--blue));
                color: #fff;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 18px;
                flex-shrink: 0
            }

            .contact-card small {
                display: block;
                color: var(--muted);
                font-size: 12px
            }

            .contact-card strong {
                font-size: 14.5px;
                word-break: break-all
            }

            /* ===== Form Pelaporan - Stepper ===== */
            #pelaporan {
                max-width: 820px;
                margin: 0 auto
            }

            .stepper {
                display: flex;
                align-items: center;
                margin-bottom: 8px
            }

            .st-dot {
                display: flex;
                flex-direction: column;
                align-items: center;
                gap: 6px;
                flex-shrink: 0;
                width: 64px
            }

            .st-dot .c {
                width: 36px;
                height: 36px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-weight: 800;
                font-size: 14px;
                background: #fff;
                color: var(--muted);
                border: 2px solid var(--line);
                transition: .3s
            }

            .st-dot span {
                font-size: 11.5px;
                font-weight: 700;
                color: var(--muted);
                text-align: center;
                line-height: 1.2
            }

            .st-dot.done .c {
                background: var(--green);
                border-color: var(--green);
                color: #fff
            }

            .st-dot.current .c {
                background: linear-gradient(135deg, var(--red), var(--gold));
                border-color: transparent;
                color: #fff;
                box-shadow: 0 0 0 5px rgba(220, 53, 69, .2)
            }

            .st-dot.current span {
                color: var(--navy)
            }

            .st-line {
                flex: 1;
                height: 3px;
                background: var(--line);
                margin-bottom: 22px;
                border-radius: 3px;
                overflow: hidden
            }

            .st-line i {
                display: block;
                height: 100%;
                width: 0;
                background: var(--green);
                transition: width .4s ease
            }

            .st-line.done i {
                width: 100%
            }

            .step {
                display: none
            }

            .step.active {
                display: block;
                animation: tabIn .35s ease
            }

            .step-head {
                margin: 22px 0 18px
            }

            .step-head h3 {
                font-size: 19px;
                font-weight: 800;
                color: var(--navy)
            }

            .step-head p {
                font-size: 13.5px;
                color: var(--muted)
            }

            .anon-toggle {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 14px
            }

            .anon-option {
                position: relative;
                display: flex;
                gap: 14px;
                align-items: flex-start;
                padding: 20px 18px;
                border: 2px solid var(--line);
                border-radius: 16px;
                cursor: pointer;
                transition: .25s;
                background: #fff
            }

            .anon-option input {
                position: absolute;
                opacity: 0
            }

            .anon-option .ic {
                width: 46px;
                height: 46px;
                border-radius: 14px;
                background: var(--bg);
                color: var(--blue);
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 20px;
                flex-shrink: 0;
                transition: .25s
            }

            .anon-option strong {
                display: block;
                color: var(--navy);
                font-size: 15px
            }

            .anon-option .desc {
                font-size: 12.5px;
                color: var(--muted)
            }

            .anon-option:hover {
                border-color: var(--blue)
            }

            .anon-option.checked {
                border-color: var(--blue);
                background: #eff6ff;
                box-shadow: 0 8px 20px rgba(42, 82, 152, .15)
            }

            .anon-option.checked .ic {
                background: linear-gradient(135deg, var(--navy), var(--blue));
                color: #fff
            }

            .anon-option.checked::after {
                content: '\f058';
                font-family: 'Font Awesome 6 Free';
                font-weight: 900;
                position: absolute;
                top: 12px;
                right: 14px;
                color: var(--green);
                font-size: 18px
            }

            .form-grid {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 0 18px
            }

            .form-group {
                display: flex;
                flex-direction: column;
                gap: 6px;
                margin-bottom: 18px
            }

            .form-group label {
                font-size: 14px;
                font-weight: 700;
                color: #374151
            }

            .form-group label .req {
                color: var(--red)
            }

            .form-group input,
            .form-group select,
            .form-group textarea {
                padding: 13px 14px;
                border: 1.5px solid var(--line);
                border-radius: 10px;
                font-size: 14.5px;
                font-family: inherit;
                width: 100%;
                background: #fff;
                transition: .2s
            }

            .form-group input:focus,
            .form-group select:focus,
            .form-group textarea:focus {
                outline: none;
                border-color: var(--blue);
                box-shadow: 0 0 0 4px rgba(42, 82, 152, .12)
            }

            .form-group.invalid input,
            .form-group.invalid select,
            .form-group.invalid textarea {
                border-color: var(--red)
            }

            .form-group small.help {
                color: var(--muted);
                font-size: 12.5px
            }

            .form-group.full {
                grid-column: 1/-1
            }

            .review-box {
                display: grid;
                gap: 16px
            }

            .rv-group {
                background: #fff;
                border: 1.5px solid var(--line);
                border-radius: 16px;
                overflow: hidden;
                box-shadow: 0 6px 18px rgba(30, 60, 114, .06)
            }

            .rv-head {
                display: flex;
                align-items: center;
                gap: 12px;
                padding: 14px 18px;
                background: linear-gradient(135deg, var(--navy), var(--blue))
            }

            .rv-head h4 {
                font-size: 15px;
                font-weight: 800;
                color: #fff
            }

            .rv-ic {
                width: 34px;
                height: 34px;
                border-radius: 10px;
                background: rgba(255, 255, 255, .18);
                color: var(--gold);
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 15px;
                flex-shrink: 0
            }

            .rv-body {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 14px 20px;
                padding: 18px
            }

            .rv-field.full {
                grid-column: 1/-1
            }

            .rv-field small {
                display: flex;
                align-items: center;
                gap: 6px;
                font-size: 12px;
                font-weight: 700;
                color: var(--muted);
                text-transform: uppercase;
                letter-spacing: .05em;
                margin-bottom: 5px
            }

            .rv-field small i {
                color: var(--amber);
                font-size: 12px
            }

            .rv-val {
                background: #f8fafc;
                border: 1px solid var(--line);
                border-left: 4px solid var(--gold);
                border-radius: 10px;
                padding: 10px 14px;
                font-size: 14.5px;
                font-weight: 600;
                color: #1f2937 !important;
                line-height: 1.6;
                word-break: break-word;
                white-space: pre-line
            }

            .rv-empty {
                color: #9ca3af !important;
                font-weight: 500;
                font-style: italic
            }

            .rv-chip {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                padding: 6px 16px;
                border-radius: 50px;
                font-size: 13.5px;
                font-weight: 800;
                color: #fff !important
            }

            .rv-chip.anon {
                background: linear-gradient(135deg, var(--navy), var(--blue))
            }

            .rv-chip.non {
                background: linear-gradient(135deg, var(--green), #059669)
            }

            .rv-chip.kat {
                background: #fffbeb;
                color: #92400e !important;
                border: 1.5px solid var(--gold)
            }

            .rv-note {
                display: flex;
                gap: 10px;
                align-items: flex-start;
                padding: 12px 16px;
                border-radius: 12px;
                background: #ecfdf5;
                border: 1px solid #a7f3d0;
                color: #065f46 !important;
                font-size: 13px
            }

            @media(max-width:768px) {
                .rv-body {
                    grid-template-columns: 1fr
                }
            }

            .step-actions {
                display: flex;
                justify-content: space-between;
                gap: 12px;
                margin-top: 26px;
                padding-top: 20px;
                border-top: 1px dashed var(--line)
            }

            .btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 8px;
                padding: 13px 30px;
                background: linear-gradient(135deg, var(--red) 0%, var(--gold) 100%);
                color: #fff;
                text-decoration: none;
                border-radius: 50px;
                font-weight: 700;
                border: none;
                cursor: pointer;
                font-size: 15px;
                font-family: inherit;
                transition: .25s
            }

            .btn:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 20px rgba(220, 53, 69, .35)
            }

            .btn-outline {
                background: #fff;
                color: var(--navy);
                border: 2px solid var(--navy)
            }

            .btn-outline:hover {
                box-shadow: 0 8px 20px rgba(30, 60, 114, .2)
            }

            .btn[hidden] {
                display: none
            }

            .alert-success-token {
                background: #ecfdf5;
                border-left: 5px solid var(--green);
                border-radius: 12px;
                padding: 20px 24px;
                margin-bottom: 24px
            }

            .alert-success-token p {
                color: #065f46;
                margin-bottom: 10px;
                font-size: 14.5px
            }

            .alert-error {
                background: #fef2f2;
                border-left-color: var(--red)
            }

            .alert-error p,
            .alert-error ul {
                color: #991b1b
            }

            .token-box {
                display: flex;
                align-items: center;
                gap: 12px;
                flex-wrap: wrap
            }

            .token-box code {
                background: #fff;
                border: 1.5px dashed var(--green);
                padding: 10px 16px;
                border-radius: 8px;
                font-size: 17px;
                font-weight: 800;
                color: #065f46;
                word-break: break-all;
                user-select: all
            }

            .copy-btn {
                padding: 9px 16px;
                border-radius: 8px;
                border: 1.5px solid var(--green);
                background: #fff;
                color: var(--green);
                font-weight: 700;
                cursor: pointer;
                font-size: 13px;
                font-family: inherit;
                transition: .2s
            }

            .copy-btn:hover {
                background: var(--green);
                color: #fff
            }

            /* ===== Lacak ===== */
            .lacak-wrap {
                max-width: 640px;
                margin: 0 auto
            }

            .lacak-hero {
                text-align: center;
                margin-bottom: 22px
            }

            .lacak-hero .ic {
                width: 64px;
                height: 64px;
                border-radius: 20px;
                margin: 0 auto 12px;
                background: linear-gradient(135deg, var(--navy), var(--blue));
                color: #fff;
                font-size: 26px;
                display: flex;
                align-items: center;
                justify-content: center;
                box-shadow: 0 10px 24px rgba(30, 60, 114, .3)
            }

            .lacak-input-row {
                display: flex;
                gap: 10px;
                padding: 8px;
                border: 2px solid var(--line);
                border-radius: 60px;
                transition: .2s
            }

            .lacak-input-row:focus-within {
                border-color: var(--blue);
                box-shadow: 0 0 0 4px rgba(42, 82, 152, .12)
            }

            .lacak-input-row input {
                flex: 1;
                min-width: 0;
                border: none;
                outline: none;
                font-size: 15px;
                font-family: inherit;
                padding: 0 14px;
                background: transparent
            }

            .lacak-input-row .btn {
                padding: 12px 24px
            }

            .lacak-hint {
                text-align: center;
                font-size: 13px;
                color: var(--muted);
                margin-top: 12px
            }

            .lacak-hint button {
                border: none;
                background: var(--bg);
                color: var(--navy);
                padding: 3px 10px;
                border-radius: 50px;
                font-family: inherit;
                font-size: 12.5px;
                font-weight: 700;
                cursor: pointer
            }

            .lacak-result {
                margin-top: 26px;
                display: none
            }

            .lacak-result.show {
                display: block;
                animation: tabIn .4s ease
            }

            .res-card {
                border: 1px solid var(--line);
                border-radius: 16px;
                padding: 22px;
                background: #f8fafc
            }

            .status-badge {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                padding: 7px 16px;
                border-radius: 50px;
                font-size: 13.5px;
                font-weight: 800;
                color: #fff;
                margin-bottom: 14px
            }

            .status-diajukan {
                background: #6b7280
            }

            .status-diterima {
                background: var(--blue)
            }

            .status-dalam_antrian {
                background: var(--amber)
            }

            .status-diproses {
                background: var(--gold);
                color: var(--navy)
            }

            .status-ditolak {
                background: var(--red)
            }

            .status-selesai {
                background: var(--green)
            }

            .res-meta {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
                gap: 12px;
                margin-bottom: 18px
            }

            .res-meta div {
                background: #fff;
                border: 1px solid var(--line);
                border-radius: 10px;
                padding: 10px 14px;
                font-size: 13.5px
            }

            .res-meta small {
                display: block;
                color: var(--muted);
                font-size: 11.5px
            }

            .res-meta strong {
                color: var(--navy);
                word-break: break-word
            }

            .timeline {
                list-style: none;
                position: relative;
                padding-left: 6px
            }

            .timeline li {
                position: relative;
                padding: 0 0 18px 40px;
                font-size: 14px;
                color: var(--muted)
            }

            .timeline li::before {
                content: '';
                position: absolute;
                left: 13px;
                top: 26px;
                bottom: -2px;
                width: 3px;
                background: var(--line)
            }

            .timeline li:last-child {
                padding-bottom: 0
            }

            .timeline li:last-child::before {
                display: none
            }

            .timeline .tl-dot {
                position: absolute;
                left: 0;
                top: 0;
                width: 28px;
                height: 28px;
                border-radius: 50%;
                background: #fff;
                border: 2px solid var(--line);
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 11px
            }

            .timeline li strong {
                display: block;
                color: #9ca3af
            }

            .timeline li.done::before {
                background: var(--green)
            }

            .timeline li.done .tl-dot {
                background: var(--green);
                border-color: var(--green);
                color: #fff
            }

            .timeline li.done strong {
                color: var(--navy)
            }

            .timeline li.now .tl-dot {
                background: linear-gradient(135deg, var(--red), var(--gold));
                border-color: transparent;
                color: #fff;
                animation: glow 1.8s ease-in-out infinite
            }

            @keyframes glow {

                0%,
                100% {
                    box-shadow: 0 0 0 4px rgba(220, 53, 69, .22)
                }

                50% {
                    box-shadow: 0 0 0 10px rgba(220, 53, 69, .08)
                }
            }

            .timeline li.now strong {
                color: var(--navy)
            }

            .timeline li.bad .tl-dot {
                background: var(--red);
                border-color: var(--red);
                color: #fff
            }

            .note-box {
                margin-top: 16px;
                padding: 14px 16px;
                border-radius: 10px;
                background: #fffbeb;
                border-left: 4px solid var(--gold);
                font-size: 13.5px;
                color: #78350f
            }

            .res-error {
                display: flex;
                gap: 12px;
                align-items: center;
                padding: 16px 18px;
                border-radius: 12px;
                background: #fef2f2;
                color: #991b1b;
                font-size: 14px
            }

            .spin {
                animation: spin .8s linear infinite
            }

            @keyframes spin {
                to {
                    transform: rotate(360deg)
                }
            }

            .reveal {
                opacity: 0;
                transform: translateY(24px);
                transition: opacity .7s ease, transform .7s ease
            }

            .reveal.in {
                opacity: 1;
                transform: none
            }

            .toast {
                position: fixed;
                left: 50%;
                bottom: 26px;
                transform: translate(-50%, 30px);
                background: var(--navy);
                color: #fff;
                padding: 12px 20px;
                border-radius: 50px;
                font-size: 14px;
                font-weight: 600;
                opacity: 0;
                pointer-events: none;
                transition: .35s;
                z-index: 100000;
                box-shadow: 0 10px 30px rgba(0, 0, 0, .3)
            }

            .toast.show {
                opacity: 1;
                transform: translate(-50%, 0)
            }

            /* ===== Hubungi Kami ===== */
            .contact-hero {
                position: relative;
                isolation: isolate;
                overflow: hidden;
                padding: 58px 0;
                background: #0f2447;
                color: #fff;
                text-align: left
            }

            .contact-hero .cbg {
                position: absolute;
                left: 0;
                right: 0;
                top: -22%;
                bottom: -22%;
                z-index: -2;
                background: var(--bg-img) center/cover no-repeat;
                filter: saturate(.85) brightness(.95);
                transform: translate3d(0, 0, 0) scale(1.1);
                will-change: transform
            }

            .contact-hero::before {
                content: '';
                position: absolute;
                inset: 0;
                z-index: -1;
                background: linear-gradient(90deg, rgba(15, 36, 71, .65), rgba(120, 20, 20, .35) 60%, rgba(15, 36, 71, .6))
            }

            .contact-hero .ch-wrap {
                display: grid;
                grid-template-columns: minmax(180px, 1fr) 2.2fr;
                align-items: center;
                gap: 32px;
                max-width: 1000px;
                margin: 0 auto
            }

            .contact-hero h2 {
                margin: 0;
                font-size: clamp(28px, 3.4vw, 40px);
                line-height: 1.15;
                font-style: italic;
                font-weight: 800;
                text-shadow: 0 4px 18px rgba(0, 0, 0, .5)
            }

            .glass-actions {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 14px
            }

            .glass-btn {
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 12px;
                padding: 14px 20px;
                border-radius: 16px;
                border: 1.5px solid rgba(255, 255, 255, .6);
                background: rgba(255, 255, 255, .08);
                backdrop-filter: blur(6px);
                color: #fff;
                font-family: inherit;
                font-weight: 700;
                font-size: 15px;
                text-decoration: none;
                cursor: pointer;
                transition: .3s
            }

            .glass-btn:hover {
                background: linear-gradient(135deg, var(--red), var(--gold));
                border-color: transparent;
                color: #fff;
                transform: translateY(-4px);
                box-shadow: 0 14px 30px rgba(0, 0, 0, .35)
            }

            @media(max-width:768px) {
                .contact-hero {
                    padding: 44px 0;
                    text-align: center
                }

                .contact-hero .ch-wrap {
                    grid-template-columns: 1fr;
                    gap: 20px
                }

                .glass-actions {
                    grid-template-columns: 1fr
                }
            }

            /* ===== Responsive umum ===== */
            @media(max-width:768px) {
                .wbs-tabs {
                    max-width: none;
                    margin: 26px 12px 34px
                }

                .anon-toggle,
                .form-grid {
                    grid-template-columns: 1fr
                }

                .st-dot {
                    width: 52px
                }

                .st-dot span {
                    font-size: 10.5px
                }

                .step-actions .btn {
                    flex: 1;
                    padding: 13px 14px
                }

                .lacak-input-row {
                    flex-direction: column;
                    border-radius: 18px;
                    padding: 10px
                }

                .lacak-input-row input {
                    padding: 10px 8px
                }

                .backsound-toggle {
                    bottom: 16px;
                    left: 16px
                }
            }

            @media(prefers-reduced-motion:reduce) {

                *,
                *::before,
                *::after {
                    animation: none !important;
                    transition: none !important
                }

                html {
                    scroll-behavior: auto
                }

                .reveal {
                    opacity: 1;
                    transform: none
                }
            }
        </style>
    </head>

    <body>
        <div id="pageProgress"></div>
        <audio id="backsound"></audio>
        <button id="toggleSound" class="backsound-toggle" aria-label="Toggle Backsound"><i
                class="fas fa-volume-mute"></i></button>

        <div id="loader-wrapper">
            <div class="logo-container"><img src="{{ asset('image/logodapenbrk.png') }}" alt="Logo Dana Pensiun"
                    class="pulsing-logo"></div>
        </div>

        <header class="main-header" id="mainHeader">
            <div class="container">
                <div class="logo-section">
                    <a href="{{ url('/') }}" class="logo">
                        <img src="{{ asset('image/logodanapensiun.png') }}" alt="Logo Dana Pensiun" class="logo-secondary">
                        <img src="{{ asset('image/logo.png') }}" alt="Logo">
                    </a>
                </div>
                <nav class="main-nav">
                    <a href="{{ url('/') }}" class="nav-link">Beranda</a>
                    <a href="{{ url('/profile') }}" class="nav-link">Profil</a>
                    <a href="{{ route('Galeri') }}" class="nav-link">Galeri</a>
                    <a href="{{ url('/kepesertaan') }}" class="nav-link">Kepesertaan</a>
                    <a href="{{ url('/warta') }}" class="nav-link">Warta</a>
                    <a href="{{ route('wbs.index') }}"
                        class="nav-link {{ request()->routeIs('wbs.*') ? 'active' : '' }}">WBS</a>
                    <a href="{{ route('formulir') }}" class="nav-link nav-download"><i class="fas fa-download"></i> Unduh
                        Formulir</a>
                    <a href="{{ route('Pengaduan') }}" class="nav-link nav-kontak"><i class="fas fa-phone-alt"></i>
                        Bantuan/Kontak</a>
                </nav>
                <div class="mobile-nav" id="mobileNav">
                    <a href="{{ url('/') }}" class="nav-link">Beranda</a>
                    <a href="{{ url('/profile') }}" class="nav-link">Profil</a>
                    <a href="{{ route('Galeri') }}" class="nav-link">Galeri</a>
                    <a href="{{ url('/kepesertaan') }}" class="nav-link">Kepesertaan</a>
                    <a href="{{ url('/warta') }}" class="nav-link">Warta</a>
                    <a href="{{ route('wbs.index') }}"
                        class="nav-link {{ request()->routeIs('wbs.*') ? 'active' : '' }}">WBS</a>
                    <a href="{{ route('formulir') }}" class="nav-link nav-download"><i class="fas fa-download"></i> Unduh
                        Formulir</a>
                    <a href="{{ route('Pengaduan') }}" class="nav-link nav-kontak"><i class="fas fa-phone-alt"></i>
                        Bantuan/Kontak</a>
                </div>
                <div class="header-actions"><button class="mobile-menu-btn"><i class="fas fa-bars"></i></button></div>
            </div>
        </header>

        <div id="home" class="wbs-main">

            <div class="hero-slider">
                <div class="slide active" style="background-image:url('{{ asset('image/flyerwbs.png') }}');">
                    <div class="slide-content">
                        <h1>Jaminan Masa Depan<br>Yang Cerah</h1>
                        <p>Dana Pensiun Bank Riau Kepri memberikan perlindungan finansial untuk hari tua Anda dengan
                            pengelolaan profesional dan transparan.</p>
                    </div>
                </div>
                <div class="slide" style="background-image:url('{{ asset('image/flyerwbs1.png') }}');">
                    <div class="slide-content">
                        <h1>Investasi Terpercaya<br>Untuk Masa Pensiun</h1>
                        <p>Pengelolaan dana pensiun yang amanah dan profesional dengan hasil investasi optimal untuk
                            kesejahteraan peserta.</p>
                    </div>
                </div>
                <div class="slide" style="background-image:url('{{ asset('image/flyerwbs2.png') }}');">
                    <div class="slide-content">
                        <h1>Layanan Prima<br>Untuk Peserta</h1>
                        <p>Tim ahli kami siap melayani kebutuhan kepesertaan Anda dengan profesional dan responsif.</p>
                    </div>
                </div>
                <div class="slider-dots">
                    <span class="dot active" onclick="changeSlide(0)"></span>
                    <span class="dot" onclick="changeSlide(1)"></span>
                    <span class="dot" onclick="changeSlide(2)"></span>
                </div>
            </div>

            <section class="quick-links">
                <div class="container">
                    <div class="wbs-card">

                        <div class="wbs-tabs" role="tablist">
                            <div class="wbs-tab-bg" id="tabBg"></div>
                            <button type="button" class="wbs-tab active" data-tab="informasi"
                                onclick="openTab('informasi')"><i class="fas fa-circle-info"></i> Informasi</button>
                            <button type="button" class="wbs-tab" data-tab="pelaporan"
                                onclick="openTab('pelaporan')"><i class="fas fa-pen-to-square"></i> Lapor</button>
                            <button type="button" class="wbs-tab" data-tab="lacak" onclick="openTab('lacak')"><i
                                    class="fas fa-magnifying-glass-location"></i> Lacak</button>
                        </div>

                        {{-- ===== TAB: INFORMASI ===== --}}
                        <div id="informasi" class="tab-content active">
                            <h2 class="h-title">Layanan Whistleblowing System</h2>
                            <p class="h-sub">Laporkan dugaan pelanggaran secara aman dan rahasia</p>
                            <div class="pill-row">
                                <span><i class="fas fa-user-secret"></i> Bisa Anonim</span>
                                <span><i class="fas fa-shield-halved"></i> Pelapor Dilindungi</span>
                                <span><i class="fas fa-ticket"></i> Lacak dengan Tiket</span>
                                <span><i class="fas fa-user-tie"></i> Ditangani Tim Anti Fraud</span>
                            </div>

                            <div class="quote-box reveal">
                                Whistleblowing System (pengaduan pelanggaran) merupakan sarana komunikasi bagi pihak
                                internal dan pihak eksternal Dapen Bank Riau Kepri untuk melaporkan tindakan fraud atau
                                pelanggaran yang dilakukan oleh pelaku di lingkungan internal Dapen Bank Riau Kepri.
                                Pelaporan harus didasari itikad baik dan bukti yang dapat dipertanggungjawabkan, bukan
                                merupakan suatu keluhan pribadi ataupun didasari kehendak buruk/fitnah.
                                <br><br>
                                <small style="color:#6b7280;">Referensi: POJK 12 Tahun 2024 tentang Penerapan Strategi Anti
                                    Fraud Bagi Lembaga Jasa Keuangan.</small>
                            </div>

                            <h3 class="block-title reveal">Alur Tahapan Whistleblowing System</h3>
                            <div class="scroll-hint"><i class="fas fa-angles-down"></i> Gulir ke bawah, tahapan tersorot
                                otomatis</div>
                            <div class="spy" id="spyFlow">
                                <div class="spy-rail"><i class="spy-fill"></i></div>
                                <div class="spy-item">
                                    <div class="spy-dot">01</div>
                                    <div class="spy-card"><i class="fas fa-pen-to-square bgi"></i><span
                                            class="spy-tag">Tahap 1</span>
                                        <h4>Input Laporan</h4>
                                        <p>Melaporkan dugaan fraud/pelanggaran melalui form yang telah disediakan pada
                                            sarana WBS.</p>
                                    </div>
                                </div>
                                <div class="spy-item">
                                    <div class="spy-dot">02</div>
                                    <div class="spy-card"><i class="fas fa-clipboard-check bgi"></i><span
                                            class="spy-tag">Tahap 2</span>
                                        <h4>Validasi Laporan</h4>
                                        <p>Tim Anti Fraud melakukan validasi/pemeriksaan serta menindaklanjuti laporan yang
                                            masuk.</p>
                                    </div>
                                </div>
                                <div class="spy-item">
                                    <div class="spy-dot">03</div>
                                    <div class="spy-card"><i class="fas fa-circle-check bgi"></i><span
                                            class="spy-tag">Tahap 3</span>
                                        <h4>Laporan Selesai</h4>
                                        <p>Laporan telah ditindaklanjuti dan pelapor dapat melihat status laporan tersebut.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <h3 class="block-title reveal">Kategori Pengaduan <span
                                    class="spy-count">{{ count($kategoriPengaduan) }} kategori</span></h3>
                            <div class="scroll-hint"><i class="fas fa-angles-down"></i> Gulir, kategori berpindah otomatis
                            </div>
                            <div class="spy sm" id="spyKategori">
                                <div class="spy-rail"><i class="spy-fill"></i></div>
                                @foreach ($kategoriPengaduan as $nama => $deskripsi)
                                    <div class="spy-item">
                                        <div class="spy-dot">{{ $loop->iteration }}</div>
                                        <div class="spy-card">
                                            <h4>{{ $nama }}</h4>
                                            <p>{{ $deskripsi }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <h3 class="block-title reveal">Jaminan Kerahasiaan</h3>
                            <div class="safe-grid reveal">
                                <div class="safe-item"><i class="fas fa-user-shield"></i>
                                    <div>Sistem ini menjamin kerahasiaan Anda, baik identitas pribadi maupun substansi
                                        laporan yang disampaikan.</div>
                                </div>
                                <div class="safe-item"><i class="fas fa-id-card"></i>
                                    <div>Pelapor dapat menyampaikan identitas pribadi, sepanjang laporan yang disampaikan
                                        jelas dan benar.</div>
                                </div>
                                <div class="safe-item"><i class="fas fa-hand-holding-heart"></i>
                                    <div>Dana Pensiun Bank Riau Kepri memberikan perlindungan dari perlakuan yang merugikan
                                        pelapor, seperti intimidasi, pelecehan, atau diskriminasi dalam segala bentuk.</div>
                                </div>
                            </div>

                            {{-- ===== PROSEDUR PELAPORAN WBS (alur zig-zag) ===== --}}
                            <h3 class="block-title reveal">Prosedur Penanganan Laporan <span class="spy-count">6
                                    tahap</span></h3>
                            <p class="h-sub" style="margin-top:-14px;">Alur laporan dari pelapor hingga eksekusi sanksi
                            </p>

                            <div class="zig-wrap reveal" id="zigWrap">
                                <svg class="zig-svg" id="zigSvg" preserveAspectRatio="none">
                                    <path id="zigPath"></path>
                                </svg>

                                <div class="zig-item L" data-zig>
                                    <div class="zig-dot"><span class="zig-num">1</span><img
                                            src="{{ asset('image/registrasi.jpg') }}" alt="Penerimaan &amp; Registrasi"
                                            loading="lazy" onerror="this.style.display='none'"></div>
                                    <div class="zig-card">
                                        <h4>Penerimaan &amp; Registrasi</h4>
                                        <p>Laporan dicatat &amp; diregistrasi Tim WBS.</p>
                                        <span class="zig-tag"><i class="fas fa-ticket"></i> Terbit nomor tiket ke
                                            pelapor</span>
                                    </div>
                                </div>
                                <div class="zig-item R" data-zig>
                                    <div class="zig-dot"><span class="zig-num">2</span><img
                                            src="{{ asset('image/verifikasi.jpg') }}" alt="Verifikasi Awal"
                                            loading="lazy" onerror="this.style.display='none'"></div>
                                    <div class="zig-card">
                                        <h4>Verifikasi Awal</h4>
                                        <p>Menilai kelayakan &amp; kecukupan bukti laporan.</p>

                                    </div>
                                </div>

                                <div class="zig-branch">
                                    <div class="zig-mini no"><i class="fas fa-xmark"></i> Tidak layak / kurang bukti →
                                        Ditolak/diarsipkan</div>
                                    <div class="zig-mini yes"><i class="fas fa-check"></i> Layak ditindaklanjuti</div>
                                </div>

                                <div class="zig-item L" data-zig>
                                    <div class="zig-dot"><span class="zig-num">3</span><img
                                            src="{{ asset('image/prosedur/3-investigasi.jpg') }}" alt="Audit Investigasi"
                                            loading="lazy" onerror="this.style.display='none'"></div>
                                    <div class="zig-card">
                                        <h4>Audit Investigasi</h4>
                                        <p>Tim melaksanakan audit investigasi khusus.</p>

                                    </div>
                                </div>
                                <div class="zig-item R" data-zig>
                                    <div class="zig-dot"><span class="zig-num">4</span><img
                                            src="{{ asset('image/prosedur/4-lhi.jpg') }}" alt="Penyusunan LHI"
                                            loading="lazy" onerror="this.style.display='none'"></div>
                                    <div class="zig-card">
                                        <h4>Penyusunan LHI</h4>
                                        <p>LHI &amp; rekomendasi sanksi disusun.</p>

                                    </div>
                                </div>
                                <div class="zig-item L" data-zig>
                                    <div class="zig-dot"><span class="zig-num">5</span><img
                                            src="{{ asset('image/prosedur/5-rekomendasi.jpg') }}"
                                            alt="Penyampaian Rekomendasi" loading="lazy"
                                            onerror="this.style.display='none'"></div>
                                    <div class="zig-card">
                                        <h4>Penyampaian Rekomendasi</h4>
                                        <p>Disampaikan ke Pengurus &amp; Dewan Pengawas.</p>

                                    </div>
                                </div>
                                <div class="zig-item R" data-zig>
                                    <div class="zig-dot"><span class="zig-num">6</span><img
                                            src="{{ asset('image/prosedur/6-keputusan.jpg') }}"
                                            alt="Keputusan &amp; Eksekusi" loading="lazy"
                                            onerror="this.style.display='none'"></div>
                                    <div class="zig-card">
                                        <h4>Keputusan &amp; Eksekusi</h4>
                                        <p>Sanksi dieksekusi, insiden dilaporkan ke OJK.</p>

                                    </div>
                                </div>
                            </div>

                            <h3 class="block-title reveal">Contact Person</h3>
                            <div class="contact-grid reveal">
                                <a class="contact-card" href="mailto:wbsdapenbrk@gmail.com">
                                    <div class="ic"><i class="fas fa-envelope"></i></div>
                                    <div><small>Email</small><strong>wbsdapenbrk@gmail.com</strong></div>
                                </a>
                                <a class="contact-card" href="https://wa.me/628137964058" target="_blank"
                                    rel="noopener">
                                    <div class="ic"><i class="fab fa-whatsapp"></i></div>
                                    <div><small>WhatsApp</small><strong>0813-7964-058</strong></div>
                                </a>
                            </div>

                            <div style="text-align:center;margin-top:34px;">
                                <button type="button" class="btn" onclick="goTab('pelaporan')"><i
                                        class="fas fa-paper-plane"></i> Buat Laporan Sekarang</button>
                            </div>
                        </div>

                        {{-- ===== TAB: PELAPORAN ===== --}}
                        <div id="pelaporan" class="tab-content">
                            @if (session('success_token'))
                                <div class="alert-success-token">
                                    <p><strong>Laporan berhasil dikirim.</strong> Simpan nomor tiket berikut untuk melacak
                                        status laporan Anda:</p>
                                    <div class="token-box">
                                        <code id="tokenValue">{{ session('success_token') }}</code>
                                        <button type="button" class="copy-btn" onclick="copyToken()"><i
                                                class="fas fa-copy"></i> Salin Token</button>
                                    </div>
                                </div>
                            @endif
                            @if ($errors->any())
                                <div class="alert-success-token alert-error">
                                    <p><strong>Terdapat kesalahan pada form:</strong></p>
                                    <ul style="padding-left:18px;font-size:13.5px;">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <h2 class="h-title">Buat Laporan</h2>
                            <p class="h-sub">Isi laporan per langkah. Hanya butuh beberapa menit.</p>
                            <div class="stepper" id="stepper"></div>

                            <form action="{{ route('wbs.store') }}" method="POST" id="formPelaporan" novalidate>
                                @csrf

                                <div class="step" data-key="anonim" data-label="Status">
                                    <div class="step-head">
                                        <h3>Bagaimana Anda ingin melapor?</h3>
                                        <p>Pilih apakah identitas Anda ingin dicantumkan atau dirahasiakan.</p>
                                    </div>
                                    <div class="anon-toggle">
                                        <label class="anon-option" id="optAnonim">
                                            <input type="radio" name="is_anonim" value="1"
                                                onchange="toggleAnonim(true)"
                                                {{ old('is_anonim', '1') == '1' ? 'checked' : '' }}>
                                            <div class="ic"><i class="fas fa-user-secret"></i></div>
                                            <div><strong>Anonim (Rahasia)</strong><span class="desc">Identitas Anda tidak
                                                    perlu diisi</span></div>
                                        </label>
                                        <label class="anon-option" id="optNonAnonim">
                                            <input type="radio" name="is_anonim" value="0"
                                                onchange="toggleAnonim(false)"
                                                {{ old('is_anonim') === '0' ? 'checked' : '' }}>
                                            <div class="ic"><i class="fas fa-user-check"></i></div>
                                            <div><strong>Non-Anonim (Mencantumkan Identitas)</strong><span
                                                    class="desc">Agar tim investigasi dapat menghubungi Anda</span></div>
                                        </label>
                                    </div>
                                </div>

                                <div class="step" data-key="identitas" data-label="Identitas" id="identitasFields">
                                    <div class="step-head">
                                        <h3>Identitas Pelapor</h3>
                                        <p>Data Anda dijaga kerahasiaannya oleh Tim Anti Fraud.</p>
                                    </div>
                                    <div class="form-grid">
                                        <div class="form-group"><label>Nama Lengkap</label><input type="text"
                                                name="nama_lengkap" value="{{ old('nama_lengkap') }}"></div>
                                        <div class="form-group"><label>Hubungan dengan DAPEN</label>
                                            <select name="hubungan_dapen">
                                                <option value="">-- Pilih --</option>
                                                @foreach ($hubunganDapen as $key => $label)
                                                    <option value="{{ $key }}"
                                                        {{ old('hubungan_dapen') == $key ? 'selected' : '' }}>
                                                        {{ $label }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group"><label>Nomor Identitas (NIK/NIP/No.
                                                Kepesertaan)</label><input type="text" name="nomor_identitas"
                                                value="{{ old('nomor_identitas') }}"><small
                                                class="help">Opsional</small></div>
                                        <div class="form-group"><label>Nomor WhatsApp/Telepon</label><input type="text"
                                                name="no_kontak" value="{{ old('no_kontak') }}"
                                                placeholder="08xxxxxxxxxx" inputmode="tel"><small class="help">Token
                                                akan dikirim ke nomor ini</small></div>
                                        <div class="form-group full"><label>Alamat Email Pribadi</label><input
                                                type="email" name="email_pribadi" value="{{ old('email_pribadi') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="step" data-key="kejadian" data-label="Kejadian">
                                    <div class="step-head">
                                        <h3>Apa yang terjadi?</h3>
                                        <p>Ceritakan kejadian sejelas mungkin: di mana, kapan, dan bagaimana.</p>
                                    </div>
                                    <div class="form-group"><label>Kategori Pelaporan <span
                                                class="req">*</span></label>
                                        <select name="kategori_pengaduan" required>
                                            <option value="">-- Silahkan Pilih Kategori Pelaporan --</option>
                                            @foreach ($kategoriPengaduan as $nama => $deskripsi)
                                                <option value="{{ $nama }}"
                                                    {{ old('kategori_pengaduan') == $nama ? 'selected' : '' }}>
                                                    {{ $nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group"><label>Deskripsi Kejadian (Lokasi, Waktu, Rincian Kejadian)
                                            <span class="req">*</span></label>
                                        <textarea name="deskripsi_kejadian" rows="5" required>{{ old('deskripsi_kejadian') }}</textarea>
                                    </div>
                                    <div class="form-group"><label>Deskripsi Kerugian</label>
                                        <textarea name="deskripsi_kerugian" rows="3">{{ old('deskripsi_kerugian') }}</textarea><small class="help">Opsional</small>
                                    </div>
                                </div>

                                <div class="step" data-key="terlapor" data-label="Terlapor">
                                    <div class="step-head">
                                        <h3>Siapa yang dilaporkan?</h3>
                                        <p>Jika tidak tahu nama lengkap, tulis nama panggilan atau inisial.</p>
                                    </div>
                                    <div class="form-grid">
                                        <div class="form-group"><label>Nama Lengkap / Inisial Terlapor <span
                                                    class="req">*</span></label><input type="text"
                                                name="nama_terlapor" value="{{ old('nama_terlapor') }}" required></div>
                                        <div class="form-group"><label>Jabatan / Divisi Terlapor</label>
                                            <select name="jabatan_terlapor">
                                                <option value="">-- Pilih --</option>
                                                @foreach ($jabatanTerlapor as $jabatan)
                                                    <option value="{{ $jabatan }}"
                                                        {{ old('jabatan_terlapor') == $jabatan ? 'selected' : '' }}>
                                                        {{ $jabatan }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group full"><label>Informasi Tambahan Terlapor (Opsional)</label>
                                            <textarea name="info_tambahan_terlapor" rows="3"
                                                placeholder="Ciri-ciri fisik, NIP, atau info lain yang membantu identifikasi">{{ old('info_tambahan_terlapor') }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="step" data-key="review" data-label="Periksa">
                                    <div class="step-head">
                                        <h3>Periksa kembali laporan Anda</h3>
                                        <p>Pastikan data sudah benar sebelum dikirim. Gunakan tombol Kembali untuk mengubah.
                                        </p>
                                    </div>
                                    <div class="review-box" id="reviewBox"></div>
                                </div>

                                <div class="step-actions">
                                    <button type="button" class="btn btn-outline" id="btnPrev"><i
                                            class="fas fa-arrow-left"></i> Kembali</button>
                                    <button type="button" class="btn" id="btnNext">Lanjut <i
                                            class="fas fa-arrow-right"></i></button>
                                    <button type="submit" class="btn" id="btnSubmit" hidden><i
                                            class="fas fa-paper-plane"></i> Kirim Laporan</button>
                                </div>
                            </form>
                        </div>

                        {{-- ===== TAB: LACAK ===== --}}
                        <div id="lacak" class="tab-content">
                            <div class="lacak-wrap">
                                <div class="lacak-hero">
                                    <div class="ic"><i class="fas fa-ticket"></i></div>
                                    <h2 class="h-title">Lacak Status Laporan</h2>
                                    <p class="h-sub" style="margin-bottom:0;">Masukkan nomor tiket yang Anda terima saat
                                        mengirim laporan.</p>
                                </div>
                                <div class="lacak-input-row">
                                    <input type="text" id="lacakToken" placeholder="Contoh: dapenbrk-9a7Ai"
                                        autocomplete="off" autocapitalize="off">
                                    <button type="button" class="btn" id="btnLacak" onclick="lacakStatus()"><i
                                            class="fas fa-search"></i> Lacak</button>
                                </div>
                                <p class="lacak-hint">Nomor tiket diawali <button type="button"
                                        onclick="document.getElementById('lacakToken').value='dapenbrk-';document.getElementById('lacakToken').focus()">dapenbrk-</button>
                                </p>
                                <div id="lacakResult" class="lacak-result"></div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>

            {{-- ===== HUBUNGI KAMI ===== --}}
            <section class="contact-hero reveal" style="--bg-img:url('{{ asset('image/LAM Kepri.jpeg') }}')">
                <div class="cbg" aria-hidden="true"></div>
                <div class="container">
                    <div class="ch-wrap">
                        <h2>Hubungi Kami</h2>
                        <div class="glass-actions">
                            <a class="glass-btn" href="mailto:wbsdapenbrk@gmail.com"><i class="far fa-envelope"></i>
                                Layanan E-mail</a>
                            <a class="glass-btn" href="https://wa.me/628137964058" target="_blank" rel="noopener"><i
                                    class="fab fa-whatsapp"></i> Kontak WhatsApp</a>
                            <button type="button" class="glass-btn" onclick="goTab('pelaporan')"><i
                                    class="fas fa-bullhorn"></i> Buat Laporan</button>
                            <button type="button" class="glass-btn" onclick="goTab('lacak')"><i
                                    class="fas fa-magnifying-glass-location"></i> Lacak Laporan</button>
                        </div>
                    </div>
                </div>
            </section>

            <footer>
                <div class="container">
                    <div class="footer-grid">
                        <div class="footer-section">
                            <h3>Tentang Kami</h3>
                            <p style="color:#d1d5db;font-size:.95rem;line-height:1.9;">Dana Pensiun Bank Riau Kepri
                                memberikan jaminan kesejahteraan di masa pensiun dengan pengelolaan yang profesional dan
                                transparan.</p>
                            <div class="social-links"><a href="https://wa.me/628137964058" target="_blank"
                                    aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a></div>
                        </div>
                        <div class="footer-section">
                            <h3>Tautan Cepat</h3>
                            <ul>
                                <li><a href="{{ url('/') }}">Beranda</a></li>
                                <li><a href="{{ url('/profile') }}">Profil</a></li>
                                <li><a href="{{ url('/kepesertaan') }}">Kepesertaan</a></li>
                                <li><a href="{{ url('/warta') }}">Warta</a></li>
                                <li><a href="{{ route('simulasi') }}">Simulasi Manfaat</a></li>
                            </ul>
                        </div>
                        <div class="footer-section">
                            <h3>Layanan</h3>
                            <ul>
                                <li><a href="{{ route('simulasi') }}">Simulasi Manfaat</a></li>
                                <li><a href="{{ route('wbs.index') }}">Whistleblowing System</a></li>
                                <li><a href="{{ route('Pengaduan') }}">Pengaduan</a></li>
                                <li><a href="{{ route('formulir') }}">Download Formulir</a></li>
                            </ul>
                        </div>
                        <div class="footer-section">
                            <h3 style="margin-bottom:1rem;">Kontak &amp; Legalitas</h3>
                            <ul style="margin-bottom:2rem;">
                                <li style="display:flex;gap:.75rem;color:#d1d5db;margin-bottom:.5rem;"><i
                                        class="fas fa-map-marker-alt"
                                        style="margin-top:.25rem;color:#fbbf24;"></i><span>Jl. Arifin Ahmad No. 54-56 Kel
                                        Sidomulyo Timur Kec Marpoyan Damai Pekanbaru - 28125</span></li>
                                <li style="display:flex;gap:.75rem;color:#d1d5db;margin-bottom:.5rem;"><i
                                        class="fas fa-phone" style="color:#fbbf24;"></i><span>(0761) 5781181</span></li>
                                <li style="display:flex;gap:.75rem;color:#d1d5db;margin-bottom:1rem;"><i
                                        class="fas fa-envelope"
                                        style="color:#fbbf24;"></i><span>dapenbankriau@gmail.com</span></li>
                            </ul>
                            <div class="compliance-group">
                                <div class="compliance-item">
                                    <p>Terdaftar dan Diawasi Oleh:</p><a href="https://www.ojk.go.id" target="_blank"
                                        rel="noopener noreferrer"><img src="{{ asset('image/logo-ojk.jpg') }}"
                                            alt="OJK Logo" class="logo-img bg-white"></a>
                                </div>
                                <div class="compliance-item">
                                    <p>Terdaftar Sebagai Anggota:</p><a href="https://www.adpi.or.id" target="_blank"
                                        rel="noopener noreferrer"><img src="{{ asset('image/adpi.jpg') }}"
                                            alt="ADPI Logo" class="logo-img bg-white"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="footer-bottom">
                        <p>&copy;Dana Pensiun Bank Riau Kepri</p>
                    </div>
                </div>
            </footer>

            <div class="toast" id="toast"></div>

            <script>
                const initialTab = @json(session('open_tab'));
                const hasErrors = @json($errors->any());
                const hasToken = @json((bool) session('success_token'));

                const $ = (s, r = document) => r.querySelector(s);
                const $$ = (s, r = document) => Array.from(r.querySelectorAll(s));
                const esc = s => String(s ?? '').replace(/[&<>"']/g, c => ({
                    '&': '&amp;',
                    '<': '&lt;',
                    '>': '&gt;',
                    '"': '&quot;',
                    "'": '&#39;'
                } [c]));

                function toast(msg) {
                    const t = $('#toast');
                    t.textContent = msg;
                    t.classList.add('show');
                    clearTimeout(toast._t);
                    toast._t = setTimeout(() => t.classList.remove('show'), 2200);
                }

                window.addEventListener("load", () => setTimeout(() => $("#loader-wrapper").classList.add("loader-hide"), 300));
                $(".mobile-menu-btn")?.addEventListener("click", e => {
                    $("#mobileNav").classList.toggle("active");
                    e.currentTarget.classList.toggle("active");
                });

                /* ---------- Tab + sliding indicator ---------- */
                function moveTabBg() {
                    const active = $('.wbs-tab.active'),
                        bg = $('#tabBg');
                    if (!active || !bg) return;
                    bg.style.width = active.offsetWidth + 'px';
                    bg.style.transform = `translateX(${active.offsetLeft - 8}px)`;
                }

                function openTab(tabName) {
                    $$('.tab-content').forEach(el => el.classList.remove('active'));
                    $$('.wbs-tab').forEach(el => el.classList.toggle('active', el.dataset.tab === tabName));
                    $('#' + tabName).classList.add('active');
                    moveTabBg();
                    window.updateSpy && requestAnimationFrame(window.updateSpy);
                }

                function goTab(name) {
                    openTab(name);
                    $('.wbs-card').scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }

                if (initialTab && ['informasi', 'pelaporan', 'lacak'].includes(initialTab)) openTab(initialTab);
                else if (hasErrors || hasToken) openTab('pelaporan');
                else openTab('informasi');

                /* ---------- Form stepper ---------- */
                const form = $('#formPelaporan');
                const allSteps = $$('.step', form);
                let cur = 0;

                const isAnonim = () => $('input[name="is_anonim"]:checked').value === '1';
                const activeSteps = () => allSteps.filter(s => !(s.dataset.key === 'identitas' && isAnonim()));

                function toggleAnonim(anonim) {
                    $('#optAnonim').classList.toggle('checked', anonim);
                    $('#optNonAnonim').classList.toggle('checked', !anonim);
                    renderStepper();
                }

                function renderStepper() {
                    const steps = activeSteps();
                    if (cur > steps.length - 1) cur = steps.length - 1;
                    $('#stepper').innerHTML = steps.map((s, n) => {
                        const state = n < cur ? 'done' : (n === cur ? 'current' : '');
                        const dot =
                            `<div class="st-dot ${state}"><div class="c">${n < cur ? '<i class="fas fa-check"></i>' : n + 1}</div><span>${esc(s.dataset.label)}</span></div>`;
                        const line = n < steps.length - 1 ? `<div class="st-line ${n < cur ? 'done' : ''}"><i></i></div>` :
                            '';
                        return dot + line;
                    }).join('');
                    allSteps.forEach(s => s.classList.remove('active'));
                    steps[cur].classList.add('active');
                    const last = cur === steps.length - 1;
                    $('#btnPrev').style.visibility = cur === 0 ? 'hidden' : 'visible';
                    $('#btnNext').hidden = last;
                    $('#btnSubmit').hidden = !last;
                    if (last) buildReview();
                }

                function validateStep() {
                    const step = activeSteps()[cur];
                    let ok = true,
                        firstBad = null;
                    $$('input, select, textarea', step).forEach(f => {
                        const g = f.closest('.form-group');
                        const invalid = (f.hasAttribute('required') && !f.value.trim()) || (f.type === 'email' && f.value &&
                            !f.checkValidity());
                        g?.classList.toggle('invalid', invalid);
                        if (invalid) {
                            ok = false;
                            firstBad = firstBad || f;
                        }
                    });
                    if (!ok) {
                        toast('Lengkapi kolom yang ditandai terlebih dahulu.');
                        firstBad.focus();
                    }
                    return ok;
                }
                const scrollToStepper = () => $('#stepper').scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });

                $('#btnNext').onclick = () => {
                    if (validateStep()) {
                        cur++;
                        renderStepper();
                        scrollToStepper();
                    }
                };
                $('#btnPrev').onclick = () => {
                    if (cur > 0) cur--;
                    renderStepper();
                    scrollToStepper();
                };

                form.addEventListener('keydown', e => {
                    if (e.key === 'Enter' && e.target.tagName !== 'TEXTAREA') {
                        e.preventDefault();
                        if (!$('#btnNext').hidden) $('#btnNext').click();
                    }
                });

                form.addEventListener('submit', e => {
                    const steps = activeSteps();
                    if (cur !== steps.length - 1) {
                        e.preventDefault();
                        return;
                    }
                    for (let n = 0; n < steps.length - 1; n++) {
                        const bad = $$('[required]', steps[n]).find(f => !f.value.trim());
                        if (bad) {
                            e.preventDefault();
                            cur = n;
                            renderStepper();
                            validateStep();
                            return;
                        }
                    }
                    if (isAnonim()) $$('input, select', $('#identitasFields')).forEach(f => f.value = '');
                    const b = $('#btnSubmit');
                    b.disabled = true;
                    b.innerHTML = '<i class="fas fa-spinner spin"></i> Mengirim...';
                });

                function buildReview() {
                    const v = n => (form.elements[n]?.value || '').trim();
                    const sel = n => {
                        const f = form.elements[n];
                        return f && f.selectedOptions ? (f.value ? f.selectedOptions[0].text : '') : '';
                    };
                    const empty = '<em class="rv-empty">Tidak diisi</em>';
                    const field = (label, val, icon, full = false) =>
                        `<div class="rv-field ${full?'full':''}"><small><i class="fas ${icon}"></i> ${esc(label)}</small><div class="rv-val">${val ? esc(val) : empty}</div></div>`;
                    const rawField = (label, html, icon, full = false) =>
                        `<div class="rv-field ${full?'full':''}"><small><i class="fas ${icon}"></i> ${esc(label)}</small>${html}</div>`;
                    const group = (title, icon, body) =>
                        `<div class="rv-group"><div class="rv-head"><span class="rv-ic"><i class="fas ${icon}"></i></span><h4>${title}</h4></div><div class="rv-body">${body}</div></div>`;

                    const anon = isAnonim();
                    let pelapor = rawField('Status Pelapor', anon ?
                        '<span class="rv-chip anon"><i class="fas fa-user-secret"></i> Anonim (Rahasia)</span>' :
                        '<span class="rv-chip non"><i class="fas fa-user-check"></i> Non-Anonim</span>', 'fa-shield-halved',
                        true);
                    if (!anon) {
                        pelapor += field('Nama Pelapor', v('nama_lengkap'), 'fa-user');
                        pelapor += field('Hubungan dengan DAPEN', sel('hubungan_dapen'), 'fa-link');
                        pelapor += field('No. Identitas', v('nomor_identitas'), 'fa-id-card');
                        pelapor += field('No. WhatsApp/Telepon', v('no_kontak'), 'fa-phone');
                        pelapor += field('Email', v('email_pribadi'), 'fa-envelope', true);
                    } else {
                        pelapor +=
                            `<div class="rv-note" style="grid-column:1/-1;"><i class="fas fa-lock"></i><div>Identitas Anda tidak akan dicantumkan dalam laporan ini.</div></div>`;
                    }

                    const kat = sel('kategori_pengaduan');
                    const kejadian = rawField('Kategori', kat ?
                            `<span class="rv-chip kat"><i class="fas fa-tag"></i> ${esc(kat)}</span>` :
                            `<div class="rv-val">${empty}</div>`, 'fa-layer-group', true) +
                        field('Deskripsi Kejadian', v('deskripsi_kejadian'), 'fa-file-lines', true) +
                        field('Deskripsi Kerugian', v('deskripsi_kerugian'), 'fa-coins', true);

                    const terlapor = field('Nama/Inisial Terlapor', v('nama_terlapor'), 'fa-user-tag') +
                        field('Jabatan/Divisi', sel('jabatan_terlapor'), 'fa-briefcase') +
                        field('Info Tambahan', v('info_tambahan_terlapor'), 'fa-circle-info', true);

                    $('#reviewBox').innerHTML = group('Data Pelapor', 'fa-user-shield', pelapor) +
                        group('Rincian Kejadian', 'fa-triangle-exclamation', kejadian) +
                        group('Pihak Terlapor', 'fa-user-tag', terlapor);
                }

                toggleAnonim(isAnonim());
                if (hasErrors) {
                    cur = 0;
                    renderStepper();
                }

                function copyToken() {
                    const text = $('#tokenValue').innerText.trim();
                    const ok = () => toast('Token disalin: ' + text);
                    const fail = () => toast('Gagal menyalin. Tekan dan tahan token untuk menyalin manual.');
                    const legacyCopy = () => {
                        const ta = document.createElement('textarea');
                        ta.value = text;
                        ta.setAttribute('readonly', '');
                        ta.style.cssText = 'position:fixed;top:0;left:0;opacity:0;';
                        document.body.appendChild(ta);
                        ta.focus();
                        ta.select();
                        ta.setSelectionRange(0, text.length);
                        let success = false;
                        try {
                            success = document.execCommand('copy');
                        } catch (e) {
                            success = false;
                        }
                        document.body.removeChild(ta);
                        success ? ok() : fail();
                    };
                    if (navigator.clipboard && window.isSecureContext) navigator.clipboard.writeText(text).then(ok).catch(
                        legacyCopy);
                    else legacyCopy();
                }

                const FLOW = [{
                        key: 'diajukan',
                        label: 'Laporan diajukan',
                        desc: 'Laporan Anda sudah masuk ke sistem.'
                    },
                    {
                        key: 'diterima',
                        label: 'Laporan diterima',
                        desc: 'Tim Anti Fraud menerima laporan Anda.'
                    },
                    {
                        key: 'dalam_antrian',
                        label: 'Dalam antrian',
                        desc: 'Menunggu giliran untuk diperiksa.'
                    },
                    {
                        key: 'diproses',
                        label: 'Sedang diproses',
                        desc: 'Laporan sedang divalidasi dan ditindaklanjuti.'
                    },
                    {
                        key: 'selesai',
                        label: 'Selesai',
                        desc: 'Laporan sudah ditindaklanjuti.'
                    },
                ];

                function buildTimeline(status) {
                    if (status === 'ditolak') {
                        return `<ul class="timeline">
                            <li class="done"><span class="tl-dot"><i class="fas fa-check"></i></span><strong>Laporan diajukan</strong>Laporan Anda sudah masuk ke sistem.</li>
                            <li class="bad"><span class="tl-dot"><i class="fas fa-xmark"></i></span><strong>Laporan ditolak</strong>Laporan tidak dapat ditindaklanjuti. Lihat catatan di bawah.</li>
                        </ul>`;
                    }
                    const idx = FLOW.findIndex(f => f.key === status);
                    return `<ul class="timeline">` + FLOW.map((f, n) => {
                        const cls = idx === -1 ? '' : (n < idx || status === 'selesai' ? 'done' : (n === idx ? 'now' : ''));
                        const icon = cls === 'done' ? 'fa-check' : (cls === 'now' ? 'fa-hourglass-half' : 'fa-circle');
                        return `<li class="${cls}"><span class="tl-dot"><i class="fas ${icon}"></i></span><strong>${f.label}</strong>${f.desc}</li>`;
                    }).join('') + `</ul>`;
                }

                function lacakStatus() {
                    const token = $('#lacakToken').value.trim();
                    const resultBox = $('#lacakResult');
                    const btn = $('#btnLacak');
                    if (!token) {
                        toast('Masukkan nomor tiket terlebih dahulu.');
                        $('#lacakToken').focus();
                        return;
                    }
                    btn.disabled = true;
                    btn.innerHTML = '<i class="fas fa-spinner spin"></i> Mencari';

                    fetch("{{ route('wbs.lacak') }}", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify({
                                ticket_token: token
                            }),
                        })
                        .then(res => res.json())
                        .then(data => {
                            resultBox.classList.add('show');
                            if (!data.found) {
                                resultBox.innerHTML =
                                    `<div class="res-error"><i class="fas fa-circle-exclamation"></i><div>${esc(data.message)}</div></div>`;
                                return;
                            }
                            resultBox.innerHTML = `
                            <div class="res-card">
                                <span class="status-badge status-${esc(data.status)}"><i class="fas fa-circle-info"></i> ${esc(data.status_label)}</span>
                                <div class="res-meta">
                                    <div><small>Nomor Tiket</small><strong>${esc(data.ticket_token)}</strong></div>
                                    <div><small>Kategori</small><strong>${esc(data.kategori_pengaduan)}</strong></div>
                                    <div><small>Tanggal Lapor</small><strong>${esc(data.tanggal_lapor)}</strong></div>
                                </div>
                                ${buildTimeline(data.status)}
                                ${data.catatan_admin ? `<div class="note-box"><strong>Catatan dari tim:</strong><br>${esc(data.catatan_admin)}</div>` : ''}
                            </div>`;
                            resultBox.scrollIntoView({
                                behavior: 'smooth',
                                block: 'nearest'
                            });
                        })
                        .catch(() => {
                            resultBox.classList.add('show');
                            resultBox.innerHTML =
                                `<div class="res-error"><i class="fas fa-circle-exclamation"></i><div>Terjadi kesalahan, coba lagi.</div></div>`;
                        })
                        .finally(() => {
                            btn.disabled = false;
                            btn.innerHTML = '<i class="fas fa-search"></i> Lacak';
                        });
                }
                $('#lacakToken').addEventListener('keydown', e => {
                    if (e.key === 'Enter') lacakStatus();
                });

                const io = 'IntersectionObserver' in window ? new IntersectionObserver(entries => {
                    entries.forEach(en => {
                        if (en.isIntersecting) {
                            en.target.classList.add('in');
                            io.unobserve(en.target);
                        }
                    });
                }, {
                    threshold: .15
                }) : null;
                $$('.reveal').forEach(el => io ? io.observe(el) : el.classList.add('in'));
            </script>

            <script>
                (function() {
                    const $ = (s, r = document) => r.querySelector(s);
                    const $$ = (s, r = document) => Array.from(r.querySelectorAll(s));
                    const REF = 0.55;

                    const hs = $$('.hero-slider .slide'),
                        hd = $$('.hero-slider .dot');
                    let hc = 0;

                    function showHero(n) {
                        hc = (n + hs.length) % hs.length;
                        hs.forEach((s, i) => s.classList.toggle('active', i === hc));
                        hd.forEach((d, i) => d.classList.toggle('active', i === hc));
                    }
                    window.changeSlide = showHero;
                    if (hs.length > 1) setInterval(() => showHero(hc + 1), 5000);

                    const spies = $$('.spy').map(root => {
                        const items = $$('.spy-item', root);
                        const dots = items.map(i => $('.spy-dot', i));
                        const rail = $('.spy-rail', root),
                            fill = $('.spy-fill', rail);
                        const center = d => {
                            const r = d.getBoundingClientRect();
                            return r.top + r.height / 2;
                        };
                        items.forEach((it, n) => it.addEventListener('click', () => window.scrollTo({
                            top: scrollY + center(dots[n]) - innerHeight * REF + 1,
                            behavior: 'smooth'
                        })));
                        return function update() {
                            if (!items.length || !root.offsetParent) return;
                            const y0 = center(dots[0]),
                                y1 = center(dots[dots.length - 1]);
                            rail.style.top = (y0 - root.getBoundingClientRect().top) + 'px';
                            rail.style.height = Math.max(0, y1 - y0) + 'px';
                            const ref = innerHeight * REF;
                            fill.style.height = Math.min(Math.max(ref - y0, 0), Math.max(0, y1 - y0)) + 'px';
                            let act = 0;
                            dots.forEach((d, n) => {
                                if (center(d) <= ref) act = n;
                            });
                            items.forEach((it, n) => {
                                it.classList.toggle('active', n === act);
                                it.classList.toggle('passed', n < act);
                            });
                        };
                    });
                    window.updateSpy = () => spies.forEach(f => f());

                    const header = $('#mainHeader'),
                        bar = $('#pageProgress');
                    let tick = false;

                    function onScroll() {
                        if (tick) return;
                        tick = true;
                        requestAnimationFrame(() => {
                            tick = false;
                            header?.classList.toggle('scrolled', scrollY > 50);
                            const h = document.documentElement.scrollHeight - innerHeight;
                            if (bar) bar.style.width = (h > 0 ? scrollY / h * 100 : 0) + '%';
                            window.updateSpy();
                        });
                    }
                    addEventListener('scroll', onScroll, {
                        passive: true
                    });
                    addEventListener('resize', () => {
                        onScroll();
                        moveTabBg();
                    });
                    addEventListener('load', onScroll);
                    onScroll();
                })();
            </script>

            <script>
                (function() {
                    const sec = document.querySelector('.contact-hero'),
                        bg = sec && sec.querySelector('.cbg');
                    if (!bg || matchMedia('(prefers-reduced-motion: reduce)').matches) return;
                    let tick = false;

                    function move() {
                        tick = false;
                        const r = sec.getBoundingClientRect();
                        if (r.bottom < 0 || r.top > innerHeight) return;
                        const p = (r.top + r.height / 2) - innerHeight / 2;
                        const max = r.height * 0.2;
                        const y = Math.max(-max, Math.min(max, -p * 0.28));
                        bg.style.transform = 'translate3d(0,' + y.toFixed(1) + 'px,0) scale(1.1)';
                    }
                    const req = () => {
                        if (!tick) {
                            tick = true;
                            requestAnimationFrame(move);
                        }
                    };
                    addEventListener('scroll', req, {
                        passive: true
                    });
                    addEventListener('resize', req);
                    addEventListener('load', req);
                    req();
                })();
            </script>

            <script>
                window.backsoundPlaylist = [
                    "{{ asset('image/Jingle1.mp3') }}",
                    "{{ asset('image/Jingle2.mp3') }}",
                    "{{ asset('image/Jingle3.mp3') }}"
                ];
            </script>
            <script src="{{ asset('js/backsound.js') }}"></script>

        </div>
    </body>

    </html>
@endsection
