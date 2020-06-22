<?php
    include '../config.php';
    include ROOT_PATH . '/includes/header.php';
    include '../functions.php';
?>
<title>CIY Jobs | <?php echo getApplicantName(); ?>'s Application</title>
</head>
<body>
    <div id="main">
        <?php include ROOT_PATH . '/includes/navbar.php'; ?>
        <div class="container">
            <div class="body_container">
                <h2 class="header_h2">Application</h2>
                <div class="project_new">
                    <h4 class="header_h4"><a href="<?php echo BASE_URL . 'users/user.php?id='.getApplicantId(); ?>"><?php echo getApplicantName(); ?></a></h4>
                    <p class="paragraph_body"><?php echo getApplicationBody(); ?></p>
                    <?php if (isset($_SESSION['is_logged_in'])): ?>
                        <a href="../applications/contact.php?id=<?php echo getApplicantId(); ?>&bid_id=<?php echo getApplicationIdAndUser(); ?>" class="edit_btn">Contact</a><br>
                    <?php endif; ?>    
                    <a href="../jobs/jobsposts.php?id=<?php echo getApplicationJobId(); ?>" class="edit_btn">Back</a>
                </div>
                <?php if (isset($_SESSION['is_logged_in']) && $_SESSION['u_id'] == getApplicantId()): ?>
                    <div class="form">
                        <form action="application.php" method="post">
                            <h2>Edit Application</h2>
                            <?php if ($edit_bid === true): ?>
                            <input type="hidden" name="bid_id" value="<?php echo $id; ?>">
                            <textarea name="bid_text" id="" cols="30" rows="10"><?php echo $bid; ?></textarea>
                            <button type="submit" name="edit_bid" class="btn">Edit Your Bid</button>
                            <?php endif; ?>
                        </form>
                    </div>
                    <a href="application.php?delete_bid=<?php echo getApplicationIdAndUser(); ?>" class="delete_btn">Delete Application</a>
                <?php endif; ?>    
            </div>
        </div>
    </div>
    <?php include ROOT_PATH . '/includes/footer.php';