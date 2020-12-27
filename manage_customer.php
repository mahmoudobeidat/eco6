<?php
class customer
{
    public $conn; 
  function __construct()
   {
       $this->conn = mysqli_connect("localhost","root","","eco6");
       if(!$this->conn)
       die("conncetion failed:".mysqli_connect_error()) ;
  
  }
  public function Add_customer($name,$email,$password,$mobile,$address,$pname)
  {
        
    
    $sql = "INSERT into customer(customer_name,customer_email,customer_password,customer_mobile,customer_address,customer_image)  
       VALUES('$name','$email','$password','$mobile','$address','$pname')";
            $result=mysqli_query($this->conn,$query);
            if ($result)
                {
                  header("Location:admin_manage.php?upload=success");

                }
   }

   public function view_customer(){
  
$array = array();  
           $query = "SELECT * FROM customer";  
           $result = mysqli_query($this->conn, $query);  
           while($row = mysqli_fetch_assoc($result))  
           {  
                $array[] = $row;  
           }  
           return $array;   
  
}
public function Delete_customer($delete)
      {
        $query = "delete from customer where admin_id = $delete";

        mysqli_query($this->conn,$query);
      }

      public function edit_customer($id,$name,$email,$password,$mobile,$address,$pname)
      {
        if (empty($pname))  {
       $query = "UPDATE customer SET customer_name      = '$name',
                                     customer_email     = '$email',
                                     customer_password  = '$password',
                                     customer_mobile    = '$mobile',
                                     customer_address   = '$address'
                                
                               WHERE customer_id = $id";

    }else{
        
    $query = "UPDATE customer SET customer_name   = '$name',
                               customer_email     = '$email',
                               customer_password  = '$password',
                               customer_mobile    = '$mobile',
                               customer_address   = '$address',
                               customer_image     = '$pname'
                         WHERE customer_id        = $id";

         }


        mysqli_query($this->conn,$query);
      }

};
$op1 = new customer();


if (isset($_POST["submit"]))
 { 
     #retrieve file title
          $name = $_POST["name"];
          $email = $_POST["email"];
          $password = $_POST["password"];
          $mobile = $_POST["mobile"];
          $address = $_POST["address"];

    
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
    $op1->Add_customer($name,$email,$password,$mobile,$address,$pname);
}
if (isset($_POST["update"]))
 {  
    $id       = $_POST['id'];
    $name     = $_POST['name'];
    $email    = $_POST['email'];
    $password = $_POST['password'];
    $mobile   = $_POST['mobile'];
    $address  = $_POST['address'];
    
   
 $imgName = $_FILES['file']['name'];
    #file name with a random number so that similar dont get replaced
    
 
    #temporary file name to store file
    $tname = $_FILES["file"]["tmp_name"];
    copy($tname,"images/".$imgName);
    $filename = pathinfo($_FILES['file']['name'], PATHINFO_FILENAME);
   
    
     #upload directory path
$uploads_dir = 'images';
    #TO move the uploaded file to specific location
    move_uploaded_file($tname, $uploads_dir.'/'.$filename);

     $op1->edit_customer($id,$name,$email,$password,$mobile,$address,$pname);

   
}
if (isset($_GET['delete_id'])) {
    // get value of id that sent from address bar 
    $delete_id =$_GET['delete_id'];
    $op1->Delete_customer($delete_id);
}


   
include ('header.php');
 
 

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
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <strong>ADDING CUSTMOERS</strong> ELEMENTS
                                    </div>
                                    <div class="card-body card-block">
                                        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                           
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">customer name</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="text-input" name="name" placeholder="customer name" class="form-control">
                                                    <small class="form-text text-muted">This is a help text</small>
                                                </div>
                                            </div>
                                             
                                             <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="email-input" class=" form-control-label">customer email</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="email" id="email-input" name="email" placeholder="customer email" class="form-control">
                                                    <small class="form-text text-muted">This is a help text</small>
                                                </div>
                                            </div>
                                             <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="password-input" class=" form-control-label">customer password</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="password" id="text-input" name="password" placeholder="customer password" class="form-control">
                                                    <small class="form-text text-muted">This is a help text</small>
                                                </div>
                                            </div>
                                             <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="mobile-input" class=" form-control-label">customer mobile</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="mobile-input" id="mobile-input" name="mobile" placeholder="customer mobile " class="form-control">
                                                    <small class="form-text text-muted">This is a help text</small>
                                                </div>
                                            </div>
                                            
                                           

                                           <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="address-input" class=" form-control-label">customer address</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="text-input" name="address" placeholder="customer address" class="form-control">
                                                    <small class="form-text text-muted">This is a help text</small>
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
                                           <div class="card-footer">
                                        <input style="color: white; name" name="submit" type="submit" class="btn btn-primary btn-sm">
                                            <i class="fa fa-dot-circle-o"></i> Submit
                                        </input>
                                       
                                    </div>
                                        </form>
                                    </div>
                                   
                                </div>
                                
                            </div>
            <!-- HEADER DESKTOP-->
            <h1 style="color: gray;margin-left: 320px;">OUR CUSTOMERS</h1>
            <div class="row m-t-30">
                            <div class="col-md-12">
                                <!-- DATA TABLE-->
                                <div class="table-responsive m-b-40">
                                    <table class="table table-borderless table-data3">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>NAME</th>
                                                <th>EMAIL</th>
                                                <th>password</th>
                                                <th>mobile</th>
                                                <th>adsress</th>
                                                <th>image</th>
                                                <th>EDIT</th>
                                                <th>Delete</th>
                                                
                                            </tr>
                                        </thead>
                                        <?php
                                                 
                                                      $array=$op1->view_customer(); 
                                                    
                                                 foreach ($array as $key => $value) {
                                                      
                                                  ?>
                                                   <tbody>
                                                    <tr>
                                                  <td><?php echo $value["customer_id"];     ?></td>
                                                  <td><?php echo $value["customer_name"];   ?></td>
                                                  <td><?php echo $value["customer_email"];   ?></td>
                                                  <td><?php echo $value["customer_password"];   ?></td>
                                                  <td><?php echo $value["customer_mobile"];   ?></td>
                                                  <td><?php echo $value["customer_address"];   ?></td>
                                                  <td><?php echo "<img width=50% src='images/". $value["customer_image"]."'>"; ?></td>

                                                  <td>
                                                      <button type="button" class="btn btn-success edit">Edit</button>
                                                  </td>
                                                  <?php
                                                  echo "<td>"."<a class='btn btn-danger' <a href=\"?delete_id={$value['customer_id']}\">DELETE</a></td>";
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
                                           <input type="hidden" name="id" id="id">
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">customer Name</label>
                                                </div>

                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="name" name="name" placeholder="admin_email" class="form-control">
                                                    
                                                </div>
                                            </div>
                                             <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">Customer Email</label>
                                                </div>

                                                <div class="col-12 col-md-9">
                                                    <input type="email" id="email" name="email" placeholder="admin_email" class="form-control">
                                                    
                                                </div>
                                            </div>
                                             <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">Customer passowrd</label>
                                                </div>

                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="password" name="password" placeholder="admin_email" class="form-control">
                                                    
                                                </div>
                                            </div>
                                               <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">Customer Mobile</label>
                                                </div>

                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="mobile" name="mobile" placeholder="admin_name" class="form-control">
                                                    
                                                </div>
                                            </div>
                                            
                                               <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">Customer Address</label>
                                                </div>

                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="address" name="address" placeholder="admin_name" class="form-control">
                                                    
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
            $('#id').val(data[0]);

            $('#name').val(data[1]);

            $('#email').val(data[2]);

            $('#password').val(data[3]);

            $('#mobile').val(data[4]);

            $('#address').val(data[5]);

            
           








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

    </div>


</body>

</html>
<!-- end document-->
