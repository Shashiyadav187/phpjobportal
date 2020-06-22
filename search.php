<?php 
    include 'config.php';
    include ROOT_PATH . '/includes/header.php';
    include 'functions.php';
?>

<title>CIY Jobs | Search results</title>
</head>
<body>
    <div id="main">
        <!-- Navbar -->
        <?php include ROOT_PATH . '/includes/navbar.php'; ?>
        <!-- Content -->
        <div class="container">
            <div class="body_container">
                <div class="search">
                    <div class="search_form">
                        <form action="search.php" method="get">
                            <input type="search" name="search_job" placeholder="Search">
                            <button type="submit" class="search_button" name="search">Search</button>
                        </form>
                    </div>
                </div>
                <h2>Search Results for: <?php echo getJobSearchName(); ?></h2>
                <div class="search_results">
                    <ul>
                        <?php echo job_search(); ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <?php include ROOT_PATH . '/includes/footer.php'; 
    