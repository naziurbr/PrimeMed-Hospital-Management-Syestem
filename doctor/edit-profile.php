<?php
session_start();
error_reporting(0);
include('include/config.php');
if(strlen($_SESSION['id']) == 0) {
    header('location:logout.php');
} else {
    if(isset($_POST['submit'])) {
        $docspecialization = $_POST['Doctorspecialization'];
        $docname = $_POST['docname'];
        $docaddress = $_POST['clinicaddress'];
        $docfees = $_POST['docfees'];
        $doccontactno = $_POST['doccontact'];
        
        $sql = mysqli_query($con, "UPDATE doctors SET specilization='$docspecialization', doctorName='$docname', address='$docaddress', docFees='$docfees', contactno='$doccontactno', updationDate=NOW() WHERE id='".$_SESSION['id']."'");
        
        if($sql) {
            echo "<script>alert('Doctor Details updated Successfully');</script>";
            $_SESSION['doctorName'] = $docname; // Update session name
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>PrimeMed | Edit Profile</title>
    
    <!-- Modern CSS Libraries -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
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
    
    /* Edit Profile Content */
    .profile-content {
        padding: 40px 30px;
    }
    
    /* Profile Header */
    .profile-header {
        background: white;
        border-radius: 20px;
        padding: 40px;
        box-shadow: var(--card-shadow);
        margin-bottom: 40px;
        border: 1px solid rgba(13, 76, 146, 0.1);
        position: relative;
        overflow: hidden;
    }
    
    .profile-header:before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, var(--primary), var(--secondary));
    }
    
    .profile-header h2 {
        font-family: 'Montserrat', sans-serif;
        font-weight: 800;
        font-size: 2rem;
        color: var(--dark);
        margin-bottom: 20px;
    }
    
    .profile-info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-top: 30px;
    }
    
    .profile-info-item {
        padding: 15px;
        background: rgba(13, 76, 146, 0.03);
        border-radius: 10px;
        border-left: 3px solid var(--primary);
    }
    
    .profile-info-label {
        font-size: 0.85rem;
        color: var(--gray);
        text-transform: uppercase;
        font-weight: 600;
        margin-bottom: 5px;
    }
    
    .profile-info-value {
        font-size: 1.1rem;
        color: var(--dark);
        font-weight: 500;
    }
    
    /* Form Styling */
    .form-modern {
        background: white;
        border-radius: 20px;
        padding: 40px;
        box-shadow: var(--card-shadow);
        border: 1px solid rgba(13, 76, 146, 0.1);
    }
    
    .form-section-title {
        font-family: 'Montserrat', sans-serif;
        font-weight: 700;
        font-size: 1.5rem;
        color: var(--dark);
        margin-bottom: 30px;
        padding-bottom: 15px;
        position: relative;
    }
    
    .form-section-title:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 50px;
        height: 3px;
        background: linear-gradient(90deg, var(--primary), var(--secondary));
        border-radius: 2px;
    }
    
    .form-group-modern {
        margin-bottom: 30px;
    }
    
    .form-label {
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 10px;
        display: block;
        font-size: 1rem;
    }
    
    .form-control-modern {
        width: 100%;
        padding: 12px 20px;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        font-size: 1rem;
        font-family: 'Poppins', sans-serif;
        transition: var(--transition);
        background: white;
    }
    
    .form-control-modern:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(13, 76, 146, 0.1);
    }
    
    .form-control-modern:read-only {
        background: #f8f9fa;
        border-color: #e2e8f0;
        color: var(--gray);
        cursor: not-allowed;
    }
    
    .form-control-modern:read-only:focus {
        border-color: #e2e8f0;
        box-shadow: none;
    }
    
    textarea.form-control-modern {
        min-height: 120px;
        resize: vertical;
    }
    
    .select-modern {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%230d4c92' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 20px center;
        background-size: 16px;
        padding-right: 50px;
    }
    
    /* Buttons */
    .btn-primary-modern {
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        color: white;
        border: none;
        padding: 14px 35px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        gap: 10px;
    }
    
    .btn-primary-modern:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(13, 76, 146, 0.3);
        color: white;
    }
    
    .btn-primary-modern:active {
        transform: translateY(-1px);
    }
    
    /* Success Message */
    .success-message {
        background: linear-gradient(135deg, #d4edda, #c3e6cb);
        border: 1px solid #c3e6cb;
        color: #155724;
        padding: 20px;
        border-radius: 12px;
        margin-bottom: 30px;
        display: flex;
        align-items: center;
        gap: 15px;
    }
    
    .success-message i {
        font-size: 1.5rem;
        color: var(--success);
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
        
        .profile-content {
            padding: 30px 20px;
        }
        
        .profile-header,
        .form-modern {
            padding: 30px;
        }
    }
    
    @media (max-width: 768px) {
        .profile-header h2 {
            font-size: 1.7rem;
        }
        
        .profile-info-grid {
            grid-template-columns: 1fr;
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
        
        .profile-content {
            padding: 20px 15px;
        }
        
        .profile-header,
        .form-modern {
            padding: 25px 20px;
        }
        
        .btn-primary-modern {
            width: 100%;
            justify-content: center;
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
                <a href="dashboard.php" class="menu-item">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
                <a href="edit-profile.php" class="menu-item active">
                    <i class="fas fa-user-md"></i>
                    <span>My Profile</span>
                </a>
                <a href="appointment-history.php" class="menu-item">
                    <i class="fas fa-calendar-check"></i>
                    <span>Appointments</span>
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
                        <h1>Edit Profile</h1>
                        <p>Update your professional information and contact details</p>
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
            
            <!-- Profile Content -->
            <div class="profile-content">
                <?php 
                $did = $_SESSION['dlogin'];
                $sql = mysqli_query($con, "SELECT * FROM doctors WHERE docEmail='$did'");
                while($data = mysqli_fetch_array($sql)) {
                ?>
                
                <!-- Profile Header -->
                <div class="profile-header">
                    <h2>Doctor Profile</h2>
                    <div class="profile-info-grid">
                        <div class="profile-info-item">
                            <div class="profile-info-label">Registration Date</div>
                            <div class="profile-info-value"><?php echo date('M d, Y', strtotime($data['creationDate'])); ?></div>
                        </div>
                        <?php if($data['updationDate']) { ?>
                        <div class="profile-info-item">
                            <div class="profile-info-label">Last Updated</div>
                            <div class="profile-info-value"><?php echo date('M d, Y', strtotime($data['updationDate'])); ?></div>
                        </div>
                        <?php } ?>
                        <div class="profile-info-item">
                            <div class="profile-info-label">Account Status</div>
                            <div class="profile-info-value" style="color: var(--success);">
                                <i class="fas fa-check-circle me-2"></i>Active
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Edit Form -->
                <div class="form-modern">
                    <h3 class="form-section-title">Edit Professional Information</h3>
                    
                    <form role="form" name="adddoc" method="post" onSubmit="return valid();">
                        <!-- Specialization -->
                        <div class="form-group-modern">
                            <label class="form-label" for="Doctorspecialization">
                                <i class="fas fa-stethoscope me-2"></i>Medical Specialization
                            </label>
                            <select name="Doctorspecialization" class="form-control-modern select-modern" required>
                                <option value="<?php echo htmlentities($data['specilization']); ?>">
                                    <?php echo htmlentities($data['specilization']); ?>
                                </option>
                                <?php 
                                $ret = mysqli_query($con, "SELECT * FROM doctorspecilization");
                                while($row = mysqli_fetch_array($ret)) {
                                    if($row['specilization'] != $data['specilization']) {
                                ?>
                                <option value="<?php echo htmlentities($row['specilization']); ?>">
                                    <?php echo htmlentities($row['specilization']); ?>
                                </option>
                                <?php 
                                    }
                                } 
                                ?>
                            </select>
                        </div>

                        <!-- Doctor Name -->
                        <div class="form-group-modern">
                            <label class="form-label" for="docname">
                                <i class="fas fa-user-md me-2"></i>Full Name
                            </label>
                            <input type="text" name="docname" class="form-control-modern" 
                                   value="<?php echo htmlentities($data['doctorName']); ?>" required>
                        </div>

                        <!-- Clinic Address -->
                        <div class="form-group-modern">
                            <label class="form-label" for="clinicaddress">
                                <i class="fas fa-map-marker-alt me-2"></i>Clinic Address
                            </label>
                            <textarea name="clinicaddress" class="form-control-modern" rows="3"><?php echo htmlentities($data['address']); ?></textarea>
                        </div>

                        <!-- Consultancy Fees -->
                        <div class="form-group-modern">
                            <label class="form-label" for="docfees">
                                <i class="fas fa-money-bill-wave me-2"></i>Consultation Fee
                            </label>
                            <div class="input-group">
                                <span class="input-group-text" style="border: 2px solid #e2e8f0; border-right: none; border-radius: 12px 0 0 12px; background: #f8f9fa;">$</span>
                                <input type="number" name="docfees" class="form-control-modern" 
                                       style="border-left: none; border-radius: 0 12px 12px 0;" 
                                       value="<?php echo htmlentities($data['docFees']); ?>" required min="0" step="0.01">
                            </div>
                        </div>

                        <!-- Contact Number -->
                        <div class="form-group-modern">
                            <label class="form-label" for="doccontact">
                                <i class="fas fa-phone me-2"></i>Contact Number
                            </label>
                            <input type="tel" name="doccontact" class="form-control-modern" 
                                   value="<?php echo htmlentities($data['contactno']); ?>" required 
                                   pattern="[0-9]{10,15}" placeholder="10-15 digit phone number">
                        </div>

                        <!-- Email (Read-only) -->
                        <div class="form-group-modern">
                            <label class="form-label" for="docemail">
                                <i class="fas fa-envelope me-2"></i>Email Address
                            </label>
                            <input type="email" name="docemail" class="form-control-modern" readonly
                                   value="<?php echo htmlentities($data['docEmail']); ?>">
                            <small class="text-muted mt-2 d-block">
                                <i class="fas fa-info-circle me-1"></i> Email cannot be changed
                            </small>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-flex justify-content-between align-items-center mt-5">
                            <a href="dashboard.php" class="text-decoration-none" style="color: var(--gray);">
                                <i class="fas fa-arrow-left me-2"></i>Back to Dashboard
                            </a>
                            <button type="submit" name="submit" class="btn-primary-modern">
                                <i class="fas fa-save me-2"></i>
                                Update Profile
                            </button>
                        </div>
                    </form>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
    
    <!-- Modern JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    
    <!-- Form Validation -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Form validation
        function valid() {
            const phone = document.forms["adddoc"]["doccontact"].value;
            const fees = document.forms["adddoc"]["docfees"].value;
            
            // Phone validation
            const phoneRegex = /^[0-9]{10,15}$/;
            if (!phoneRegex.test(phone)) {
                alert("Please enter a valid phone number (10-15 digits)");
                return false;
            }
            
            // Fees validation
            if (fees <= 0) {
                alert("Consultation fee must be greater than 0");
                return false;
            }
            
            return true;
        }
        
        // Add validation event listener
        const form = document.forms["adddoc"];
        if (form) {
            form.onsubmit = valid;
        }
        
        // Real-time phone number formatting
        const phoneInput = document.querySelector('input[name="doccontact"]');
        if (phoneInput) {
            phoneInput.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, '');
                if (value.length > 15) {
                    value = value.substring(0, 15);
                }
                e.target.value = value;
            });
        }
        
        // Real-time fees validation
        const feesInput = document.querySelector('input[name="docfees"]');
        if (feesInput) {
            feesInput.addEventListener('blur', function(e) {
                if (e.target.value <= 0) {
                    e.target.style.borderColor = 'var(--accent)';
                    e.target.style.boxShadow = '0 0 0 3px rgba(255, 107, 107, 0.1)';
                } else {
                    e.target.style.borderColor = '#e2e8f0';
                    e.target.style.boxShadow = 'none';
                }
            });
        }
        
        // Animate form elements on focus
        const formControls = document.querySelectorAll('.form-control-modern');
        formControls.forEach(control => {
            control.addEventListener('focus', function() {
                this.parentElement.style.transform = 'translateY(-2px)';
            });
            
            control.addEventListener('blur', function() {
                this.parentElement.style.transform = 'translateY(0)';
            });
        });
        
        // Update last update time
        function updateTime() {
            const now = new Date();
            document.querySelector('.welcome-text p').textContent = 
                now.toLocaleDateString('en-US', { 
                    weekday: 'long', 
                    year: 'numeric', 
                    month: 'long', 
                    day: 'numeric' 
                });
        }
        
        updateTime();
    });
    </script>
</body>
</html>
<?php } ?>