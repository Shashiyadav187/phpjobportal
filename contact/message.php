<?php
    include '../config.php';
    include ROOT_PATH . '/includes/header.php';
    include '../functions.php';
?>
<title>CIY Jobs | Thread</title>
</head>
    <div id="main">
        <?php include ROOT_PATH . '/includes/navbar.php'; ?>
        <div class="container">
            <div class="body_container">
                <?php
                    if (!isset($_SESSION['is_logged_in'])) {
                        header('location: ../login.php?please_login');
                    }
                ?>
                <ul>
                    <?php
                        $messages = getThread();
                        $i = 1;
                        while ($row = mysqli_fetch_array($messages)):
                    ?>
                    <li class="message_bubble">
                        <p class="message_body"><?php echo $row['message_body']; ?></p>
                        <p><?php echo $row['username']; ?></p>
                        <p class="small"><?php echo $row['created_at']; ?></p>
                    </li>
                    <?php
                        $i++;
                        endwhile;
                    ?>
                </ul>
                <div class="form">
                    <form action="message.php?thread_id=<?php getThreadId(); ?>&receiver_id=<?php getReceiverId(); ?>" method="post">
                        <textarea name="reply" id="" cols="30" rows="10"></textarea>
                        <input type="hidden" name="thread_id" value="<?php getThreadId(); ?>">
                        <input type="hidden" name="receiver_id" value="<?php getReceiverId(); ?>">
                        <button type="submit" name="reply_message" class="btn">Reply</button>
                    </form>
                </div>
                <a href="<?php echo BASE_URL . 'contact/contacts.php?id='.getSessionUserId(); ?>" class="cancel_btn">Back</a>
            </div>
        </div>
    </div>
    <?php include ROOT_PATH . '/includes/footer.php'; ?>