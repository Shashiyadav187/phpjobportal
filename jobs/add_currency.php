<?php
    include '../config.php';
    include ROOT_PATH . '/includes/header.php';
    include '../functions.php';
?>

<title>CIY Jobs | Add Currency</title>
</head>
<body>
    <div id="main">
        <?php include ROOT_PATH . '/includes/navbar.php'; ?>
        <div class="container">
            <div class="body_container">
            <?php if (isset($_SESSION['u_id']) && $_SESSION['u_role'] == 'Admin'): ?>
                <div class="form">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <?php if($edit_currency === true): ?>
                        <input type="hidden" name="id" value="<?php echo $id_currency; ?>">
                        <h2>Edit Currency</h2>
                        <input type="text" name="currency_name" value="<?php echo $currency_name; ?>">
                        <button type="submit" class="btn" name="update_currency">Edit Currency</button>
                        <?php else: ?>
                        <h2>Add Currency</h2>
                        <input type="text" name="currency_name" value="<?php echo $currency_name; ?>" placeholder="Currency name">
                        <button type="submit" class="btn" name="add_currency">Add Currency</button>
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