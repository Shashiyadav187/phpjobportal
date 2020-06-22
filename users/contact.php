<?php
    include '../config.php';
    include ROOT_PATH . '/includes/header.php';
    include '../functions.php';
?>

<title>CIY Jobs | Contact <?php echo getUserName(); ?></title>
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
                    <form action="contact.php?id=<?php echo getTheUserId(); ?>" method="post">
                        <h2 class="header_h2">Contact <?php echo getUserName(); ?></h2>
                        <textarea name="message_body" id="" cols="30" rows="10"></textarea>
                        <button type="submit" name="send_message" class="btn">Send Message</button>
                    </form>
                </div>
                <a href="../users/user.php?id=<?php echo getTheUserId(); ?>" class="btn">Back</a>    
            </div>
        </div>
    </div>
<?php include ROOT_PATH . '/includes/footer.php';
