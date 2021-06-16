<?php
$koneksi = new mysqli ("localhost", "root", "", "login-registrasi")
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
            <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous" />
<style>
    body {
        background-color: lightblue;
    }
</style>
</head>

<body>
<div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-transparent mb-0"><h5 class="text-center">Silahkan <span class="font-weight-bold text-primary">LOGIN</span></h5></div>
                <div class="card-body">
                <form action="" method="POST">
                    <div class="form-group mb-3">
                        <input type="text" name="username" class="form-control" placeholder="Username">
                    </div>
                    <div class="form-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                    </div>
                    <div class="form-group custom-control custom-checkbox mb-4">
                        <input type="checkbox" class="custom-control-input" id="customControlAutosizing">
                    <label class="custom-control-label" for="customControlAutosizing">Remember me</label>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="login" value="Login" class="btn btn-primary btn-block">
                        <a href="regiss.php" class="btn btn-md btn-success text-light" style="background-color: #0ffff; ">Registrasi</a>
                    </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>

    <?php 
        require_once("configg.php");

        if(isset($_POST['login'])){

        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

        $sql = "SELECT * FROM register WHERE username=:username";
        $stmt = $db->prepare($sql);
    
        // bind parameter ke query
        $params = array(
            ":username" => $username,
        );

        $stmt->execute($params);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // jika user terdaftar
        if($user){
            // verifikasi password
            if(password_verify($password, $user["password"])){
                // buat Session
                session_start();
                $_SESSION["user"] = $user;
                // login sukses, alihkan ke halaman timeline
                header("Location: admin.php");
            }
        }
    }
    ?>
</body>
</html>