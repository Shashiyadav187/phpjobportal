<?php 
    include '../config.php';
    include ROOT_PATH . '/includes/header.php';
    include '../functions.php';
?>

<title>CIY Jobs | Search Results</title>
</head>
<body>
    <div id="main">
        <?php include ROOT_PATH . '/includes/navbar.php'; ?>
        <div class="container">
            <div class="body_container">
                <div class="search">
                    <div class="search_form">
                        <form action="search.php" method="get">
                            <input type="text" name="search_loc" placeholder="Search Location">
                            <button type="submit" name="loc_search" class="search_button">Search</button>
                        </form>
                    </div>
                </div>
                <h2>Search Results For: <?php echo getLocSearchName(); ?></h2>
                <div class="category_list">
                    <ul>
                        <?php echo locSearch(); ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <?php include ROOT_PATH . '/includes/footer.php';
