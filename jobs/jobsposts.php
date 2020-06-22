<?php
    include '../config.php';
    include ROOT_PATH . '/includes/header.php';
    include '../functions.php';
?>

<title>CIY Jobs | <?php echo getJobTitle(); ?></title>
</head>
<body>
    <div id="main">
        <!-- Navigation Bar -->
        <?php include ROOT_PATH . '/includes/navbar.php'; ?>
        <!-- Content -->
        <div class="container">
            <div class="body_container">
                <section class="job_meta">
                    <div class="job_title">
                        <h2><?php echo getJobTitle(); ?></h2>
                    </div>
                    <div class="job_salary">
                        <h2><?php echo getJobSalary(). ' ' .getJobCurrency(); ?></h2>
                    </div>
                </section>
                <section class="job_ad_page">
                    <section class="section_left">
                        <div class="job_ad">
                            <p><?php echo getJobDesc(); ?></p>
                            <p class="bold">Category: <a href="<?php echo BASE_URL . 'categories/category.php?id='.getJobCatId(); ?>"><?php getJobCategory(); ?></a></p>
                            <p class="bold">Location: <a href="<?php echo BASE_URL . 'locations/location.php?id='.getLocationId(); ?>"><?php echo getJobLocation(); ?></a></p>
                            <p class="bold">Employer: <a href="<?php echo BASE_URL . 'users/user.php?id='.getJobUser(); ?>"><?php echo getTheJobUserName(); ?></a></p>
                            <p class="bold">About the employer</p>
                            <p><?php echo getJobUserHeadline(); ?></p>
                        </div>
                        <div class="job_application">
                            <h4>Apply for the job</h4>
                            <div class="form">
                                <form action="../jobs/jobsposts.php?id=<?php echo getJobId(); ?>" method="post">
                                    <textarea name="bid_text" placeholder="Describe yourself" cols="30" rows="10"></textarea><br>
                                    <?php if (isset($_SESSION['is_logged_in'])): ?>
                                        <button type="submit" name="submit_bid" class="btn">Apply</button>
                                    <?php else: ?>
                                        <a href="../login.php" class="btn">Login to apply for this job</a>
                                    <?php endif; ?>    
                                </form>
                            </div>
                        </div>
                        <div class="job_applicants">
                            <h4>Applicants</h4>
                            <ul>
                                <?php  
                                    $bids = getApplication();
                                    $i = 1;
                                    while ($row = mysqli_fetch_array($bids)):
                                ?>
                                <li class="job_applicants_list">
                                    <?php if ($row['bid_id'] && $row['user_id']): ?>
                                        <div class="job_applicant_img">
                                            <img src="../uploads/profile<?php echo $row['auid']; ?>" alt="">
                                        </div>
                                        <div class="job_applicant_info">
                                            <h4><?php echo $row['username']; ?></h4>
                                            <p><?php echo $row['application_body']; ?> <a href="../applications/application.php?bid_id=<?php echo $row['bid_id']; ?>">[More]</a></p>
                                        <?php endif; ?>    
                                        </div>
                                </li>
                                <?php
                                    $i++;
                                    endwhile;
                                ?>    
                            </ul>
                        </div>
                    </section>
                    <section class="section_right">
                        <div class="project_new">
                            <a href="<?php echo BASE_URL . 'jobs/create.php?id'; ?>">Post a Project</a>
                        </div>
                        <?php if (isset($_SESSION['is_logged_in']) && $_SESSION['u_id'] == getJobUser()): ?>
                            <div class="project_new">
                                <a href="<?php echo BASE_URL . 'jobs/create.php?edit='. getJobId(); ?>">Edit Job</a>
                            </div>
                            <div class="project_new">
                                <a onclick="confirmBox()" href="<?php echo BASE_URL . 'jobs/jobs.php?delete_job='. getJobId(); ?>">Delete Job</a>
                            </div>
                        <?php endif; ?>    
                        <div class="project_similar">
                            <h4>More jobs from this employer</h4>
                            <ul>
                                <?php  
                                   $jobs =  getAllJobs();
                                   $i = 1;
                                   while ($row = mysqli_fetch_array($jobs)):
                                ?>
                                <li>
                                    <?php if ($row['user_id'] == getJobUser()): ?>
                                        <a href="jobsposts.php?id=<?php $row['id']; ?>"><?php echo $row['job_title']; ?></a>
                                </li>
                                <?php
                                    endif;
                                    $i++;
                                    endwhile;
                                ?>
                            </ul>
                        </div>
                        <div class="project_similar">
                            <h4>Similar Jobs</h4>
                            <ul>
                                <?php  
                                    $cats = getAllJobs();
                                    $i = 1;
                                    while ($row = mysqli_fetch_array($cats)):
                                ?>
                                <li>
                                    <?php if ($row['cat_id'] === getJobCatId()): ?>
                                    <a href="<?php echo BASE_URL . '/jobs/jobsposts.php?id='.$row['id']; ?>"><?php echo $row['job_title']; ?></a>
                                </li>
                                <?php
                                    endif;
                                    $i++;
                                    endwhile;
                                ?>
                            </ul>
                        </div>
                    </section>
                </section>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <?php include ROOT_PATH . '/includes/footer.php';