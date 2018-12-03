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
$dbhost="localhost";
$dbuser="root";
$dbpass="123456";
$dbname="youthcare";
$connection= mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
$connection->set_charset("utf8");
if(mysqli_connect_errno()){
    die("database not connect".mysqli_connect_error()."(".mysqli_connect_errno().")");
}

?>
<?php
$id1=" ";
$name1="اسم الطالب رباعى";
$card_id1=" ";
$Faculty1="الكليه المنتمى اليها";
$level1=" ";
$phone1=" ";
$address1=" العنوان كاملا";
$team="حاله الانضمام للمنتخب";
$required="required";
$hidden="hidden";
$hidden2=" ";
$hidden3="hidden";
$readonly="readonly";
if(isset($_POST['search'])){
    $hidden=" ";
    $css2=$_POST['css'];
    $css1=(string)$css2;
    
       $query1="SELECT `id`, `name`, `card_id`, `Faculty`, `level`, `phone`, `address`, `superTeam` FROM `student` WHERE card_id = $css1 and flag=1";
        $res_1=mysqli_query($connection, $query1);
         if (mysqli_num_rows($res_1) > 0) {
             $flagid=mysqli_fetch_assoc($res_1);
             $id1=$flagid['id'];
             $name1=$flagid['name'];
             $card_id1=$flagid['card_id'];
             $Faculty1=$flagid['Faculty'];
             $level1=$flagid['level'];
             $phone1="0".$flagid['phone'];
             $address1=$flagid['address'];
            $team2=$flagid['superTeam'];
             if($team2==0){
                 $team="لم ينضم";
             }else{
                 $team="منضم فى المنتخب";
             }
             $required=" ";
             $hidden2="hidden";
             
         }else{
             $mass="لا يوجد بيانات لرقم البطاقه هذه برجاء التاكد من الرقم";
          echo "<script type ='text/javascript'>alert('$mass');</script>"; 
            
         }
    
}elseif(isset($_POST['search2'])){
    $required="required";
    redirect("serche_student4.php");
    
}elseif(isset($_POST['update'])){
    $readonly=" ";
    $card_id2=$_POST['id2'];
     $query1="SELECT `id`, `name`, `card_id`, `Faculty`, `level`, `phone`, `address`, `superTeam` FROM `student` WHERE card_id = $card_id2 and flag=1";
        $res_1=mysqli_query($connection, $query1);
         if (mysqli_num_rows($res_1) > 0) {
             $flagid=mysqli_fetch_assoc($res_1);
             $id1=$flagid['id'];
             $name1=$flagid['name'];
             $card_id1=$flagid['card_id'];
             $Faculty1=$flagid['Faculty'];
             $level1=$flagid['level'];
             $phone1="0".$flagid['phone'];
             $address1=$flagid['address'];
             $team2=$flagid['superTeam'];
             if($team2==0){
                 $team="لم ينضم";
             }else{
                 $team="منضم فى المنتخب";
             }
             $required=" ";
             $hidden2="hidden";
             $hidden3=" ";
         }
}elseif(isset($_POST['save'])){
    $upd1=$_POST['level1'];
    $upd2=$_POST['phone'];
    $upd3=$_POST['address'];
    $card_id2=$_POST['id2'];
  
    $query5="UPDATE `student` SET `level`='$upd1',`phone`=$upd2,`address`='$upd3' WHERE card_id = $card_id2 and flag=1";
    $res_5=mysqli_query($connection, $query5);
     $query1="SELECT `id`, `name`, `card_id`, `Faculty`, `level`, `phone`, `address`, `superTeam` FROM `student` WHERE card_id = $card_id2 and flag=1";
        $res_1=mysqli_query($connection, $query1);
         if (mysqli_num_rows($res_1) > 0) {
             $flagid=mysqli_fetch_assoc($res_1);
             $id1=$flagid['id'];
             $name1=$flagid['name'];
             $card_id1=$flagid['card_id'];
             $Faculty1=$flagid['Faculty'];
             $level1=$flagid['level'];
             $phone1="0".$flagid['phone'];
             $address1=$flagid['address'];
             $team2=$flagid['superTeam'];
             if($team2==0){
                 $team="لم ينضم";
             }else{
                 $team="منضم فى المنتخب";
             }
             
             $required=" ";
             $hidden2="hidden";
             
         }
    $readonly="readonly";
    $hidden=" ";
    $hidden3="hidden";
}elseif(isset($_POST['cancel'])){
        $card_id2=$_POST['id2'];
         $query1="SELECT `id`, `name`, `card_id`, `Faculty`, `level`, `phone`, `address`, `superTeam` FROM `student` WHERE card_id = $card_id2 and flag=1" ;
        $res_1=mysqli_query($connection, $query1);
         if (mysqli_num_rows($res_1) > 0) {
             $flagid=mysqli_fetch_assoc($res_1);
             $id1=$flagid['id'];
             $name1=$flagid['name'];
             $card_id1=$flagid['card_id'];
             $Faculty1=$flagid['Faculty'];
             $level1=$flagid['level'];
             $phone1="0".$flagid['phone'];
             $address1=$flagid['address'];
             $team2=$flagid['superTeam'];
             if($team2==0){
                 $team="لم ينضم";
             }else{
                 $team="منضم فى المنتخب";
             }
             
             $required=" ";
             $hidden2="hidden";
             
         }
    $readonly="readonly";
    $hidden=" ";
    $hidden3="hidden";
}


?>
<!DOCTYPE html>
<html dir="rtl" lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="stylesheet" href="./css/style.css">
    
    <title>البحث عن طالب</title>
</head>

<body class="main">
        <nav class="navbar navbar-expand-lg navbar-dark py-0 fixed-top" style="background:#00376d ; " >
                <button class="navbar-toggler text-white"   type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon "></span>
                      </button>  
                      <img src="images/a.jpg" alt="logo" >
               
               
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav ml-auto">

                     <li class="nav-item dropdown ">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  المسابقات
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                  <a class="dropdown-item " href="new_activity4.php">تسجيل مسابق جديده</a>
                                  <a class="dropdown-item " href="serche_activity4.php">البحث عن مسابقه</a>
                         </div>
                              </li>

                              <li class="nav-item dropdown active">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      الطلاب
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                      <a class="dropdown-item" href="new_student4.php">تسجيل طالب </a>
                                      <a class="dropdown-item active" href="serche_student4.php">البحث عن بيانات طالب</a>
                                  </div>
                                  </li>
                                  <li class="nav-item ">
                                <a class="nav-link" href="result4-1.php">ترتيب الكليات</a>
                              </li>
                                  <li class="nav-item dropdown ">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      منتخب الجامعه
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                       <a class="dropdown-item  " href="super_team4.php" > اضافه طالب</a>
                                      <a class="dropdown-item " href="result4-2.php"> عرض منتخب الجامعه </a>
                                  </div>     
                                  </li>
                    <li class="nav-item ">
                      <a class="nav-link" href="main4.php">القائمه الرئيسيه</a>
                    </li>
                    
                  </ul>
                  <form class="form-inline my-2 my-lg-0" action="serche_student4.php" method="post">
                   <button class="btn btn-info my-2 p-2 mr-sm-4 " type="submit" name="button1">تسجيل خروج </button>
                  </form>
                </div>
              </nav>
             

    <div class="container">
        
            <div class="form-content">
                    <div class="px-4 fade show" id="new-competition" role="tabpanel">
               
                <form action="serche_student4.php" method="post" class="mb-3 pb-2">
                    <div class="form-row justify-content-center">
                        <div class="col-sm-6 mt-2 col-md-6 col-lg-3 ">
                                <label for="card_id" <?php echo $hidden2;?>>ادخل رقم بطاقه الطالب</label>
                              
                        </div>
                        <div class="col-sm-6 mt-2 col-md-6 col-lg-3 ">
                                <input type="number" placeholder="14 رقم" class="form-control" id="card_id" min="10000000000000" max="99999999999999" name="css"  <?php echo $required; ?> <?php echo $hidden2;?> onkeyup="lettersOnly2(this)">
                            </div>

                    </div>

                    <div class="form-row justify-content-center mt-5"  >
                            <button class="btn btn-info mx-2" type="submit" name="search" <?php echo $hidden2;?>>بحث</button>
                            <button class="btn btn-info mx-2" type="reset" value="reset" <?php echo $hidden2;?>>الغاء</button>
                    </div>
                    <div class="form-row justify-content-center">
                            <div class="col-sm-12 col-md-12 col-lg-6 ">
                                <label <?php echo $hidden3;?>>لا يمكن التعديل غير على الفرقه ورقم الهاتف و العنوان</label><br>
                                <label for="name"> اسم الطالب </label>
                                <input type="text" placeholder="اسم الطالب رباعى" class="form-control" id="student_name" readonly name="student_name" value="<?php echo $name1;?>" >
                            </div>
                        </div>
                        <div class="form-row justify-content-center">
                                <div class="col-sm-6 mt-2 col-md-6 col-lg-3 ">
                                    <label for="faculty">الكليه</label>
                                    <input type="text"  class="form-control" id="faculty" readonly name="faculty" value="<?php echo $Faculty1;?>" >
                                </div>
                                <div class="col-sm-6 mt-2 col-md-6 col-lg-3 ">
                                        <label for="level">الفرقه</label>
                                        <input type="text"  class="form-control" id="level" <?php echo $readonly;?> name="level1" value="<?php echo $level1;?>" >
                                </div>
                        </div>
                        <div class="form-row justify-content-center">
                                <div class="col-sm-6 mt-2 col-md-6 col-lg-3 ">
                                     <label for="level">رقم البطاقه</label>
                                        <input type="text"  class="form-control" id="level" readonly name="card" value="<?php echo $card_id1;?>" >
                                </div>
                                <div class="col-sm-6 mt-2 col-md-6 col-lg-3 ">
                                        <label for="phone">رقم الهاتف</label>
                                        <input type="tel" placeholder="الهاتف" class="form-control" id="phone" <?php echo $readonly;?> name="phone" value="<?php echo $phone1;?>" onkeyup="lettersOnly2(this)">
                                       
                                </div>
                        </div>
                    
                    <div class="form-row justify-content-center">
                                <div class="col-sm-6 mt-2 col-md-6 col-lg-3 ">
                                    <label for="super_team"> منتخب الجامعه</label>
                                    <input type="text"  class="form-control" id="super_team" readonly name="super_team" value="<?php echo $team;?>" >
                                </div>
                                <div class="col-sm-6 mt-2 col-md-6 col-lg-3 ">
                                     
                                       
                                </div>
                        </div>
                    
                    <div class="form-row justify-content-center">
                        <div class="col-sm-12 col-md-12 col-lg-6 ">
                            <label for="address"> العنوان </label>
                            <input type="text" placeholder=" العنوان كاملا" class="form-control" id="address" placeholder="المكان" <?php echo $readonly;?> name="address" value="<?php echo $address1;?>" >
                        </div>
                    </div>
                   
                  
                      
                    
                    
                        <div class="form-row justify-content-center mt-5"  >
                               <button class="btn btn-info mx-2" type="submit" name="search2" <?php echo $hidden;?>>بحث مره اخرى</button>
                                <button class="btn btn-info mx-2" type="submit" name="update"<?php echo $hidden;?>>تعديل</button>
                                <button class="btn btn-info mx-2" type="submit" name="save" <?php echo $hidden3;?>>حفظ التعديل</button>
                                <button class="btn btn-info mx-2" type="submit" name="cancel" <?php echo $hidden3;?>>الغاء</button>
                            <input type="text"  class="form-control" id="level"  name="id1" hidden value="<?php echo $id1;?>">
                            <input type="text"  class="form-control" id="level"  name="id2" hidden  value="<?php echo $card_id1;?>">
                            </div>
    

                </form>
            </div>
        </div>
    </div>



<script>
function lettersOnly(input) {
    var regex = /[^أ-ىa-zيء]/g;
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