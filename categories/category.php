<?php 
    include '../config.php';
    include ROOT_PATH . '/includes/header.php';
    include '../functions.php';
?>

<title>CIY Jobs | Category Name</title>
</head>
<body>
    <div id="main">
        <!-- Navbar -->
        <?php include ROOT_PATH . '/includes/navbar.php'; ?>
        <!-- Content -->
        <div class="container">
            <div class="body_container">
                <div class="search">
                    <div class="search_form">
                        <form action="search.php" method="get">
                            <input type="search" name="search_category" placeholder="Search Category">
                        <button type="submit" class="search_button" name="search_cat">Search</button>
                        </form>
                    </div>
                </div>
                <section class="category">
                    <h2>All jobs in "<?php echo getTheCategoryName(); ?>"</h2>
                    <?php if (isset($_SESSION['u_id']) && $_SESSION['u_role'] == 'Admin'): ?>
                        <a href="create_category.php?edit=<?php echo getTheCatId(); ?>" class="btn">Edit Category</a>
                        <a href="index.php?delete_cat=<?php echo getTheCatId(); ?>" class="btn">Delete Category</a>
                    <?php endif; ?>
                    <div class="category_list">
                        <ul>
                            <?php  
                                $jobs = getJobAndCat();
                                $i = 1;
                                while ($row = mysqli_fetch_array($jobs)):
                            ?>
                            <li><a href="<?php echo BASE_URL . 'jobs/jobsposts.php?id='.$row['jid']; ?>"><?php echo $row['job_title']; ?>, </a></li>
                            <?php  
                                $i++;
                                endwhile;
                            ?>
                        </ul>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <?php include ROOT_PATH . '/includes/footer.php'; ?>