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
$hidden="hidden";
$required="required";
$faild1=" ";
$date1=" ";

if(isset($_POST['search']))
{
    $faild1=$_POST['faild'];
    $date1=$_POST['date'];
    $hidden=" ";
    $query1="SELECT `id` FROM `activity2` WHERE type = '$faild1' and start_trining = '$date1' ";
    
    $res_1 = mysqli_query($connection, $query1);
    $flagid=mysqli_fetch_assoc($res_1);
    $x=$flagid['id'];
   $query2 ="SELECT `id`, `name`, `result`, `activity2_id` FROM `team_result` WHERE activity2_id='$x' ";
    $search_result = mysqli_query($connection, $query2);
    $required=" ";
}elseif(isset($_POST['save'])){
    
    $hidden=" ";
    $required=" ";
    $faild1=$_POST['id2'];
    $date1=$_POST['id3'];
    $id3=$_POST['id1'];
    $resulty=$_POST['result1'];
    $query2 = "UPDATE `team_result` SET `result`='$resulty' WHERE id= $id3";
    
    $res_2 = mysqli_query($connection, $query2);
    $query1="SELECT `id` FROM `activity2` WHERE type = '$faild1' and start_trining = '$date1' ";
    $res_1 = mysqli_query($connection, $query1);
    $flagid=mysqli_fetch_assoc($res_1);
    $x=$flagid['id'];
   
    $query2 ="SELECT `id`, `name`, `result`, `activity2_id` FROM `team_result` WHERE activity2_id='$x' ";
    $search_result = mysqli_query($connection, $query2);
    $required=" ";
}else {
    $query = "SELECT * FROM `register` WHERE id=0";
    $search_result = mysqli_query($connection, $query);

}

// function to connect and execute the query
function filterTable($query)
{
    $connect = mysqli_connect("localhost", "root", "123456", "testashraf");
    $filter_Result = mysqli_query($connect, $query);
    return $filter_Result;
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
    <title>تسجيل ترتيب الكليات</title>
    <style>
    #scroll {
      height: 500px;
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

                     <li class="nav-item dropdown ">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  المسابقات
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                  <a class="dropdown-item " href="new_activity4.php">تسجيل مسابق جديده</a>
                                  <a class="dropdown-item active" href="serche_activity4.php">البحث عن مسابقه</a>
                         </div>
                              </li>

                              <li class="nav-item dropdown ">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      الطلاب
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                      <a class="dropdown-item" href="new_student4.php">تسجيل طالب </a>
                                      <a class="dropdown-item" href="serche_student4.php">البحث عن بيانات طالب</a>
                                  </div>     
                                  </li>
                                   <li class="nav-item active">
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
                  <form class="form-inline my-2 my-lg-0" action="result4-1.php" method="post">
                    
                    <button class="btn btn-info my-2 p-2 mr-sm-4 " type="submit" name="button1">تسجيل خروج </button>
                  </form>
                </div>
              </nav>

    <div class="container">
        
        <div class="form-content">
            <div class="px-4 fade show" id="new-competition" role="tabpanel">
               
                <form action="result4-1.php" method="post" class="mb-3 pb-2">
                    
                       
                    <div class="form-row justify-content-center">
                        <div class="col-sm-6 mt-2 col-md-6 col-lg-3 ">
                            <label for="field">اختر النوع</label>
                            <select name="faild" id="field" class="form-control" <?php echo $required;?>>
                                <option disabled selected value="">اختر المجال.....</option>
                                <option value="مهرجان">مهرجان </option>
                                <option value="تدريب">تدريب</option>
                            </select>
                        </div>
                        <div class="col-sm-6 mt-2 col-md-6 col-lg-3 ">
                            <label for="date">تاريخ المسابقه</label>
                            <input type="date" placeholder="dd/mm/yyyy" class="form-control" id="date" name="date" <?php echo $required;?>>
                        </div>
                    </div>
                   <div class="form-row justify-content-center mt-2"  >
                            <button class="btn btn-info mx-3 my-2" type="submit" name="search">بحث</button>
                            <button class="btn btn-info mx-3 my-2" type="reset" value="reset" >الغاء</button>
                        </div>
                    <div class="form-row justify-content-center">
                        <div  class="col-sm-12 col-md-12 col-lg-8 mt-5"  >
                              <label <?php echo $hidden?>><?php echo " نوع المسابقه ".$faild1." بتاريخ ".$date1;?></label>
                        </div>
                    </div>
                    <div class="form-row justify-content-center">
                        <div id="scroll" class="col-sm-12 col-md-12 col-lg-8 mt-5"  >
                              
                            
                                <table id="table" class="table table-info table-hover  table-striped   " style="table-layout:fixed">
                                        <thead class="bg-info">
                                          <tr class="text-white" >
                                            <th class="text-center" hidden >id</th>
                                            <th class="text-center" > اسم الكليه</th>
                                             <th class="text-center"> النتيجة</th>
                                              <th class="text-center"> </th>
                                          </tr>
                                        </thead>
                                         <?php  while($row=mysqli_fetch_array($search_result)):?>
                <tr>
                    <td hidden><?php echo $row['id'];?></td>
                    <td><?php echo $row['name'];?></td>
                    <td><?php echo $row['result'];?></td>
                    <td> <a href= "#" class="list-group-item list-group-item-action list-group-item-info text-center" onclick="document.getElementById('id01').style.display='block'" >تسجيل نتيجه او تعديل</a>  </td>
                </tr>
                <?php endwhile;?>
                                    
                                      </table>
                                 
                        </div>
                        <div class="col-sm-6 mt-2 col-md-6 col-lg-3 mt-5">
                            <label for="date">اسم الكليه</label>
                            <input type="text" placeholder="اسم الطالب" class="form-control" id="name1" name="name1" readonly>
                            <label for="date">النتيجه</label>
                            <input type="text" placeholder="ادخل النتيجه" class="form-control" id="result1" name="result1"  >
                            
                            
                            <div class="mt-4 mx-4" >
                            <button class="btn btn-info mx-3 my-2" type="submit" name="save">حفظ</button>
                            <button class="btn btn-info mx-3 my-2" type="reset" value="reset">الغاء</button>
                            <input type="number" class="form-control" id="id1" name="id1" hidden >
                            <input type="text" class="form-control" name="id2" value="<?php echo $faild1;?>" hidden >
                            <input type="date" class="form-control" id="id3" name="id3"  value="<?php echo $date1;?>" hidden >
                        </div>
                        </div>
                        </div>
                </form>
            </div>
        </div>
    </div>



    <script>
    
                var table = document.getElementById('table');
                
                for(var i = 1; i < table.rows.length; i++)
                {
                    table.rows[i].onclick = function()
                    {
                         //rIndex = this.rowIndex;
                        
                        document.getElementById("id1").value = this.cells[0].innerHTML;
                         document.getElementById("name1").value = this.cells[1].innerHTML;
                         document.getElementById("result1").value = this.cells[2].innerHTML;
                    };
                }
    
         </script>
    <script src="./js/jquery-1.12.4.min.js"></script>
    <script src="./js/popper.min.js"></script>
    <script src="./js/bootstrap.js"></script>
</body>

</html>