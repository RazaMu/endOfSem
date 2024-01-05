<?php
// Include the constants file
require_once 'constants.php'; // Ensure this matches the actual file name

class Database {
    private $connection;

    public function __construct() {
        // Create a connection to the MySQL database
        $this->connection = new mysqli(HOST_NAME, DATABASE_USER, PASSWORD, DATABASE_NAME);

        // Check the connection
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    public function getConnection() {
        return $this->connection;
    }


}

?>
