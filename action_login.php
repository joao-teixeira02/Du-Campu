<?php
    declare(strict_types = 1);
    session_start();

    require_once('user_session.php');
    require_once('database/connection.db.php');
    require_once('database/customer.class.php');

    function validateLogin(string $username, string $password) : bool{
        $db = getDatabaseConnection();

        $customer = Customer::getCustomer($db, $username);

        print_r($customer);
        if($customer === null){
            return false;
        }

        return $customer->{password} === $password;
    }


    // validate login
    if (isset($_GET['u']) && isset($_GET['p'])){
        if(validateLogin($_GET['u'], $_GET['p'])){
            $_SESSION["username"] = $_GET['u'];
        }
    }

    //header('Location: ' . $_SERVER['HTTP_REFERER']);
?>