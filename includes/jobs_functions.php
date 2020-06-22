<?php

$db_selected = mysqli_select_db($conn, "job_portal");
if(!$db_selected)
{
    header('location: create.php?cannot_connect');
    exit();
}

$job_title = "";
$job_desc = "";
$location = "";
$salary = "";
$currency = "";
$category = "";
$user_id = "";
$published = "";
$edit_job = false;
$id = 0;

$currency_name = "";
$edit_currency = false;
$currency_id = 0;

$location_name = "";
$edit_location = false;
$location_id = 0;


if (isset($_POST['submit_job'])) {
    $errors = "";
    $job_title = mysqli_real_escape_string($conn, $_POST['job_title']);
    $job_desc = mysqli_real_escape_string($conn, $_POST['job_description']);
    $location = mysqli_real_escape_string($conn, $_REQUEST['location_name']);
    $salary = mysqli_real_escape_string($conn, $_POST['job_salary']);
    $currency = mysqli_real_escape_string($conn, $_POST['currency']);
    $published = isset($_POST['published']) ? : 0;
    $category = mysqli_real_escape_string($conn, $_REQUEST['category_name']);
        
    if (empty($job_title) || empty($job_desc) || empty($salary)) {
        header('location: create.php?job=fields_cannot_be_empty&job_title='.$job_title.'&description='.$job_desc);
        exit();
    }  
    
    if (!is_numeric($salary)) {
        header('location: create.php?job=must_be_a_number&job_title='.$job_title.'&description='.$job_desc);
        exit();
    }
    else {
        $user_id = $_SESSION['u_id'];

        $cid_res = explode("_", $category, 2);
        $cat_id = $cid_res[0];
        $cat_name = $cid_res[1];
        
        $loc_res = explode("_", $location, 2);
        $loc_id = $loc_res[0];
        $loc_name = $loc_res[1];
        $insert_query = "INSERT INTO jobs (job_title, job_description, location, job_salary, currency, published, category, created_at, updated_at, user_id, cat_id, loc_id) VALUES ('$job_title', '$job_desc', '$loc_name', '$salary', '$currency', '$published', '$cat_name', now(), now(), '$user_id', '$cat_id', '$loc_id')";
        mysqli_query($conn, $insert_query);
        header('Location: jobs.php?=job=created=successfully');
    }
}

if (isset($_GET['edit'])) {
    $edit_job = true;
    $id = $_GET['edit'];

    $get_job = "SELECT * FROM jobs WHERE id = $id LIMIT 1";
    $result = mysqli_query($conn, $get_job);

    $edit = mysqli_fetch_array($result);
    $job_title = $edit['job_title'];
    $job_desc = $edit['job_description'];
    $job_location = $edit['location'];
    $job_salary = $edit['job_salary'];
    $job_currency = $edit['currency'];
    $job_category = $edit['category'];
}

if (isset($_POST['update_job'])) {
    $job_title = mysqli_real_escape_string($conn, $_POST['job_title']);
    $job_desc = mysqli_real_escape_string($conn, $_POST['job_description']);
    $location = mysqli_real_escape_string($conn, $_POST['location_name']);
    $salary = mysqli_real_escape_string($conn, $_POST['job_salary']);
    $currency = mysqli_real_escape_string($conn, $_POST['currency']);
    $published = isset($_POST['published']) ? : 0;
    $category = mysqli_real_escape_string($conn, $_POST['category_name']);

    if (empty($job_title) || empty($job_desc) || empty($job_salary)) {
        header('location: create.php?job=fields_cannot_be_empty&job_title='.$job_title.'&description='.$job_desc);
        exit();
    } 
    if (!is_numeric($salary)) {
        header('location: create.php?job=must_be_a_number');
        exit();
    }
    else {
        $id = $_POST['id'];
        $update_job = "UPDATE jobs SET job_title='$job_title', job_description='$job_desc', location='$location', job_salary='$salary', currency='$currency', published='$published', category='$category', created_at=now(), updated_at=now() WHERE id=$id";
        mysqli_query($conn, $update_job); 
        header('location:jobs.php?job=updated=successfully');
    }
}

if (!isset($_GET['delete_job'])) {
    return;
    $errors = "Can't delete this job";
    header('location: ' .BASE_URL. 'jobs/jobs.php?job_cannot_be_deleted');
    exit();
}

if (isset($_GET['delete_job'])) {
    $id = $_GET['delete_job'];
    $get_job = "DELETE FROM jobs WHERE id=$id";
    if (!mysqli_query($conn, $get_job)) {
        $errors = "There's an error trying to deleting this job, please try again";
        header('location: ' .BASE_URL. 'jobs/jobs.php?error_when_deleting');
        exit();
    } else {
        header('location: ' .BASE_URL. 'jobs/jobs.php?job_successfully_deleted');
        exit();
    }
}

function jobErrors()
{
    if (!isset($_GET['job'])) {
        return;
    }
    else {
        $job_check = $_GET['job'];
        if ($job_check == "fields_cannot_be_empty") {
            echo "<p class='error'>Fields cannot be empty!</p>";
            return;
        }
        elseif ($job_check == "must_be_a_number") {
            echo "<p class='error'>Salary must be a number!</p>";
            return;
        }
    }
}

if (isset($_POST['submit'])) {
    $location = mysqli_real_escape_string($conn, $_POST['location_name']);

    if (empty($location)) {
        $errors = "Pick a location";
        header('location: add_location.php?=field=empty');
    } else {
        $get_location = "SELECT * FROM locations WHERE location_name='$location'";
        $result = mysqli_query($conn, $get_location);
        $check = mysqli_num_rows($result);

        if ($check > 0){
            $errors = "Location already exists";
            header('location: add_location.php?=Location=already=added');
            exit();
        } else {
            $insert_location = "INSERT INTO locations (location_name) VALUES ('$location')";
            mysqli_query($conn, $insert_location);
            header('location: ' .BASE_URL. 'locations/locations.php?=Location=successfully=added');
            exit();
        }
    }
}

if (isset($_GET['edit_location'])) {
    $edit_location = true;
    $location_id = $_GET['edit_location'];

    $get_location = "SELECT * FROM locations WHERE id = $location_id LIMIT 1";
    $result = mysqli_query($conn, $get_location);

    $edit = mysqli_fetch_array($result);
    $location_name = $edit['location_name'];
}

if (isset($_POST['update_location'])) {
    $location_name = mysqli_real_escape_string($conn, $_POST['location_name']);
    $location_id = $_POST['id'];
    if (empty($location_name)) {
        $errors = "Field cannot be emtpy";
        header('location:' .BASE_URL .'locations/location.php?id='.$location_id.'field_cannot_be_empty');
        exit();
    } else {
        $location_check_query = "SELECT * FROM locations WHERE location_name='$location_name' LIMIT 1";
        $result = mysqli_query($conn, $location_check_query);
    }
    if (mysqli_num_rows($result) > 0) {
        $errors = "Currency already exists";
        header('location:' .BASE_URL. 'locations/location.php?id='.$location_id.'location_already_exists');
        exit();
    } else {
        $update_location = "UPDATE locations SET location_name='$location_name' WHERE id=$location_id";
        mysqli_query($conn, $update_location);
        header('location: '.BASE_URL.'locations/locations.php?location_updated_successful');
    }
}

if (isset($_GET['delete_location'])) {
    $location_id = $_GET['delete_location'];
    $delete_location = "DELETE FROM locations WHERE id=$location_id";
    if (!mysqli_query($conn, $delete_location)) {
        header('location:' .BASE_URL. 'locations/location.php?id='.$location_name.'location_not_deleted');
        exit();
    } else {
        header('location:' .BASE_URL. 'locations/locations.php?location_deleted');
        exit();
    }
}

if (isset($_POST['add_currency'])) {
    if (empty($_POST['currency_name'])) {
        $errors = "Field cannot be empty";
        header('location: add_currency.php?=field=cannot=be=empty');
        exit();
    } else {
        $currency_name = mysqli_real_escape_string($conn, $_POST['currency_name']);
        $get_currency = "SELECT * FROM currencies WHERE currency_name='$currency_name'";
        $result = mysqli_query($conn, $get_currency);
        $check = mysqli_num_rows($result);

        if ($check > 0) {
            $errors = "Currency already exists";
            header('location: add_currency.php?=currency=already=exists');
            exit();
        } elseif (!$errors) {
            $insert_currency = "INSERT INTO currencies (currency_name) VALUES ('$currency_name')";
            mysqli_query($conn, $insert_currency);
            header('location: ../currencies/currencies.php?=currency=successfully=added');
            exit();
        }
    }
}

if(isset($_GET['edit_currency']))
{
    $edit_currency = true;
    $id_currency = $_GET['edit_currency'];

    $get_currency = "SELECT * FROM currencies WHERE id = $id_currency LIMIT 1";
    $result = mysqli_query($conn, $get_currency);
    $edit = mysqli_fetch_array($result);
    $currency_name = $edit['currency_name'];
}

if (isset($_POST['update_currency'])) {
    $currency_name = mysqli_real_escape_string($conn, $_POST['currency_name']);
    $id_currency = $_POST['id'];
    if (empty($currency_name))
    {
        $errors = "Field cannot be empty";
        header('location: add_currency.php?nope_field_cannot_be_empty');
        exit();
    } else {
        $currency_check_query = "SELECT * FROM currencies WHERE currency_name='$currency_name' LIMIT 1";
        $result = mysqli_query($conn, $currency_check_query);
    }
    if (mysqli_num_rows($result) > 0) {
        $errors = "Currency already exists";
        header('location: '.BASE_URL.'currencies/currency.php?id='.$id_currency.'?currency_already_exists');
        exit();
    } else {
        $update_currency = "UPDATE currencies SET currency_name='$currency_name' WHERE id=$id_currency";
        mysqli_query($conn, $update_currency);
        header('location: ../currencies/currencies.php?currency_updated_successfully');
    }
}

if (isset($_GET['delete_currency'])) {
    $currency_id = $_GET['delete_currency'];
    $delete_currency = "DELETE FROM currencies WHERE id=$currency_id";
    if (!mysqli_query($conn, $delete_currency)) {
        header('location: ../currencies/currency.php?id='.$id_currency.'?currency_not_deleted');
        exit();
    } else {
        header('location: ../currencies/currencies.php?currency_successfuly_deleted');
        exit();
    }
}

function queryCurrencies() 
{
    global $conn;
    $get_currencies = "SELECT * FROM currencies ORDER BY currency_name ASC";
    $result = mysqli_query($conn, $get_currencies);
    return $result;
}

function getTheCurrency() 
{
    global $conn;
    $name = $_GET['name'];
    $get_currency = "SELECT * FROM currencies WHERE currency_name='$name'";
    $result = mysqli_query($conn, $get_currency);
    return $result;
}

function getAllCurrencies() 
{
    $query = queryCurrencies();
    $i = 1;
    while ($currency = mysqli_fetch_array($query)): ?>
        <li><a href="<?php echo BASE_URL . 'currencies/currency.php?name='.$currency['currency_name']; ?>"><?php echo $currency['currency_name']; ?></a>, </li>
        <?php
        $i++;
    endwhile;    
}

function getTheCurrencyId() 
{
    $result = getTheCurrency();
    if ($id = mysqli_fetch_array($result)) {
        $currency_id = $id['id'];
        return $currency_id;
    }
}

function getTheCurrencyName()
{
    $result = getTheCurrency();
    if ($name = mysqli_fetch_array($result)) {
        $currency_name = $name['currency_name'];
        echo $currency_name;
    }
}

function getTheCurrencyNameDropDown()
{
    global $conn;
    $sql = "SELECT * FROM currencies";
    $result = mysqli_query($conn, $sql);
    $currencies = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $currencies;
}

function getJobAndCur()
{
    global $conn;
    $cur_name = $_GET['name'];
    $query = "SELECT *, jobs.id AS jid FROM jobs INNER JOIN currencies ON jobs.currency = currencies.currency_name WHERE currency = '$cur_name'";
    $result = mysqli_query($conn, $query);
    return $result;
}

// Get all Locations
function queryLocations()
{
    global $conn;
    $get_locations = "SELECT * FROM locations ORDER BY location_name ASC";
    $locations = mysqli_query($conn, $get_locations);
    return $locations;
}

function getLocId()
{
    $result = queryLocations();
    if ($l = mysqli_fetch_array($result)) {
        $loc_id = $l['loc_id'];
        return $loc_id;
    }
}

function getTheLocation()
{
    global $conn;
    $location_id = $_GET['id'];
    $get_location = "SELECT * FROM locations WHERE loc_id='$location_id'";
    if (!$get_location) {
        echo 'Could not run query: ' . mysqli_error();
        exit();
    }
    $result = mysqli_query($conn, $get_location);
    return $result;
}

function getAllLocation()
{
    $result = queryLocations();

    $i = 1;
    while ($location = mysqli_fetch_array($result)): ?>
        <li><a href="<?php echo BASE_URL . 'locations/location.php?id='.$location['loc_id']; ?>"><?php echo $location['location_name']; ?></a>, </li>
        <?php
        $i++;
    endwhile;
}

function getTheLocationName()
{
    $result = getTheLocation();
    if ($name = mysqli_fetch_array($result)) {
        $location_name = $name['location_name'];
        echo $location_name;
    }
}

function getTheLocationId()
{
    $result = getTheLocation();
    if ($id = mysqli_fetch_array($result)) {
        $location_id = $id['loc_id'];
        return $location_id;
    }
}

function getJobAndLoc()
{
    global $conn;
    $loc_id = $_GET['id'];
    $query = "SELECT * FROM jobs  WHERE loc_id = $loc_id";
    $result = mysqli_query($conn, $query);
    return $result;
}

function getTheLocationNameDropDown()
{
    global $conn;
    $sql = "SELECT * FROM locations";
    $result = mysqli_query($conn, $sql);
    $locations = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $locations;
}

function mostPopularLocations()
{
    global $conn;
    $query = "SELECT location, COUNT(*) FROM jobs GROUP BY location ORDER BY 2 DESC LIMIT 5";
    $result = mysqli_query($conn, $query);
    return $result;
}

function countUsers()
{
    global $conn;
    $query = "SELECT COUNT(*) FROM users";
    $result = mysqli_query($conn, $query);
    $all_users = mysqli_fetch_array($result);
    $total = $all_users[0];
    return $total;
}

function countJobs()
{
    global $conn;
    $query = "SELECT COUNT(*) FROM jobs";
    $result = mysqli_query($conn, $query);
    $all_jobs = mysqli_fetch_array($result);
    $total = $all_jobs[0];
    return $total;
}

function countLocations()
{
    global $conn;
    $query = "SELECT COUNT(*) FROM locations";
    $result = mysqli_query($conn, $query);
    $all_loc = mysqli_fetch_array($result);
    $total = $all_loc[0];
    return $total;
}

function latestJobs()
{
    global $conn;
    $get_jobs = "SELECT * FROM jobs ORDER BY created_at DESC LIMIT 3";
    $result = mysqli_query($conn, $get_jobs);
    return $result;
}

// Get all Jobs
function getAllJobs()
{
    global $conn;
    $get_jobs = "SELECT * FROM jobs ORDER BY created_at DESC";
    $result = mysqli_query($conn, $get_jobs);
    return $result;
}

function listAllJobs()
{
    $result = getAllJobs();    

    $i = 1;
    while ($row = mysqli_fetch_array($result)): ?>
    <li class="jobs_listing">
        <div class="jobs_listing_left">
        <a name="jobspost" href="<?php echo BASE_URL . '/jobs/jobsposts.php?id='.$row['id'].'?='.$row['job_title'].'?u_id='.$row['user_id']; ?>">
        <h4><?php echo $row['job_title']; ?></h4>
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
        <?php $i++;
        endwhile;
}

function getJob()
{
    global $conn;
    $id = $_GET['id'];
    $get_job = "SELECT * FROM jobs WHERE id='$id'";
    $result = mysqli_query($conn, $get_job);
    return $result;
}

function getJobId()
{
    $result = getJob();
    if ($id = mysqli_fetch_array($result)) {
        $job_id = $id['id'];
        return $job_id;
    }
}

function getJobUser()
{
    $result = getJob();
    if ($user_id = mysqli_fetch_array($result)) {
        $user_id = $user_id['user_id'];
        return $user_id;
    }
}

function getJobTitle()
{
    $result = getJob();
    if ($title = mysqli_fetch_array($result)) {
        $job_title = $title['job_title'];
        return $job_title;
    }
}

function getJobSalary()
{
    $result = getJob();
    if ($salary = mysqli_fetch_array($result)) {
        $job_salary = $salary['job_salary'];
        return $job_salary;
    }
}

function getJobCurrency()
{
    $result = getJob();
    if ($currency = mysqli_fetch_array($result)) {
        $job_currency = $currency['currency'];
        return $job_currency;
    }
}

function getJobDesc()
{
    $result = getJob();
    if ($desc = mysqli_fetch_array($result)) {
        $job_desc = $desc['job_description'];
        return $job_desc;
    }
}

function getJobLocation()
{
    $result = getJob();
    if ($location = mysqli_fetch_array($result)) {
        $job_location = $location['location'];
        return $job_location;
    }
}

function getLocationId()
{
    $result = getJob();
    if ($l = mysqli_fetch_array($result)) {
        $loc_id = $l['loc_id'];
        return $loc_id;
    }
}

function getJobCategory()
{
    $result = getJob();
    if ($cat = mysqli_fetch_array($result)) {
        $job_cat = $cat['category'];
        echo $job_cat;
    }
}

function getJobCatId()
{
    $result = getJob();
    if ($c = mysqli_fetch_array($result)) {
        $cat_id = $c['cat_id'];
        return $cat_id;
    }
}

function theJobUserQuery()
{
    global $conn;
    $get_job = $_GET['id'];
    $query = "SELECT * FROM jobs INNER JOIN users ON jobs.user_id = users.id WHERE jobs.id = '$get_job'";
    if (!$query) {
        echo 'Could not run query: ' . mysqli_error();
        exit();
    }
    $result = mysqli_query($conn, $query);
    return $result;
}

function getTheJobUserName()
{
    $result = theJobUserQuery();
    if ($u = mysqli_fetch_array($result)) {
        $uname = $u['username'];
        return $uname;
    }
}

function getJobUserHeadline()
{
    $result = theJobUserQuery();
    if ($h = mysqli_fetch_array($result)) {
        $uheadline = $h['user_headline'];
        return $uheadline;
    }
}

function getJobAndCat()
{
    global $conn;
    $cat_id = $_GET['id'];
    $query = "SELECT *, jobs.id AS jid FROM jobs INNER JOIN categories ON jobs.cat_id = categories.id WHERE cat_id = $cat_id";
    $result = mysqli_query($conn, $query);
    return $result;
}

function getJobToCat()
{
    $result = getJobAndCat();
    if ($c = mysqli_fetch_array($result)) {
        $job_name = $c['cat_id'];
        return $job_name;
    }
}

function getCategory()
{
    global $conn;
    $id = $_GET['id'];
    $sql = "SELECT * FROM categories WHERE cat_name = '$id'";
    $result = mysqli_query($conn, $sql);
    return $result;
}

function getCatId()
{
    $result = getCategory();
    if ($cid = mysqli_fetch_array($result)) {
        $cat_id = $cid['id'];
        return $cat_id;
    }
}

function getSimilarJob()
{
    global $conn;
    $query = "SELECT id, job_title, category, COUNT(*) FROM jobs GROUP BY category HAVING COUNT(*) > 1";
    $result = mysqli_query($conn, $query);
    return $result;
}

function getJobAndUser()
{
    global $conn;
    $user_id = $_SESSION['u_id'];
    $get_conn = "SELECT * FROM jobs WHERE user_id = $user_id";
    $result = mysqli_query($conn, $get_conn);
    return $result;
}
