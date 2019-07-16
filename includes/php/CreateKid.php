<?php
		include 'db.php';
        
        mysqli_set_charset($connection, "utf8");
        
        $i=$_POST["ID"];
        $iP=$_POST["IDP"];
        $f=$_POST["firstName"];
        $l=$_POST["lastName"];
        $g=$_POST["gender"];
        $p1=$_POST["phone"];
        $p2=$_POST["phone2"];
        $m=$_POST["mail"];
        $img=$_POST["image"];
        
        $query= "SELECT kids_id FROM tbl_posts_219 WHERE kids_id=$i";
        $result = mysqli_query($connection , $query);
        $row = mysqli_fetch_array($result);
        
        if($row["kids_id"]==""){
            $query= "INSERT INTO tbl_posts_219 (kids_id,FirstName,LastName,gander,PhoneMain,PhoneSec,Email,imagekid,id_user_parent)VALUES('$i','$f','$l','$g','$p1','$p2','$m','$img','$iP')"; echo $query;
            $result = mysqli_query($connection , $query);
         
            $query= "INSERT INTO tbl_message_219 (id) VALUES('$i')";
            $result = mysqli_query($connection , $query);
         
            header("location:feedback.php?ID=$i&firstName=$f&lastName=$l&btn=insert&user=");
        }
        else{
            header("location:feedback.php?ID=$i&firstName=$f&lastName=$l&btn=NoNew&user=");
        }
        mysqli_close($connection);
        ?>