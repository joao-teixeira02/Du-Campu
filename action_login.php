<?php
    declare(strict_types = 1);
    require_once('utils/session.php');
    require_once('database/connection.db.php');
    require_once('database/customer.class.php');

    $session = new Session();

    function validateLogin(string $username, string $password) : bool{
        $db = getDatabaseConnection();

        $customer = Customer::getCustomer($db, $username);

        print_r($customer);
        if($customer === null){
            return false;
        }

        return $customer->password === $password;
    }


    // validate login
    if (isset($_GET['u']) && isset($_GET['p'])){
        if(validateLogin($_GET['u'], $_GET['p'])){
            $session->setUsername($_GET['u']);
            header('Location: ' . "index.php");
            exit();
        }
    }

    header('Location: ' . $_SERVER['HTTP_REFERER']);
?>