<?php 
    include '../config.php';
    include ROOT_PATH . '/includes/header.php';
    include '../functions.php';
?>
<title>CIY Jobs | Upload Picture</title>
</head>
<body>
    <div id="main">
        <?php include ROOT_PATH . '/includes/navbar.php'; ?>
        <div class="container">
            <div class="body_container">
                <div class="form">
                    <form action="picture_upload.php" method="post" enctype="multipart/form-data">
                        <?php if ($edit_pic === true): ?>
                            <input type="hidden" name="id" value="<?php echo $pic_id; ?>">
                            <h2>Change Profile Picture</h2>
                            <input type="file" name="profile_pic" value="<?php echo $u_profile_pic; ?>">
                            <button type="submit" name="edit_picture">Change Picture</button>
                        <?php else: ?>    
                            <h2>Upload Profile Picture</h2>
                            <input type="file" name="profile_pic" id="">
                            <button type="submit" name="submit_picture" class="btn">Upload</button>
                        <?php endif; ?>    
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include ROOT_PATH . '/includes/footer.php';
