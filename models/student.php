<?php
require 'study.php';

class Student
{
    public $id;
    public $first_name;
    public $last_name;
    public $specialization;
    public $university;
    public $partnering_entity;
    public $email;
    public $directorate;
    public $department;
    public $employeeID;

    public function __construct()
    {
    }

    // Setter and Getter for id
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    // Setter and Getter for first_name
    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;
        return $this;
    }



    public function setLastName($last_name)
    {
        $this->last_name = $last_name;
        return $this;
    }


    // Setter and Getter for specialization
    public function setSpecialization($specialization)
    {
        $this->specialization = $specialization;
        return $this;
    }



    // Setter and Getter for university
    public function setUniversity($university)
    {
        $this->university = $university;
        return $this;
    }



    // Setter and Getter for partnering_entity
    public function setPartneringEntity($partnering_entity)
    {
        $this->partnering_entity = $partnering_entity;
        return $this;
    }



    // Setter and Getter for email
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }



    // Setter and Getter for directorate
    public function setDirectorate($directorate)
    {
        $this->directorate = $directorate;
        return $this;
    }



    // Setter and Getter for department
    public function setDepartment($department)
    {
        $this->department = $department;
        return $this;
    }



    // Setter and Getter for employeeID
    public function setEmployeeID($employeeID)
    {
        $this->employeeID = $employeeID;
        return $this;
    }




    public function insert(MySQLConnector $db)
    {
        $employeeID = isset($this->employeeID) ? $this->employeeID : "NULL";
        $sql = "INSERT INTO student (first_name, last_name, specialization, university, partnering_entity, email, directorate, department, empolyeeID)
        VALUES ('$this->first_name', '$this->last_name', '$this->specialization', '$this->university', '$this->partnering_entity', '$this->email', '$this->directorate', '$this->department', $employeeID)";

        $db->query($sql);
        $this->id = $db->getLastInsertedId();
    }

    public function assignTo(Program $program, MySQLConnector $db, $isOptional, $year)
    {
        // todo use the combination of student and program as a primary key
        // check if this student is already assigned to this program
        $sql = "SELECT * FROM study WHERE student = $this->id AND program = $program->id";
        $result = $db->query($sql);
        $row = $result->fetch_assoc();

        if ($row) {
            return;
        }
        $optional = $isOptional ? 1 : 0;
        $sql = "INSERT INTO study (student, program, year, optional,personel_note)
                VALUES ('$this->id', '$program->id', '$year', '$optional','')";

        $db->query($sql);
    }

    public function getStudies(MySQLConnector $db)
    {
        $sql = "SELECT * FROM study  WHERE study.student = '$this->id'";
        $result = $db->query($sql);

        $studies = [];
        while ($row = $result->fetch_assoc()) {
            $program = Program::get($row['program'], $db);
            $study = new Study();
            $study->setProgram($program)
                ->setStudentID($this->id)
                ->setYear($row['year'])
                ->setIsOptional($row['optional'])
                ->setIsDone($row['done'])
                ->setPersonel_note($row['personel_note'])
                ->id = $row['id'];
            $studies[] = $study;
        }

        return $studies;
    }

    public function getRunningPrograms(MySQLConnector $db)
    {
        $sql = "SELECT * FROM study WHERE student = $this->id AND year = YEAR(CURDATE()) AND done = 0";
        $result = $db->query($sql);


        $programs = [];
        while ($row = $result->fetch_assoc()) {
            $program = Program::get($row['program'], $db);
            // todo create class for Study
            $programs[] = $program;
        }



        return $programs;
    }


    public function delete(MySQLConnector $db)
    {
        // delete from the study then from the stuend

        $sql = "DELETE FROM study WHERE student = $this->id";
        $db->query($sql);

        $sql = "DELETE FROM student WHERE id = $this->id";
        $db->query($sql);
    }
    static public function fromEmployee(Employee $employee, MySQLConnector $db)
    {
        // check if the employee is already a student or not
        $sql = "SELECT * FROM student WHERE empolyeeID = $employee->id";
        $result = $db->query($sql);
        $row = $result->fetch_assoc();

        if ($row) {
            $student = new Student();
            $student->setId($row['id'])
                ->setFirstName($row['first_name'])
                ->setLastName($row['last_name'])
                ->setSpecialization($row['specialization'])
                ->setUniversity($row['university'])
                ->setPartneringEntity($row['partnering_entity'])
                ->setEmail($row['email'])
                ->setDirectorate($row['directorate'])
                ->setDepartment($row['department'])
                ->setEmployeeID($row['empolyeeID']);
            return $student;
        } else {
            $student = new Student();
            $student->setFirstName($employee->first_name)
                ->setLastName($employee->last_name)
                ->setEmployeeID($employee->id);

            $student->insert($db);
            return $student;
        }
    }

    static public function get($id, MySQLConnector $db)
    {
        $sql = "SELECT * FROM student WHERE id = $id";
        $result = $db->query($sql);
        $row = $result->fetch_assoc();

        if ($row) {
            $student = new Student();
            $student->setId($row['id'])
                ->setFirstName($row['first_name'])
                ->setLastName($row['last_name'])
                ->setSpecialization($row['specialization'])
                ->setUniversity($row['university'])
                ->setPartneringEntity($row['partnering_entity'])
                ->setEmail($row['email'])
                ->setDirectorate($row['directorate'])
                ->setDepartment($row['department'])
                ->setEmployeeID($row['empolyeeID']);
            return $student;
        } else {
            return null;
        }
    }



    static public function getAll(MySQLConnector $db)
    {
        $sql = "SELECT * FROM student";
        $result = $db->query($sql);

        $students = [];
        $employees = [];
        while ($row = $result->fetch_assoc()) {
            $student = new Student();
            $student->setId($row['id'])
                ->setFirstName($row['first_name'])
                ->setLastName($row['last_name'])
                ->setSpecialization($row['specialization'])
                ->setUniversity($row['university'])
                ->setPartneringEntity($row['partnering_entity'])
                ->setEmail($row['email'])
                ->setDirectorate($row['directorate'])
                ->setDepartment($row['department'])
                ->setEmployeeID($row['empolyeeID']);

            if ($student->email == null) {
                $employee = Employee::get($student->employeeID, $db);
                $employees[] = $employee;
            } else {
                $students[] = $student;
            }
        }

        return [
            "students" => $students,
            "employees" => $employees
        ];
    }


    static public function getAllByTrainer(Trainer $trainer, MySQLConnector $db)
    {
        $sql = "SELECT *, student.id as studentID  FROM student join study on student.id = study.student join program on study.program = program.id WHERE program.trainer = $trainer->id";
        $result = $db->query($sql);

        $students = [];
        while ($row = $result->fetch_assoc()) {
            $student = new Student();
            $student->setId($row['studentID'])
                ->setFirstName($row['first_name'])
                ->setLastName($row['last_name'])
                ->setSpecialization($row['specialization'])
                ->setUniversity($row['university'])
                ->setPartneringEntity($row['partnering_entity'])
                ->setEmail($row['email'])
                ->setDirectorate($row['directorate'])
                ->setDepartment($row['department'])
                ->setEmployeeID($row['empolyeeID']);
            $students[] = $student;
        }

        return $students;
    }
}
