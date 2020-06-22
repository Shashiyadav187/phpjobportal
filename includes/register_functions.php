<?php
    $db_selected = mysqli_select_db($conn, "job_portal");
    if (!$db_selected) {
        header('location: register.php?cannot_connect');
        exit();
    }

    $username = "";
    $email = "";
    $profile_pic = "";

    if (!isset($_POST['reg_user'])) {
        return;
        header('location: register.php');
        exit();
    }

    if (isset($_POST['reg_user'])) {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password_1 = mysqli_real_escape_string($conn, $_POST['password_1']);
        $password_2 = mysqli_real_escape_string($conn, $_POST['password_2']);

        if (empty($username) || empty($email) || empty($password_1)) {
            header('location: register.php?register=fields_empty&username='.$username.'&email='.$email);
            exit();
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header('location: register.php?register=not_a_valid_email&username='.$username.'&email='.$email);
            exit();
        }
        if ($password_1 != $password_2) {
            header('location: register.php?register=passwords_do_not_match&username='.$username.'&email='.$email);
            exit();
        }

        $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
        $result = mysqli_query($conn, $user_check_query);
        $user = mysqli_fetch_assoc($result);

        if ($user) {
            if ($user['username'] === $username) {
                header('location: register.php?register=user_already_exists&username='.$username.'&email='.$email);
                exit();
            }
            if ($user['email'] === $email) {
                header('location: register.php?register=email_already_exists&username='.$username.'&email='.$email);
                exit();
            }
        }

        if ($user <= 0) {
            $password = password_hash($password_1, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (username, email, role, password, created_at, updated_at) VALUES ('$username', '$email', 'User', '$password', now(), now())";
            mysqli_query($conn, $sql);
            $query = "SELECT * FROM users WHERE email = '$email'";
            $login = mysqli_query($conn, $query);
            $check = mysqli_num_rows($login);
            $row = mysqli_fetch_assoc($login);
            $_SESSION['is_logged_in'] = $row['id'];
            $_SESSION['u_id'] = $row['id'];
            $_SESSION['u_username'] = $row['username'];
            $_SESSION['u_email'] = $row['email'];
            $_SESSION['user_password'] = $row['password'];
            $_SESSION['u_role'] = $row['role'];
            if ($_SESSION['u_role'] == 'User') {
                header('location: ' .BASE_URL. 'users/user_dashboard.php?register=successful');
            } elseif ($_SESSION['u_role'] == 'Admin') {
            header('location: ' .BASE_URL. 'admin/admin_dashboard.php?register=successful');
            exit();
            }
        }
    }
    
    function getUserById($id)
    {
        global $conn;
        $sql = "SELECT * FROM users WHERE id = $id LIMIT 1";
        $result = mysqli_query($conn, $sql);
        $user = mysqli_fetch_all($result);
        return $user;
    }

    function register_error()
    {
        if (!isset($_GET['register'])) {
            return;
        }
        else {
            $register_check = $_GET['register'];
            if ($register_check == "fields_empty") {
                echo "<p class='error'>Fields cannot be empty</p>";
                return;
            }
            elseif ($register_check == "not_a_valid_email") {
                echo "<p class='error'>Invlid email address</p>";
                return;
            }
            elseif ($register_check == "passwords_do_not_match") {
                echo "<p class='error'>Passwords do not match</p>";
                return;
            }
            elseif ($register_check == "user_already_exists") {
                echo "<p class='error'>Username already exists</p>";
                return;
            }
            elseif ($register_check == "email_already_exists") {
                echo "<p class='error'>Email already exists</p>";
                return;
            }
        }
    }
