<?php
// Read the values of the environment variables from the .env file
$env = parse_ini_file(__DIR__ . '/.env');

// Get the values of the environment variables
$host = $env['DB_HOST'];
$username = $env['DB_USERNAME'];
$password = $env['DB_PASSWORD'];
$dbname = $env['DB_NAME'];


// Create a connection to the database
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check the connection
if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}else{
    // cehk if the users  table exists if not creat one 
    $query = "SHOW TABLES LIKE 'users';";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 0) {
       $create_table_query = "
       CREATE TABLE users (
        id INT(11) NOT NULL AUTO_INCREMENT,
        name VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        password VARCHAR(255) NOT NULL,
        PRIMARY KEY (id)
      );";
       mysqli_query($conn, $create_table_query);

    }
    // cheking if the  'rank' table  exists or not if not create one;
    $query_rank_for_table_chek = "SHOW TABLES LIKE 'rank';";
    $result2 = mysqli_query($conn, $query_rank_for_table_chek);
    if (mysqli_num_rows($result2) == 0) {
        
        $create_table_query = "
        CREATE TABLE rank (
          name VARCHAR(255) NOT NULL,
          score INT(11) NOT NULL
        );";
      
       mysqli_query($conn, $create_table_query);
    }


}



?>