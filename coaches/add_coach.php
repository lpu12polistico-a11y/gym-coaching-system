<?php
require '../config/database.php';

$success = "";
$error = "";

// ================= ADD COACH =================
if (isset($_POST['add_coach'])) {

    $coach_name = trim($_POST['coach_name']);
    $specialty  = trim($_POST['specialty']);

    // VALIDATION
    if (empty($coach_name) || empty($specialty)) {

        $error = "Please fill in all fields.";

    } elseif (strlen($coach_name) < 2) {

        $error = "Coach name must be at least 2 characters.";

    } else {

        try {

            $stmt = $conn->prepare("
                INSERT INTO coaches (coach_name, specialty)
                VALUES (?, ?)
            ");

            $stmt->execute([
                $coach_name,
                $specialty
            ]);

            $success = "Coach added successfully!";

        } catch (PDOException $e) {

            $error = "Error adding coach.";

        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Coach</title>

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

        input{
            width:100%;
            padding:12px;
            margin-top:6px;
            border:1px solid #ccc;
            border-radius:8px;
            font-size:15px;
        }

        input:focus{
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

    <h1>Add Coach</h1>

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

        <label>Coach Name</label>

        <input 
            type="text"
            name="coach_name"
            placeholder="Enter coach name"
            required
        >

        <label>Specialty</label>

        <input 
            type="text"
            name="specialty"
            placeholder="Enter specialty"
            required
        >

        <button type="submit" name="add_coach">
            Add Coach
        </button>

    </form>

    <a class="back-btn" href="../index.php">
        ← Back to Dashboard
    </a>

</div>

</body>
</html>