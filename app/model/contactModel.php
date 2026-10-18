<?php

require __DIR__ . '/DB.php';

class ContactModel
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->conn;
    }

    // GET ALL DOCTORS
    public function getDoctors()
    {
        $stmt = $this->db->prepare("SELECT * FROM doctor");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
    // COUNT DOCTORS
public function countDoctors()
{
    $stmt = $this->db->prepare("SELECT COUNT(*) FROM doctor");
    $stmt->execute();
    return $stmt->fetchColumn();
}

// COUNT PATIENTS
public function countPatients()
{
    $stmt = $this->db->prepare("SELECT COUNT(*) FROM patient");
    $stmt->execute();
    return $stmt->fetchColumn();
}
    // GET DOCTOR BY ID
    public function getDoctorById($doctor_id)
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM doctor WHERE doctor_id = ?"
        );

        $stmt->execute([$doctor_id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // LOGIN
    public function loginUser($email, $password)
    {
        // Doctor
        $stmt = $this->db->prepare(
            "SELECT * FROM doctor WHERE email = ?"
        );

        $stmt->execute([$email]);
        $doctor = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($doctor && password_verify($password, $doctor['password'])) {
            return [
                'type' => 'doctor',
                'user' => $doctor
            ];
        }

        // Patient
        $stmt = $this->db->prepare(
            "SELECT * FROM patient WHERE email = ?"
        );

        $stmt->execute([$email]);
        $patient = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($patient && password_verify($password, $patient['password'])) {
            return [
                'type' => 'patient',
                'user' => $patient
            ];
        }

        $stmt = $this->db->prepare(
            "SELECT * FROM admin WHERE email = ?"
        );

        $stmt->execute([$email]);
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);

        if($admin && password_verify($password, $admin['password'])) {
            return [
                'type' => 'admin',
                'user' => $admin
            ];
        }

        return false;
    }

    // REGISTER PATIENT
    public function registerPatient(
        $username,
        $email,
        $password,
        $phone,
        $DOB,
        $gender
    ) {
        $sql = "
            INSERT INTO patient
            (username, email, password, phone, DOB, gender)
            VALUES (?, ?, ?, ?, ?, ?)
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            $username,
            $email,
            password_hash($password, PASSWORD_DEFAULT),
            $phone,
            $DOB,
            $gender
        ]);
    }

    // Get admin by ID 
    public function getAdminById($admin_id)
    {
        $sql = "SELECT admin_id,username FROM admin WHERE admin_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$admin_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC); 
    }
    // GET PATIENT BY ID
    public function getPatientById($patient_id)
    {
        $sql = "
            SELECT
                patient_id,
                username,
                email,
                phone,
                DOB,
                gender
            FROM patient
            WHERE patient_id = ?
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$patient_id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // GET PATIENT APPOINTMENTS
    public function getPatientAppointments($patient_id)
    {
        $sql = "
            SELECT
                a.appointment_id,
                a.appointment_date,
                a.appointment_time,
                a.reason,
                a.status,
                d.username AS doctor_name,
                d.specialty
            FROM appointment a
            INNER JOIN doctor d
                ON a.doctor_id = d.doctor_id
            WHERE a.patient_id = ?
            ORDER BY a.appointment_date DESC,
                     a.appointment_time DESC
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$patient_id]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // BOOK APPOINTMENT
    public function bookAppointment(
        $patient_id,
        $doctor_id,
        $appointment_date,
        $appointment_time,
        $reason
    ) {
        $sql = "
            INSERT INTO appointment
            (
                patient_id,
                doctor_id,
                appointment_date,
                appointment_time,
                reason,
                status
            )
            VALUES (?, ?, ?, ?, ?, 'Pending')
        ";

        $stmt = $this->db->prepare($sql);

        $success = $stmt->execute([
            $patient_id,
            $doctor_id,
            $appointment_date,
            $appointment_time,
            $reason
        ]);

        if ($success) {
            return $this->db->lastInsertId();
        }

        return false;
    }

    // GET ONE APPOINTMENT
    public function getAppointmentById(
        $appointment_id,
        $patient_id
    ) {
        $sql = "
            SELECT
                a.appointment_id,
                a.appointment_date,
                a.appointment_time,
                a.reason,
                a.status,

                d.doctor_id,
                d.username AS doctor_name,
                d.specialty,
                d.profile_photo

            FROM appointment a

            INNER JOIN doctor d
                ON a.doctor_id = d.doctor_id

            WHERE a.appointment_id = ?
            AND a.patient_id = ?
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            $appointment_id,
            $patient_id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // GET DOCTOR APPOINTMENTS
    public function getDoctorAppointments($doctor_id)
    {
        $sql = "
            SELECT
                a.appointment_id,
                a.appointment_date,
                a.appointment_time,
                a.reason,
                a.status,
                p.username AS patient_name
            FROM appointment a
            INNER JOIN patient p
                ON a.patient_id = p.patient_id
            WHERE a.doctor_id = ?
            ORDER BY a.appointment_date DESC,
                     a.appointment_time DESC
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$doctor_id]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listPatients(){

    $sql = "
        SELECT * from patient";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchALL(PDO::FETCH_ASSOC);
    }
    //GET APPOINTMENT FOR ADMIN LET HIS SEEEE😣
    public function getAdminAppointments($admin_id){
         $sql = "
            SELECT
                a.appointment_id,
            a.appointment_date,
            a.appointment_time,
            a.reason,
            a.status,
            p.username AS patient_name,
            d.username AS doctor_name
        FROM appointment a
        INNER JOIN patient p ON a.patient_id = p.patient_id
        INNER JOIN doctor d ON a.doctor_id = d.doctor_id
        ORDER BY a.appointment_date DESC, a.appointment_time DESC
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([]);
        return $stmt->FetchAll(PDO::FETCH_ASSOC);
    }

    // APPROVE APPOINTMENT
public function approveAppointment($appointment_id)
{
    $sql = "UPDATE appointment SET status = 'Approved' WHERE appointment_id = ?";
    $stmt = $this->db->prepare($sql);
    return $stmt->execute([$appointment_id]);
}
    // GET APPOINTMENT FOR MEDICAL RECORD
    public function getAppointmentForRecord(
        $appointment_id,
        $doctor_id
    ) {
        $sql = "
            SELECT
                a.appointment_id,
                a.appointment_date,
                a.appointment_time,
                a.reason,
                a.status,

                p.patient_id,
                p.username,
                p.gender,
                p.phone,
                p.DOB

            FROM appointment a

            INNER JOIN patient p
                ON a.patient_id = p.patient_id

            WHERE a.appointment_id = ?
            AND a.doctor_id = ?
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            $appointment_id,
            $doctor_id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // GET DOCTOR PRESCRIPTIONS
    public function getDoctorPrescriptions($doctor_id)
    {
        $sql = "
            SELECT
                pr.prescription_id,
                pr.appointment_id,
                pr.medication,
                pr.dosage,
                pr.frequency,
                pr.duration,
                pr.created_at,
                p.username AS patient_name

            FROM prescription pr

            INNER JOIN patient p
                ON pr.patient_id = p.patient_id

            WHERE pr.doctor_id = ?

            ORDER BY pr.created_at DESC
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$doctor_id]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // GET ONE PRESCRIPTION
    public function getPrescriptionById(
        $prescription_id,
        $doctor_id
    ) {
        $sql = "
            SELECT
                pr.prescription_id,
                pr.appointment_id,
                pr.medication,
                pr.dosage,
                pr.frequency,
                pr.duration,
                pr.created_at,

                p.username AS patient_name,
                p.gender,
                p.phone,
                p.DOB

            FROM prescription pr

            INNER JOIN patient p
                ON pr.patient_id = p.patient_id

            WHERE pr.prescription_id = ?
            AND pr.doctor_id = ?
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            $prescription_id,
            $doctor_id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // SAVE MEDICAL RECORD
    public function saveMedicalRecord(
        $patient_id,
        $doctor_id,
        $appointment_id,
        $diagnosis,
        $symptoms,
        $treatment,
        $notes
    ) {
        $sql = "
            INSERT INTO medical_record
            (
                patient_id,
                doctor_id,
                appointment_id,
                diagnosis,
                symptoms,
                treatment,
                notes
            )
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            $patient_id,
            $doctor_id,
            $appointment_id,
            $diagnosis,
            $symptoms,
            $treatment,
            $notes
        ]);
    }

    // SAVE PRESCRIPTION
    public function savePrescription(
        $patient_id,
        $doctor_id,
        $appointment_id,
        $medication,
        $dosage,
        $frequency,
        $duration
    ) {
        $sql = "
            INSERT INTO prescription
            (
                patient_id,
                doctor_id,
                appointment_id,
                medication,
                dosage,
                frequency,
                duration
            )
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            $patient_id,
            $doctor_id,
            $appointment_id,
            $medication,
            $dosage,
            $frequency,
            $duration
        ]);
    }

    // GET PATIENT MEDICAL RECORDS
    public function getPatientMedicalRecords($patient_id)
    {
        $sql = "
            SELECT
                mr.record_id,
                mr.diagnosis,
                mr.symptoms,
                mr.treatment,
                mr.notes,
                mr.created_at,
                d.username AS doctor_name

            FROM medical_record mr

            INNER JOIN doctor d
                ON mr.doctor_id = d.doctor_id

            WHERE mr.patient_id = ?

            ORDER BY mr.created_at DESC
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$patient_id]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // get prescription fro the doctor
    public function getPatientPrescriptions($patient_id)
{
    $sql = "
        SELECT
            pr.prescription_id,
            pr.medication,
            pr.dosage,
            pr.frequency,
            pr.duration,
            pr.created_at,
            d.username AS doctor_name
        FROM prescription pr
        INNER JOIN doctor d
            ON pr.doctor_id = d.doctor_id
        WHERE pr.patient_id = ?
        ORDER BY pr.created_at DESC
    ";

    $stmt = $this->db->prepare($sql);
    $stmt->execute([$patient_id]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}
?>