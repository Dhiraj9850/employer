 <!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Employer.com</title>
  </head>
  <style>
      .container{
          margin-top: 20px;
      }
      .btn-close{
          float:right;
      }
      #nameweb{
        color: rgb(200, 56, 200);
        font-weight: 500;
      }
      h2{
        display:flex;
        justify-content:center;
      }
      #li-1,#li-2{
        background-color: rgb(32, 32, 31);
        color: white;
      }
      #profilebtn{
              margin-left: 10px;
      }
      #loginbtn{
              display:block;
              margin:auto;
              width:10%;
      }
  </style>
  <body>
  
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#" id="nameweb">Employee.com</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">about</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            services
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" id="li-1" href="#">HR help</a></li>
            <li><a class="dropdown-item" id="li-2" href="#">manage teamwork</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link">Contact</a>
        </li>
      </ul>
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success mx-2" type="submit">Search</button>
      </form>
      <button type="button" class="btn btn-success ">sign up</button>
    </div>
  </div>
</nav>

<?php
$insert = false;
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        
      
      // Connecting to the Database
      $servername = "localhost";
      $username = "root";
      $password = "";
      $database = "employee";

      // Create a connection
      $conn = mysqli_connect($servername, $username, $password, $database);
      // Die if connection was not successful
      if (!$conn){
          die("Sorry we failed to connect: ". mysqli_connect_error());
      }
      else{ 
        // Submit these to a database
        // Sql query to be executed 
        $sql = "INSERT INTO `login` (`name`, `email`, `password`) VALUES ('$name', '$email', '$password')";
        $result = mysqli_query($conn, $sql);
 
        if($result){
           $insert = true;
        }
        else{
          echo"login failed";
        }

     
      }
    }
       

 ?>
 <?php
       if($insert){
        echo"<div class='alert alert-success' role='alert'>
        <strong>Success!!..Employer '$name'logged in successfully!!!!.....</strong>...click on profile button to redirect the home page<button type='button' class='btn btn-secondary' id='profilebtn'>profile</button>
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
      }
 ?>
 <div class="container">
    <h2>Employee.com-login page</h2>
    <form action="index.php" method="post">
    <div class="mb-3">
        <label for="name">Enter Employer name:</label>
        <input type="name" name="name" class="form-control" id="name" aria-describedby="nameHelp" required> 
        
        </div>
        <div class="mb-3">
        <label for="email">Email</label>
        <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" required> 
          <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name = "password" required>
          <div id="passHelp" class="form-text">enter Valid password</div>
        </div>
       
        <button type="submit" class="btn btn-success" id="loginbtn">login</button>
      </form>
</div>
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  <script>
        let my_url_home = "home.php";
        document.getElementById("profilebtn").onclick = function(){
          window.location.replace(my_url_home)
        }
  </script>
    
  </body>
</html>