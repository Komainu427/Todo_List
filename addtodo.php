<?php
$host = "localhost";
$database_name = "todo_list";
$database_user = "root";
$database_password = "pass";
$database = new PDO(
    "mysql:host=$host;dbname=$database_name",
    $database_user, 
    $database_password 
  );
  $label = $_POST["todo_label"];
// 1. check whether the user insert a name
if ( empty( $label ) ) {
    echo "Please insert a label";
} else {
    // 2. add the student name to database
    // 2.1 (recipe)
    $sql = 'INSERT INTO todos (`label`) VALUES (:label)';
    // 2.2 (prepare)
    $query = $database->prepare( $sql );
    // 2.3 (execute)
    $query->execute([
        'label' => $label
    ]);
    // 3. redirect the user back to index.php
    header("Location: index.php");
    exit;
}
?>