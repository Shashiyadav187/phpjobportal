<?php
    include '../config.php';
    include ROOT_PATH . '/includes/header.php';
    include '../functions.php';
?>
<title>CIY Jobs | Leave a review</title>
</head>
<body>
    <div id="main">
        <?php include ROOT_PATH . '/includes/navbar.php'; ?>
        <div class="container">
            <div class="body_container">
                <?php 
                    if (!isset($_SESSION['is_logged_in'])) {
                        header('location: ../login.php?please_login');
                    }
                ?>
                <div class="form">
                    <form action="create_review.php?id=<?php echo getTheUserId(); ?>" method="post">
                        <h2 class="header_h2">Leave a Review</h2>
                        <input type="hidden" name="review_id">
                        <input type="text" name="job_title" placeholder="Job title">
                        <textarea name="review_body" placeholder="Leave a review" cols="30" rows="10"></textarea>
                        <button type="submit" class="btn" name="submit_review">Leave review</button>
                    </form>
                </div>
                <a href="../users/user.php?id=<?php echo getTheUserId(); ?>" class="btn">Back</a>
            </div>
        </div>
    </div>
    <?php include ROOT_PATH . '/includes/footer.php';
