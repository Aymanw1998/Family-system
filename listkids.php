<?php	
		include 'includes/php/db.php';
		session_start();
		$i=$_SESSION["id"];
		if(!isset($i)){header('Location:index.php');}//
		mysqli_set_charset($connection, "utf8");
		$query= "SELECT * FROM tbl_users_219 WHERE user_id=$i";
		$result = mysqli_query($connection , $query);
		$row = mysqli_fetch_array($result);
		$firstName=$row["name"];
		$lastName=$row["family"];
		$image=$row["image"];
		mysqli_free_result($result);
		$query= "SELECT * FROM tbl_posts_219 WHERE id_user_parent=$i";
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
	<body id="listKids">
		<div id="wrapper">
			<header>
				<img class="reorder">
        		<a href="listkids.php" id="MyLogo"></a>
				<img src="images/<?php echo $image?>"class="imageuser">
				<section>
					<h6><b>שם משתמש: </b><?php echo $firstName.' '.$lastName ?></h6>
					<h6><b>תפקיד: </b>הורה</h6>
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
			<br><h1> {הילדים שלי}</h1><br>  

				<input type="search" id="search" pattern="Search" value placeholder="Search..."><br>
				<table class="table">
				<thead class="thead-light">
				  <tr>
						<th scope="col"><p>פרטים</p></th>
						<th scope="col"><p>שם  משפחה</p></th>
						<th scope="col"><p>שם פרטי</p></th>
						<th scope="col"><p>תמונה</p></th>
				  </tr>
				</thead>
				<tbody>
					<?php
					
                    while($row=mysqli_fetch_assoc($result)){
                        echo '<tr><th scope="row"><button class="icon-button imageC" onclick="'.'location.href='."'Detailskids.php?ID=".$row["kids_id"]."'".'";'.'></button></th>';
                        echo '<td><p>'.$row["LastName"].'</p></td>';
                        echo '<td><p>'.$row["FirstName"].'</p></td>';
                        echo '<td><img class="rounded-circle" src="images/'.$row["imagekid"].'"></td></tr>';
					}
					
                    ?>
				</tbody>
			</table>
			<form action="ChildForm.php?ID="><button id="Add" name="ID" class="btn btn-primary btn-success">הוספה</button></form>	
		</main>
	</body>
	<script src="includes/JS+JQ/showNav.js"></script>
</html>
<?php
mysqli_free_result($result);
mysqli_close($connection);
?>