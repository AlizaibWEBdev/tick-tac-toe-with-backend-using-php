<?php
include "./db.php";

session_start();
$_SESSION['submited'] = false;
// cheking srever method if it is post adding data to database
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $name = $_POST["name"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  $confrom_password = $_POST["c-password"];
  $name = htmlspecialchars($name);
  $email = htmlspecialchars($email);
  $password = htmlspecialchars($password);

  if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {


    // echosdfj

    //validating user data


    if (empty($name) || empty($email) || empty($password)) {
      echo "<script>alert('Please fill all the fields');</script>";
      echo "<script>window.location.href = './singup.php';</script>";
      die();
    }
    if (strlen($password) < 8) {
      echo "<script>alert('Password must be atleast 8 characters');</script>";
      echo "<script>window.location.href = './singup.php';</script>";
      die();
    } else if ($password != $confrom_password) {
      echo "<script>alert('Password does not match');</script>";
      echo "<script>window.location.href = './singup.php';</script>";

      die();
    } else {
      $query = "SELECT * FROM users WHERE name='$name' OR  email='$email'";
      $result = mysqli_query($conn, $query);
      if (mysqli_num_rows($result) > 0) {
        echo '
         <script>alert("USer already exists");</script>
          ';

        echo "<script>window.location.href = './singup.php';</script>";
        die();
      } else {
        // inserting new rank value 
       $inticalScore = 0;
        $insertNewScorequery = "INSERT INTO `rank` ( name , score ) VALUES ('$name', '$inticalScore');";
        $result = mysqli_query($conn, $insertNewScorequery);
        if (!$result) {
          echo "sadfsaf";
        }
        // insert new user image 
        $filename = $_FILES['image']['name'];
        $filetype = $_FILES['image']['type'];
        $filesize = $_FILES['image']['size'];
        $filetemp = $_FILES['image']['tmp_name'];

        // Check if the file is an image with a valid extension
        $allowed_ext = array('jpg', 'jpeg', 'png', 'gif');
        $fileext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        if (in_array($fileext, $allowed_ext)) {
          // Generate a unique filename for the uploaded image
          $newfilename = $name . '.' . $fileext;
          $destination = 'uploads/' . $newfilename;

          // Move the uploaded file to its new location
          move_uploaded_file($filetemp, $destination);
        } else {

          echo '<script>
          alert("Sorry, only JPG, JPEG, PNG, and GIF files are allowed.");
          </script>';
        }
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$hash')";

        $result = mysqli_query($conn, $query);
        if ($result) {
          $_SESSION['submited'] = true;

          header("location:./login.php");

          die();
        } else {
          echo "
          <script>
          alert('Something went wrong');
          </script>
          ";
        }
      }
    }
  } else {
    echo '
    <script>
    alert("please fill all the fealds ");
    </script>
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

  <section class="vh-100 gradient-custom">
    <div class="container py-5 h-100">
      <div class="row justify-content-center align-items-center h-100">
        <div class="col-12 col-lg-9 col-xl-7">
          <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
            <div class="card-body p-4 p-md-5">
              <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">singup here </h3>
              <p>allredy have acount <a href="./login.php">login here</a></p>
              <form method="POST" action="./singup.php" enctype="multipart/form-data">

                <div class="row">
                  <div class="col-md-6 mb-4">

                    <div class="form-outline">
                      <input name="name" type="text" id="firstName" class="form-control form-control-lg" />
                      <label class="form-label" for="firstName"> Name</label>
                    </div>

                  </div>
                  <div class="col-md-6 mb-4 d-flex align-items-center">

                    <div class="form-outline datepicker w-100">
                      <input name="email" type="email" class="form-control form-control-lg" id="birthdayDate" />
                      <label for="birthdayDate" class="form-label">email</label>
                    </div>

                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6 mb-4 pb-2">

                    <div class="form-outline">
                      <input name="password" type="password" class="form-control form-control-lg" />
                      <label class="form-label" for="emailAddress">password</label>
                    </div>

                  </div>
                  <div class="col-md-6 mb-4 pb-2">

                    <div class="form-outline">
                      <input name="c-password" type="password" class="form-control form-control-lg" />
                      <label class="form-label" for="emailAddress"> confrom password</label>
                    </div>

                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6 mb-4 pb-2">

                    <div class="form-outline">
                      <input required name="image" type="file" class="form-control form-control-lg" />
                      <label class="form-label" for="emailAddress">upload profile photo </label>
                    </div>

                  </div>
                  <div class="mt-4 pt-2 mx-4">
                    <input class="btn btn-dark btn-lg" type="submit" value="Submit" />
                  </div>
                  <div class="mt-4 pt-2">
                    <button class="btn btn-danger btn-lg" type="reset"> clear </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <footer class="text-center py-3 bg-dark text-white">
    <p> copy &copy; right 2023 created Alizaib </p>
  </footer>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>