<?php
session_start(); 

if (empty($_SESSION['ss_username'])) {
    header('Location: index.php');
    exit;
}

$username = $_SESSION['ss_username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-screen flex items-center justify-center bg-gray-900 text-white">
    <div class="text-center">
        <h1 class="text-2xl font-bold">Welcome <?php echo htmlspecialchars($username); ?></h1>
        <p class="mt-4">You are logged in</p>
        <form method="post" action="home.php">
            <button class="mt-4 px-4 py-2 bg-red-500 rounded hover:bg-red-600 text-white">Logout</button>
        </form>
    </div>
</body>
</html>

<?php 

if ($_SERVER['REQUEST_METHOD'] == "POST"){

    session_unset();
    session_destroy();
    header("location: index.php");
    exit;

}

?>