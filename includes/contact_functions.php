<?php

if (isset($_POST['send_message'])) {
    $to = "thecodeityourself@gmail.com";
    $from = $_POST['contact_email'];
    $sender = $_POST['contact_name'];
    $title = $_POST['contact_title'];
    $title2 = "Copy of your form submission";
    $message = $_POST['message'];

    $header = "From:" . $from;
    $header2 = "From:" . $to;
    mail($to, $title, $message, $header);
    mail($from, $title2, $message, $header2);

    header('location: '.BASE_URL. 'contact/thank_you.php?message_sent');
}

$mess = "";
$receiver_id = 0;

if (isset($_POST['send_message'])) {
    $mess = mysqli_real_escape_string($conn, $_POST['message_body']);

    if (empty($mess)) {
        header('location: ../applications/contact.php?id='.getUserId());
        exit();
    }

    $sender_id = $_SESSION['u_id'];
    $receiver_id = $_GET['id'];
    $insert_thread = "INSERT INTO threads (created_at, person_id, reciever_id) VALUES (now(), '$sender_id', '$receiver_id')";
    $id_thread = mysqli_query($conn, $insert_thread);
    
    $last_id = mysqli_insert_id($conn);
    $send_message = "INSERT INTO messages (message_body, sender_id, receiver_id, created_at, updated_at, thread_id) VALUE ('$mess', '$sender_id', '$receiver_id', now(), now(), '$last_id')";
    mysqli_query($conn, $send_message);
    header('location: ../contact/contacts.php?id='.$sender_id.'?message_sent');
    exit();
}

$thread = "";
$thread_id = 0;
$receiver_id = 0;

if (isset($_POST['reply_message'])) {
    $thread = mysqli_real_escape_string($conn, $_POST['reply']);

    if (empty($thread)) {
        header('location: ../contacts/message.php?'.getThreadId());
        exit();
    }

    $sender_id = $_SESSION['u_id'];
    $thread_id = $_GET['thread_id'];
    $receiver_id = $_GET['receiver_id'];
    $reply = "INSERT INTO messages (message_body, sender_id, receiver_id, created_at, updated_at, thread_id) VALUE ('$thread', '$sender_id', '$receiver_id', now(), now(), '$thread_id')";
    mysqli_query($conn, $reply);
    header('location: ../contact/message.php?thread_id='.$thread_id.'&receiver='.$receiver_id.'?message_sent');
    exit();
}

function getMessages()
{
    global $conn;
    $session_id = $_SESSION['u_id'];
    $get_message = "SELECT * FROM messages INNER JOIN users ON messages.sender_id = users.id WHERE sender_id = $session_id OR receiver_id = $session_id";
    if (!$get_message) {
        echo 'Could not run query: ' . mysqli_error();
        exit();
    }
    $result = mysqli_query($conn, $get_message);
    return $result;
}

function getThread()
{
    global $conn;
    $user = $_SESSION['u_id'];
    $thread = $_GET['thread_id'];
    $get_thread = "SELECT * FROM messages INNER JOIN users ON messages.sender_id = users.id WHERE thread_id = $thread";
    if (!$get_thread) {
        echo 'Could not run query: ' . mysqli_error();
        exit();
    }
    $result = mysqli_query($conn, $get_thread);
    return $result;
}

function getThreadId()
{
    $result = getThread();
    if ($thread = mysqli_fetch_array($result)) {
        $thread_id = $thread['thread_id'];
        echo $thread_id;
    }
}

function getReceiverId()
{
    $result = getThread();
    if ($r = mysqli_fetch_array($result)) {
        $receiver = $r['receiver_id'];
        echo $receiver;
    }
}

function getThreads()
{
    global $conn;
    $user_id = $_SESSION['u_id'];
    $thread_id = "SELECT *, threads.created_at AS ttime, messages.created_at AS mtime FROM threads INNER JOIN messages ON threads.id_thread = messages.thread_id INNER JOIN users ON messages.sender_id = users.id INNER JOIN profile_pics ON users.id = profile_pics.user_id WHERE sender_id = '$user_id' OR receiver_id = '$user_id' GROUP BY thread_id ORDER BY mtime DESC";
    $result = mysqli_query($conn, $thread_id);
    return $result;
}

