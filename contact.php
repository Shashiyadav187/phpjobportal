<?php
    include 'config.php';
    include ROOT_PATH . '/includes/header.php';
    include 'functions.php';
?>
<title>CIY Jobs | Contact Us</title>
</head>
<body>
    <div id="main">
        <!-- Navbar -->
        <?php include ROOT_PATH . '/includes/navbar.php'; ?>
        <!-- Content -->
        <div class="container">
            <div class="body_container">
                <section class="form">
                    <form action="contact.php" method="post">
                        <h2>Contact Us</h2>
                        <p>Don't be shy! We love to hear from you and you can easily contact us on phone, various social media or just use the below contact form below.</p>
                        <p>We will get back to you as soon as we can.</p>
                        <!-- Error message here -->
                        <input type="text" name="contact_title" placeholder="Your title" value="">
                        <input type="text" name="contact_name" placeholder="Your name" value="">
                        <input type="email" name="contact_email" placeholder="Your email" value="">
                        <textarea name="message" placeholder="Your message" cols="30" rows="10"></textarea>
                        <button type="submit" name="send_message" class="btn">Send</button>
                    </form>
                </section>
                <a href="index.php" class="btn">Home</a>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <?php include ROOT_PATH . '/includes/footer.php'; ?>
