<!DOCTYPE HTML>
<html>
<head>
    <title>النشاط الاجتماعى</title>
     </head>
    <body>
   <form action="test.php" method="post">
    <b>Comment</b><br>
    <select name="text" id="text">
    <option value="">Select a option</option>
    <option value="option1">Option 1</option>
    <option value="option2">Option 2</option>
    <option value="other">Other</option>
    </select>
<br>
       <div class="other box">
    <b>Comment 2</b><br>
    <input type="text" name="own_text">
    </div>
    <input type="submit" name="submit" value="get"/>
       
    </form>
    <?php
    if(isset($_POST['submit'])){
      if($_POST['text'] == "") {
        echo 'thbbjkk;;k';
      } else {
          echo 'You chose other but has not typed anything';
        }
    }
    
    ?>
    
   
    
        
    </body>


</html>