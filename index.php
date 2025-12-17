<?php
// include_once('hms/include/config.php');
if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($con, $_POST['fullname']);
    $email = mysqli_real_escape_string($con, $_POST['emailid']);
    $mobileno = mysqli_real_escape_string($con, $_POST['mobileno']);
    $dscrption = mysqli_real_escape_string($con, $_POST['description']);
    $query = mysqli_query($con, "insert into tblcontactus(fullname,email,contactno,message) values('$name','$email','$mobileno','$dscrption')");
    if ($query) {
        echo "<script>alert('Your information succesfully submitted');</script>";
        echo "<script>window.location.href ='index.php'</script>";
    } else {
        echo "<script>alert('Something went wrong. Please try again.');</script>";
    }
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PrimeMed | Advanced Healthcare Management System</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/images/fav.jpg">

    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <style>
        :root {
            /* Premium Color Palette */
            --primary: #0A2463;
            --primary-light: #3E78B2;
            --primary-dark: #071A3E;
            --secondary: #00B4D8;
            --secondary-light: #4CC9F0;
            --accent: #FF6B6B;
            --accent-light: #FF9E9E;
            --success: #2E7D32;
            --success-light: #4CAF50;
            --dark: #0D1B2A;
            --dark-light: #1B263B;
            --light: #F8F9FA;
            --gray: #8B8C8D;
            --gray-light: #E0E0E0;

            /* Premium Gradients */
            --gradient-primary: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            --gradient-dark: linear-gradient(135deg, var(--dark) 0%, var(--primary) 100%);
            --gradient-accent: linear-gradient(135deg, var(--accent) 0%, var(--accent-light) 100%);
            --gradient-blue: linear-gradient(135deg, var(--secondary) 0%, var(--secondary-light) 100%);
            --gradient-success: linear-gradient(135deg, var(--success) 0%, var(--success-light) 100%);

            /* Premium Shadows */
            --shadow-sm: 0 2px 8px rgba(10, 36, 99, 0.08);
            --shadow-md: 0 8px 24px rgba(10, 36, 99, 0.12);
            --shadow-lg: 0 16px 40px rgba(10, 36, 99, 0.15);
            --shadow-xl: 0 24px 56px rgba(10, 36, 99, 0.18);
            --shadow-xxl: 0 32px 72px rgba(10, 36, 99, 0.22);

            /* Premium Transitions */
            --transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            --transition-slow: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            --transition-fast: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);

            /* Glass Morphism */
            --glass-bg: rgba(255, 255, 255, 0.1);
            --glass-border: rgba(255, 255, 255, 0.18);
            --glass-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
            scroll-padding-top: 80px;
        }

        body {
            font-family: 'Poppins', sans-serif;
            color: var(--dark);
            line-height: 1.7;
            overflow-x: hidden;
            background: var(--light);
            position: relative;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at 20% 30%, rgba(10, 36, 99, 0.03) 0%, transparent 50%),
                radial-gradient(circle at 80% 70%, rgba(0, 180, 216, 0.03) 0%, transparent 50%);
            pointer-events: none;
            z-index: -1;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Montserrat', sans-serif;
            font-weight: 800;
            line-height: 1.2;
            letter-spacing: -0.5px;
        }

        /* ===== PREMIUM NAVBAR ===== */
        .navbar-premium {
            padding: 1.5rem 0;
            background: rgba(255, 255, 255, 0.96);
            backdrop-filter: blur(25px) saturate(180%);
            -webkit-backdrop-filter: blur(25px) saturate(180%);
            border-bottom: 1px solid rgba(10, 36, 99, 0.08);
            transition: var(--transition);
            z-index: 1000;
        }

        .navbar-premium.scrolled {
            padding: 1rem 0;
            background: rgba(255, 255, 255, 0.98);
            box-shadow: var(--shadow-lg);
            border-bottom: 1px solid rgba(10, 36, 99, 0.12);
        }

        .nav-brand-premium {
            display: flex;
            align-items: center;
            text-decoration: none;
        }

        .nav-logo-icon-premium {
            width: 50px;
            height: 50px;
            background: var(--gradient-primary);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            color: white;
            font-size: 1.6rem;
            box-shadow: 0 8px 24px rgba(10, 36, 99, 0.2);
            transition: var(--transition);
        }

        .navbar-premium.scrolled .nav-logo-icon-premium {
            transform: scale(0.9);
        }

        .nav-logo-text-premium {
            font-size: 2rem;
            font-weight: 900;
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: -1px;
        }

        .nav-link-premium {
            color: var(--dark) !important;
            font-weight: 600;
            padding: 0.8rem 1.5rem !important;
            margin: 0 0.3rem;
            border-radius: 12px;
            transition: var(--transition);
            position: relative;
            font-size: 0.95rem;
        }

        .nav-link-premium:hover {
            background: rgba(10, 36, 99, 0.05);
            color: var(--primary) !important;
            transform: translateY(-2px);
        }

        .nav-link-premium.active {
            background: rgba(10, 36, 99, 0.08);
            color: var(--primary) !important;
        }

        .nav-link-premium.active::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 50%;
            transform: translateX(-50%);
            width: 6px;
            height: 6px;
            background: var(--secondary);
            border-radius: 50%;
            box-shadow: 0 0 0 4px rgba(0, 180, 216, 0.2);
        }

        .btn-premium {
            background: var(--gradient-primary);
            color: white;
            padding: 0.9rem 2rem;
            border-radius: 14px;
            font-weight: 600;
            border: none;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
            font-size: 0.95rem;
            box-shadow: 0 8px 24px rgba(10, 36, 99, 0.2);
        }

        .btn-premium::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: var(--transition-slow);
        }

        .btn-premium:hover {
            transform: translateY(-3px);
            box-shadow: 0 16px 40px rgba(10, 36, 99, 0.3);
        }

        .btn-premium:hover::before {
            left: 100%;
        }

        /* ===== ULTIMATE HERO SECTION ===== */
        .hero-ultimate {
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            overflow: hidden;
            padding-top: 80px;
        }

        .hero-video-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
        }

        .hero-video-container video {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            filter: brightness(0.7);
        }

        .hero-gradient-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg,
                    rgba(10, 36, 99, 0.9) 0%,
                    rgba(62, 120, 178, 0.7) 50%,
                    rgba(0, 180, 216, 0.8) 100%);
            z-index: 2;
        }

        .hero-particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 3;
            pointer-events: none;
        }

        .particle {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            animation: float-particle 20s infinite linear;
        }

        @keyframes float-particle {
            0% {
                transform: translate(0, 0) rotate(0deg);
            }

            100% {
                transform: translate(100px, 100px) rotate(360deg);
            }
        }

        .hero-content-ultimate {
            position: relative;
            z-index: 4;
            color: white;
        }

        .hero-badge-ultimate {
            display: inline-flex;
            align-items: center;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            padding: 0.8rem 1.8rem;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 2.5rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
            animation: slideInLeft 0.8s ease;
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .hero-title-ultimate {
            font-size: 5rem;
            font-weight: 900;
            margin-bottom: 1.5rem;
            line-height: 1.1;
            text-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            animation: fadeInUp 0.8s ease 0.2s both;
        }

        .hero-title-ultimate span {
            background: linear-gradient(135deg, #fff 0%, var(--secondary) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            position: relative;
        }

        .hero-title-ultimate span::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 100%;
            height: 3px;
            background: var(--gradient-blue);
            border-radius: 2px;
        }

        .hero-subtitle-ultimate {
            font-size: 1.4rem;
            opacity: 0.95;
            margin-bottom: 3.5rem;
            max-width: 650px;
            font-weight: 300;
            line-height: 1.8;
            animation: fadeInUp 0.8s ease 0.4s both;
        }

        .hero-cta-ultimate {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
            margin-bottom: 4rem;
            animation: fadeInUp 0.8s ease 0.6s both;
        }

        .btn-hero-primary {
            background: var(--gradient-blue);
            color: white;
            padding: 1.2rem 2.5rem;
            border-radius: 14px;
            font-weight: 600;
            font-size: 1.1rem;
            box-shadow: 0 12px 32px rgba(0, 180, 216, 0.3);
        }

        .btn-hero-secondary {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            color: white;
            padding: 1.2rem 2.5rem;
            border-radius: 14px;
            font-weight: 600;
            font-size: 1.1rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .hero-stats-ultimate {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 2rem;
            animation: fadeInUp 0.8s ease 0.8s both;
        }

        .stat-card-ultimate {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 2.5rem 2rem;
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.15);
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }

        .stat-card-ultimate::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: var(--gradient-blue);
            transform: scaleX(0);
            transform-origin: left;
            transition: var(--transition);
        }

        .stat-card-ultimate:hover::before {
            transform: scaleX(1);
        }

        .stat-card-ultimate:hover {
            transform: translateY(-10px);
            background: rgba(255, 255, 255, 0.15);
            border-color: rgba(255, 255, 255, 0.25);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }

        .stat-icon-ultimate {
            font-size: 3rem;
            margin-bottom: 1.5rem;
            color: var(--secondary-light);
        }

        .stat-number-ultimate {
            font-size: 3.5rem;
            font-weight: 900;
            margin-bottom: 0.5rem;
            background: linear-gradient(135deg, #fff, var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            line-height: 1;
        }

        .stat-label-ultimate {
            font-size: 1rem;
            opacity: 0.9;
            font-weight: 500;
        }

        /* ===== ULTIMATE EMERGENCY BANNER ===== */
        .emergency-ultimate {
            background: var(--gradient-accent);
            color: white;
            padding: 3rem;
            border-radius: 25px;
            margin: 5rem 0;
            position: relative;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(255, 107, 107, 0.3);
            animation: pulse-glow 2s infinite;
        }

        @keyframes pulse-glow {

            0%,
            100% {
                box-shadow: 0 0 0 0 rgba(255, 107, 107, 0.7),
                    0 20px 50px rgba(255, 107, 107, 0.3);
            }

            50% {
                box-shadow: 0 0 0 20px rgba(255, 107, 107, 0),
                    0 20px 50px rgba(255, 107, 107, 0.3);
            }
        }

        .emergency-ultimate::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><path fill="%23ffffff" fill-opacity="0.05" d="M0,0L1000,0L1000,1000L0,1000Z"/></svg>');
        }

        /* ===== ULTIMATE SECTIONS ===== */
        .section-ultimate {
            padding: 140px 0;
            position: relative;
        }

        .section-title-ultimate {
            position: relative;
            display: inline-block;
            font-size: 3.5rem;
            margin-bottom: 1.5rem;
        }

        .section-title-ultimate::after {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 0;
            width: 80px;
            height: 6px;
            background: var(--gradient-primary);
            border-radius: 3px;
        }

        .section-title-ultimate.center::after {
            left: 50%;
            transform: translateX(-50%);
        }

        .section-subtitle-ultimate {
            color: var(--gray);
            font-size: 1.2rem;
            max-width: 700px;
            margin: 0 auto 5rem;
            line-height: 1.8;
        }

        /* ===== ULTIMATE FEATURE CARDS ===== */
        .feature-ultimate-card {
            background: white;
            padding: 4rem 3rem;
            border-radius: 30px;
            box-shadow: var(--shadow-xl);
            transition: var(--transition);
            height: 100%;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(10, 36, 99, 0.1);
        }

        .feature-ultimate-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 6px;
            background: var(--gradient-primary);
            transform: scaleX(0);
            transform-origin: left;
            transition: var(--transition);
        }

        .feature-ultimate-card:hover::before {
            transform: scaleX(1);
        }

        .feature-ultimate-card:hover {
            transform: translateY(-20px);
            box-shadow: var(--shadow-xxl);
        }

        .feature-icon-ultimate {
            width: 100px;
            height: 100px;
            background: var(--gradient-primary);
            border-radius: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 2.5rem;
            color: white;
            font-size: 2.5rem;
            transition: var(--transition);
            box-shadow: 0 12px 32px rgba(10, 36, 99, 0.2);
        }

        .feature-ultimate-card:hover .feature-icon-ultimate {
            transform: rotate(10deg) scale(1.1);
        }

        .feature-ultimate-card h3 {
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
        }

        .feature-list-ultimate {
            list-style: none;
            padding: 0;
            margin-top: 2rem;
        }

        .feature-list-ultimate li {
            padding: 0.8rem 0;
            color: var(--dark);
            border-bottom: 1px solid rgba(10, 36, 99, 0.1);
            display: flex;
            align-items: center;
        }

        .feature-list-ultimate li:last-child {
            border-bottom: none;
        }

        .feature-list-ultimate li i {
            color: var(--success-light);
            font-size: 1.1rem;
            margin-right: 12px;
            width: 24px;
            text-align: center;
        }

        /* ===== ULTIMATE PORTAL CARDS ===== */
        .portal-ultimate-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(380px, 1fr));
            gap: 40px;
        }

        .portal-ultimate-card {
            background: white;
            border-radius: 30px;
            overflow: hidden;
            box-shadow: var(--shadow-xl);
            transition: var(--transition);
            height: 100%;
            position: relative;
        }

        .portal-ultimate-card:hover {
            transform: translateY(-20px) scale(1.02);
            box-shadow: var(--shadow-xxl);
        }

        .portal-header-ultimate {
            padding: 4rem 3rem;
            text-align: center;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .portal-header-ultimate::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: var(--gradient-blue);
            z-index: 1;
        }

        .portal-header-ultimate.patient::before {
            background: var(--gradient-blue);
        }

        .portal-header-ultimate.doctor::before {
            background: var(--gradient-success);
        }

        .portal-header-ultimate.admin::before {
            background: linear-gradient(135deg, #7B1FA2, #9C27B0);
        }

        .portal-icon-ultimate {
            position: relative;
            z-index: 2;
            font-size: 4rem;
            margin-bottom: 1.5rem;
            display: inline-block;
            width: 100px;
            height: 100px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(5px);
        }

        .portal-header-ultimate h3 {
            position: relative;
            z-index: 2;
            font-size: 2rem;
            margin: 0;
            font-weight: 800;
        }

        .portal-body-ultimate {
            padding: 3rem;
        }

        .portal-features-ultimate {
            list-style: none;
            padding: 0;
            margin: 2rem 0 3rem;
        }

        .portal-features-ultimate li {
            padding: 1rem 0;
            color: var(--dark);
            border-bottom: 1px solid rgba(10, 36, 99, 0.1);
            display: flex;
            align-items: center;
            font-size: 1rem;
        }

        .portal-features-ultimate li:last-child {
            border-bottom: none;
        }

        .portal-features-ultimate li::before {
            content: '✓';
            color: var(--success-light);
            font-weight: bold;
            font-size: 1.1rem;
            margin-right: 12px;
            width: 24px;
            text-align: center;
        }

        /* ===== ULTIMATE SERVICES ===== */
        .services-ultimate-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 40px;
        }

        .service-ultimate-card {
            background: white;
            border-radius: 25px;
            padding: 3rem;
            box-shadow: var(--shadow-lg);
            transition: var(--transition);
            text-align: center;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(10, 36, 99, 0.1);
        }

        .service-ultimate-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: var(--gradient-primary);
            transform: scaleX(0);
            transform-origin: left;
            transition: var(--transition);
        }

        .service-ultimate-card:hover::before {
            transform: scaleX(1);
        }

        .service-ultimate-card:hover {
            transform: translateY(-15px);
            box-shadow: var(--shadow-xl);
        }

        .service-icon-ultimate {
            width: 80px;
            height: 80px;
            background: var(--gradient-primary);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 2rem;
            color: white;
            font-size: 2rem;
            transition: var(--transition);
            box-shadow: 0 8px 24px rgba(10, 36, 99, 0.2);
        }

        .service-ultimate-card:hover .service-icon-ultimate {
            transform: rotate(15deg) scale(1.1);
        }

        /* ===== ULTIMATE APPOINTMENT ===== */
        .appointment-ultimate {
            background: var(--gradient-dark);
            color: white;
            border-radius: 40px;
            padding: 5rem;
            position: relative;
            overflow: hidden;
            box-shadow: var(--shadow-xl);
        }

        .appointment-ultimate::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><circle cx="500" cy="500" r="450" fill="%23ffffff" fill-opacity="0.03"/></svg>');
        }

        .appointment-stats {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 2rem;
        }

        .appointment-stat {
            text-align: center;
            padding: 2rem;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* ===== ULTIMATE CONTACT ===== */
        .contact-ultimate-form {
            background: white;
            padding: 4rem;
            border-radius: 30px;
            box-shadow: var(--shadow-xl);
            position: relative;
            overflow: hidden;
        }

        .contact-ultimate-form::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 6px;
            background: var(--gradient-primary);
        }

        .form-group-ultimate {
            margin-bottom: 2rem;
            position: relative;
        }

        .form-label-ultimate {
            display: block;
            margin-bottom: 0.8rem;
            font-weight: 600;
            color: var(--dark);
            font-size: 1rem;
        }

        .form-control-ultimate {
            padding: 1.2rem 1.5rem;
            border: 2px solid rgba(10, 36, 99, 0.1);
            border-radius: 14px;
            font-size: 1rem;
            transition: var(--transition);
            width: 100%;
            background: white;
        }

        .form-control-ultimate:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(10, 36, 99, 0.1);
            outline: none;
        }

        /* ===== ULTIMATE FOOTER ===== */
        .footer-ultimate {
            background: var(--dark);
            color: white;
            padding: 6rem 0 3rem;
            position: relative;
        }

        .footer-ultimate::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 6px;
            background: var(--gradient-primary);
        }

        .footer-logo-ultimate {
            font-size: 2.5rem;
            font-weight: 900;
            margin-bottom: 1.5rem;
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .footer-column-ultimate h5 {
            color: white;
            font-size: 1.2rem;
            margin-bottom: 2rem;
            position: relative;
            padding-bottom: 15px;
        }

        .footer-column-ultimate h5::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 4px;
            background: var(--gradient-primary);
            border-radius: 2px;
        }

        .footer-links-ultimate {
            list-style: none;
            padding: 0;
        }

        .footer-links-ultimate li {
            margin-bottom: 1rem;
        }

        .footer-links-ultimate a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: var(--transition);
            display: flex;
            align-items: center;
        }

        .footer-links-ultimate a:hover {
            color: white;
            padding-left: 10px;
        }

        .footer-links-ultimate a i {
            margin-right: 10px;
            font-size: 0.9rem;
            width: 20px;
            text-align: center;
        }

        .social-ultimate {
            display: flex;
            gap: 15px;
            margin-top: 2rem;
        }

        .social-ultimate a {
            width: 50px;
            height: 50px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
            transition: var(--transition);
        }

        .social-ultimate a:hover {
            background: var(--gradient-primary);
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(10, 36, 99, 0.3);
        }

        .copyright-ultimate {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 3rem;
            margin-top: 5rem;
            text-align: center;
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.95rem;
        }

        /* ===== ANIMATIONS ===== */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-element {
            opacity: 0;
            transform: translateY(40px);
            transition: opacity 0.8s ease, transform 0.8s ease;
        }

        .animate-element.animated {
            opacity: 1;
            transform: translateY(0);
        }

        /* ===== RESPONSIVE DESIGN ===== */
        @media (max-width: 1200px) {
            .hero-title-ultimate {
                font-size: 4rem;
            }

            .hero-stats-ultimate {
                grid-template-columns: repeat(2, 1fr);
            }

            .section-title-ultimate {
                font-size: 3rem;
            }
        }

        @media (max-width: 768px) {
            .hero-title-ultimate {
                font-size: 3rem;
            }

            .hero-subtitle-ultimate {
                font-size: 1.2rem;
            }

            .section-ultimate {
                padding: 100px 0;
            }

            .portal-ultimate-grid,
            .services-ultimate-grid {
                grid-template-columns: 1fr;
            }

            .feature-ultimate-card,
            .portal-ultimate-card,
            .service-ultimate-card {
                padding: 3rem 2rem;
            }

            .contact-ultimate-form {
                padding: 3rem 2rem;
            }

            .appointment-ultimate {
                padding: 3rem 2rem;
            }
        }

        @media (max-width: 576px) {
            .hero-title-ultimate {
                font-size: 2.5rem;
            }

            .hero-stats-ultimate {
                grid-template-columns: 1fr;
            }

            .btn-hero-primary,
            .btn-hero-secondary {
                padding: 1rem 2rem;
                font-size: 1rem;
            }

            .hero-badge-ultimate {
                font-size: 0.85rem;
                padding: 0.7rem 1.5rem;
            }

            .nav-logo-text-premium {
                font-size: 1.6rem;
            }

            .nav-logo-icon-premium {
                width: 40px;
                height: 40px;
                font-size: 1.3rem;
            }
        }

        /* ===== UTILITY CLASSES ===== */
        .text-gradient-primary {
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .bg-gradient-primary {
            background: var(--gradient-primary);
        }

        .rounded-xxxl {
            border-radius: 40px;
        }

        .shadow-premium {
            box-shadow: var(--shadow-xl);
        }

        .glass-effect {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            box-shadow: var(--glass-shadow);
        }
    </style>
</head>

<body>
    <?php include 'inc/MainNavbar.php'; ?>

    <!-- Ultimate Hero Section -->
    <section class="hero-ultimate" style="padding-top: 150px;" id="home">
        <!-- Video Background -->
        <div class="hero-video-container">
            <video autoplay muted loop playsinline poster="assets/images/slider/slider_3.jpg">
                <source src="assets/videos/hero-bg.mp4" type="video/mp4">
                <source src="assets/videos/hero-bg.webm" type="video/webm">
                <!-- Fallback -->
                <img src="assets/images/slider/slider_3.jpg" alt="Healthcare Background">
            </video>
            <div class="hero-gradient-overlay"></div>
            <div class="hero-particles" id="particles"></div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="hero-content-ultimate">
                        <div class="hero-badge-ultimate">
                            <i class="fas fa-award me-2"></i> Excellence in Healthcare Since 2010
                        </div>

                        <h1 class="hero-title-ultimate">
                            Redefining <span>Healthcare</span> With Technology & Compassion
                        </h1>

                        <p class="hero-subtitle-ultimate">
                            Experience world-class medical care powered by cutting-edge technology,
                            delivered by compassionate professionals dedicated to your well-being.
                        </p>

                        <div class="hero-cta-ultimate">
                            <a href="#appointment" class="btn btn-hero-primary">
                                <i class="fas fa-calendar-check me-2"></i>Book Appointment Now
                            </a>
                            <a href="#contact" class="btn btn-hero-secondary">
                                <i class="fas fa-play-circle me-2"></i>View Virtual Tour
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="hero-stats-ultimate">
                <div class="stat-card-ultimate animate-element">
                    <div class="stat-icon-ultimate">
                        <i class="fas fa-user-md"></i>
                    </div>
                    <div class="stat-number-ultimate" data-count="500">0</div>
                    <div class="stat-label-ultimate">Board Certified Specialists</div>
                </div>

                <div class="stat-card-ultimate animate-element">
                    <div class="stat-icon-ultimate">
                        <i class="fas fa-ambulance"></i>
                    </div>
                    <div class="stat-number-ultimate">24/7</div>
                    <div class="stat-label-ultimate">Emergency Response</div>
                </div>

                <div class="stat-card-ultimate animate-element">
                    <div class="stat-icon-ultimate">
                        <i class="fas fa-hospital-user"></i>
                    </div>
                    <div class="stat-number-ultimate" data-count="99.7">0</div>
                    <div class="stat-label-ultimate">Patient Satisfaction Rate</div>
                </div>

                <div class="stat-card-ultimate animate-element">
                    <div class="stat-icon-ultimate">
                        <i class="fas fa-award"></i>
                    </div>
                    <div class="stat-number-ultimate" data-count="50">0</div>
                    <div class="stat-label-ultimate">Medical Specialties</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Ultimate Emergency Banner -->
    <div class="container">
        <div class="emergency-ultimate animate-element">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h3 class="mb-2"><i class="fas fa-ambulance me-2"></i>Emergency Medical Services Available 24/7</h3>
                    <p class="mb-0">Critical care when you need it most. Our emergency response team is always ready.</p>
                </div>
                <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                    <a href="tel:+1234567890" class="btn btn-light btn-premium">
                        <i class="fas fa-phone-alt me-2"></i>Emergency: +1 (234) 567-890
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Hospital Features Section -->
    <section class="section-hospital-features" id="features">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="mb-3">Our Hospital <span class="text-primary">Advantages</span></h2>
                <p class="text-muted">Quality healthcare services designed for your well-being</p>
            </div>

            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="hospital-feature-card">
                        <div class="feature-icon-hospital">
                            <i class="fas fa-user-md"></i>
                        </div>
                        <h5 class="mt-3 mb-2">Expert Medical Team</h5>
                        <p class="text-muted small">Our board-certified doctors and specialists provide personalized care with years of experience.</p>
                        <div class="feature-badge">500+ Doctors</div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="hospital-feature-card">
                        <div class="feature-icon-hospital">
                            <i class="fas fa-ambulance"></i>
                        </div>
                        <h5 class="mt-3 mb-2">24/7 Emergency Care</h5>
                        <p class="text-muted small">Round-the-clock emergency services with rapid response and critical care facilities.</p>
                        <div class="feature-badge">Emergency Ready</div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="hospital-feature-card">
                        <div class="feature-icon-hospital">
                            <i class="fas fa-procedures"></i>
                        </div>
                        <h5 class="mt-3 mb-2">Advanced Facilities</h5>
                        <p class="text-muted small">State-of-the-art operation theaters, ICU, and diagnostic centers with modern equipment.</p>
                        <div class="feature-badge">Modern Infrastructure</div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="hospital-feature-card">
                        <div class="feature-icon-hospital">
                            <i class="fas fa-stethoscope"></i>
                        </div>
                        <h5 class="mt-3 mb-2">Comprehensive Diagnostics</h5>
                        <p class="text-muted small">Advanced laboratory, imaging, and diagnostic services for accurate medical assessments.</p>
                        <div class="feature-badge">Accurate Results</div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="hospital-feature-card">
                        <div class="feature-icon-hospital">
                            <i class="fas fa-heart"></i>
                        </div>
                        <h5 class="mt-3 mb-2">Patient-Centered Care</h5>
                        <p class="text-muted small">Personalized treatment plans and compassionate care focused on individual patient needs.</p>
                        <div class="feature-badge">99% Satisfaction</div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="hospital-feature-card">
                        <div class="feature-icon-hospital">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <h5 class="mt-3 mb-2">Easy Appointment System</h5>
                        <p class="text-muted small">Quick online booking, minimal waiting time, and flexible scheduling options.</p>
                        <div class="feature-badge">Quick Access</div>
                    </div>
                </div>
            </div>

            <!-- Hospital Stats -->
            <div class="row mt-5 pt-4">
                <div class="col-12">
                    <div class="hospital-stats">
                        <div class="row text-center">
                            <div class="col-md-3 mb-4 mb-md-0">
                                <div class="stat-number">98%</div>
                                <div class="stat-label">Treatment Success Rate</div>
                            </div>
                            <div class="col-md-3 mb-4 mb-md-0">
                                <div class="stat-number">15min</div>
                                <div class="stat-label">Average Waiting Time</div>
                            </div>
                            <div class="col-md-3 mb-4 mb-md-0">
                                <div class="stat-number">500+</div>
                                <div class="stat-label">Successful Surgeries</div>
                            </div>
                            <div class="col-md-3">
                                <div class="stat-number">1000+</div>
                                <div class="stat-label">Happy Patients Monthly</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        /* Hospital Features Section */
        .section-hospital-features {
            padding: 80px 0;
            background: #f8f9fa;
        }

        .hospital-feature-card {
            background: white;
            padding: 30px 25px;
            border-radius: 12px;
            text-align: center;
            height: 100%;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            border: 1px solid transparent;
        }

        .hospital-feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
            border-color: #007bff;
        }

        .feature-icon-hospital {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #0A2463, #00B4D8);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            color: white;
            font-size: 1.8rem;
        }

        .hospital-feature-card h5 {
            color: #333;
            font-weight: 700;
        }

        .hospital-feature-card p {
            font-size: 0.95rem;
            line-height: 1.6;
            color: #666;
            margin-bottom: 20px;
        }

        .feature-badge {
            display: inline-block;
            background: rgba(10, 36, 99, 0.1);
            color: #0A2463;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        /* Hospital Stats */
        .hospital-stats {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 800;
            color: #0A2463;
            margin-bottom: 5px;
        }

        .stat-label {
            color: #666;
            font-size: 0.95rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .section-hospital-features {
                padding: 60px 0;
            }

            .hospital-feature-card {
                padding: 25px 20px;
            }

            .hospital-stats {
                padding: 30px 20px;
            }

            .stat-number {
                font-size: 2rem;
            }
        }
    </style>

    <!-- Compact Portal Section -->
    <section class="section-portal-compact" id="portal">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="mb-3">Access Portals</h2>
                <p class="text-muted mb-0">Secure role-based access to healthcare management</p>
            </div>

            <div class="row g-4">
                <!-- Patient Portal -->
                <div class="col-lg-4">
                    <div class="portal-card-compact">
                        <div class="portal-header-compact patient-portal">
                            <div class="portal-icon-compact">
                                <i class="fas fa-user-injured"></i>
                            </div>
                            <h4 class="mb-1">Patient Portal</h4>
                            <p class="small mb-0">For Patients</p>
                        </div>
                        <div class="portal-body-compact">
                            <div class="portal-features-compact">
                                <div class="feature-item">
                                    <i class="fas fa-check text-success"></i>
                                    <span>Appointment Booking</span>
                                </div>
                                <div class="feature-item">
                                    <i class="fas fa-check text-success"></i>
                                    <span>Medical Records</span>
                                </div>
                                <div class="feature-item">
                                    <i class="fas fa-check text-success"></i>
                                    <span>Video Consultations</span>
                                </div>
                            </div>
                            <a href="hms/user-login.php" class="btn btn-primary w-100 mt-3">
                                <i class="fas fa-sign-in-alt me-2"></i>Access Portal
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Doctor Portal -->
                <div class="col-lg-4">
                    <div class="portal-card-compact">
                        <div class="portal-header-compact doctor-portal">
                            <div class="portal-icon-compact">
                                <i class="fas fa-user-md"></i>
                            </div>
                            <h4 class="mb-1">Doctor Portal</h4>
                            <p class="small mb-0">For Medical Professionals</p>
                        </div>
                        <div class="portal-body-compact">
                            <div class="portal-features-compact">
                                <div class="feature-item">
                                    <i class="fas fa-check text-success"></i>
                                    <span>Health Records</span>
                                </div>
                                <div class="feature-item">
                                    <i class="fas fa-check text-success"></i>
                                    <span>Patient Management</span>
                                </div>
                                <div class="feature-item">
                                    <i class="fas fa-check text-success"></i>
                                    <span>Prescription System</span>
                                </div>
                            </div>
                            <a href="hms/doctor" class="btn btn-success w-100 mt-3">
                                <i class="fas fa-sign-in-alt me-2"></i>Access Portal
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Admin Portal -->
                <div class="col-lg-4">
                    <div class="portal-card-compact">
                        <div class="portal-header-compact admin-portal">
                            <div class="portal-icon-compact">
                                <i class="fas fa-cogs"></i>
                            </div>
                            <h4 class="mb-1">Admin Portal</h4>
                            <p class="small mb-0">For Administrators</p>
                        </div>
                        <div class="portal-body-compact">
                            <div class="portal-features-compact">
                                <div class="feature-item">
                                    <i class="fas fa-check text-success"></i>
                                    <span>Staff Management</span>
                                </div>
                                <div class="feature-item">
                                    <i class="fas fa-check text-success"></i>
                                    <span>Inventory Control</span>
                                </div>
                                <div class="feature-item">
                                    <i class="fas fa-check text-success"></i>
                                    <span>Reports & Analytics</span>
                                </div>
                            </div>
                            <a href="hms/admin" class="btn btn-purple w-100 mt-3">
                                <i class="fas fa-sign-in-alt me-2"></i>Access Portal
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        /* Compact Portal Section */
        .section-portal-compact {
            padding: 80px 0;
            background: #f8f9fa;
        }

        .portal-card-compact {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            height: 100%;
        }

        .portal-card-compact:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
        }

        .portal-header-compact {
            padding: 25px;
            text-align: center;
            color: white;
        }

        .patient-portal {
            background: linear-gradient(135deg, #4CC9F0, #00B4D8);
        }

        .doctor-portal {
            background: linear-gradient(135deg, #2E7D32, #4CAF50);
        }

        .admin-portal {
            background: linear-gradient(135deg, #7B1FA2, #9C27B0);
        }

        .portal-icon-compact {
            font-size: 2.5rem;
            margin-bottom: 15px;
        }

        .portal-header-compact h4 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .portal-body-compact {
            padding: 25px;
        }

        .portal-features-compact {
            margin-bottom: 20px;
        }

        .feature-item {
            display: flex;
            align-items: center;
            padding: 8px 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .feature-item:last-child {
            border-bottom: none;
        }

        .feature-item i {
            margin-right: 10px;
            font-size: 0.9rem;
        }

        .feature-item span {
            font-size: 0.95rem;
            color: #495057;
        }

        .btn-purple {
            background: linear-gradient(135deg, #7B1FA2, #9C27B0);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-purple:hover {
            background: linear-gradient(135deg, #6A1B9A, #8E24AA);
            color: white;
            transform: translateY(-2px);
        }
    </style>

    <!-- Ultimate Services Section -->
    <section class="section-ultimate bg-light" id="services">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="section-title-ultimate center">Advanced Medical <span class="text-gradient-primary">Specialties</span></h2>
                    <p class="section-subtitle-ultimate">Comprehensive healthcare solutions delivered by world-class specialists.</p>
                </div>
            </div>

            <div class="services-ultimate-grid mt-5">
                <?php
                $services = [
                    ['icon' => 'fas fa-heartbeat', 'title' => 'Cardiology', 'color' => '#FF6B6B'],
                    ['icon' => 'fas fa-brain', 'title' => 'Neurology', 'color' => '#4CC9F0'],
                    ['icon' => 'fas fa-bone', 'title' => 'Orthopedics', 'color' => '#2E7D32'],
                    ['icon' => 'fas fa-baby', 'title' => 'Pediatrics', 'color' => '#FF9800'],
                    ['icon' => 'fas fa-eye', 'title' => 'Ophthalmology', 'color' => '#9C27B0'],
                    ['icon' => 'fas fa-tooth', 'title' => 'Dentistry', 'color' => '#2196F3'],
                    ['icon' => 'fas fa-lungs', 'title' => 'Pulmonology', 'color' => '#00BCD4'],
                    ['icon' => 'fas fa-dna', 'title' => 'Genetics', 'color' => '#E91E63'],
                ];

                foreach ($services as $index => $service) {
                ?>
                    <div class="service-ultimate-card animate-element" style="animation-delay: <?php echo ($index * 0.1); ?>s">
                        <div class="service-icon-ultimate" style="background: linear-gradient(135deg, <?php echo $service['color']; ?>, <?php echo $service['color']; ?>80);">
                            <i class="<?php echo $service['icon']; ?>"></i>
                        </div>
                        <h4 class="mb-3"><?php echo $service['title']; ?></h4>
                        <p class="mb-4">Advanced treatment and care for comprehensive health solutions.</p>
                        <a href="#appointment" class="btn btn-outline-primary">Book Consultation</a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>

    <!-- Ultimate Appointment Section -->
    <section class="section-ultimate" id="appointment">
        <div class="container">
            <div class="appointment-ultimate animate-element">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <h2 class="mb-4">Ready to Experience Premium Healthcare?</h2>
                        <p class="mb-4">Schedule your appointment with our world-class specialists. Fast, secure, and convenient.</p>
                        <div class="d-flex flex-wrap gap-3">
                            <a href="hms/user-login.php" class="btn btn-light btn-premium">
                                <i class="fas fa-calendar-check me-2"></i>Book Online Now
                            </a>
                            <a href="tel:+1234567890" class="btn btn-outline-light">
                                <i class="fas fa-phone me-2"></i>Call for Appointment
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="appointment-stats mt-4 mt-lg-0">
                            <div class="appointment-stat">
                                <div class="stat-number-ultimate" style="font-size: 2.8rem;">15min</div>
                                <div class="stat-label-ultimate">Avg. Response Time</div>
                            </div>
                            <div class="appointment-stat">
                                <div class="stat-number-ultimate" style="font-size: 2.8rem;">4.9★</div>
                                <div class="stat-label-ultimate">Patient Rating</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Ultimate Contact Section -->
    <section class="section-ultimate" id="contact">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="section-title-ultimate center">Get In <span class="text-gradient-primary">Touch</span></h2>
                    <p class="section-subtitle-ultimate">Have questions? Our team is ready to assist you with any inquiries.</p>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-lg-8 mx-auto">
                    <div class="contact-ultimate-form animate-element">
                        <h3 class="mb-4">Send Your Message</h3>
                        <form method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group-ultimate">
                                        <label class="form-label-ultimate">Full Name *</label>
                                        <input type="text" class="form-control-ultimate" name="fullname" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group-ultimate">
                                        <label class="form-label-ultimate">Email Address *</label>
                                        <input type="email" class="form-control-ultimate" name="emailid" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group-ultimate">
                                <label class="form-label-ultimate">Mobile Number *</label>
                                <input type="tel" class="form-control-ultimate" name="mobileno" required>
                            </div>
                            <div class="form-group-ultimate">
                                <label class="form-label-ultimate">Your Message *</label>
                                <textarea class="form-control-ultimate" name="description" rows="5" required></textarea>
                            </div>
                            <button type="submit" name="submit" class="btn btn-premium w-100">
                                <i class="fas fa-paper-plane me-2"></i>Send Message
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Contact Info -->
            <div class="row mt-5">
                <?php
                $ret = mysqli_query($con, "select * from tblpage where PageType='contactus' ");
                while ($row = mysqli_fetch_array($ret)) {
                ?>
                    <div class="col-md-3 mb-4">

                    <?php } ?>
                    </div>
            </div>
    </section>

    <?php include 'inc/MainFooter.php';  ?>

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>
        // Navbar scroll effect
        $(window).scroll(function() {
            if ($(this).scrollTop() > 50) {
                $('.navbar-premium').addClass('scrolled');
            } else {
                $('.navbar-premium').removeClass('scrolled');
            }
        });

        // Smooth scrolling with active link update
        $('a[href^="#"]').on('click', function(e) {
            e.preventDefault();
            var target = this.hash;
            var $target = $(target);

            $('html, body').stop().animate({
                'scrollTop': $target.offset().top - 100
            }, 800, 'swing', function() {
                window.location.hash = target;
            });

            // Update active nav link
            $('.nav-link-premium').removeClass('active');
            $(this).addClass('active');
        });

        // Animated counters
        function animateCounter(element) {
            var $this = $(element);
            var countTo = $this.attr('data-count');
            if (countTo) {
                var count = parseFloat(countTo);
                var duration = 2000;
                var start = 0;
                var increment = count / (duration / 30);

                var current = 0;
                var timer = setInterval(function() {
                    current += increment;
                    if (current >= count) {
                        $this.text(countTo + (countTo == '99.7' ? '%' : '+'));
                        clearInterval(timer);
                    } else {
                        $this.text(Math.floor(current) + (countTo == '99.7' ? '%' : '+'));
                    }
                }, 30);
            }
        }

        // Scroll animations
        function animateOnScroll() {
            $('.animate-element').each(function() {
                var elementTop = $(this).offset().top;
                var elementBottom = elementTop + $(this).outerHeight();
                var viewportTop = $(window).scrollTop();
                var viewportBottom = viewportTop + $(window).height();

                if (elementBottom > viewportTop && elementTop < viewportBottom - 100) {
                    if (!$(this).hasClass('animated')) {
                        $(this).addClass('animated');

                        // Animate counters when in view
                        if ($(this).hasClass('stat-card-ultimate')) {
                            setTimeout(function() {
                                animateCounter($(this).find('.stat-number-ultimate'));
                            }.bind(this), 300);
                        }
                    }
                }
            });
        }

        // Create floating particles
        function createParticles() {
            var particlesContainer = $('#particles');
            if (particlesContainer.length) {
                for (var i = 0; i < 15; i++) {
                    var size = Math.random() * 100 + 50;
                    var posX = Math.random() * 100;
                    var posY = Math.random() * 100;
                    var duration = Math.random() * 20 + 10;
                    var delay = Math.random() * 10;

                    var particle = $('<div class="particle"></div>').css({
                        width: size + 'px',
                        height: size + 'px',
                        left: posX + '%',
                        top: posY + '%',
                        animationDelay: delay + 's',
                        animationDuration: duration + 's'
                    });

                    particlesContainer.append(particle);
                }
            }
        }

        // Form submission handling
        $('form').on('submit', function(e) {
            var submitBtn = $(this).find('button[type="submit"]');
            var originalText = submitBtn.html();

            submitBtn.html('<i class="fas fa-spinner fa-spin me-2"></i>Processing...');
            submitBtn.prop('disabled', true);

            // Simulate processing time
            setTimeout(function() {
                submitBtn.html(originalText);
                submitBtn.prop('disabled', false);
            }, 2000);
        });

        // Video autoplay handling
        $(document).ready(function() {
            var video = $('.hero-video-container video')[0];
            if (video) {
                var playPromise = video.play();
                if (playPromise !== undefined) {
                    playPromise.catch(function(error) {
                        console.log('Video autoplay prevented, showing fallback');
                    });
                }
            }

            // Create particles
            createParticles();

            // Initialize scroll animations
            animateOnScroll();
        });

        // Event listeners
        $(window).on('scroll', animateOnScroll);
        $(window).on('load', animateOnScroll);

        // Emergency banner animation restart
        setInterval(function() {
            $('.emergency-ultimate').css('animation', 'none');
            setTimeout(function() {
                $('.emergency-ultimate').css('animation', 'pulse-glow 2s infinite');
            }, 10);
        }, 4000);

        // Current year update
        $(document).ready(function() {
            var currentYear = new Date().getFullYear();
            $('.copyright-ultimate p:first-child').html('&copy; ' + currentYear + ' PrimeMed Healthcare Management System. All rights reserved.');
        });

        // Add hover effect to all interactive elements
        $('.btn-premium, .feature-ultimate-card, .portal-ultimate-card, .service-ultimate-card, .stat-card-ultimate')
            .on('mouseenter', function() {
                $(this).css('transition', 'all 0.3s cubic-bezier(0.4, 0, 0.2, 1)');
            })
            .on('mouseleave', function() {
                $(this).css('transition', 'var(--transition)');
            });
    </script>
</body>

</html>