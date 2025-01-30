<?php
session_start();

echo "Welcome to the Admin Dashboard! <br>";
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SESSION['role'] !== 'admin') {
    header("Location: dashboard.php");
    exit;
}



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include_once '../Repository/brandRepository.php';
    
    
    $name = $_POST['name'];
    $description = $_POST['description'];
    $image = $_FILES['image']['name']; 

    
    $target_dir = "../uploads";
    $target_file = $target_dir . basename($image);
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
        
        $brandRepository = new BrandRepository();
        $brandRepository->addBrand($name, $image, $description);
    } else {
        echo "Gabim në ngarkimin e imazhit!";
    }

}


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
           
            height: 100vh;
        }

        .dashboard-container {
            background-color:rgb(103, 20, 34);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 1200px;
            overflow: auto;
            
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

        <div class="contact-form-entries">
    <h2>Mesazhet nga Formulari i Kontaktit</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Emri</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Mesazhi</th>
                <th>Data</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include_once '../Repository/contactFormRepository.php'; 
            $contactFormRepository = new ContactFormRepository();
            $entries = $contactFormRepository->getAllEntries(); 

            foreach ($entries as $entry) {
                echo "
                <tr>
                    <td>{$entry['id']}</td>
                    <td>{$entry['name']}</td>
                    <td>{$entry['email']}</td>
                    <td>{$entry['phone']}</td>
                    <td>{$entry['message']}</td>
                    <td>{$entry['created_at']}</td>
                </tr>
                ";
            }
            ?>
        </tbody>
    </table>
</div>

        <div class="add-brand">
    <h2>Shto Brand</h2>
    <form method="POST" enctype="multipart/form-data">
    <label for="name">Brand Name:</label>
    <input type="text" name="name" required>
    <br>

    <label for="description">Description:</label>
    <textarea name="description" required></textarea>
    <br>

    <label for="image">Image:</label>
    <input type="file" name="image" required>
    <br>

    <button type="submit">Add Brand</button>
</form>
</div>
<div class="brand-list">
    <h2>Lista e Brendeve</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Emri</th>
                <th>Përshkrimi</th>
                <th>Imazhi</th>
                <th>Veprime</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include_once '../Repository/brandRepository.php';
            $brandRepository = new BrandRepository();
            $brands = $brandRepository->getAllBrands();

            foreach ($brands as $brand) {
                echo "
                <tr>
                    <td>{$brand['id']}</td>
                    <td>{$brand['name']}</td>
                    <td>{$brand['description']}</td>
                    <td><img src='{$brand['image']}' alt='{$brand['name']}' width='100'></td>
                    <td class='action-links'>
                        <a href='../View/edit_brand.php?id={$brand['id']}'>Edit</a>
                        <a href='../View/delete_brand.php?id={$brand['id']}'>Delete</a>
                    </td>
                </tr>
                ";
            }
            ?>
        </tbody>
    </table>
</div>

        <div class="logout-btn">
            <a href="../logout.php">Logout</a>
        </div>
    </div>
</body>
</html>