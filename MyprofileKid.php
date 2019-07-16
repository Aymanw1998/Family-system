<?php
        include 'includes/php/db.php';
        session_start();
        $i=$_SESSION["id"];
        if(!isset($i)){header('Location:index.php');}
        mysqli_set_charset($connection, "utf8");
        $query= "SELECT * FROM tbl_posts_219 WHERE kids_id=$i";
        $result = mysqli_query($connection , $query);
        $row = mysqli_fetch_array($result);
        ?>
<!DOCTYPE html>
<html>
	<head>
        <title>Child Safety</title>

        <meta charset="UTF-8">

        <!--font in Google (hebrew font) for h1-->
		    <link href="https://fonts.googleapis.com/css?family=Secular+One&display=swap" rel="stylesheet">

        <!-- My Settings (CSS+JS) -->
        <link rel="stylesheet" href="includes/CSS/style.css">
        
        <!-- Accordion (CSS) -->
        <link rel="stylesheet" href="includes/CSS/Accordion.css">
     
        <!-- Bootstrap Settings (CSS+JS+JQuery)-->
		    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous" async></script>
		    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous" async></script>
		    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous" async></script>	
	</head>

	<body id="profilekid">
		<div id="wrapper">
      <header>
          <img class="reorder">
          <a href="#" id="MyLogo"></a>
          <form action="index.php"><button id="Exit" class="btn btn-primary btn-danger">יציאה</button></form>
      </header>
      <nav class="Menu"  id="menu">
        <ul id="navList" class="hide">
                <li><a href="#">הפרופיל</a></li>
                <li><a href="message.php?ID=<?php echo $i;?>">הודעות</a></li>
                <li><a href="#">מספרי חירום</a></li>
        </ul>
      </nav> 
      <main>
          <h1> {הפרופיל שלי}</h1>  
          <h2 id="FullName"><?php echo $row["LastName"].' '.$row["FirstName"]?></h2>
          <div class="form1">
              <ul>
                <li>
                  <b>תעודת זיהות:</b>
                  <p><?php echo $row["kids_id"];?></p>
                </li>
                <li>
                  <b>שם פרטי:</b>
                  <p><?php echo $row["FirstName"];?></p>
                </li>
                <li>
                  <b>שם משפחה:</b>
                  <p><?php echo $row["LastName"];?></p>
                </li>
                <li>
                  <b>מין:</b>
                  <p><?php echo $row["gander"];?></p>
                </li>
                <li>
                  <b>טלפון ראשי:</b>
                  <p><?php echo $row["PhoneMain"];?></p>
                </li>
                <li>
                  <b>טלפון משני:</b>
                  <p><?php echo $row["PhoneSec"];?></p>
                </li>
                <li>
                  <p><?php echo $row["Email"];?></p>
                  <b>:(דואר אלקטרוני(אם יש</b>
                </li>
              </ul>
              <div class="card">
                  <img class="card-img-top" src="images/<?php echo $row["imagekid"]?>" alt="Card image cap">
              </div>
          </div>
          <a href="ChildForm.php?ID=<?php echo $row["kids_id"]?>" id="Update" class="btn btn-primary">עריכה</a>
      </main>
    </div>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="includes/JS+JQ/showNav.js"></script>
	</body>
</html>

<?php
    mysqli_free_result($result);
    mysqli_close($connection);
?>