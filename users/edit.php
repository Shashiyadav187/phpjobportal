<?php
    include '../config.php';
    include ROOT_PATH . '/includes/header.php';
    include '../functions.php';
?>

<title>CIY Jobs | Edit <?php getSessionUserName(); ?> Profile</title>
</head>
<body>
    <div id="main">
        <!-- Navbar -->
        <?php include ROOT_PATH . '/includes/navbar.php'; ?>
        <!-- Content -->
        <div class="container">
            <div class="body_container">
            <?php 
                if (!isset($_SESSION['is_logged_in'])) :
                    header('location: ../login.php');
                elseif (isset($_SESSION['is_logged_in']) && $_SESSION['u_id'] != getEditUserId()) :
                    header('../index.php');
                elseif (isset($_SESSION['is_logged_in']) && $_SESSION['u_id'] == true) : ?>
                <section class="form background_section">
                    <form action="edit.php" method="post">
                        <?php if ($user_edit === true): ?>
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <h2>Edit Profile</h2>
                            <textarea class="user_headline" name="user_headline" placeholder="Headline" cols="30" rows="10"><?php echo $user_headline; ?></textarea>
                            <textarea name="user_desc" placeholder="Describe yourself" cols="30" rows="10"><?php echo $user_desc; ?></textarea>
                            <input type="text" name="user_location" placeholder="Your location" value="<?php echo $user_location; ?>">
                            <button onclick="location.href='<?php echo BASE_URL . 'users/user_dashboard.php?id='.$id; ?>'" type="button" class="cancel_btn">Cancel</button>
                            <button type="submit" name="add_user_info" class="btn">Save</button>
                        <?php endif; ?>
                    </form>
                </section>
            </div>
            <?php endif; ?>
        </div>
    </div>
    <!-- Footer -->
    <?php include ROOT_PATH . '/includes/footer.php';
    