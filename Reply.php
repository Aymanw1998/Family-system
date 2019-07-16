<?php	
		include 'includes/php/db.php';
        $i=$_GET["ID"];
        $id=$_GET["ID2"];

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

        $query= "SELECT * FROM tbl_users_219,tbl_posts_219 WHERE user_id=$id OR kids_id=$id";
        mysqli_set_charset($connection, "utf8");
        $result = mysqli_query($connection , $query);
        
        if($result){
                $row2 = mysqli_fetch_array($result);
                if($row2["user_id"]==$id){
                        $firstName2=$row2["name"];
                        $lastName2=$row2["family"];
                  }
                else{
                        $firstName2=$row2["FirstName"];
                        $lastName2=$row2["LastName"];
                    }
                mysqli_free_result($result);
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
    
        <!-- Bootstrap Settings (CSS+JS) -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous" async></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous" async></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous" async></script>	
	</head>
	<body id="Reply">
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
					<li><a href="#">ילדים שלי</a></li>
					<li><a href="message.php?ID=<?php echo $i?>">הודעות</a></li>
					<li><a href="#">מספרי חירום</a></li>
					<li><a href="#">ברכב</a></li>
				</ul>
			</nav>
			
			<main>
                <form action="includes/php/feedbackReply.php?ID=<?php echo $i?>&ID2=<?php echo $id?>" method="POST">
                    <br><h1> {ההודעות}</h1><br>
                    <div class="form-group">
                        <?php
                                if($id != ""){
                                        echo '<input type="text" class="from-control text-white bg-dark" id="usr" value="'.$firstName2.' '.$lastName2.'" readonly>';
                                    }
                                else{
                                    if($row["user_id"]==$i){ 
                                            $query= "SELECT * FROM tbl_posts_219 WHERE id_user_parent=$i";
                                            mysqli_set_charset($connection, "utf8");
                                            $result = mysqli_query($connection , $query);
                                            
                                            echo '<select name="selectID">';
                                            
                                            while($row = mysqli_fetch_array($result)){
                                                    echo '<option value="'.$row["kids_id"].'">'.$row["FirstName"].' '.$row["LastName"].'</option>';
                                            }

                                            echo '</select>';
                                            mysqli_free_result($result);
                                        }
                                else{
                                    $query= "SELECT id_user_parent FROM tbl_posts_219 WHERE kids_id=$i";
                                    mysqli_set_charset($connection, "utf8");
                                    $result = mysqli_query($connection , $query);
                                    $row = mysqli_fetch_array($result);
                                    
                                    $query= "SELECT * FROM tbl_users_219 WHERE user_id=".$row["id_user_parent"]."";
                                    mysqli_set_charset($connection, "utf8");
                                    $result = mysqli_query($connection , $query);
                                    
                                    echo '<select name="selectID" >';
                                    
                                    while($row = mysqli_fetch_array($result)){
                                            echo '<option value="'.$row["user_id"].'">'.$row["name"].' '.$row["family"].'</option>';
                                        }
                                    echo '</select>';
                                    }
                                }
                        ?>
                        <label for="usr">שם המקבל</label>
                    </div>
                    <div class="form-group">
                        <label for="comment">מבנה ההודעה</label>
                        <textarea class="form-control" rows="2" name="msg" id="comment" ></textarea>
                    </div>
                    <input type="submit" value="שלח">
                </form>
		    </main>
        </div>
        <script src="includes/JS+JQ/showNav.js"></script>
	</body>
</html>
<?php
mysqli_close($connection);
?>