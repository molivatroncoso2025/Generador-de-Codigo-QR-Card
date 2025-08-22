<?php
// Requiere la librería PHP QR Code (puedes instalarla con composer o descargarla)
require_once __DIR__ . '/phpqrcode/qrlib.php';

function limpiar($valor) {
    return htmlspecialchars(trim($valor));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = limpiar($_POST['nombre'] ?? '');
    $apellido = limpiar($_POST['apellido'] ?? '');
    $empresa = limpiar($_POST['empresa'] ?? '');
    $cargo = limpiar($_POST['cargo'] ?? '');
    $telefono = limpiar($_POST['telefono'] ?? '');
    $email = limpiar($_POST['email'] ?? '');
    $direccion = limpiar($_POST['direccion'] ?? '');
    $web = limpiar($_POST['web'] ?? '');

    $vcard = "BEGIN:VCARD\nVERSION:3.0\n";
    $vcard .= "N:$apellido;$nombre\n";
    $vcard .= "FN:$nombre $apellido\n";
    if ($empresa) $vcard .= "ORG:$empresa\n";
    if ($cargo) $vcard .= "TITLE:$cargo\n";
    if ($telefono) $vcard .= "TEL;TYPE=CELL:$telefono\n";
    if ($email) $vcard .= "EMAIL:$email\n";
    if ($direccion) $vcard .= "ADR;TYPE=WORK:;;$direccion\n";
    if ($web) $vcard .= "URL:$web\n";
    $vcard .= "END:VCARD";

    // Generar QR temporal
    $filename = 'temp_qr_' . uniqid() . '.png';
    $filepath = __DIR__ . '/qrs/' . $filename;
    if (!is_dir(__DIR__ . '/qrs')) {
        mkdir(__DIR__ . '/qrs', 0777, true);
    }
    QRcode::png($vcard, $filepath, QR_ECLEVEL_Q, 6);

    // Redirigir para mostrar el QR
    header('Location: index.php?qr=qrs/' . $filename);
    exit;
}
