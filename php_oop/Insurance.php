<?php
require_once('Database.php');
require_once("PatientRecord.php");

class Insurance implements PatientRecord
{
    private $_id;
    private $patient_id;
    private $iname;
    private $from_date;
    private $to_date;
    private $pn;
    private $db;


    public function __construct($_id)
    {
        $this->db = new Database;
        $this->_id = $_id;

        $this->fetch_insurance_data();

    }

    // Extra private function to handle sql query
    private function fetch_insurance_data()
    {
        $result = $this->db->execute("
        SELECT insurance.*, patient.pn
        FROM insurance 
        JOIN patient ON insurance.patient_id = patient._id
        WHERE insurance._id = " . $this->_id . ";");

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $this->patient_id = $row["patient_id"];
            $this->iname = $row["iname"];
            $this->from_date = $row["from_date"];
            $this->to_date = $row["to_date"];
            $this->pn = $row["pn"];
        } else {
            echo "Empty result";
        }
    }



    // Getters
    public function get_id()
    {
        return $this->_id;
    }
    public function get_patient_number()
    {
        return $this->pn;
    }
    // //Extra getter method to get insurance name
    public function get_insurance_name()
    {
        return $this->iname;
    }

    //Insurance validity on specified date
    public function validate($date_mmddyy)
    {
        $date_obj = DateTime::createFromFormat('m-d-y', $date_mmddyy);
        $formatted_date = $date_obj->format('Y-m-d');
        $is_valid = (($formatted_date >= $this->from_date && $formatted_date <= $this->to_date)
            || ($formatted_date >= $this->from_date && $this->to_date === null));
        return $is_valid;

    }

}

/* $th = new Insurance(15);
echo $th->get_id() . "\n";
echo $th->get_patient_number() . "\n";
echo $th->get_insurance_name() . "\n";
$valid = $th->validate("01-01-33") ? "yes":"no";
print_r($valid . "\n"); */


?>