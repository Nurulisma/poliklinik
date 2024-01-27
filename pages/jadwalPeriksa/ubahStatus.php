<?php
include '../../config/koneksi.php';
session_start();

    $id = $_POST['id'];
    $status = $_POST['status'];
    $id_dokter = $_SESSION['id'];

    if($status == 'Y'){
        $queryUbahStatus = mysqli_query($mysqli,"UPDATE jadwal_periksa SET status = 'T' WHERE id = '$id'");

        if ($queryUbahStatus) {
            echo '<script>alert("Jadwal tidak aktif");window.location.href="../../jadwalPeriksa.php";</script>';
        }
        else{
            echo '<script>alert("Error");window.location.href="../../jadwalPeriksa.php";</script>';
        }
    }
    else if ($status == 'T') {
        $dapatStatus = mysqli_query($mysqli,"SELECT COUNT(*) AS aktif FROM jadwal_periksa WHERE id_dokter = '$id_dokter' AND status = 'Y'");
        $data = mysqli_fetch_assoc($dapatStatus);
        if ($data['aktif']>0){
            echo '<script>alert("Perubahan gagal");window.location.href="../../jadwalPeriksa.php";</script>';
        }
        else {
            $queryUbahStatus = mysqli_query($mysqli,"UPDATE jadwal_periksa SET status = 'Y' WHERE id = '$id'");
        
            if ($queryUbahStatus) {
                echo '<script>alert("Jadwal aktif");window.location.href="../../jadwalPeriksa.php";</script>';
            }
            else{
                echo '<script>alert("Error");window.location.href="../../jadwalPeriksa.php";</script>';
            }
        }
    }

mysqli_close($mysqli);
?>