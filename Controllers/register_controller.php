<?php

include '../Models/register_model.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verifyRegister();
}


include '../Views/register_view.php';

