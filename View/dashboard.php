<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SESSION['role'] !== 'admin') {
    header("Location: dashboard.php");
    exit;
}

echo "Welcome to the Admin Dashboard!";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/dashboard.css">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #222;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .dashboard-container {
            background-color:rgb(103, 20, 34);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 1200px;
        }

        h1 {
            text-align: center;
            color: #111;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: rgb(0, 0, 0);
            color: white;
        }

        tr {
            background-color:rgba(180, 180, 180, 0.22) ;
        }

        tr:hover {
            background-color: rgb(180, 180, 180);
        }

        .action-links a {
            text-decoration: none;
            color:rgb(255, 0, 0);
            margin-right: 10px;
        }

        .action-links a:hover {
            text-decoration: underline;
        }

        .logout-btn {
            display: block;
            width: 100%;
            text-align: center;
            margin-top: 20px;
        }

        .logout-btn a {
            text-decoration: none;
            color: #fff;
            background-color: rgb(36, 36, 36);
            padding: 10px 20px;
            border-radius: 5px;
        }

        .logout-btn a:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <h1>Admin Dashboard</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Surname</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include_once '../Repository/userRepository.php';

                $userRepository = new UserRepository();
                $user_id = $_SESSION['user_id'];
                $user = $userRepository->getAdmin($user_id);

                if ($user) {
                    echo "
                    <tr>
                        <td>{$user['user_id']}</td>
                        <td>{$user['name']}</td>
                        <td>{$user['surname']}</td>
                        <td>{$user['email']}</td>
                        <td>{$user['password']}</td>
                        <td class='action-links'><a href='edit.php?user_id={$user['user_id']}'>Edit</a></td>
                        <td class='action-links'><a href='delete.php?user_id={$user['user_id']}'>Delete</a></td>
                    </tr>
                    ";
                }
                ?>
            </tbody>
        </table>
        <div class="logout-btn">
            <a href="logout.php">Logout</a>
        </div>
    </div>
</body>
</html>