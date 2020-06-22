<?php
    include '../config.php';
    include ROOT_PATH . '/includes/header.php';
    include '../functions.php';
?>

<title>CIY Jobs | Latest Jobs</title>
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
                    <form action="../search.php" method="get">
                        <input type="search" name="search_job" placeholder="Search">
                        <button type="submit" class="search_button" name="search">Search</button>
                    </form>
                </div>
            </div>
            <section class="latest_jobs">
                <ul>
                    <?php echo listAllJobs(); ?>
                </ul>
            </section>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <?php include ROOT_PATH . '/includes/footer.php'; ?>