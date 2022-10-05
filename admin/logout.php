<?php

include('../config/constants.php');

session_destroy();

header("location:http://localhost/Restaurent/admin/login.php");
