<?php session_start()?>
<?php require_once("redirection.php");?>
<?php  
$user=$_SESSION['name'];
$pass=$_SESSION['password'];
$flag1=$_SESSION['flag1'];
$flag2=$_SESSION['department1'];
$flag3=$_SESSION['id1'];
?>
<?php
 if (isset($_POST['button1'])) {
    session_unset();
    session_destroy();
    redirect("index.php");
    header('Cache-Control: no cache');
    exit();
    }

?>
<?php 
$host="localhost";
$dbusername="root";
$dbpassword="123456";
$dbname="youthcare";
$conn = new mysqli ($host,$dbusername,$dbpassword,$dbname);
$conn->set_charset("utf8");
if(mysqli_connect_error()){
die('Connect Error('.mysqli_connect_errno().')'. mysqli_connect_error());
}
?>

<?php
$active=" ";
$hidden1=" ";
$hidden2=" ";
$hidden3=" hidden";
 $name="أدخل الاسم";
  $tel="رقم الهاتف";
 $address="العنوان";
 $faculty="الكليه";
 $level= "الفرقه";
 $read="readonly";
 $card2="الرقم القومى";
$num=" الرقم القومى";
$id55=" ";

if(isset($_POST['search'])){
    $hidden3=" hidden";
    $read="readonly";
    $card=$_POST['css'];
    $card2=(string) $card;
    $query_u="SELECT `card_id` FROM `student` WHERE card_id='$card2'";
    $res=mysqli_query($conn,$query_u);
    $finel_n=mysqli_fetch_assoc($res);
        $num=$finel_n['card_id'];
    if(mysqli_num_rows($res) > 0){
         $query_e="SELECT `id` FROM `student` WHERE card_id='$card2'";
    $res_e=mysqli_query($conn,$query_e);
        $finel=mysqli_fetch_assoc($res_e);
        $id=$finel['id'];
        $id55=$finel['id'];
        $query_o="SELECT  `name`, `Faculty`, `level`, `phone`, `address` FROM `student` WHERE card_id='$card2'";
        $res_o=mysqli_query($conn,$query_o);
        $finel_o=mysqli_fetch_assoc($res_o);
        $name=$finel_o['name'];
        $faculty=$finel_o['Faculty'];
        $level=$finel_o['level'];
        $tel="0".$finel_o['phone'];
        $address=$finel_o['address'];  
$query="SELECT  `Studentid`, `budget`, `school_year` FROM `student_social` WHERE Studentid='$id'";
$query_res=mysqli_query($conn,$query);
        }
    else{
        $mes="هذا الطالب لم يتم تسجيله من قبل ";
    echo "<script type='text/javascript'>alert('$mes');</script>";
        die('Connect Error('.mysqli_connect_errno().')'. mysqli_connect_error());
    }
   
    }
// else{
//     
//  $query="SELECT  `Studentid`, `budget`, `school_year` FROM `student_social` WHERE Studentid='0'";
//$query_res=mysqli_query($conn,$query);  
//}
 elseif(isset($_POST['edit'])){
     $hidden3=" ";
     $hidden1=" hidden";
     $read=" ";
     $id55=$_POST['id10'];
     
        $num=$_POST['card_num'];
    $card=$_POST['css'];
   $card2=(string) $card;
     $name=$_POST['name'];
      $tel=$_POST['tel'];
     $address=$_POST['address'];
     $faculty=$_POST['faculty'];
    $level= $_POST['level'];
    $query_e="SELECT `id` FROM `student` WHERE card_id='$card2'";
    $res_e=mysqli_query($conn,$query_e);
        $finel=mysqli_fetch_assoc($res_e);
        $id=$finel['id']; 
     
    $query="SELECT  `Studentid`, `budget`, `school_year` FROM `student_social` WHERE Studentid='$id55'";
$query_res=mysqli_query($conn,$query); 
     
     
 }
  elseif(isset($_POST['save_edit'])){
      $hidden3=" hidden";
      $num=$_POST['card_num'];
      $id55=$_POST['id10'];
      $name=$_POST['name'];
      $tel=$_POST['tel'];
     $address=$_POST['address'];
     $faculty=$_POST['faculty'];
    $level= $_POST['level'];
     $update_query="UPDATE `student` SET   `name`='$name', `Faculty`='$faculty', `level`='$level', `phone`='$tel', `address`='$address' WHERE card_id='$num' ";
      $update_res=mysqli_query($conn,$update_query);
       $read="readonly";
       $query_e="SELECT `id` FROM `student` WHERE card_id='$card2'";
    $res_e=mysqli_query($conn,$query_e);
        $finel=mysqli_fetch_assoc($res_e);
        $id=$finel['id']; 
    $query="SELECT  `Studentid`, `budget`, `school_year` FROM `student_social` WHERE Studentid='$id55'";
$query_res=mysqli_query($conn,$query); 
      }  
  elseif(isset($_POST['again'])){
      $read =" ";
      $name=" ";
      $tel=" ";
     $address=" ";
     $faculty=" ";
     $level=" ";
       $query_e="SELECT `id` FROM `student` WHERE card_id='$card2'";
    $res_e=mysqli_query($conn,$query_e);
        $finel=mysqli_fetch_assoc($res_e);
        $id=$finel['id']; 
    $query="SELECT  `Studentid`, `budget`, `school_year` FROM `student_social` WHERE Studentid='$id'";
$query_res=mysqli_query($conn,$query); 
}
else{
     
  $query="SELECT  `Studentid`, `budget`, `school_year` FROM `student_social` WHERE Studentid='0'";
$query_res=mysqli_query($conn,$query);  
}    
    


?>
<!DOCTYPE html>
<html dir="rtl" lang="en">

<head>
    <style>
table, th, td {    
    border: 1px solid black;
}
</style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="stylesheet" href="./css/style.css">
    
    <title>البحث عن طالب</title>
     <style>
    #scroll {
      height: 100px;
      max-height: 350px;
        margin-top: 20px;
      overflow-y: auto;
    }
    
  </style>
</head>

<body class="main">
    

        <nav class="navbar navbar-expand-lg navbar-dark py-0 fixed-top" style="background:#00376d ; " >
                <button class="navbar-toggler text-white"   type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon "></span>
                      </button>  
                      <img src="images/a.jpg" alt="logo" >
               
               
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav ml-auto">

                       
                        <li class="nav-item ">
                                <a class="nav-link" href="new_student3.php"> تسجيل طالب جديد</a>
                              </li>
                              <li class="nav-item ">
                                    <a class="nav-link" href="cost.php"> حساب ميزانيه</a>
                                  </li>
                
                                  <li class="nav-item active">
                                        <a class="nav-link" href="serche_student3.php">البحث عن بيانات طالب</a>
                                      </li>
                    <li class="nav-item ">
                      <a class="nav-link" href="main3.php">القائمه الرئيسيه</a>
                    </li>
                    
                  </ul>
                  <form class="form-inline my-2 my-lg-0" method="post"  action="serche_student3.php" >
                     
                   <button class="btn btn-info my-2 p-2 mr-sm-4 " type="submit" name="button1">تسجيل خروج </button>
                  </form>
                </div>
              </nav>


        
    <div class="container">
        
            <div class="form-content">
                    <div class="px-4 fade show" id="new-competition" role="tabpanel">
               
                <form method="post"  action="serche_student3.php" class="mb-3 pb-2">
                    <div class="form-row justify-content-center">
                        <div class="col-sm-6 mt-2 col-md-6 col-lg-3 ">
                                <label for="card_id">ادخل رقم بطاقه الطالب</label>
                              
                        </div>
                        <div class="col-sm-6 mt-2 col-md-6 col-lg-3 ">
                                <input type="number" name="css" value=" " placeholder="14 رقم" class="form-control" id="card_id" onkeyup="lettersOnly2(this)">
                            </div>
                    </div>

                    <div class="form-row justify-content-center mt-5" >
                            <button class="btn btn-info mx-2" type="submit" name="search">بحث</button>
                            <button class="btn btn-info mx-2" type="reset" value="reset" >الغاء</button>
                    </div>
                    <div class="form-row justify-content-center">
                            <div class="col-sm-12 col-md-12 col-lg-6 ">
                                <label for="name"> اسم الطالب </label>
                                <input type="text" name="name" value="<?php echo $name; ?>" class="form-control" id="name" readonly>
                            </div>
                        </div>
                        <div class="form-row justify-content-center">
                                <div class="col-sm-6 mt-2 col-md-6 col-lg-3 ">
                                    <label for="faculty">الكليه</label>
                                    <input type="text" name="faculty" value="<?php echo $faculty; ?>" class="form-control" id="faculty" readonly>
                                </div>
                                <div class="col-sm-6 mt-2 col-md-6 col-lg-3 ">
                                        <label for="level">الفرقه</label>
                                        <input type="text" name="level" value="<?php echo $level; ?>" class="form-control" id="level" <?php echo $read;?>>
                                </div>
                        </div>
                    
                    <div class="form-row justify-content-center">
                        <div class="col-sm-12 col-md-12 col-lg-6 ">
                            <label for="address"> العنوان </label>
                            <input type="text" name="address" value="<?php echo $address; ?>"  placeholder=" العنوان كاملا" class="form-control" id="address"  <?php echo $read;?> >
                        </div>
                    </div>
                    <div class="form-row justify-content-center">
                            <div class="col-sm-12 col-md-12 col-lg-6 ">
                                    <label for="phone">رقم الهاتف</label>
                                    <input type="tel" name="tel" value="<?php echo $tel; ?>" placeholder="الهاتف" class="form-control" id="phone" <?php echo $read;?> onkeyup="lettersOnly2(this)">
                            </div>
                        </div>
                    <div class="form-row justify-content-center">
                            <div class="col-sm-12 col-md-12 col-lg-6 ">
                                    <label for="phone">لرقم القومى</label>
                                    <input type="text" name="card_num" value="<?php echo $num; ?>" placeholder="" class="form-control" id="phone" readonly>
                            </div>
                        </div>
                    
                    
                    <div class="form-row justify-content-center">
                            <div class="col-sm-12 col-md-12 col-lg-6 mt-5 ">
                                   <label for="fmale"> ميزانيه الطالب </label>

                        </div>
                    </div>
                           <div class="form-row justify-content-center">
                            <div id="scroll" class="col-sm-12 col-md-12 col-lg-6 mt-5">
                                  

                             <table id="table" class="table table-info table-hover  table-striped   " style="table-layout:fixed">
                                  <thead class="bg-info">
                                          <tr class="text-white" >
                                            
                                            <th class="text-center" > المبلغ</th>
                                             <th class="text-center"> العام الدراسى</th>
                                           
                                          </tr>
                                        </thead>
                                 <?php  while($row=mysqli_fetch_array($query_res)):?>
                                 <tr>
                    
                    <td><?php echo $row['budget'];?></td>
                    <td><?php echo $row['school_year'];?></td>
                    
                </tr>
                                 <?php endwhile;?>
                                    
                                      </table>
                               </div>
                    </div>
<!--
                                 <tbody>
                                    
                                <?php while($row = mysqli_fetch_array($query_res)):?>
                            <tr>
                                <td><?php echo $row['budget'];?></td>
                                <td><?php echo $row['school_year'];?></td>
                                
                            </tr>
                            <?php endwhile;?>

                                
                                 </tbody>

                        </table>
                            </div>
                        </div>
                      
-->
                    
                    
                        <div class="form-row justify-content-center mt-5"  >
                                <button class="btn btn-info mx-2" type="submit" name ="again">بحث مره اخرى</button>
                                <button class="btn btn-info mx-2" type="submit" name="edit" <?php echo $hidden1; ?> >تعديل</button>
                                <button class="btn btn-info mx-2" type="submit" name ="save_edit" <?php echo $hidden3; ?>>حفظ التعديل</button>
                            <input type="text" name="id10" value="<?php echo $id55; ?>"id="id10"  hidden>
                    </div>
    

                </form>
            </div>
        </div>
    </div>



<script>
function lettersOnly(input) {
    var regex = /[^أ-ىa-zءي]/g;
    input.value = input.value.replace(regex, "");
}
    function lettersOnly2(input) {
    var regex = /[^0-9]/g;
    input.value = input.value.replace(regex, "");
}
</script>
    <script src="./js/jquery-1.12.4.min.js"></script>
    <script src="./js/popper.min.js"></script>
    <script src="./js/bootstrap.js"></script>
  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
    
    </html>