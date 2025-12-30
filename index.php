<?php
session_start();

$password = '';
$hashed = '';
$verify_result = '';

if (isset($_POST['hash'])) {
    $password = $_POST['password'];
    $hashed = password_hash($password, PASSWORD_DEFAULT);
    $_SESSION['hashed_password'] = $hashed;
}

if (isset($_POST['verify'])) {
    $password = $_POST['password'];
    if (isset($_SESSION['hashed_password'])) {
        if (password_verify($password, $_SESSION['hashed_password'])) {
            $verify_result = "match";
        } else {
            $verify_result = "no match";
        }
        $hashed = $_SESSION['hashed_password'];
    }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>Password Hashing</title>
    <style>
        body {
            font-family: Arial;
            background-color: #f0f0f0;
            padding: 50px;
        }
        
        .container {
            background-color: white;
            padding: 30px;
            max-width: 500px;
            margin: 0 auto;
            border: 1px solid #ddd;
        }
        
        h2 {
            text-align: center;
            color: #333;
        }
        
        label {
            display: block;
            margin: 15px 0 5px;
        }
        
        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            font-size: 16px;
        }
        
        button {
            width: 48%;
            padding: 10px;
            margin: 10px 1% 10px 0;
            font-size: 16px;
            cursor: pointer;
        }
        
        .result {
            background-color: #f9f9f9;
            padding: 15px;
            margin-top: 15px;
            border: 1px solid #ddd;
        }
        
        .match {
            background-color: #d4edda;
            color: #155724;
            padding: 15px;
            margin-top: 15px;
            text-align: center;
            font-weight: bold;
        }
        
        .no-match {
            background-color: #f8d7da;
            color: #721c24;
            padding: 15px;
            margin-top: 15px;
            text-align: center;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>تجزئة كلمات المرور</h2>
        
        <form method="POST">
            <label>كلمة المرور:</label>
            <input type="text" name="password" value="<?php echo $password; ?>" required>
            
            <button type="submit" name="hash">تجزئة</button>
            <button type="submit" name="verify">تحقق</button>
        </form>

        <?php if ($password && isset($_POST['hash'])): ?>
            <div class="result">
                <strong>كلمة المرور:</strong><br>
                <?php echo $password; ?>
            </div>
        <?php endif; ?>

        <?php if ($hashed): ?>
            <div class="result">
                <strong>التجزئة:</strong><br>
                <?php echo $hashed; ?>
            </div>
        <?php endif; ?>

        <?php if ($verify_result == "match"): ?>
            <div class="match">Match</div>
        <?php elseif ($verify_result == "no match"): ?>
            <div class="no-match">No Match</div>
        <?php endif; ?>
    </div>
</body>
</html>
