<?php

/*
  Uploadify
  Copyright (c) 2012 Reactive Apps, Ronnie Garcia
  Released under the MIT License <http://www.opensource.org/licenses/mit-license.php>
 */

// Define a destination
$targetFolder = '/uploads';
$userfile_name = str_replace(' ', '_', $_FILES['userfile']['name']);

if (file_exists($_SERVER['DOCUMENT_ROOT'] . $targetFolder . '/' . $userfile_name)) {
    echo 1;
    print_r('exist');
//    return false;
} else {
    echo 0;
    print_r('d"ont exist');
//    return false;
}

//echo json_encode($_FILES['userfile']);
//return json_encode($_FILES['userfile']);
?>