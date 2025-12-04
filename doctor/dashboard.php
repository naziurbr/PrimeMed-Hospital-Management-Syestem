<?php
session_start();
error_reporting(0);
include('include/config.php');
if(strlen($_SESSION['id']==0)) {
 header('location:logout.php');
  } else{

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>PrimeMed | Doctor Dashboard</title>
		
		<!-- Modern CSS Libraries -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
		<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
		
		<!-- Original CSS (keeping for compatibility) -->
		<link href="vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
		<link href="vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
		
		<!-- New Modern Dashboard CSS -->
		<style>
		/* ===== Modern Dashboard Theme ===== */
		:root {
			--primary: #0d4c92;
			--primary-light: #3a6fc8;
			--secondary: #00b4d8;
			--accent: #ff6b6b;
			--success: #2ecc71;
			--warning: #f39c12;
			--dark: #1a1a2e;
			--light: #f8f9fa;
			--gray: #6c757d;
			--card-shadow: 0 10px 30px rgba(13, 76, 146, 0.08);
			--transition: all 0.3s ease;
		}
		
		* {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}
		
		body {
			font-family: 'Poppins', sans-serif;
			background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 50%, #e2e8f0 100%);
			min-height: 100vh;
			color: var(--dark);
		}
		
		/* Modern Navigation */
		.sidebar-modern {
			background: linear-gradient(135deg, var(--dark) 0%, var(--primary) 100%);
			min-height: 100vh;
			position: fixed;
			width: 280px;
			box-shadow: 5px 0 30px rgba(0, 0, 0, 0.1);
			z-index: 1000;
		}
		
		.sidebar-brand {
			padding: 25px 20px;
			border-bottom: 1px solid rgba(255, 255, 255, 0.1);
			text-align: center;
		}
		
		.brand-logo {
			display: flex;
			align-items: center;
			justify-content: center;
			gap: 15px;
			color: white;
			text-decoration: none;
		}
		
		.brand-icon {
			width: 45px;
			height: 45px;
			background: linear-gradient(135deg, var(--secondary), var(--accent));
			border-radius: 12px;
			display: flex;
			align-items: center;
			justify-content: center;
			font-size: 1.5rem;
		}
		
		.brand-text {
			font-family: 'Montserrat', sans-serif;
			font-weight: 800;
			font-size: 1.8rem;
			line-height: 1;
		}
		
		.brand-text span:first-child {
			color: white;
		}
		
		.brand-text span:last-child {
			background: linear-gradient(135deg, var(--secondary), var(--accent));
			-webkit-background-clip: text;
			-webkit-text-fill-color: transparent;
			background-clip: text;
		}
		
		.sidebar-menu {
			padding: 30px 0;
		}
		
		.menu-item {
			padding: 15px 25px;
			color: rgba(255, 255, 255, 0.8);
			text-decoration: none;
			display: flex;
			align-items: center;
			gap: 15px;
			transition: var(--transition);
			border-left: 4px solid transparent;
			font-weight: 500;
		}
		
		.menu-item:hover, .menu-item.active {
			background: rgba(255, 255, 255, 0.1);
			color: white;
			border-left-color: var(--secondary);
		}
		
		.menu-item i {
			font-size: 1.2rem;
			width: 25px;
		}
		
		/* Main Content Area */
		.main-content-modern {
			margin-left: 280px;
			padding: 0;
			min-height: 100vh;
		}
		
		/* Modern Header */
		.header-modern {
			background: white;
			padding: 20px 30px;
			box-shadow: 0 4px 20px rgba(13, 76, 146, 0.08);
			position: sticky;
			top: 0;
			z-index: 100;
		}
		
		.header-content {
			display: flex;
			justify-content: space-between;
			align-items: center;
		}
		
		.page-title h1 {
			font-family: 'Montserrat', sans-serif;
			font-weight: 800;
			font-size: 2.2rem;
			color: var(--dark);
			margin-bottom: 5px;
		}
		
		.page-title p {
			color: var(--gray);
			font-size: 1rem;
			margin: 0;
		}
		
		.doctor-info {
			display: flex;
			align-items: center;
			gap: 20px;
		}
		
		.welcome-text {
			text-align: right;
		}
		
		.welcome-text h5 {
			font-weight: 600;
			color: var(--dark);
			margin-bottom: 5px;
		}
		
		.welcome-text p {
			color: var(--gray);
			font-size: 0.9rem;
			margin: 0;
		}
		
		.doctor-avatar {
			width: 50px;
			height: 50px;
			background: linear-gradient(135deg, var(--primary), var(--secondary));
			border-radius: 50%;
			display: flex;
			align-items: center;
			justify-content: center;
			color: white;
			font-size: 1.3rem;
			font-weight: 600;
		}
		
		/* Dashboard Content */
		.dashboard-content {
			padding: 40px 30px;
		}
		
		/* Stats Overview */
		.stats-overview {
			display: grid;
			grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
			gap: 25px;
			margin-bottom: 50px;
		}
		
		.stat-card {
			background: white;
			border-radius: 20px;
			padding: 30px;
			box-shadow: var(--card-shadow);
			transition: var(--transition);
			border: 1px solid rgba(13, 76, 146, 0.1);
			position: relative;
			overflow: hidden;
		}
		
		.stat-card:hover {
			transform: translateY(-10px);
			box-shadow: 0 20px 40px rgba(13, 76, 146, 0.15);
		}
		
		.stat-card:before {
			content: '';
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 4px;
			background: linear-gradient(90deg, var(--primary), var(--secondary));
		}
		
		.stat-header {
			display: flex;
			justify-content: space-between;
			align-items: center;
			margin-bottom: 20px;
		}
		
		.stat-icon {
			width: 60px;
			height: 60px;
			background: rgba(13, 76, 146, 0.1);
			border-radius: 15px;
			display: flex;
			align-items: center;
			justify-content: center;
			font-size: 1.8rem;
			color: var(--primary);
		}
		
		.stat-number {
			font-size: 2.5rem;
			font-weight: 800;
			color: var(--dark);
			line-height: 1;
		}
		
		.stat-label {
			font-size: 1rem;
			color: var(--gray);
			margin-top: 10px;
		}
		
		.stat-trend {
			display: flex;
			align-items: center;
			gap: 5px;
			font-size: 0.9rem;
			font-weight: 600;
			margin-top: 15px;
		}
		
		.trend-up {
			color: var(--success);
		}
		
		.trend-down {
			color: var(--accent);
		}
		
		/* Quick Actions */
		.quick-actions-title {
			font-family: 'Montserrat', sans-serif;
			font-weight: 700;
			font-size: 1.8rem;
			color: var(--dark);
			margin-bottom: 30px;
			position: relative;
			padding-bottom: 15px;
		}
		
		.quick-actions-title:after {
			content: '';
			position: absolute;
			bottom: 0;
			left: 0;
			width: 60px;
			height: 4px;
			background: linear-gradient(90deg, var(--primary), var(--secondary));
			border-radius: 2px;
		}
		
		.actions-grid {
			display: grid;
			grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
			gap: 25px;
			margin-bottom: 50px;
		}
		
		.action-card {
			background: white;
			border-radius: 20px;
			padding: 30px;
			box-shadow: var(--card-shadow);
			transition: var(--transition);
			border: 1px solid rgba(13, 76, 146, 0.1);
			text-align: center;
			position: relative;
			overflow: hidden;
		}
		
		.action-card:hover {
			transform: translateY(-10px);
			box-shadow: 0 20px 40px rgba(13, 76, 146, 0.15);
		}
		
		.action-card:hover:before {
			left: 100%;
		}
		
		.action-card:before {
			content: '';
			position: absolute;
			top: 0;
			left: -100%;
			width: 100%;
			height: 100%;
			background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
			transition: left 0.7s;
		}
		
		.action-icon {
			width: 80px;
			height: 80px;
			margin: 0 auto 25px;
			position: relative;
		}
		
		.action-icon-bg {
			width: 100%;
			height: 100%;
			background: linear-gradient(135deg, var(--primary), var(--secondary));
			border-radius: 20px;
			display: flex;
			align-items: center;
			justify-content: center;
			color: white;
			font-size: 2.2rem;
			transition: var(--transition);
		}
		
		.action-card:hover .action-icon-bg {
			transform: rotate(10deg) scale(1.1);
		}
		
		.action-icon-glow {
			position: absolute;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
			width: 90px;
			height: 90px;
			background: var(--secondary);
			border-radius: 50%;
			filter: blur(15px);
			opacity: 0.3;
			z-index: -1;
		}
		
		.action-title {
			font-size: 1.4rem;
			font-weight: 700;
			color: var(--dark);
			margin-bottom: 15px;
		}
		
		.action-description {
			color: var(--gray);
			font-size: 1rem;
			line-height: 1.6;
			margin-bottom: 25px;
		}
		
		.btn-action {
			display: inline-flex;
			align-items: center;
			justify-content: center;
			gap: 10px;
			background: linear-gradient(135deg, var(--primary), var(--secondary));
			color: white;
			padding: 12px 30px;
			border-radius: 12px;
			font-weight: 600;
			font-size: 1rem;
			text-decoration: none;
			transition: var(--transition);
			border: none;
			cursor: pointer;
			width: 100%;
		}
		
		.btn-action:hover {
			transform: translateY(-3px);
			box-shadow: 0 10px 25px rgba(13, 76, 146, 0.3);
			color: white;
		}
		
		/* Recent Activity */
		.recent-activity {
			background: white;
			border-radius: 20px;
			padding: 30px;
			box-shadow: var(--card-shadow);
			border: 1px solid rgba(13, 76, 146, 0.1);
		}
		
		.activity-title {
			font-family: 'Montserrat', sans-serif;
			font-weight: 700;
			font-size: 1.8rem;
			color: var(--dark);
			margin-bottom: 25px;
			position: relative;
			padding-bottom: 15px;
		}
		
		.activity-title:after {
			content: '';
			position: absolute;
			bottom: 0;
			left: 0;
			width: 60px;
			height: 4px;
			background: linear-gradient(90deg, var(--primary), var(--secondary));
			border-radius: 2px;
		}
		
		.activity-list {
			display: flex;
			flex-direction: column;
			gap: 20px;
		}
		
		.activity-item {
			display: flex;
			align-items: center;
			gap: 20px;
			padding: 20px;
			background: rgba(13, 76, 146, 0.03);
			border-radius: 12px;
			transition: var(--transition);
		}
		
		.activity-item:hover {
			background: rgba(13, 76, 146, 0.08);
			transform: translateX(5px);
		}
		
		.activity-icon {
			width: 50px;
			height: 50px;
			background: var(--primary);
			border-radius: 12px;
			display: flex;
			align-items: center;
			justify-content: center;
			color: white;
			font-size: 1.3rem;
			flex-shrink: 0;
		}
		
		.activity-content h5 {
			font-weight: 600;
			color: var(--dark);
			margin-bottom: 5px;
		}
		
		.activity-content p {
			color: var(--gray);
			font-size: 0.9rem;
			margin: 0;
		}
		
		.activity-time {
			margin-left: auto;
			color: var(--gray);
			font-size: 0.85rem;
			font-weight: 500;
		}
		
		/* Responsive Design */
		@media (max-width: 1200px) {
			.sidebar-modern {
				width: 250px;
			}
			
			.main-content-modern {
				margin-left: 250px;
			}
			
			.actions-grid {
				grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
			}
		}
		
		@media (max-width: 992px) {
			.sidebar-modern {
				width: 70px;
				overflow: hidden;
			}
			
			.sidebar-modern:hover {
				width: 280px;
			}
			
			.brand-text, .menu-item span {
				display: none;
			}
			
			.sidebar-modern:hover .brand-text,
			.sidebar-modern:hover .menu-item span {
				display: inline;
			}
			
			.main-content-modern {
				margin-left: 70px;
			}
			
			.sidebar-modern:hover + .main-content-modern {
				margin-left: 280px;
			}
			
			.header-content {
				flex-direction: column;
				align-items: flex-start;
				gap: 15px;
			}
			
			.doctor-info {
				width: 100%;
				justify-content: space-between;
			}
		}
		
		@media (max-width: 768px) {
			.dashboard-content {
				padding: 30px 20px;
			}
			
			.stats-overview,
			.actions-grid {
				grid-template-columns: 1fr;
			}
			
			.page-title h1 {
				font-size: 1.8rem;
			}
		}
		
		@media (max-width: 576px) {
			.sidebar-modern {
				display: none;
			}
			
			.main-content-modern {
				margin-left: 0;
			}
			
			.header-modern {
				padding: 15px 20px;
			}
			
			.dashboard-content {
				padding: 20px 15px;
			}
			
			.stat-card, .action-card, .recent-activity {
				padding: 25px 20px;
			}
		}
		
		/* Notification Badge */
		.notification-badge {
			position: absolute;
			top: 10px;
			right: 10px;
			width: 20px;
			height: 20px;
			background: var(--accent);
			color: white;
			border-radius: 50%;
			display: flex;
			align-items: center;
			justify-content: center;
			font-size: 0.7rem;
			font-weight: 700;
		}
		</style>
	</head>
	<body>
		<div class="container-fluid p-0">
			<!-- Modern Sidebar -->
			<div class="sidebar-modern">
				<!-- Brand Logo -->
				<div class="sidebar-brand">
					<a href="#" class="brand-logo">
						<div class="brand-icon">
							<i class="fas fa-heartbeat"></i>
						</div>
						<div class="brand-text">
							<span>Prime</span><span>Med</span>
						</div>
					</a>
				</div>
				
				<!-- Sidebar Menu -->
				<div class="sidebar-menu">
					<a href="#" class="menu-item active">
						<i class="fas fa-tachometer-alt"></i>
						<span>Dashboard</span>
					</a>
					<a href="edit-profile.php" class="menu-item">
						<i class="fas fa-user-md"></i>
						<span>My Profile</span>
					</a>
					<a href="appointment-history.php" class="menu-item">
						<i class="fas fa-calendar-check"></i>
						<span>Appointments</span>
						<span class="notification-badge">3</span>
					</a>
					<a href="patients.php" class="menu-item">
						<i class="fas fa-users"></i>
						<span>Patients</span>
						<span class="notification-badge">5</span>
					</a>
					<a href="prescriptions.php" class="menu-item">
						<i class="fas fa-prescription"></i>
						<span>Prescriptions</span>
					</a>
					<a href="reports.php" class="menu-item">
						<i class="fas fa-chart-line"></i>
						<span>Reports</span>
					</a>
					<a href="settings.php" class="menu-item">
						<i class="fas fa-cogs"></i>
						<span>Settings</span>
					</a>
					<a href="logout.php" class="menu-item" style="margin-top: 30px;">
						<i class="fas fa-sign-out-alt"></i>
						<span>Logout</span>
					</a>
				</div>
			</div>
			
			<!-- Main Content -->
			<div class="main-content-modern">
				<!-- Modern Header -->
				<header class="header-modern">
					<div class="header-content">
						<div class="page-title">
							<h1>Doctor Dashboard</h1>
							<p>Welcome back! Here's your medical overview</p>
						</div>
						
						<div class="doctor-info">
							<div class="welcome-text">
								<h5>Dr. <?php echo $_SESSION['doctorName'] ?? 'Doctor'; ?></h5>
								<p>Last login: Today, 10:30 AM</p>
							</div>
							<div class="doctor-avatar">
								<?php echo substr($_SESSION['doctorName'] ?? 'D', 0, 1); ?>
							</div>
						</div>
					</div>
				</header>
				
				<!-- Dashboard Content -->
				<div class="dashboard-content">
					<!-- Stats Overview -->
					<div class="stats-overview">
						<!-- Today's Appointments -->
						<div class="stat-card">
							<div class="stat-header">
								<div class="stat-icon">
									<i class="fas fa-calendar-alt"></i>
								</div>
								<div class="stat-trend trend-up">
									<i class="fas fa-arrow-up"></i>
									<span>12% from yesterday</span>
								</div>
							</div>
							<div class="stat-number">15</div>
							<div class="stat-label">Today's Appointments</div>
						</div>
						
						<!-- Pending Prescriptions -->
						<div class="stat-card">
							<div class="stat-header">
								<div class="stat-icon">
									<i class="fas fa-prescription-bottle-alt"></i>
								</div>
								<div class="stat-trend trend-up">
									<i class="fas fa-arrow-up"></i>
									<span>3 new</span>
								</div>
							</div>
							<div class="stat-number">8</div>
							<div class="stat-label">Pending Prescriptions</div>
						</div>
						
						<!-- Total Patients -->
						<div class="stat-card">
							<div class="stat-header">
								<div class="stat-icon">
									<i class="fas fa-user-injured"></i>
								</div>
								<div class="stat-trend trend-up">
									<i class="fas fa-arrow-up"></i>
									<span>5 this week</span>
								</div>
							</div>
							<div class="stat-number">245</div>
							<div class="stat-label">Total Patients</div>
						</div>
						
						<!-- Satisfaction Rate -->
						<div class="stat-card">
							<div class="stat-header">
								<div class="stat-icon">
									<i class="fas fa-star"></i>
								</div>
								<div class="stat-trend trend-up">
									<i class="fas fa-arrow-up"></i>
									<span>2% increase</span>
								</div>
							</div>
							<div class="stat-number">98%</div>
							<div class="stat-label">Patient Satisfaction</div>
						</div>
					</div>
					
					<!-- Quick Actions -->
					<h2 class="quick-actions-title">Quick Actions</h2>
					<div class="actions-grid">
						<!-- Profile Card -->
						<div class="action-card">
							<div class="action-icon">
								<div class="action-icon-bg">
									<i class="fas fa-user-md"></i>
								</div>
								<div class="action-icon-glow"></div>
							</div>
							<h3 class="action-title">My Profile</h3>
							<p class="action-description">
								Update your personal information, specialization, and contact details.
							</p>
							<a href="edit-profile.php" class="btn-action">
								<i class="fas fa-edit me-2"></i>
								Update Profile
							</a>
						</div>
						
						<!-- Appointments Card -->
						<div class="action-card">
							<div class="action-icon">
								<div class="action-icon-bg">
									<i class="fas fa-calendar-check"></i>
								</div>
								<div class="action-icon-glow"></div>
							</div>
							<h3 class="action-title">Appointments</h3>
							<p class="action-description">
								Manage your schedule, view upcoming appointments, and check history.
							</p>
							<a href="appointment-history.php" class="btn-action">
								<i class="fas fa-history me-2"></i>
								View Appointments
							</a>
						</div>
						
						<!-- New Prescription Card -->
						<div class="action-card">
							<div class="action-icon">
								<div class="action-icon-bg">
									<i class="fas fa-prescription"></i>
								</div>
								<div class="action-icon-glow"></div>
							</div>
							<h3 class="action-title">New Prescription</h3>
							<p class="action-description">
								Create new prescriptions for your patients with medication details.
							</p>
							<a href="add-prescription.php" class="btn-action">
								<i class="fas fa-plus-circle me-2"></i>
								Create Prescription
							</a>
						</div>
					</div>
					
					<!-- Recent Activity -->
					<div class="recent-activity">
						<h2 class="activity-title">Recent Activity</h2>
						<div class="activity-list">
							<div class="activity-item">
								<div class="activity-icon">
									<i class="fas fa-calendar-plus"></i>
								</div>
								<div class="activity-content">
									<h5>New Appointment Scheduled</h5>
									<p>John Doe booked an appointment for tomorrow</p>
								</div>
								<div class="activity-time">10:30 AM</div>
							</div>
							
							<div class="activity-item">
								<div class="activity-icon">
									<i class="fas fa-prescription"></i>
								</div>
								<div class="activity-content">
									<h5>Prescription Created</h5>
									<p>Prescribed medication for Sarah Johnson</p>
								</div>
								<div class="activity-time">Yesterday</div>
							</div>
							
							<div class="activity-item">
								<div class="activity-icon">
									<i class="fas fa-file-medical"></i>
								</div>
								<div class="activity-content">
									<h5>Medical Report Updated</h5>
									<p>Updated medical history for patient #245</p>
								</div>
								<div class="activity-time">2 days ago</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<!-- Modern JavaScript Libraries -->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
		
		<!-- Original JS (keeping for compatibility) -->
		<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
		<script src="assets/js/main.js"></script>
		
		<!-- Modern Dashboard JS -->
		<script>
		document.addEventListener('DOMContentLoaded', function() {
			// Initialize Perfect Scrollbar
			new PerfectScrollbar('.sidebar-menu');
			
			// Animated number counters
			const counters = document.querySelectorAll('.stat-number');
			counters.forEach(counter => {
				const target = parseInt(counter.textContent);
				let current = 0;
				const increment = target / 50;
				
				const updateCounter = () => {
					current += increment;
					if (current >= target) {
						counter.textContent = counter.textContent.includes('%') ? 
							target + '%' : target;
						return;
					}
					
					if (counter.textContent.includes('%')) {
						counter.textContent = Math.floor(current) + '%';
					} else {
						counter.textContent = Math.floor(current);
					}
					
					setTimeout(updateCounter, 30);
				};
				
				updateCounter();
			});
			
			// Card hover effects
			const cards = document.querySelectorAll('.stat-card, .action-card');
			cards.forEach(card => {
				card.addEventListener('mouseenter', function() {
					const icon = this.querySelector('.stat-icon i, .action-icon-bg i');
					if (icon) {
						icon.style.transform = 'scale(1.2)';
					}
				});
				
				card.addEventListener('mouseleave', function() {
					const icon = this.querySelector('.stat-icon i, .action-icon-bg i');
					if (icon) {
						icon.style.transform = 'scale(1)';
					}
				});
			});
			
			// Activity item click
			const activityItems = document.querySelectorAll('.activity-item');
			activityItems.forEach(item => {
				item.addEventListener('click', function() {
					activityItems.forEach(i => i.style.background = '');
					this.style.background = 'rgba(13, 76, 146, 0.1)';
				});
			});
			
			// Update current time
			function updateTime() {
				const now = new Date();
				const options = { 
					weekday: 'long', 
					year: 'numeric', 
					month: 'long', 
					day: 'numeric',
					hour: '2-digit',
					minute: '2-digit'
				};
				document.querySelector('.welcome-text p').textContent = 
					'Last updated: ' + now.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
			}
			
			// Update time every minute
			setInterval(updateTime, 60000);
			updateTime();
		});
		</script>
	</body>
</html>
<?php } ?>