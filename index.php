<?php
session_start();
include 'db.php';

// Login/Register Logic
if(isset($_POST['auth_action'])){
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = $_POST['password'];
    
    if($_POST['auth_action'] == 'register'){
        $user = mysqli_real_escape_string($conn, $_POST['username']);
        $hash = password_hash($pass, PASSWORD_DEFAULT);
        mysqli_query($conn, "INSERT INTO users (username, email, password) VALUES ('$user', '$email', '$hash')");
        echo "<script>alert('Registration Successful! Please Login.');</script>";
    } else {
        $res = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
        if($row = mysqli_fetch_assoc($res)){
            if(password_verify($pass, $row['password'])){
                $_SESSION['user'] = $row['username'];
                $_SESSION['id'] = $row['id'];
                header("Location: dashboard.php");
            } else { echo "<script>alert('Wrong Password');</script>"; }
        } else { echo "<script>alert('User not found');</script>"; }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sai Soft Infosys | Home</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>
<body class="dynamic-bg">

    <header class="public-nav">
        <h1 class="logo-3d">SAI SOFT INFOSYS</h1>
        <div class="auth-trigger">Hover Laptop to Login ↓</div>
    </header>

    <section class="info-hero">
        <div class="glass-card">
            <h2>Trusted Expertise Since 2008</h2>
            <p>15+ Years of Experience in Tally Solutions. Based in Chhatrapati Sambhajinagar, serving Jalna and beyond.</p>
        </div>
    </section>

    <section class="services-grid">
        <div class="card"><h3>Sales & Support</h3><p>Tally Products Expert Assistance</p></div>
        <div class="card"><h3>Customizations</h3><p>TallyPrime Custom Solutions</p></div>
        <div class="card"><h3>Training</h3><p>Corporate Tally Training</p></div>
        <div class="card"><h3>Cloud</h3><p>AWS & Azure Cloud Solutions</p></div>
    </section>

    <div class="laptop-container">
        <div class="laptop-screen">
            <div class="auth-form-box">
                <h2 id="auth-title">Business Login</h2>
                <form method="POST">
                    <div id="reg-extra" style="display:none;">
                        <input type="text" name="username" placeholder="Full Name">
                    </div>
                    <input type="email" name="email" placeholder="Business Email" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <button type="submit" name="auth_action" id="auth-btn" value="login" class="btn-3d">Enter System</button>
                </form>
                <p onclick="toggleAuth()" class="toggle-link">New Client? Register Here</p>
            </div>
        </div>
    </div>

    <script>
        function toggleAuth(){
            const extra = document.getElementById('reg-extra');
            const title = document.getElementById('auth-title');
            const btn = document.getElementById('auth-btn');
            if(extra.style.display === 'none'){
                extra.style.display = 'block';
                title.innerText = 'Client Registration';
                btn.value = 'register';
                btn.innerText = 'Create Account';
            } else {
                extra.style.display = 'none';
                title.innerText = 'Business Login';
                btn.value = 'login';
                btn.innerText = 'Enter System';
            }
        }
    </script>
</body>
</html>