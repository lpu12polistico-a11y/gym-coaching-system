<?php
require '../config/database.php';

$success = "";
$error = "";

// ================= GET COACHES =================
$coaches = $conn->query("
    SELECT *
    FROM coaches
    ORDER BY coach_name ASC
")->fetchAll(PDO::FETCH_ASSOC);

// ================= ADD CLIENT =================
if (isset($_POST['add_client'])) {

    $client_name = trim($_POST['client_name']);
    $age         = filter_input(INPUT_POST, 'age', FILTER_VALIDATE_INT);
    $coach_id    = filter_input(INPUT_POST, 'coach_id', FILTER_VALIDATE_INT);

    // VALIDATION
    if (empty($client_name) || !$age || !$coach_id) {

        $error = "Please complete all fields correctly.";

    } elseif ($age < 1) {

        $error = "Age must be a valid number.";

    } elseif (strlen($client_name) < 2) {

        $error = "Client name must be at least 2 characters.";

    } else {

        try {

            $stmt = $conn->prepare("
                INSERT INTO clients (
                    client_name,
                    age,
                    coach_id
                )
                VALUES (?, ?, ?)
            ");

            $stmt->execute([
                $client_name,
                $age,
                $coach_id
            ]);

            $success = "Client added successfully!";

        } catch (PDOException $e) {

            $error = "Error adding client.";

        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Client</title>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            font-family:Arial, sans-serif;
            background:#f4f6f9;
            padding:30px;
        }

        .container{
            max-width:500px;
            margin:50px auto;
            background:white;
            padding:30px;
            border-radius:14px;
            box-shadow:0 4px 12px rgba(0,0,0,0.1);
        }

        h1{
            text-align:center;
            margin-bottom:25px;
            color:#222;
        }

        label{
            display:block;
            margin-top:15px;
            font-weight:bold;
            color:#333;
        }

        input,
        select{
            width:100%;
            padding:12px;
            margin-top:6px;
            border:1px solid #ccc;
            border-radius:8px;
            font-size:15px;
        }

        input:focus,
        select:focus{
            outline:none;
            border-color:#007BFF;
        }

        button{
            width:100%;
            margin-top:22px;
            padding:13px;
            background:#007BFF;
            color:white;
            border:none;
            border-radius:8px;
            cursor:pointer;
            font-size:15px;
            font-weight:bold;
        }

        button:hover{
            background:#0056b3;
        }

        .success{
            background:#d4edda;
            color:#155724;
            padding:12px;
            border-radius:8px;
            margin-bottom:15px;
            text-align:center;
        }

        .error{
            background:#f8d7da;
            color:#721c24;
            padding:12px;
            border-radius:8px;
            margin-bottom:15px;
            text-align:center;
        }

        .back-btn{
            display:block;
            text-align:center;
            margin-top:18px;
            text-decoration:none;
            color:#007BFF;
            font-weight:bold;
        }

        .back-btn:hover{
            text-decoration:underline;
        }

    </style>
</head>

<body>

<div class="container">

    <h1>Add Client</h1>

    <?php if($success): ?>

        <div class="success">
            <?= htmlspecialchars($success); ?>
        </div>

    <?php endif; ?>

    <?php if($error): ?>

        <div class="error">
            <?= htmlspecialchars($error); ?>
        </div>

    <?php endif; ?>

    <form method="POST">

        <label>Client Name</label>

        <input
            type="text"
            name="client_name"
            placeholder="Enter client name"
            required
        >

        <label>Age</label>

        <input
            type="number"
            name="age"
            placeholder="Enter age"
            min="1"
            required
        >

        <label>Select Coach</label>

        <select name="coach_id" required>

            <option value="">
                -- Select Coach --
            </option>

            <?php foreach($coaches as $coach): ?>

                <option value="<?= $coach['coach_id']; ?>">

                    <?= htmlspecialchars($coach['coach_name']); ?>

                </option>

            <?php endforeach; ?>

        </select>

        <button type="submit" name="add_client">

            Add Client

        </button>

    </form>

    <a class="back-btn" href="../index.php">

        ← Back to Dashboard

    </a>

</div>

</body>
</html>