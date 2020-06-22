<?php
    include '../config.php';
    include ROOT_PATH . '/includes/header.php';
    include '../functions.php';
?>

<title>CIY Jobs | Create New Job</title>
</head>
<body>
    <div id="main">
        <!-- Navbar -->
        <?php include ROOT_PATH . '/includes/navbar.php'; ?>
        <!-- Content -->
        <div class="container">
            <div class="body_container">
            <?php if ($_SESSION['u_id']): ?>
                <div class="form">
                    <form method="post" action="<?php ROOT_PATH . '/jobs/create.php'; ?>">
                        <?php if ($edit_job === true): ?>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <h2>Edit Job</h2>
                            <?php jobErrors(); ?>
                            <input type="text" name="job_title" value="<?php echo $job_title; ?>" placeholder="Job Title">
                            <input type="text" name="job_description" value="<?php echo $job_desc; ?>" placeholder="Job Description">
                            <select name="location_name">
                            <option value="" selected disabled>Choose Location</option>
                            <?php
                                $locations = getTheLocationNameDropDown(); 
                                foreach ($locations as $location): 
                            ?>
                            <option value="<?php echo $location['location_name']; ?>">
                                <?php echo $location['location_name']; ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                        <input type="text" name="job_salary" value="<?php echo $job_salary; ?>" placeholder="Salary">
                        <select name="currency">
                            <option value="" selected disabled>Pick a Currency</option>
                            <?php 
                                $currencies = getTheCurrencyNameDropDown();
                                foreach ($currencies as $currency): 
                            ?>
                            <option value="<?php echo $currency['currency_name']; ?>">
                                <?php echo $currency['currency_name']; ?>
                            </option>
                            <?php endforeach; ?>
                        </select><br>
                        <select name="category_name">
                            <option value="" selected disabled>Pick a Category</option>
                            <?php 
                                $categories = getTheCategoryNameDropDown();
                                foreach ($categories as $category): 
                            ?>
                            <option value="<?php echo $category['cat_name'] | $category['id']; ?>">
                                <?php echo $category['cat_name']; $category['id']; ?>
                            </option>
                            <?php endforeach; ?>
                        </select><br>
                        <label for="published">Publish now? </label><br> 
                        <input type="checkbox" value="1" name="published" class="checkbox" checked="checked">
                        <button type="submit" name="update_job" class="btn">Edit Job</button>

                        <?php else: ?>    

                        <h2>Create A New Job</h2>
                        <?php jobErrors(); ?>
                        <?php 
                            if (isset($_GET['job_title'])) {
                                $title = $_GET['job_title'];
                                echo '<input type="text" name="job_title" value="'.$title.'" placeholder="Job Title" autocomplete="off">';
                            }
                            else {
                                echo '<input type="text" name="job_title" value="'.$job_title.'" placeholder="Job Title" autocomplete="off">';
                            }
                            if (isset($_GET['description'])) {
                                $desc = $_GET['description'];
                                echo '<input type="text" name="job_description" value="'.$desc.'" placeholder="Job Description" autocomplete="off">';
                            }
                            else {
                                echo '<input type="text" name="job_description" value="'.$job_desc.'" placeholder="Job Description" autocomplete="off">';
                            }
                        ?>
                        <select name="location_name">
                            <option value="" selected disabled>Choose Location</option>
                            <?php
                                $locations = queryLocations(); 
                                while ($loc = mysqli_fetch_assoc($locations)):
                                    $loc_id = $loc['loc_id'];
                                    $loc_name = $loc['location_name'];
                                    echo '<option value="'.$loc_id."_".$loc_name.'">
                                    '.$loc_name.'
                                    </option>';
                                endwhile;     
                            ?>
                        </select>
                        <input type="text" name="job_salary" value="<?php echo $salary; ?>" placeholder="Salary">
                        <select name="currency">
                            <option value="" selected disabled>Pick a Currency</option>
                            <?php 
                                $currencies = getTheCurrencyNameDropDown();
                                foreach($currencies as $currency): 
                            ?>
                            <option value="<?php echo $currency['currency_name']; ?>">
                                <?php echo $currency['currency_name']; ?>
                            </option>
                            <?php endforeach; ?>
                        </select><br>
                        <select name="category_name">
                            <option value="" selected disabled>Pick a Category</option>
                            <?php 
                                $categories = queryCategories();
                                while ($row = mysqli_fetch_assoc($categories)):
                                    $cat_id = $row['id'];
                                    $cat_name = $row['cat_name'];
                                    echo '<option value="'.$cat_id."_".$cat_name.'">
                                    '.$cat_name.'
                                    </option>';
                                endwhile;?>
                        </select><br>
                        <label for="published">Publish now? </label><br> 
                        <input type="checkbox" value="1" name="published" class="checkbox" checked="checked">
                        <button type="submit" name="submit_job" class="btn">Submit Job</button>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
        <?php  
            else: 
                header('location: ../login.php?please_login');
                exit();
            endif;
        ?>    
        </div>
    </div>
    <!-- Footer -->
    <?php include ROOT_PATH . '/includes/footer.php';
    