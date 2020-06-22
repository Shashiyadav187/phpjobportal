<?php
    $email_err = "";
    $password_err = "";
    $no_user = "";
    $login_email = $login_password = "";

    if(!isset($_POST['login_btn'])) {
        return;
        header('location: login.php?=cannot_login');
        exit();
    }

    if (isset($_POST['login_btn'])) {
        $login_email = mysqli_real_escape_string($conn, $_POST['user_email']);
        $login_password = mysqli_real_escape_string($conn, $_POST['user_password']);
        
        if (empty($login_email) || empty($login_password)) {
            header('location: login.php?login=empty');
            exit();
        }

        if (!filter_var($login_email, FILTER_VALIDATE_EMAIL)) {
            header('location: login.php?login=not_a_valid_email');
            exit();
        }
    }

    $login_query = "SELECT * FROM users where email = '$login_email'";
    $result = mysqli_query($conn, $login_query);
    $check = mysqli_num_rows($result);

    if ($check < 1) {
        header('location: login.php?login=no_user');
        exit();
    } else {
    
    if ($row = mysqli_fetch_assoc($result)) {
        $hashedpwdcheck = password_verify($login_password, $row['password']);
        if ($hashedpwdcheck == false) {
            header('location: login.php?login=wrong_password');
            exit();
        } elseif ($hashedpwdcheck == true) {
            $_SESSION['is_logged_in'] = $row['id'];
            $_SESSION['u_id'] = $row['id'];
            $_SESSION['u_username'] = $row['username'];
            $_SESSION['u_email'] = $row['email'];
            $_SESSION['user_password'] = $row['password'];
            $_SESSION['u_role'] = $row['role'];
            if ($_SESSION['u_role'] == 'User') {
                header('location: ' .BASE_URL. 'users/user_dashboard.php?login=successful');
            } elseif ($_SESSION['u_role'] == 'Admin') {
                header('location: ' .BASE_URL. 'admin/admin_dashboard.php?login=successful');
                exit();
            }    
        }
    }}

    function loginErrors()
    {
        if (!isset($_GET['login'])) {
            return;
        }
        else {
            $signup_check = $_GET['login'];
            if ($signup_check == "empty") {
                echo "<p class='error'>Fields cannot be empty</p>";
                return;
            }
            elseif ($signup_check == "not_a_valid_email") {
                echo "<p class='error'>Invlid email address</p>";
                return;
            }
            elseif ($signup_check == "wrong_password") {
                echo "<p class='error'>Incorrect password!</p>";
                return;
            }
            elseif ($signup_check == "no_user") {
                echo "<p class='error'>There is no user with these credentials!</p>";
                return;
            }
        }
    }
