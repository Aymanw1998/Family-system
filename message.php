<?php	
		include 'includes/php/db.php';
        $i=$_GET["ID"];

        $query= "SELECT * FROM tbl_users_219,tbl_posts_219 WHERE user_id=$i OR kids_id=$i";
        mysqli_set_charset($connection, "utf8");
		$result = mysqli_query($connection , $query);
        $row = mysqli_fetch_array($result);

        if($row["user_id"]==$i){
		    $firstName=$row["name"];
		    $lastName=$row["family"];
            $image=$row["image"];
        }
        else{
            $firstName=$row["FirstName"];
		    $lastName=$row["LastName"];
            $image=$row["imagekid"];
        }

        mysqli_free_result($result);
        
		mysqli_set_charset($connection, "utf8");
        $query= "SELECT * FROM tbl_message_219 WHERE to_id=$i AND msg!='NULL'";
        $result = mysqli_query($connection , $query);

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
        <!-- Bootstrap Settings (CSS+JS) -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous" async></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous" async></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous" async></script>	
	</head>
	<body id="message">
		<div id="wrapper">
			<header>
                <img class="reorder">
                <?php
                    if($row["user_id"]==$i){
                    echo '<a href="listkids.php" id="MyLogo"></a>';
                    }
                    else{echo '<a href="MyprofileKid.php" id="MyLogo"></a>';}
                ?>
				<img src="images/<?php echo $image?>"class="imageuser">
				<section>
                    <h6><b>שם משתמש: </b><?php echo $firstName.' '.$lastName ?></h6>
                    <?php
                         if($row["user_id"]==$i){
                                echo'<h6><b>תפקיד: </b>הורה</h6>';
                            }
                    ?>
					<form action="index.php"><button id="Exit" class="btn btn-primary btn-danger">יציאה</button></form>
				</section>
			</header>
			<nav class="Menu"  id="menu">
				<ul id="navList" class="hide">
                    <?php   if($row["user_id"]==$i){echo '<li><a href="listkids.php">ילדים שלי</a></li>';}
                            else{echo '<li><a href="MyprofileKid.php">הפרופיל</a></li>';}
                    ?>
					<li><a href="#">הודעות</a></li>
					<li><a href="#">מספרי חירום</a></li>
                    <?php
                            if($row["user_id"]==$i){echo '<li><a href="#">ברכב</a></li>';}
                    ?>
				</ul>
			</nav>
			
			<main>
                <br><h1> {ההודעות}</h1><br> 
                <ul class="list-group ulmessage">
                    <?php
                            while($row = mysqli_fetch_array($result)){
                                        $id=$row["id"];$msg=$row["msg"];

                                        $query= "SELECT * FROM tbl_posts_219,tbl_users_219 WHERE kids_id=$id OR user_id=$id";
                                        $result2 = mysqli_query($connection , $query);
                                        $row2 = mysqli_fetch_array($result2);

                                        if($row2["kids_id"]==$id){$fullName=$row2["FirstName"];}
                                        else{$fullName=$row2["name"];}

                                        echo'<li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <button id="Reply" class="btn btn-primary btn-success" onclick="location.href='."'Reply.php?ID=$i&ID2=$id"."'".'";>חזור בתשובה</button>
                                                    <!-- שם השוליח -->'.$msg.'
                                                    <span class="badge badge-primary bage-pill"><!--סימון אם לא נקרה-->'.$fullName.'</span>
                                            </li>';//$i for user and $id for messager
                                        
                                        mysqli_free_result($result2);
                                }
                    ?>
                </ul>
                <br>
                <button id="Sent" class="btn btn-primary btn-success" onclick="location.href='Reply.php?ID=<?php echo $i?>&ID2=';">שלח</button>
			</main>
            <script src="includes/JS+JQ/showNav.js"></script>
	</body>
	
</html>

<?php
    mysqli_free_result($result);
    mysqli_close($connection);
?>
        