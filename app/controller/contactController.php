<?php
session_start();

require __DIR__ . '/../model/contactModel.php';

class Manager
{
    private $connectModel;

    public function __construct()
    {
        $this->connectModel = new ContactModel();
    }

    public function handleller()
    {
        $action = $_GET['action'] ?? null;

        /* ================= ACTIONS ================= */

        switch ($action) {

            /* ---------- LOGIN ---------- */
            case 'login':

                if (isset($_POST['login'])) {

                    $result = $this->connectModel->loginUser(
                        $_POST['email'],
                        $_POST['password']
                    );

                    if ($result) {

                        if ($result['type'] === 'doctor') {
                            $_SESSION['doctor_id'] =
                                $result['user']['doctor_id'];

                            header("Location: ?view=doctorDashboard");
                            exit;
                        }

                        if ($result['type'] === 'patient') {
                            $_SESSION['patient_id'] =
                                $result['user']['patient_id'];

                            header("Location: ?view=patientDashboard");
                            exit;
                        }

                        if ($result['type']=== 'admin') {
                            $_SESSION['admin_id'] = 
                            $result['user']['admin_id'];

                            header("location: ?view=adminDashboard");
                            exit;
                        }
                    } else {
                        echo "Invalid email or password.";
                    }
                }

                break;


            /* ---------- REGISTER PATIENT ---------- */
            case 'registerPatient':

                if (isset($_POST['submit'])) {

                    $success = $this->connectModel->registerPatient(
                        $_POST['username'],
                        $_POST['email'],
                        $_POST['password'],
                        $_POST['phone'],
                        $_POST['DOB'],
                        $_POST['gender']
                    );

                    if ($success) {
                        header("Location: ?view=login");
                        exit;
                    }

                    echo "Registration failed.";
                }

                break;


            /* ---------- SHOW CONFIRMATION PAGE ---------- */
            case 'confirmBooking':

                if (!isset($_SESSION['patient_id'])) {
                    die("Patient is not logged in.");
                }

                if (isset($_POST['book'])) {

                    $doctor_id = $_POST['doctor_id'];
                    $date = $_POST['appointment_date'];
                    $time = $_POST['appointment_time'];
                    $reason = $_POST['reason'];

                    $doctor =
                        $this->connectModel->getDoctorById($doctor_id);

                    if (!$doctor) {
                        die("Doctor not found.");
                    }

                    $this->display('confirmBook', [
                        'doctor' => $doctor,
                        'appointment_date' => $date,
                        'appointment_time' => $time,
                        'reason' => $reason
                    ]);

                    return;
                }


                /* ---------- ACTUALLY SAVE ---------- */

                if (isset($_POST['confirm_booking'])) {

                    $appointment_id =
                        $this->connectModel->bookAppointment(
                            $_SESSION['patient_id'],
                            $_POST['doctor_id'],
                            $_POST['appointment_date'],
                            $_POST['appointment_time'],
                            $_POST['reason']
                        );

                    if ($appointment_id) {
                        header("Location: ?view=patientDashboard");
                        exit;
                    }

                    die("Failed to book appointment.");
                }

                break;


            /* ---------- SAVE MEDICAL RECORD ---------- */
            case 'doctorRecords':

                if (!isset($_SESSION['doctor_id'])) {
                    die("Doctor is not logged in.");
                }

                if (isset($_POST['save_record'])) {

                    $appointment =
                        $this->connectModel->getAppointmentForRecord(
                            $_POST['appointment_id'],
                            $_SESSION['doctor_id']
                        );

                    if (!$appointment) {
                        die("Appointment not found.");
                    }

                    $this->connectModel->saveMedicalRecord(
                        $appointment['patient_id'],
                        $_SESSION['doctor_id'],
                        $_POST['appointment_id'],
                        $_POST['diagnosis'],
                        $_POST['symptoms'],
                        $_POST['treatment'],
                        $_POST['notes']
                    );

                    header("Location: ?view=prescript");
                    exit;
                }

                break;


            /* ---------- SAVE PRESCRIPTION ---------- */
            case 'prescript':

                if (!isset($_SESSION['doctor_id'])) {
                    die("Doctor is not logged in.");
                }

                if (isset($_POST['save_prescription'])) {

                    $appointment =
                        $this->connectModel->getAppointmentForRecord(
                            $_POST['appointment_id'],
                            $_SESSION['doctor_id']
                        );

                    if (!$appointment) {
                        die("Appointment not found.");
                    }

                    $this->connectModel->savePrescription(
                        $appointment['patient_id'],
                        $_SESSION['doctor_id'],
                        $_POST['appointment_id'],
                        $_POST['medication'],
                        $_POST['dosage'],
                        $_POST['frequency'],
                        $_POST['duration']
                    );

                    header("Location: ?view=doctorDashboard");
                    exit;
                }

                break;
        }


        /* ================= VIEWS ================= */

        $view = $_GET['view'] ?? 'login';


        switch ($view) {

            /* ---------- HOME ---------- */
            case 'home':

                $doctors =
                    $this->connectModel->getDoctors();

                $this->display('home', [
                    'doctors' => $doctors
                ]);

                break;


            /* ---------- PATIENT DASHBOARD ---------- */
            case 'patientDashboard':

                if (!isset($_SESSION['patient_id'])) {
                    die("Patient is not logged in.");
                }

                $patient_id = $_SESSION['patient_id'];

                $patient =
                    $this->connectModel->getPatientById($patient_id);

                $appointments =
                    $this->connectModel
                    ->getPatientAppointments($patient_id);

                $medicalRecords =
                    $this->connectModel
                    ->getPatientMedicalRecords($patient_id);

                $prescriptions = $this->connectModel
                    ->getPatientPrescriptions($patient_id);    

                $pending = 0;
                $approved = 0;

                foreach ($appointments as $appointment) {

                    if ($appointment['status'] === 'Pending') {
                        $pending++;
                    }

                    if ($appointment['status'] === 'Approved') {
                        $approved++;
                    }
                }

                $this->display('patientDashboard', [
                    'patient' => $patient,
                    'appointments' => $appointments,
                    'medicalRecords' => $medicalRecords,
                    'prescriptions' => $prescriptions,
                    'totalAppointments' => count($appointments),
                    'pendingAppointments' => $pending,
                    'approvedAppointments' => $approved
                ]);

                break;


            /* ---------- DOCTOR DASHBOARD ---------- */
            case 'doctorDashboard':

                if (!isset($_SESSION['doctor_id'])) {
                    die("Doctor is not logged in.");
                }

                $doctor_id = $_SESSION['doctor_id'];

                $appointments =
                    $this->connectModel
                    ->getDoctorAppointments($doctor_id);

                $prescriptions =
                    $this->connectModel
                    ->getDoctorPrescriptions($doctor_id);

                $this->display('doctorDashboard', [
                    'appointments' => $appointments,
                    'myAppointments' => $appointments,
                    'prescriptions' => $prescriptions
                ]);

                break;


            /* ---------- DOCTOR RECORD ---------- */
            case 'doctorRecords':

                if (!isset($_SESSION['doctor_id'])) {
                    die("Doctor is not logged in.");
                }

                if (!isset($_GET['appointment_id'])) {
                    die("Appointment ID is missing.");
                }

                $appointment =
                    $this->connectModel
                    ->getAppointmentForRecord(
                        $_GET['appointment_id'],
                        $_SESSION['doctor_id']
                    );

                if (!$appointment) {
                    die("Appointment not found.");
                }

                $this->display('doctorRecords', [
                    'appointment' => $appointment
                ]);

                break;


            /* ---------- PRESCRIPTION PAGE ---------- */
            case 'prescript':

                if (!isset($_SESSION['doctor_id'])) {
                    die("Doctor is not logged in.");
                }

                if (!isset($_GET['appointment_id'])) {
                    die("Appointment ID is missing.");
                }

                $appointment =
                    $this->connectModel
                    ->getAppointmentForRecord(
                        $_GET['appointment_id'],
                        $_SESSION['doctor_id']
                    );

                if (!$appointment) {
                    die("Appointment not found.");
                }

                $this->display('prescript', [
                    'appointment' => $appointment
                ]);

                break;


            /* ---------- VIEW PRESCRIPTION ---------- */
            case 'doctorViewPrescript':

                if (!isset($_SESSION['doctor_id'])) {
                    die("Doctor is not logged in.");
                }

                if (!isset($_GET['prescription_id'])) {
                    die("Prescription ID is missing.");
                }

                $prescription =
                    $this->connectModel
                    ->getPrescriptionById(
                        $_GET['prescription_id'],
                        $_SESSION['doctor_id']
                    );

                if (!$prescription) {
                    die("Prescription not found.");
                }

                $this->display('doctorViewPrescript', [
                    'prescription' => $prescription
                ]);

                break;


            /* ---------- ABOUT ---------- */
            case 'about':

                $this->display('about');

                break;

            /*--------Doctor -----------------*/
            case 'adminDashboard':

                if(!isset($_SESSION['admin_id'])){
                    die("Admin is not log in");
                }
                $admin_id = $_SESSION['admin_id'];

                $admin = $this->connectModel
                        ->getAdminById($admin_id);
              
                $appointments = 
                $this->connectModel
                        ->getAdminAppointments($admin_id);
                 
                $pending = 0;
           

                foreach ($appointments as $appointment) {

                    if ($appointment['status'] === 'Pending') {
                        $pending++;
                    }
                }        

                $this->display('adminDashboard', [
                    'admin' => $admin,
                    'appointments'=> $appointments
                ]);
                break;

            case 'adminRecDoc':
                $this->display('adminRecDoc');
                break;    
            /* ---------- DEFAULT ---------- */
            default:

                $this->display('login');

                break;
        }
    }


    public function display($view = 'login', $data = [])
    {
        extract($data);

        if ($view === 'login') {
            include __DIR__ . '/../view/main/login.php';
        } else {
            include __DIR__ . '/../view/main/' . $view . '.php';
        }
    }
}
?>