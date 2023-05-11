
<?php
class Study
{
    public $id;
    public Program $program;
    public  $studentID;
    public $year;
    public $isOptional;
    public $isDone;
    public $personl_note;

    public function __construct()
    {
    }


    public function setProgram(Program $program)
    {
        $this->program = $program;
        return $this;
    }



    public function setStudentID($studentID)
    {
        $this->studentID = $studentID;
        return $this;
    }

    public function setYear($year)
    {
        $this->year = $year;
        return $this;
    }

    public function setIsOptional($isOptional)
    {
        $this->isOptional = $isOptional;
        return $this;
    }

    public function setIsDone($isDone)
    {
        $this->isDone = !!$isDone;
        return $this;
    }

    public function setPersonel_note($personl_note)
    {
        $this->personl_note = $personl_note;
        return $this;
    }



    static public function finish($id, MySQLConnector $db)
    {
        $sql = "UPDATE study SET done = 1 WHERE id = $id";
        $db->query($sql);
    }
}
