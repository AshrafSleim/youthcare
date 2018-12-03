<?php session_start()?>
<?php require_once("redirection.php");?>
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
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $user = $_POST['uname'];
      $pass = $_POST['psw'];
      $sql_u ="SELECT `name`, `password` FROM `login` WHERE name ='$user' and password ='$pass'";
      
      $res_u = mysqli_query($connection, $sql_u);
      if (mysqli_num_rows($res_u) > 0) {
          $_SESSION['name']=$user;
          $_SESSION['password']=$pass;
          $sql_e ="SELECT `checked`,`department`,`id` FROM `login` WHERE name ='$user' and password ='$pass'";
          $res_e = mysqli_query($connection, $sql_e);
          $flag=mysqli_fetch_assoc($res_e);
         
          $_SESSION['flag1']=$flag["checked"];
          $_SESSION['department1']=$flag["department"];
          $_SESSION['id1']=$flag["id"];
          $x=$flag['checked'];
          if($x==1){
                $mass="يوجد شخص اخر يقوم باستخدام هذا الاسم و الرقم السرى ";
                echo "<script type ='text/javascript'>alert('$mass');</script>";
          }else{
                         if($_SESSION['name']=="admin" && $_SESSION['password']=="admin"){
                
                redirect("main_admin.php");
                
          }elseif($_SESSION['department1']=="اداره النشاط الثقافى"){
         
                redirect("main1.php");
              
          }elseif($_SESSION['department1']=="اداره النشاط الاجتماعى"){
         
                redirect("main3.php");
              
          }elseif($_SESSION['department1']=="اداره الفن"){
          
                redirect("main2.php");
              
          }else{
          
                redirect("main4.php");
              
          }
          }

  	     
  	}else{
          $mass="الاسم المستخدم او الرقم السرى غير صحيح برجاء التسجيل مره اخرى";
          echo "<script type ='text/javascript'>alert('$mass');</script>";
  	}
}elseif(isset($_SESSION['name'])){
      $id=$_SESSION['id1'];
      $sql_x ="UPDATE `login` SET `checked` = '0' WHERE id ='$id'";
      $res_x = mysqli_query($connection, $sql_x);
      session_unset();
      session_destroy();
              
  }

  

?>




<!DOCTYPE html>
<html lang="ar">
<head>
  <title>الصفحه الرئيسيه</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="./css/bootstrap.css">
  <link rel="stylesheet" href="./css/style4.css">
  <style>
       
        </style>
        </head>
  <body class="main">
                
      <header class="container-fluid py-2 justify-content-middle">
          <div class="row text-center" >
            <div class="col-md-3"> <img src="images/a.jpg" alt="logo" ></div>
            <div class="col-md-6"> <h2 align="center"class="pt-3 pb-2" >اداره الرعايه و الشباب</h2></div>
            <div class="col-md-3"> </div>
           
          </div>
                
               </header>
        <div class="container" >
                <div class="tab-content form-content">
                    <div class="mb-3 pb-2">
                            <div class="form-row justify-content-center">
                                        
            <div class="col-sm-6 mt-2 col-md-6 col-lg-5 ">
        <div class="list-group ">
          <a href="#" class="list-group-item list-group-item-action list-group-item-info text-center" onclick="document.getElementById('id01').style.display='block'">موظف</a>
                <!-- <button class="btn btn-info py-3 btn-block" onclick="document.getElementById('id01').style.display='block'">موظف</button> -->
                <a href="first_year.php" class="list-group-item list-group-item-action list-group-item-info text-center"> طالب</a>
               </div>
              </div>
              <div id="id01" class="modal">
                       <?php 
                        $user = null;
                        $pass = null;?>                
                    <form id="form" class="modal-content animate" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                      <div class="imgcontainer">

                        <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
                        <img src="images/img_avatar.png" alt="Avatar" class="avatar">
                      </div>
                  
                      <div class="container">
                        <label class="text-right" for="uname"><b>الاسم المستخدم</b></label>
                        <input autocomplete="off" value="<?php echo htmlspecialchars( $user) ;?>" type="text" style="direction: rtl;" placeholder="ادخل الاسم" name="uname" required>
                  
                        <label class="text-right" for="psw"><b>الرقم السرى</b></label>
                        <input value="<?php echo htmlspecialchars( $pass) ;?>" autocomplete="new-password" type="password" style="direction: rtl;" placeholder="ادخل الرقم السرى" name="psw" required>
                          
                        <button type="submit" style="background-color: #00376d; color: white;">تسجيل الدخول</button>
                        
                        
                          
                      </div>
                  
                      <div class="container" style="background-color:#f1f1f1">
                        <button type="button" style="color: white; background-color: #00376d" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">الغاء</button>
                        
                      </div>
                    </form>
</div>
              </div>
              </div>
            </div>
            </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    
      
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script>
        // Get the modal
        var modal = document.getElementById('id01');
        
        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
        </script>
      <script>
window.location.hash="no-back-button";
window.location.hash="Again-No-back-button";//again because google chrome don't insert first hash into history
window.onhashchange=function(){window.location.hash="no-back-button";}
</script> 
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
</body>
</html>