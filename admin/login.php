<?php
include ('./database_file.php');

if (isset($_POST['form_login'])) {
    try {
        $password = $_POST['password'];
        $password = md5($password);

        $statement = $db->prepare("SELECT username, password FROM login WHERE username = ? AND password = ?");
        $statement->execute(array($_POST['username'], $password));

        $num = $statement->rowCount();


        if ($num > 0) {
            session_start();
            $_SESSION['name'] = "my_admin";
            header('location: home.php');
        } else {
            throw new Exception("Invalid username or password!");
        }
    } catch (Exception $e) {
        $error_message = $e->getMessage();
    }
}
?>


<html>
    <head>
        <title>Login sample blog</title>
        <link type="text/css" href="design.css" rel="stylesheet">
    </head>

    <body>

        <div id="login">
            <h1 style="color: #00FFFFFF">Admin Login</h1>

            <?php
            if (isset($error_message)) {
                echo "<span class='error'>" . $error_message . "</span>";
            }
            ?>

            <form action="" method="post">
                <table>
                    <tr>
                        <td style="color: #00FFFFFF">Username:</td>
                        <td><input type="text" name="username"></td>
                    </tr>
                    <tr>
                        <td style="color: #00FFFFFF">Password:</td>
                        <td><input type="Password" name="password"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" value="Login" name="form_login"></td>
                    </tr>
                    <table>
                        <form>
                            </div>
                            </body>
                            </html>

