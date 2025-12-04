<?php
session_start();
error_reporting(0);
include('include/config.php');
if(strlen($_SESSION['id']) == 0) {
    header('location:logout.php');
} else {
    if(isset($_GET['cancel'])) {
        mysqli_query($con, "UPDATE appointment SET doctorStatus='0' WHERE id='".$_GET['id']."'");
        $_SESSION['msg'] = "Appointment canceled successfully!";
        header('location:appointment-history.php');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>PrimeMed | Appointment History</title>
    
    <!-- Modern CSS Libraries -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    
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
    
    /* Appointments Content */
    .appointments-content {
        padding: 40px 30px;
    }
    
    /* Stats Cards */
    .appointments-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }
    
    .stat-card-small {
        background: white;
        border-radius: 15px;
        padding: 20px;
        box-shadow: var(--card-shadow);
        display: flex;
        align-items: center;
        gap: 15px;
        transition: var(--transition);
        border: 1px solid rgba(13, 76, 146, 0.1);
    }
    
    .stat-card-small:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(13, 76, 146, 0.15);
    }
    
    .stat-icon-small {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.3rem;
    }
    
    .stat-info-small h4 {
        font-size: 1.8rem;
        font-weight: 800;
        color: var(--dark);
        line-height: 1;
        margin-bottom: 5px;
    }
    
    .stat-info-small p {
        font-size: 0.9rem;
        color: var(--gray);
        margin: 0;
    }
    
    /* Filters Section */
    .filters-section {
        background: white;
        border-radius: 15px;
        padding: 25px;
        box-shadow: var(--card-shadow);
        margin-bottom: 30px;
        border: 1px solid rgba(13, 76, 146, 0.1);
    }
    
    .filters-title {
        font-family: 'Montserrat', sans-serif;
        font-weight: 700;
        font-size: 1.2rem;
        color: var(--dark);
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .filters-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
    }
    
    .filter-group {
        margin-bottom: 0;
    }
    
    .filter-label {
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 8px;
        font-size: 0.9rem;
    }
    
    .filter-select {
        width: 100%;
        padding: 10px 15px;
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        font-size: 0.95rem;
        font-family: 'Poppins', sans-serif;
        background: white;
        transition: var(--transition);
    }
    
    .filter-select:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(13, 76, 146, 0.1);
    }
    
    .btn-filter {
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        color: white;
        border: none;
        padding: 10px 25px;
        border-radius: 10px;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        display: flex;
        align-items: center;
        gap: 8px;
        height: fit-content;
        align-self: flex-end;
    }
    
    .btn-filter:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(13, 76, 146, 0.2);
    }
    
    /* Appointments Table */
    .appointments-table-container {
        background: white;
        border-radius: 15px;
        padding: 30px;
        box-shadow: var(--card-shadow);
        border: 1px solid rgba(13, 76, 146, 0.1);
        overflow: hidden;
    }
    
    .table-title {
        font-family: 'Montserrat', sans-serif;
        font-weight: 700;
        font-size: 1.5rem;
        color: var(--dark);
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 15px;
    }
    
    .table-title:after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 0;
        width: 60px;
        height: 3px;
        background: linear-gradient(90deg, var(--primary), var(--secondary));
        border-radius: 2px;
    }
    
    .table-modern {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        border-radius: 10px;
        overflow: hidden;
    }
    
    .table-modern thead {
        background: linear-gradient(135deg, var(--primary), var(--primary-light));
    }
    
    .table-modern thead th {
        color: white;
        font-weight: 600;
        padding: 15px;
        border: none;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
    }
    
    .table-modern tbody tr {
        transition: var(--transition);
        border-bottom: 1px solid rgba(13, 76, 146, 0.1);
    }
    
    .table-modern tbody tr:hover {
        background: rgba(13, 76, 146, 0.03);
        transform: translateX(5px);
    }
    
    .table-modern tbody td {
        padding: 15px;
        border: none;
        vertical-align: middle;
    }
    
    /* Status Badges */
    .status-badge {
        padding: 6px 15px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .status-active {
        background: rgba(46, 204, 113, 0.1);
        color: var(--success);
        border: 1px solid rgba(46, 204, 113, 0.3);
    }
    
    .status-canceled-patient {
        background: rgba(243, 156, 18, 0.1);
        color: var(--warning);
        border: 1px solid rgba(243, 156, 18, 0.3);
    }
    
    .status-canceled-doctor {
        background: rgba(255, 107, 107, 0.1);
        color: var(--accent);
        border: 1px solid rgba(255, 107, 107, 0.3);
    }
    
    .status-upcoming {
        background: rgba(0, 180, 216, 0.1);
        color: var(--secondary);
        border: 1px solid rgba(0, 180, 216, 0.3);
    }
    
    /* Action Buttons */
    .btn-action-sm {
        padding: 6px 15px;
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 600;
        text-decoration: none;
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        gap: 5px;
        border: none;
        cursor: pointer;
    }
    
    .btn-view {
        background: rgba(13, 76, 146, 0.1);
        color: var(--primary);
    }
    
    .btn-view:hover {
        background: rgba(13, 76, 146, 0.2);
        color: var(--primary);
    }
    
    .btn-cancel {
        background: rgba(255, 107, 107, 0.1);
        color: var(--accent);
    }
    
    .btn-cancel:hover {
        background: rgba(255, 107, 107, 0.2);
        color: var(--accent);
    }
    
    .btn-approve {
        background: rgba(46, 204, 113, 0.1);
        color: var(--success);
    }
    
    .btn-approve:hover {
        background: rgba(46, 204, 113, 0.2);
        color: var(--success);
    }
    
    .btn-disabled {
        background: rgba(108, 117, 125, 0.1);
        color: var(--gray);
        cursor: not-allowed;
        opacity: 0.7;
    }
    
    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
    }
    
    .empty-icon {
        font-size: 4rem;
        color: rgba(13, 76, 146, 0.2);
        margin-bottom: 20px;
    }
    
    .empty-title {
        font-family: 'Montserrat', sans-serif;
        font-weight: 700;
        font-size: 1.5rem;
        color: var(--dark);
        margin-bottom: 10px;
    }
    
    .empty-text {
        color: var(--gray);
        margin-bottom: 30px;
        max-width: 400px;
        margin-left: auto;
        margin-right: auto;
    }
    
    /* Responsive Design */
    @media (max-width: 1200px) {
        .sidebar-modern {
            width: 250px;
        }
        
        .main-content-modern {
            margin-left: 250px;
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
        
        .appointments-content {
            padding: 30px 20px;
        }
        
        .table-modern thead {
            display: none;
        }
        
        .table-modern tbody tr {
            display: block;
            margin-bottom: 15px;
            border: 1px solid rgba(13, 76, 146, 0.1);
            border-radius: 10px;
            padding: 15px;
        }
        
        .table-modern tbody td {
            display: block;
            text-align: right;
            padding: 10px 0;
            position: relative;
            border-bottom: 1px solid rgba(13, 76, 146, 0.05);
        }
        
        .table-modern tbody td:before {
            content: attr(data-label);
            position: absolute;
            left: 0;
            width: 50%;
            padding-right: 15px;
            text-align: left;
            font-weight: 600;
            color: var(--dark);
        }
        
        .table-modern tbody td:last-child {
            border-bottom: none;
        }
    }
    
    @media (max-width: 768px) {
        .appointments-stats {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .filters-grid {
            grid-template-columns: 1fr;
        }
        
        .table-title {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
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
        
        .appointments-content {
            padding: 20px 15px;
        }
        
        .appointments-stats {
            grid-template-columns: 1fr;
        }
        
        .appointments-table-container {
            padding: 20px 15px;
        }
        
        .btn-action-sm {
            width: 100%;
            justify-content: center;
            margin-bottom: 5px;
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
    
    /* Success Message */
    .success-message {
        background: linear-gradient(135deg, #d4edda, #c3e6cb);
        border: 1px solid #c3e6cb;
        color: #155724;
        padding: 15px 20px;
        border-radius: 10px;
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        animation: slideIn 0.5s ease;
    }
    
    .success-message-content {
        display: flex;
        align-items: center;
        gap: 15px;
    }
    
    .success-message i {
        font-size: 1.3rem;
        color: var(--success);
    }
    
    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
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
                <a href="dashboard.php" class="menu-item">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
                <a href="edit-profile.php" class="menu-item">
                    <i class="fas fa-user-md"></i>
                    <span>My Profile</span>
                </a>
                <a href="appointment-history.php" class="menu-item active">
                    <i class="fas fa-calendar-check"></i>
                    <span>Appointments</span>
                    <?php
                    $newAppointments = mysqli_query($con, "SELECT COUNT(*) as count FROM appointment WHERE doctorId='".$_SESSION['id']."' AND doctorStatus='1' AND userStatus='1'");
                    $newCount = mysqli_fetch_array($newAppointments)['count'];
                    if($newCount > 0): ?>
                    <span class="notification-badge"><?php echo $newCount; ?></span>
                    <?php endif; ?>
                </a>
                <a href="patients.php" class="menu-item">
                    <i class="fas fa-users"></i>
                    <span>Patients</span>
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
                        <h1>Appointment History</h1>
                        <p>Manage and track all your medical appointments</p>
                    </div>
                    
                    <div class="doctor-info">
                        <div class="welcome-text">
                            <h5>Dr. <?php echo $_SESSION['doctorName'] ?? 'Doctor'; ?></h5>
                            <p><?php echo date('F j, Y'); ?></p>
                        </div>
                        <div class="doctor-avatar">
                            <?php echo substr($_SESSION['doctorName'] ?? 'D', 0, 1); ?>
                        </div>
                    </div>
                </div>
            </header>
            
            <!-- Appointments Content -->
            <div class="appointments-content">
                <!-- Success Message -->
                <?php if(isset($_SESSION['msg']) && !empty($_SESSION['msg'])): ?>
                <div class="success-message">
                    <div class="success-message-content">
                        <i class="fas fa-check-circle"></i>
                        <span><?php echo htmlentities($_SESSION['msg']); ?></span>
                    </div>
                    <button type="button" class="btn-close" onclick="this.parentElement.style.display='none'"></button>
                </div>
                <?php $_SESSION['msg'] = ""; endif; ?>
                
                <!-- Stats Overview -->
                <div class="appointments-stats">
                    <?php
                    $doctorId = $_SESSION['id'];
                    $today = date('Y-m-d');
                    
                    // Total Appointments
                    $totalQuery = mysqli_query($con, "SELECT COUNT(*) as count FROM appointment WHERE doctorId='$doctorId'");
                    $totalCount = mysqli_fetch_array($totalQuery)['count'];
                    
                    // Today's Appointments
                    $todayQuery = mysqli_query($con, "SELECT COUNT(*) as count FROM appointment WHERE doctorId='$doctorId' AND appointmentDate='$today'");
                    $todayCount = mysqli_fetch_array($todayQuery)['count'];
                    
                    // Upcoming Appointments
                    $upcomingQuery = mysqli_query($con, "SELECT COUNT(*) as count FROM appointment WHERE doctorId='$doctorId' AND appointmentDate >= '$today' AND doctorStatus='1' AND userStatus='1'");
                    $upcomingCount = mysqli_fetch_array($upcomingQuery)['count'];
                    
                    // Cancelled Appointments
                    $cancelledQuery = mysqli_query($con, "SELECT COUNT(*) as count FROM appointment WHERE doctorId='$doctorId' AND (doctorStatus='0' OR userStatus='0')");
                    $cancelledCount = mysqli_fetch_array($cancelledQuery)['count'];
                    ?>
                    
                    <div class="stat-card-small">
                        <div class="stat-icon-small" style="background: linear-gradient(135deg, var(--primary), var(--secondary));">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <div class="stat-info-small">
                            <h4><?php echo $totalCount; ?></h4>
                            <p>Total Appointments</p>
                        </div>
                    </div>
                    
                    <div class="stat-card-small">
                        <div class="stat-icon-small" style="background: linear-gradient(135deg, var(--success), #27ae60);">
                            <i class="fas fa-calendar-day"></i>
                        </div>
                        <div class="stat-info-small">
                            <h4><?php echo $todayCount; ?></h4>
                            <p>Today's Appointments</p>
                        </div>
                    </div>
                    
                    <div class="stat-card-small">
                        <div class="stat-icon-small" style="background: linear-gradient(135deg, var(--secondary), #0096c7);">
                            <i class="fas fa-calendar-plus"></i>
                        </div>
                        <div class="stat-info-small">
                            <h4><?php echo $upcomingCount; ?></h4>
                            <p>Upcoming</p>
                        </div>
                    </div>
                    
                    <div class="stat-card-small">
                        <div class="stat-icon-small" style="background: linear-gradient(135deg, var(--accent), #ff4757);">
                            <i class="fas fa-calendar-times"></i>
                        </div>
                        <div class="stat-info-small">
                            <h4><?php echo $cancelledCount; ?></h4>
                            <p>Cancelled</p>
                        </div>
                    </div>
                </div>
                
                <!-- Filters -->
                <div class="filters-section">
                    <h3 class="filters-title">
                        <i class="fas fa-filter"></i> Filter Appointments
                    </h3>
                    <div class="filters-grid">
                        <div class="filter-group">
                            <label class="filter-label">Status</label>
                            <select class="filter-select" id="statusFilter">
                                <option value="all">All Status</option>
                                <option value="active">Active</option>
                                <option value="upcoming">Upcoming</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                        </div>
                        
                        <div class="filter-group">
                            <label class="filter-label">Date Range</label>
                            <select class="filter-select" id="dateFilter">
                                <option value="all">All Dates</option>
                                <option value="today">Today</option>
                                <option value="week">This Week</option>
                                <option value="month">This Month</option>
                            </select>
                        </div>
                        
                        <div class="filter-group">
                            <label class="filter-label">Sort By</label>
                            <select class="filter-select" id="sortFilter">
                                <option value="date_desc">Date (Newest First)</option>
                                <option value="date_asc">Date (Oldest First)</option>
                                <option value="patient">Patient Name</option>
                            </select>
                        </div>
                        
                        <button class="btn-filter" onclick="applyFilters()">
                            <i class="fas fa-sync-alt"></i> Apply Filters
                        </button>
                    </div>
                </div>
                
                <!-- Appointments Table -->
                <div class="appointments-table-container">
                    <h3 class="table-title">Appointment List</h3>
                    
                    <?php
                    $sql = mysqli_query($con, "SELECT users.fullName as fname, appointment.* FROM appointment 
                            JOIN users ON users.id = appointment.userId 
                            WHERE appointment.doctorId = '".$_SESSION['id']."' 
                            ORDER BY appointment.appointmentDate DESC, appointment.appointmentTime DESC");
                    $cnt = 1;
                    $totalRows = mysqli_num_rows($sql);
                    ?>
                    
                    <?php if($totalRows > 0): ?>
                    <div class="table-responsive">
                        <table class="table-modern" id="appointmentsTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Patient Name</th>
                                    <th>Specialization</th>
                                    <th>Fee</th>
                                    <th>Date & Time</th>
                                    <th>Booked On</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($row = mysqli_fetch_array($sql)): ?>
                                <?php
                                $statusClass = '';
                                $statusText = '';
                                $isActive = false;
                                
                                if(($row['userStatus'] == 1) && ($row['doctorStatus'] == 1)) {
                                    $statusClass = 'status-active';
                                    $statusText = 'Active';
                                    $isActive = true;
                                } elseif(($row['userStatus'] == 0) && ($row['doctorStatus'] == 1)) {
                                    $statusClass = 'status-canceled-patient';
                                    $statusText = 'Canceled by Patient';
                                } elseif(($row['userStatus'] == 1) && ($row['doctorStatus'] == 0)) {
                                    $statusClass = 'status-canceled-doctor';
                                    $statusText = 'Canceled by You';
                                }
                                
                                // Check if upcoming
                                $appointmentDate = strtotime($row['appointmentDate']);
                                $today = strtotime(date('Y-m-d'));
                                if($isActive && $appointmentDate > $today) {
                                    $statusClass = 'status-upcoming';
                                    $statusText = 'Upcoming';
                                }
                                ?>
                                
                                <tr>
                                    <td data-label="#"><?php echo $cnt; ?></td>
                                    <td data-label="Patient Name">
                                        <div style="font-weight: 600; color: var(--dark);"><?php echo htmlentities($row['fname']); ?></div>
                                    </td>
                                    <td data-label="Specialization"><?php echo htmlentities($row['doctorSpecialization']); ?></td>
                                    <td data-label="Fee">
                                        <span style="font-weight: 600; color: var(--primary);">$<?php echo htmlentities($row['consultancyFees']); ?></span>
                                    </td>
                                    <td data-label="Date & Time">
                                        <div style="font-weight: 600; color: var(--dark);">
                                            <?php echo date('M d, Y', strtotime($row['appointmentDate'])); ?>
                                        </div>
                                        <div style="font-size: 0.9rem; color: var(--gray);">
                                            <i class="far fa-clock me-1"></i> <?php echo date('h:i A', strtotime($row['appointmentTime'])); ?>
                                        </div>
                                    </td>
                                    <td data-label="Booked On"><?php echo date('M d, Y', strtotime($row['postingDate'])); ?></td>
                                    <td data-label="Status">
                                        <span class="status-badge <?php echo $statusClass; ?>">
                                            <?php echo $statusText; ?>
                                        </span>
                                    </td>
                                    <td data-label="Actions">
                                        <div class="d-flex gap-2 flex-wrap">
                                            <?php if($isActive): ?>
                                            <a href="appointment-history.php?id=<?php echo $row['id']; ?>&cancel=update" 
                                               onclick="return confirmCancel('<?php echo htmlentities($row['fname']); ?>', '<?php echo date('M d, Y', strtotime($row['appointmentDate'])); ?>')"
                                               class="btn-action-sm btn-cancel">
                                                <i class="fas fa-times"></i> Cancel
                                            </a>
                                            <?php else: ?>
                                            <span class="btn-action-sm btn-disabled">
                                                <i class="fas fa-ban"></i> Canceled
                                            </span>
                                            <?php endif; ?>
                                            
                                            <a href="view-appointment.php?id=<?php echo $row['id']; ?>" 
                                               class="btn-action-sm btn-view">
                                                <i class="fas fa-eye"></i> View
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php $cnt++; endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php else: ?>
                    <div class="empty-state">
                        <div class="empty-icon">
                            <i class="far fa-calendar-times"></i>
                        </div>
                        <h3 class="empty-title">No Appointments Found</h3>
                        <p class="empty-text">You don't have any appointments scheduled yet. New appointments will appear here.</p>
                        <a href="dashboard.php" class="btn-filter">
                            <i class="fas fa-tachometer-alt me-2"></i> Go to Dashboard
                        </a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modern JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize DataTable
        $('#appointmentsTable').DataTable({
            "pageLength": 10,
            "order": [[4, 'desc']],
            "language": {
                "search": "Search appointments:",
                "lengthMenu": "Show _MENU_ appointments",
                "info": "Showing _START_ to _END_ of _TOTAL_ appointments",
                "paginate": {
                    "previous": "<i class='fas fa-chevron-left'></i>",
                    "next": "<i class='fas fa-chevron-right'></i>"
                }
            }
        });
        
        // Auto-hide success message after 5 seconds
        const successMsg = document.querySelector('.success-message');
        if (successMsg) {
            setTimeout(() => {
                successMsg.style.opacity = '0';
                setTimeout(() => {
                    successMsg.style.display = 'none';
                }, 300);
            }, 5000);
        }
        
        // Update time
        function updateTime() {
            const now = new Date();
            const options = { 
                weekday: 'long', 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric' 
            };
            document.querySelector('.welcome-text p').textContent = 
                now.toLocaleDateString('en-US', options);
        }
        
        updateTime();
        setInterval(updateTime, 60000); // Update every minute
    });
    
    function confirmCancel(patientName, appointmentDate) {
        return confirm(`Are you sure you want to cancel the appointment with ${patientName} scheduled for ${appointmentDate}?`);
    }
    
    function applyFilters() {
        const statusFilter = document.getElementById('statusFilter').value;
        const dateFilter = document.getElementById('dateFilter').value;
        const sortFilter = document.getElementById('sortFilter').value;
        
        // Show loading state
        const table = $('#appointmentsTable').DataTable();
        table.search('').draw(); // Reset search
        
        // Filter by status
        if (statusFilter !== 'all') {
            table.column(6).search(statusFilter).draw();
        }
        
        // You would typically make an AJAX call here to fetch filtered data
        // For now, we'll just show a message
        alert('Filter functionality would fetch data from server in a real implementation.');
        
        // In a real implementation, you would:
        // 1. Collect filter values
        // 2. Send AJAX request to PHP backend
        // 3. Update table with filtered data
    }
    
    // Add row highlighting on hover
    $(document).ready(function() {
        $('#appointmentsTable tbody').on('mouseenter', 'tr', function() {
            $(this).css('transform', 'translateX(5px)');
        }).on('mouseleave', 'tr', function() {
            $(this).css('transform', 'translateX(0)');
        });
        
        // Add click effect to action buttons
        $('.btn-action-sm').on('click', function() {
            $(this).css('transform', 'scale(0.95)');
            setTimeout(() => {
                $(this).css('transform', 'scale(1)');
            }, 150);
        });
    });
    </script>
</body>
</html>
<?php } ?>