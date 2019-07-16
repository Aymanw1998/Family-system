<?php
        include 'includes/php/db.php';$user="";//$user for if Null ("") so I am in Parent user else=> i am kid user
        session_start();
        $i=$_SESSION["id"];
        if(!isset($i)){
            header('Location:index.php');
          }

        mysqli_set_charset($connection, "utf8");
        $query= "SELECT * FROM tbl_users_219,tbl_posts_219 WHERE user_id=$i OR kids_id=$i";
        $result = mysqli_query($connection , $query);
        $row = mysqli_fetch_array($result);
        $firstName=$row["name"];
        $lastName=$row["family"];
        $image=$row["image"];

        if($row["kids_id"]==$i){
          $firstName=$row["FirstName"];
          $lastName=$row["LastName"];
          $image=$row["imagekid"];
          $user=$i;
        }
        mysqli_free_result($result);
        
        $row="";$row2="";
        if($_GET["ID"] != ""){
            $query= "SELECT * FROM tbl_posts_219 WHERE kids_id='".$_GET["ID"]."'";
            $result = mysqli_query($connection , $query);
            $row2= mysqli_fetch_array($result);
          } 
?>
<!DOCTYPE html>
<html>

	<head>

    <title>Child Safety</title>
    <meta charset="UTF-8">

    <!--font in Google (hebrew font) for h1-->
		<link href="https://fonts.googleapis.com/css?family=Secular+One&display=swap" rel="stylesheet">

    <!-- My Settings (CSS) -->
    <link rel="stylesheet" href="includes/CSS/style.css">
       

    <!-- Bootstrap Settings (CSS+JS+JQuery)-->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous" async></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous" async></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous" async></script> 
	
  </head>

	<body id="form">
		<div id="wrapper">
			
      <header>
				<img class="reorder"><!--for mobile-->
        <?php
                    if($user!=$i){
                      echo '<a href="listkids.php" id="MyLogo"></a>';
                    }
                    else{echo '<a href="MyprofileKid.php" id="MyLogo"></a>';}
        ?>
				<img src="images/<?php echo $image?>"class="imageuser">
				
        <section>
					<h6><b>שם משתמש: </b><?php echo $firstName.' '.$lastName ?></h6>
          <?php
                if($row2 ==""||$row2["kids_id"]!=$i){
                  echo '<h6><b>תפקיד: </b>הורה</h6>';
                  }
          ?>
				</section>
			</header>

			<nav class="Menu"  id="menu">
				<ul id="navList" class="hide">
          <?php   if($user!=$i){echo '<li><a href="#">ילדים שלי</a></li>';}
                  else{echo '<li><a href="MyprofileKid.php">הפרופיל</a></li>';}
          ?>
					<li><a href="message.php?ID=<?php echo $i?>">הודעות</a></li>
					<li><a href="#">מספרי חירום</a></li>
          <?php  if($user!=$i){echo '<li><a href="#">ברכב</a></li>';}?>
				</ul>
			</nav>
			
			<main>
			  <form method="POST"  <?php /*שלושה אפשריות*/if($_GET["ID"]!="" &&  $i==$_GET["ID"]){/* כאשר אני מעדכן את הפרטים כשאני הילד*/echo'action="includes/php/Update.php?'."user=kids".'"';} else if($_GET["ID"]!="" &&  $i!=$_GET["ID"]){/*(כאשר אני מעדכן את פרטי הילד (אני ההורה */echo'action="includes/php/Update.php?'."user=".'"';} else{/*(כאשר אני מוסיף את פרטי הילד (אני ההורה */echo'action="includes/php/CreateKid.php"';}?>>
          <?php
            if($_GET["ID"] ==""){
                echo '<h1>{הוספה}</h1>';
              }
            else{
                echo '<h1>{עדכון}</h1>';
              }
          ?>
          <section class="textLabel">
            <?php
                echo '<input type="hidden" name="IDP" value="'.$i.'" placeholder="209138155" class="form-control input-lg" pattern="^[0-9-+s()*]*$" required></label><br>';
            ?>
            <?php
                if($_GET["ID"] ==""){
                      echo '<div>
                            <label class="textLabellabel">:תעודת זהות <br>
                            <input type="text" name="ID" value="" placeholder="209138155" class="form-control input-lg" pattern="^[0-9-+s()*]*$" required></label><br>
                            </div>';
                  }
                else{
                      echo'<input type="hidden" name="ID" value="'.$row2["kids_id"].'" placeholder="209138155" class="form-control input-lg" pattern="^[0-9-+s()*]*$" required>';
                    }
            ?>
            <div>
                <label class="textLabellabel">:שם פרטי <br>
                <?php 
                      if($row2 !=""){
                        echo'<input type="text" name="firstName" value="'.$row2["FirstName"].'" placeholder="אמיר" class="form-control input-lg" required></label><br>';
                      }
                      else{
                        echo'<input type="text" name="firstName" value="" placeholder="אמיר" class="form-control input-lg" required></label><br>';
                        }
                ?>
            </div>
            <div>
                <label class="textLabellabel">:שם משפחה <br>
                <?php
                      if($row2 !=""){
                        echo '<input type="text" name="lastName" value="'.$row2["LastName"].'" placeholder="בן דויד" class="form-control input-lg" required></label><br>';
                      }
                      else{
                        echo '<input type="text" name="lastName" value="" placeholder="בן דויד" class="form-control input-lg" required></label><br>';
                        }
                ?>
            </div>
            <div>
                <label class="textLabellabel boxGender" required>
                    <label class="gender">:מין הילד</label><br>
                    <?php
                          if($_GET["ID"] !="" && $row2["gander"]=="זכר"){
                                        echo '<div class="type">
                                                  <label>נקבה</label>
                                                  <input type="radio" name="gender" value="נקבה"  required>
                                                  <label>זכר</label>
                                                  <input type="radio" name="gender" value="זכר" checked="checked" required >
                                                  </div>';
                            }
                          else if($_GET["ID"] !="" && $row2["gander"]=="נקבה"){
                                        echo '<div class="type">
                                                <label>נקבה</label><input type="radio" name="gender" value="נקבה" checked="checked" required>
                                                <label>זכר</label><input type="radio" name="gender" value="זכר"  required >
                                                </div>';
                            }
                          else{
                                        echo '<div class="type">
                                                <label>נקבה</label>
                                                <input type="radio" name="gender" value="נקבה" required>
                                                <label>זכר</label>
                                                <input type="radio" name="gender" value="זכר"  required >
                                                </div>';
                            }
                    ?>
                </label>
            </div>
            <div class="PhoneM">
              <label class="textLabellabel">:טלפן ראשי
              <?php
                   if($row2 !=""){
                                    echo '<input type="tel" name="phone" value="'.'0'.$row2["PhoneMain"].'"  pattern="^[0-9-+s()*]*$" placeholder="012-345-6789" class="form-control input-lg"></label><br>';
                                  }
                    else{
                                    echo '<input type="tel" name="phone" value=""  pattern="^[0-9-+s()*]*$" placeholder="012-345-6789" class="form-control input-lg"></label><br>';
                        }
              ?>
            </div>
          </section>
          <section class="textInput">
            <br>
            <div>
              <label class="textLabellabel ">:טלפן משני
              <?php 
                      if($row2 !=""){
                        echo '<input type="tel" name="phone2" value="'.'0'.$row2["PhoneSec"].'"  pattern="^[0-9-+s()*]*$" placeholder="012-345-6789" class="form-control input-lg"></label><br>';
                      }
                      else{
                        echo '<input type="tel" name="phone2" value=""  pattern="^[0-9-+s()*]*$" placeholder="012-345-6789" class="form-control input-lg"></label><br>';
                      }
              ?>
            </div>
            <div>
              <label class="textLabellabel">:דואר אלקטרוני
              <?php
                      if($row2 !=""){
                        echo '<input type="email" name="mail" value="'. $row2["Email"].'" placeholder="Amir@example.com" class="form-control input-lg"></label><br>';
                      }
                      else{
                        echo '<input type="email" name="mail" value="" placeholder="Amir@example.com" class="form-control input-lg"></label><br>';
                      }
              ?>
            </div><br>
            <div class="cc-selector-2">
              <label>בחר תמונה</label><br>
              <?php
                      if($_GET["ID"] !="" && $row2["imagekid"]=="kidNum1.jpg"){
                                  echo '<input id="image1" type="radio" name="image" value="kidNum1.jpg" checked="checked">
                                            <label class="drinkcard-cc image1" for="image1"></label>
                                        <input id="image2" type="radio" name="image" value="kidNum2.png">
                                            <label class="drinkcard-cc image2"for="image2"></label>
                                        <input id="image3" type="radio" name="image" value="kidNum3.jpg">
                                            <label class="drinkcard-cc image3"for="image3"></label>';
                        }
                      else if($_GET["ID"] !="" && $row2["imagekid"]=="kidNum2.png"){
                                  echo '<input id="image1" type="radio" name="image" value="kidNum1.jpg" >
                                            <label class="drinkcard-cc image1" for="image1"></label>
                                        <input id="image2" type="radio" name="image" value="kidNum2.png"checked="checked">
                                            <label class="drinkcard-cc image2"for="image2"></label>
                                        <input id="image3" type="radio" name="image" value="kidNum3.jpg">
                                            <label class="drinkcard-cc image3"for="image3"></label>';
                        }
                      else if($_GET["ID"] !="" && $row2["imagekid"]=="kidNum3.jpg"){
                                  echo '<input id="image1" type="radio" name="image" value="kidNum1.jpg" >
                                            <label class="drinkcard-cc image1" for="image1"></label>
                                        <input id="image2" type="radio" name="image" value="kidNum2.png">
                                            <label class="drinkcard-cc image2"for="image2"></label>
                                        <input id="image3" type="radio" name="image" value="kidNum3.jpg"checked="checked">
                                            <label class="drinkcard-cc image3"for="image3"></label>';
                        }
                      else{
                                  echo '<input id="image1" type="radio" name="image" value="kidNum1.jpg">
                                            <label class="drinkcard-cc image1" for="image1"></label>
                                        <input id="image2" type="radio" name="image" value="kidNum2.png">
                                            <label class="drinkcard-cc image2"for="image2"></label>
                                        <input id="image3" type="radio" name="image" value="kidNum3.jpg">
                                            <label class="drinkcard-cc image3"for="image3"></label>';
                        }
              ?>
            </div>
          </section>

          <?php 
                  if($_GET["ID"]!=""){
                        echo '<button id="Update" name="btn" class="btn btn-primary btn-success">עדכון</button>';
                    }
                  else{
                        echo'<button type="submit" id="ADD" class="btn btn-success btn-success">הוספה</button>';
                    }
          ?> 
        </form>
        <button id="Back" name="" class="btn btn-primary btn-info" onclick="goBack()">חזרה</button></form>
      </main>
      <script src="includes/JS+JQ/showNav.js"></script>
      <script src="includes/JS+JQ/main.js"></script>
	</body>
  
</html>
<?php
      if($row2 != ""){
          mysqli_free_result($result);
        }
          mysqli_close($connection);
?>