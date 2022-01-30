<?php
$insert = false;
$update = false;
$delete = false;

// connect to the database
$servername = "localhost";
$username = "root";
$password = ""; 
$database = "employee";

// create a connection 
$conn = mysqli_connect($servername,$username,$password,$database);
if (!$conn){
  die("Sorry we failed to connect: ". mysqli_connect_error());
}
if(isset($_GET['delete'])){
  $sno = $_GET['delete'];
  $delete = true;
  $sql = "DELETE FROM `employeelist` WHERE `sno` = $sno";
  $result = mysqli_query($conn, $sql);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  if(isset($_POST['snoEdit'])){
    // update the record 
    $sno = $_POST['snoEdit'];
    $firstname = $_POST['firstnameEdit'];
    $lastname = $_POST['lastnameEdit'];
    $email = $_POST['emailEdit'];
    $employeeid = $_POST['employeeidEdit'];
  
     // Sql query to be executed ----UPDATE
     $sql = "UPDATE `employeelist` SET `firstname` = '$firstname',`lastname` = '$lastname',`email` = '$email',`employeeid` = '$employeeid' WHERE `employeelist`.`sno` = $sno";
     $result = mysqli_query($conn, $sql);
     if($result){
      $update = true;
    }
    else{
      echo"the record has not inserted";
    }
  }
  else{ 
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $email = $_POST['email'];
  $employeeid = $_POST['employeeid'];

   // Sql query to be executed ----INSERT
   $sql = "INSERT INTO `employeelist` (`firstname`, `lastname`, `email`,`employeeid`) VALUES ('$firstname', '$lastname', '$email','$employeeid')";
   $result = mysqli_query($conn, $sql);
   
   if($result){
     $insert = true;
   }
   else{
     echo"the record has not inserted";
   }
  }
}

?>
<!doctype html>
<html lang="en">
  <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href="//cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">

    

    <link href="https://fonts.googleapis.com/css2?family=Baloo+Bhai+2:wght@400;500;600&family=Baloo+Bhaijaan+2:wght@700&family=Dancing+Script&family=Fira+Sans:ital,wght@0,100;1,100&family=Irish+Grover&family=Kanit:wght@300&family=Lato:ital,wght@0,100;1,400&family=Libre+Baskerville:wght@700&family=Lobster&family=Lora:ital,wght@1,600&family=Oswald:wght@200&family=PT+Serif:ital,wght@1,700&family=Roboto+Slab:wght@800&family=Shippori+Antique&family=Ubuntu:ital,wght@0,300;1,500&family=Yanone+Kaffeesatz&display=swap" rel="stylesheet">
    <title>Employee.com-Home</title>

   
  </head>
  <style>
      #nameweb{
        color: rgb(200, 56, 200);
        font-weight: 500;
      }
      .image img{
        height: 900px;
        width:100%;
      }
      body{
        margin: 0;
        padding: 0;
        background: url('img/bg.jpg')no-repeat center center;
        background-size: cover;
        height: 800px;
      }
      h2{
        color: rgb(47, 44, 44);
        display: flex;
        justify-content: center;
        margin-top:20px;
        font-family: 'Baloo Bhai 2', cursive;
      
      }
      #firstname{
        margin-right: 10px;
        background: none;
        border: 2px solid rgb(170, 166, 159);
      }
      #lastname{
        margin-left: 10px;
        background: none;
        border: 2px solid rgb(170, 166, 159);
      }
      .name-grp , .email-grp{
        display: flex;
        flex-direction: row;
      }
      #email{
        margin-right: 10px;
        background:none ;
        border: 2px solid rgb(170, 166, 159);
      }
      #employeeid{
        margin-left: 10px;
        background: none;
        border: 2px solid rgb(170, 166, 159);
      }
      #mainbtn{
        display: block;
        margin: 15px auto;
      }
      label{
        color: rgb(31, 88, 121);
        font-weight: bold;
       
      }
      .container-record{
        width:90%;
        margin-top: 40px;
        display:block;
        margin:auto;
      
      }
      
      .table{
        background:none;
        margin-top:30px;
        background: none;
        border: 2px solid black;
        opacity: 0.64;
      }
      .nav-table{
        background-color: rgb(157, 187, 223);
        
      }
      #attribute{
        color: black;
      }
      h5{
        font-family: 'Murecho', sans-serif;
        font-weight: bold;
        color:purple;
        display: block;
        margin: auto;
      }
  </style>
  <body>
    <!--edit trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
  Edit info
</button> -->

<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editmodal">Edit Record of Employee</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="home.php" method="post">
         <input type="hidden" name="snoEdit" id="snoEdit">
          <div class="name-grp">
            <div class="col-md-6">
              <label for="name" class="form-label">first name:</label>
              <input type="text" class="form-control" id="firstnameEdit" name="firstnameEdit" Required>
            </div>
             
              <div class="col-md-6">
                <label for="name" class="form-label">last name:</label>
                <input type="text" class="form-control" id="lastnameEdit" name="lastnameEdit" Required>
              </div>
          </div>
          
          <div class="email-grp">
            <div class="col-md-6">
              <label for="email" class="form-label">Email:</label>
              <input type="email" class="form-control" id="emailEdit" name="emailEdit" Required>
            </div>
            <div class="col-md-6">
              <label for="id" class="form-label">Employee id:</label>
              <input type="text" class="form-control" id="employeeidEdit" name="employeeidEdit" Required>
            </div>
          </div>
          <div class="col-12">
            <button type="submit" id="mainbtn" class="btn btn-success">save changes</button>
          </div>
            
     
          </form>
      </div>
     
    </div>
  </div>
</div>

                  <!-- *********NAVBAR******** -->
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
                  Tasks
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" id="li-1" href="task.php">Employee task</a></li>
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

            <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
             <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Profile
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#">Edit Info</a></li>
                <li><a class="dropdown-item" href="index.php">Logout</a></li>
              </ul>
             </li>
            </ul>
            </form>
           
          </div>
        </div>
      </nav>
   
      <?php
        if($insert){
          echo"<div class='alert alert-success' role='alert'>
          <strong>Employer '$firstname $lastname' (id =$employeeid) added successfully!!!!</strong> You should check in on some of those fields below.
          <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
        }
      
      ?>
      <?php
          if($update){
            echo"<div class='alert alert-success' role='alert'>
            <strong>Employer details are changed successfully!!!!</strong> You should check in on some of those fields below.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
          }
      ?>
      <?php
           if($delete){
            echo"<div class='alert alert-success' role='alert'>
            <strong>Employer deleted successfully!!!!</strong> You should check in on some of those fields below.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
          }
      ?>
      <div class="container">
        <h2>Add the Employees those are selected!!</h2>
      <form action="home.php" method="post">
      <div class="name-grp">
        <div class="col-md-6">
          <label for="name" class="form-label">first name:</label>
          <input type="text" class="form-control" id="firstname" name="firstname" Required>
        </div>
         
          <div class="col-md-6">
            <label for="name" class="form-label">last name:</label>
            <input type="text" class="form-control" id="lastname" name="lastname" Required>
          </div>
      </div>
      
      <div class="email-grp">
        <div class="col-md-6">
          <label for="email" class="form-label">Email:</label>
          <input type="email" class="form-control" id="email" name="email" Required>
        </div>
        <div class="col-md-6">
          <label for="id" class="form-label">Employee id:</label>
          <input type="text" class="form-control" id="employeeid" name="employeeid" Required>
        </div>
      </div>
          <div class="col-12">
            <button type="submit" id="mainbtn" class="btn btn-success">Add employee</button>
          </div>
        
 
      </form>
      </div>
    
<div class="container-record">


<table class="table" id="myTable">
  <thead>
    <tr class="nav-table">
      <th scope="col">S.No</th>
      <th scope="col" id="attribute">First name</th>
      <th scope="col" id="attribute">Last name</th>
      <th scope="col" id="attribute">Email</th>
      <th scope="col" id="attribute">Employee id</th>
      <th scope="col" id="attribute">actions</th>
    </tr>
  </thead>
  <tbody>
<?php
$sql = "SELECT * FROM `employeelist`";
$result = mysqli_query($conn, $sql);
$sno = 0;
while($row = mysqli_fetch_assoc($result)){
  $sno = $sno + 1;
  echo "<tr>
  <th scope='row'>". $sno . "</th>
  <td>". $row['firstname'] . "</td>
  <td>". $row['lastname'] . "</td>
  <td>". $row['email'] . "</td>
  <td>". $row['employeeid'] . "</td>
  <td><button class='edit btn btn-info mx-2' id=".$row['sno'].">Edit</button><button class='delete btn btn-dark mx-2' id=d".$row['sno'].">Delete</button> </td>
</tr>";
} 

?>
 
   
  </tbody>
</table>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
    crossorigin="anonymous"></script>

    <script src="//cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script>
      $(document).ready(function () {
        $('#myTable').DataTable();
  
      });
    </script>

    <script>
      edits = document.getElementsByClassName('edit');
      Array.from(edits).forEach((element) => {
        element.addEventListener("click", (e) => {
          console.log("edit ");
          tr = e.target.parentNode.parentNode;
          firstname = tr.getElementsByTagName("td")[0].innerText;
          lastname = tr.getElementsByTagName("td")[1].innerText;
          email = tr.getElementsByTagName("td")[2].innerText;
          employeeid = tr.getElementsByTagName("td")[3].innerText;
          console.log(firstname,lastname,email,employeeid);
          firstnameEdit.value = firstname
          lastnameEdit.value = lastname
          emailEdit.value = email
          employeeidEdit.value = employeeid
          $('#editModal').modal('toggle');
          snoEdit.value = e.target.id;
          console.log(e.target.id);
      })
    })
    
    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("delete ");
        sno = e.target.id.substr(1);

        if (confirm("Are you sure you want to delete this employee")) {
          console.log("yes");
          window.location = `home.php?delete=${sno}`;
        
        }
        else {
          console.log("no");
        }
      })
    })
 </script>

  </body>
</html>