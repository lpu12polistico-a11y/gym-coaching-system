<?php
require '../config/database.php';

$error = "";
$success = "";

$coach_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$coach_id) {
    header("Location: ../index.php");
    exit;
}

$stmt = $conn->prepare("SELECT * FROM coaches WHERE coach_id = ?");
$stmt->execute([$coach_id]);
$coach = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$coach) {
    exit("
        <script>
            alert('Coach not found.');
            window.location.href='../index.php';
        </script>
    ");
}

if (isset($_POST['update_coach'])) {

    $coach_name = trim($_POST['coach_name']);
    $specialty  = trim($_POST['specialty']);

    if (empty($coach_name) || empty($specialty)) {
        $error = "Please complete all fields correctly.";
    } elseif (strlen($coach_name) < 2) {
        $error = "Coach name must be at least 2 characters.";
    } else {
        try {
            $stmt = $conn->prepare("
                UPDATE coaches
                SET coach_name = ?, specialty = ?
                WHERE coach_id = ?
            ");

            $stmt->execute([$coach_name, $specialty, $coach_id]);

            $success = "Coach updated successfully!";

            $stmt = $conn->prepare("SELECT * FROM coaches WHERE coach_id = ?");
            $stmt->execute([$coach_id]);
            $coach = $stmt->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            $error = "Error updating coach.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Coach</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            min-height: 100vh;
            padding: 30px;
        }

        .container {
            max-width: 500px;
            margin: 60px auto;
            background: #ffffff;
            padding: 35px;
            border-radius: 14px;
            box-shadow: 0 6px 18px rgba(0,0,0,0.12);
        }

        h1 {
            text-align: center;
            margin-bottom: 8px;
            color: #222;
        }

        .subtitle {
            text-align: center;
            color: #666;
            margin-bottom: 25px;
            font-size: 14px;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
            color: #333;
        }

        input {
            width: 100%;
            padding: 12px;
            margin-top: 7px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 15px;
        }

        input:focus {
            outline: none;
            border-color: #007BFF;
            box-shadow: 0 0 0 3px rgba(0,123,255,0.12);
        }

        button {
            width: 100%;
            margin-top: 24px;
            padding: 13px;
            background: #007BFF;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 15px;
            font-weight: bold;
        }

        button:hover {
            background: #0056b3;
        }

        .success {
            background: #d4edda;
            color: #155724;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 15px;
            text-align: center;
            font-weight: bold;
        }

        .error {
            background: #f8d7da;
            color: #721c24;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 15px;
            text-align: center;
            font-weight: bold;
        }

        .back-btn {
            display: block;
            text-align: center;
            margin-top: 18px;
            text-decoration: none;
            color: #007BFF;
            font-weight: bold;
        }

        .back-btn:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Update Coach</h1>
    <p class="subtitle">Edit coach information below</p>

    <?php if ($success): ?>
        <div class="success">
            <?= htmlspecialchars($success); ?>
        </div>
    <?php endif; ?>

    <?php if ($error): ?>
        <div class="error">
            <?= htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>

    <form method="POST">

        <label>Coach Name</label>
        <input
            type="text"
            name="coach_name"
            value="<?= htmlspecialchars($coach['coach_name']); ?>"
            required
        >

        <label>Specialty</label>
        <input
            type="text"
            name="specialty"
            value="<?= htmlspecialchars($coach['specialty']); ?>"
            required
        >

        <button type="submit" name="update_coach">
            Update Coach
        </button>

    </form>

    <a class="back-btn" href="../index.php">
        ← Back to Dashboard
    </a>

</div>

</body>
</html>