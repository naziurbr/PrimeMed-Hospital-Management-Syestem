<?php
$navItems = [
    'home'        => 'Home',
    'features'    => 'Features',
    'services'    => 'Services',
    'portal'      => 'Portals',
    'appointment' => 'Appointment',
    'contact'     => 'Contact',
];
?>

<!-- ===== NAVBAR ===== -->
<nav id="primeMedNavbar" class="navbar navbar-expand-lg navbar-premium fixed-top bg-white shadow-sm">
    <div class="container">

        <a class="nav-brand-premium d-flex align-items-center text-decoration-none" href="#home">
            <i class="fas fa-heartbeat fs-4 me-2"></i>
            <span class="fw-bold">PrimeMed</span>
        </a>

        <button class="navbar-toggler" type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarUltimate">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarUltimate">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <?php foreach ($navItems as $id => $label): ?>
                    <li class="nav-item">
                        <a class="nav-link nav-link-premium"
                            href="#<?= $id ?>">
                            <?= $label ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>

            <a href="hms/user-login.php" class="btn btn-premium ms-lg-3">
                <i class="fas fa-user-circle me-2"></i>Patient Login
            </a>
        </div>

    </div>
</nav>

<!-- ===== AUTO ACTIVE SCRIPT (INCLUDE SAFE) ===== -->
<script>
    (function() {

        function initNavbarActive() {
            const nav = document.getElementById('primeMedNavbar');
            if (!nav) return;

            const links = nav.querySelectorAll('.nav-link-premium');
            if (!links.length) return;

            const navbarHeight = nav.offsetHeight + 20;

            function setActiveLink() {
                let currentId = '';

                links.forEach(link => {
                    const target = document.querySelector(link.getAttribute('href'));
                    if (!target) return;

                    if (window.scrollY >= target.offsetTop - navbarHeight) {
                        currentId = target.id;
                    }
                });

                links.forEach(link => {
                    link.classList.toggle(
                        'active',
                        link.getAttribute('href') === '#' + currentId
                    );
                });
            }

            // Run on load + scroll
            window.addEventListener('scroll', setActiveLink);
            window.addEventListener('load', setActiveLink);
            setTimeout(setActiveLink, 300); // include / async safe

            // Close mobile menu on click
            links.forEach(link => {
                link.addEventListener('click', () => {
                    const menu = nav.querySelector('.navbar-collapse');
                    if (menu && menu.classList.contains('show')) {
                        bootstrap.Collapse.getOrCreateInstance(menu).hide();
                    }
                });
            });
        }

        // DOM-safe init
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initNavbarActive);
        } else {
            initNavbarActive();
        }

    })();
</script>