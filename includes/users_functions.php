<?php
    $db_selected = mysqli_select_db($conn, "job_portal");
    if (!$db_selected) {
        header('location: register.php?cannot_connect');
        exit();
    }

    $u_username = "";
    $u_email = "";
    $u_role = "";
    $role = "";
    $id = 0;
    $edit_user = false;
    
    if (isset($_POST['admin_reg_user'])) {
        $u_username = mysqli_real_escape_string($conn, $_POST['a_username']);
        $u_email = mysqli_real_escape_string($conn, $_POST['a_email']);
        $u_password_1 = mysqli_real_escape_string($conn, $_POST['a_password_1']);
        $u_password_2 = mysqli_real_escape_string($conn, $_POST['a_password_2']);
        $u_role = mysqli_real_escape_string($conn, $_POST['role_name']);
        
        if (empty($u_username) || empty($u_email) || empty($u_role) || empty($u_password_1)) {
        header('location: create_user.php?fields_cannot_be_empty');
        exit();
        }
        if (!filter_var($u_email, FILTER_VALIDATE_EMAIL)) {
            header('location: create_user.php?not_a_valid_email');
            exit();
        }
        if ($u_password_1 != $u_password_2) {
            header('location: create_user.php?passwords_do_not_match');
            exit();
        }

        $user_check_query = "SELECT * FROM users WHERE username = '$u_username' OR email = '$u_email' LIMIT 1";
        $result = mysqli_query($conn, $user_check_query);
        $user = mysqli_fetch_assoc($result);

        if ($user['username'] === $u_username) {
            header('location: create_user.php?username_already_exists');
            exit();
        }
        if ($user['email'] === $u_email) {
            header('location: create_user.php?email_already_exists');
            exit();
        } 
        if ($user <= 0) {
            $hashed_pwd = password_hash($u_password_1, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (username, email, role, password, created_at, updated_at) VALUES ('$u_username', '$u_email', '$u_role', '$hashed_pwd', now(), now())";
            mysqli_query($conn, $sql);
            header('location: ../users/users.php');
            exit();
        }

    } 

    if (isset($_GET['edit_user'])) {
        $edit_user = true;
        $id = $_GET['edit_user'];

        $get_the_user = "SELECT * FROM users WHERE id = $id LIMIT 1";
        $result = mysqli_query($conn, $get_the_user);

        $user = mysqli_fetch_array($result);
        $u_username = $user['username'];
        $u_email = $user['email'];
        $u_role = $user['role'];
    }

    if (isset($_POST['admin_edit_user'])) {
        $u_username = mysqli_real_escape_string($conn, $_POST['a_username']);
        $u_email = mysqli_real_escape_string($conn, $_POST['a_email']);
        $u_role = mysqli_real_escape_string($conn, $_POST['role_name']);
        $u_password_1 = mysqli_real_escape_string($conn, $_POST['a_password_1']);
        $u_password_2 = mysqli_real_escape_string($conn, $_POST['a_password_2']);
        
        if (empty($u_username)) {
            header('location: create_user.php?username=empty');
            exit();
        }
        if (empty($u_email)) {
            header('location: create_user.php?email_empty');
            exit();
        }
        if (empty($u_role)) {
            header('location: create_user.php?role_empty');
        }
        if (!FILTER_VAR($u_email, FILTER_VALIDATE_EMAIL)) {
            header('location: create_user.php?not_a_valid_email');
            exit();
        }
        if ($u_password_1 != $u_password_2) {
            header('location: create_user.php?passwords_must_match');
            exit();
        }

        $check_user = "SELECT * FROM users WHERE username = '$u_username' OR email = '$u_email' LIMIT 1";
        $result = mysqli_query($conn, $check_user);
        $user = mysqli_fetch_assoc($result);

        if ($user['username'] === $u_username) {
            header('location: create_user.php?username_already_exists');
            exit();
        }
        if ($user['email'] === $u_email) {
            header('location: create_user.php?email_already_exists');
            exit();
        }
        if ($user <= 0) {
            $user_password = password_hash($u_password_1, PASSWORD_DEFAULT);
            $id = $_POST['id'];
            $update_user = "UPDATE users SET username='$u_username', email='$u_email', role='$u_role', password='$user_password' WHERE id='$id'";
            mysqli_query($conn, $update_user);
            header('location: ../users/users.php?user_updated');
            exit();
        }
    }

    if (isset($_GET['delete_user'])) {
        $id = $_GET['delete_user'];
        $get_user = "DELETE FROM users WHERE id=$id";
        if (!mysqli_query($conn, $get_user)) {
            header('location: '.BASE_URL. 'users/users.php?error_trying_to_delete_user');
            exit();
        } 
        else {
            header('location: '.BASE_URL. 'users/users.php?user_deleted');
            exit();
        }
    }

    $user_headline = "";
    $user_desc = "";
    $user_location = "";
    $user_edit = false;
    $id = 0;

    if (isset($_GET['edit_user_id'])) {
        $user_edit = true;
        $id = $_GET['edit_user_id'];
        $get_the_user = "SELECT * FROM users WHERE id = $id LIMIT 1";
        $result = mysqli_query($conn, $get_the_user);

        $user = mysqli_fetch_array($result);
        $user_headline = $user['user_headline'];
        $user_desc = $user['user_desc'];
        $user_location = $user['user_location'];
    }

    if (isset($_POST['add_user_info'])) {
        $user_headline = mysqli_real_escape_string($conn, $_POST['user_headline']);
        $user_desc = mysqli_real_escape_string($conn, $_POST['user_desc']);
        $user_location = mysqli_real_escape_string($conn, $_POST['user_location']);

        $id = $_POST['id'];
        $insert_info = "UPDATE users SET user_headline='$user_headline', user_desc='$user_desc', user_location='$user_location' WHERE id=$id";
        mysqli_query($conn, $insert_info);
        header('location: ../users/users.php?user_updated');
        exit();
    }

    $u_profile_pic = "";
    
    if (isset($_POST['submit_picture'])) {
        $u_profile_pic = $_FILES['profile_pic']['name'];
        $u_file_tmp_name = $_FILES['profile_pic']['tmp_name'];
        $u_fileSize = $_FILES['profile_pic']['size'];
        $u_fileError = $_FILES['profile_pic']['error'];
        $u_fileType = $_FILES['profile_pic']['type'];

        $file_ext = explode('.', $u_profile_pic);
        $file_actual_exist = strtolower(end($file_ext));

        $allowed = ['jpg', 'jpeg', 'png', 'pdf'];
        $pic_user_id = $_SESSION['u_id'];

        if (in_array($file_actual_exist, $allowed)) {
            if ($u_fileError === 0) {
                if ($u_fileSize < 500000) {
                    $new_file_name = "profile"."$pic_user_id".".".$file_actual_exist;
                    $file_destination = '../uploads/'.$new_file_name;
                    move_uploaded_file($u_file_tmp_name, $file_destination);
                    $insert_pic = "INSERT INTO profile_pics (profile_pic, tmp_name, user_id) VALUE ('$u_profile_pic', '$u_file_tmp_name', '$pic_user_id')";
                    mysqli_query($conn, $insert_pic);
                    header('location: users.php?image_uploaded');
                    exit();
                }
            }
        }
    }

    $edit_pic = false;
    $pic_id = 0;

    if (isset($_GET['edit_picure'])) {
        $edit_pic = true;
        $pic_id = $_GET['edit_picure'];

        $get_pic = "SELECT * FROM profile_pics WHERE pic_id = $pic_id LIMIT 1";
        $result = mysqli_query($conn, $get_pic);
        $edit = mysqli_fetch_array($result);
        $u_profile_pic = $edit['profile_pic'];
    }

    if (isset($_POST['edit_picture'])) {
        $u_profile_pic = $_FILES['profile_pic']['name'];
        $u_file_tmp_name = $_FILES['profile_pic']['tmp_name'];
        $u_fileSize = $_FILES['profile_pic']['size'];
        $u_fileError = $_FILES['profile_pic']['error'];
        $u_fileType = $_FILES['profile_pic']['type'];

        $file_ext = explode('.', $u_profile_pic);
        $file_actual_exist = strtolower(end($file_ext));

        $allowed = ['jpg', 'jpeg', 'png', 'pdf'];
        $pic_user_id = $_SESSION['u_id'];

        if (in_array($file_actual_exist, $allowed)) {
            if ($u_fileError === 0) {
                if ($u_fileSize < 500000) {
                    $new_file_name = "profile"."$pic_user_id".".".$file_actual_exist;
                    $file_destination = '../uploads/'.$new_file_name;
                    move_uploaded_file($u_file_tmp_name, $file_destination);
                    $pic_id = $_POST['pic_id'];
                    $update_pic = "UPDATE profile_pics SET profile_pic='$u_profile_pic', tmp_name='$u_file_tmp_name' WHERE pic_id=$pic_id";
                    mysqli_query($conn, $update_pic);
                    header('location: users.php?image_updated');
                    exit();
                }
            }
        }
    }
    
    function getSessionUserEmail()
    {
        $session_email = $_SESSION['u_email'];
        echo $session_email;
    }

    function getSessionUserId()
    {
        $session_id = $_SESSION['u_id'];
        return $session_id;
    }

    function getSessionUserName()
    {
        $session_name = $_SESSION['u_username'];
        echo $session_name;
    }

    function getUsers()
    {
        global $conn;
        $get_users = "SELECT * FROM users LEFT JOIN profile_pics ON users.id = profile_pics.user_id WHERE role = 'User' ORDER BY username ASC";
        $result = mysqli_query($conn, $get_users);
        return $result;
    }

    function getAllUsers()
    {
        global $conn;
        $get_users = "SELECT * FROM users LEFT JOIN profile_pics ON users.id = profile_pics.user_id ORDER BY username ASC";
        $result = mysqli_query($conn, $get_users);
        return $result;
    }

    function getUser()
    {
        global $conn;
        $id = $_GET['id'];
        $get_user = "SELECT * FROM users WHERE id='$id'";
        $result = mysqli_query($conn, $get_user);
        return $result;
    }

    function getUserName()
    {
        $result = getUser();
        if ($name = mysqli_fetch_array($result)) {
            $user_name = $name['username'];
            return $user_name;
        }
    }

    function getTheUserId()
    {
        $user = getUser();
        if ($id = mysqli_fetch_array($user)) {
            $user_id = $id['id'];
            return $user_id;
        }
    }

    function getTheUserName()
    {
        $user_name = getAllUsers();
        if ($user = mysqli_fetch_array($user_name)) {
            $u_name = $user['username'];
            return $u_name;
        }
    }

    function getTheRolesDropDown()
    {
        global $conn;
        $role_query = "SELECT role FROM users";
        $result = mysqli_query($conn, $role_query);
        $roles = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $roles;
    }

    function getTheUserHeadline()
    {
        global $conn;
        $headline_query = getUser();
        if ($user = mysqli_fetch_array($headline_query)) {
            $headline = $user['user_headline'];
            return $headline;
        }
    }

    function getTheUserDescription()
    {
        global $conn;
        $description_query = getUser();
        if ($user = mysqli_fetch_array($description_query)) {
            $user_description = $user['user_desc'];
            return $user_description;
        }
    }

    function getTheUserLocation()
    {
        global $conn;
        $location_query = getUser();
        if ($user = mysqli_fetch_array($location_query)) {
            $user_location = $user['user_location'];
            return $user_location;
        }
    }

    function getEditUserIdQuery()
    {
        global $conn;
        $edit_user = $_GET['edit_user_id'];
        $query = "SELECT * FROM users WHERE id = '$edit_user'";
        $result = mysqli_query($conn, $query);
        return $result;
    }

    function getEditUserId()
    {
        $result = getEditUserIdQuery();
        if ($edit_id = mysqli_fetch_array($result)) {
            $u_id = $edit_id['id'];
            return $u_id;
        }
    }

    function getUserProfilePic()
    {
        global $conn;
        $user_id = $_GET['id'];
        $profile_pic_query = "SELECT * FROM profile_pics WHERE user_id = '$user_id'";
        $result = mysqli_query($conn, $profile_pic_query);
        if ($user = mysqli_fetch_array($result)) {
            $user_pic = $user['user_id'];
            return $user_pic;
        }
    }

    function getPictures()
    {
        global $conn;
        $user_id = $_GET['id'];
        $get_pic_id = "SELECT * FROM profile_pics WHERE user_id='$user_id'";
        $result = mysqli_query($conn, $get_pic_id);
        return $result;
    }

    function getPictureId()
    {
        $result = getPictures();
        if ($id = mysqli_fetch_array($result)) {
            $pic_id = $id['pic_id'];
            return $pic_id;
        }
    }
    