<?php

    // Choosing the character image based on numeric input
    function characterToImage(int $number){
        $imageFile = "images/characters/";
        $imageFile .= $number;
        $imageFile .= ".png";
        return $imageFile;
    }

    // Choosing the area image based on numeric input
    function levelToImage(int $number){
        $imageFile = "images/places/";
        if ($number >= 1 && $number <= 4){
            $imageFile .= 1;
        }
        elseif ($number >= 5 && $number <= 8){
            $imageFile .= 2;
        }
        elseif ($number >= 9 && $number <= 12){
            $imageFile .= 3;
        }
        elseif ($number == 13){
            $imageFile .= 4;
        }
        elseif ($number >= 14 && $number <= 17){
            $imageFile .= 5;
        }
        elseif ($number == 18){
            $imageFile .= 6;
        }
        elseif ($number >= 19 && $number <= 21){
            $imageFile .= 7;
        }
        elseif ($number == 22){
            $imageFile .= 8;
        }
        elseif ($number == 23){
            $imageFile .= 7;
        }
        elseif ($number == 24){
            $imageFile .= 9;
        }
        elseif ($number == 25){
            $imageFile .= 10;
        }
        elseif ($number >= 26 && $number <= 28){
            $imageFile .= 11;
        }
        elseif ($number == 29){
            $imageFile .= 12;
        }
        elseif ($number >= 30 && $number <= 31){
            $imageFile .= 13;
        }
        elseif ($number == 32){
            $imageFile .= 14;
        }
        elseif ($number == 33){
            $imageFile .= 13;
        }
        elseif ($number == 34){
            $imageFile .= 15;
        }
        elseif ($number == 35){
            $imageFile .= 16;
        }
        $imageFile .= ".png";
        return $imageFile;
    }

    // function to change the table's sorting order, reverse ascending/descending if same type of sort before
    function reload(int $pageParam, string $sortParam, string $orderParam, string $previousSort){
        if ($sortParam == $previousSort) {
            if ($orderParam == 'ASC'){
                $orderParam = 'DESC';
            }
            else{
                $orderParam = 'ASC';
            }
        }
        return "index.php?page=" . $pageParam . '&sort=' . $sortParam . '&order=' . $orderParam;
    }

    // same function as above, but for a player page only
    function userReload(int $pageParam, int $user, string $sortParam, string $orderParam, string $previousSort){
        if ($sortParam == $previousSort) {
            if ($orderParam == 'ASC'){
                $orderParam = 'DESC';
            }
            else{
                $orderParam = 'ASC';
            }
        }
        return "stats.php?page=" . $pageParam . '&sort=' . $sortParam . '&order=' . $orderParam . '&user=' . $user;
    }

?>
