<?php 
    $db_selected = mysqli_select_db($conn, "job_portal");
    if (!$db_selected) {
        header('location: index.php? cannot_connect');
        exit();
    }

    $company_name = "";
    $portfolio_id = 0;
    $portfolio_desc = "";
    $edit_portfolio = false;

    if (isset($_POST['create_portfolio'])) {
        $company_name = mysqli_real_escape_string($conn, $_POST['company_name']);
        $portfolio_desc = mysqli_real_escape_string($conn, $_POST['portfolio_description']);

        if (empty($company_name)) {
            header('location: create_portfolio.php?Name_cannot_be_empty');
            exit();
        }
        if (empty($portfolio_desc)) {
            header('location: create_portfolio.php?description_cannot_be_empty');
            exit();
        }

        $user_id = $_SESSION['u_id'];
        $insert_portfolio = "INSERT INTO portfolios (company_name, description, user_id, created_at, updated_at) VALUES ('$company_name', '$portfolio_desc', $user_id, now(), now())";
        mysqli_query($conn, $insert_portfolio);
        header('location: portfolios.php?id='.$_SESSION['u_id'].'?portfolio_created');
        exit();
    }

    if (isset($_GET['edit_portfolio'])) {
        $edit_portfolio = true;
        $id = $_GET['edit_portfolio'];

        $get_portfolio = "SELECT * FROM portfolios WHERE id = $id LIMIT 1";
        $result = mysqli_query($conn, $get_portfolio);

        $edit = mysqli_fetch_array($result);
        $company_name = $edit['company_name'];
        $portfolio_desc = $edit['description'];
    }

    if (isset($_POST['update_portfolio'])) {
        $company_name = mysqli_real_escape_string($conn, $_POST['company_name']);
        $portfolio_desc = mysqli_real_escape_string($conn, $_POST['portfolio_description']);

        if (empty($company_name)) {
            header('location: portfolios.php?name_cannot_be_empty');
            exit();
        }
        if (empty($portfolio_desc)) {
            header('location: portfolios.php?description_cannot_be_empty');
            exit();
        }

        $id = $_POST['id'];
        $update_portfolio = "UPDATE portfolios SET company_name='$company_name', description='$portfolio_desc', updated_at=now() WHERE id=$id";
        mysqli_query($conn, $update_portfolio);
        header('location: portfolios.php?portfolio_updated');
        exit();
    }

    if (isset($_GET['delete_portfolio'])) {
        $portfolio_id = $_GET['delete_portfolio'];
        $get_portfolio = "DELETE FROM portfolios WHERE id=$portfolio_id";
        if (!mysqli_query($conn, $get_portfolio)) {
            header('location: ../portfolios/portfolios.php?portfolio_was_not_deleted');
            exit();
        } 
        else {
            header('location: ../portfolios/portfolios.php?portfolio_deleted');
            exit();
        }
    }

    function queryPortfolio()
    {
        global $conn;
        $user_id = $_GET['id'];
        $get_portfolios = "SELECT * FROM portfolios WHERE user_id='$user_id'";
        $result = mysqli_query($conn, $get_portfolios);
        return $result;
    }

    function getAllPortfolio()
    {
        global $conn;
        $get_portfolios = "SELECT * FROM portfolios";
        $result = mysqli_query($conn, $get_portfolios);
        return $result;
    }

    function getTheUserPortfolio()
    {
        $result = getAllPortfolio();
        if ($id = mysqli_fetch_array($result)) {
            $user_id = $id['user_id'];
            return $user_id;
        }
    }

    function getThePortfolio()
    {
        global $conn;
        $id = $_GET['id'];
        $get_portfolio = "SELECT * FROM portfolios WHERE id ='$id'";
        $result = mysqli_query($conn, $get_portfolio);
        return $result;
    }

    function getPortfolioId()
    {
        $result = getThePortfolio();
        if ($id = mysqli_fetch_array($result)) {
            $portfolio_id = $id['id'];
            return $portfolio_id;
        }
    }
