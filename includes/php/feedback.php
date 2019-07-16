<?php
      include 'db.php';
      mysqli_set_charset($connection, "utf8");
      $user=$_GET["user"];
?>
<!DOCTYPE html>
<html>
	<head>
        <title>Child Safety</title>
        <meta charset="UTF-8">

        <!-- My Settings (CSS+JS) -->
        <?php echo'<link rel="stylesheet" href="../CSS/style.css">
        <script src="../JS+JQ/main.js" async></script>';?>
        
        <!-- Accordion (JQuery+CSS) -->
        <?php echo'<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <link rel="stylesheet" href="Accordion.css">';?>

        <!-- Bootstrap Settings (CSS+JS+JQuery)-->
		    <?php echo'<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous" async></script>
		    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous" async></script>';?>
	</head>
	<body id="correct">
		<div id="wrapper">
      <?php
           if($_GET["btn"]=="delete"){
                echo '<img class="correct" src="https://image.flaticon.com/icons/svg/1009/1009256.svg">';
                echo	'<p>הפרטים נמחקו</p>';
              }   
          else if($_GET["btn"]=="insert"){
                echo '<img class="correct" src="https://image.flaticon.com/icons/svg/1009/1009256.svg">';
                echo'<p>הפרטים של ' . $_GET["firstName"].' '. $_GET["lastName"].' '. 'נשמרו </p>';
              }
          else if($_GET["btn"]=="update"){echo '<img class="correct" src="https://image.flaticon.com/icons/svg/1009/1009256.svg">';
                echo'<p>הפרטים של ' . $_GET["firstName"].' '. $_GET["lastName"].' '. 'עודכנו </p>';
              }
          else{
                echo '<img class="correct" src="https://image.flaticon.com/icons/svg/1660/1660192.svg">';
                echo'<p>הילד בעל תעודת זיהות  ' . $_GET["ID"].' קיים </p>';
              }
          
          if($user!=""){
                echo '<form method="post" action="../../MyprofileKid.php" ><button type="submit" id="Back" class="btn btn-primary" >חזןר לפרופיל</button></form>';
                      }
          else{
                echo '<form method="post" action="../../listkids.php" ><button type="submit" id="Back" class="btn btn-primary" >חזור לרשימת הילדים</button></form>';
              }
        ?>
    </div>
	</body>
</html>

<?php mysqli_close($connection); ?>