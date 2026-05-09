<?php
session_start();

require '../config/database.php';

// ================= VALIDATE CLIENT ID =================
$client_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$client_id) {
    $_SESSION['client_success'] = "Invalid client ID.";
    header("Location: ../index.php");
    exit;
}

try {

    // ================= CHECK IF CLIENT EXISTS =================
    $stmt = $conn->prepare("
        SELECT client_id
        FROM clients
        WHERE client_id = ?
    ");
    $stmt->execute([$client_id]);
    $client = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$client) {
        $_SESSION['client_success'] = "Client not found.";
        header("Location: ../index.php");
        exit;
    }

    // ================= DELETE CLIENT =================
    $stmt = $conn->prepare("
        DELETE FROM clients
        WHERE client_id = ?
    ");
    $stmt->execute([$client_id]);

    $_SESSION['client_success'] = "Client deleted successfully.";

    header("Location: ../index.php");
    exit;

} catch (PDOException $e) {

    $_SESSION['client_success'] = "Error deleting client.";
    header("Location: ../index.php");
    exit;
}
?>