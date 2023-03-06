<?php
class authors {
        private $conn;
        private $table = "authors";

        public $id;
        public $author;
        
        public function __construct($db) {
            $this->conn = $db;
        }

        public function read(){
            $query = 'SELECT *
                FROM ' . $this->table . ' a 
                ORDER BY
                    a.id';
            $stmt = $this->conn->prepare($query);

            $stmt->execute();

            return $stmt;

        }
        public function read_single() {
            $query = 'SELECT a.author, a.id 
            FROM ' . $this->table . ' a
                WHERE 
                    a.id = ?
                LIMIT 0,1';
            
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(1, $this->id);

            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->id =  $row['id'];
            $this->author =  $row['author'];
            
            

        }
        public function create() {
            $query = 'INSERT INTO ' . $this->table . '
                SET
                    author = :author';
            
        $stmt = $this->conn->prepare($query);

        $this->author = htmlspecialchars(strip_tags($this->author));
            

        $stmt->bindParam(':author', $this->author);
        

        if($stmt->execute()){
            return true;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;

        }
        


        public function update() {
            $query = 'UPDATE ' . $this->table . '
                SET
                    author = :author
                WHERE
                    id = :id';
            
        $stmt = $this->conn->prepare($query);

        $this->author = htmlspecialchars(strip_tags($this->author));
            

        $stmt->bindParam(':author', $this->author);
        $stmt->bindParam(':id', $this->id);
        

        if($stmt->execute()){
            return true;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;

        }

        public function delete(){
            $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
            
            $stmt = $this->conn->prepare($query);
            
            $stmt->bindParam(':id', $this->id);

            if($stmt->execute()){
                return true;
            }
            printf("Error: %s.\n", $stmt->error);
            return false;
    

        }
    }