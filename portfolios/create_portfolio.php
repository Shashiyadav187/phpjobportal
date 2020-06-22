<?php
    include '../config.php';
    include ROOT_PATH . '/includes/header.php';
    include '../functions.php';
?>

<title>CIY Jobs | Add Portfolio</title>
</head>
<body>
    <div id="main">
        <?php include ROOT_PATH . '/includes/navbar.php'; ?>
        <div class="container">
            <div class="body_container">
                <div class="form">
                    <form action="create_portfolio.php" method="post">
                        <?php if ($edit_portfolio === true): ?>
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <h2>Edit Portfolio</h2>
                            <input type="text" name="company_name" placeholder="Company Name" value="<?php echo $company_name; ?>">
                            <textarea name="portfolio_description" placeholder="Description" cols="30" rows="10"><?php echo $portfolio_desc; ?></textarea>
                            <button type="submit" name="update_portfolio" class="btn">Create Portfolio</button>
                        <?php else: ?>
                            <h2>Create Portfolio</h2>
                            <input type="text" name="company_name" placeholder="Company Name">
                            <textarea name="portfolio_description" placeholder="Description" cols="30" rows="10"></textarea>
                            <button type="submit" name="create_portfolio" class="btn">Create Portfolio</button>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include ROOT_PATH . '/includes/footer.php'; ?>