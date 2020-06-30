<!-- @format -->
<?php
$type=0;
$message="";
session_start();
if (isset($_POST["submit"])) {
    include_once 'DBConnect.php';
    
    $email = $_POST['email'];
    $password = $_POST['pswd'];
    
    $database = new dbConnect();
    
    $db = $database->openConnection();
    
    $sql = "select * from users where email = '$email' and password= '$password'";
   
    $user = $db->query($sql);
    $result = $user->fetchAll();
   
    if(!empty($result)){
      $id = $result[0]['id'];
    $name = $result[0]['name'];
    $email = $result[0]['email'];
    $_SESSION['name'] = $name;
    $_SESSION['id'] = $id;
    
    $database->closeConnection();
    header('location: dashboard.php');
    }else{
      $type=1;
      $message="Wrong email or password, try again";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registration</title>
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
    />

    <link rel="stylesheet" href="reg.css" />
  </head>

  <body>
    <div class="container">
      <div class="col-8 col-sm-6 col-xl-4 col-bg-6 center">
        <div class="card">
        <?php  if($type==1): ?>
          <div class="alert alert-danger">
          <strong>Error!</strong> <?php echo $message; ?>
          </div>

        <?php endif; ?>
          <div class="card-header"><h2>Login</h2></div>
          <div class="card-body">
          <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
              <div class="form-group">
                <input
                  type="email"
                  class="form-control"
                  id="email"
                  placeholder="Enter email address"
                  name="email"
                  required
                />
              </div>

              <div class="form-group">
                <input
                  type="password"
                  class="form-control"
                  id="pwd"
                  placeholder="enter password"
                  name="pswd"
                  required
                />
              </div>

              <button type="submit" name="submit" class="btn btn-primary btn-block">
                Submit
              </button>
              <a href="/phpValidationNew/registration.php" class="btn btn-info btn-block">
                Registration
              </a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </body>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</html>
