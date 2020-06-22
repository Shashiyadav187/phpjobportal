<?php
    include '../config.php';
    include ROOT_PATH . '/includes/header.php';
    include '../functions.php';
?>

<title>CIY Jobs | Search result</title>
</head>
<body>
    <div id="main">
        <?php include ROOT_PATH . '/includes/navbar.php'; ?>
        <div class="container">
            <div class="body_container">
                <div class="search">
                    <div class="search_form">
                        <form action="search.php" method="get">
                            <input type="text" name="user" placeholder="Search freelancer or location">
                            <button type="submit" class="search_button" name="search_users">Search</button>
                        </form>
                    </div>
                </div>
                <h2>Search Results for: <?php echo getUserSearchName(); ?></h2>
                <div class="search_results">
                    <ul>
                        <?php echo user_search(); ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <?php include ROOT_PATH . '/includes/footer.php';
    