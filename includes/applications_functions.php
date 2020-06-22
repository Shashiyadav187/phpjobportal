<?php
    $db_selected = mysqli_select_db($conn, "job_portal");
    if (!$db_selected) {
        header('location: index.php?cannot_connect');
        exit();
    }

    $bid = "";
    $bid_id = 0;
    $edit_bid = false;

    if (isset($_POST['submit_bid'])) {
        $bid = mysqli_real_escape_string($conn, $_POST['bid_text']);

        if (empty($bid)) {
            header('location: ../users/users.php?field_cannot_be_empty');
            exit();
        }

        $user_id = $_SESSION['u_id'];
        $get_job_id = $_GET['id'];
        $insert_bid = "INSERT INTO applications (application_body, user_id, job_id, created_at, updated_at) VALUE ('$bid', $user_id, $get_job_id, now(), now())";
        mysqli_query($conn, $insert_bid);
        header('location: ../users/users.php?application_successful');
        exit();
    }

    if (isset($_GET['bid_id'])) {
        $edit_bid = true;
        $id = $_GET['bid_id'];

        $get_bid = "SELECT * FROM applications WHERE bid_id = $id LIMIT 1";
        $result = mysqli_query($conn, $get_bid);

        $edit = mysqli_fetch_array($result);
        $bid = $edit['application_body'];
    }

    if (isset($_POST['edit_bid'])) {
        $bid = mysqli_real_escape_string($conn, $_POST['bid_text']);
        if (empty($bid)) {
            header('location: application.php?bid_id='.$id);
            exit();
        }

        $id = $_POST['bid_id'];
        $update_bid = "UPDATE applications SET application_body='$bid', updated_at=now() WHERE bid_id=$id";
        mysqli_query($conn, $update_bid);
        header('location: ../jobs/jobs.php?bid_updated');
        exit();
    }

    if (isset($_GET['delete_bid'])) {
        $bid_id = $_GET['delete_bid'];
        $delete_bid = "DELETE FROM applications WHERE bid_id=$bid_id";
        if (!mysqli_query($conn, $delete_bid)) {
            header('location: ../jobs/jobs.php?bid_not_deleted');
            exit();
        } else {
            header('location: ../jobs/jobs.php?bid_was_successfully_deleted');
            exit();
        }
    }

    function getAllApplications()
    {
        global $conn;
        $get_bids = "SELECT * FROM applications INNER JOIN users ON applications.user_id = users.id INNER JOIN jobs ON applications.job_id = jobs.id";
        $result = mysqli_query($conn, $get_bids);
        return $result;
    }

    function getApplication()
    {
        global $conn;
        $job_id = $_GET['id'];
        $get_bid = "SELECT *, jobs.user_id AS juid, applications.user_id AS auid FROM applications INNER JOIN users ON applications.user_id = users.id INNER JOIN jobs ON applications.job_id = jobs.id WHERE job_id = '$job_id'";
        $bid = mysqli_query($conn, $get_bid);
        return $bid;
    }

    function getTheApplication()
    {
        global $conn;
        $bid_id = $_GET['bid_id'];
        $get_the_bid = "SELECT * FROM applications WHERE bid_id = '$bid_id'";
        $the_bid = mysqli_query($conn, $get_the_bid);
        return $the_bid;
    }

    function getApplicationIdAndUser()
    {
        $result = getTheApplication();
        if ($bid = mysqli_fetch_array($result)) {
            $id = $bid['bid_id'];
            return $id;
        }
    }

    function getApplicantAndUser()
    {
        global $conn;
        $bid_id = $_GET['bid_id'];
        $get_bid = "SELECT *, applications.user_id AS auid FROM applications INNER JOIN users ON applications.user_id = users.id WHERE bid_id = '$bid_id'";
        $the_bid = mysqli_query($conn, $get_bid);
        return $the_bid;
    }

    function getApplicantName()
    {
        $result = getApplicantAndUser();
        if ($name = mysqli_fetch_array($result)) {
            $username = $name['username'];
            return $username;
        }
    }

    function getApplicantEmail()
    {
        $result = getAllApplications();
        if ($e = mysqli_fetch_array($result)) {
            $email = $e['email'];
            return $email;
        }
    }

    function getApplicationBody()
    {
        $result = getApplicantAndUser();
        if ($b = mysqli_fetch_array($result)) {
            $body = $b['application_body'];
            return $body;
        }
    }

    function getApplicantId()
    {
        $result = getTheApplication();
        if ($i = mysqli_fetch_array($result)) {
            $id = $i['user_id'];
            return $id;
        }
    }

    function getApplicationJobId()
    {
        $result = getApplicantAndUser();
        if ($job = mysqli_fetch_array($result)) {
            $job_id = $job['job_id'];
            return $job_id;
        }
    }

    function getApplicationId()
    {
        $result = getAllApplications();
        if ($id = mysqli_fetch_array($result)) {
            $bid_id = $id['bid_id'];
            return $bid_id;
        }
    }

    function getApplicationApplicantId()
    {
        global $conn;
        $id = $_GET['id'];
        $query = "SELECT * FROM applications WHERE user_id = '$id'";
        $the_user = mysqli_query($conn, $query);
        return $the_user;
    }

    function getUserId()
    {
        $result = getApplicationApplicantId();
        if ($u = mysqli_fetch_array($result)) {
            $user = $u['user_id'];
            echo $user;
        }
    }
