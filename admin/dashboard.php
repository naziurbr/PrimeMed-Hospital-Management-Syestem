<?php
session_start();
error_reporting(0);
include('include/config.php');
if(strlen($_SESSION['id']) == 0) {
    header('location:logout.php');
} else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>PrimeMed | Admin Dashboard</title>
    
    <!-- Modern CSS Libraries -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.35.0/dist/apexcharts.css">
    
    <!-- Modern Dashboard CSS -->
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
    
    .admin-info {
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
    
    .admin-avatar {
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
        margin-bottom: 40px;
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
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        color: white;
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
    
    /* Charts Section */
    .charts-section {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(500px, 1fr));
        gap: 30px;
        margin-bottom: 40px;
    }
    
    .chart-card {
        background: white;
        border-radius: 20px;
        padding: 30px;
        box-shadow: var(--card-shadow);
        border: 1px solid rgba(13, 76, 146, 0.1);
    }
    
    .chart-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }
    
    .chart-title {
        font-family: 'Montserrat', sans-serif;
        font-weight: 700;
        font-size: 1.5rem;
        color: var(--dark);
    }
    
    .chart-subtitle {
        color: var(--gray);
        font-size: 0.9rem;
    }
    
    .chart-actions {
        display: flex;
        gap: 10px;
    }
    
    .chart-action-btn {
        padding: 8px 15px;
        border: 1px solid rgba(13, 76, 146, 0.2);
        border-radius: 8px;
        background: white;
        color: var(--dark);
        font-size: 0.85rem;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
    }
    
    .chart-action-btn:hover {
        background: rgba(13, 76, 146, 0.05);
        border-color: var(--primary);
    }
    
    .chart-action-btn.active {
        background: var(--primary);
        color: white;
        border-color: var(--primary);
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
        
        .charts-section {
            grid-template-columns: 1fr;
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
        
        .admin-info {
            width: 100%;
            justify-content: space-between;
        }
        
        .dashboard-content {
            padding: 30px 20px;
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
        
        .charts-section {
            grid-template-columns: 1fr;
        }
        
        .chart-card {
            padding: 20px;
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
        
        .stat-card, .action-card, .chart-card, .recent-activity {
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
                <a href="dashboard.php" class="brand-logo">
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
                <a href="dashboard.php" class="menu-item active">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
                <a href="manage-users.php" class="menu-item">
                    <i class="fas fa-users"></i>
                    <span>Manage Users</span>
                </a>
                <a href="manage-doctors.php" class="menu-item">
                    <i class="fas fa-user-md"></i>
                    <span>Manage Doctors</span>
                </a>
                <a href="appointment-history.php" class="menu-item">
                    <i class="fas fa-calendar-check"></i>
                    <span>Appointments</span>
                </a>
                <a href="manage-patient.php" class="menu-item">
                    <i class="fas fa-user-injured"></i>
                    <span>Manage Patients</span>
                </a>
                <a href="unread-queries.php" class="menu-item">
                    <i class="fas fa-question-circle"></i>
                    <span>Queries</span>
                    <?php
                    $newQueries = mysqli_query($con,"SELECT COUNT(*) as count FROM tblcontactus WHERE IsRead IS NULL");
                    $newCount = mysqli_fetch_array($newQueries)['count'];
                    if($newCount > 0): ?>
                    <span class="notification-badge"><?php echo $newCount; ?></span>
                    <?php endif; ?>
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
                        <h1>Admin Dashboard</h1>
                        <p>Welcome to PrimeMed Admin Panel - System Overview</p>
                    </div>
                    
                    <div class="admin-info">
                        <div class="welcome-text">
                            <h5>Administrator</h5>
                            <p><?php echo date('F j, Y'); ?></p>
                        </div>
                        <div class="admin-avatar">
                            <i class="fas fa-user-shield"></i>
                        </div>
                    </div>
                </div>
            </header>
            
            <!-- Dashboard Content -->
            <div class="dashboard-content">
                <!-- Stats Overview -->
                <div class="stats-overview">
                    <?php
                    // Get all stats
                    $totalUsers = mysqli_query($con,"SELECT COUNT(*) as count FROM users")->fetch_assoc()['count'];
                    $totalDoctors = mysqli_query($con,"SELECT COUNT(*) as count FROM doctors")->fetch_assoc()['count'];
                    $totalAppointments = mysqli_query($con,"SELECT COUNT(*) as count FROM appointment")->fetch_assoc()['count'];
                    $totalPatients = mysqli_query($con,"SELECT COUNT(*) as count FROM tblpatient")->fetch_assoc()['count'];
                    $totalQueries = mysqli_query($con,"SELECT COUNT(*) as count FROM tblcontactus WHERE IsRead IS NULL")->fetch_assoc()['count'];
                    ?>
                    
                    <!-- Users -->
                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-icon" style="background: linear-gradient(135deg, #3498db, #2980b9);">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="stat-trend trend-up">
                                <i class="fas fa-arrow-up"></i>
                                <span>12% growth</span>
                            </div>
                        </div>
                        <div class="stat-number"><?php echo $totalUsers; ?></div>
                        <div class="stat-label">Total Users</div>
                    </div>
                    
                    <!-- Doctors -->
                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-icon" style="background: linear-gradient(135deg, #2ecc71, #27ae60);">
                                <i class="fas fa-user-md"></i>
                            </div>
                            <div class="stat-trend trend-up">
                                <i class="fas fa-arrow-up"></i>
                                <span>8% growth</span>
                            </div>
                        </div>
                        <div class="stat-number"><?php echo $totalDoctors; ?></div>
                        <div class="stat-label">Total Doctors</div>
                    </div>
                    
                    <!-- Appointments -->
                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-icon" style="background: linear-gradient(135deg, #9b59b6, #8e44ad);">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                            <div class="stat-trend trend-up">
                                <i class="fas fa-arrow-up"></i>
                                <span>15% increase</span>
                            </div>
                        </div>
                        <div class="stat-number"><?php echo $totalAppointments; ?></div>
                        <div class="stat-label">Total Appointments</div>
                    </div>
                    
                    <!-- Patients -->
                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-icon" style="background: linear-gradient(135deg, #e74c3c, #c0392b);">
                                <i class="fas fa-user-injured"></i>
                            </div>
                            <div class="stat-trend trend-up">
                                <i class="fas fa-arrow-up"></i>
                                <span>20% growth</span>
                            </div>
                        </div>
                        <div class="stat-number"><?php echo $totalPatients; ?></div>
                        <div class="stat-label">Total Patients</div>
                    </div>
                </div>
                
                <!-- Charts Section -->
                <div class="charts-section">
                    <!-- Appointments Chart -->
                    <div class="chart-card">
                        <div class="chart-header">
                            <div>
                                <h3 class="chart-title">Appointments Overview</h3>
                                <p class="chart-subtitle">Last 7 days appointment statistics</p>
                            </div>
                            <div class="chart-actions">
                                <button class="chart-action-btn active" onclick="changeChartPeriod('week')">Week</button>
                                <button class="chart-action-btn" onclick="changeChartPeriod('month')">Month</button>
                                <button class="chart-action-btn" onclick="changeChartPeriod('year')">Year</button>
                            </div>
                        </div>
                        <div id="appointmentsChart"></div>
                    </div>
                    
                    <!-- System Status -->
                    <div class="chart-card">
                        <div class="chart-header">
                            <div>
                                <h3 class="chart-title">System Status</h3>
                                <p class="chart-subtitle">Current system metrics and performance</p>
                            </div>
                        </div>
                        <div id="systemStatusChart"></div>
                    </div>
                </div>
                
                <!-- Quick Actions -->
                <h2 class="quick-actions-title">Quick Actions</h2>
                <div class="actions-grid">
                    <!-- Manage Users -->
                    <div class="action-card">
                        <div class="action-icon">
                            <div class="action-icon-bg" style="background: linear-gradient(135deg, #3498db, #2980b9);">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="action-icon-glow" style="background: #3498db;"></div>
                        </div>
                        <h3 class="action-title">Manage Users</h3>
                        <p class="action-description">
                            View, add, edit, or remove system users and manage their permissions.
                        </p>
                        <a href="manage-users.php" class="btn-action">
                            <i class="fas fa-user-cog me-2"></i>
                            Manage Users
                        </a>
                    </div>
                    
                    <!-- Manage Doctors -->
                    <div class="action-card">
                        <div class="action-icon">
                            <div class="action-icon-bg" style="background: linear-gradient(135deg, #2ecc71, #27ae60);">
                                <i class="fas fa-user-md"></i>
                            </div>
                            <div class="action-icon-glow" style="background: #2ecc71;"></div>
                        </div>
                        <h3 class="action-title">Manage Doctors</h3>
                        <p class="action-description">
                            Add new doctors, update profiles, and manage doctor specializations.
                        </p>
                        <a href="manage-doctors.php" class="btn-action">
                            <i class="fas fa-stethoscope me-2"></i>
                            Manage Doctors
                        </a>
                    </div>
                    
                    <!-- View Appointments -->
                    <div class="action-card">
                        <div class="action-icon">
                            <div class="action-icon-bg" style="background: linear-gradient(135deg, #9b59b6, #8e44ad);">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                            <div class="action-icon-glow" style="background: #9b59b6;"></div>
                        </div>
                        <h3 class="action-title">Appointments</h3>
                        <p class="action-description">
                            View all appointments, check schedules, and manage appointment status.
                        </p>
                        <a href="appointment-history.php" class="btn-action">
                            <i class="fas fa-calendar-alt me-2"></i>
                            View Appointments
                        </a>
                    </div>
                </div>
                
                <!-- Recent Activity -->
                <div class="recent-activity">
                    <h2 class="activity-title">Recent Activity</h2>
                    <div class="activity-list">
                        <?php
                        // Get recent activities
                        $recentActivities = mysqli_query($con, "
                            (SELECT 'user_registered' as type, fullName as name, regDate as date FROM users ORDER BY regDate DESC LIMIT 1)
                            UNION ALL
                            (SELECT 'doctor_added' as type, doctorName as name, creationDate as date FROM doctors ORDER BY creationDate DESC LIMIT 1)
                            UNION ALL
                            (SELECT 'appointment_booked' as type, CONCAT('Appointment #', id) as name, postingDate as date FROM appointment ORDER BY postingDate DESC LIMIT 1)
                            UNION ALL
                            (SELECT 'query_received' as type, CONCAT('Query from ', name) as name, PostingDate as date FROM tblcontactus WHERE IsRead IS NULL ORDER BY PostingDate DESC LIMIT 1)
                            ORDER BY date DESC LIMIT 4
                        ");
                        
                        while($activity = mysqli_fetch_array($recentActivities)) {
                            $icons = [
                                'user_registered' => ['icon' => 'fas fa-user-plus', 'color' => '#3498db', 'text' => 'New User Registered'],
                                'doctor_added' => ['icon' => 'fas fa-user-md', 'color' => '#2ecc71', 'text' => 'New Doctor Added'],
                                'appointment_booked' => ['icon' => 'fas fa-calendar-plus', 'color' => '#9b59b6', 'text' => 'Appointment Booked'],
                                'query_received' => ['icon' => 'fas fa-question-circle', 'color' => '#e74c3c', 'text' => 'New Query Received']
                            ];
                            $activityData = $icons[$activity['type']];
                        ?>
                        <div class="activity-item">
                            <div class="activity-icon" style="background: <?php echo $activityData['color']; ?>;">
                                <i class="<?php echo $activityData['icon']; ?>"></i>
                            </div>
                            <div class="activity-content">
                                <h5><?php echo $activityData['text']; ?></h5>
                                <p><?php echo htmlentities($activity['name']); ?></p>
                            </div>
                            <div class="activity-time">
                                <?php echo date('h:i A', strtotime($activity['date'])); ?>
                            </div>
                        </div>
                        <?php } ?>
                        
                        <?php if(mysqli_num_rows($recentActivities) == 0): ?>
                        <div class="activity-item">
                            <div class="activity-icon" style="background: var(--gray);">
                                <i class="fas fa-info-circle"></i>
                            </div>
                            <div class="activity-content">
                                <h5>No Recent Activity</h5>
                                <p>Activity will appear here as the system is used</p>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modern JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.35.0/dist/apexcharts.min.js"></script>
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize charts
        initAppointmentsChart();
        initSystemStatusChart();
        
        // Animated number counters
        const counters = document.querySelectorAll('.stat-number');
        counters.forEach(counter => {
            const target = parseInt(counter.textContent);
            let current = 0;
            const increment = target / 50;
            
            const updateCounter = () => {
                current += increment;
                if (current >= target) {
                    counter.textContent = target;
                    return;
                }
                
                counter.textContent = Math.floor(current);
                
                setTimeout(updateCounter, 30);
            };
            
            updateCounter();
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
                now.toLocaleDateString('en-US', options);
        }
        
        // Update time every minute
        setInterval(updateTime, 60000);
        updateTime();
        
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
    });
    
    function initAppointmentsChart() {
        const options = {
            series: [{
                name: 'Appointments',
                data: [30, 40, 35, 50, 49, 60, 70]
            }],
            chart: {
                height: 350,
                type: 'area',
                toolbar: {
                    show: true
                }
            },
            colors: ['var(--primary)'],
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth',
                width: 3
            },
            xaxis: {
                categories: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun']
            },
            yaxis: {
                title: {
                    text: 'Number of Appointments'
                }
            },
            tooltip: {
                theme: 'light'
            }
        };
        
        const chart = new ApexCharts(document.querySelector("#appointmentsChart"), options);
        chart.render();
    }
    
    function initSystemStatusChart() {
        const options = {
            series: [85, 70, 90, 65],
            chart: {
                height: 350,
                type: 'radialBar',
            },
            plotOptions: {
                radialBar: {
                    dataLabels: {
                        name: {
                            fontSize: '22px',
                        },
                        value: {
                            fontSize: '16px',
                        },
                        total: {
                            show: true,
                            label: 'System Health',
                            formatter: function (w) {
                                return '85%'
                            }
                        }
                    }
                }
            },
            labels: ['Users', 'Doctors', 'Appointments', 'Patients'],
            colors: ['#3498db', '#2ecc71', '#9b59b6', '#e74c3c']
        };
        
        const chart = new ApexCharts(document.querySelector("#systemStatusChart"), options);
        chart.render();
    }
    
    function changeChartPeriod(period) {
        // Update active button
        document.querySelectorAll('.chart-action-btn').forEach(btn => {
            btn.classList.remove('active');
        });
        event.target.classList.add('active');
        
        // In a real application, you would fetch new data based on the period
        // and update the chart accordingly
        console.log('Changing chart period to:', period);
        
        // For demonstration, we'll show a notification
        const toast = document.createElement('div');
        toast.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            background: var(--primary);
            color: white;
            padding: 15px 25px;
            border-radius: 10px;
            z-index: 10000;
            animation: slideIn 0.3s ease;
        `;
        toast.innerHTML = `<i class="fas fa-sync-alt me-2"></i> Loading ${period} data...`;
        document.body.appendChild(toast);
        
        setTimeout(() => {
            toast.style.animation = 'slideOut 0.3s ease';
            setTimeout(() => toast.remove(), 300);
        }, 1500);
    }
    </script>
    
    <style>
    @keyframes slideIn {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    
    @keyframes slideOut {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(100%);
            opacity: 0;
        }
    }
    </style>
</body>
</html>
<?php } ?>