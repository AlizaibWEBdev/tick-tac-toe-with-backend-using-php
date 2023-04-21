<?php
session_start();
include "./db.php";

if (isset($_SESSION["submited"]) && $_SESSION['submited'] == true) {
  echo '
  <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Congratulations</strong> your acount hase been added created you can login here 
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
 </div> 
  
  ';
$_SESSION["submited"] = false;

}

// cheking if user have make the post request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // geting name or email and  password from post 
  $name = $_POST['name-emial'];
  $email = $_POST['name-emial'];
  $userpassword = $_POST['password'];

  // cheking if name and password are correct that in database 
  $chekquery = "SELECT * FROM users WHERE name='$name' or email='$email'";
  $result = mysqli_query($conn,$chekquery);
  if (mysqli_num_rows($result) > 0) {
    //  geting data from database using assoc 
    while ($row = mysqli_fetch_assoc($result)){
      $id = $row['id'];
      $name = $row['name'];
      $email = $row['email'];
      $hashPassowrd = $row['password'];
    }
    // cheking if password is correct that in database then seeting user in session  
    if(password_verify($userpassword, $hashPassowrd)){
        $_SESSION['id'] = $id;
        $_SESSION['name'] = $name;
        $_SESSION['login'] = true;
        header("Location:index.php");
    }else{
      echo '
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Oop! password dose not match </strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>
    ';
    }


  }else{
    echo '
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Oops! There is no user with that name or email</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>
    ';
  }
  
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
  <body>
    <!-- <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Holy guacamole!</strong> You should check in on some of those fields below.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> -->
    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
          <div class="row justify-content-center align-items-center h-100">
            <div class="col-12 col-lg-9 col-xl-7">
              <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                <div class="card-body p-4 p-md-5">
                  <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">login here </h3>
                  <p>no have acount <a href="./singup.php">singup here</a></p>
                  <form action="./login.php" method="POST">
                    <div class="row">
                      <div class="col-md-6 mb-4 pb-2">
      
                        <div class="form-outline">
                          <input  name="name-emial" type="text" id="emailAddress" class="form-control form-control-lg" />
                          <label class="form-label" for="emailAddress">password</label>
                        </div>
      
                      </div>
                      <div class="col-md-6 mb-4 pb-2">
      
                        <div class="form-outline">
                          <input  name="password" type="password" id="emailAddress" class="form-control form-control-lg" />
                          
                          <label class="form-label" for="emailAddress"> confrom password</label>
                        </div>
      
                      </div>
                    </div>
      
                    <div class="mt-4 pt-2">
                      <input class="btn btn-dark btn-lg" type="submit" value="Submit" />
                    </div>
      
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <script>
        
      </script>
      <footer class="text-center py-3 bg-dark text-white">
        <p> copy &copy; right 2023 created Alizaib </p>
      </footer>
      
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
   
