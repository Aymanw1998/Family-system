<?php
		include 'db.php';
        $i=$_GET["ID"];
        mysqli_set_charset($connection, "utf8");
        
        $query= "DELETE FROM tbl_posts_219 WHERE kids_id=$i";
        $result = mysqli_query($connection , $query);
        
        $query= "DELETE FROM tbl_message_219 WHERE id=$i OR to_id=$i";
        $result = mysqli_query($connection , $query);

        header("location:feedback.php?ID=$i&firstName=$f&lastName=$l&btn=delete&user=");
       
        mysqli_close($connection);
?>