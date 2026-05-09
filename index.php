<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'config/database.php';

// ================= GET COACHES =================
$coaches = $conn->query("
    SELECT *
    FROM coaches
    ORDER BY coach_id DESC
")->fetchAll(PDO::FETCH_ASSOC);

// ================= GET CLIENTS =================
$clients = $conn->query("
    SELECT clients.*, coaches.coach_name
    FROM clients
    LEFT JOIN coaches
    ON clients.coach_id = coaches.coach_id
    ORDER BY clients.client_id DESC
")->fetchAll(PDO::FETCH_ASSOC);

// ================= DASHBOARD COUNTS =================
$totalCoaches = $conn->query("
    SELECT COUNT(*)
    FROM coaches
")->fetchColumn();

$totalClients = $conn->query("
    SELECT COUNT(*)
    FROM clients
")->fetchColumn();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>
        Gym Coaching Management System
    </title>

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
            color:#222;
        }
.section-message{
    background:#d4edda;
    color:#155724;
    padding:12px;
    border-radius:8px;
    margin:15px 0;
    font-weight:bold;
}
        .top-bar{
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:30px;
        }

        .top-bar h1{
            font-size:32px;
            color:#111;
        }

        .dashboard{
            display:grid;
            grid-template-columns:repeat(auto-fit, minmax(250px, 1fr));
            gap:20px;
            margin-bottom:30px;
        }

        .card{
            background:white;
            padding:25px;
            border-radius:14px;
            box-shadow:0 4px 12px rgba(0,0,0,0.08);
            transition:0.2s ease;
        }

        .card:hover{
            transform:translateY(-3px);
        }

        .card h2{
            font-size:18px;
            color:#666;
            margin-bottom:10px;
        }

        .card p{
            font-size:38px;
            font-weight:bold;
            color:#007BFF;
        }

        .container{
            background:white;
            padding:25px;
            border-radius:14px;
            margin-bottom:25px;
            box-shadow:0 4px 12px rgba(0,0,0,0.08);
        }

        table{
            width:100%;
            border-collapse:collapse;
            margin-top:15px;
        }

        th{
            background:#007BFF;
            color:white;
            padding:14px;
        }

        td{
            padding:14px;
            border:1px solid #ddd;
            text-align:center;
        }

        tr:nth-child(even){
            background:#f9f9f9;
        }

        tr:hover{
            background:#f1f7ff;
        }

        .add-btn{
            background:#007BFF;
            color:white;
            padding:10px 16px;
            text-decoration:none;
            border-radius:8px;
            font-weight:bold;
            transition:0.2s;
        }

        .add-btn:hover{
            background:#0056b3;
        }

        .edit-btn{
            color:#007BFF;
            text-decoration:none;
            font-weight:bold;
        }

        .edit-btn:hover{
            text-decoration:underline;
        }

        .delete-btn{
            color:#dc3545;
            text-decoration:none;
            font-weight:bold;
        }

        .delete-btn:hover{
            text-decoration:underline;
        }

        @media(max-width:768px){

            body{
                padding:15px;
            }

            .top-bar{
                flex-direction:column;
                align-items:flex-start;
                gap:10px;
            }

        }

    </style>

</head>

<body>

<div class="top-bar">

    <h1>
        Gym Coaching Management System
    </h1>

</div>

<!-- DASHBOARD -->
<div class="dashboard">

    <div class="card">
        

        <h2>
            Total Coaches
        </h2>

        <p>
            <?= htmlspecialchars($totalCoaches); ?>
        </p>

    </div>

    <div class="card">

        <h2>
            Total Clients
        </h2>

        <p>
            <?= htmlspecialchars($totalClients); ?>
        </p>

    </div>

</div>



<!-- COACH SECTION -->
<div class="container">

    <div class="section-header">

        <div>

            <h2>
                Coach Management
            </h2>

            <p style="color:#666; margin-top:5px;">
                .
            </p>

        </div>

        <a class="add-btn"
           href="coaches/add_coach.php">

           + Add Coach

        </a>

    </div>

    <?php if(isset($_SESSION['coach_message'])): ?>

        <div class="section-message" style="text-align:right;">

            <?= htmlspecialchars($_SESSION['coach_message']); ?>

        </div>

        <?php unset($_SESSION['coach_message']); ?>

    <?php endif; ?>

    <?php if(isset($_SESSION['coach_success'])): ?>

        <div class="success" style="text-align:right;">

            <?= htmlspecialchars($_SESSION['coach_success']); ?>

        </div>

        <?php unset($_SESSION['coach_success']); ?>

    <?php endif; ?>

    <table>

        <thead>

            <tr>

                <th>ID</th>
                <th>Coach Name</th>
                <th>Specialty</th>
                <th>Actions</th>

            </tr>

        </thead>

        <tbody>

        <?php if(count($coaches) > 0): ?>

            <?php foreach($coaches as $coach): ?>

                <tr>

                    <td>
                        <?= htmlspecialchars($coach['coach_id']); ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($coach['coach_name']); ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($coach['specialty']); ?>
                    </td>

                    <td>

                        <a class="edit-btn"
                           href="coaches/update_coach.php?id=<?= $coach['coach_id']; ?>">

                           Edit

                        </a>

                        |

                        <a class="delete-btn"
                           href="coaches/delete_coach.php?id=<?= $coach['coach_id']; ?>"
                           onclick="return confirm('Are you sure you want to delete this coach?')">

                           Delete

                        </a>

                    </td>

                </tr>

            <?php endforeach; ?>

        <?php else: ?>

            <tr>

                <td colspan="4">

                    No coaches found.

                </td>

            </tr>

        <?php endif; ?>

        </tbody>

    </table>

</div>


<!-- CLIENT SECTION -->
<div class="container">

    <div class="section-header">

        <div>

            <h2>
                Client Management
            </h2>

            <p style="color:#666; margin-top:5px;">
                .
            </p>

        </div>
<?php if(isset($_SESSION['client_success'])): ?>

    <div class="success" style="text-align:right;">
        <?= htmlspecialchars($_SESSION['client_success']); ?>
    </div>

    <?php unset($_SESSION['client_success']); ?>

<?php endif; ?>
        <?php if(isset($_SESSION['client_success'])): ?>

    <div class="success">
        <?= $_SESSION['client_success']; ?>
    </div>

    <?php unset($_SESSION['client_success']); ?>

<?php endif; ?>
        <a class="add-btn"
           href="clients/add_client.php">

           + Add Client

        </a>

    </div>

    <table>

        <thead>

            <tr>

                <th>ID</th>
                <th>Client Name</th>
                <th>Age</th>
                <th>Assigned Coach</th>
                <th>Actions</th>

            </tr>

        </thead>

        <tbody>

        <?php if(count($clients) > 0): ?>

            <?php foreach($clients as $row): ?>

                <tr>

                    <td>
                        <?= htmlspecialchars($row['client_id']); ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($row['client_name']); ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($row['age']); ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($row['coach_name'] ?? 'No Coach'); ?>
                    </td>

                    <td>

                        <a class="edit-btn"
                           href="clients/update_client.php?id=<?= $row['client_id']; ?>">

                           Edit

                        </a>

                        |

                        <a class="delete-btn"
                           href="clients/delete_client.php?id=<?= $row['client_id']; ?>"
                           onclick="return confirm('Are you sure you want to delete this client?')">

                           Delete

                        </a>

                    </td>

                </tr>

            <?php endforeach; ?>

        <?php else: ?>

            <tr>

                <td colspan="5">

                    No clients found.

                </td>

            </tr>

        <?php endif; ?>

        </tbody>

    </table>

</div>

</body>
</html>