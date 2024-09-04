<?php
session_start();

$host = "localhost";
$database_name = "todo_list";
$database_user = "root";
$database_password = "pass";
$database = new PDO(
    "mysql:host=$host;dbname=$database_name",
    $database_user, 
    $database_password 
  );
  $sql = "select * from todos";
  $query = $database->prepare($sql);
  $query->execute();
  $todos = $query->fetchAll();
  ?>
  <!DOCTYPE html>
<html>
  <head>
    <title>TODO App</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css"
    />
    <style type="text/css">
      body {
        background: #F1F1F1;
      }
    </style>
  </head>
  <body>
    <div
      class="card rounded shadow-sm"
      style="max-width: 500px; margin: 60px auto;"
    >
      <div class="card-body">
        <?php if ( isset( $_SESSION['user'] ) ) : ?>
          <h4>Welcome back, <?= $_SESSION['user']['name']; ?></h4>
        <h3 class="card-title mb-3">My Todo List</h3>
        <a href="logout.php">Logout</a>
        <ul class="list-group">
        <?php foreach ($todos as $index => $todo) : ?>
          <li class="list-group-item d-flex justify-content-between align-items-center">
     <div>
        <form method="POST" action="update.php">
        <input type="hidden" name="todo_id" value="<?= $todo["id"]; ?>" />
        <input type="hidden" name="completed" value="<?= $todo['completed']; ?>" />
        <?php if ( $todo['completed'] == 1 ) : ?>
          <button class="btn btn-sm btn-success">
              <i class="bi bi-check-square"></i>
          </button>
          <span class="ms-2"><?= $todo['label']; ?></span>
      <?php else : ?>
          <button class="btn btn-sm btn-light">
              <i class="bi bi-square"></i>
          </button>
          <span class="ms-2"><?= $todo['label']; ?></span>
      <?php endif; ?>
  </form>
  </div>
  <div>
    <form action="delete.php" method="POST">
      <input type="hidden" name="todo_id" value="<?= $todo["id"]; ?>" />
      <button class="btn btn-sm btn-danger">
        <i class="bi bi-trash"></i>
      </button>
    </form>
  </div>
</li>
        <?php endforeach; ?>
        </ul>
        <div class="mt-4">
          <form class="d-flex justify-content-between align-items-center" method="POST" action="addtodo.php">
            <input
              type="text"
              class="form-control"
              placeholder="Add new item..."
               name="todo_label"
            />
            <button class="btn btn-primary btn-sm rounded ms-2">Add</button>
          </form>
        </div>
        <?php else : ?>
          <p>Please login to continue</p>
          <a href="login.php">Login</a>
          <a href="signup.php">Sign Up</a>
        <?php endif; ?>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>