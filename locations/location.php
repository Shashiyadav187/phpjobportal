<?php 
    include '../config.php';
    include ROOT_PATH . '/includes/header.php';
    include '../functions.php';
?>

<title>CIY Jobs | <?php getTheLocationName(); ?></title>
</head>
<body>
    <div id="main">
        <?php include ROOT_PATH . '/includes/navbar.php'; ?>
        <div class="container">
            <div class="body_container">
                <div class="search">
                    <div class="search_form">
                        <form action="search.php" method="get">
                            <input type="search" name="search_loc" placeholder="Search Location">
                            <button type="submit" class="search_button" name="loc_search">Search</button>
                        </form>
                    </div>
                </div>
                <div class="section category">
                    <h2>All jobs in "<?php getTheLocationName(); ?>"</h2>
                    <?php if (isset($_SESSION['u_id']) && $_SESSION['u_role'] == 'Admin'): ?>
                        <a href="<?php echo BASE_URL . 'jobs/add_location.php?edit_location='.getTheLocationId(); ?>" class="btn">Edit Location</a>
                        <a href="<?php echo BASE_URL . 'locations/locations.php?delete_location='.getTheLocationId(); ?>" class="btn">Delete Location</a>
                    <?php endif; ?>
                    <div class="category_list">
                        <ul>
                            <?php
                                $locations = getJobAndLoc();
                                $i = 1;
                                while ($row = mysqli_fetch_array($locations)):
                            ?>
                            <li>
                                <a href="<?php echo BASE_URL . 'jobs/jobsposts.php?id='.$row['id']; ?>"><?php echo $row['job_title']; ?>, </a>
                            </li>
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