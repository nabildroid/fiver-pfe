<?php

include '../config.php';


class MySQLConnector
{
    private $host;
    private $username;
    private $password;
    private $dbname;
    private $conn;

    function __construct($host, $username, $password, $dbname)
    {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;
    }

    function connect()
    {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->dbname);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    function disconnect()
    {
        $this->conn->close();
    }

    function query($sql)
    {
        $result = $this->conn->query($sql);
        if ($result === false) {
            die("Query failed: " . $this->conn->error);
        }
        return $result;
    }

    public function getLastInsertedId()
    {
        return $this->conn->insert_id;
    }



    public function getEmployees()
    {
        // Dummy data for employees
        $employees = array(
            array("id" => 1, "first_name" => "John", "last_name" => "Doe", "nationID" => "1234567890", "birthday" => "1990-01-01", "educational_qualification" => "Bachelor's Degree", "date_hire" => "2020-01-01", "job_title" => "Software Developer", "category" => "IT", "job_grade" => "Senior", "year_grade" => 5, "directorate" => "Technology", "department" => "Development", "Promotion" => "Yes", "phone" => "+1234567890", "email" => "john.doe@example.com"),
            array("id" => 2, "first_name" => "Jane", "last_name" => "Doe", "nationID" => "0987654321", "birthday" => "1992-01-01", "educational_qualification" => "Master's Degree", "date_hire" => "2021-01-01", "job_title" => "Project Manager", "category" => "Management", "job_grade" => "Junior", "year_grade" => 2, "directorate" => "Operations", "department" => "Project Management", "Promotion" => "No", "phone" => "+0987654321", "email" => "jane.doe@example.com")
        );

        return $employees;
    }

    public function getPlanning()
    {
        // Dummy data for planning
        $planning = array(
            array("id" => 1, "program" => 1, "year" => 2022),
            array("id" => 2, "program" => 2, "year" => 2022)
        );

        return $planning;
    }

    public function getPrograms()
    {
        // Dummy data for programs
        $programs = array(
            array("id" => 1, "program_name" => "PHP Development", "program_type" => "Training", "institution_name" => "Acme Inc.", "internal_or_external" => "Internal", "location" => "Online", "number_of_hours" => 40, "number_of_days" => 5, "employee_id" => 1),
            array("id" => 2, "program_name" => "Project Management", "program_type" => "Training", "institution_name" => "Acme Inc.", "internal_or_external" => "External", "location" => "In-person", "number_of_hours" => 32, "number_of_days" => 4, "employee_id" => 2)
        );

        return $programs;
    }



    public function getStudents()
    {
        // Dummy data for students
        $students = array(
            array("id" => 1, "first_name" => "Alice", "last_name" => "Smith", "specialization" => "Computer Science", "university" => "University of California", "partnering_entity" => "Acme Inc.", "email" => "alice.smith@example.com", "directorate" => "Technology", "department" => "Development"),
            array("id" => 2, "first_name" => "Bob", "last_name" => "Johnson", "specialization" => "Business Administration", "university" => "Harvard University", "partnering_entity" => "Acme Inc.", "email" => "bob.johnson@example.com", "directorate" => "Operations", "department" => "Project Management")
        );

        return $students;
    }

    public function getStudies()
    {
        // Dummy data for studies
        $studies = array(
            array("id" => 1, "student" => 1, "program" => 1, "program_type" => "Training", "start_date" => "2022-03-01", "end_date" => "2022-03-05"),
            array("id" => 2, "student" => 2, "program" => 2, "program_type" => "Training", "start_date" => "2022-04-01", "end_date" => "2022-04-04")
        );

        return $studies;
    }
}


$db = new MySQLConnector(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

$db->connect();
