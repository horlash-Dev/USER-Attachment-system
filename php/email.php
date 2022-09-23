<?php 
require_once 'includes/session.in.php';
session_start();
$users = new session;
 $users->currentUser();
$command= new controller;
    if ($command->Mail($users->cUser) != null) {
        if ($command->nysc_mails(1,$users->cid) == false) {
            header("Location:verify.php");
			exit();
        }else{
            header("Location:dashboard-page.php");
			exit();
        }

    }else{
            header("Location:dashboard-page.php");
			exit();
        }
