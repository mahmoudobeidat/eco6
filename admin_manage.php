<?php

class Admin
{
    public $conn; 
  function __construct()
   {
       $this->conn = mysqli_connect("localhost","root","","eco6");
       if(!$this->conn)
       die("conncetion failed:".mysqli_connect_error()) ;
  
  }
  public function Add_admin($email,$password,$name,$pname)
  {
        
    
    $query="INSERT INTO admin (admin_email,admin_password,admin_name,admin_image) 
            VALUES('$email','$password','$name','$pname')";
            $result=mysqli_query($this->conn,$query);
            if ($result)
                {
                  header("Location:admin_manage.php?upload=success");

                }
   }

   public function view_admin(){
  
$array = array();  
           $query = "SELECT * FROM admin";  
           $result = mysqli_query($this->conn, $query);  
           while($row = mysqli_fetch_assoc($result))  
           {  
                $array[] = $row;  
           }  
           return $array;   
  
}
public function Delete_admin($delete)
      {
        $query = "delete from admin where admin_id = $delete";

        mysqli_query($this->conn,$query);
      }
      public function edit_admin($id,$name,$email,$pname2)
      {
        if (empty($pname2))  {
        $query = "UPDATE admin SET admin_email    = '$email',
                              
                               admin_name         = '$name'
                 WHERE         admin_id           = $id";
    }


    else{
        $query = "UPDATE admin SET admin_email     = '$email',
                           
                               admin_name          = '$name',
                               admin_image         = '$pname2'
                   WHERE       admin_id            = '$id'";
         }

        mysqli_query($this->conn,$query);
      }

};

$op1 = new Admin();


  if(isset($_POST['save']))
  {
    $email    =$_POST['email'];
    $password =$_POST['password'];
    $name     =$_POST['name'];
     
 $imgName = $_FILES['images']['name'];
    #file name with a random number so that similar dont get replaced
    
  $pname = date("Y-M-D-d")."(".rand(1,300).")"."Image".$imgName;
    #temporary file name to store file
    $tname = $_FILES["file"]["tmp_name"];
    copy($tname,"images/".$pname);
   
     #upload directory path
$uploads_dir = 'images';
    #TO move the uploaded file to specific location
    move_uploaded_file($tname, $uploads_dir.'/'.$pname);


 
  $op1->Add_admin($email,$password,$name,$pname);

}
if (isset($_POST["update"]))
 { 
     #retrieve file title
        $id  = $_POST["id"];
        $name  = $_POST["name"];
        $email  = $_POST["email"];
        
       $imgName = $_FILES['file']['name'];
       #file name with a random number so that similar dont get replaced
    
      $pname2 = date("Y-M-D-d")."(".rand(2,300).")"."Image".$imgName;
      #temporary file name to store file
      $tname = $_FILES["file"]["tmp_name"];
      copy($tname,"images/".$pname2);
      #upload directory path
      $uploads_dir = 'images';
      #TO move the uploaded file to specific location
      move_uploaded_file($tname, $uploads_dir.'/'.$pname2);

     $op1->edit_admin($id,$name,$email,$pname2);

   
}
if (isset($_GET['delete_id'])) {
    // get value of id that sent from address bar 
    $delete_id =$_GET['delete_id'];
    $op1->Delete_admin($delete_id);
}
include("header.php");



  




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Dashboard</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition">

     <div class="page-container">

         <div class="main-content">
            <h1 style="color: gray;margin-left: 320px;">ADD NEW ADMIN</h1>
        <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">Example Form</div>
                                    <div class="card-body card-block">
                                        <form action="?" method="post" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-addon">name</div>
                                                    <input type="text" id="username3" name="name" class="form-control">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-user"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-addon">Email</div>
                                                    <input type="email" id="email3" name="email" class="form-control">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-envelope"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-addon">Password</div>
                                                    <input type="password" id="password3" name="password" class="form-control">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-asterisk"></i>
                                                    </div>
                                                </div>
                                                 <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="image-input" class=" form-control-label">File input</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="file" id="file-input" name="file" class="form-control-file">
                                                </div>
                                            </div>
                                            <div class="form-actions form-group">
                                                <button type="submit" class="btn btn-primary btn-sm" name="save">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
            <!-- HEADER DESKTOP-->

               <h1 style="color: gray;margin-left: 320px;">OUR ADMINS</h1>
                    <div class="container-fluid">
            <div class="row m-t-30">
                            <div class="col-md-12">
                                <!-- DATA TABLE-->
                                <div class="table-responsive m-b-40">
                                    <table class="table table-borderless table-data3">
                                        <thead>
                                            <tr>
                                                <th>id</th>
                                                <th>EMAIL</th>
                                                <th>NAME</th>
                                                <th>IMAGE</th>
                                                <th>EDIT</th>
                                                <th>DELETE</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php

                                                    
                                                   
                                                      $array=$op1->view_admin(); 
                                                    
                                                 foreach ($array as $key => $value) {
                                                      
                                                  ?>
                                                   <tbody>
                                                    <tr>
                                                  <td><?php echo $value["admin_id"];     ?></td>
                                                  <td><?php echo $value["admin_email"];   ?></td>
                                                  <td><?php echo $value["admin_name"];   ?></td>
                                                  <td><?php echo "<img width=50% src='images/". $value["admin_image"]."'>"; ?></td>

                                                  <td>
                                                      <button type="button" class="btn btn-success edit">Edit</button>
                                                  </td>
                                                  <?php
                                                  echo "<td>"."<a class='btn btn-danger' <a href=\"?delete_id={$value['admin_id']}\">DELETE</a></td>";
                                                    ?>






                                            
</tr>
                                        </tbody>
                                        <?php
                                    }
                                    ?>
                                        
                                        
                                    </table>
                                </div>
                                <!-- END DATA TABLE-->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="copyright">
                                    <?php include 'footer.php'; 
                                    ?>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
      </div>
      <div id="myModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                           <input type="hidden" name="id" id="admin_id">
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">Admin Emai;</label>
                                                </div>

                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="admin_email" name="email" placeholder="admin_email" class="form-control">
                                                    
                                                </div>
                                            </div>
                                               <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">Admin Name</label>
                                                </div>

                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="admin_name" name="name" placeholder="admin_name" class="form-control">
                                                    
                                                </div>
                                            </div>
                                             
                                         
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="file-input" class=" form-control-label">File input</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="file" id="file-input" name="file" class="form-control-file">
                                                </div>
                                            </div>


                                           
                                    </div>       <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="update" class="btn btn-primary">Save changes</button>
                                        </form>
                </div>
         
                </div>
            </div>
        </div>
    </div>
</div>

       </div>
      

    </div>

    <!-- Jquery JS-->
   <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.6.0/umd/popper.min.js" integrity="sha512-BmM0/BQlqh02wuK5Gz9yrbe7VyIVwOzD1o40yi1IsTjriX/NGF37NyXHfmFzIlMmoSIBXgqDiG1VNU6kB5dBbA==" crossorigin="anonymous"></script>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

    <!-- Main JS-->
    <script>
        $(document).ready(function(){
            $('.edit').on('click',function(){
            $('#myModal').modal('show');

            $tr=$(this).closest('tr');

            var data =$tr.children("td").map(function(){
                return $(this).text();
            }).get();

            console.log(data);
            $('#admin_id').val(data[0]);

            $('#admin_email').val(data[1]);

            $('#admin_name').val(data[2]);

            
           








        });
        });
    </script>
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="js/main.js"></script>

</body>

</html>
<!-- end document-->
