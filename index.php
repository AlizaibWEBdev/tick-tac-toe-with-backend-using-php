<?php
// cheking session for user that if user is logged in or not if not then again redirecting to login 

session_start();

if(!isset($_SESSION['login']) || $_SESSION['login']==false){
 header("Location:login.php");
}else{
$name = $_SESSION['name'];

  
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
      td{
    border: 2px solid #333;
    height: 100px;
    width: 100px;
    text-align: center;
    vertical-align: middle;
    font-family: Verdana, Geneva, Tahoma, sans-serif;
    font-size: 70px;
    cursor: pointer;    
}

table{
    border-collapse: collapse;
    position: relative;
    left: 50%;
    margin-left: -155px;
    top: 50px;
}

table tr:first-child td{
    border-top: 0;

}

table tr:last-child td {
    border-bottom: 0;

}

table tr td:first-child {
    border-left: 0;

}

table tr td:last-child {
    border-right: 0;

}

.endgame{
    display: none;
    width: 200px;
    top:130px;
    background-color: rgba(0, 6, 27, 0.704);
    position: absolute;
    left: 50%;
    margin-left: -100px;
    padding-top: 50px;
    padding-bottom: 50px;
    text-align: center;
    color: white;
    font-size: 2em;
}
/* making butifull button */
.endgame button{
  width: 120px;
  height: 40px;
    background-color: rgb(0, 50, 135);
    color: white;
    font-size: 20px;
    font-weight: bold;
    border-radius: 3px;
  

  border: none;

}
body{
  overflow: hidden;
}
  </style>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#"> <b>
        <?php  echo$name . " ". " vs" . " Ai" ?>
        </b></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
           
            <li class="nav-item">
              <a class="nav-link" href="./dashboard.php">Dashboard</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./logout.php">logout</a>
            </li>
           
          </ul>
         
        </div>
      </nav>
      
      <br>
      <h1 style="position: absolute;right:80px;font-size: 20px;" id="score"></h1>
      <table>
        
          <tr>
              <td class="cell" id="0"></td>
              <td class="cell" id="1"></td>
              <td class="cell" id="2"></td>
          </tr>
          <tr>
              <td class="cell" id="3"></td>
              <td class="cell" id="4"></td>
              <td class="cell" id="5"></td>
          </tr>
          <tr>
              <td class="cell" id="6"></td>
              <td class="cell" id="7"></td>
              <td class="cell" id="8"></td>
          </tr>
      </table>
      <br>
      <div class="endgame">
              <div class="text"></div>
              <button onclick="startGame()">Restart</button>
      </div>
      <footer class="text-center py-3 bg-dark text-white" style="position: absolute; bottom: 0px; width: 100vw;">
        <p> copy &copy; right 2023 created Alizaib </p>
      </footer>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="game.js"></script>
  </body>
</html>
   
