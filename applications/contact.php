<?php
    include '../config.php';
    include ROOT_PATH . '/includes/header.php';
    include '../functions.php';
?>

<title>CIY Jobs | Contact <?php echo getApplicantName(); ?></title>
</head>
<body>
    <div id="main">
        <?php include ROOT_PATH . '/includes/navbar.php'; ?>
        <div class="container">
            <div class="body_container">
                <div class="form">
                    <form action="contact.php?id=<?php getUserId(); ?>" method="post">
                        <h2 class="header_h2">Contact <?php echo getApplicantName(); ?></h2>
                        <textarea name="message_body" id="" cols="30" rows="10"></textarea>
                        <button type="submit" name="send_message" class="btn">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php include ROOT_PATH . '/includes/footer.php';
