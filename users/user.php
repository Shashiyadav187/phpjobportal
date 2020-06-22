<?php
    include '../config.php';
    include ROOT_PATH . '/includes/header.php';
    include '../functions.php';
?>

<title>CIY Jobs | <?php echo getUserName(); ?></title>
</head>
<body>
    <div id="main">
        <!-- Navigation Bar -->
        <?php include ROOT_PATH . '/includes/navbar.php'; ?>
        <!-- Content -->
        <div class="container">
            <div class="body_container">
                <section class="background_section">
                    <div class="profile_card">
                        <div class="user_img">
                            <?php if (getUserProfilePic()): ?>
                                <img src="../uploads/profile<?php echo getUserProfilePic(); ?>" alt="">
                            <?php else: ?>    
                                <img src="../static/images/no-profile-image.jpg">
                            <?php endif; ?>
                            <?php if (isset($_SESSION['is_logged_in']) && $_SESSION['u_id'] == getTheUserId()): ?>
                                <?php if (!getPictureId()): ?>
                                    <a href="picture_upload.php?id=<?php echo getTheUserId(); ?>" class="btn">Upload Picture</a>
                                <?php elseif (getPictureId()): ?>    
                                    <a href="picture_upload.php?edit_picure=<?php echo getPictureId(); ?>" class="btn">Edit Picture</a>
                                <?php endif; ?> 
                                <div class="margin"></div>   
                            <?php endif; ?>    
                            <?php if (isset($_SESSION['is_logged_in']) && $_SESSION['u_id'] != getTheUserId()): ?>
                                    <a href="<?php echo BASE_URL . 'users/contact.php?id='.getTheUserId(); ?>" class="btn">Contact</a>
                            <?php else: ?>
                                    <a href="<?php echo BASE_URL . 'users/contact.php?id='.getTheUserId(); ?>" class="btn">Contact</a>        
                            <?php endif; ?>
                            <p><span>Location: </span><?php echo getTheUserLocation(); ?></p>
                        </div>
                        <div class="user_info">
                            <h2><?php echo getUserName(); ?></h2>
                            <h4><?php echo getTheUserHeadline(); ?></h4>
                            <p><?php echo getTheUserDescription(); ?></p>
                            <?php 
                                if (isset($_SESSION['is_logged_in'])):
                                    if ($_SESSION['u_id'] == getTheUserID()): ?>
                                        <a class="edit_btn" href="<?php echo BASE_URL . 'users/edit.php?edit_user_id='.$_SESSION['u_id']; ?>">Edit</a>
                                    <?php endif;     
                                endif; 
                            ?>    
                        </div>
                    </div>
                </section>
                <section class="background_section">
                    <div class="portfolio_list">
                        <div class="portfolio_header">
                            <h2 class="header">Portfolio</h2>
                            <?php if (isset($_SESSION['is_logged_in']) && $_SESSION['u_id'] == getTheUserId()): ?>
                                <a href="<?php echo BASE_URL . 'portfolios/create_portfolio.php?'.$_SESSION['u_id']; ?>" class="edit_btn user_btn">Add Portfolio</a>
                            <?php endif; ?>    
                            <a href="<?php echo BASE_URL . 'portfolios/portfolios.php?id='.getTheUserId(); ?>" class="edit_btn user_btn">See Portfolio</a>
                        </div>
                        <ul>
                            <?php 
                                $portfolios = queryPortfolio();
                                $i = 1;
                                while ($row = mysqli_fetch_array($portfolios)):
                            ?>
                            <li>
                                <h4><?php echo $row['company_name']; ?></h4>
                                <p><?php echo $row['description']; ?></p>
                                <?php if (isset($_SESSION['is_logged_in']) && $_SESSION['u_id'] == getTheUserId()): ?>
                                    <a href="<?php echo BASE_URL . 'portfolios/create_portfolio.php?edit_portfolio='.$row['id']; ?>" class="edit_btn user_btn">Edit Portfolio</a>
                                    <a href="<?php echo BASE_URL . 'portfolios/portfolios.php?delete_portfolio='.$row['id']; ?>" class="edit_btn user_btn">Delete Portfolio</a>
                                <?php endif; ?>    
                            </li>
                            <?php
                                $i++;
                                endwhile;
                            ?>
                        </ul>
                    </div>
                </section>
                <section class="background_section">
                    <h2>Reviews</h2>
                    <?php if (isset($_SESSION['is_logged_in']) && $_SESSION['u_id'] != getTheUserId()): ?>
                        <a href="../reviews/create_review.php?id=<?php echo getTheUserId(); ?>" class="btn">Leave a Review</a>
                    <?php endif; ?>
                    <ul>
                        <?php  
                            $reviews = queryReviews();
                            $i = 1;
                            while ($row = mysqli_fetch_array($reviews)):
                        ?>
                        <li class="job_applicants_list">
                            <?php if ($row['emp_id'] == getEmp()): ?>
                                <div class="job_applicant_img">
                                    <img src="../uploads/profile<?php echo $row['user_id']; ?>" alt="">
                                </div>
                                <div class="job_applicant_info">
                                    <h4><?php echo $row['job_title']; ?></h4>
                                    <p><?php echo $row['review_body']; ?></p>
                                    <p><?php echo $row['username']; ?></p>
                                </div>
                            <?php endif; ?>    
                        </li>
                        <?php
                            $i++;
                            endwhile;
                        ?>
                    </ul>
                </section>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <?php include ROOT_PATH . '/includes/footer.php';
    