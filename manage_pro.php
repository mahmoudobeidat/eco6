<?php

class Product
{
    public $conn;
  function __construct()
   {
       $this->conn = mysqli_connect("localhost","root","","eco6");
       if(!$this->conn)
       die("conncetion failed:".mysqli_connect_error()) ;
  
  }
  public function Add_pro($name,$desc,$price,$pname2,$catid)
  {
   
       $sql = "INSERT into products(pro_name,pro_desc,pro_price,pro_image,cat_id)
                             VALUES('$name','$desc','$price','$pname2','$catid')";

    $result = mysqli_query($this->conn,$sql); 

    if($result){
 
    echo "File Sucessfully uploaded";
    }
    else{
        echo "Error";
    }
}

public function view_pro()
  {       $query="SELECT products.pro_id,products.pro_name,products.pro_price, products.pro_desc ,products.pro_image                  ,category.cat_name 
                                               FROM products
                                               INNER JOIN category ON products.cat_id=category.cat_id";
                                   $result = mysqli_query($this->conn, $query);  
           while($row = mysqli_fetch_assoc($result))  
           {  
                $array[] = $row;  
           }  
           return $array;
           
           
      }  
      public function Delete_pro($delete)
      {
        $query = "delete from category where cat_id = $delete";

        mysqli_query($this->conn,$query);
      }

      public function edit_pro($id,$name,$desc,$price,$catid,$pname2)
      {
        if (empty($pname)) {
                           $query="UPDATE products set pro_name='$name',
                                                       pro_desc='$desc',
                                                       pro_price='$price',
                                                       cat_id='$catid'
                                                 where pro_id='$id'";
                             }else{
                                $query="UPDATE products set pro_name='$name',
                                        pro_desc='$desc',
                                        pro_price='$price',
                                        cat_id='$cat',
                                        pro_image='$pname'
                                        where pro_id='$id'";
                                 }

        mysqli_query($this->conn,$query);
      }

    
                                        
                                     
       
};

$op1 = new Product();


if (isset($_POST["submit"]))
 { 
     #retrieve file title
        $name  = $_POST["name"];
        $desc  = $_POST["desc"];
        $price = $_POST["price"];
        $catid = $_POST["catname"];
    
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

     $op1->Add_pro($name,$desc,$price,$catid,$pname2);

   
}
if (isset($_POST["update"]))
 { 
     #retrieve file title
        $id  = $_POST["id"];
        $name  = $_POST["name"];
        $desc  = $_POST["desc"];
        $price = $_POST["price"];
        $catid = $_POST["catname"];
    
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

     $op1->edit_pro($id,$name,$desc,$price,$catid,$pname2);

   
}

if (isset($_GET['delete_id'])) {
    // get value of id that sent from address bar 
    $delete_id =$_GET['delete_id'];
    $op1->Delete_pro($delete_id);
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<style>
    .bs-example{
      margin: 20px;
    }
</style>

</head>

<body class="animsition">

     <div class="page-container">

         <div class="main-content">

                          
            <h1 style="color: gray;margin-left: 320px;">ADD NEW PRODUCT</h1>
        <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                               <div class="col-lg-12">  
                                <div class="card">
                                    <div class="card-header">
                                        <strong>ADDING PRODUCTS</strong> ELEMENTS
                                    </div>
                                    <div class="card-body card-block">
                                        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                           
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">Product name</label>
                                                </div>

                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="text-input" name="name" placeholder="product name" class="form-control">
                                                    <small class="form-text text-muted">This is a help text</small>
                                                </div>
                                            </div>
                                           <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">category name</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                                          
                                                <select name="catname">
                                                <option disabled selected>-- Select category --</option>
                                                <?php
                                                $localhost = "localhost"; #localhost
                                                $dbusername = "root"; #username of phpmyadmin
                                                $dbpassword = "";  #password of phpmyadmin
                                                $dbname = "eco6";  #database name
                                                 
                                                #connection string
                                                $conn = mysqli_connect($localhost,$dbusername,$dbpassword,$dbname);
                                                      // Using database connection file here
                                                    $records = mysqli_query($conn, "SELECT cat_name,cat_id From category");  // Use select query here 

                                                    while($data = mysqli_fetch_array($records))
                                                    {
                                                        echo "<option value='". $data['cat_id'] ."'>" .$data['cat_name'] ."</option>";  // displaying data in option menu
                                                    }   
                                                ?>  
                                              </select>    </div>
                                            </div>
                                           
                                            
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="textarea-input" class=" form-control-label">Product description</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <textarea name="desc" id="textarea-input" rows="9" placeholder="category description..." class="form-control"></textarea>
                                                </div>
                                            </div>
                                           <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">price</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="text-input" name="price" placeholder="product price" class="form-control">
                                                    <small class="form-text text-muted">This is a help text</small>
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

               <h1 style="color: gray;margin-left: 320px;">OUR PRODUCTS</h1>
                    <div class="container-fluid">
            <div class="row m-t-30">
                            <div class="col-md-12">
                                <!-- DATA TABLE-->
                                <div class="table-responsive m-b-40">
                                    <table class="table table-borderless table-data3">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>NAME</th>
                                                <th>DESCRIPTION</th>
                                                <th>PRICE</th>
                                                <th>IMAGE</th>
                                                <th>CATEGORY NAME</th>
                                                <th>EDIT</th>
                                                <th>DELETE</th>
                                            </tr>
                                        </thead>
                                       
                                           <?php

/*

            echo "<tr><td>". $value["pro_id"]. " </td><td> ". $value["pro_name"]. "</td><td> " . $value["pro_desc"] ."</td><td> " . $value["pro_price"]."</td><td><img width=50% src='images/". $value["pro_image"]."'>"."</td><td>".$value["cat_name"]."</td><td>"."<a href='#myModal' role='button' class='btn btn-lg btn-primary' data-toggle='modal'>EDIT</a>"."</td><td>"."<a href=\"?delete_id={$value['pro_id']}\"' class='btn btn-danger'>DELETE</a>"."</td></tr>";
}?>
*/
                                           
                                                
                                                  $array= $op1->view_pro();  
                                                    
                                                 foreach ($array as $key => $value) {
                                                    
                                                  ?>
                                                   <tbody>
                                                    <tr>
                                                  <td><?php echo $value["pro_id"];     ?></td>
                                                  <td><?php echo $value["pro_name"];   ?></td>
                                                  <td><?php echo $value["pro_desc"];   ?></td>
                                                  <td><?php echo $value["pro_price"];  ?></td>
                                                  <td><?php echo "<img width=50% src='images/". $value["pro_image"]."'>"; ?></td>

                                                  <td><?php echo $value["cat_name"];  ?></td>
                                                  <td>
                                                      <button type="button" class="btn btn-success edit">Edit</button>
                                                  </td>
                                                 <?php
                                                  echo "<td>"."<a class='btn btn-danger' <a href=\"?delete_id={$value['pro_id']}\">DELETE</a></td>";
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
       <!-- Modal HTML -->
    <div id="myModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                           <input type="hidden" name="id" id="pro_id">
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">Product name</label>
                                                </div>

                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="pro_name" name="name" placeholder="product price" class="form-control">
                                                    
                                                </div>
                                            </div>
                                              <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="textarea-input" class=" form-control-label">Product description</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <textarea type="text" name="desc" id="pro_desc" rows="9" placeholder="category description..." class="form-control"></textarea>
                                                </div>
                                            </div>
                                             <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">price</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text"  id="pro_price" name="price" placeholder="product price" class="form-control">
                                                    
                                                </div>
                                            </div>
                                           <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">category name</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                                          
                                                <select id="catname" name="catname" placeholder="product price" class="form-control">
                                                <option >-- Select category --</option>
                                                <?php
                                                $localhost = "localhost"; #localhost
                                                $dbusername = "root"; #username of phpmyadmin
                                                $dbpassword = "";  #password of phpmyadmin
                                                $dbname = "eco6";  #database name
                                                 
                                                #connection string
                                                $conn = mysqli_connect($localhost,$dbusername,$dbpassword,$dbname);
                                                      // Using database connection file here
                                                    $records = mysqli_query($conn, "SELECT cat_name,cat_id From category");  // Use select query here 

                                                    while($data = mysqli_fetch_array($records))
                                                    {
                                                        echo "<option  selected value='". $data['cat_id'] ."'>" .$data['cat_name'] ."</option>";  // displaying data in option menu
                                                    }   
                                                ?>  
                                              </select>    </div>
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
            $('#pro_id').val(data[0]);

            $('#pro_name').val(data[1]);

            $('#pro_desc').val(data[2]);

            $('#pro_price').val(data[3]);

            $('#cat_name').val(data[4]);
           








        });
        });
    </script>

    

    

</body>

</html>
<!-- end document-->
