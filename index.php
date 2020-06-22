<?php
    require_once 'config.php';
    require_once ROOT_PATH . '/includes/header.php';
    include 'functions.php';
?>

<title>CIY Jobs | Welcome</title>
</head>
<body>
   <div id="main"> 
       <!-- Navbar -->
        <?php include ROOT_PATH . '/includes/navbar.php'; ?>
        <!-- Banner -->
        <?php include ROOT_PATH . '/includes/banner.php'; ?>
        <div class="container">
            <div class="body_container">
            <!-- Content -->
                <section class="section partner_icons">
                    <ul>
                        <li><h4>Used by:</h4></li>
                        <li><img src="static/images/ac_milan_logo.png" alt=""></li>
                        <li><img src="static/images/instagram_logo.jpg" alt=""></li>
                        <li><img src="static/images/seoul_logo.png" alt=""></li>
                        <li><img src="static/images/starbucks_logo.jpg" alt=""></li>
                        <li><img src="static/images/tesla_logo.jpg" alt=""></li>
                        <li><img src="static/images/volvo_logo.jpg" alt=""></li>
                    </ul>    
                </section>
                <section class="section why_us_icons">
                    <h2>Why Us</h2>
                    <div class="why_us">
                        <div class="icons">
                        <i class="fas fa-cog"></i>
                        <h4>Easy to post a job</h4>
                        </div>
                        <div class="icons">
                            <i class="far fa-lightbulb"></i>
                            <h4>Easy to apply for a job</h4>
                        </div>  
                        <div class="icons">
                            <i class="fas fa-tools"></i>
                            <h4>Easy to find the right person</h4>
                        </div>  
                        <div class="icons">
                            <i class="far fa-sticky-note"></i>
                            <h4>Easy to find the right employer</h4>
                        </div>
                    </div>
                </section> 
                <section class="section testimonials">
                    <div class="testimonial_card">
                        <img src="static/images/profile_man_glasses.jpg" alt="">
                        <h4>Name</h4>
                        <p>This service is awesome</p>
                    </div>
                    <div class="testimonial_card">
                        <img src="static/images/profile_man_beard.jpg" alt="">
                        <h4>Name</h4>
                        <p>This service is awesome</p>
                    </div>
                    <div class="testimonial_card">
                        <img src="static/images/profile_woman.jpg" alt="">
                        <h4>Name</h4>
                        <p>This service is awesome</p>
                    </div>
                </section>   
                <section class="section latest_jobs">
                    <h2>Top Jobs</h2>
                    <div>
                        <ul class="jobs_list">
                            <?php 
                                $all_jobs = latestJobs();
                                $i = 1;
                                while ($row = mysqli_fetch_array($all_jobs)):
                            ?>
                            <li class="jobs_card">
                                <a href="jobs/jobsposts.php?id=<?php echo $row['id']; ?>">
                                    <h3><?php echo $row['job_title']; ?></h3>
                                    <p><?php echo $row['job_description']; ?></p>
                                    <p class="job_post_meta">Category: <span><?php echo $row['category']; ?></span></p>
                                    <p class="job_post_meta">Location: <span><?php echo $row['location']; ?></span></p>
                                    <p class="job_post_meta">Posted: <span><?php echo $row['created_at']; ?></span></p>
                                </a>
                            </li>
                            <?php
                                $i++;
                                endwhile;
                            ?>
                        </ul>
                    </div>
                </section> 
            </div>       
        </div>
   </div> 
   <!-- Footer -->
   <?php include ROOT_PATH . '/includes/footer.php';
