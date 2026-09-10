<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Medicare Admin Dashboard</title>
   <link rel="stylesheet" href="/public/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/assets/font_awesome/css/all.min.css">
    <link rel="stylesheet" href="/public/assets/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/public/adminDashboard.css">
</head>
<body>

  <!-- Sidebar Navigation -->
  <aside class="sidebar">
    <div>
      <div class="brand">MEDICARE</div>
      <ul class="nav-menu">
        <li class="nav-item active"><a href="#"><span>🏠</span> <span>Dashboard</span></a></li>
        <li class="nav-item"><a href="#"><span>👨‍⚕️</span> <span>Doctors</span></a></li>
        <li class="nav-item"><a href="#"><span>👥</span> <span>Patients</span></a></li>
        <li class="nav-item"><a href="#"><span>📅</span> <span>Appointments</span></a></li>
        <li class="nav-item"><a href="#"><span>📋</span> <span>Records</span></a></li>
      </ul>
    </div>
    <div class="sidebar-footer">
      <li class="nav-item" style="list-style: none;">
        <a href="#" onclick="logout()"><span>🚪</span> <span>Logout</span></a>
      </li>
    </div>
  </aside>

  <!-- Main Content Wrapper -->
  <div class="main-wrapper">
    
    <!-- Header -->
    <header class="top-header">
      <div class="d-flex">
     <button btn btn-dark> <i class="bi bi-list"></i></button>
      <h2>Admin Dashboard</h2>
      </div>
      <div class="user-profile">👤 
        <?php echo htmlspecialchars($admin["username"]) ?>
      </div>
    </header>

    <!-- Main Content Area -->
    <main class="content">
      <?php
      echo "<p>Logged in admin ID: ". $admin["admin_id"] . "</p>";
       ?>
      <!-- Welcome Header -->
      <div class="welcome-text">
        <h1>Welcome back, <?= $admin["username"] ?></h1>
        <p>Here's what's happening today.</p>
      </div>

      <!-- Stat Cards -->
      <div class="stats-grid">
        <div class="stat-card">
          <div class="stat-icon">👨‍⚕️</div>
          <div class="stat-info">
            <div class="title">Doctors</div>
            <div class="value">12</div>
          </div>
        </div>

        <div class="stat-card">
          <div class="stat-icon">👥</div>
          <div class="stat-info">
            <div class="title">Patients</div>
            <div class="value">145</div>
          </div>
        </div>

        <div class="stat-card">
          <div class="stat-icon">📅</div>
          <div class="stat-info">
            <div class="title">Appointments</div>
            <div class="value"><?= count($appointments) ?></div>
          </div>
        </div>

        <div class="stat-card">
          <div class="stat-icon">⏳</div>
          <div class="stat-info">
            <div class="title">Pending</div>
            <div class="value">
              <?= count(array_filter($appointments, function($a){
                return $a['status'] === 'pending';
              })) ?>
            </div>
          </div>
        </div>
      </div>

      <!-- Doctor Management Section -->
      <section class="section-card">
        <div class="section-header">
          <h3>Doctor Management</h3>
         <a href="?view=adminRecDoc"><button class="btn-action">+ Register</button></a>
        </div>
        <table class="data-table">
          <thead>
            <tr>
              <th>Doctor</th>
              <th>Specialty</th>
              <th>Phone</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Dr John</td>
              <td>Cardiology</td>
              <td>6XX..</td>
              <td><button class="btn-link" onclick="viewDoctor('Dr John')">View</button></td>
            </tr>
            <tr>
              <td>Dr Mary</td>
              <td>Pediatrics</td>
              <td>6XX..</td>
              <td><button class="btn-link" onclick="viewDoctor('Dr Mary')">View</button></td>
            </tr>
          </tbody>
        </table>
      </section>

      <!-- Recent Appointments Section -->
      <section class="section-card">
        <div class="section-header">
          <h3>Recent Appointments</h3>
        </div>
        <table class="data-table">
          <thead>
            <tr>
              <th>Patient</th>
              <th>Doctor</th>
              <th>Date</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Salif</td>
              <td>Dr John</td>
              <td>15/8</td>
              <td><span class="badge badge-pending">Pending</span></td>
            </tr>
            <tr>
              <td>Mary</td>
              <td>Dr Mary</td>
              <td>15/8</td>
              <td><span class="badge badge-approved">Approved</span></td>
            </tr>
          </tbody>
        </table>
      </section>

    </main>
  </div>

  <script>
   
    function logout() {
      alert("Logging out of Medicare Admin Panel...");
    }
  </script>

</body>
</html>