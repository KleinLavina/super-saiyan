<?php
class Database {
    public $connection;

    // Constructor to establish database connection
    public function __construct() {
        $this->connection = new mysqli("localhost", "root", "", "klein");

        // Check connection
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    // Method to execute a query and return results
    public function getData($sql, $params = []) {
        $stmt = $this->connection->prepare($sql);
        
        // Check if the prepare() statement was successful
        if ($stmt === false) {
            die('MySQL prepare error: ' . $this->connection->error . ' - SQL: ' . $sql);
        }
        
        if ($params) {
            $types = str_repeat('s', count($params));
            $stmt->bind_param($types, ...$params);
        }
    
        $stmt->execute();
        
        // Check if execution was successful
        if ($stmt->errno) {
            die('Execute error: ' . $stmt->error);
        }
    
        $result = $stmt->get_result();
        $stmt->close();
    
        return $result;
    }

    // Method to prepare a SQL statement with parameters
    public function prepare($sql) {
        $stmt = $this->connection->prepare($sql);

        // Check if the prepare() statement was successful
        if ($stmt === false) {
            die('MySQL prepare error: ' . $this->connection->error . ' - SQL: ' . $sql);
        }

        return $stmt;
    }

    // Method to close the database connection
    public function close() {
        $this->connection->close();
    }
}

?>
