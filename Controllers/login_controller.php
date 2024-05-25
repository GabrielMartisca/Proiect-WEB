<?php

include '../Models/login_model.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verifyLogin();
}


include '../Views/login_view.php';

