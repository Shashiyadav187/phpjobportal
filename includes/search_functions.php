<?php

    function job_search()
    {
        global $conn;

        if (isset($_GET['search'])) {

            $searchq = mysqli_real_escape_string($conn, $_GET['search_job']);
            $search_query = "SELECT * FROM jobs WHERE job_title LIKE '%$searchq%' OR job_description LIKE '%$searchq%' OR location LIKE '%$searchq%' OR job_salary LIKE '%$searchq%' OR currency LIKE '%$searchq%' OR category LIKE '%$searchq%'";
            $result = mysqli_query($conn, $search_query);
                
            if(mysqli_num_rows($result) > 0) { 
                
                while($row = mysqli_fetch_assoc($result)): ?>
                    <li class="jobs_listing">
                        <div class="jobs_listing_left">
                            <a name="jobspost" href="<?php echo BASE_URL . '/jobs/jobsposts.php?id='.$row['id'].'?='.$row['job_title'].'?u_id='.$row['user_id']; ?>">
                                <h4><?php echo $row['job_title'] ?></h4>
                                <p><?php echo $row['job_description']; ?></p>
                            </a>
                            <ul>
                                <li><a href="<?php echo BASE_URL . 'categories/category.php?id='.$row['cat_id']; ?>"><?php echo $row['category']; ?></a></li>
                            </ul>
                        </div>
                        <div class="jobs_listing_right">
                            <h4><?php echo $row['job_salary']; echo ' ' .$row['currency']; ?></h4>
                            <p><?php echo $row['location']; ?></p>
                        </div>
                    </li>
                <?php endwhile; 
            }    
        }
    }

    function getJobSearchName()
    {
        $get_name = $_GET['search_job'];
        return $get_name;
    }

    function user_search()
    {
        global $conn;
        if (isset($_GET['search_users'])) {
            $userq = mysqli_real_escape_string($conn, $_GET['user']);
            $user_query = "SELECT * FROM users LEFT JOIN profile_pics ON users.id = profile_pics.user_id WHERE username LIKE '%$userq%' OR user_headline LIKE '%$userq%' OR user_desc LIKE '%$userq%' OR user_location LIKE '%$userq%'";
            $result = mysqli_query($conn, $user_query);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)): ?>
                    <li class="job_applicants_list">
                        <div class="job_applicant_img">
                            <?php if ($row['profile_pic']): ?>
                                <img src="../uploads/profile<?php echo $row['id']; ?>" alt="">
                            <?php else: ?>    
                                <img src="../static/images/no-profile-image.jpg" alt="">
                            <?php endif; ?>    
                        </div>
                        <div class="job_applicant_info">
                            <?php 
                                if (isset($_SESSION['is_logged_in'])) :
                                    if (isset($_SESSION['u_role']) == 'Admin'): ?>
                                        <h4><a href="<?php echo BASE_URL . 'users/user.php?id='.$row['id'].'='.$row['username']; ?>"><?php echo $row['username']; ?></a></h4>
                                        <p><?php echo $row['user_desc']; ?></p>
                                    <?php elseif ($_SESSION['u_role'] == 'User'): ?>
                                        <h4><a href="<?php echo BASE_URL . 'users/user.php?id='.$row['id'].'='.$row['username']; ?>"><?php echo $row['username']; ?></a></h4>
                                        <p><?php echo $row['user_desc']; ?></p>
                                    <?php 
                                    endif; 
                                else:    
                            ?>    
                                    <h4><a href="<?php echo BASE_URL . 'users/user.php?id='.$row['id'].'='.$row['username']; ?>"><?php echo $row['username']; ?></a></h4>
                                    <p><?php echo $row['user_desc']; ?></p>
                                <?php endif; ?>
                        </div>
                    </li>
                <?php endwhile; 
            }
        }
    }

    function getUserSearchName()
    {
        $get_name = $_GET['user'];
        return $get_name;
    }

    function catSearch()
    {
        global $conn;
        if (isset($_GET['search_cat'])) {
            $searchq = mysqli_real_escape_string($conn, $_GET['search_category']);
            $query = "SELECT * FROM categories WHERE cat_name LIKE '%$searchq%' OR slug LIKE '%$searchq%'";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)): ?>
                    <li><a href="<?php echo BASE_URL . 'categories/category.php?id='.$row['id']; ?>"><?php echo $row['cat_name']; ?></a></li>
                <?php endwhile;     
            }
        }
    }

    function getCatSearchName()
    {
        $get_cat = $_GET['search_category'];
        return $get_cat;
    }

    function currSearch()
    {
        global $conn;
        if (isset($_GET['search_currency'])) {
            $searchq = mysqli_real_escape_string($conn, $_GET['search_curr']);
            $query = "SELECT * FROM currencies WHERE currency_name LIKE '%$searchq%'";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)): ?>
                    <li><a href="<?php echo BASE_URL . 'currencies/currency.php?name='.$row['currency_name']; ?>"><?php echo $row['currency_name']; ?></a></li>
                <?php endwhile;    
            }
        }
    }

    function getCurrSearchName()
    {
        $get_curr = $_GET['search_curr'];
        return $get_curr;
    }

    function locSearch()
    {
        global $conn;
        if (isset($_GET['loc_search'])) {
            $searchq = mysqli_real_escape_string($conn, $_GET['search_loc']);
            $query = "SELECT * FROM locations WHERE location_name LIKE '%$searchq%'";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)): ?>
                    <li><a href="<?php echo BASE_URL . 'locations/location.php?id='.$row['loc_id']; ?>"><?php echo $row['location_name']; ?></a></li>
                <?php endwhile;  
            }
        }
    }

    function getLocSearchName()
    {
        $get_loc = $_GET['search_loc'];
        return $get_loc;
    }
