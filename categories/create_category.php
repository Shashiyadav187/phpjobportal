<?php 
    include '../config.php';
    include ROOT_PATH . '/includes/header.php';
    include '../functions.php';
?>

<title>CIY Jobs | Create New Category</title>
</head>
<body>
    <div id="main">
        <!-- Navigation Bar -->
        <?php include ROOT_PATH . '/includes/navbar.php'; ?>
        <!-- Content -->
        <div class="container">
            <div class="body_container">
            <?php if (isset($_SESSION['u_id']) && $_SESSION['u_role'] == 'Admin'): ?>
                <div class="form">
                    <form action="<?php echo BASE_URL . 'categories/create_category.php'; ?>" method="post">
                        <?php if ($edit_cat === true): ?>
                        <input type="hidden" name="id" value="<?php echo $cat_id; ?>">
                        <h2>Edit Category</h2>
                        <input type="text" name="cat_name" value="<?php echo $cat_name; ?>" placeholder="Category Name">
                        <button type="submit" class="btn" name="update_cat">Edit Category</button>
                        <?php else: ?>    
                        <h2>Create Category</h2>
                        <input type="text" name="cat_name" value="<?php echo $cat_name; ?>" placeholder="Category Name">
                        <button type="submit" class="btn" name="add_category">Add Category</button>
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