<?php
    include 'config.php';
    include ROOT_PATH . '/includes/header.php';
    include 'functions.php';
?>
<title>CIY Jobs | Log in</title>
</head>
<body>
    <div id="main">
        <!-- Navbar -->
        <?php include ROOT_PATH . '/includes/navbar.php'; ?>
        <!-- Content -->
        <div class="container">
            <div class="body_container">
                <section class="form">
                    <form action="login.php" method="post">
                        <h2>Log in</h2>
                        <?php loginErrors(); ?>
                        <input type="email" name="user_email" value="" placeholder="Email" autocomplete="off" required>
                        <input type="password" name="user_password" placeholder="Password" required>
                        <button type="submit" class="btn" name="login_btn">Log in</button>
                        <p>Not yet a member? <a href="register.php">Sign up</a></p>
                    </form>
                </section>
            </div>
        </div>
    </div>
    <?php include ROOT_PATH . '/includes/footer.php';
    