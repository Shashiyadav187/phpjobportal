<?php
$db_selected = mysqli_select_db($conn, "job_portal");
if (!$db_selected) {
    header('location: index.php?cannot_connect');
    exit('Cannot connect to the database');
}

$cat_name = "";
$cat_id = 0;
$errors = "";
$edit_cat = false;

if (isset($_POST['add_category'])) {
    $cat_name = mysqli_real_escape_string($conn, $_POST['cat_name']);
    $cat_slug = makeSlug($cat_name);

    if (empty($cat_name)) {
        $errors = "Field cannot be empty";
        header('location: create_category.php?=field=is=empty');
        exit();
    } else {
        $cat_check_query = "SELECT * FROM categories WHERE cat_name='$cat_name' LIMIT 1";
        $result = mysqli_query($conn, $cat_check_query);
    }
    if (mysqli_num_rows($result) > 0) {
        $errors = "Category already exists";
        header('location: create_category.php?=category=already=exists');
        exit();
    } else {
        $insert_cat = "INSERT INTO categories (cat_name, slug, created_at, updated_at) VALUES ('$cat_name', '$cat_slug', now(), now())";    
        mysqli_query($conn, $insert_cat);
        header('location: create_category.php?=category=created=successfully');
    }
}

if (isset($_GET['edit'])) {
    $edit_cat = true;
    $id = $_GET['edit'];

    $get_cat = "SELECT * FROM categories WHERE id = $id LIMIT 1";
    
    $result = mysqli_query($conn, $get_cat);

    $edit = mysqli_fetch_array($result);
    $cat_name = $edit['cat_name'];
    
}

if (isset($_POST['update_cat'])) {
    $cat_name = mysqli_real_escape_string($conn, $_POST['cat_name']);
    if (empty($cat_name)) {
        $errors = "Fields cannot be empty";
        header('location: create_category.php?nope_field_cannot_be_empty');
        exit();
    } else {
        $id = $_POST['id'];
        $update_cat = "UPDATE categories SET cat_name='$cat_name', updated_at=now() WHERE id=$id";
        mysqli_query($conn, $update_cat);
        header('location: index.php?category_created_successfully');
    }
}

if (isset($_GET['delete_cat'])) {
    $cat_id = $_GET['delete_cat'];
    $get_cat = "DELETE FROM categories WHERE id=$cat_id";
    if (!mysqli_query($conn, $get_cat)) {
        header('location: index.php?category_was_not_deleted');
    } else {
        header('location: index.php?category_deleted');
        exit();
    }
}

function queryCategories()
{
    global $conn;
    $get_categories = "SELECT * FROM categories ORDER BY cat_name ASC";
    $result = mysqli_query($conn, $get_categories);
    return $result;
}

function getTheCategory()
{
    global $conn;
    $id = $_GET['id'];
    $get_cat = "SELECT * FROM categories WHERE id='$id'";
    $result = mysqli_query($conn, $get_cat);
    return $result;
}

function getAllCategories()
{
    $result = queryCategories();
    $i = 1;
    while ($cat = mysqli_fetch_array($result)): ?>
        <li><a href="<?php echo BASE_URL . 'categories/category.php?id='.$cat['id']; ?>"><?php echo $cat['cat_name']. ','; ?></a></li>
        <?php 
        $i++;
    endwhile;
}

function getTheCatId()
{
    $result = getTheCategory();
    if ($id = mysqli_fetch_array($result)) {
        $cat_id = $id['id'];
        return $cat_id;
    }
}

function getTheCategoryName()
{
    $result = getTheCategory();
    if ($name = mysqli_fetch_array($result)) {
        $cat_name = $name['cat_name'];
        return $cat_name;
    }
}

function getTheCategoryNameDropDown()
{
    global $conn;
    $sql = "SELECT * FROM categories";
    $result = mysqli_query($conn, $sql);
    $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $categories;
}


