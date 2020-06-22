<?php
    include '../config.php';
    include ROOT_PATH . '/includes/header.php';
    include '../functions.php';
?>
<title>CIY | <?php echo $_SESSION['u_username']; ?></title>
</head>
<body>
    <div id="main">
        <!-- Navbar -->
        <?php include ROOT_PATH . '/includes/navbar.php'; ?>
        <!-- Content -->
        <div class="container">
            <div class="body_container">
            <?php if ($_SESSION['u_id']): ?>
                <div class="admin_panel">
                    <div class="user_stats">
                        <div class="amount_users background_section">
                            <h4>Total Users</h4>
                            <p><?php echo countUsers(); ?></p>
                        </div>
                        <div class="amount_users background_section">
                            <h4>Open Jobs</h4>
                            <p><?php echo countJobs(); ?></p>
                        </div>
                        <div class="amount_users background_section">
                            <h4>Total locations</h4>
                            <p><?php echo countLocations(); ?></p>
                        </div>
                    </div>
                    <div class="location_stats">
                        <div class="top_locations background_section">
                            <h4>Top 5 locations</h4>
                            <ul>
                                <?php
                                    $loc = mostPopularLocations();
                                    $i = 1;
                                    while ($row = mysqli_fetch_array($loc)):
                                ?>
                                <li><?php echo $row['location']; ?></li>
                                <?php
                                    $i++;
                                    endwhile;
                                ?>
                            </ul>
                            <a href="../locations/locations.php" class="search_button">All locations</a>
                        </div>
                        <div class="location_create background_section">
                            <div class="form">
                                <form action="admin_dashboard.php" method="post">
                                    <input type="text" name="location_name" placeholder="Location Name">
                                    <button type="submit" name="submit" class="btn">Create Location</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <h2>Admin Actions</h2>
                    <div class="admin_actions">
                        <div class="action_users background_section">
                            <a href="../users/users.php" class="edit_btn">All Users</a>
                            <a href="../admin/create_user.php" class="edit_btn">Create User</a>
                            <div class="search_form">
                                <form action="../users/search.php" method="get">
                                    <input type="text" name="user" placeholder="Search User">
                                    <button type="submit" name="search_users" class="search_button">Search</button>
                                </form>
                            </div>
                        </div>
                        <div class="action_jobs background_section">
                            <a href="../jobs/jobs.php" class="edit_btn">All Jobs</a>
                            <a href="../jobs/create.php" class="edit_btn">Add Jobs</a>
                            <div class="search_form">
                                <form action="../search.php" method="get">
                                    <input type="text" name="search_job" placeholder="Search User">
                                    <button type="submit" name="search" class="search_button">Search</button>
                                </form>
                            </div>
                        </div>
                        <div class="action_jobs background_section">
                            <a href="../categories/index.php" class="edit_btn">All Categories</a>
                            <a href="../categories/create_category.php" class="edit_btn">Add Category</a>
                            <div class="search_form">
                                <form action="../categories/search.php" method="get">
                                    <input type="text" name="search_category" placeholder="Search Category">
                                    <button type="submit" name="search_cat" class="search_button">Search</button>
                                </form>
                            </div>
                        </div>
                        <div class="action_jobs background_section">
                            <a class="edit_btn" href="<?php echo BASE_URL . 'currencies/currencies.php'; ?>">All Currencies</a>
                            <a class="edit_btn" href="<?php echo BASE_URL . 'jobs/add_currency.php'; ?>">Add Currency</a>
                            <div class="search_form">
                                <form action="../currencies/search.php" method="get">
                                    <input type="text" name="search_curr" placeholder="Search Currency">
                                    <button type="submit" name="search_currency" class="search_button">Search</button>
                                </form>
                            </div>
                        </div>
                        <div class="action_jobs background_section">
                            <a class="edit_btn" href="<?php echo BASE_URL . 'locations/locations.php'; ?>">All Locations</a>
                            <a class="edit_btn" href="<?php echo BASE_URL . 'jobs/add_location.php'; ?>">Add Location</a>
                            <div class="search_form">
                                <form action="../locations/search.php" method="get">
                                    <input type="text" name="search_loc" placeholder="Search Location">
                                    <button type="submit" name="loc_search" class="search_button">Search</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <h2>User Details</h2>
                    <div class="user_info">
                        <h4>User Info</h4>
                        <p><?php getSessionUserEmail(); ?></p>
                        <a class="edit_btn" href="<?php echo BASE_URL . 'users/edit.php?'.getSessionUserId(); ?>">Update information</a><br>
                            <a class="edit_btn" href="<?php echo BASE_URL . 'users/user.php?id='.getSessionUserId(); ?>">View profile</a>
                    </div>
                </div>
            <?php 
                else: 
                header('location: ../login.php');
                endif;
            ?>    
            </div>
        </div>
    </div>
    <!-- Footer -->
    <?php include ROOT_PATH . '/includes/footer.php';