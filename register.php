<?php 
    require 'config.php';
    require ROOT_PATH . '/includes/header.php';
    include 'functions.php';
?>

<title>CIY Jobs | Register</title>
</head>
<body>
    <div id="main">
        <!-- Navbar -->
        <?php include ROOT_PATH . '/includes/navbar.php'; ?>
        <!-- Content -->
        <div class="container">
            <div class="body_container">
                <section class="form">
                
                    <form action="register.php" method="post" enctype="multipart/form-data">
                        <h2>Register on CIY Jobs</h2>
                        <?php register_error(); ?>
                        <?php
                            if (isset($_GET['username'])) {
                                $user = $_GET['username'];
                                echo '<input type="text" name="username" value="'.$user.'" placeholder="Username" autocomplete="off">';
                            }
                            else {
                                echo '<input type="text" name="username" value="'.$username.'" placeholder="Username" autocomplete="off">';
                            }
                            if (isset($_GET['email'])) {
                                $mail = $_GET['email'];
                                echo '<input type="email" name="email" value="'.$mail.'" placeholder="Email" autocomplete="off">';
                            }
                            else {
                                echo '<input type="email" name="email" value="'.$email.'" placeholder="Email" autocomplete="off">';
                            }
                        ?>
                        <input type="password" name="password_1" placeholder="Password">
                        <input type="password" name="password_2" placeholder="Password Confirmation">
                        <button type="submit" class="btn" name="reg_user">Register</button>
                        <p>Already a member? <a href="login.php">Log in</a></p>
                    </form>
                </section>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <?php include ROOT_PATH . '/includes/footer.php';
