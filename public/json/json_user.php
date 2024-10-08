<?php
    session_start();
    header('Content-Type: application/json; charset=utf-8');
    $_SESSION['user']['pesan'] = "True : Data pengguna telah diverifikasi, dan diambil kembali";
    echo json_encode($_SESSION['user']);
    unset($_SESSION['user']['pesan']);