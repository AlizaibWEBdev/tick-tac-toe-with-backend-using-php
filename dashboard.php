<?php
// cheking session for user that if user is logged in or not if not then again redirecting to login 
include "./db.php";
session_start();

if (!isset($_SESSION['login']) || $_SESSION['login'] == false) {
  header("Location:login.php");
}


?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <title>Hello, world!</title>
</head>
<style>
  .profile img{
    width:45px;
    height:45px;
    border-radius: 100px;
  }
</style>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#"><?php echo$_SESSION['name']?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">

        <li class="nav-item">
          <a class="nav-link" href="./index.php">game</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./logout.php">logout</a>
        </li>

      </ul>
    </div>
  </nav>

  <table class="table">
    <thead>
      <tr>
        <th scope="col">profile</th>
        <th scope="col">name</th>
        <th scope="col">rank</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $query = "
          SELECT name, score
          FROM rank
          ORDER BY score DESC
          LIMIT 20;";
      $result = mysqli_query($conn, $query);
      while ($row = mysqli_fetch_assoc($result)) {
        $nname = $row['name'];
        $score = $row['score'];
        $allowed_ext = array('jpg', 'jpeg', 'png', 'gif');
         $src = "";
        foreach ($allowed_ext as $key => $value) {
          if (file_exists("./uploads/$nname" . "." . "$value")) {$src = "./uploads/$nname" . "." . "$value";}
        }
        echo "
            <tr>
        <td class='profile'><img src='$src' alt='image of $nname'></td>
        <td>$nname</td>
        <td>$score</td>
          </tr>
              ";
      }

      ?>
    </tbody>
  </table>
  <footer class="text-center py-3 bg-dark text-white" style="position: absolute;bottom: 0;width:100vw;">
    <p> copy &copy; right 2023 created Alizaib </p>
  </footer>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>