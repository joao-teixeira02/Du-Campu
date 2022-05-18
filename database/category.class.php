<?php
    declare(strict_types = 1);

    class Category{
        public int $id;
        public string $name;
        
        public function __construct(int $id, string $name){ 
            $this->id = $id;
            $this->name= $name;
        }

        static function getCategories(PDO $db) : ?array {
            $stmt = $db->prepare('SELECT * FROM Category;');
            $stmt->execute();
        
            $category = array();
            while ($category_data = $stmt->fetch()) {
                $category[] = new Category(
                intval($category_data['id']),
                $category_data['name'],
                );
            }
    
            return $category;
        }
    }



?>