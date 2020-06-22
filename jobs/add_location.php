<?php
    include '../config.php';
    include ROOT_PATH . '/includes/header.php';
    include '../functions.php';
?>

<title>CIY Jobs | Add Location</title>
</head>
<body>
    <div id="main">
        <?php include ROOT_PATH . '/includes/navbar.php'; ?>
        <div class="container">
            <div class="body_container">
            <?php if (isset($_SESSION['u_id']) && $_SESSION['u_role'] == 'Admin'): ?>
                <div class="form">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <?php if($edit_location === true): ?>
                        <input type="hidden" name="id" value="<?php echo $location_id; ?>">
                        <h2>Edit Location</h2>
                        <input type="text" name="location_name" value="<?php echo $location_name; ?>" placeholder="Location Name">
                        <button type="submit" class="btn" name="update_location">Edit Location</button>
                        <?php else: ?>
                        <h2>Add Location</h2>
                        <input type="text" name="location_name" placeholder="Location Name">
                        <button type="submit" class="btn" name="submit">Submit</button>
                        <?php endif; ?>
                    </form>
                </div>
            <?php  
                else: 
                    header('location: ../login.php?login_as_admin');
                    exit();
                endif;
            ?>    
            </div>
        </div>
    </div>
    <?php include ROOT_PATH . '/includes/footer.php';