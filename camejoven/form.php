<?php

try {
    $db = new PDO('mysql:host=localhost;dbname=camejoven_g20', 'camejoven_g20', 'S79m29kCi');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $db->prepare('INSERT INTO inscripciones (contact_name, passport, pais, asociacion, email, telefono, cargo, fechallegada, fechapartida, titular, tipoTarjeta, numeroTarjeta, vencimiento, cvv2) VALUES (:contact_name, :passport, :pais, :asociacion, :email, :telefono, :cargo, :fechallegada, :fechapartida, :titular, :tipoTarjeta, :numeroTarjeta, :vencimiento, :cvv2)');
    $stmt->bindParam(':contact_name', $_POST['contact_name']);
    $stmt->bindParam(':passport', $_POST['passport']);
    $stmt->bindParam(':pais', $_POST['pais']);
    $stmt->bindParam(':asociacion', $_POST['asociacion']);
    $stmt->bindParam(':email', $_POST['email']);
    $stmt->bindParam(':telefono', $_POST['telefono']);
    $stmt->bindParam(':cargo', $_POST['cargo']);
    $stmt->bindParam(':fechallegada', $_POST['fechallegada']);
    $stmt->bindParam(':fechapartida', $_POST['fechapartida']);
    $stmt->bindParam(':titular', $_POST['titular']);
    $stmt->bindParam(':tipoTarjeta', $_POST['tipoTarjeta']);
    $stmt->bindParam(':numeroTarjeta', $_POST['numeroTarjeta']);
    $stmt->bindParam(':vencimiento', $_POST['vencimiento']);
    $stmt->bindParam(':cvv2', $_POST['cvv2']);
    $stmt->execute();

    echo success;
} catch (Exception $e) {
    var_dump($e);
}