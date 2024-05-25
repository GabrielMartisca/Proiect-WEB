<?php

include '../Models/forgot_model.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    sendForgotMail();
}


include '../Views/forgot_view.php';

