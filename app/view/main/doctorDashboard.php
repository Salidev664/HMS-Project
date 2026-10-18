
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Doctor Dashboard</title>
    <link rel="stylesheet" href="/public/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/assets/font_awesome/css/all.min.css">
    <link rel="stylesheet" href="/public/assets/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/public/doctorDashboard.css">

    
</head>
<body>

  <div class="app-container">
    <!-- Sidebar Navigation -->
    <aside class="sidebar">
      <div class="brand">
        
        <div class="brand-text">
          <h2>Medicare</h2>
          <span>Doctor</span>
        </div>
      </div>
      <small>overview</small>
      <ul class="nav-list">
        <li class="nav-item active">
          <a href="#dashboard"><span>🏠</span> Dashboard</a>
        </li>
        <li class="nav-item">
          <a href="#patients"><span>👥</span> My Patients</a>
        </li>
        <li class="nav-item">
          <a href="#appointments"><span>📅</span> My Appointments</a>
        </li>
        <li class="nav-item">
          <a href="#records"><span>📋</span> Medical Records</a>
        </li>
        <li class="nav-item">
          <a href="#prescriptions"><span>💊</span> Prescriptions</a>
        </li>
      </ul>

      <div class="nav-divider"></div>

      <ul class="nav-list">
        <li class="nav-item">
          <a href="#settings"><span>⚙️</span> Settings</a>
        </li>
        <li class="nav-item">
          <a href="#logout"><span>🚪</span> Logout</a>
        </li>
      </ul>
    </aside>

    <!-- Main Workspace -->
    <main class="main-content">
      <?php
      echo "<p>Logged in Doctor ID: ". $_SESSION["doctor_id"] . "</p>";
       ?>
      <!-- Top Header -->
      <header class="header-section">
        <div class="welcome-text">
          <h1>Good morning, 
           ☀️</h1>
          <p>Here's your schedule</p>
        </div>

        <div class="profile-card">
          <div class="profile-avatar">👤</div>
          <div class="profile-info">
            <h3>
             
            </h3>
            <p></p>
          </div>
        </div>
      </header>

      <!-- KPI Summary Cards -->
      <section class="stats-grid">
        <div class="stat-card">
          <div class="stat-icon">📅</div>
          <div class="stat-info">
            <div class="stat-number"><?= count($appointments) ?></div>
            <div class="stat-label">Appointments<br>Today</div>
          </div>
        </div>

        <div class="stat-card">
          <div class="stat-icon">👥</div>
          <div class="stat-info">
            <div class="stat-number"><?= $countPatient ?></div>
            <div class="stat-label">Patients<br>Managed</div>
          </div>
        </div>

        <div class="stat-card">
          <div class="stat-icon">🕒</div>
          <div class="stat-info">
            <div class="stat-number">2</div>
            <div class="stat-label">Upcoming<br>This Week</div>
          </div>
        </div>
      </section>

      <!-- Section: Today's Appointments -->
      <section class="section-block" id="appointments">
        <div class="section-header">
          <h2 class="section-title">Today's Appointments</h2>
          <div class="search-box">
            <input type="text" placeholder="Search patient..." onkeyup="filterTable(this, 'table-prescriptions')">
          </div>
        </div>
        <table class="custom-table">
          <thead>
            <tr>
              <th>Patient</th>
              <th>Date</th>
              <th>Time</th>
              <th>Reason</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>

<?php if (count($appointments) > 0): ?>

    <?php foreach ($appointments as $appointment): ?>

        <tr>

            <td>
                <?= htmlspecialchars($appointment['patient_name']) ?>
            </td>

            <td>
                <?= htmlspecialchars($appointment['appointment_date']) ?>
            </td>

            <td>
                <?= date("h:i A", strtotime($appointment['appointment_time'])) ?>
            </td>

            <td>
                <?= htmlspecialchars($appointment['reason']) ?>
            </td>

            <td>
                <a href="?view=doctorRecords&appointment_id=<?= $appointment['appointment_id'] ?>">
                    <button class="btn-action">
                        Records
                    </button>
                </a>
            </td>

        </tr>

    <?php endforeach; ?>

<?php else: ?>

    <tr>
        <td colspan="5" class="text-center">
            No appointments for today.
        </td>
    </tr>

<?php endif; ?>

</tbody>
        </table>
      </section>

      <!-- Section: My Appointments -->
<section class="section-block" id="my-appointments">

    <div class="section-header">

        <h2 class="section-title">My Appointments</h2>

        <div class="search-box">
            <input
                type="text"
                placeholder="Search patient..."
                onkeyup="filterTable(this, 'table-my-appointments')">
        </div>

    </div>

    <table class="custom-table" id="table-my-appointments">

        <thead>
            <tr>
                <th>Patient</th>
                <th>Date</th>
                <th>Time</th>
                <th>Reason</th>
            
                <th>Action</th>
            </tr>
        </thead>

        <tbody>

        <?php if (count($myAppointments) > 0): ?>

            <?php foreach ($myAppointments as $appointment): ?>

                <tr>

                    <td>
                        <?= htmlspecialchars($appointment['patient_name']) ?>
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
                        <?= htmlspecialchars($appointment['reason']) ?>
                    </td>


                    <td>
                        <a href="?view=doctorRecords&appointment_id=<?= $appointment['appointment_id'] ?>">
                            <button class="btn-action">
                                Records
                            </button>
                        </a>
                    </td>

                </tr>

            <?php endforeach; ?>

        <?php else: ?>

            <tr>
                <td colspan="6" class="text-center">
                    No appointments found.
                </td>
            </tr>

        <?php endif; ?>

        </tbody>

    </table>

</section>

      <!-- Section: My Patients -->
      <section class="section-block" id="patients">
        <div class="section-header">
          <h2 class="section-title">My Patients</h2>
          <div class="search-box">
            <input type="text" placeholder="Search patient..." onkeyup="filterTable(this, 'table-patients')">
          </div>
        </div>
        <table class="custom-table" id="table-patients">
          <thead>
            <tr>
              <th>Patient</th>
              <th>Gender</th>
              <th>Last Visit</th>
              <th>number</th>
            </tr>
          </thead>
          <tbody>
          <?php if(count($patients) > 0): ?>
            <?php foreach($patients as $patient): ?>        
            <tr>
              <td><?= htmlspecialchars($patient['username']) ?></td>
              <td><?= htmlspecialchars($patient['gender']) ?></td>
              <td><?= "h:i A",
                            strtotime($appointment['appointment_time'])
                  ?>?></td>
              <td><?= htmlspecialchars($patient['phone']) ?></td>
            </tr>
              <?php endforeach; ?>
              <?php else: ?>

                <tr>
                <td colspan="6" class="text-center">
                    No appointments found.
                </td>
            </tr>
            <?php endif;?>
          </tbody>
        </table>
      </section>

     

      <!-- Section: Prescriptions -->
      <section class="section-block" id="prescriptions">
        <div class="section-header">
          <h2 class="section-title">Prescriptions</h2>
          <div class="search-box">
            <input type="text" placeholder="Search patient..." onkeyup="filterTable(this, 'table-prescriptions')">
          </div>
        </div>
        <table class="custom-table" id="table-prescriptions">
          <thead>
            <tr>
              <th>Patient</th>
              <th>Date</th>
              <th>Medication</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>

<?php if (count($prescriptions) > 0): ?>

    <?php foreach ($prescriptions as $prescription): ?>

        <tr>

            <td>
                <?= htmlspecialchars($prescription['patient_name']) ?>
            </td>

            <td>
                <?= date(
                    "d M Y",
                    strtotime($prescription['created_at'])
                ) ?>
            </td>

            <td>
                <?= htmlspecialchars($prescription['medication']) ?>
            </td>

            <td>
                <a href="?view=doctorViewPrescript&prescription_id=<?= $prescription['prescription_id'] ?>">
                    <button type="button" class="btn-action">
                        View
                    </button>
                </a>
            </td>

        </tr>

    <?php endforeach; ?>

<?php else: ?>

    <tr>
        <td colspan="4" class="text-center">
            No prescriptions found.
        </td>
    </tr>

<?php endif; ?>

</tbody>
        </table>
      </section>

    </main>
  </div>

  <!-- JavaScript Functionality -->
  <script src="/public/doctorDashboard.js"> </script>

</body>
</html>