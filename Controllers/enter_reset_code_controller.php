<?php

include '../Models/enter_reset_code_model.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   checkCode();
}


include '../Views/enter_reset_code_view.php';

