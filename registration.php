<!-- @format -->
<?php
$type=-1;
$message="";
if (isset($_POST["submit"])) {
    include_once 'DBConnect.php';
    
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pswd = $_POST['pswd'];
    $dob = $_POST['dob'];
    $phoneNo = $_POST['phoneNo'];


    
    $database = new dbConnect();
    
    $db = $database->openConnection();
    $sql1 = "select name, email from users where email='$email'";
    
    $user = $db->query($sql1);
    $result = $user->fetchAll();
  
   
    if (empty($result)) {
        $sql = "insert into users (name,email, password,dob,mobile) values('$name','$email','$pswd','$dob','$phoneNo')";
        
        $db->exec($sql);
        
        $database->closeConnection();
        $type=0;
        $message="Registration Successful";
        $response = array(
            "type" => "success",
            "message" => "You have registered successfully.<br/><a href='login.php'>Now Login</a>."
        );
    } else {
      $type=1;
      $message="Email Already used";
        $response = array(
            "type" => "error",
            "message" => "Email already in use."
        );
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
        <?php if($type==0):?>
        <div class="alert alert-success">
        <strong>Success!</strong> <?php echo $message; ?>
        </div>
        <?php  elseif($type==1): ?>
          <div class="alert alert-warning">
          <strong>Warning!</strong> <?php echo $message; ?>
          </div>

        <?php endif; ?>
          <div class="card-header"><h3>Registration</h3></div>
          <div class="card-body">
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
              <div class="form-group">
                <input
                  type="text"
                  class="form-control"
                  id="name"
                  placeholder="Enter Name"
                  name="name"
                  required
                />
              </div>
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
                  type="tel"
                  class="form-control"
                  id="phoneNo"
                  placeholder="mobile number"
                  pattern="[0][1][0-9]{9}"
                  name="phoneNo"
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
                  minlength="6"
                  required
                />
              </div>

              <div class="form-group">
                <input
                  type="date"
                  class="form-control"
                  id="dob"
                  placeholder="Date OF Birth"
                  name="dob"
                  required
                />
              </div>

              <button type="submit" name="submit" class="btn btn-primary btn-block">
                Submit
              </button>
              <a  href="/phpValidationNew/login.php" class="btn btn-info btn-block">
                Log In
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
