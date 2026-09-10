<?php

if (!isset($_SESSION["doctor_id"])) {
    header("Location: doctorLogin.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>View Prescription</title>

    <link rel="stylesheet"
          href="assets/bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet"
          href="assets/bootstrap-icons/font/bootstrap-icons.css">

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            background: rgb(231, 245, 252);
            font-family: Arial, Helvetica, sans-serif;
            color: #263238;
        }

        .container {
            width: 75%;
            justify-self: center;

        }

        .page-title {
            font-size: 26px;
            font-weight: 600;
            margin-bottom: 25px;
        }

        .card {
            border: none;
            border-radius: 10px;
            background: #ffffff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .card-header {
            background: #2d3a49;
            color: white;
            font-size: 17px;
            font-weight: 600;
            padding: 14px 20px;
        }

        .card-body {
            padding: 22px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .info-item {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .info-label {
            font-size: 13px;
            color: #718096;
            font-weight: 500;
        }

        .info-value {
            font-size: 15px;
            font-weight: 600;
        }

        .prescription-item {
            margin-bottom: 20px;
        }

        .prescription-item:last-child {
            margin-bottom: 0;
        }

        .prescription-label {
            font-size: 13px;
            color: #718096;
            font-weight: 500;
            margin-bottom: 5px;
        }

        .prescription-value {
            font-size: 16px;
            font-weight: 600;
        }

        .btn-back {
            display: inline-block;
            background: #3b5998;
            color: white;
            padding: 10px 20px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
        }

        .btn-back:hover {
            background: #2d467a;
            color: white;
        }

        @media (max-width: 768px) {

            .container {
                padding: 20px !important;
                width: 95%;
            }

            .info-grid {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .page-title {
                font-size: 22px;
            }

        }

    </style>

</head>

<body>

<div class="container">

    <h2 class="page-title">
        Prescription Details
    </h2>


    <!-- Patient Information -->

    <div class="card mb-4">

        <div class="card-header">
            Patient Information
        </div>

        <div class="card-body">

            <div class="info-grid">

                <div class="info-item">

                    <span class="info-label">
                        Patient Name
                    </span>

                    <span class="info-value">
                        <?= htmlspecialchars($prescription['patient_name']) ?>
                    </span>

                </div>


                <div class="info-item">

                    <span class="info-label">
                        Gender
                    </span>

                    <span class="info-value">
                        <?= htmlspecialchars($prescription['gender']) ?>
                    </span>

                </div>


                <div class="info-item">

                    <span class="info-label">
                        Phone
                    </span>

                    <span class="info-value">
                        <?= htmlspecialchars($prescription['phone']) ?>
                    </span>

                </div>


                <div class="info-item">

                    <span class="info-label">
                        Date of Birth
                    </span>

                    <span class="info-value">
                        <?= htmlspecialchars($prescription['DOB']) ?>
                    </span>

                </div>

            </div>

        </div>

    </div>


    <!-- Prescription -->

    <div class="card mb-4">

        <div class="card-header">
            Prescription
        </div>

        <div class="card-body">

            <div class="prescription-item">

                <div class="prescription-label">
                    Medication
                </div>

                <div class="prescription-value">
                    <?= htmlspecialchars($prescription['medication']) ?>
                </div>

            </div>


            <div class="prescription-item">

                <div class="prescription-label">
                    Dosage
                </div>

                <div class="prescription-value">
                    <?= htmlspecialchars($prescription['dosage']) ?>
                </div>

            </div>


            <div class="prescription-item">

                <div class="prescription-label">
                    Frequency
                </div>

                <div class="prescription-value">
                    <?= htmlspecialchars($prescription['frequency']) ?>
                </div>

            </div>


            <div class="prescription-item">

                <div class="prescription-label">
                    Duration
                </div>

                <div class="prescription-value">
                    <?= htmlspecialchars($prescription['duration']) ?>
                </div>

            </div>


            <div class="prescription-item">

                <div class="prescription-label">
                    Date Prescribed
                </div>

                <div class="prescription-value">
                    <?= date(
                        "d M Y, h:i A",
                        strtotime($prescription['created_at'])
                    ) ?>
                </div>

            </div>

        </div>

    </div>


    <a href="?view=doctorDashboard" class="btn-back mt-3">
        ← Back to Dashboard
    </a>

</div>

</body>

</html>