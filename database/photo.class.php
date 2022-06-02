<?php
    declare(strict_types = 1);

    class Photo{
        public int $id;
        public string $path;

        public function __construct(int $id, string $path){ 
            $this->id = $id;
            $this->path = $path;
        }

        public static function insertPhoto(PDO $db, array $file, string $photo_name) : int{
            if (!is_dir('../images')) mkdir('../images');
            if (!is_dir('../images/photos')) mkdir('../images/photos');
            
            $photo_path = '../images/photos/'.$photo_name;
            

            $stmt = $db->prepare('Select *  from Photo where path = ?');
            $stmt->execute(array($photo_path));
            
            $id = $stmt->fetch()['id'];

            move_uploaded_file($file['tmp_name'], $photo_path);
            
            if($id == null){
                $stmt = $db->prepare('INSERT INTO Photo(path) Values (?)');
                $stmt->execute(array($photo_path));

                return $db->lastInsertId();
            }

            

            return intval($id);
        }


    }


?>