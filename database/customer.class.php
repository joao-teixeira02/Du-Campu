<?php
    declare(strict_types = 1);

    class Customer{
        public int $id;
        public string $username;
        public string $password;
        
        public function __construct(int $id, string $username, string $password){ 
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        }

        static function getCustomer(PDO $db, string $username) : ?Customer {
            $stmt = $db->prepare('SELECT * FROM Customer WHERE Customer.username=?');
            $stmt->execute(array($username));
        
            $customer = null;
            while ($customer_data = $stmt->fetch()) {
                $customer = new Customer(
                intval($customer_data['id']),
                $customer_data['username'],
                $customer_data['password']
                );
                
                break;
            }
    
            return $customer;
        }
    }



?>