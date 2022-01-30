<?php
// if(isset($_POST['SUBMIT'])){
//   $file = $_FILES['file'];

//   $fileName = $_FILES['file']['name'];
//   $fileTmpName = $_FILES['file']['tmpname'];
//   $fileSize = $_FILES['file']['size'];
//   $fileError = $_FILES['file']['error'];
//   $fileType = $_FILES['file']['type'];

//   $fileExt = explode('.',$fileName);
//   $fileActualExt = strtolower(end($fileExt));

//   // this file type is allowd 
//   $allowed = array('pdf','jpg');

//   if(in_array($fileActualExt , $allowed)){
//     if($fileError === 0){
//        if($fileSize < 300000){
//          $fileNameNew = uniqid('',true).".".$fileActualExt;
//         //  $fileDestination = 'upload/'.$fileNameNew;
//         //  move_uploaded_file($fileTmpName,$fileDestination);
//         //  header("location:task.php?uploadsuccess");
//        }
//        else{
//          echo"your file size is too big";
//        }
//     }
//     else{
//       echo"there was an error while uploading a file";
//     }

//   }
//   else{
//     echo"you cannot upload files of this type,only PDF file format is allowed!";
//   }
// }
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link href="https://fonts.googleapis.com/css2?family=Baloo+Bhai+2:wght@400;500;600&family=Baloo+Bhaijaan+2:wght@700&family=Dancing+Script&family=Fira+Sans:ital,wght@0,100;1,100&family=Irish+Grover&family=Kanit:wght@300&family=Lato:ital,wght@0,100;1,400&family=Libre+Baskerville:wght@700&family=Lobster&family=Lora:ital,wght@1,600&family=Merriweather:ital,wght@1,700&family=Murecho:wght@300&family=Oswald:wght@200&family=PT+Serif:ital,wght@1,700&family=Roboto+Slab:wght@800&family=Shippori+Antique&family=Ubuntu:ital,wght@0,300;1,500&family=Yanone+Kaffeesatz&display=swap" rel="stylesheet">

    <title>Employer.com</title>
    <style>
        #nameweb{
            color: rgb(200, 56, 200);
            font-weight: 500;
        }
        h2{
          display:flex;
          justify-content:center;
          font-family: 'Merriweather', serif;
        }
        .name-grp{
          display: flex;
          flex-direction: row;
        }
        #firstname{
          margin-right:7px;
        }
        #lastname{
          margin-left:7px;
        }
        .fileselect{
          display: flex;
          flex-direction: column;
          margin-top: 10px;
          margin-bottom: 10px;
        }
        #file{
          cursor: pointer;
        }
        #submitbtn{
          display: block;
          margin: auto;
        }
    </style>
  </head>
  
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
            tasks
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            
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
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $quality = $_POST['quality'];
  $email = $_POST['email'];
  // $file = $_POST['file'];
  $worksample = $_POST['worksample'];

 //connecting to the database
 $servername = "localhost";
 $username = "root";
 $password = "";
 $database = "employee";

 // create a connection 
 $conn = mysqli_connect($servername,$username,$password,$database);
 if(!$conn){
   die("Sorry we failed to connect: ". mysqli_connect_error());
 }
 else{ 
   // Submit these to a database
   // Sql query to be executed 
   $sql = "INSERT INTO `employeetask` (`firstname`, `lastname`, `email`,`quality`,`worksample`) VALUES ('$firstname', '$lastname', '$email','$quality','$worksample')";
   $result = mysqli_query($conn, $sql);

   if($result){
      $insert = true;
   }
   else{
     echo"please make sure that you are eligible for task or not!!";
   }

 }
}  
?>

<?php
   if($insert){
    echo"<div class='alert alert-success' role='alert'>
    <strong>Success!!.. Dear Employer '$firstname' your task is submitted successfully!!!!.....</strong>...click <button type='button' class='btn btn-link' id='destinationpage'>here</button>to confirm
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  </div>";
   }
   else{
     echo"<div class='alert alert-warning alert-dismissible fade show' role='alert'>
    <strong>oops!,currently we are allowing only first 10 serial numbers,we will contact you soon..!</strong> You should check your eligibilty and try again .
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  </div>";
   }
 
?>

<div class="container">
    <h2>Task Management Page</h2>
    
<form action="task.php" method="post">
  
 <div class="name-grp">
 <div class="col-md-6">
    <label for="name" class="form-label">firstname</label>
    <input type="name" class="form-control" id="firstname" name="firstname" aria-describedby="name">
    
  </div>
  <div class="col-md-6">
    <label for="name" class="form-label">lastname</label>
    <input type="name" class="form-control" id="lastname" name="lastname" aria-describedby="name">
    
  </div>
 </div>
  
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>
  
  <select class="form-select" id="quality" name="quality" aria-label="Default select example">
    <option selected>select the speciality</option>
    <option value="web developer">web developer</option>
    <option value="full stack developer">full stack developer</option>
    <option value="app developer">app developer</option>
  </select>

  <!-- <div class="fileselect">
    <label for="filename">Upload your Resume here(PDF file only:)</label>
    <input type="file" name="file" id="file">
  </div> -->

  <div class="work">
    <label for="work">Upload your work samples here with short notes:</label>
    <textarea name="worksample" id="worksample" cols="150" rows="7"></textarea>
  </div>
  
  <button type="submit" class="btn btn-primary" id="submitbtn">Submit</button>
</form>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    
    <script>
      

      alert("this is the task page,please check your task submission eligibilty first");
       let srnumber = prompt("what is the serial number assigned?");
       console.log(srnumber);
       
       let eligibilty = true; 

       if(srnumber<10){
           console.log("you are eligible for task submission");
       }
       else{
         console.log("sorry,currently you are not eligible for task submission");
       }

       let my_url_tasksubmission = "tasksubmit.php";
        document.getElementById("destinationpage").onclick = function(){
          window.location.replace(my_url_tasksubmission)
        }
    </script>
  
  </body>
</html>