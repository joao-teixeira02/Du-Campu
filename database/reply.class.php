<?php
    declare(strict_types = 1);

    class Reply{
        public int $id;
        public string $text;
        public int $owner_id;
        public int $review_id;

        public function __construct(int $id, string $text, int $owner_id, int $review_id){ 
        $this->id = $id;
        $this->text = $text;
        $this->owner_id = $owner_id;
        $this->review_id = $review_id;
        }

        function getUsername(PDO $db) : string{
            $stmt = $db->prepare('SELECT username FROM User WHERE User.id=?');
            $stmt->execute(array($this->owner_id));
            $username = $stmt->fetch();
            return $username['username'];
        }

    }

?>