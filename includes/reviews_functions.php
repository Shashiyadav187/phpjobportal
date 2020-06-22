<?php 
    $db_selected = mysqli_select_db($conn, "job_portal");
    if (!$db_selected) {
        header('location: index.php?cannot_connect');
        exit();
    }

    $review = "";
    $job_title = "";
    $emp_id = 0;
    $review_id = 0;
    $edit_review = false;

    if (isset($_POST['submit_review'])) {
        $review = mysqli_real_escape_string($conn, $_POST['review_body']);
        $job_title = mysqli_real_escape_string($conn, $_POST['job_title']);

        if (empty($review)) {
            header('location: ../users/user.php?user='.getTheUserId());
            exit();
        }

        $user_id = $_SESSION['u_id'];
        $emp_id = $_GET['id'];
        $insert_review = "INSERT INTO reviews (review_body, user_id, job_title, created_at, updated_at, emp_id) VALUE ('$review', '$user_id', '$job_title', now(), now(), '$emp_id')";
        mysqli_query($conn, $insert_review);
        header('location: ../users/users.php?review_posted');
        exit();
    }

    function queryReviews()
    {
        global $conn;
        $get_reviews = "SELECT * FROM reviews INNER JOIN users ON reviews.user_id = users.id";
        if (!$get_reviews) {
            echo 'Could not run query: ' . mysqli_error();
            exit();
        }
        $result = mysqli_query($conn, $get_reviews);
        return $result;
    }

    function getEmpAndReview()
    {
        global $conn;
        $rev_id = $_GET['id'];
        $get_emp = "SELECT * FROM reviews INNER JOIN users ON reviews.emp_id = users.id WHERE emp_id = '$rev_id'";
        if (!$get_emp) {
            echo 'Could not run query: ' . mysqli_error();
            exit();
        }
        $result = mysqli_query($conn, $get_emp);
        return $result;
    }

    function getEmp()
    {
        $result = getEmpAndReview();
        if ($e = mysqli_fetch_array($result)) {
            $emp = $e['emp_id'];
            return $emp;
        }
    }

    
