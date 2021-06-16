<?php

require_once("configg.php");

if(isset($_POST['register'])){

    // filter data yang diinputkan
    $nama = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING);
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    // enkripsi password
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);


    // menyiapkan query
    $sql = "INSERT INTO register (nama, username, email, password) 
            VALUES (:nama, :username, :email, :password)";
    $stmt = $db->prepare($sql);

    // bind parameter ke query
    $params = array(
        ":nama" => $nama,
        ":username" => $username,
        ":password" => $password,
        ":email" => $email
    );

    // eksekusi query untuk menyimpan ke database
    $saved = $stmt->execute($params);

    // jika query simpan berhasil, maka user sudah terdaftar
    // maka alihkan ke halaman login
    if($saved) header("Location: loginn.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Regis</title>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous" />
        <style>
    body {
        background-color: lightblue;
    }
</style>
</head>
<div class="container">
        <div class="row justify-content-center mt-5">
        <div class="col-md-4">
            <div class="card">
            <div class="card-header bg-transparent mb-0"><h5 class="text-center">Silahkan <span class="font-weight-bold text-primary">REGISTRASI</span></h5></div>
            <div class="card-body">
                <form action="" method="POST">
                <div class="form-group mb-3">
                    <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap">
                </div>
                <div class="form-group mb-3">
                    <input type="text" name="username" class="form-control" placeholder="Username">
                </div>
                <div class="form-group mb-3">
                    <input type="text" name="email" class="form-control" placeholder="Email">
                </div>
                <div class="form-group mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-success btn-block" name="register" value="Daftar" />
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</body>
</html>