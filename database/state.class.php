<?php
    declare(strict_types = 1);
    
    require_once(__DIR__ . '/connection.db.php');
    
    class State{

        public int $id;
        public string $name;

        
        public function __construct(int $id, string $name){ 
            $this->id = $id;
            $this->name = $name;
        }

        static function getStatus(PDO $db) : ?array {
            $stmt = $db->prepare('SELECT * FROM State ');
            $stmt->execute();
        
            $states = array();
            while ($state_data = $stmt->fetch()) {
                $states[] = new State( intval($state_data['id']), $state_data['state']);
            }
    
            return $states;
        }

    }



?>