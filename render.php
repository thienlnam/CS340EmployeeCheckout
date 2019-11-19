<?php

    function renderNames() {
        $result = selectUsers();
        while($row = mysqli_fetch_array($result)){
            echo("<h1>$row[firstName]</h1>");
        }
    }


?>