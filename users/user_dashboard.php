<?php 
   include '../config.php';
   include ROOT_PATH . '/includes/header.php';
   include '../functions.php';
?>

<title>CIY Jobs | <?php getSessionUserName(); ?></title>
</head>
<body>
    <div id="main">
        <!-- Navbar -->
        <?php include ROOT_PATH . '/includes/navbar.php'; ?>
        <!-- Content -->
        <div class="container">
            <div class="body_container">
            <?php if ($_SESSION['u_id']): ?>
                <section class="user_page">
                    <div class="user_left">
                        <div class="projects_recent">
                            <h4>Recent Projects</h4>
                            <ul>
                                <li><a href="<?php echo BASE_URL . 'jobs/jobsposts.php'; ?>">Name of the job</a></li>
                                <li><a href="<?php echo BASE_URL . 'jobs/jobsposts.php'; ?>">Name of the job</a></li>
                            </ul>
                        </div>
                        <div class="jobs_section">
                            <h4>Uploaded Projects</h4>
                            <a href="<?php echo BASE_URL . 'jobs/create.php?id'; ?>" class="edit_btn">Upload Project</a>
                            <ul>
                                <?php
                                    $jobs = getJobAndUser();
                                    $i = 1;
                                    while ($row = mysqli_fetch_array($jobs)):
                                ?>
                                <li><a href="<?php echo BASE_URL . 'jobs/jobsposts.php?id='.$row['id']; ?>"><?php echo $row['job_title']; ?></a></li>
                                <?php 
                                    $i++;
                                    endwhile;
                                ?>
                            </ul>
                        </div>
                    </div>
                    <div class="user_right">
                        <div class="user_welcome">
                            <h4>Welcome Back</h4>
                            <h2><?php echo $_SESSION['u_username']; ?></h2>
                        </div>
                        <div class="user_info">
                            <h4>User Info</h4>
                            <p><?php echo $_SESSION['u_email']; ?></p>
                            <a class="edit_btn" href="<?php echo BASE_URL . 'users/edit.php?edit_user_id='.$_SESSION['u_id']; ?>">Update information</a><br><br><br>
                            <a class="edit_btn" href="<?php echo BASE_URL . 'users/user.php?id='.$_SESSION['u_id']; ?>">View profile</a>
                            <form action="../logout.php" method="post">
                                <button class="edit_btn" type="submit" name="logout">Logout</button>
                            </form>
                        </div>
                        <div class="user_jobs">
                            <h4>Current Job</h4>
                            <ul>
                                <li><a href="<?php echo BASE_URL . 'jobs/jobsposts.php'; ?>">Name of job</a></li>
                                <li><a href="<?php echo BASE_URL . 'jobs/jobsposts.php'; ?>">Name of job</a></li>
                            </ul>
                        </div>
                    </div>
                </section>
            <?php
                else: 
                     header('location: ../login.php?please_login') ;
                     exit();
                endif;     
            ?>    
            </div>
        </div>
    </div>
    <!-- Footer -->
    <?php include ROOT_PATH . '/includes/footer.php';
    