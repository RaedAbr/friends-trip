<?php
include_once 'includes.php';

Session::destroy_session();
header("Location: signin_view.php");