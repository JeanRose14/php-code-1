<?php
// Start PHP mode - this file only contains PHP code

// Defines the DB class, a reusable blueprint for creating database connections
class DB
{
    // Private properties: only this class can read/change them (encapsulation)
    private $host;      // Server address (hostname)
    private $user;      // MySQL username
    private $password;  // MySQL password
    private $dbname;    // Name of the database to connect to

    // Constructor: runs automatically when "new DB()" is called
    public function __construct()
    {
        // Set the connection credentials
        $this->host = "localhost";  // XAMPP MySQL runs on the local machine
        $this->user = "root";       // Default XAMPP MySQL user
        $this->password = "";       // Default XAMPP MySQL password (empty)
        $this->dbname = "rose";     // Target database name
    }

    // Creates and returns a connection to the MySQL database
    public function createConnection()
    {
        try {
            // Attempt to open a mysqli connection using the stored credentials
            $conn = new mysqli($this->host, $this->user, $this->password, $this->dbname);

            // If mysqli reports a connection error, return it as a string
            if ($conn->error) {
                return "Error: " . $conn->error;
            }

            // No error - return the live connection object to the caller
            return $conn;
        }   catch (Exception $e) {
            // If an exception is thrown, display the error message instead of crashing
            echo "Error: " . $e->getMessage();
        }
    }
}
// End of DB class