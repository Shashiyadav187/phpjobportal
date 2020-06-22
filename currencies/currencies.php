<?php
    include '../config.php';
    include ROOT_PATH . '/includes/header.php';
    include '../functions.php';
?>

<title>CIY Jobs | All Currencies</title>
</head>
<body>
    <div id="main">
        <?php include ROOT_PATH . '/includes/navbar.php'; ?>
        <div class="container">
            <div class="body_container">
                <div class="search">
                    <div class="search_form">
                        <input type="search" name="search_item" placeholder="Search">
                        <button type="submit" class="search_button" name="search_button">Search</button>
                    </div>
                </div>
                <section class="category">
                    <h2>Currencies</h2>
                    <?php if (isset($_SESSION['u_id']) && $_SESSION['u_role'] == 'Admin'): ?>
                        <a class="btn" href="<?php echo BASE_URL . 'jobs/add_currency.php'; ?>">Add Currency</a>
                    <?php endif; ?>
                    <div class="category_list">
                        <ul>
                            <?php getAllCurrencies(); ?>
                        </ul>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <?php include ROOT_PATH . '/includes/footer.php';