<?php 
    include '../config.php';
    include ROOT_PATH . '/includes/header.php';
    include '../functions.php';
?>

<title>CIY Jobs | Create User</title>
</head>
<body>
    <div id="main">
    <?php include ROOT_PATH . '/includes/navbar.php'; ?>
        <div class="container">
            <div class="body_container">
            <?php if (isset($_SESSION['u_role']) == 'Admin'): ?>
                <section class="form">
                    <form action="create_user.php" method="post" enctype="multipart/form-data">
                        <?php if ($edit_user === true): ?>
                            <h2>Edit User</h2>
                            <!-- Add error file here -->
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="text" name="a_username" value="<?php echo $u_username; ?>" placeholder="Username">
                            <input type="email" name="a_email" value="<?php echo $u_email; ?>" placeholder="Email">
                            <input type="password" name="a_password_1" placeholder="Password">
                            <input type="password" name="a_password_2" placeholder="Password Confirmation">
                            <select name="role_name" id="">
                                <option value="<?php echo $u_role; ?>" selected disabled>Pick a Role</option>
                                <?php 
                                    $roles = ['Admin', 'User'];
                                    foreach ($roles as $key => $role):
                                ?>
                                <option value="<?php echo $role; ?>">
                                    <?php echo $role; ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                            <!-- <input type="file" name="a_profile_pic" id=""> -->
                            <button type="submit" class="btn" name="admin_edit_user">Edit User</button><br>
                        <?php else: ?>    
                            <h2>Add User</h2>
                            <!-- Add error file here -->
                            <input type="text" name="a_username" value="<?php echo $username; ?>" placeholder="Username">
                            <input type="email" name="a_email" value="<?php echo $email; ?>" placeholder="Email">
                            <input type="password" name="a_password_1" placeholder="Password">
                            <input type="password" name="a_password_2" placeholder="Password Confirmation">
                            <select name="role_name" id="">
                                <option value="" selected disabled>Pick a Role</option>
                                <?php 
                                    $roles = ['Admin', 'User'];
                                    foreach ($roles as $key => $role):
                                ?>
                                <option value="<?php echo $role; ?>">
                                    <?php echo $role; ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                            <!-- <input type="file" name="a_profile_pic" id=""> -->
                            <button type="submit" class="btn" name="admin_reg_user">Register</button><br>
                        <?php endif; ?>    
                    </form>
                    <a class="edit_btn" href="admin_dashboard.php?=<?php echo $_SESSION['u_id']; ?>">Cancel</a>
                </section>
                <?php else: 
                    header('location: ../login.php');
                    exit();
                endif;
                ?>
            </div>
        </div>
    </div>
    <?php include ROOT_PATH . '/includes/footer.php';