<?php
require_once('Database.php');
require_once("PatientRecord.php");
require_once("Insurance.php");

class Patient implements PatientRecord
{
    private $_id;
    private $pn;
    private $first;
    private $last;
    private $dob;
    private $insurance_records = array();
    private $db;


    public function __construct($pn)
    {
        $this->db = new Database;
        $this->pn = $pn;

        // Populating fields with db data
        if ($pn) {
            $this->fetch_patient_data();
            // // 
            $this->insurance_records = array_map(function ($rec) {
                return new Insurance($rec["_id"]);
            }, $this->fetch_insurance_records());
        } else {
            echo "Missing parameter";
        }
    }

    //Extra private functions to separate sql queries
    private function fetch_patient_data()
    {
        $result = $this->db->execute("
        SELECT *
        FROM patient 
        WHERE pn = " . $this->pn . ";");

        $patient_data = mysqli_fetch_assoc($result);
        if ($result->num_rows > 0) {
            $this->_id = $patient_data["_id"];
            $this->first = $patient_data["first"];
            $this->last = $patient_data["last"];
            $this->dob = $patient_data["dob"];
        } else {
            echo "Empty result";
        }
    }

    private function fetch_insurance_records()
    {
        $result = $this->db->execute("SELECT * FROM insurance WHERE patient_id = " . $this->_id . ";");
        if ($result) {
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        }
    }

    //Getters
    public function get_id()
    {
        return $this->_id;
    }
    public function get_patient_number()
    {
        return $this->pn;
    }
    public function get_patient_name()
    {
        return $this->first . " " . $this->last;
    }
    public function get_insurance_records()
    {
        return $this->insurance_records;
    }

    //Insurance validity on specified date
    public function validate($date_mmddyy)
    {
        foreach ($this->insurance_records as $record) {
            $valid = $record->validate($date_mmddyy) ? "Yes" : "No";
            echo "{$this->pn}, {$this->first}, {$this->last}, {$record->get_insurance_name()}, {$valid} \n";
        }
    }
}