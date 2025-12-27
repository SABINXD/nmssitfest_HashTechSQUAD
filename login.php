<?php
session_start();

// Database connection
$host = "localhost";
$user = "root";
$pass = "";
$db = "login_system";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";
$messageType = "";

// Handle Registration
if (isset($_POST['register'])) {
    $firstName = trim($_POST['firstName']);
    $lastName = trim($_POST['lastName']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    
    // Check if email exists
    $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $result = $check->get_result();
    
    if ($result->num_rows > 0) {
        $message = "Email already exists!";
        $messageType = "error";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $insert = $conn->prepare("INSERT INTO users (firstName, lastName, email, password) VALUES (?, ?, ?, ?)");
        $insert->bind_param("ssss", $firstName, $lastName, $email, $hashedPassword);
        
        if ($insert->execute()) {
            $message = "Registration successful! You can now login.";
            $messageType = "success";
        } else {
            $message = "Registration failed: " . $conn->error;
            $messageType = "error";
        }
    }
}

// Handle Login
if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['firstName'] = $user['firstName'];
            $_SESSION['lastName'] = $user['lastName'];
            
            header("Location: parent-dashboard.html");
            exit();
        } else {
            $message = "Incorrect password!";
            $messageType = "error";
        }
    } else {
        $message = "Email not found!";
        $messageType = "error";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Register</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        
        .container {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            width: 90%;
            max-width: 450px;
            background-attachment: fixed
            max-height: 100vh;     
            overflow-y: auto;
            margin-right: 180px;
        }
        
        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }
        
        .logo {
            text-align: center;
            margin-bottom: 25px;
            margin: right 20px;
        }
        
        .logo img {
            max-width: 315px;
            height: auto;
        }
        
        .message {
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 5px;
            text-align: center;
        }
        
        .message.success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .message.error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        .form-group {
            position: relative;
            margin-bottom: 20px;
        }
        
        .form-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #667eea;
        }
        
        .form-group input {
            width: 100%;
            padding: 12px 15px 12px 45px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
        }
        
        .form-group input:focus {
            outline: none;
            border-color: #667eea;
        }
        
        .btn {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 10px;
        }
        
        .btn:hover {
            opacity: 0.9;
        }
        
        .switch-form {
            text-align: center;
            margin-top: 20px;
            color: #666;
        }
        
        .switch-form a {
            color: #667eea;
            text-decoration: none;
            font-weight: bold;
        }
        
        .switch-form a:hover {
            text-decoration: underline;
        }
        
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <!-- Login Form -->
    <div class="container" id="loginForm">
        <div class="logo">
            <img src="logo.png" alt="Logo">
        </div>
        <h1>Sign In</h1>
        
        <?php if ($message && isset($_POST['login'])): ?>
            <div class="message <?php echo $messageType; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
        
        <form method="POST" action="">
            <div class="form-group">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" placeholder="Email" required>
            </div>
            <div class="form-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <button type="submit" name="login" class="btn">Sign In</button>
        </form>
        
        <div class="switch-form">
            Don't have an account? <a href="#" onclick="showRegister(); return false;">Sign Up</a>
        </div>
    </div>
    
    <!-- Register Form -->
    <div class="container hidden" id="registerForm">
        <div class="logo">
            <img src="logo.png" alt="Logo">
        </div>
        <h1>Register</h1>
        
        <?php if ($message && isset($_POST['register'])): ?>
            <div class="message <?php echo $messageType; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
        
        <form method="POST" action="">
            <div class="form-group">
                <i class="fas fa-user"></i>
                <input type="text" name="firstName" placeholder="First Name" required>
            </div>
            <div class="form-group">
                <i class="fas fa-user"></i>
                <input type="text" name="lastName" placeholder="Last Name" required>
            </div>
            <div class="form-group">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" placeholder="Email" required>
            </div>
            <div class="form-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" placeholder="Password (min 6 characters)" minlength="6" required>
            </div>
            <button type="submit" name="register" class="btn">Sign Up</button>
        </form>
        
        <div class="switch-form">
            Already have an account? <a href="#" onclick="showLogin(); return false;">Sign In</a>
        </div>
    </div>
    
    <script>
        function showRegister() {
            document.getElementById('loginForm').classList.add('hidden');
            document.getElementById('registerForm').classList.remove('hidden');
        }
        
        function showLogin() {
            document.getElementById('registerForm').classList.add('hidden');
            document.getElementById('loginForm').classList.remove('hidden');
        }
        
        <?php if (isset($_POST['register'])): ?>
            showRegister();
        <?php endif; ?>
    </script>
</body>
</html>