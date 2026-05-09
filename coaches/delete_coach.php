<?php
session_start();

require '../config/database.php';

// ================= VALIDATE ID =================
$coach_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$coach_id) {

    $_SESSION['success'] = "Invalid coach ID.";

    header("Location: ../index.php");
    exit;
}

try {

    // ================= CHECK CLIENTS =================
    $stmt = $conn->prepare("
        SELECT COUNT(*) 
        FROM clients
        WHERE coach_id = ?
    ");

    $stmt->execute([$coach_id]);

    $clientCount = $stmt->fetchColumn();

    // ================= PREVENT DELETE =================
    if ($clientCount > 0) {

        $_SESSION['success'] =
            "Cannot delete coach because clients are still assigned.";

        header("Location: ../index.php");
        exit;
    }

    // ================= DELETE COACH =================
    $stmt = $conn->prepare("
        DELETE FROM coaches
        WHERE coach_id = ?
    ");

    $stmt->execute([$coach_id]);

    $_SESSION['coach_success'] = "Coach deleted successfully!";

    header("Location: ../index.php");
    exit;

} catch (PDOException $e) {

    $_SESSION['success'] = "Database Error: " . $e->getMessage();

    header("Location: ../index.php");
    exit;
}
?>