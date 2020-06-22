<nav class="navbar">
    <span class="navbar_slider">
        <a href="#" onclick="openSideMenu()">
            <i class="fas fa-bars"></i>
        </a>
    </span>
    <div class="navbar_nav">
        <div class="navbar_logo">
            <a href="<?php echo BASE_URL . 'index.php'; ?>">JobApp</a>
        </div>
        <ul class="navbar_list">
            <li>
                <a class="active" href="<?php echo BASE_URL . 'about.php'; ?>">About Us</a>
                <a href="<?php echo BASE_URL . 'jobs/jobs.php'; ?>">Jobs</a>
                <a href="<?php echo BASE_URL . 'contact.php?id='; ?>">Contact us</a>
            </li>
        </ul>
        <ul class="navbar_register">
            <?php if (isset($_SESSION['u_id']) && $_SESSION['u_role'] == 'Admin'): ?>
            <li><a href="<?php echo BASE_URL . 'admin/admin_dashboard.php'; ?>">Dashboard</a></li>
            <li><a href="<?php echo BASE_URL . 'contact/contacts.php?id='. getSessionUserId(); ?>">Messages</a></li>
            <li><form method="post" action="<?php echo BASE_URL . 'logout.php'; ?>"><button type="submit" name="logout" class="logout_btn">Logout</button></form></li>
            <?php elseif (isset($_SESSION['u_id']) && $_SESSION['u_role'] == 'User'): ?>
            <li><a href="<?php echo BASE_URL . 'users/user_dashboard.php'; ?>">Dashboard</a></li>
            <li><a href="<?php echo BASE_URL . 'contact/contacts.php?id='. getSessionUserId(); ?>">Messages</a></li>
            <li><form method="post" action="<?php echo BASE_URL . 'logout.php'; ?>"><button type="submit" name="logout" class="logout_btn">Logout</button></form></li>
            <?php elseif (empty($_SESSION['u_role'])): ?>
            <li><a href="<?php echo BASE_URL . 'register.php'; ?>">Sign Up</a></li>
            <li><a href="<?php echo BASE_URL . 'login.php'; ?>">Log In</a></li>
            <?php endif; ?>
        </ul>
    </div>
    <div class="navbar_logo_mob">
        <a href="<?php echo BASE_URL . 'index.php'; ?>">JobApp</a>
    </div>
</nav>
<div id="navbar_side_menu" class="side_nav">
    <a href="#" class="btn_close" onclick="closeSideMenu()">&times;</a>
    <ul class="navbar_list">
        <li>
            <a class="active" href="<?php echo BASE_URL . 'about.php'; ?>">About Us</a>
            <a href="<?php echo BASE_URL . 'jobs/jobs.php'; ?>">Jobs</a>
            <a href="<?php echo BASE_URL . 'contact.php?'; ?>">Contact us</a>
        </li>
    </ul>
    <ul class="navbar_register">
        <?php if (isset($_SESSION['u_id']) && $_SESSION['u_role'] == 'Admin'): ?>
        <li><a href="<?php echo BASE_URL . 'admin/admin_dashboard.php'; ?>">Dashboard</a></li>
        <li><a href="<?php echo BASE_URL . 'contact/contacts.php?id='. getSessionUserId(); ?>">Messages</a></li>
        <li><form method="post" action="<?php echo BASE_URL . 'logout.php'; ?>"><button type="submit" name="logout" class="logout_btn">Logout</button></form></li>
        <?php elseif (isset($_SESSION['u_id']) && $_SESSION['u_role'] == 'User'): ?>
        <li><a href="<?php echo BASE_URL . 'users/user_dashboard.php'; ?>">Dashboard</a></li>
        <li><a href="<?php echo BASE_URL . 'contact/contacts.php?id='. getSessionUserId(); ?>">Messages</a></li>
        <li><form method="post" action="<?php echo BASE_URL . 'logout.php'; ?>"><button type="submit" name="logout" class="logout_btn">Logout</button></form></li>
        <?php elseif (empty($_SESSION['u_role'])): ?>
        <li><a href="<?php echo BASE_URL . 'register.php'; ?>">Sign Up</a></li>
        <li><a href="<?php echo BASE_URL . 'login.php'; ?>">Log In</a></li>
        <?php endif; ?>
    </ul>
</div>