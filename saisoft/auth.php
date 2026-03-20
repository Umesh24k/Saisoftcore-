<?php
session_start();
include 'db.php';
// Login/Register Logic remains same as previous, just update HTML below
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login | Sai Soft Infosys</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="auth-body">
    <div class="auth-card">
        <h1>SAI SOFT INFOSYS</h1>
        <form method="POST">
            <input type="email" name="email" placeholder="Email Address" required style="width:100%; padding:10px; margin-bottom:10px;">
            <input type="password" name="password" placeholder="Password" required style="width:100%; padding:10px; margin-bottom:10px;">
            <button name="login" style="width:100%; padding:12px; background:var(--tally-blue); color:white; border:none; border-radius:5px;">Sign In</button>
        </form>
        <p style="margin-top:20px;">Don't have an account? <a href="register.php">Register here</a></p>
    </div>
</body>
</html>