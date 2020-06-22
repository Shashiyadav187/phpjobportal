<?php
    include '../config.php';
    include ROOT_PATH . '/includes/header.php';
    include '../functions.php';
?>

<title>CIY Jobs | Freelancers</title>
</head>
<body>
    <div id="main">
        <!-- Navbar -->
        <?php include ROOT_PATH . '/includes/navbar.php'; ?>
        <!-- Content -->
        <div class="container">
            <div class="body_container">
                <div class="user_list_grid">
                    <div class="search_field background_section">
                        <h4>Search for freelancers</h4>
                        <div class="search_form">
                            <form action="search.php" method="get">
                                <input type="text" name="user" placeholder="Search freelancer or location">
                                <button type="submit" class="btn" name="search_users">Search</button>
                            </form>
                        </div>
                    </div>
                    <div class="user_list background_section">
                        <?php
                            if (isset($_SESSION['is_logged_in'])) :
                                if ($_SESSION['u_role'] == 'Admin'): ?>
                            <!-- Admin -->
                                <ul>
                                    <?php 
                                        $users = getAllUsers(); 
                                        $i = 1;
                                        while ($row = mysqli_fetch_array($users)):
                                    ?>
                                    <li class="job_applicants_list">
                                        <div class="job_applicant_img">
                                            <?php if ($row['profile_pic']): ?>
                                                <img src="../uploads/profile<?php echo $row['id']; ?>" alt="">
                                            <?php else: ?>    
                                                <img src="../static/images/no-profile-image.jpg" alt="">
                                            <?php endif; ?>    
                                        </div>
                                        <div class="job_applicant_info">
                                            <h4><a href="<?php echo BASE_URL . 'users/user.php?id='.$row['id'].'='.$row['username']; ?>"><?php echo $row['username']; ?></a></h4>
                                            <p>The user description here...</p>
                                            <?php if (isset($_SESSION['u_role']) == 'Admin'): ?>
                                            <a href="<?php echo BASE_URL . 'users/users.php?delete_user='.$row['id']; ?>" class="search_btn">Delete</a>
                                            <a href="<?php echo BASE_URL . 'admin/create_user.php?edit_user='.$row['id']; ?>" class="search_btn">Edit</a>
                                            <?php endif; ?>
                                        </div>
                                    </li>
                                    <?php 
                                        $i++;
                                        endwhile;
                                    ?>    
                                </ul>
                                <?php elseif ($_SESSION['u_role'] == 'User'): ?>
                                <!-- User -->
                                <ul>
                                    <?php 
                                        $users = getUsers(); 
                                        $i = 1;
                                        while ($row = mysqli_fetch_array($users)):
                                    ?>
                                    <li class="job_applicants_list">
                                        <div class="job_applicant_img">
                                            <?php if ($row['profile_pic']): ?>
                                                <img src="../uploads/profile<?php echo $row['id']; ?>" alt="">
                                            <?php else: ?>    
                                                <img src="../static/images/no-profile-image.jpg" alt="">
                                            <?php endif; ?>    
                                        </div>
                                        <div class="job_applicant_info">
                                            <h4><a href="<?php echo BASE_URL . 'users/user.php?id='.$row['id'].'?='.$row['username']; ?>"><?php echo $row['username']; ?></a></h4>
                                            <p><?php echo $row['user_desc']; ?></p>
                                        </div>
                                    </li>
                                    <?php 
                                        $i++;
                                        endwhile;
                                    ?>    
                                </ul>
                                <?php endif; ?>
                            <?php else: ?>
                            <ul>
                                <?php 
                                    $users = getUsers(); 
                                    $i = 1;
                                    while ($row = mysqli_fetch_array($users)):
                                ?>
                                <li class="job_applicants_list">
                                    <div class="job_applicant_img">
                                        <?php if ($row['profile_pic']): ?>
                                            <img src="../uploads/profile<?php echo $row['id']; ?>" alt="">
                                        <?php else: ?>    
                                            <img src="../static/images/no-profile-image.jpg" alt="">
                                        <?php endif; ?>    
                                    </div>
                                    <div class="job_applicant_info">
                                        <h4><a href="<?php echo BASE_URL . 'users/user.php?id='.$row['id'].'='.$row['username']; ?>"><?php echo $row['username']; ?></a></h4>
                                        <p><?php echo $row['user_desc']; ?></p>
                                    </div>
                                </li>
                                <?php 
                                    $i++;
                                    endwhile;
                                ?>    
                            </ul>
                        <?php endif; ?>    
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <?php include ROOT_PATH . '/includes/footer.php';
    