<?php   
    class quotes {
        private $conn;
        private $table = "quotes";

        public $id;
        public $quote;
        public $categoryId;
        public $authorId;
        
        public function __construct($db) {
            $this->conn = $db;
        }

        public function read(){
            $query = 'SELECT *
                FROM ' . $this->table . ' q 
                ORDER BY
                    q.id';
            $stmt = $this->conn->prepare($query);

            $stmt->execute();

            return $stmt;

        }
        public function read_single() {
            $query = 'SELECT q.quote, q.id, q.categoryId, q.authorId 
            FROM ' . $this->table . ' q
                WHERE 
                    q.id = ?
                LIMIT 0,1';
            
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(1, $this->id);

            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->quote =  $row['quote'];
            $this->id =  $row['id'];
            $this->categoryId =  $row['categoryId'];
            $this->authorId =  $row['authorId'];
            

        }
        public function create() {
            $query = 'INSERT INTO ' . $this->table . '
                SET
                    quote = :quote,
                    authorId = :authorId,
                    categoryId = :categoryId';
            
        $stmt = $this->conn->prepare($query);

        $this->quote = htmlspecialchars(strip_tags($this->quote));
            

        $stmt->bindParam(':quote', $this->quote);
        $stmt->bindParam(':authorId', $this->authorId);
        $stmt->bindParam(':categoryId', $this->categoryId);

        if($stmt->execute()){
            return true;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;

        }
        


        public function update() {
            $query = 'UPDATE ' . $this->table . '
                SET
                    quote = :quote,
                    authorId = :authorId,
                    categoryId = :categoryId
                WHERE
                    id = :id';
            
        $stmt = $this->conn->prepare($query);

        $this->quote = htmlspecialchars(strip_tags($this->quote));
            

        $stmt->bindParam(':quote', $this->quote);
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':authorId', $this->authorId);
        $stmt->bindParam(':categoryId', $this->categoryId);

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