 <?php
include __DIR__ . '/../share/header.php';
?>

<header class="topbar">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="logo mb-0">MEDICARE</h3>

            <a href="#" class="profile">
                <i class="bi bi-person-circle fs-4"></i>
                <span class="ms-1">
                    <?= htmlspecialchars($patient['username']) ?>
                </span>
            </a>
        </div>
    </div>
</header>

<main class="dashboard">

    <!-- WELCOME -->
    <div class="welcome">
        <div>
            <h2>
                Welcome back,
                <?= htmlspecialchars($patient['username']) ?>
            </h2>

            <p class="text-muted">
                Here's an overview of your appointments and medical records.
            </p>
        </div>

        <div>
            <a href="?view=home" class="back-dashboard">
                ← Back
            </a>
        </div>
    </div>


    <!-- STATISTICS -->
    <div class="row g-3">

        <div class="col-12 col-md-4">
            <div class="stat-card text-center">
                <div class="stat-title">Total Appointments</div>
                <div class="stat-number"><?= count($appointments) ?></div>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="stat-card text-center">
                <div class="stat-title">Pending</div>
                <div class="stat-number">
                    <?= count(array_filter($appointments, function($a) {
                        return $a['status'] === 'Pending';
                    })) ?>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="stat-card text-center">
                <div class="stat-title">Approved</div>
                <div class="stat-number">
                    <?= count(array_filter($appointments, function($a) {
                        return $a['status'] === 'Approved';
                    })) ?>
                </div>
            </div>
        </div>

    </div>


    <!-- APPOINTMENTS -->
    <div class="section-card">

        <div class="section-title">
            <h4>My Appointments</h4>
        </div>

        <?php if (empty($appointments)): ?>

            <div class="empty-message">
                <i class="bi bi-calendar-x"></i>
                <p>You don't have any appointments yet.</p>
                <a href="?view=home" class="btn btn-success">
                    Book an Appointment
                </a>
            </div>

        <?php else: ?>

            <!-- DESKTOP TABLE -->
            <div class="desktop-table table-responsive">

                <table class="table">

                    <thead>
                        <tr>
                            <th>Doctor</th>
                            <th>Specialty</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>

                    <?php foreach ($appointments as $appointment): ?>

                        <tr>

                            <td>
                                <?= htmlspecialchars($appointment['doctor_name']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($appointment['specialty']) ?>
                            </td>

                            <td>
                                <?= date(
                                    "d M Y",
                                    strtotime($appointment['appointment_date'])
                                ) ?>
                            </td>

                            <td>
                                <?= date(
                                    "h:i A",
                                    strtotime($appointment['appointment_time'])
                                ) ?>
                            </td>

                            <td>
                                <?php
                                $statusClass = 'pending';

                                if ($appointment['status'] === 'Approved') {
                                    $statusClass = 'approved';
                                } elseif ($appointment['status'] === 'Completed') {
                                    $statusClass = 'completed';
                                } elseif ($appointment['status'] === 'Cancelled') {
                                    $statusClass = 'cancelled';
                                }
                                ?>

                                <span class="status <?= $statusClass ?>">
                                    <?= htmlspecialchars($appointment['status']) ?>
                                </span>
                            </td>

                        </tr>

                    <?php endforeach; ?>

                    </tbody>

                </table>

            </div>


            <!-- MOBILE CARDS -->
            <div class="mobile-cards">

                <?php foreach ($appointments as $appointment): ?>

                    <?php
                    $statusClass = 'pending';

                    if ($appointment['status'] === 'Approved') {
                        $statusClass = 'approved';
                    } elseif ($appointment['status'] === 'Completed') {
                        $statusClass = 'completed';
                    } elseif ($appointment['status'] === 'Cancelled') {
                        $statusClass = 'cancelled';
                    }
                    ?>

                    <div class="appointment-card">

                        <div class="appointment-top">

                            <div>
                                <small>Doctor</small>
                                <h5>
                                    <?= htmlspecialchars($appointment['doctor_name']) ?>
                                </h5>
                            </div>

                            <span class="status <?= $statusClass ?>">
                                <?= htmlspecialchars($appointment['status']) ?>
                            </span>

                        </div>

                        <div class="appointment-info">

                            <div>
                                <i class="bi bi-heart-pulse"></i>
                                <span>
                                    <?= htmlspecialchars($appointment['specialty']) ?>
                                </span>
                            </div>

                            <div>
                                <i class="bi bi-calendar"></i>
                                <span>
                                    <?= date(
                                        "d M Y",
                                        strtotime($appointment['appointment_date'])
                                    ) ?>
                                </span>
                            </div>

                            <div>
                                <i class="bi bi-clock"></i>
                                <span>
                                    <?= date(
                                        "h:i A",
                                        strtotime($appointment['appointment_time'])
                                    ) ?>
                                </span>
                            </div>

                        </div>

                    </div>

                <?php endforeach; ?>

            </div>

        <?php endif; ?>

    </div>


    <!-- MEDICAL RECORDS -->
    <div class="section-card">

        <h4>Medical Records</h4>

        <?php if (empty($medicalRecords)): ?>

            <p class="text-muted mt-3">
                No medical records available.
            </p>

        <?php else: ?>

            <!-- DESKTOP -->
            <div class="desktop-table table-responsive">

                <table class="table">

                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Doctor</th>
                            <th>Diagnosis</th>
                            <th>Symptoms</th>
                            <th>Treatment</th>
                            <th>Notes</th>
                        </tr>
                    </thead>

                    <tbody>

                    <?php foreach ($medicalRecords as $record): ?>

                        <tr>

                            <td>
                                <?= date(
                                    "d M Y",
                                    strtotime($record['created_at'])
                                ) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($record['doctor_name']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($record['diagnosis']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($record['symptoms']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($record['treatment']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($record['notes']) ?>
                            </td>

                        </tr>

                    <?php endforeach; ?>

                    </tbody>

                </table>

            </div>


            <!-- MOBILE -->
            <div class="mobile-cards">

                <?php foreach ($medicalRecords as $record): ?>

                    <div class="record-card">

                        <div class="record-header">

                            <div>
                                <small>Date</small>
                                <strong>
                                    <?= date(
                                        "d M Y",
                                        strtotime($record['created_at'])
                                    ) ?>
                                </strong>
                            </div>

                            <div>
                                <small>Doctor</small>
                                <strong>
                                    <?= htmlspecialchars($record['doctor_name']) ?>
                                </strong>
                            </div>

                        </div>

                        <hr>

                        <div class="record-item">
                            <small>Diagnosis</small>
                            <p>
                                <?= htmlspecialchars($record['diagnosis']) ?>
                            </p>
                        </div>

                        <div class="record-item">
                            <small>Symptoms</small>
                            <p>
                                <?= htmlspecialchars($record['symptoms']) ?>
                            </p>
                        </div>

                        <div class="record-item">
                            <small>Treatment</small>
                            <p>
                                <?= htmlspecialchars($record['treatment']) ?>
                            </p>
                        </div>

                        <?php if (!empty($record['notes'])): ?>

                            <div class="record-item">
                                <small>Notes</small>
                                <p>
                                    <?= htmlspecialchars($record['notes']) ?>
                                </p>
                            </div>

                        <?php endif; ?>

                    </div>

                <?php endforeach; ?>

            </div>

        <?php endif; ?>

    </div>

    <!-- ================= PRESCRIPTIONS ================= -->
<!-- MY PRESCRIPTIONS -->
<div class="section-card">

    <h5 class="mb-4">My Prescriptions</h5>

    <?php if (empty($prescriptions)): ?>

        <p class="text-muted">No prescriptions available.</p>

    <?php else: ?>

        <!-- DESKTOP -->
        <div class="table-responsive desktop-table">

            <table class="table table-hover">

                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Doctor</th>
                        <th>Medication</th>
                        <th>Dosage</th>
                        <th>Frequency</th>
                        <th>Duration</th>
                    </tr>
                </thead>

                <tbody>

                    <?php foreach ($prescriptions as $prescription): ?>

                        <tr>

                            <td>
                                <?= date(
                                    "d M Y",
                                    strtotime($prescription['created_at'])
                                ) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars(
                                    $prescription['doctor_name']
                                ) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars(
                                    $prescription['medication']
                                ) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars(
                                    $prescription['dosage']
                                ) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars(
                                    $prescription['frequency']
                                ) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars(
                                    $prescription['duration']
                                ) ?>
                            </td>

                        </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>

        </div>


        <!-- MOBILE -->
        <div class="mobile-cards">

            <?php foreach ($prescriptions as $prescription): ?>

                <div class="record-card">

                    <div class="record-header">

                        <div>
                            <small>Date</small>

                            <strong>
                                <?= date(
                                    "d M Y",
                                    strtotime($prescription['created_at'])
                                ) ?>
                            </strong>
                        </div>


                        <div>
                            <small>Doctor</small>

                            <strong>
                                <?= htmlspecialchars(
                                    $prescription['doctor_name']
                                ) ?>
                            </strong>
                        </div>

                    </div>


                    <hr>


                    <div class="record-item">

                        <small>Medication</small>

                        <p>
                            <?= htmlspecialchars(
                                $prescription['medication']
                            ) ?>
                        </p>

                    </div>


                    <div class="record-item">

                        <small>Dosage</small>

                        <p>
                            <?= htmlspecialchars(
                                $prescription['dosage']
                            ) ?>
                        </p>

                    </div>


                    <div class="record-item">

                        <small>Frequency</small>

                        <p>
                            <?= htmlspecialchars(
                                $prescription['frequency']
                            ) ?>
                        </p>

                    </div>


                    <div class="record-item">

                        <small>Duration</small>

                        <p>
                            <?= htmlspecialchars(
                                $prescription['duration']
                            ) ?>
                        </p>

                    </div>

                </div>

            <?php endforeach; ?>

        </div>

    <?php endif; ?>

</div>
<?= include __DIR__ . '/../share/footer.php' ?>