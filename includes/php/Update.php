<?php
		include 'db.php';
        mysqli_set_charset($connection, "utf8");
        
        $i=$_POST["ID"];
        $f=$_POST["firstName"];
        $l=$_POST["lastName"];
        $g=$_POST["gender"];
        $p1=$_POST["phone"];
        $p2=$_POST["phone2"];
        $img=$_POST["image"];    
        $m=$_POST["mail"];

        $query="UPDATE  `studDB19a`.`tbl_posts_219` SET  `FirstName` =  '$f',`LastName` =  '$l',`gander` =  '$g',`PhoneMain` =  '$p1',`PhoneSec` =  '$p2',`Email` =  '$m',
        `imagekid` =  '$img' WHERE  `tbl_posts_219`.`kids_id` =$i";echo $query;
        $result = mysqli_query($connection , $query);
        
        header("location:feedback.php?ID=$i&firstName=$f&lastName=$l&btn=update&user=".$_GET["user"]."");
        
        mysqli_free_result($result);
        mysqli_close($connection);
        ?>