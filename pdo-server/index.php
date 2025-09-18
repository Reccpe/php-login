<?php

use database_config\database_config;

require_once('database_config.php');
session_start();

if (isset($_SESSION['ss_username'])){
  header("location: home.php");
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] == "POST"){
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (isset($_POST['loginBtn'])){

        $db = new database_config('localhost','root','','mydata');

        if ($db->err){
            $error = $db->err;
        }
        else {
            if ($db->login($username,$password)){
              $_SESSION['ss_username'] = $username;
                header('location: home.php');
                exit;
            }
            else{
                $error = "Username or password is incorrect";
            }
        }

    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-screen flex items-center justify-center bg-gray-900">

  <div class="flex flex-col space-y-4 bg-white p-6 rounded-xl shadow-lg items-center">
    <label class="font-bold text-4xl mb-5 text-center">Login</label>

    <?php if(!empty($error)): ?>
      <div class="text-red-600 font-bold animate-bounce mb-2"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST" class="flex flex-col space-y-4 items-center">
        <input type="text" name="username" class="border p-2 rounded w-64 border-2 border-indigo-300" placeholder="Username">
        <input type="password" name="password" class="border p-2 rounded w-64 border-2 border-indigo-300" placeholder="Password">
        <input type="submit" value="Log in" name="loginBtn" class="border p-2 rounded bg-blue-500 text-white cursor-pointer w-64">
    </form>
  </div>

</body>
</html>
