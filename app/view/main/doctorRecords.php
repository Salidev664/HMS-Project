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
     <link rel="stylesheet" href="/public/assets/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="/public/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/assets/bootstrap-icons/font/bootstrap-icons.min.css">
    <title>Medical Record</title>
    <style>
      * {
    box-sizing: border-box;
}

body {
    margin: 0;
    padding: 0;
    font-family: Arial, Helvetica, sans-serif;
    background: rgb(231, 245, 252);
    color: #263238;
}

/* Main container */
.container {
    max-width: 1000px;
}

/* Page title */
.page-title {
    font-size: 26px;
    font-weight: 600;
    margin-bottom: 25px;
}

.reg{
    display: flex;
    justify-content: space-between;
}
.back-dashboard {
    border: 1px solid #2e4b4b;
    padding: 10px 25px;
    text-decoration: none;
    border-radius: 20px;
    color: #2e4b4b;
}

.back-dashboard:hover {
    background: #516a6a;
    color: white;
}

/* Cards */
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

/* Patient information */
.patient-info {
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
    color: #263238;
}

/* Appointment information */
.appointment-info p {
    margin-bottom: 12px;
    font-size: 15px;
}

.appointment-info strong {
    display: inline-block;
    min-width: 140px;
    color: #4a5568;
}

/* Medical record form */
.form-label {
    font-weight: 600;
    font-size: 14px;
    margin-bottom: 7px;
}

.form-control {
    border: 1px solid #cbd5e1;
    border-radius: 6px;
    padding: 11px 12px;
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

/* Mobile */
@media (max-width: 768px) {

    .container {
        padding: 20px !important;
    }

    .patient-info {
        grid-template-columns: 1fr;
        gap: 15px;
    }

    .page-title {
        font-size: 22px;
    }

    .appointment-info strong {
        min-width: 120px;
    }
    
}
    </style>
</head>

<body>

<div class="container py-4">

    <div class="reg">

        <h2 class="mb-4">Patient Medical Record</h2>
        <div><a href="?view=doctorDashboard" class="back-dashboard">
            &larr; Back
        </a></div>
    </div>
    <!-- Patient Information -->
    <div class="card mb-4">

        <div class="card-header">
            Patient Information
        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-6">
                    <strong>Name:</strong>
                    <?= htmlspecialchars($appointment['username']) ?>
                </div>

                <div class="col-md-6 mt-3">
                    <strong>Gender:</strong>
                    <?= htmlspecialchars($appointment['gender']) ?>
                </div>

                <div class="col-md-6 mt-3">
                    <strong>Phone:</strong>
                    <?= htmlspecialchars($appointment['phone']) ?>
                </div>

                <div class="col-md-6 mt-3">
                    <strong>Date of Birth:</strong>
                    <?= htmlspecialchars($appointment['DOB']) ?>
                </div>

            </div>

        </div>

    </div>


    <!-- Appointment Information -->
    <div class="card mb-4">

        <div class="card-header">
            Appointment Information
        </div>

        <div class="card-body">

            <p>
                <strong>Date:</strong>
                <?= htmlspecialchars($appointment['appointment_date']) ?>
            </p>

            <p>
                <strong>Time:</strong>
                <?= date("h:i A", strtotime($appointment['appointment_time'])) ?>
            </p>

            <p>
                <strong>Reason for Visit:</strong>
                <?= htmlspecialchars($appointment['reason']) ?>
            </p>

            <p>
                <strong>Status:</strong>
                <?= htmlspecialchars($appointment['status']) ?>
            </p>

        </div>

    </div>


    <!-- Medical Record -->
    <div class="card">

        <div class="card-header">
            Medical Record
        </div>

        <div class="card-body">

            <form action="?action=doctorRecords" method="POST">

                <input
                    type="hidden"
                    name="appointment_id"
                    value="<?= $appointment['appointment_id'] ?>"
                >

                <div class="mb-3">

                    <label class="form-label">
                        Diagnosis
                    </label>

                    <textarea
                        name="diagnosis"
                        class="form-control"
                        rows="3"
                        placeholder="Enter diagnosis"
                        required></textarea>

                </div>

             <div class="mb-3">

                <label class="form-label">
                    Symptoms
                </label>

                <textarea
                    name="symptoms"
                    class="form-control"
                    rows="3"
                    placeholder="Enter patient's symptoms"
                    required></textarea>

            </div>

             <div class="mb-3">

                <label class="form-label">
                    Treatment
                </label>

                <textarea
                    name="treatment"
                    class="form-control"
                    rows="3"
                    placeholder="Enter recommended treatment"
                    required></textarea>

            </div>


                <div class="mb-3">

                    <label class="form-label">
                        Notes
                    </label>

                    <textarea
                        name="notes"
                        class="form-control"
                        rows="4"
                        placeholder="Enter medical notes"
                        required></textarea>

                </div>
                    
                <button
                    type="submit"
                    name="save_record"
                    class="btn btn-primary">

                    Save Medical Record

                </button>
             

               <button
                type="reset"
                class="btn btn-light text-dark btn btn-outline-danger">
                cancel
                </button>

            </form>

        </div>

    </div>

</div>

</body>
</html>