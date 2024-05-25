<?php

include '../Models/reset_password_model.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    changePassword();
}


include '../Views/reset_password_view.php';

