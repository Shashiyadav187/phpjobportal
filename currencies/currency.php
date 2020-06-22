<?php
    include '../config.php';
    include ROOT_PATH . '/includes/header.php';
    include '../functions.php';
?>
<title>CIY Jobs | <?php getTheCurrencyName(); ?></title>
</head>
<body>
    <div id="main">
        <!-- Navbar -->
        <?php include ROOT_PATH . '/includes/navbar.php'; ?>
        <!-- Content -->
        <div class="container">
            <div class="body_container">
                <div class="section category">
                    <h2>All jobs in "<?php getTheCurrencyName(); ?>"</h2>
                    <?php if (isset($_SESSION['u_id']) && $_SESSION['u_role'] == 'Admin'): ?>
                        <a href="<?php echo BASE_URL . 'jobs/add_currency.php?edit_currency='.getTheCurrencyId(); ?>" class="btn">Edit Currency</a>
                        <a href="<?php echo BASE_URL . 'currencies/currencies.php?delete_currency='.getTheCurrencyId(); ?>" class="btn">Delete Currency</a>
                    <?php endif; ?>
                    <div class="category_list">
                        <ul>
                            <?php
                                $curr = getJobAndCur();
                                $i = 1;
                                while ($row = mysqli_fetch_array($curr)):
                            ?>
                            <li><a href="<?php echo BASE_URL . 'jobs/jobsposts.php?id='.$row['jid']; ?>"><?php echo $row['job_title']; ?>, </a></li>
                            <?php
                                $i++;
                                endwhile;
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include ROOT_PATH . '/includes/footer.php';