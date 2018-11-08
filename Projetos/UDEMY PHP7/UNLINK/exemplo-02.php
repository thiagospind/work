<?php
/**
 * Created by PhpStorm.
 * User: 00660
 * Date: 11/10/2018
 * Time: 10:48
 */

if (!is_dir("images")) mkdir("images");

foreach (scandir("images") as $item) {
    if(!in_array($item,array(".",".."))){
        unlink("images/" . $item);
    }
}

echo "Ok";