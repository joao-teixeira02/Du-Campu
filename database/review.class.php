<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/reply.class.php');

    class Review{
        public int $id;
        public string $review;
        public int $customer_id;
        public float $points;
        public int $restaurant_id;
        public string $date;

        public function __construct(int $id, string $review, int $customer_id, float $points, int $restaurant_id, string $date){ 
        $this->id = $id;
        $this->review = $review;
        $this->customer_id = $customer_id;
        $this->points = $points;
        $this->restaurant_id = $restaurant_id;
        $this->date = $date;
        }

        function getUsername(PDO $db) : string{
            $stmt = $db->prepare('SELECT username FROM User WHERE User.id=?');
            $stmt->execute(array($this->customer_id));
            $username = $stmt->fetch();
            return $username['username'];
        }

        function getReply(PDO $db) : ?Reply {
            $stmt = $db->prepare('SELECT * FROM Reply WHERE Reply.review_id=?');
            $stmt->execute(array($this->id));

            $reply = null;

            while ($reply_data = $stmt->fetch()) {
                $reply = new Reply(
                    intval($reply_data['id']),
                    $reply_data['text'],
                    intval($reply_data['owner_id']),
                    intval($reply_data['review_id']),
                    $reply_data['date']
                );
            }

            return $reply;
        }


    }

?>