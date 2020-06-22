<?php
    include '../config.php';
    include ROOT_PATH . '/includes/header.php';
    include '../functions.php';
?>

<title>CIY Jobs | All Locations</title>
</head>
<body>
    <div id="main">
        <?php include ROOT_PATH . '/includes/navbar.php'; ?>
        <div class="container">
            <div class="body_container">
                <div class="search">
                    <div class="search_form">
                        <form action="../search.php" method="get">
                            <input type="search" name="search_job" placeholder="Search">
                            <button type="submit" class="search_button" name="search">Search</button>
                        </form>
                    </div>
                </div>
                <section class="category">
                    <h2>Locations</h2>
                    <?php if (isset($_SESSION['u_id']) && $_SESSION['u_role'] == 'Admin'): ?>
                        <a href="<?php echo BASE_URL . 'jobs/add_location.php'; ?>" class="btn">Add Location</a>
                    <?php endif; ?>
                    <div class="category_list">
                        <ul>
                            <?php getAllLocation(); ?>
                        </ul>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <?php include ROOT_PATH . '/includes/footer.php';