<?php
    include '../config.php';
    include ROOT_PATH . '/includes/header.php';
    include '../functions.php';
?>
<title>CIY Jobs | Conversations</title>
</head>
<body>
    <div id="main">
        <?php include ROOT_PATH . '/includes/navbar.php'; ?>
        <div class="container">
            <div class="body_container">
                <section class="category">
                    <h2 class="header_h2">Your Messages</h2>
                    <?php if (getSessionUserId()): ?>
                        <ul>
                            <?php  
                                $messages = getThreads();
                                $i = 1;
                                while ($row = mysqli_fetch_array($messages)):
                                    $reciever = $row['reciever_id'];
                                    $thread_id = $row['id_thread'];
                                    $user_info = "SELECT *, messages.created_at AS mtime FROM users INNER JOIN threads ON users.id = threads.reciever_id INNER JOIN messages ON threads.id_thread = messages.thread_id WHERE id = '$reciever' AND id_thread = '$thread_id' ORDER BY mtime DESC"; 
                                    $user_query = mysqli_query($conn, $user_info);
                                    $user_name = mysqli_fetch_array($user_query);
                                    $name = $user_name['username'];
                                    $rec_mess = $user_name['message_body'];
                                    $rec_time = $user_name['mtime'];

                                    $sender = $row['person_id'];
                                    $user_info_sender = "SELECT *, messages.created_at AS mtime FROM users INNER JOIN threads ON users.id = threads.person_id INNER JOIN messages ON threads.id_thread = messages.thread_id WHERE id = '$sender' ORDER BY mtime DESC"; 
                                    $u_query = mysqli_query($conn, $user_info_sender);
                                    $u_name = mysqli_fetch_array($u_query);
                                    $uname = $u_name['username'];
                                    $send_mess = $u_name['message_body'];
                                    $timestamp = $u_name['mtime'];
                            ?>
                            <li>
                                <a href="<?php echo BASE_URL . '/contact/message.php?thread_id='.$row['thread_id'].'&receiver='.$row['receiver_id']; ?>"  class="message_card">
                                    <div class="message_img">
                                        <?php if ($_SESSION['u_id'] == $row['person_id']):  ?>
                                            <img src="../uploads/profile<?php echo $row['reciever_id']; ?>" alt="">
                                            <?php elseif ($_SESSION['u_id'] == $row['reciever_id']): ?>
                                                <img src="../uploads/profile<?php echo $row['person_id']; ?>" alt=""> 
                                            <?php endif; ?>    
                                    </div>
                                    <div class="message_overview">
                                        <?php if ($_SESSION['u_id'] == $row['person_id']): ?>
                                            <h2><?php echo $name; ?></h2>
                                            <p><?php echo $rec_mess; ?></p>
                                            <p class="small timestamp"><?php echo $rec_time; ?></p>
                                        <?php elseif ($_SESSION['u_id'] == $row['reciever_id']): ?> 
                                            <h2><?php echo $uname; ?></h2>
                                            <p><?php echo $send_mess; ?></p>
                                            <p class="small timestamp"><?php echo $timestamp; ?></p>
                                        <?php endif; ?>    
                                    </div>
                                </a>
                            </li>
                            <?php
                                $i++;
                                endwhile;
                            ?>
                        </ul>
                    <?php 
                        else: 
                            header('location: ../login.php');
                        endif; 
                    ?>    
                </section>
            </div>
        </div>
    </div>
    <?php include ROOT_PATH . '/includes/footer.php'; ?>