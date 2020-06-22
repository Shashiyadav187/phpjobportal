<?php
    include '../config.php';
    include ROOT_PATH . '/includes/header.php';
    include '../functions.php';
?>

<title>CIY Jobs | All Categories</title>
</head>
<body>
    <div id="main">
        <!-- Navigation Bar -->
        <?php include ROOT_PATH . '/includes/navbar.php'; ?>
        <!-- Content -->
        <div class="container">
            <div class="body_container">
                <div class="search">
                    <div class="search_form">
                        <form action="search.php" method="get">
                            <input type="search" name="search_category" placeholder="Search Category">
                            <button type="submit" class="search_button" name="search_cat">Search</button>
                        </form>
                    </div>
                </div>
                <section class="category">
                    <h2>Categories</h2>
                    <?php if (isset($_SESSION['u_id']) && $_SESSION['u_role'] == 'Admin'): ?>
                    <a href="create_category.php" class="btn">Create Category</a>
                    <?php endif; ?>
                    <div class="category_list">
                        <ul>
                            <?php echo getAllCategories(); ?>
                        </ul>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <?php include ROOT_PATH . '/includes/footer.php'; ?>