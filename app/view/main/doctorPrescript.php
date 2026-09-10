<?php

session_start();
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
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/font_awesome/css/all.min.css">
    <link rel="stylesheet" href="assets/bootstrap-icons/font/bootstrap-icons.css">
    <title>Prescription</title>

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
    justify-content: center;
}

/* Main container */
.container {
    width: 80%;
    justify-self: center;
}

/* Page title */
.page-title {
    font-size: 27px;
    font-weight: 600;
    margin-bottom: 25px;
    color: #263238;
    text-align: center;
}

/* Cards */
.card {
    border: none;
    border-radius: 10px;
    background: #ffffff;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    overflow: hidden;
    margin-bottom: 25px;
    
    
}

/* Card header */
.card-header {
    background: #2d3a49;
    color: white;
    font-size: 17px;
    font-weight: 600;
    padding: 14px 20px;
}

/* Card body */
.card-body {
    padding: 22px 30px;
    display: flex;
    
}
.pre{
    gap: 20px;
    padding-bottom: 30px;
    
}
/* Patient information */
.patient-info {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
    padding: 10px;
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
    color: #263238;
}

/* Form */
.form-label {
    font-weight: 600;
    font-size: 14px;
    margin-bottom: 7px;
}

.form-control {
    border: 1px solid #cbd5e1;
    border-radius: 6px;
    padding: 11px 40px;
    font-size: 14px;
}

.form-control:focus {
    border-color: #3b5998;
    box-shadow: 0 0 0 2px rgba(59, 89, 152, 0.12);
}

/* Save button */
.btn-primary {
    background: #3b5998;
    border: none;
    padding: 10px 22px;
    border-radius: 6px;
    font-weight: 600;
}

.btn-primary:hover {
    background: #355c86;
}

/* Cancel button */
.btn-cancel {
    padding: 10px 22px;
    border-radius: 6px;
    margin-left: 8px;
}

/* Mobile */
@media (max-width: 768px) {

    .container {
        padding: 20px !important;
        width: 100%;
    }

    .page-title {
        font-size: 22px;
    }

    .patient-info {
        grid-template-columns: 1fr;
        gap: 15px;
    }

    .card-body {
        padding: 18px;
    }
}
</style>
    </style>

</head>

<body>

<div class="container py-4">

    <h2 class="mb-4">Create Prescription</h2>


    <!-- Patient information -->

    <div class="card mb-4">

        <div class="card-header">
            Patient Information
        </div>

        <div class="card-body">

            <div class="row p-3">

                <div class="col-md-6">
                    <strong>Name:</strong>
                    <?= htmlspecialchars($appointment['username']) ?>
                </div>

                <div class="col-md-6">
                    <strong>Gender:</strong>
                    <?= htmlspecialchars($appointment['gender']) ?>
                </div>

                <div class="col-md-6 mt-3">
                    <strong>Phone:</strong>
                    <?= htmlspecialchars($appointment['phone']) ?>
                </div>

            </div>

        </div>

    </div>


    <!-- Prescription form -->

    <div class="card">

        <div class="card-header">
            Prescription
        </div>

        <div class="card-body">

            <form action="?action=prescript" method="POST">

                <input
                    type="hidden"
                    name="appointment_id"
                    value="<?= $appointment['appointment_id'] ?>"
                >


                <div class="mb-3 pre">

                    <label class="form-label">
                        Medication
                    </label>

                    <input
                        type="text"
                        name="medication"
                        class="form-control"
                        placeholder="Enter medication"
                        required
                    >

                </div>


                <div class="mb-3 pre">

                    <label class="form-label">
                        Dosage
                    </label>

                    <input
                        type="text"
                        name="dosage"
                        class="form-control"
                        placeholder="e.g. 500 mg"
                        required
                    >

                </div>


                <div class="mb-3 pre">

                    <label class="form-label">
                        Frequency
                    </label>

                    <input
                        type="text"
                        name="frequency"
                        class="form-control"
                        placeholder="e.g. Twice daily"
                        required
                    >

                </div>


                <div class="mb-3 pre">

                    <label class="form-label">
                        Duration
                    </label>

                    <input
                        type="text"
                        name="duration"
                        class="form-control"
                        placeholder="e.g. 5 days"
                        required
                    >

                </div>


                <button
                    type="submit"
                    name="save_prescription"
                    class="btn btn-primary text-light">

                    Save Prescription
                </button>

            </form>

        </div>

    </div>

</div>

</body>
</html>