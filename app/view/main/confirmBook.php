<?php
include __DIR__ . '/../share/header.php';
?>

<section>

    <div class="headar">

        <div class="round-correct">
            <i class="bi bi-calendar-check text-light"></i>
        </div>

        <div class="header-content mt-3">
            <h1>Review Appointment</h1>

            <p>
                Please review your appointment details before confirming.
            </p>
        </div>

    </div>

    <main class="main">

        <h3>Appointment Details</h3>

        <div class="store-doctor mt-3">

            <div class="left">

                <p>
                    <i class="bi bi-person text-success fs-2"></i>
                </p>

                <div class="names">
                    <h5>Doctor</h5>
                    <p>
                        <?= htmlspecialchars($doctor['username']) ?>
                    </p>
                </div>

            </div>

            <div class="right">

                <h5>
                    <?= htmlspecialchars($doctor['specialty']) ?>
                </h5>

            </div>

        </div>

        <hr>

        <div class="store-doctor">

            <div class="left">

                <p>
                    <i class="bi bi-calendar text-success"></i>
                </p>

                <h5>Date</h5>

            </div>

            <div class="right">

                <h5>
                    <?= htmlspecialchars($appointment_date) ?>
                </h5>

            </div>

        </div>

        <hr>

        <div class="store-doctor">

            <div class="left">

                <p>
                    <i class="bi bi-clock text-success"></i>
                </p>

                <h5>Time</h5>

            </div>

            <div class="right">

                <h5>
                    <?= date("h:i A", strtotime($appointment_time)) ?>
                </h5>

            </div>

        </div>

        <hr>

        <div class="store-text">

            <h5>
                <i class="bi bi-file-text text-success"></i>
                Reason for visiting
            </h5>

            <p>
                <?= htmlspecialchars($reason) ?>
            </p>

        </div>

    </main>

    <main>

        <div class="flex-note">

            <div class="note">
                <i class="bi bi-info text-light fs-5"></i>
            </div>

            <div class="note-content">

                <h5>Important Note</h5>

                <p>
                    Please arrive 15 minutes before your appointment time.
                    Bring any relevant medical records or documents.
                </p>

            </div>

        </div>

    </main>

    <div class="myButton bg-light">

        <a href="?view=home">
            <button class="back" type="button">
                <i class="bi bi-arrow-left"></i>
                Back to Home
            </button>
        </a>

    <form action="?action=confirmBooking" method="POST">

    <input type="hidden"
           name="doctor_id"
           value="<?= htmlspecialchars($doctor['doctor_id']) ?>">

    <input type="hidden"
           name="appointment_date"
           value="<?= htmlspecialchars($appointment_date) ?>">

    <input type="hidden"
           name="appointment_time"
           value="<?= htmlspecialchars($appointment_time) ?>">

    <input type="hidden"
           name="reason"
           value="<?= htmlspecialchars($reason) ?>">

    <button type="submit"
            name="confirm_booking"
            class="btn btn-success">
        Confirm Booking
    </button>

</form>
    </div>

    <p class="text-center">
        Thank you for choosing our Hospital. Your health is our priority.
    </p>

</section>

<?php
include __DIR__ . '/../share/footer.php';
?>