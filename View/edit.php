<?php
$userId = $_GET['user_id'];

include_once '../Repository/userRepository.php';

$userRepository = new UserRepository();

$user  = $userRepository->getUserById($userId);

if(isset($_POST['editBtn'])){
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $userRepository->updateUser($userId, $name, $surname, $email, $password);

    header("location:dashboard.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>
<body style="background: #1c1c1c; color: white; font-family: Arial, sans-serif;">

    <div style="width: 50%; margin: 50px auto; padding: 25px; background: #222; color: white; border-radius: 12px; box-shadow: 0 0 12px rgba(255, 255, 255, 0.15);">
        <h3 style="text-align: center; font-size: 22px; margin-bottom: 15px;">Edit User</h3>

        <form action="" method="post">
            <label style="display: block; margin: 10px 0 5px; font-weight: bold;">User ID:</label>
            <input type="text" name="id" value="<?=$user['user_id']?>" readonly 
                style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #555; background: #333; color: white;">

            <label style="display: block; margin: 10px 0 5px; font-weight: bold;">Name:</label>
            <input type="text" name="name" value="<?=$user['name']?>" required 
                style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #555; background: #333; color: white;">

            <label style="display: block; margin: 10px 0 5px; font-weight: bold;">Surname:</label>
            <input type="text" name="surname" value="<?=$user['surname']?>" required 
                style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #555; background: #333; color: white;">

            <label style="display: block; margin: 10px 0 5px; font-weight: bold;">Email:</label>
            <input type="email" name="email" value="<?=$user['email']?>" required 
                style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #555; background: #333; color: white;">

            <label style="display: block; margin: 10px 0 5px; font-weight: bold;">Password:</label>
            <input type="text" name="password" value="<?=$user['password']?>" required 
                style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #555; background: #333; color: white;">

            <button type="submit" name="editBtn" 
                style="width: 100%; margin-top: 15px; padding: 12px; background: crimson; color: white; font-size: 16px; font-weight: bold; border: none; border-radius: 6px; cursor: pointer; transition: 0.3s;">
                Save Changes
            </button>
        </form>
    </div>

</body>
</html>
