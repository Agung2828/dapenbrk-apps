@extends('layout.user.index')

@section('content')
    <!DOCTYPE html>
    <html lang="id">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Kepesertaan - Dana Pensiun Bank Riau Kepri</title>
        <link rel="icon" type="image/png" href="{{ asset('image/Loadinglogo.png') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <style>
            /* ============================
                                                                                                                                                                                                                       BASE STYLES
                                                                                                                                                                                                                    ============================ */
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            body {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                background: #f5f7fa;
                color: #333;
                line-height: 1.6;
            }

            /* ============================
                                                                                                                                                                                                                       LOADING SCREEN
                                                                                                                                                                                                                    ============================ */
            #loader-wrapper {
                position: fixed;
                top: 0;
                left: 0;
                width: 100vw;
                height: 100vh;
                z-index: 99999;
                background: rgba(0, 0, 0, 0.75);
                display: flex;
                justify-content: center;
                align-items: center;
                transition: opacity 0.2s ease-out, visibility 0.2s ease-out;
            }

            #loader-wrapper.loader-hide {
                opacity: 0;
                visibility: hidden;
            }

            .pulsing-logo {
                width: 100px;
                animation: pulse 2s ease-in-out infinite;
            }

            @keyframes pulse {

                0%,
                100% {
                    transform: scale(1);
                }

                50% {
                    transform: scale(1.1);
                }
            }

            /* ============================
                                                                                                                                                                                                                       NAVIGATION BUTTONS
                                                                                                                                                                                                                    ============================ */
            .nav-download {
                background: rgba(234, 90, 12, 0.75);
                color: #ffffff !important;
                padding: 10px 18px;
                border-radius: 8px;
                margin-left: 10px;
                font-weight: 600;
                font-size: 0.95rem;
                display: inline-flex;
                align-items: center;
                gap: 8px;
                transition: all 0.3s ease;
                box-shadow: 0 2px 8px rgba(234, 90, 12, 0.35);
                white-space: nowrap;
                border: 2px solid transparent;
            }

            .nav-download:hover {
                background: #ffffff;
                color: #ea5a0c !important;
                border-color: #ea5a0c;
                transform: translateY(-2px);
                box-shadow: 0 4px 12px rgba(234, 90, 12, 0.4);
            }

            /* ============================
                                                                                                                                                                                                                       HERO SECTION
                                                                                                                                                                                                                    ============================ */
            .hero-section {
                background-color: #2a5298;
                background-image: url('{{ asset('image/Istana Siak.PNG') }}');
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                min-height: 50vh;
                color: #fff;
                padding: 80px 20px 60px;
                text-align: center;
                position: relative;
                overflow: hidden;
            }

            .hero-section::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.4);
            }

            .hero-content {
                position: relative;
                z-index: 1;
                max-width: 800px;
                margin: 0 auto;
            }

            .hero-section h1 {
                font-size: 48px;
                font-weight: 700;
                margin-bottom: 15px;
                text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            }

            .hero-section p {
                font-size: 20px;
                opacity: 0.95;
            }

            /* ============================
                                                                                                                                                                                                                       CONTAINER
                                                                                                                                                                                                                    ============================ */
            .container {
                max-width: 1200px;
                margin: 0 auto;
                padding: 0 20px;
            }

            /* ============================
                                       FLOATING WHATSAPP BUTTON
                                    ============================ */
            .floating-whatsapp {
                position: fixed;
                bottom: 30px;
                right: 30px;
                z-index: 9999;
            }

            .floating-whatsapp-link {
                display: flex;
                align-items: center;
                justify-content: center;
                width: 55px;
                height: 55px;
                background: linear-gradient(135deg, #25D366 0%, #128C7E 100%);
                border-radius: 50%;
                box-shadow: 0 4px 20px rgba(37, 211, 102, 0.4);
                transition: all 0.3s ease;
                text-decoration: none;
                animation: floating-pulse 2s ease-in-out infinite;
            }

            .floating-wha@media (max-width: 768px) {
                .floating-whatsapp {
                    bottom: 20px;
                    right: 20px;
                }

                .floating-whatsapp-link {
                    width: 55px;
                    height: 55px;
                }

                .floating-whatsapp-link i {
                    font-size: 1.8rem;
                }
            }

            @media (max-width: 480px) {
                .floating-whatsapp {
                    bottom: 15px;
                    right: 15px;
                }

                .floating-whatsapp-link {
                    width: 50px;
                    height: 50px;
                }

                .floating-whatsapp-link i {
                    font-size: 1.6rem;
                }
            }

            tsapp-link:hover {
                transform: scale(1.1);
                box-shadow: 0 6px 30px rgba(37, 211, 102, 0.6);
            }

            .floating-whatsapp-link i {
                font-size: 2.2rem;
                color: white;
            }

            @keyframes floating-pulse {

                0%,
                100% {
                    transform: translateY(0);
                }

                50% {
                    transform: translateY(-8px);
                }
            }

            /* ============================
                                                                                                                                                                                                                       STATS SECTION (GLASS EFFECT)
                                                                                                                                                                                                                    ============================ */
            .stats-section {
                background: rgba(255, 255, 255, 0.25);
                backdrop-filter: blur(20px);
                -webkit-backdrop-filter: blur(20px);
                border: 1px solid rgba(255, 255, 255, 0.3);
                margin: -60px auto 60px;
                max-width: 1200px;
                border-radius: 24px;
                box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1), inset 0 1px 0 rgba(255, 255, 255, 0.5);
                padding: 50px 40px;
                position: relative;
                z-index: 2;
            }

            .stats-section::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: linear-gradient(135deg, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0.05) 100%);
                border-radius: 24px;
                pointer-events: none;
            }

            .stats-header {
                text-align: center;
                margin-bottom: 40px;
                position: relative;
                z-index: 1;
            }

            .stats-header h2 {
                font-size: 28px;
                color: #1a1a2e;
                margin-bottom: 8px;
                font-weight: 700;
                letter-spacing: -0.5px;
                text-shadow: 0 2px 10px rgba(255, 255, 255, 0.5);
            }

            .stats-date {
                color: #6c757d;
                font-size: 14px;
                font-weight: 400;
            }

            .data-stats-grid {
                display: grid;
                grid-template-columns: repeat(6, 1fr);
                gap: 16px;
                margin-bottom: 40px;
                position: relative;
                z-index: 1;
            }

            .stat-card {
                background: rgba(88, 101, 242, 0.15);
                backdrop-filter: blur(10px);
                -webkit-backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.2);
                color: #1a1a2e;
                padding: 32px 20px;
                border-radius: 16px;
                text-align: center;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                opacity: 0;
                transform: translateY(20px);
                position: relative;
                overflow: hidden;
                box-shadow: 0 4px 16px rgba(88, 101, 242, 0.1), inset 0 1px 0 rgba(255, 255, 255, 0.3);
            }

            .stat-card::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: linear-gradient(135deg, rgba(255, 255, 255, 0.2) 0%, rgba(255, 255, 255, 0.05) 100%);
                pointer-events: none;
                border-radius: 16px;
            }

            .stat-card.animate {
                animation: fadeInUp 0.5s ease forwards;
            }

            @keyframes fadeInUp {
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .stat-card.active-stat {
                background: rgba(251, 191, 36, 0.15);
                border: 1px solid rgba(251, 191, 36, 0.3);
                box-shadow: 0 4px 16px rgba(251, 191, 36, 0.2), inset 0 1px 0 rgba(255, 255, 255, 0.4);
            }

            .stat-card:hover {
                transform: translateY(-8px);
                box-shadow: 0 12px 32px rgba(88, 101, 242, 0.2), inset 0 1px 0 rgba(255, 255, 255, 0.5);
            }

            .stat-number {
                font-size: 42px;
                font-weight: 800;
                margin-bottom: 8px;
                font-variant-numeric: tabular-nums;
                line-height: 1;
                position: relative;
                z-index: 1;
                background: linear-gradient(135deg, #1a1a2e 0%, #5865f2 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }

            .stat-card.active-stat .stat-number {
                background: linear-gradient(135deg, #f59e0b 0%, #fbbf24 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }

            .stat-label {
                font-size: 13px;
                font-weight: 600;
                color: #1a1a2e;
                line-height: 1.4;
                position: relative;
                z-index: 1;
            }

            /* Total Counter */
            .total-counter-section {
                margin-top: 0;
                padding-top: 40px;
                border-top: 1px solid rgba(255, 255, 255, 0.2);
                text-align: center;
                position: relative;
                z-index: 1;
            }

            .total-counter-wrapper {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 12px;
                padding: 28px 48px;
                background: rgba(30, 58, 95, 0.15);
                backdrop-filter: blur(15px);
                border: 1px solid rgba(255, 255, 255, 0.25);
                border-radius: 16px;
                box-shadow: 0 8px 32px rgba(30, 58, 95, 0.15), inset 0 1px 0 rgba(255, 255, 255, 0.3);
                position: relative;
                overflow: hidden;
            }

            .total-counter-wrapper::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: linear-gradient(135deg, rgba(255, 255, 255, 0.15) 0%, rgba(255, 255, 255, 0.05) 100%);
                pointer-events: none;
                border-radius: 16px;
            }

            .total-counter-label {
                color: #1a1a2e;
                font-size: 16px;
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: 1.5px;
                position: relative;
                z-index: 1;
            }

            .total-counter-number {
                color: #fbbf24;
                font-size: 48px;
                font-weight: 900;
                font-variant-numeric: tabular-nums;
                line-height: 1;
                position: relative;
                z-index: 1;
                text-shadow: 0 0 20px rgba(251, 191, 36, 0.5), 0 2px 4px rgba(0, 0, 0, 0.1);
            }

            .total-counter-suffix {
                color: #1a1a2e;
                font-size: 18px;
                font-weight: 600;
                position: relative;
                z-index: 1;
            }

            /* ============================
                                                                                                                                                                                                                       SECTION
                                                                                                                                                                                                                    ============================ */
            .section {
                background: white;
                margin: 40px auto;
                max-width: 1160px;
                border-radius: 20px;
                box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
                padding: 50px 40px;
            }

            .section-title {
                font-size: 28px;
                color: #1e3c72;
                margin-bottom: 10px;
                padding-bottom: 15px;
                border-bottom: 3px solid #fbbf24;
                display: inline-block;
            }

            .section-subtitle {
                color: #666;
                font-size: 16px;
                margin-bottom: 30px;
            }

            /* ============================
                                                                       SECTION WRAPPER
                                                                    ============================ */
            .section {
                background: #ffffff;
                padding: 40px 32px;
                border-radius: 16px;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
                margin-bottom: 60px;
            }

            .section-title {
                font-size: 28px;
                font-weight: 800;
                color: #1e3c72;
                margin-bottom: 6px;
            }

            .section-subtitle {
                font-size: 15px;
                color: #6b7280;
                margin-bottom: 30px;
            }

            /* ============================
                                                                       TABS (SEDERET, RAPI)
                                                                    ============================ */
            .tabs {
                display: flex;
                flex-wrap: nowrap;
                /* PAKSA SATU BARIS */
                gap: 12px;
                border-bottom: 2px solid #e5e7eb;
                margin-bottom: 28px;
                overflow-x: auto;
                scrollbar-width: none;
            }

            .tabs::-webkit-scrollbar {
                display: none;
            }

            .tab-btn {
                flex-shrink: 0;
                padding: 12px 22px;
                background: transparent;
                border: none;
                cursor: pointer;
                font-size: 15px;
                font-weight: 600;
                color: #6b7280;
                border-bottom: 3px solid transparent;
                transition: all 0.25s ease;
                white-space: nowrap;
            }

            .tab-btn:hover {
                color: #1e3c72;
            }

            .tab-btn.active {
                color: #1e3c72;
                border-bottom-color: #fbbf24;
            }

            /* ============================
                                                                       TAB CONTENT
                                                                       (JS LOGIC AMAN)
                                                                    ============================ */
            .tab-contents {
                width: 100%;
            }

            .tab-content {
                display: none;
            }

            .tab-content.active {
                display: block;
                animation: fadeIn 0.4s ease;
            }

            /* ============================
                                                                       ANIMATION
                                                                    ============================ */
            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: translateY(10px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }


            /* ===============================
                                                                                                           PROGRAM PENSIUN – CLEAN & RAPI
                                                                                                        ================================ */

            /* Grid utama */
            #program .card-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
                gap: 28px;
                margin-top: 25px;
            }

            /* Card */
            #program .info-card {
                background: #ffffff;
                border-radius: 16px;
                padding: 26px 28px;
                box-shadow: 0 10px 28px rgba(0, 0, 0, 0.08);
                transition: transform .25s ease, box-shadow .25s ease;
            }

            #program .info-card:hover {
                transform: translateY(-4px);
                box-shadow: 0 16px 40px rgba(0, 0, 0, 0.12);
            }

            /* Heading utama */
            #program .section-heading {
                display: flex;
                align-items: center;
                gap: 12px;
                font-size: 20px;
                font-weight: 700;
                margin-bottom: 18px;
            }

            #program .section-heading i {
                font-size: 22px;
            }

            /* Warna heading */
            #program .section-heading.success {
                color: #1e3c72;
            }

            #program .section-heading.pension {
                color: #2a5298;
            }

            /* Sub heading */
            #program h3 {
                font-size: 18px;
                font-weight: 700;
                color: #1e3c72;
                margin-bottom: 12px;
            }

            #program h4 {
                font-size: 15px;
                font-weight: 700;
                color: #374151;
                margin: 18px 0 10px;
            }

            /* List umum */
            #program ul {
                padding-left: 18px;
                margin-bottom: 16px;
            }

            #program ul li {
                font-size: 14.5px;
                line-height: 1.7;
                color: #374151;
                margin-bottom: 8px;
            }

            /* Numbered list */
            #program .numbered-list {
                padding-left: 20px;
                margin-bottom: 20px;
            }

            #program .numbered-list li {
                margin-bottom: 10px;
            }

            /* Nested list */
            #program ul ul {
                margin-top: 6px;
            }

            /* Paragraf */
            #program p {
                font-size: 14.5px;
                line-height: 1.7;
                color: #374151;
                margin-bottom: 10px;
            }

            /* Formula box */
            #program .formula-box {
                background: #f1f5f9;
                border-left: 5px solid #1e3c72;
                padding: 14px 18px;
                border-radius: 10px;
                margin: 10px 0 18px;
            }

            #program .formula-box span {
                font-weight: 600;
                font-size: 14px;
                color: #1e293b;
            }

            /* Divider visual antar section */
            #program .info-card:not(:last-child) {
                position: relative;
            }

            #program .info-card:not(:last-child)::after {
                content: "";
                position: absolute;
                bottom: -14px;
                left: 10%;
                width: 80%;
                height: 1px;
                background: linear-gradient(to right, transparent, #cbd5e1, transparent);
            }

            /* ===============================
                                                                                                           RESPONSIVE
                                                                                                        ================================ */
            @media (max-width: 768px) {
                #program .card-grid {
                    grid-template-columns: 1fr;
                }

                #program .info-card {
                    padding: 22px;
                }
            }

            /* ============================
                                                                                                                                                                                                                       INFO CARD & CARD GRID
                                                                                                                                                                                                                    ============================ */
            .card-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
                gap: 25px;
                margin: 30px 0;
            }

            .info-card {
                background: white;
                border: 2px solid #e5e7eb;
                border-radius: 15px;
                padding: 30px;
                transition: all 0.3s ease;
            }

            .info-card:hover {
                border-color: #fbbf24;
                box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
                transform: translateY(-5px);
            }

            .info-card h3 {
                color: #1e3c72;
                margin-bottom: 15px;
                font-size: 22px;
            }

            .info-card h4 {
                color: #1e3c72;
                margin-bottom: 12px;
                font-size: 18px;
            }

            .info-card ul {
                list-style: none;
                padding: 0;
            }

            .info-card li {
                padding: 10px 0;
                padding-left: 30px;
                position: relative;
            }

            .info-card li::before {
                content: '\f105';
                font-family: 'Font Awesome 6 Free';
                font-weight: 900;
                position: absolute;
                left: 0;
                color: #fbbf24;
            }

            /* ============================
                                                                                                                                                                                                                       CUSTOM LIST
                                                                                                                                                                                                                    ============================ */
            .custom-list {
                list-style: none;
                padding: 0;
            }

            .custom-list li {
                padding: 12px 0;
                padding-left: 35px;
                position: relative;
                border-bottom: 1px solid #e5e7eb;
            }

            .custom-list li:last-child {
                border-bottom: none;
            }

            .custom-list li::before {
                content: '\f00c';
                font-family: 'Font Awesome 6 Free';
                font-weight: 900;
                position: absolute;
                left: 0;
                color: #10b981;
                font-size: 18px;
            }

            /* ============================
                                                                                                                                                                                                                       FORMULA BOX
                                                                                                                                                                                                                    ============================ */
            .formula-box {
                background: #fef3c7;
                padding: 14px;
                border-radius: 6px;
                margin: 10px 0 20px;
                border-left: 4px solid #fbbf24;
            }

            .formula-box span {
                display: block;
                background: #ffffff;
                color: #1e3c72;
                text-align: center;
                font-weight: 600;
                padding: 12px;
                border-radius: 4px;
            }

            /* ============================
                                                                                                                                                                                                                       PENGKINIAN DATA
                                                                                                                                                                                                                    ============================ */
            .pengkinian-greeting h3 {
                font-weight: 600;
                color: #1e3c72;
                margin: 20px 0 10px;
            }

            .address-block {
                background: #f8f9fa;
                border-left: 5px solid #fbbf24;
                padding: 24px;
                border-radius: 12px;
                margin: 25px 0;
            }

            .address-block p {
                margin-bottom: 8px;
                color: #444;
            }

            .address-block .instansi {
                font-weight: 600;
                color: #1e3c72;
                margin-bottom: 15px;
            }

            .address-list {
                list-style: none;
                padding: 0;
            }

            .address-list li {
                margin-bottom: 8px;
                color: #444;
            }

            .address-list strong {
                display: inline-block;
                width: 80px;
                color: #1e3c72;
            }

            .address-list a {
                color: #2a5298;
                font-weight: 600;
                text-decoration: none;
            }

            .address-list a:hover {
                text-decoration: underline;
            }

            .form-options-section {
                background: #f8fafc;
                border-radius: 12px;
                padding: 24px;
                margin-top: 25px;
            }

            .cta-row {
                display: flex;
                gap: 15px;
                margin: 15px 0 10px;
                flex-wrap: wrap;
            }

            .form-options-list {
                margin-top: 10px;
                padding-left: 20px;
            }

            /* ============================
                   NAV KONTAK (SOFT BLUE)
                   ============================ */
            .nav-kontak {
                background: rgba(186, 152, 2, 0.85);
                /* biru navy kalem */
                color: #fff !important;

                /* ukuran sama */
                padding: 10px 18px;
                border-radius: 8px;
                margin-left: 10px;
                font-weight: 600;
                font-size: 0.95rem;

                display: inline-flex;
                align-items: center;
                gap: 8px;

                transition: all 0.3s ease;
                box-shadow: 0 2px 8px rgba(44, 82, 130, 0.25);
                border: 2px solid transparent;
            }

            .nav-kontak:hover {
                background: #ffffff;
                color: #988904 !important;
                border-color: #82682c;
                transform: translateY(-2px);
            }

            /* ============================
                                                                                                                                                                                                                       BUTTON
                                                                                                                                                                                                                    ============================ */
            .btn {
                display: inline-block;
                padding: 12px 30px;
                background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
                color: white;
                text-decoration: none;
                border-radius: 50px;
                font-weight: 600;
                transition: all 0.3s ease;
                border: none;
                cursor: pointer;
            }

            .btn:hover {
                transform: translateY(-2px);
                box-shadow: 0 5px 15px rgba(251, 191, 36, 0.4);
            }

            .btn i {
                margin-left: 8px;
            }

            /* ============================
                                                                                                                                                                                                                       NUMBERED LIST
                                                                                                                                                                                                                    ============================ */
            .numbered-list {
                padding-left: 20px;
            }

            .numbered-list li {
                margin-bottom: 12px;
                text-align: justify;
            }

            /* ============================
                                                                                                                                                                                                                       COMPLAINT PAGE
                                                                                                                                                                                                                    ============================ */
            .complaint-page {
                padding: 20px 0;
            }

            .page-header h3 {
                display: flex;
                align-items: center;
                gap: 10px;
                font-size: 22px;
                font-weight: 700;
                color: #1e3c72;
                margin-bottom: 10px;
            }

            .page-header i {
                color: #b91c1c;
            }

            .page-header p {
                margin-top: 8px;
                color: #555;
            }

            .card-header {
                padding: 8px 12px;
                font-weight: 600;
                color: #fff;
                border-radius: 8px;
                margin-bottom: 10px;
            }

            .card-header.red {
                background: #b91c1c;
            }

            .clean-list {
                padding-left: 18px;
            }

            .clean-list li {
                margin-bottom: 6px;
            }

            .highlight {
                color: #b91c1c;
                font-weight: 700;
            }

            .section-heading {
                display: flex;
                align-items: center;
                gap: 10px;
                font-size: 20px;
                font-weight: 700;
            }

            .section-heading.success i {
                color: #10b981;
            }

            .section-heading.pension i {
                color: #b91c1c;
            }

            /* ============================
                                                       MATERI SOSIALISASI STYLES
                                                    ============================ */

            /* ===== UTIL ===== */
            .d-flex {
                display: flex;
            }

            .align-items-center {
                align-items: center;
            }

            .mb-4 {
                margin-bottom: 1.5rem;
            }

            .mb-0 {
                margin-bottom: 0;
            }

            .ms-3 {
                margin-left: 1rem;
            }

            /* ===== HEADER ===== */
            .materi-header {
                margin-bottom: 2.5rem;
            }

            .materi-icon {
                width: 70px;
                height: 70px;
                background: linear-gradient(135deg, #dc3545, #c82333);
                border-radius: 16px;
                display: flex;
                align-items: center;
                justify-content: center;
                color: #fff;
                font-size: 32px;
                box-shadow: 0 8px 16px rgba(220, 53, 69, .3);
                flex-shrink: 0;
            }

            .materi-header h3 {
                font-size: 32px;
                font-weight: 700;
                color: #1e3c72;
            }

            /* ===== GRID ===== */
            .materi-grid {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
                gap: 2.5rem;
                margin-top: 2rem;
            }

            /* ===== CARD ===== */
            .materi-card {
                background: #fff;
                border-radius: 20px;
                overflow: hidden;
                border: 2px solid #f1f3f5;
                box-shadow: 0 4px 12px rgba(0, 0, 0, .08);
                transition: .3s ease;
            }

            .materi-card:hover {
                transform: translateY(-6px);
                border-color: #dc3545;
                box-shadow: 0 14px 28px rgba(0, 0, 0, .18);
            }

            /* ===== PDF PREVIEW (FIX UTAMA) ===== */
            .pdf-preview-wrapper {
                position: relative;
                background: #e9ecef;
                padding: 16px;
            }

            .pdf-thumbnail {
                position: relative;
                width: 100%;
                height: 480px;
                background: #fff;
                border-radius: 14px;
                overflow: hidden;
                box-shadow:
                    0 10px 30px rgba(0, 0, 0, .18),
                    inset 0 0 0 1px rgba(0, 0, 0, .05);
            }

            /* PDF ASLI – JANGAN GELAP */
            .pdf-thumbnail iframe {
                width: 100%;
                height: 100%;
                border: none;
                pointer-events: none;
                background: white;
                transform: scale(1);
                transition: transform .35s ease;
            }

            /* efek zoom halus */
            .materi-card:hover .pdf-thumbnail iframe {
                transform: scale(1.03);
            }

            /* ===== OVERLAY (LEMBUT, BUKAN NUTUP PDF) ===== */
            .pdf-overlay {
                position: absolute;
                inset: 0;
                background: linear-gradient(to bottom,
                        rgba(0, 0, 0, 0) 40%,
                        rgba(0, 0, 0, .65));
                display: flex;
                align-items: flex-end;
                justify-content: center;
                padding-bottom: 24px;
                opacity: 0;
                transition: opacity .3s ease;
            }

            .materi-card:hover .pdf-overlay {
                opacity: 1;
            }

            .overlay-content {
                text-align: center;
                color: #fff;
            }

            .overlay-content i {
                font-size: 28px;
                margin-bottom: 6px;
            }

            .overlay-content p {
                font-size: 14px;
                font-weight: 600;
                margin: 0;
            }

            /* ===== CONTENT ===== */
            .materi-content {
                padding: 22px 24px 24px;
                background: #fff;
            }

            .materi-title {
                font-size: 20px;
                font-weight: 700;
                color: #1e3c72;
                margin-bottom: 10px;
            }

            .materi-desc {
                font-size: 14px;
                line-height: 1.6;
                color: #6c757d;
                margin-bottom: 18px;
            }

            /* ===== FOOTER ===== */
            .materi-footer {
                display: flex;
                justify-content: space-between;
                align-items: center;
                border-top: 1px solid #e9ecef;
                padding-top: 14px;
            }

            .btn-lihat-pdf {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                padding: 9px 20px;
                border-radius: 50px;
                background: linear-gradient(135deg, #dc3545, #c82333);
                color: #fff;
                font-size: 14px;
                font-weight: 600;
                text-decoration: none;
                box-shadow: 0 4px 12px rgba(220, 53, 69, .35);
                transition: .3s ease;
            }

            .btn-lihat-pdf:hover {
                transform: translateX(4px);
                box-shadow: 0 8px 18px rgba(220, 53, 69, .45);
            }

            /* ===== EMPTY ===== */
            .empty-state {
                text-align: center;
                padding: 80px 20px;
                background: #f8f9fa;
                border-radius: 16px;
            }

            .empty-state i {
                opacity: .5;
            }

            .empty-state p {
                font-size: 16px;
            }

            /* ============================
                                                                                                                                                                                                                       PDF MODAL STYLES
                                                                                                                                                                                                                    ============================ */
            .pdf-modal {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                z-index: 10000;
                animation: fadeInModal 0.3s ease;
            }

            .pdf-modal.active {
                display: block;
            }

            @keyframes fadeInModal {
                from {
                    opacity: 0;
                }

                to {
                    opacity: 1;
                }
            }

            .pdf-modal-overlay {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.8);
                backdrop-filter: blur(4px);
            }

            .pdf-modal-content {
                position: relative;
                width: 90%;
                max-width: 1200px;
                height: 90%;
                margin: 2.5% auto;
                background: white;
                border-radius: 16px;
                overflow: hidden;
                box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
                display: flex;
                flex-direction: column;
                animation: slideUpModal 0.3s ease;
            }

            @keyframes slideUpModal {
                from {
                    transform: translateY(50px);
                    opacity: 0;
                }

                to {
                    transform: translateY(0);
                    opacity: 1;
                }
            }

            .pdf-modal-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 20px 30px;
                background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
                color: white;
                border-bottom: 2px solid rgba(255, 255, 255, 0.2);
            }

            .modal-title {
                margin: 0;
                font-size: 22px;
                font-weight: 700;
            }

            .pdf-modal-actions {
                display: flex;
                gap: 12px;
                align-items: center;
            }

            .btn-download {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                padding: 10px 20px;
                background: white;
                color: #dc3545;
                text-decoration: none;
                border-radius: 8px;
                font-weight: 600;
                font-size: 14px;
                transition: all 0.3s ease;
            }

            .btn-download:hover {
                background: #f8f9fa;
                transform: translateY(-2px);
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
                color: #c82333;
                text-decoration: none;
            }

            .btn-close-modal {
                width: 40px;
                height: 40px;
                display: flex;
                align-items: center;
                justify-content: center;
                background: rgba(255, 255, 255, 0.2);
                border: none;
                border-radius: 8px;
                color: white;
                font-size: 20px;
                cursor: pointer;
                transition: all 0.3s ease;
            }

            .btn-close-modal:hover {
                background: rgba(255, 255, 255, 0.3);
                transform: rotate(90deg);
            }

            .pdf-modal-body {
                flex: 1;
                overflow: hidden;
                background: #525659;
            }

            .pdf-modal-body iframe {
                width: 100%;
                height: 100%;
                border: none;
            }

            /* ============================
                                                                                                                                                                                               FLOWCHART SYARAT PEMBAYARAN
                                                                                                                                                                                            ============================ */
            .flowchart-syarat-container {
                background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
                padding: 50px 30px;
                border-radius: 20px;
                margin: 40px 0;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
                position: relative;
                overflow: hidden;
            }

            .flowchart-syarat-container::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                height: 5px;
                background: linear-gradient(90deg, #eca63d 0%, #dfc231 50%, #fbbf24 100%);
            }

            .flowchart-title-section {
                text-align: center;
                margin-bottom: 50px;
            }

            .flowchart-title-section h3 {
                color: #1e3c72;
                font-size: 28px;
                font-weight: 700;
                margin-bottom: 10px;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 12px;
            }

            .flowchart-title-section p {
                color: #666;
                font-size: 16px;
                margin: 0;
            }

            .flowchart-syarat {
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 30px;
                flex-wrap: wrap;
                margin: 40px 0;
                position: relative;
            }

            .flowchart-oval-wrapper {
                display: flex;
                align-items: center;
                gap: 30px;
                position: relative;
            }

            .flowchart-oval {
                width: 260px;
                min-height: 160px;
                border: 4px solid #cb6b0c;
                border-radius: 50%;
                padding: 25px 20px;
                text-align: center;
                display: flex;
                flex-direction: column;
                justify-content: center;
                background: white;
                box-shadow: 0 8px 24px rgba(30, 60, 114, 0.15);
                transition: all 0.3s ease;
                position: relative;
                z-index: 2;
            }

            .flowchart-oval::before {
                content: '';
                position: absolute;
                top: -8px;
                left: -8px;
                right: -8px;
                bottom: -8px;
                border: 2px solid #fbbf24;
                border-radius: 50%;
                opacity: 0;
                transition: opacity 0.3s ease;
                z-index: -1;
            }

            .flowchart-oval:hover {
                transform: translateY(-8px) scale(1.05);
                border-color: #926c04;
                box-shadow: 0 12px 32px #9b8209;
            }

            .flowchart-oval:hover::before {
                opacity: 1;
            }

            .flowchart-oval-number {
                position: absolute;
                top: -15px;
                left: 50%;
                transform: translateX(-50%);
                width: 40px;
                height: 40px;
                background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-weight: 800;
                font-size: 18px;
                color: white;
                box-shadow: 0 4px 12px rgba(251, 191, 36, 0.4);
                border: 3px solid white;
            }

            .flowchart-oval-title {
                font-size: 17px;
                font-weight: 700;
                color: #00040991;
                margin-bottom: 15px;
                display: block;
                padding-bottom: 12px;
                border-bottom: 2px solid #e5e7eb;
            }

            .flowchart-oval-content {
                font-size: 14px;
                line-height: 1.8;
                color: #555;
            }

            .flowchart-oval-content span {
                display: block;
                padding: 4px 0;
                position: relative;
                padding-left: 20px;
            }

            /* .flowchart-oval-content span::before {
                                                                                                                                                                            content: '\f00c';
                                                                                                                                                                            font-family: 'Font Awesome 6 Free';
                                                                                                                                                                            font-weight: 900;
                                                                                                                                                                            position: absolute;
                                                                                                                                                                            left: 0;
                                                                                                                                                                            color: #fbbf24;
                                                                                                                                                                            font-size: 12px;
                                                                                                                                                                        } */

            .flowchart-line {
                width: 60px;
                height: 4px;
                background: linear-gradient(90deg, #f0b920 0%, #9b8209 100%);
                position: relative;
                flex-shrink: 0;
            }

            .flowchart-line::after {
                content: '\f054';
                font-family: 'Font Awesome 6 Free';
                font-weight: 900;
                position: absolute;
                right: -10px;
                top: 50%;
                transform: translateY(-50%);
                color: #9b8209;
                font-size: 16px;
                animation: arrowPulse 2s ease-in-out infinite;
            }

            @keyframes arrowPulse {

                0%,
                100% {
                    transform: translateY(-50%) translateX(0);
                    opacity: 1;
                }

                50% {
                    transform: translateY(-50%) translateX(5px);
                    opacity: 0.7;
                }
            }

            .flowchart-note-box {
                background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
                border-left: 5px solid #fbbf24;
                border-radius: 12px;
                padding: 25px 30px;
                margin-top: 50px;
                box-shadow: 0 4px 15px rgba(251, 191, 36, 0.2);
                display: flex;
                align-items: center;
                gap: 15px;
            }

            .flowchart-note-icon {
                width: 50px;
                height: 50px;
                background: white;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                flex-shrink: 0;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            }

            .flowchart-note-icon i {
                color: #f59e0b;
                font-size: 24px;
            }

            .flowchart-note-content {
                flex: 1;
            }

            .flowchart-note-content p {
                margin: 0;
                color: #92400e;
                font-size: 15px;
                line-height: 1.6;
            }

            .flowchart-note-content a {
                color: #1e3c72;
                font-weight: 700;
                text-decoration: none;
                border-bottom: 2px solid #fbbf24;
                transition: all 0.3s ease;
                padding-bottom: 2px;
            }

            .flowchart-note-content a:hover {
                color: #2a5298;
                border-bottom-color: #2a5298;
            }

            /* ============================
                                                                                                                                                                                               RESPONSIVE DESIGN
                                                                                                                                                                                            ============================ */
            @media (max-width: 1024px) {
                .flowchart-oval {
                    width: 240px;
                    min-height: 150px;
                }

                .flowchart-line {
                    width: 50px;
                }
            }

            @media (max-width: 768px) {
                .flowchart-syarat-container {
                    padding: 40px 20px;
                }

                .flowchart-title-section h3 {
                    font-size: 24px;
                    flex-direction: column;
                }

                .flowchart-syarat {
                    flex-direction: column;
                    gap: 40px;
                }

                .flowchart-oval-wrapper {
                    flex-direction: column;
                    gap: 30px;
                }

                .flowchart-line {
                    width: 4px;
                    height: 50px;
                    transform: rotate(0deg);
                }

                .flowchart-line::after {
                    right: 50%;
                    bottom: -10px;
                    top: auto;
                    transform: translateX(50%) rotate(90deg);
                }

                @keyframes arrowPulse {

                    0%,
                    100% {
                        transform: translateX(50%) rotate(90deg) translateY(0);
                        opacity: 1;
                    }

                    50% {
                        transform: translateX(50%) rotate(90deg) translateY(5px);
                        opacity: 0.7;
                    }
                }

                .flowchart-oval {
                    width: 100%;
                    max-width: 320px;
                }

                .flowchart-note-box {
                    flex-direction: column;
                    text-align: center;
                }
            }

            @media (max-width: 480px) {
                .flowchart-oval {
                    width: 100%;
                    padding: 20px 15px;
                }

                .flowchart-oval-title {
                    font-size: 16px;
                }

                .flowchart-oval-content {
                    font-size: 13px;
                }

                .flowchart-note-box {
                    padding: 20px;
                }
            }

            /* ============================
                                                                                                                                                                                                                       RESPONSIVE DESIGN
                                                                                                                                                                                                                    ============================ */
            @media (max-width: 1024px) {
                .data-stats-grid {
                    grid-template-columns: repeat(3, 1fr);
                    gap: 14px;
                }

                .materi-grid {
                    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
                    gap: 2rem;
                }
            }

            @media (max-width: 768px) {
                .hero-section h1 {
                    font-size: 32px;
                }

                .hero-section p {
                    font-size: 16px;
                }

                .section {
                    padding: 30px 20px;
                }

                .stats-section {
                    padding: 30px 20px;
                    margin: -40px auto 40px;
                }

                .stats-header h2 {
                    font-size: 24px;
                }

                .tabs {
                    overflow-x: auto;
                }

                .tab-btn {
                    white-space: nowrap;
                }

                .card-grid {
                    grid-template-columns: 1fr;
                }

                .data-stats-grid {
                    grid-template-columns: repeat(2, 1fr);
                    gap: 12px;
                }

                .stat-card {
                    padding: 24px 16px;
                }

                .stat-number {
                    font-size: 32px;
                }

                .stat-label {
                    font-size: 12px;
                }

                .total-counter-wrapper {
                    padding: 20px 32px;
                }

                .total-counter-label {
                    font-size: 13px;
                    letter-spacing: 1px;
                }

                .total-counter-number {
                    font-size: 36px;
                }

                .total-counter-suffix {
                    font-size: 16px;
                }

                .materi-header h3 {
                    font-size: 24px;
                }

                .materi-icon {
                    width: 60px;
                    height: 60px;
                    font-size: 28px;
                }

                .materi-grid {
                    grid-template-columns: 1fr;
                    gap: 1.5rem;
                }

                .pdf-thumbnail {
                    height: 350px;
                }

                .no-preview {
                    height: 350px;
                }

                .materi-footer {
                    flex-direction: column;
                    gap: 12px;
                    align-items: flex-start;
                }

                .pdf-modal-content {
                    width: 95%;
                    height: 95%;
                    margin: 2.5% auto;
                }

                .pdf-modal-header {
                    padding: 16px 20px;
                    flex-wrap: wrap;
                    gap: 12px;
                }

                .modal-title {
                    font-size: 18px;
                    width: 100%;
                }

                .pdf-modal-actions {
                    width: 100%;
                    justify-content: space-between;
                }

                .btn-download {
                    font-size: 13px;
                    padding: 8px 16px;
                }
            }

            @media (max-width: 480px) {
                .periode-badge {
                    font-size: 11px;
                    padding: 8px 16px;
                }

                .materi-title {
                    font-size: 18px;
                }

                .materi-desc {
                    font-size: 13px;
                }

                .btn-lihat-pdf {
                    font-size: 13px;
                    padding: 8px 16px;
                }

            }
        </style>
    </head>

    <body>
        <!-- LOADING SCREEN -->
        <div id="loader-wrapper">
            <div class="logo-container">
                <img src="{{ asset('image/Loadinglogo.png') }}" alt="Logo Dana Pensiun" class="pulsing-logo">
            </div>
        </div>
        <!-- FLOATING WHATSAPP BUTTON -->
        <div class="floating-whatsapp">
            <a href="https://wa.me/628137964058" target="_blank" class="floating-whatsapp-link" aria-label="WhatsApp">
                <i class="fab fa-whatsapp"></i>
            </a>
        </div>
        <!-- Main Header -->
        <header class="main-header" id="mainHeader">
            <div class="container">
                <!-- Logo -->
                <div class="logo-section">
                    <a href="{{ url('/') }}" class="logo">
                        <img src="{{ asset('image/logo.png') }}" alt="Logo">
                    </a>
                </div>

                <!-- Main Nav -->
                <nav class="main-nav">
                    <a href="{{ url('/') }}" class="nav-link">Beranda</a>
                    <a href="{{ url('/profile') }}" class="nav-link">Profil</a>
                    <a href="{{ route('Galeri') }}" class="nav-link">Galeri</a>
                    <a href="{{ url('/kepesertaan') }}" class="nav-link active">Kepesertaan</a>
                    <a href="{{ url('/warta') }}" class="nav-link">Warta</a>

                    <!-- MENU KHUSUS -->
                    <a href="{{ route('formulir') }}" class="nav-link nav-download">
                        <i class="fas fa-download"></i> Unduh Formulir
                    </a>
                    <a href="{{ route('Pengaduan') }}" class="nav-link nav-kontak">
                        <i class="fas fa-phone-alt"></i> Bantuan/Kontak
                    </a>
                </nav>

                <!-- Mobile Nav -->
                <div class="mobile-nav" id="mobileNav">
                    <a href="{{ url('/') }}" class="nav-link">Beranda</a>
                    <a href="{{ url('/profile') }}" class="nav-link">Profil</a>
                    <a href="{{ route('Galeri') }}" class="nav-link">Galeri</a>
                    <a href="{{ url('/kepesertaan') }}" class="nav-link active">Kepesertaan</a>
                    <a href="{{ url('/warta') }}" class="nav-link">Warta</a>

                    <!-- MENU KHUSUS -->
                    <a href="{{ route('formulir') }}" class="nav-link nav-download">
                        <i class="fas fa-download"></i> Unduh Formulir
                    </a>
                    <a href="{{ route('Pengaduan') }}" class="nav-link nav-kontak">
                        <i class="fas fa-phone-alt"></i> Bantuan/Kontak
                    </a>
                </div>

                <!-- Header Actions -->
                <div class="header-actions">
                    <button class="mobile-menu-btn">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </div>
        </header>

        <!-- Hero Section -->
        <div class="hero-section">
            <div class="hero-content">
                <h1>Kepesertaan Dana Pensiun</h1>
                <p>Informasi lengkap mengenai peserta, iuran, hak, kewajiban, dan layanan Dana Pensiun Bank Riau Kepri</p>
            </div>
        </div>

        <!-- Main Content -->
        <div class="container mt-4">
            <!-- Jumlah Peserta (GLASS EFFECT) -->
            <div class="stats-section">
                <div class="stats-header">
                    <h2>Jumlah Peserta</h2>
                    <p class="stats-date">Data per {{ now()->format('d F Y') }}</p>
                </div>

                <div class="data-stats-grid">
                    @php
                        $fields = [
                            'peserta_aktif' => 'Peserta Aktif',
                            'pensiun_ditunda' => 'Pensiun Ditunda',
                            'pensiun_normal' => 'Pensiun Normal',
                            'pensiun_dipercepat' => 'Pensiun Dipercepat',
                            'pensiun_janda_duda' => 'Pensiun Janda/Duda',
                            'pensiun_anak' => 'Pensiun Anak',
                        ];
                    @endphp

                    @foreach ($fields as $field => $label)
                        <div class="stat-card {{ $loop->first ? 'active-stat' : '' }}"
                            style="animation-delay: {{ $loop->index * 0.1 }}s">
                            <div class="stat-number" data-target="{{ $data->$field ?? 0 }}">0</div>
                            <div class="stat-label">{{ $label }}</div>
                        </div>
                    @endforeach
                </div>

                <!-- Total Counter -->
                <div class="total-counter-section">
                    <div class="total-counter-wrapper">
                        <div class="total-counter-label">Total Peserta</div>
                        <div>
                            <span class="total-counter-number"
                                data-target="{{ ($data->peserta_aktif ?? 0) +
                                    ($data->pensiun_ditunda ?? 0) +
                                    ($data->pensiun_normal ?? 0) +
                                    ($data->pensiun_dipercepat ?? 0) +
                                    ($data->pensiun_janda_duda ?? 0) +
                                    ($data->pensiun_anak ?? 0) }}">0</span>
                            <span class="total-counter-suffix">Orang</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Informasi Kepesertaan -->
            <div class="section">
                <h2 class="section-title">Informasi Kepesertaan</h2>
                <p class="section-subtitle">Panduan lengkap hak, kewajiban, dan program manfaat pensiun</p>

                <!-- Tabs -->
                <div class="tabs">
                    <button class="tab-btn active" onclick="openTab(event, 'hak-kewajiban')">Hak & Kewajiban</button>
                    <button class="tab-btn" onclick="openTab(event, 'pengkinian-data')">Pengkinian Data</button>
                    <button class="tab-btn" onclick="openTab(event, 'program')">Program Pensiun</button>
                    <button class="tab-btn" onclick="openTab(event, 'syarat')">Syarat Pembayaran Manfaat Pensiun</button>
                    <button class="tab-btn" onclick="openTab(event, 'materi-sosialisasi')">Materi Sosialisasi</button>
                </div>

                <!-- Tab: Hak & Kewajiban -->
                <div id="hak-kewajiban" class="tab-content active">
                    <div class="card-grid">
                        <div class="info-card">
                            <h3><i class="fas fa-check-circle" style="color: #10b981;"></i> Hak Peserta</h3>
                            <ul>
                                <li>Menyampaikan pendapat dan saran mengenai perkembangan portofolio investasi dan hasilnya
                                    kepada Pendiri, Dewan Pengawas dan Pengurus</li>
                                <li>Peserta yang berhenti bekerja dan telah mencapai usia Pensiun Normal, berhak atas
                                    Manfaat Pensiun Normal</li>
                                <li>Peserta yang berhenti bekerja dan telah mencapai usia Pensiun Dipercepat tetapi belum
                                    mencapai usia pensiun normal, berhak atas Manfaat Pensiun Dipercepat</li>
                                <li>Peserta yang berhenti bekerja karena Cacat, berhak atas Manfaat Pensiun Cacat</li>
                                <li>Peserta yang berhenti bekerja dan belum mencapai usia Pensiun Dipercepat dan telah
                                    memiliki masa kepesertaan sekurang-kurangnya 3 (tiga) tahun berhak atas Pensiun Ditunda
                                </li>
                                <li>Peserta yang berhenti bekerja dan memiliki masa kepesertaan kurang dari 3 (tiga) tahun,
                                    berhak atas Iuran Peserta ditambah bunga yang besarnya setingkat dengan bunga deposito
                                    berjangka 3 (tiga) bulan pada bank umum Pemerintah yang tertinggi selama periode
                                    kepesertaan dan dibayarkan secara sekaligus</li>
                            </ul>
                        </div>

                        <div class="info-card">
                            <h3><i class="fas fa-exclamation-circle" style="color: #ef4444;"></i> Kewajiban Peserta</h3>
                            <ul>
                                <li>Membayar Iuran Peserta</li>
                                <li>Memberikan data kepesertaan yang diperlukan oleh Pengurus</li>
                                <li>Mendaftarkan Isteri/Suami, Anak atau seseorang yang ditunjuk apabila Peserta tidak
                                    menikah dan tidak mempunyai anak, serta melaporkannya setiap terjadi perubahan susunan
                                    keluarga</li>
                                <li>Mentaati Peraturan Dana Pensiun dan ketentuan peraturan perundang-undangan</li>
                                <li>Mentaati Peraturan Dana Pensiun yang berlaku</li>
                                <li>Bertanggung jawab atas kebenaran data yang diberikan</li>
                            </ul>
                        </div>

                        <div class="info-card">
                            <h3><i class="fas fa-user-check" style="color:#fbbf24;"></i> Tanggung Jawab Peserta</h3>
                            <ul>
                                <li>Bertanggung jawab atas kebenaran data/keterangan yang diberikan kepada Dana Pensiun
                                    dalam rangka administrasi kepesertaan</li>
                                <li>Bertanggung jawab atas hal-hal yang telah disepakati dalam Peraturan</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Tab: Pengkinian Data -->
                <div id="pengkinian-data" class="tab-content">
                    <h2 class="section-title">Pengkinian Data Pensiunan</h2>
                    <p class="section-subtitle">Pemutakhiran data penerima manfaat pensiun</p>

                    <div class="pengkinian-greeting">
                        <h3>Yth. Para Pensiunan,</h3>
                    </div>

                    <p>
                        Bahwa untuk mencapai visi dan misi Dana Pensiun Bank Riau Kepri, dengan ini kami informasikan kepada
                        para pensiunan, apabila terdapat perubahan penerima manfaat pensiun, kami harapkan Bapak/Ibu/Sdr
                        mengisi formulir Pemutahiran Data dengan lengkap dan benar serta mengirimkan kembali ke Dana Pensiun
                        Bank Riau Kepri, ke alamat :
                    </p>

                    <div class="address-block">
                        <p>Departemen Kepesertaan</p>
                        <p class="instansi">Dana Pensiun Bank Riau Kepri</p>
                        <ul class="address-list">
                            <li><strong>Alamat</strong> Arifin Ahmad No. 54–56, Pekanbaru</li>
                            <li><strong>Telepon</strong> (0761) 5781181</li>
                            <li><strong>Fax</strong> (0761) 32720</li>
                            <li><strong>Email</strong> <a href="mailto:dapenbankriau@gmail.com">dapenbankriau@gmail.com</a>
                            </li>
                        </ul>
                    </div>

                    @php
                        use App\Models\FormPemutakhiran;
                        $pdfPemutakhiran = FormPemutakhiran::orderBy('created_at', 'desc')->first();
                    @endphp

                    <div class="form-options-section">
                        <p><strong>Metode Pengisian Formulir:</strong></p>

                        <div class="cta-row">
                            <a href="https://docs.google.com/forms/d/e/1FAIpQLSfLHniuTKGJEk0O2y1hUqDSORJHxA1yptxxeOVwqAH7ZXLTHA/viewform"
                                class="btn">
                                Isi Form Online <i class="fas fa-arrow-right"></i>
                            </a>

                            @if ($pdfPemutakhiran && $pdfPemutakhiran->file_pdf)
                                <a href="{{ asset('uploads/form_pemutakhiran/' . $pdfPemutakhiran->file_pdf) }}"
                                    class="btn" download>
                                    Download Form <i class="fas fa-download"></i>
                                </a>
                            @else
                                <span class="text-muted">Form PDF belum tersedia</span>
                            @endif
                        </div>

                        <ul class="form-options-list">
                            <li>Pengisian online melalui tautan resmi Dana Pensiun.</li>
                            <li>Pengisian offline dengan mengunduh dan mengirimkan formulir.</li>
                        </ul>
                    </div>
                </div>

                <!-- Tab: Program Pensiun -->
                <div id="program" class="tab-content">
                    <div class="card-grid">

                        <!-- Program Dana Pensiun -->
                        <div class="info-card">
                            <h3 class="section-heading success">
                                <i class="fas fa-user-check"></i>
                                Program Dana Pensiun
                            </h3>
                            <ul>
                                <li>Jenis Dana Pensiun adalah <strong>Dana Pensiun Pemberi Kerja (DPPK)</strong></li>
                                <li>Program adalah <strong>Program Pensiun Manfaat Pasti (PPMP)</strong></li>
                            </ul>
                        </div>

                        <!-- Manfaat Pensiun -->
                        <div class="info-card">
                            <h3 class="section-heading pension">
                                <i class="fas fa-hand-holding-usd"></i>
                                Manfaat Pensiun
                            </h3>

                            <h4>a. Jenis Manfaat Pensiun (Produk)</h4>
                            <ol class="numbered-list">
                                <li>Manfaat Pensiun Normal adalah Manfaat Pensiun bagi Peserta, yang mulai dibayarkan
                                    pada saat Peserta Pensiunan setelah mencapai usia 56 (lima puluh enam) tahun
                                    atau sesuai Peraturan Dana Pensiun.</li>
                                <li>Manfaat Pensiun Dipercepat adalah Manfaat Pensiun bagi Peserta, yang mulai
                                    dibayarkan pada saat Peserta Pensiun setelah mencapai usia 46 (empat puluh enam)
                                    tahun atau sesuai Peraturan Dana Pensiun.</li>
                                <li>Manfaat Pensiun Ditunda adalah hak atas Manfaat Pensiun bagi Peserta yang telah
                                    berhenti bekerja sebelum mencapai usia pensiun normal yang pembayarannya ditunda
                                    sampai sekurang-kurangnya mencapai usia pensiun dipercepat.</li>
                                <li>Manfaat Pensiun Cacat adalah Manfaat Pensiun bagi Peserta yang dibayarkan bila
                                    Peserta menjadi cacat.</li>
                                <li>Manfaat Pensiun Janda/Duda adalah Manfaat Pensiun bagi Janda/Duda yang dibayarkan
                                    setelah Peserta/Pensiunan meninggal dunia.</li>
                                <li>Manfaat Pensiun Anak adalah Manfaat Pensiun bagi anak yang dibayarkan setelah
                                    Janda/Duda kawin lagi atau Janda/Duda meninggal dunia atau Peserta/Pensiunan
                                    meninggal dunia tidak ada Janda/Duda.</li>
                            </ol>

                            <h4 style="margin-top: 25px;">b. Perhitungan Manfaat Pensiun</h4>

                            <p>1) Manfaat Pensiun Normal (MPN) sebulan dihitung dengan menggunakan rumus :</p>
                            <div class="formula-box">
                                <span>MPN = (Faktor Penghargaan × Masa Kerja × Penghasilan Dasar Pensiun)</span>
                            </div>

                            <p>2) Manfaat Pensiun Dipercepat (MPD) sebulan dihitung dengan menggunakan rumus :</p>
                            <div class="formula-box">
                                <span>MPD = (Faktor Penghargaan × Masa Kerja × Penghasilan Dasar Pensiun)</span>
                            </div>

                            <p>3) Hak atas Pensiun Ditunda (PD) dihitung dengan menggunakan rumus :</p>
                            <div class="formula-box">
                                <span>PD = Nilai Sekarang × (Faktor Penghargaan × Masa Kerja × Penghasilan Dasar
                                    Pensiun)</span>
                            </div>

                            <p>4) Manfaat Pensiun Cacat (MPC) dihitung dengan menggunakan rumus :</p>
                            <div class="formula-box">
                                <span>MPC = (Faktor Penghargaan × Masa Kerja × Penghasilan Dasar Pensiun)</span>
                            </div>
                        </div>

                        <div class="info-card">
                            <h3 style="color: #1e3c72; margin-bottom: 20px;">
                                Struktur Iuran Pensiun
                            </h3>

                            <h3>Iuran Normal</h3>
                            <ul>
                                <li>Iuran Normal adalah iuran yang diperlukan dalam satu tahun untuk mendanai bagian
                                    dari nilai sekarang Manfaat Pensiun yang dialokasikan pada tahun yang bersangkutan
                                    yang dihitung berdasarkan jumlah yang lebih besar di antara jumlah iuran Peserta
                                    yang ditetapkan dalam Peraturan Dana Pensiun, dan bagian dari nilai sekarang
                                    Manfaat Pensiun yang dialokasikan pada tahun yang bersangkutan sesuai dengan metode
                                    perhitungan aktuaria yang dipergunakan</li>
                                <li>
                                    <strong>Iuran Normal terdiri dari:</strong>
                                    <ol class="numbered-list">
                                        <li>
                                            <strong>Iuran Normal Peserta</strong>
                                            <ul>
                                                <li>Iuran Normal yang wajib dibayar oleh Peserta dan dipungut secara
                                                    langsung oleh Pemberi Kerja setiap bulan, sejak menjadi Peserta
                                                    sampai dengan terjadinya Pemutusan Hubungan Kerja (PHK) atau
                                                    meninggal dunia.</li>
                                                <li>Besarnya Iuran Normal Peserta adalah sebesar 5% (lima persen) dari
                                                    PhDP per bulan.</li>
                                            </ul>
                                        </li>
                                        <li>
                                            <strong>Iuran Normal Pemberi Kerja</strong>
                                            <ul>
                                                <li>Iuran Normal Pemberi Kerja merupakan selisih antara jumlah Iuran
                                                    Normal yang diperlukan berdasarkan Laporan Aktuaris terakhir
                                                    dengan Iuran Normal Peserta yang ditetapkan dalam bentuk persentase
                                                    dari PhDP.</li>
                                                <li>PhDP adalah Penghasilan Dasar Pensiun, yaitu penghasilan yang
                                                    digunakan sebagai dasar perhitungan besarnya iuran pensiun dan
                                                    manfaat pensiun.</li>
                                                <li>Pemberi Kerja wajib menyetorkan Iuran Normal kepada Dana Pensiun
                                                    setiap bulan paling lambat tanggal 15 bulan berikutnya.</li>
                                            </ul>
                                        </li>
                                    </ol>
                                </li>
                            </ul>

                            <h3 style="margin-top: 20px;">Iuran Tambahan</h3>
                            <ul>
                                <li>Iuran Tambahan (PSL, Past Service liabilities) adalah iuran yang disetor dalam rangka
                                    melunasi Defisit</li>
                                <li>Besarnya Iuran Tambahan ditetapkan berdasarkan hasil Valuasi Aktuaria terakhir</li>
                            </ul>
                        </div>

                    </div>
                </div>

                <!-- Tab: Syarat Pembayaran -->
                <div id="syarat" class="tab-content">
                    <div class="flowchart-syarat-container">
                        <div class="flowchart-title-section">
                            <h3>
                                <i class="fas fa-file-contract"></i>
                                Dokumen Syarat Pembayaran Manfaat Pensiun
                            </h3>
                            <p>Lengkapi dokumen berikut untuk proses pembayaran manfaat pensiun</p>
                        </div>

                        <div class="flowchart-syarat">
                            <div class="flowchart-oval-wrapper">
                                <div class="flowchart-oval">
                                    <div class="flowchart-oval-number">1</div>
                                    <strong class="flowchart-oval-title">
                                        <i class="fas fa-id-card"></i> Identitas Peserta
                                    </strong>
                                    <div class="flowchart-oval-content">
                                        <span>Asli Kartu Peserta</span>
                                        <span>Fotokopi KTP</span>
                                        <span>Fotokopi Kartu Keluarga</span>
                                        <span>Fotokopi NPWP</span>
                                        <span>Pas Foto Berwarna</span>
                                    </div>
                                </div>

                                <div class="flowchart-line"></div>

                                <div class="flowchart-oval">
                                    <div class="flowchart-oval-number">2</div>
                                    <strong class="flowchart-oval-title">
                                        <i class="fas fa-users"></i> Status & Keluarga
                                    </strong>
                                    <div class="flowchart-oval-content">
                                        <span>Fotokopi SK PHK</span>
                                        <span>Fotokopi Surat/Akta Nikah</span>
                                        <span>Daftar Susunan Keluarga</span>
                                    </div>
                                </div>

                                <div class="flowchart-line"></div>

                                <div class="flowchart-oval">
                                    <div class="flowchart-oval-number">3</div>
                                    <strong class="flowchart-oval-title">
                                        <i class="fas fa-clipboard-list"></i> Administrasi
                                    </strong>
                                    <div class="flowchart-oval-content">
                                        <span>Fotokopi Buku Rekening</span>
                                        <span>Nomor Telepon</span>
                                        <span>Dokumen Lain (jika ada)</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flowchart-note-box">
                            <div class="flowchart-note-icon">
                                <i class="fas fa-info-circle"></i>
                            </div>
                            <div class="flowchart-note-content">
                                <p>
                                    <strong>Informasi Penting:</strong> Formulir permohonan pembayaran manfaat pensiun dapat
                                    <a href="{{ route('formulir') }}">diunduh di sini</a>.
                                    Pastikan semua dokumen telah dilengkapi dengan benar sebelum diserahkan.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tab: Materi Sosialisasi -->
                <div id="materi-sosialisasi" class="tab-content">
                    <div class="materi-header">
                        <div class="d-flex align-items-center mb-4">
                            <div class="materi-icon">
                                <i class="fas fa-newspaper"></i>
                            </div>
                            <h3 class="mb-0 ms-3">Materi Sosialisasi</h3>
                        </div>
                    </div>

                    @php
                        use App\Models\MateriSosialisasi;
                        $materis = MateriSosialisasi::orderBy('created_at', 'desc')->get();
                    @endphp

                    @if ($materis->count() > 0)
                        <div class="materi-grid">
                            @foreach ($materis as $materi)
                                <div class="materi-card">
                                    <!-- PDF Preview -->
                                    <div class="pdf-preview-wrapper">
                                        @if ($materi->file_pdf)
                                            <!-- PDF Thumbnail -->
                                            <div class="pdf-thumbnail"
                                                onclick="openPdfModal('{{ asset('uploads/materi_sosialisasi/' . $materi->file_pdf) }}', '{{ $materi->judul }}')">
                                                <iframe
                                                    src="{{ asset('uploads/materi_sosialisasi/' . $materi->file_pdf) }}#toolbar=0&navpanes=0&scrollbar=0"
                                                    width="100%" height="450"
                                                    style="border: none; pointer-events: none;">
                                                </iframe>
                                                <div class="pdf-overlay">
                                                    <div class="overlay-content">
                                                        <i class="fas fa-eye fa-2x"></i>
                                                        <p>Klik untuk Lihat & Download</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="no-preview">
                                                <i class="fas fa-file-pdf fa-4x text-muted"></i>
                                                <p class="mt-3 text-muted">Preview tidak tersedia</p>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Card Content -->
                                    <div class="materi-content">
                                        <h5 class="materi-title">{{ $materi->judul }}</h5>

                                        @if ($materi->deskripsi)
                                            <p class="materi-desc">{{ Str::limit($materi->deskripsi, 120) }}</p>
                                        @endif

                                        <div class="materi-footer">
                                            {{-- <div class="materi-date">
                                                <i class="far fa-calendar"></i>
                                                <span>{{ $materi->periode ?? 'Sept - Okt 2026' }}</span>
                                            </div> --}}
                                            @if ($materi->file_pdf)
                                                <a href="javascript:void(0)"
                                                    onclick="openPdfModal('{{ asset('uploads/materi_sosialisasi/' . $materi->file_pdf) }}', '{{ $materi->judul }}')"
                                                    class="btn-lihat-pdf">
                                                    Lihat PDF <i class="fas fa-arrow-right"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-state">
                            <i class="fas fa-folder-open fa-4x text-muted mb-3"></i>
                            <p class="text-muted mb-0">Belum ada materi sosialisasi tersedia</p>
                        </div>
                    @endif
                </div>

                <!-- Modal PDF Viewer -->
                <div id="pdfModal" class="pdf-modal">
                    <div class="pdf-modal-overlay" onclick="closePdfModal()"></div>
                    <div class="pdf-modal-content">
                        <div class="pdf-modal-header">
                            <h4 id="pdfTitle" class="modal-title">Dapen BRK</h4>
                            <div class="pdf-modal-actions">
                                <a id="pdfDownload" href="#" download class="btn-download">
                                    <i class="fas fa-download"></i> Download
                                </a>
                                <button onclick="closePdfModal()" class="btn-close-modal">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="pdf-modal-body">
                            <iframe id="pdfViewer" src="" width="100%" height="100%"
                                frameborder="0"></iframe>
                        </div>
                    </div>
                </div>

                <!-- Tab: Pengaduan & Kontak -->
                <div id="pengkinian" class="tab-content complaint-page">
                    <div class="page-header">
                        <h3>
                            <i class="fas fa-headset"></i>
                            Layanan Pengaduan Peserta
                        </h3>
                        <p>
                            Anda dapat melakukan pengaduan apabila terjadi kerugian finansial yang diduga karena
                            kesalahan
                            atau kelalaian Dana Pensiun Bank Riau Kepri.
                        </p>
                    </div>

                    <div class="info-card">
                        <h4>1. Referensi</h4>
                        <p>
                            Peraturan Otoritas Jasa Keuangan Nomor: 1/POJK.07/2013 tentang Perlindungan Konsumen Sektor
                            Jasa
                            Keuangan, Peraturan Otoritas Jasa Keuangan Nomor: 18/POJK.07/2018 tentang Layanan Pengaduan
                            Konsumen Sektor Jasa Keuangan, dan Surat Edaran Otoritas Jasa Keuangan Nomor:
                            2/SEOJK.07/2014
                            tentang Pelayanan dan Penyelesaian Pengaduan Konsumen pada Pelaku Usaha Jasa Keuangan.
                        </p>
                    </div>

                    <div class="info-card">
                        <h4>2. Ketentuan Umum</h4>
                        <ul class="clean-list">
                            <li>Peserta dapat melakukan pengaduan atas kerugian dan/atau potensi kerugian finansial.
                            </li>
                            <li>Pengaduan dapat disampaikan secara lisan atau tertulis ke Kantor Dana Pensiun Bank Riau
                                Kepri.</li>
                        </ul>
                    </div>

                    <div class="info-card">
                        <div class="card-header red">Layanan Lisan</div>
                        <p><strong>Telepon:</strong> <span class="highlight">0761-5781181</span></p>
                        <p>Pengaduan harus dilengkapi dengan:</p>
                        <ul class="clean-list">
                            <li>Nama</li>
                            <li>Alamat</li>
                            <li>Nomor telepon yang dapat dihubungi</li>
                            <li>Deskripsi singkat pengaduan</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer>
            <div class="container">
                <div class="footer-grid">
                    <div class="footer-section">
                        <h3>Tentang Kami</h3>
                        <p style="color: #d1d5db; font-size: 0.95rem; line-height: 1.9;">
                            Dana Pensiun Bank Riau Kepri memberikan jaminan kesejahteraan di masa pensiun dengan pengelolaan
                            yang profesional dan transparan.
                        </p>
                        <div class="social-links">
                            <a href="https://wa.me/628137964058" target="_blank" aria-label="WhatsApp">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                        </div>
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
                            <li><a href="{{ route('Pengaduan') }}">Pengaduan</a></li>
                            <li><a href="{{ route('formulir') }}">Download Formulir</a></li>
                        </ul>
                    </div>

                    <div class="footer-section">
                        <h3 style="margin-bottom: 1rem;">Kontak & Legalitas</h3>
                        <ul style="margin-bottom: 2rem;">
                            <li style="display: flex; gap: 0.75rem; color: #d1d5db; margin-bottom: 0.5rem;">
                                <i class="fas fa-map-marker-alt" style="margin-top: 0.25rem; color: #fbbf24;"></i>
                                <span>Jl. Arifin Ahmad No. 54-56 Kel Sidomulyo Timur Kec Marpoyan Damai Pekanbaru -
                                    28125</span>
                            </li>
                            <li style="display: flex; gap: 0.75rem; color: #d1d5db; margin-bottom: 0.5rem;">
                                <i class="fas fa-phone" style="color: #fbbf24;"></i>
                                <span>(0761) 5781181</span>
                            </li>
                            <li style="display: flex; gap: 0.75rem; color: #d1d5db; margin-bottom: 1rem;">
                                <i class="fas fa-envelope" style="color: #fbbf24;"></i>
                                <span>dapenbankriau@gmail.com</span>
                            </li>
                        </ul>

                        <div class="compliance-group">
                            <div class="compliance-item">
                                <p>Terdaftar dan Diawasi Oleh:</p>
                                <a href="https://www.ojk.go.id" target="_blank" rel="noopener noreferrer">
                                    <img src="{{ asset('image/logo-ojk.jpg') }}" alt="OJK Logo"
                                        class="logo-img bg-white">
                                </a>
                            </div>

                            <div class="compliance-item">
                                <p>Terdaftar Sebagai Anggota:</p>
                                <a href="https://www.adpi.or.id" target="_blank" rel="noopener noreferrer">
                                    <img src="{{ asset('image/adpi.jpg') }}" alt="ADPI Logo" class="logo-img bg-white">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="footer-bottom">
                    <p>&copy;Dana Pensiun Bank Riau Kepri</p>
                </div>
            </div>
        </footer>


        <!-- Scripts -->
        <script>
            // Loading Screen
            window.addEventListener("load", function() {
                const loader = document.getElementById("loader-wrapper");
                setTimeout(function() {
                    loader.classList.add("loader-hide");
                }, 300);
            });

            // Mobile Menu
            const mobileBtn = document.querySelector(".mobile-menu-btn");
            const mobileNav = document.getElementById("mobileNav");

            if (mobileBtn && mobileNav) {
                mobileBtn.addEventListener("click", () => {
                    mobileNav.classList.toggle("active");
                });
            }

            // Header Scroll
            window.addEventListener('scroll', function() {
                const header = document.getElementById('mainHeader');
                if (header) {
                    if (window.scrollY > 50) header.classList.add('scrolled');
                    else header.classList.remove('scrolled');
                }
            });

            // Tab Functionality
            function openTab(evt, tabName) {
                const tabContents = document.getElementsByClassName('tab-content');
                for (let i = 0; i < tabContents.length; i++) {
                    tabContents[i].classList.remove('active');
                }

                const tabBtns = document.getElementsByClassName('tab-btn');
                for (let i = 0; i < tabBtns.length; i++) {
                    tabBtns[i].classList.remove('active');
                }

                document.getElementById(tabName).classList.add('active');
                if (evt && evt.currentTarget) {
                    evt.currentTarget.classList.add('active');
                }

                // Update URL hash
                if (history.pushState) {
                    history.pushState(null, null, '#' + tabName);
                } else {
                    window.location.hash = '#' + tabName;
                }
            }

            // Open tab from URL hash
            function openTabFromHash() {
                const hash = window.location.hash.substring(1);

                if (hash) {
                    const tabButtons = document.querySelectorAll('.tab-btn');
                    const tabContents = document.querySelectorAll('.tab-content');

                    tabButtons.forEach(btn => btn.classList.remove('active'));
                    tabContents.forEach(content => content.classList.remove('active'));

                    const targetContent = document.getElementById(hash);
                    if (targetContent) {
                        targetContent.classList.add('active');

                        const targetButton = Array.from(tabButtons).find(btn => {
                            const onclickAttr = btn.getAttribute('onclick');
                            return onclickAttr && onclickAttr.includes(hash);
                        });

                        if (targetButton) {
                            targetButton.classList.add('active');
                        }

                        setTimeout(() => {
                            const tabsSection = document.querySelector('.tabs');
                            if (tabsSection) {
                                const yOffset = -100;
                                const y = tabsSection.getBoundingClientRect().top + window.pageYOffset + yOffset;
                                window.scrollTo({
                                    top: y,
                                    behavior: 'smooth'
                                });
                            }
                        }, 300);
                    }
                }
            }

            // Animated Counter
            function animateCounter(element, start, end, duration) {
                let startTime = null;
                const step = (timestamp) => {
                    if (!startTime) startTime = timestamp;
                    const progress = Math.min((timestamp - startTime) / duration, 1);
                    const easeOutExpo = progress === 1 ? 1 : 1 - Math.pow(2, -10 * progress);
                    const currentCount = Math.floor(easeOutExpo * (end - start) + start);
                    element.textContent = currentCount.toLocaleString('id-ID');

                    if (progress < 1) {
                        window.requestAnimationFrame(step);
                    } else {
                        element.textContent = end.toLocaleString('id-ID');
                    }
                };
                window.requestAnimationFrame(step);
            }

            // Intersection Observer for Stats
            const observerOptions = {
                threshold: 0.3,
                rootMargin: '0px 0px -100px 0px'
            };

            const statsObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting && !entry.target.classList.contains('counted')) {
                        entry.target.classList.add('counted');

                        const statCards = entry.target.querySelectorAll('.stat-card');
                        statCards.forEach((card, index) => {
                            setTimeout(() => {
                                card.classList.add('animate');
                                const counter = card.querySelector('.stat-number');
                                const target = parseInt(counter.getAttribute('data-target'));
                                animateCounter(counter, 0, target, 2000);
                            }, index * 100);
                        });

                        setTimeout(() => {
                            const totalCounter = document.querySelector('.total-counter-number');
                            if (totalCounter) {
                                const totalTarget = parseInt(totalCounter.getAttribute('data-target'));
                                animateCounter(totalCounter, 0, totalTarget, 2500);
                            }
                        }, statCards.length * 100 + 300);
                    }
                });
            }, observerOptions);

            // PDF Modal Functions
            function openPdfModal(pdfUrl, title) {
                const modal = document.getElementById('pdfModal');
                const pdfViewer = document.getElementById('pdfViewer');
                const pdfTitle = document.getElementById('pdfTitle');
                const pdfDownload = document.getElementById('pdfDownload');

                if (modal && pdfViewer && pdfTitle && pdfDownload) {
                    pdfTitle.textContent = title;
                    pdfViewer.src = pdfUrl;
                    pdfDownload.href = pdfUrl;
                    modal.classList.add('active');
                    document.body.style.overflow = 'hidden';
                }
            }

            function closePdfModal() {
                const modal = document.getElementById('pdfModal');
                const pdfViewer = document.getElementById('pdfViewer');

                if (modal && pdfViewer) {
                    modal.classList.remove('active');
                    document.body.style.overflow = '';
                    setTimeout(() => {
                        pdfViewer.src = '';
                    }, 300);
                }
            }

            // Close modal with ESC key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closePdfModal();
                }
            });

            // Main Initialization
            document.addEventListener('DOMContentLoaded', () => {
                // Observe stats
                const statsSection = document.querySelector('.stats-section');
                if (statsSection) {
                    statsObserver.observe(statsSection);
                }

                // Check hash
                if (window.location.hash) {
                    openTabFromHash();
                } else {
                    const firstTab = document.querySelector('.tab-btn');
                    if (firstTab) {
                        firstTab.click();
                    }
                }

                // Prevent closing when clicking inside modal content
                const modalContent = document.querySelector('.pdf-modal-content');
                if (modalContent) {
                    modalContent.addEventListener('click', function(e) {
                        e.stopPropagation();
                    });
                }
            });

            // Hash change listener
            window.addEventListener('hashchange', openTabFromHash);
        </script>
    </body>

    </html>
@endsection
