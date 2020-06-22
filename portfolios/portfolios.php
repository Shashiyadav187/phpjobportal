<?php 
    include '../config.php';
    include ROOT_PATH . '/includes/header.php';
    include '../functions.php';
?>

<title>CIY Jobs | <?php echo getUserName(); ?> portfolio</title>
</head>
<body>
    <div id="main">
        <?php include ROOT_PATH . '/includes/navbar.php'; ?>
        <div class="container">
            <div class="body_container">
                <h2 class="header_h2">Portfolio</h2>
                <?php if (!$portfolios = queryPortfolio()): ?>
                    <h2>No portfolios</h2>
                <?php else: ?>    
                <ul class="ul_container">
                    <?php 
                        $portfolios = queryPortfolio();
                        $i = 1;
                        while ($row = mysqli_fetch_array($portfolios)):
                    ?>
                    <li class="li_container">
                        <h4 class="header_h4"><?php echo $row['company_name']; ?></h4>
                        <p class="li_paragraph"><?php echo $row['description']; ?></p>
                    </li>
                    <?php 
                        $i++;
                        endwhile;
                    ?>    
                </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php include ROOT_PATH . '/includes/footer.php';
