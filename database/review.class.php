<?php
    declare(strict_types = 1);

    class Review{
        public int $id;
        public string $review;
        public int $customer_id;
        public float $points;
        public int $restaurant_id;

        public function __construct(int $id, string $review, int $customer_id, float $points, int $restaurant_id){ 
        $this->id = $id;
        $this->review = $review;
        $this->customer_id = $customer_id;
        $this->points = $points;
        $this->restaurant_id = $restaurant_id;
        }

        function getUsername(PDO $db) : string{
            $stmt = $db->prepare('SELECT username FROM User WHERE User.id=?');
            $stmt->execute(array($this->customer_id));
            $username = $stmt->fetch();
            return $username['username'];
        }

    }

?>