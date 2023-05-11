


<?php
// create class for Employee for this //     $db->query("INSERT INTO `employees` (`first_name`, `last_name`, `nationID`, `birthday`, `educational_qualification`, `date_hire`, `job_title`, `category`, `job_grade`, `year_grade`, `directorate`, `department`, `Promotion`, `phone`, `email`) VALUES ('$first_name', '$last_name', '$nationID', '$birthday', '$educational_qualification', '$date_hire', '$job_title', '$category', '$job_grade', '$year_grade', '$directorate', '$department', '$Promotion', '$phone', '$email')");
// that accept execute on db

class Employee
{
    public $first_name;
    public $last_name;
    public $nationID;
    public $birthday;
    public $educational_qualification;
    public $date_hire;
    public $job_title;
    public $category;
    public $job_grade;
    public $year_grade;
    public $directorate;
    public $department;
    public $Promotion;
    public $phone;
    public $email;
    public $id;

    public function __construct()
    {
    }

    // create setters 

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

    public function setNationID($nationID)
    {
        $this->nationID = $nationID;
        return $this;
    }

    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;
        return $this;
    }

    public function setEducationalQualification($educational_qualification)
    {
        $this->educational_qualification = $educational_qualification;
        return $this;
    }

    public function setDateHire($date_hire)
    {
        $this->date_hire = $date_hire;
        return $this;
    }


    public function setJobTitle($job_title)
    {
        $this->job_title = $job_title;
        return $this;
    }

    public function setCategory($category)
    {
        $this->category = $category;
        return $this;
    }

    public function setJobGrade($job_grade)
    {
        $this->job_grade = $job_grade;
        return $this;
    }

    public function setYearGrade($year_grade)
    {
        $this->year_grade = $year_grade;
        return $this;
    }

    public function setDirectorate($directorate)
    {
        $this->directorate = $directorate;
        return $this;
    }

    public function setDepartment($department)
    {
        $this->department = $department;
        return $this;
    }

    public function setPromotion($Promotion)
    {
        $this->Promotion = $Promotion;
        return $this;
    }


    public function setPhone($phone)
    {
        $this->phone = $phone;
        return $this;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }


    public function update(MySQLConnector $db)
    {
        $sql = "UPDATE `employees` SET `first_name` = '$this->first_name', `last_name` = '$this->last_name', `nationID` = '$this->nationID', `birthday` = '$this->birthday', `educational_qualification` = '$this->educational_qualification', `date_hire` = '$this->date_hire', `job_title` = '$this->job_title', `category` = '$this->category', `job_grade` = '$this->job_grade', `year_grade` = '$this->year_grade', `directorate` = '$this->directorate', `department` = '$this->department', `Promotion` = '$this->Promotion', `phone` = '$this->phone', `email` = '$this->email' WHERE `id` = $this->id";
        $db->query($sql);
    }


    public function delete(MySQLConnector $db)
    {
        $sql = "DELETE FROM `employees` WHERE `id` = $this->id";
        $db->query($sql);
    }

    public function updateSuccess($success, MySQLConnector $db)
    {
    }

    public function insert(MySQLConnector $db)
    {
        $sql = "INSERT INTO `employees` (`first_name`, `last_name`, `nationID`, `birthday`, `educational_qualification`, `date_hire`, `job_title`, `category`, `job_grade`, `year_grade`, `directorate`, `department`, `Promotion`, `phone`, `email`) VALUES ('$this->first_name', '$this->last_name', '$this->nationID', '$this->birthday', '$this->educational_qualification', '$this->date_hire', '$this->job_title', '$this->category', '$this->job_grade', '$this->year_grade', '$this->directorate', '$this->department', '$this->Promotion', '$this->phone', '$this->email')";

        $db->query($sql);
        $this->id = $db->getLastInsertedId();
    }

    static public function get($id, MySQLConnector $db)
    {
        $sql = "SELECT * FROM `employees` WHERE `id` = $id";
        // check if its empty or not

        $result = $db->query($sql);

        if ($result->num_rows == 0) {
            return null;
        }
        $row = $result->fetch_assoc();

        $employee = new Employee();
        $employee->setFirstName($row['first_name'])
            ->setLastName($row['last_name'])
            ->setNationID($row['nationID'])
            ->setBirthday($row['birthday'])
            ->setEducationalQualification($row['educational_qualification'])
            ->setDateHire($row['date_hire'])
            ->setJobTitle($row['job_title'])
            ->setCategory($row['category'])
            ->setJobGrade($row['job_grade'])
            ->setYearGrade($row['year_grade'])
            ->setDirectorate($row['directorate'])
            ->setDepartment($row['department'])
            ->setPromotion($row['Promotion'])
            ->setPhone($row['phone'])
            ->setEmail($row['email'])
            ->id = $row['id'];
        return $employee;
    }

    static public function getAll(MySQLConnector $db)
    {
        $sql = "SELECT * FROM `employees`";
        $result = $db->query($sql);
        $employees = [];
        while ($row = $result->fetch_assoc()) {
            $employee = new Employee();
            $employee->setFirstName($row['first_name'])
                ->setLastName($row['last_name'])
                ->setNationID($row['nationID'])
                ->setBirthday($row['birthday'])
                ->setEducationalQualification($row['educational_qualification'])
                ->setDateHire($row['date_hire'])
                ->setJobTitle($row['job_title'])
                ->setCategory($row['category'])
                ->setJobGrade($row['job_grade'])
                ->setYearGrade($row['year_grade'])
                ->setDirectorate($row['directorate'])
                ->setDepartment($row['department'])
                ->setPromotion($row['Promotion'])
                ->setPhone($row['phone'])
                ->setEmail($row['email'])
                ->id = $row['id'];
            $employees[] = $employee;
        }
        return $employees;
    }
}
