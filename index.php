<?php
        include 'includes/php/db.php';
        session_start();
        if(!empty($_POST["loginMail"])){
            $i=$_POST["loginMail"];
            $p=$_POST["loginPass"];
            $query="SELECT * FROM tbl_posts_219,tbl_users_219 WHERE (user_id=$i AND password='$p') OR (kids_id=$i)";
            $result = mysqli_query($connection , $query);
            $row = mysqli_fetch_array($result);
            if(is_array($row)){
                if($i==$row["user_id"]){
                $_SESSION["id"]= $row["user_id"];$_SESSION["pass"]= $row["password"];
                header('Location:listkids.php');
                }
                else{
                $_SESSION["id"]= $row["kids_id"];$_SESSION["pass"]="";
                header('Location:MyprofileKid.php');
                }
            }
            else{$message="אם אתה הורה אז ות.ז. או הסיסמה שגויה או אם אתה ילד אז רק הת.ז. שלך שגויה";}
        }
      
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Child Safety-Login</title>
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
    <body id="Login">
        <div class="container">
            <h1 class="text-right">כניסת משתמש</h1>
            <form action="#" method="post" id="frm">
                <div class="form-group text-right">
                    <label for="loginMail">תעודת זהות </label>
                    <input type="" class="form-control" name="loginMail" id="loginMail"
                    aria-describedby="emailHelp" placeholder="תעודת זהות שלך">
                </div>
                <div class="form-group text-right">
                    <label for="exampleInputPassword1">:סיסמא </label>
                    <input type="password" class="form-control" name="loginPass" id="loginPass"
                    placeholder="(הסיסמא(אם יש">
                </div>
                <div class="error-message text-right text-danger"><?php if(isset($message)) { echo $message; } ?></div>
                <button type="submit" class="btn btn-primary">כניסה</button>
            </form>
        </div>
    </body>
</html>
<?php
?>