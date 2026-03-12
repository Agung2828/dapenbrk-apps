<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peraturan & Dokumen - Dana Pensiun Bank Riau Kepri</title>
    <link rel="icon" type="image/png" href="{{ asset('image/Loadinglogo.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        /* ============================
                   NAVIGATION BUTTONS
                ============================ */
        .nav-download {
            background: linear-gradient(135deg, #dd762c9c 0%, #ea5a0c88 100%);
            color: #ca3c3c !important;
            padding: 10px 18px;
            border-radius: 8px;
            margin-left: 10px;
            font-weight: 600;
            font-size: 0.95rem;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(249, 115, 22, 0.3);
            white-space: nowrap;
        }

        .nav-download:hover {
            background: linear-gradient(135deg, #ea580c 0%, #c2410c 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(249, 115, 22, 0.4);
        }

        .nav-whatsapp {
            background: rgba(37, 211, 102, 0.15);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 0.2px solid rgba(37, 211, 102, 0.3);
            color: #ffffff !important;
            padding: 10px 10px;
            border-radius: 10px;
            margin-left: 10px;
            font-weight: 600;
            font-size: 0.95rem;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(37, 211, 102, 0.1);
            white-space: nowrap;
        }

        .nav-whatsapp:hover {
            background: rgba(37, 211, 102, 0.25);
            border-color: rgba(37, 211, 102, 0.5);
            color: #128C7E !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(37, 211, 102, 0.2);
        }

        .nav-whatsapp i {
            font-size: 1.1rem;
            color: #25D366;
            transition: color 0.3s ease;
        }

        .nav-whatsapp:hover i {
            color: #128C7E;
        }

        /* ============================
           LOADING SCREEN STYLES (VERSI TRANSPARAN)
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
            flex-direction: column;
            justify-content: center;
            align-items: center;
            transition: opacity 0.2s ease-out, visibility 0.2s ease-out;
            overflow: hidden;
        }

        .loading-ring,
        .loading-text,
        .progress-container,
        .loading-percentage,
        .particle {
            display: none !important;
        }

        /* ==================== BASE STYLES (TETAP) ==================== */

        /* Navigation */
        .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%);
            transition: left 0.3s;
            z-index: -1;
            border-radius: 8px;
        }

        .nav-link:hover::before,
        .nav-link.active::before {
            left: 0;
        }

        .nav-link:hover,
        .nav-link.active {
            color: #dc2626;
            transform: translateY(-2px);
        }

        .header-actions {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .mobile-menu-btn {
            background: transparent;
            border: none;
            color: rgb(8, 8, 8);
            cursor: pointer;
            padding: 0.5rem;
            transition: all 0.3s ease;
            border-radius: 50%;
            display: none;
            width: 35px;
            height: 35px;
            position: relative;
            justify-content: center;
            align-items: center;
        }

        .mobile-menu-btn .line {
            width: 25px;
            height: 3px;
            background: #333;
            position: absolute;
            transition: 0.4s ease;
            border-radius: 5px;
        }

        .mobile-menu-btn .line1 {
            transform: translateY(-6px);
        }

        .mobile-menu-btn .line2 {
            transform: translateY(6px);
        }

        .mobile-menu-btn.active .line1 {
            transform: rotate(45deg);
        }

        .mobile-menu-btn.active .line2 {
            transform: rotate(-45deg);
        }

        .mobile-nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 100vh;
            background: white;
            padding: 5rem 2rem 2rem;
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
            transform: translateY(-100%);
            transition: transform 0.4s ease;
            z-index: 998;
            overflow-y: auto;
        }

        .mobile-nav.active {
            transform: translateY(0);
        }

        .mobile-link {
            color: #333;
            font-size: 1.1rem;
            font-weight: 600;
            text-decoration: none;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }

        .mobile-link:hover,
        .mobile-link.active {
            color: #dc2626;
        }

        /* Hero Section */
        .hero-slider {
            position: relative;
            height: 650px;
            overflow: hidden;

        }

        .hero-slider::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(0, 0, 0, 0.6) 0%, rgba(220, 38, 38, 0.4) 100%);
        }

        .slide-content {
            position: relative;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            color: white;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            z-index: 1;
            animation: slideUp 1s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .slide-content h1 {
            font-size: 4rem;
            margin-bottom: 1.5rem;
            font-weight: 800;
            text-shadow: 2px 2px 20px rgba(0, 0, 0, 0.3);
            line-height: 1.2;
        }

        .slide-content p {
            font-size: 1.35rem;
            max-width: 650px;
            text-shadow: 1px 1px 10px rgba(0, 0, 0, 0.3);
            line-height: 1.8;
        }

        table td,
        table th {
            color: #111 !important;
        }

        tbody tr:hover td {
            color: #111 !important;
        }

        /* Container */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        /* Main Content */
        .main-content {
            padding: 0;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border-left: 5px solid #dc2626;
            transition: all 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(220, 38, 38, 0.2);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #dc2626;
            font-size: 1.8rem;
            margin-bottom: 1rem;
        }

        .stat-value {
            font-size: 2.5rem;
            font-weight: 800;
            color: #dc2626;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: #666;
            font-size: 0.95rem;
            font-weight: 600;
        }

        /* Tabs Navigation */
        .tabs-navigation {
            display: flex;
            gap: 1rem;
            margin-bottom: 3rem;
            border-bottom: 3px solid #e5e7eb;
            flex-wrap: wrap;
            background: white;
            padding: 1rem;
            border-radius: 15px 15px 0 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .tab-btn {
            padding: 1rem 2rem;
            background: none;
            border: none;
            color: #666;
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            position: relative;
            transition: all 0.3s;
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .tab-btn:hover {
            color: #dc2626;
            background: #fef2f2;
        }

        .tab-btn.active {
            color: #dc2626;
            background: #fef2f2;
        }

        .tab-btn.active::after {
            content: '';
            position: absolute;
            bottom: -1rem;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #dc2626 0%, #fbbf24 100%);
            border-radius: 3px 3px 0 0;
        }

        /* Tab Content */
        .tab-content {
            display: none;
            animation: fadeInContent 0.5s ease-in;
        }

        .tab-content.active {
            display: block;
        }

        @keyframes fadeInContent {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Document Section */
        .document-section {
            background: white;
            border-radius: 20px;
            padding: 2.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border-left: 5px solid #dc2626;
        }

        .section-title {
            font-size: 1.8rem;
            color: #1a1a1a;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .section-title i {
            color: #dc2626;
            font-size: 1.5rem;
        }

        .section-description {
            color: #666;
            margin-bottom: 2rem;
            line-height: 1.8;
        }

        /* Table Styles */
        .data-table-wrapper {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .search-box {
            padding: 1.5rem;
            background: #f8f9fa;
            border-bottom: 2px solid #e5e7eb;
            position: relative;
        }

        .search-input {
            width: 100%;
            padding: 1rem 1rem 1rem 3rem;
            border: 2px solid #e5e7eb;
            border-radius: 50px;
            font-size: 1rem;
            transition: all 0.3s;
        }

        .search-input:focus {
            outline: none;
            border-color: #dc2626;
            box-shadow: 0 0 0 4px rgba(220, 38, 38, 0.1);
        }

        .search-icon {
            position: absolute;
            left: 2.5rem;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: 1.2rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
            color: white;
        }

        th {
            padding: 1.2rem;
            text-align: left;
            font-weight: 700;
            font-size: 0.95rem;
        }

        td {
            padding: 1rem 1.2rem;
            border-bottom: 1px solid #f0f0f0;
        }

        tbody tr {
            transition: all 0.3s;
        }

        tbody tr:hover {
            background: #fef2f2;
        }

        .row-number {
            font-weight: 700;
            color: #dc2626;
        }

        /* No Results Message */
        .no-results {
            padding: 2rem;
            text-align: center;
            color: #666;
            font-style: italic;
            display: none;
        }

        .no-results.show {
            display: block;
        }

        /* Prosedur Grid */
        .prosedur-grid {
            display: grid;
            gap: 1rem;
        }

        .prosedur-item {
            background: white;
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            padding: 1.2rem;
            display: flex;
            align-items: center;
            gap: 1.5rem;
            transition: all 0.3s;
            cursor: pointer;
        }

        .prosedur-item:hover {
            border-color: #dc2626;
            background: #fef2f2;
            transform: translateX(5px);
        }

        .prosedur-code {
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: 700;
            font-size: 0.85rem;
            white-space: nowrap;
            min-width: 180px;
            text-align: center;
        }

        .prosedur-title {
            flex-grow: 1;
            font-weight: 600;
            color: #333;
        }

        .prosedur-icon {
            color: #dc2626;
            font-size: 1.3rem;
        }

        .social-links {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .social-links a {
            width: 45px;
            height: 45px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            transition: all 0.3s;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .social-links a:hover {
            background: linear-gradient(135deg, #dc2626 0%, #fbbf24 100%);
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(220, 38, 38, 0.3);
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 2rem;
            text-align: center;
            color: #9ca3af;
            font-size: 0.9rem;
        }

        /* PDF Cards Grid */
        .pdf-cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .pdf-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s;
            cursor: pointer;
            border: 2px solid transparent;
        }

        .pdf-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(220, 38, 38, 0.2);
            border-color: #dc2626;
        }

        .pdf-preview {
            position: relative;
            height: 350px;
            background: #f8f9fa;
            overflow: hidden;
        }

        .pdf-preview iframe {
            width: 100%;
            height: 100%;
            border: none;
            pointer-events: none;
        }

        .pdf-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom, transparent 0%, rgba(0, 0, 0, 0.7) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .pdf-card:hover .pdf-overlay {
            opacity: 1;
        }

        .pdf-overlay-content {
            text-align: center;
            color: white;
            transform: translateY(20px);
            transition: transform 0.3s;
        }

        .pdf-card:hover .pdf-overlay-content {
            transform: translateY(0);
        }

        .pdf-overlay-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .pdf-overlay-text {
            font-size: 1.1rem;
            font-weight: 600;
        }

        .pdf-badge {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 700;
            font-size: 0.75rem;
            text-transform: uppercase;
            box-shadow: 0 4px 10px rgba(220, 38, 38, 0.3);
        }

        .pdf-content {
            padding: 1.5rem;
        }

        .pdf-title {
            font-size: 1.2rem;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 0.75rem;
            line-height: 1.4;
        }

        .pdf-description {
            color: #666;
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 1rem;
        }

        .pdf-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 1rem;
            border-top: 1px solid #e5e7eb;
        }

        .pdf-date {
            color: #999;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .pdf-action {
            color: #dc2626;
            font-weight: 600;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        /* PDF Modal */
        .pdf-modal {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.9);
            z-index: 10000;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .pdf-modal.active {
            display: flex;
        }

        .pdf-modal-content {
            width: 100%;
            max-width: 1200px;
            height: 90vh;
            background: white;
            border-radius: 15px;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .pdf-modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.5rem 2rem;
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
            color: white;
        }

        .pdf-modal-title {
            font-size: 1.3rem;
            font-weight: 700;
        }

        .pdf-modal-actions {
            display: flex;
            gap: 1rem;
        }

        .pdf-modal-btn {
            background: white;
            color: #dc2626;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s;
        }

        .pdf-modal-btn:hover {
            background: #fef2f2;
            transform: translateY(-2px);
        }

        .pdf-modal-close {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 8px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
        }

        .pdf-modal-close:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        .pdf-modal-viewer {
            flex: 1;
            overflow: hidden;
        }

        .pdf-modal-viewer iframe {
            width: 100%;
            height: 100%;
            border: none;
        }

        /* Document Intro Section */
        .document-intro {
            margin-bottom: 3rem;
        }

        .document-intro-box {
            background: white;
            border-radius: 18px;
            padding: 2.5rem 3rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border-left: 6px solid #dc2626;
        }

        .document-intro-box h2 {
            font-size: 1.8rem;
            font-weight: 800;
            color: #111;
            margin-bottom: 1rem;
        }

        .document-intro-box p {
            font-size: 1rem;
            color: #555;
            line-height: 1.8;
            max-width: 900px;
        }

        .document-category {
            margin-top: 1.5rem;
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .document-category span {
            background: #fef2f2;
            color: #dc2626;
            padding: 0.6rem 1.2rem;
            border-radius: 30px;
            font-size: 0.9rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        /* Fix Ukuran PDF Peraturan */
        .pdf-card.small-pdf .pdf-preview {
            height: 210px !important;
        }

        .pdf-card.small-pdf iframe {
            transform: scale(1.05);
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

        .floating-whatsapp-link:hover {
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

        @media (max-width: 768px) {
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

        /* ==================== RESPONSIVE STYLES ==================== */

        /* Mobile First: Default untuk layar kecil */
        @media (max-width: 768px) {

            /* Navigation */
            .main-nav {
                display: none;
            }

            .mobile-menu-btn {
                display: flex;
            }

            /* Hero */
            .hero-slider {
                height: 400px;
            }

            .slide-content h1 {
                font-size: 2rem;
            }

            .slide-content p {
                font-size: 1rem;
            }

            .slide-content {
                padding: 0 1rem;
            }

            /* Container */
            .container {
                padding: 0 1rem;
            }

            /* Tabs */
            .tabs-navigation {
                flex-direction: column;
                padding: 0.75rem;
                gap: 0.5rem;
            }

            .tab-btn {
                width: 100%;
                justify-content: center;
                padding: 0.875rem 1rem;
                font-size: 0.9rem;
            }

            .tab-btn.active::after {
                display: none;
            }

            /* Document Section */
            .document-section {
                padding: 1.5rem;
                border-radius: 15px;
            }

            .section-title {
                font-size: 1.3rem;
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }

            /* Document Intro */
            .document-intro-box {
                padding: 1.5rem;
            }

            .document-intro-box h2 {
                font-size: 1.3rem;
            }

            .document-intro-box p {
                font-size: 0.9rem;
            }

            .document-category span {
                font-size: 0.8rem;
                padding: 0.5rem 0.9rem;
            }

            /* Search */
            .search-box {
                padding: 1rem;
            }

            .search-input {
                padding: 0.75rem 0.75rem 0.75rem 2.5rem;
                font-size: 0.9rem;
            }

            .search-icon {
                left: 1.5rem;
                font-size: 1rem;
            }

            /* Table */
            .data-table-wrapper {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            table {
                font-size: 0.85rem;
                min-width: 500px;
            }

            th,
            td {
                padding: 0.75rem 0.5rem;
            }

            th {
                font-size: 0.85rem;
            }

            /* PDF Cards */
            .pdf-cards-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .pdf-preview {
                height: 250px;
            }

            .pdf-content {
                padding: 1.25rem;
            }

            .pdf-title {
                font-size: 1rem;
            }

            .pdf-description {
                font-size: 0.85rem;
            }

            /* PDF Modal */
            .pdf-modal {
                padding: 1rem;
            }

            .pdf-modal-content {
                height: 85vh;
            }

            .pdf-modal-header {
                padding: 1rem;
                flex-wrap: wrap;
                gap: 0.75rem;
            }

            .pdf-modal-title {
                font-size: 1rem;
                width: 100%;
            }

            .pdf-modal-actions {
                width: 100%;
                justify-content: space-between;
            }

            .pdf-modal-btn {
                padding: 0.625rem 1rem;
                font-size: 0.85rem;
            }

            /* Stats */
            .stats-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .stat-card {
                padding: 1.5rem;
            }

            /* Prosedur */
            .prosedur-item {
                flex-direction: column;
                align-items: flex-start;
                padding: 1rem;
            }

            .prosedur-code {
                min-width: auto;
                width: 100%;
                font-size: 0.75rem;
                padding: 0.5rem;
            }

            .prosedur-title {
                font-size: 0.9rem;
            }
        }

        /* Tablet: 769px - 1023px */
        @media (min-width: 769px) and (max-width: 1023px) {
            .hero-slider {
                height: 500px;
            }

            .slide-content h1 {
                font-size: 3rem;
            }

            .slide-content p {
                font-size: 1.2rem;
            }

            .pdf-cards-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 1.75rem;
            }

            .tabs-navigation {
                gap: 0.75rem;
            }

            .tab-btn {
                padding: 0.875rem 1.5rem;
                font-size: 0.95rem;
            }
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

        /* Desktop: 1024px ke atas */
        @media (min-width: 1024px) {
            .main-nav {
                display: flex;
                gap: 0.25rem;
                align-items: center;
                animation: fadeIn 0.8s ease-out;
            }

            @keyframes fadeIn {
                from {
                    opacity: 0;
                }

                to {
                    opacity: 1;
                }
            }

            .nav-link {
                color: rgb(8, 8, 8);
                text-decoration: none;
                font-size: 0.938rem;
                font-weight: 500;
                transition: all 0.3s ease;
                position: relative;
                padding: 0.75rem 1.25rem;
                border-radius: 8px;
                text-shadow: 0 1px 2px rgba(250, 247, 247, 0.2);
            }

            .main-header.scrolled .nav-link {
                color: #333;
                text-shadow: none;
            }

            .mobile-menu-btn,
            .mobile-nav {
                display: none !important;
            }

            .pdf-cards-grid {
                grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
            }
        }

        /* Large Desktop: 1400px ke atas */
        @media (min-width: 1400px) {
            .container {
                max-width: 1320px;
            }

            .nav-download {
                background: #f36c12;
                /* kuning-oranye */
                color: #fff !important;
                padding: 8px 14px;
                border-radius: 6px;
                margin-left: 10px;
                font-weight: 600;
            }

            .nav-download:hover {
                background: #d68910;
                color: #f70707 !important;
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

    <script>
        window.addEventListener("load", function() {
            const loader = document.getElementById("loader-wrapper");
            setTimeout(function() {
                loader.classList.add("loader-hide");
            }, 300);
        });
    </script>

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
                <a href="{{ url('/kepesertaan') }}" class="nav-link">Kepesertaan</a>
                <a href="{{ url('/warta') }}" class="nav-link">Warta</a>
                <!-- MENU KHUSUS -->
                <a href="{{ route('formulir') }}" class="nav-link nav-download">
                    <i class="fas fa-download"></i> Unduh Formulir
                </a>
                <a href="{{ route('Pengaduan') }}" class="nav-link nav-kontak">
                    <i class="fas fa-phone-alt"></i> Bantuan/Kontak
                </a>
        </div>

        <!-- Mobile Nav -->
        <div class="mobile-nav" id="mobileNav">
            <a href="{{ url('/') }}" class="nav-link">Beranda</a>
            <a href="{{ url('/profile') }}" class="nav-link">Profil</a>
            <a href="{{ route('Galeri') }}" class="nav-link">Galeri</a>
            <a href="{{ url('/kepesertaan') }}" class="nav-link">Kepesertaan</a>
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

    <!-- MOBILE NAV SCRIPT -->
    <script>
        const mobileBtn = document.querySelector(".mobile-menu-btn");
        const mobileNav = document.getElementById("mobileNav");

        mobileBtn.addEventListener("click", () => {
            mobileNav.classList.toggle("active");
        });
    </script>

    <!-- SCROLL EFFECT -->
    <script>
        window.addEventListener('scroll', function() {
            const header = document.getElementById('mainHeader');
            if (window.scrollY > 50) header.classList.add('scrolled');
            else header.classList.remove('scrolled');
        });
    </script>

    <!-- Home Page -->
    <div id="home" class="page-content active">
        <!-- Hero Slider -->
        <div class="hero-slider">
            <div class="slide active" style="background-image: url('{{ asset('image/Istana Siak.PNG') }}');">
                <div class="slide-content">
                    <h1>Jaminan Masa Depan<br>Yang Cerah</h1>
                    <p>Dana Pensiun Bank Riau Kepri memberikan perlindungan finansial untuk hari tua Anda dengan
                        pengelolaan profesional dan transparan.</p>
                </div>
            </div>

            <div class="slide" style="background-image: url('{{ asset('image/MTQ.jpg') }}');">
                <div class="slide-content">
                    <h1>Investasi Terpercaya<br>Untuk Masa Pensiun</h1>
                    <p>Pengelolaan dana pensiun yang amanah dan profesional dengan hasil investasi optimal untuk
                        kesejahteraan peserta.</p>
                </div>
            </div>

            <div class="slide" style="background-image: url('{{ asset('image/MTQ.jpg') }}');">
                <div class="slide-content">
                    <h1>Investasi Terpercaya<br>Untuk Masa Pensiun</h1>
                    <p>Pengelolaan dana pensiun yang amanah dan profesional dengan hasil investasi optimal untuk
                        kesejahteraan peserta.</p>
                </div>
            </div>

            <div class="slider-dots">
                <span class="dot active" onclick="changeSlide(0)"></span>
                <span class="dot" onclick="changeSlide(1)"></span>
                <span class="dot" onclick="changeSlide(2)"></span>
            </div>
        </div>
        <section class="quick-links">
            <!-- Main Content -->
            <main class="main-content">
                <section class="document-intro">
                    <div class="document-intro-box">
                        <h2>Peraturan & Dokumen Dana Pensiun</h2>
                        <p>
                            Halaman ini memuat peraturan, pedoman, prosedur standar operasional, serta
                            daftar penerima manfaat pensiun Dana Pensiun Bank Riau Kepri.
                        </p>

                        <div class="document-category">
                            <span><i class="fas fa-file-pdf"></i> Peraturan Dana Pensiun</span>
                            <span><i class="fas fa-book"></i> Pedoman</span>
                            <span><i class="fas fa-clipboard-list"></i> PSO</span>
                        </div>
                    </div>
                </section>


                <!-- Tabs Navigation - HANYA 3 TAB -->
                <div class="tabs-navigation">
                    <button class="tab-btn active" onclick="showTab('peraturan-pdf')">
                        <i class="fas fa-file-pdf"></i> Peraturan PDF
                    </button>
                    <button class="tab-btn" onclick="showTab('pedoman')">
                        <i class="fas fa-book"></i> Pedoman
                    </button>
                    <button class="tab-btn" onclick="showTab('pso')">
                        <i class="fas fa-clipboard-list"></i> PSO
                    </button>
                </div>

                <!-- Tab: Pedoman -->
                <div id="pedoman" class="tab-content">
                    <div class="document-section">
                        <h2 class="section-title">
                            <i class="fas fa-book"></i>
                            Pedoman Dana Pensiun
                        </h2>

                        <div class="data-table-wrapper">
                            <div class="search-box">
                                <i class="fas fa-search search-icon"></i>
                                <input type="text" id="searchPedoman" class="search-input"
                                    placeholder="Cari pedoman (kode atau nama)...">
                            </div>
                            <table id="tablePedoman">
                                <thead>
                                    <tr>
                                        <th width="80">No</th>
                                        <th width="250">Kode</th>
                                        <th>Nama</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pedomans as $i => $item)
                                        <tr>
                                            <td class="row-number">{{ $i + 1 }}</td>
                                            <td>{{ $item->kode }}</td>
                                            <td>{{ $item->nama }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div id="noResultsPedoman" class="no-results">Tidak ada data yang ditemukan</div>
                        </div>
                    </div>
                </div>

                <!-- Tab: PSO -->
                <div id="pso" class="tab-content">
                    <div class="document-section">
                        <h2 class="section-title">
                            <i class="fas fa-clipboard-list"></i>
                            Prosedur Standar Operasional
                        </h2>

                        <div class="data-table-wrapper">
                            <div class="search-box">
                                <i class="fas fa-search search-icon"></i>
                                <input type="text" id="searchPSO" class="search-input"
                                    placeholder="Cari PSO (kode atau nama)...">
                            </div>
                            <table id="tablePSO">
                                <thead>
                                    <tr>
                                        <th width="80">No</th>
                                        <th width="250">Kode</th>
                                        <th>Nama</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($psos as $i => $item)
                                        <tr>
                                            <td class="row-number">{{ $i + 1 }}</td>
                                            <td>{{ $item->kode }}</td>
                                            <td>{{ $item->nama }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div id="noResultsPSO" class="no-results">Tidak ada data yang ditemukan</div>
                        </div>
                    </div>
                </div>

                <!-- Tab: Peraturan Dana Pensiun PDF -->

                <div id="peraturan-pdf" class="tab-content active">
                    <h2 class="section-title">
                        <i class="fas fa-file-pdf"></i>
                        Peraturan Dana Pensiun
                    </h2>

                    <div class="pdf-cards-grid">
                        @forelse ($peraturans as $item)
                            <div class="pdf-card small-pdf"
                                onclick="openPDF('{{ asset('storage/' . $item->file_pdf) }}', '{{ $item->judul }}')">

                                <!-- PREVIEW PDF -->
                                <div class="pdf-preview">
                                    <iframe
                                        src="{{ asset('storage/' . $item->file_pdf) }}#page=1&view=FitH&toolbar=0&navpanes=0"
                                        scrolling="no">
                                    </iframe>

                                    <!-- OVERLAY -->
                                    <div class="pdf-overlay">
                                        <div class="pdf-overlay-content">
                                            <div class="pdf-overlay-icon">
                                                <i class="fas fa-eye"></i>
                                            </div>
                                            <div class="pdf-overlay-text">
                                                Klik untuk Lihat & Download
                                            </div>
                                        </div>
                                    </div>

                                    <!-- BADGE -->
                                    <span class="pdf-badge">
                                        PDF {{ $item->tahun }}
                                    </span>
                                </div>

                                <!-- KONTEN BAWAH -->
                                <div class="pdf-content">
                                    <h3 class="pdf-title">
                                        {{ $item->judul }}
                                    </h3>

                                    <p class="pdf-description">
                                        {{ $item->deskripsi }}
                                    </p>

                                    <div class="pdf-meta">
                                        <span class="pdf-date">
                                            <i class="far fa-calendar"></i>
                                            {{ $item->tahun }}
                                        </span>

                                        <span class="pdf-action">
                                            Lihat PDF <i class="fas fa-arrow-right"></i>
                                        </span>
                                    </div>
                                </div>

                            </div>
                        @empty
                            <p class="text-muted">Belum ada peraturan PDF.</p>
                        @endforelse
                    </div>
                </div>
            </main>
        </section>
    </div>

    <!-- PDF Modal -->
    <div class="pdf-modal" id="pdfModal">
        <div class="pdf-modal-content">
            <div class="pdf-modal-header">
                <div class="pdf-modal-title" id="pdfTitle">Dokumen PDF</div>
                <div class="pdf-modal-actions">
                    <button class="pdf-modal-btn" onclick="downloadPDF()">
                        <i class="fas fa-download"></i> Download
                    </button>
                    <button class="pdf-modal-close" onclick="closePDF()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="pdf-modal-viewer">
                <iframe id="pdfViewer" src=""></iframe>
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


    <!-- JAVASCRIPT -->
    <script>
        // ==================== TAB FUNCTIONALITY ====================
        function showTab(tabName) {
            // Hide all tabs
            document.querySelectorAll(".tab-content").forEach(el => {
                el.classList.remove("active");
            });

            // Show selected tab
            document.getElementById(tabName).classList.add("active");

            // Update active button
            document.querySelectorAll(".tab-btn").forEach(btn => {
                btn.classList.remove("active");
            });

            event.target.classList.add("active");
        }

        // ==================== SEARCH FUNCTIONALITY ====================

        // Search for Pedoman (searches both kode and nama)
        document.getElementById('searchPedoman').addEventListener('keyup', function() {
            searchTable('tablePedoman', this.value, 'noResultsPedoman', true);
        });

        // Search for PSO (searches both kode and nama)
        document.getElementById('searchPSO').addEventListener('keyup', function() {
            searchTable('tablePSO', this.value, 'noResultsPSO', true);
        });

        // Universal search function
        function searchTable(tableId, searchValue, noResultsId, searchMultipleColumns = false) {
            const table = document.getElementById(tableId);
            const tbody = table.querySelector('tbody');
            const rows = tbody.getElementsByTagName('tr');
            const searchLower = searchValue.toLowerCase();
            let visibleCount = 0;

            for (let i = 0; i < rows.length; i++) {
                const row = rows[i];
                let text = '';

                if (searchMultipleColumns) {
                    // Search in all columns except the first (No column)
                    const cells = row.getElementsByTagName('td');
                    for (let j = 1; j < cells.length; j++) {
                        text += cells[j].textContent || cells[j].innerText;
                        text += ' ';
                    }
                } else {
                    // Search only in the second column (Nama)
                    const nameCell = row.getElementsByTagName('td')[1];
                    text = nameCell.textContent || nameCell.innerText;
                }

                if (text.toLowerCase().indexOf(searchLower) > -1) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            }

            // Show/hide no results message
            const noResults = document.getElementById(noResultsId);
            if (visibleCount === 0 && searchValue !== '') {
                noResults.classList.add('show');
            } else {
                noResults.classList.remove('show');
            }
        }

        // ==================== SLIDER FUNCTIONALITY ====================
        let currentSlide = 0;
        const slides = document.querySelectorAll('.slide');
        const dots = document.querySelectorAll('.dot');

        function showSlide(n) {
            slides.forEach(slide => slide.classList.remove('active'));
            dots.forEach(dot => dot.classList.remove('active'));

            currentSlide = n;
            if (currentSlide >= slides.length) currentSlide = 0;
            if (currentSlide < 0) currentSlide = slides.length - 1;

            slides[currentSlide].classList.add('active');
            dots[currentSlide].classList.add('active');
        }

        function changeSlide(n) {
            showSlide(n);
        }

        setInterval(() => {
            currentSlide++;
            showSlide(currentSlide);
        }, 5000);

        // ==================== PDF MODAL ====================
        let currentPDF = '';

        function openPDF(url, title = 'Dokumen PDF') {
            currentPDF = url;
            document.getElementById('pdfViewer').src = url;
            document.getElementById('pdfTitle').innerText = title;
            document.getElementById('pdfModal').classList.add('active');
        }

        function closePDF() {
            document.getElementById('pdfModal').classList.remove('active');
            document.getElementById('pdfViewer').src = '';
        }

        function downloadPDF() {
            if (!currentPDF) return;
            window.open(currentPDF, '_blank');
        }

        // Close modal when clicking outside
        document.getElementById('pdfModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closePDF();
            }
        });
    </script>
</body>

</html>
