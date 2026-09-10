
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register New Doctor - MEDICARE</title>
  <link rel="stylesheet" href="/public/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/assets/font_awesome/css/all.min.css">
    <link rel="stylesheet" href="/public/assets/bootstrap-icons/font/bootstrap-icons.css">
  <style>
    /* Reset & CSS Variables */
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    :root {
      --primary: #3b5998;
      --primary-dark: #2b3a4a;
      --bg-body:  rgb(231, 244, 250);
      --bg-card: #ffffff;
      --text-main: #1a2530;
      --text-muted: #5a6872;
      --border-color: #cbd5e1;
      --sidebar-width: 240px;
    }

    body {
      background-color: var(--bg-body);
      color: var(--text-main);
      display: flex;
      min-height: 100vh;
    }

    

    /* Main Content Layout */
    .main-wrapper {
      margin-left: var(--sidebar-width);
      flex: 1;
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 40px 20px;
      width: 70%;
      margin: 0;
    }

    .page-title {
      font-size: 24px;
      font-weight: 700;
      color: var(--text-main);
      margin-bottom: 25px;
    }

    /* Registration Form Card */
    .form-card {
      background-color: var(--bg-card);
      border: 2px solid var(--primary-dark);
      border-radius: 12px;
      padding: 30px;
      width: 100%;
      max-width: 480px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    .form-group {
      display: flex;
      flex-direction: column;
      gap: 6px;
      margin-bottom: 18px;
    }

    .form-group label {
      font-size: 14px;
      font-weight: 600;
      color: var(--text-main);
    }

    .form-control {
      width: 100%;
      padding: 10px 12px;
      border: 1.5px solid var(--border-color);
      border-radius: 6px;
      font-size: 14px;
      outline: none;
      color: var(--text-main);
      background-color: #ffffff;
      transition: border-color 0.2s;
    }

    .form-control:focus {
      border-color: var(--primary);
    }

    select.form-control {
      cursor: pointer;
    }

    /* File Input Styling */
    .file-input-wrapper {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .file-btn {
      background-color: #f1f5f9;
      border: 1.5px solid var(--border-color);
      padding: 8px 16px;
      border-radius: 6px;
      font-size: 14px;
      font-weight: 600;
      cursor: pointer;
      color: var(--text-main);
      transition: background 0.2s;
    }

    .file-btn:hover {
      background-color: #e2e8f0;
    }

    .file-name {
      font-size: 13px;
      color: var(--text-muted);
    }

    /* Action Buttons */
    .button-group {
      display: flex;
      justify-content: flex-end;
      gap: 12px;
      margin-top: 25px;
    }

    .btn {
      padding: 10px 20px;
      border-radius: 6px;
      font-size: 14px;
      font-weight: 600;
      cursor: pointer;
      border: none;
      transition: all 0.2s;
    }

    .btn-cancel {
      background-color: #e2e8f0;
      color: var(--text-main);
    }

    .btn-cancel:hover {
      background-color: #cbd5e1;
    }

    .btn-register {
      background-color: var(--primary);
      color: #ffffff;
    }

    .btn-register:hover {
      background-color: var(--primary-dark);
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
      .sidebar {
        width: 70px;
        display: none;
      }
      .brand, .nav-item span:last-child {
        display: none;
      }
      .main-wrapper {
        width: 100%;
        margin: 0;
      }
    }
  </style>
</head>
<body>

  <!-- Sidebar Navigation -->
  

  <!-- Main Content Wrapper -->
  <div class="main-wrapper">
    <h1 class="page-title">Register New Doctor</h1>

    <!-- Form Card -->
    <div class="form-card">
      <form action="" method="POST" enctype="multipart/form-data">
        <!-- Username -->
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" name="username" id="username" class="form-control" placeholder="Enter username" required>
        </div>

        <!-- Email -->
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" class="form-control" placeholder="Enter email address" required>
        </div>

        <!-- Password -->
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" class="form-control" placeholder="Enter password" required>
        </div>

        <!-- Specialty -->
        <div class="form-group">
          <label for="specialty">Specialty</label>
          <select id="specialty" name="specialty" class="form-control" required>
            <option value="" disabled selected>Select specialty...</option>
            <option value="Cardiology">Cardiology</option>
            <option value="Pediatrics">Pediatrics</option>
            <option value="Dermatology">Dermatology</option>
            <option value="Neurology">Neurology</option>
            <option value="General Medicine">General Medicine</option>
          </select>
        </div>

        <!-- Phone -->
        <div class="form-group">
          <label for="phone">Phone</label>
          <input type="tel" id="phone" name="phone" class="form-control" placeholder="Enter phone number" required>
        </div>

        <!-- Profile Photo -->
        <div class="form-group">
          <label>Profile Photo</label>
          <div class="file-input-wrapper">
            <input type="file" id="profilePhoto" name="profile_photo" accept="image/*" style="display: none;" onchange="updateFileName(this)">
            <button type="button" class="file-btn" onclick="document.getElementById('profilePhoto').click()">Choose</button>
            <span class="file-name" id="fileNameDisplay">No file chosen</span>
          </div>
        </div>

        <!-- Form Actions -->
        <div class="button-group">
         <a href="adminDashboard.php"> <button type="button" class="btn btn-cancel">close</button></a>
          <button type="submit" class="btn btn-register" name="register">Register Doctor</button>
        </div>

      </form>
    </div>
  </div>

</body>
</html>