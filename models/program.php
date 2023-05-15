<?php

require_once 'trainer.php';
class Program
{
    public $name;
    public $type;
    public $institution_name;
    public $internal_or_external;
    public $location;
    public $number_of_hours;
    public $number_of_days;
    public $note = "";
    public $id;
    public $trainer;
    public $start;
    public $end;

    public function __construct()
    {
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function setStart($date)
    {
        $this->start = $date;
        return $this;
    }


    public function setEnd($date)
    {
        $this->end = $date;
        return $this;
    }

    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    public function setTrainer(Trainer $trainer)
    {
        $this->trainer = $trainer;
        return $this;
    }

    public function setInstitution($institution_name)
    {
        $this->institution_name = $institution_name;
        return $this;
    }

    public function setInternalOrExternal($internal_or_external)
    {
        $this->internal_or_external = $internal_or_external;
        return $this;
    }

    public function setLocation($location)
    {
        $this->location = $location;
        return $this;
    }

    public function setNumberOfHours($number_of_hours)
    {
        $this->number_of_hours = $number_of_hours;
        return $this;
    }

    public function setNumberOfDays($number_of_days)
    {
        $this->number_of_days = $number_of_days;
        return $this;
    }

    public function setNote($note)
    {
        $this->note = $note;
        return $this;
    }



    public function insert(Trainer $trainer, MySQLConnector $db)
    {
        $sql = "INSERT INTO `program` (`start`,`end`,`trainer`,`program_name`,`note`, `program_type`, `institution_name`, `internal_or_external`, `location`, `number_of_hours`, `number_of_days`) VALUES ('$this->start','$this->end','$trainer->id','$this->name','$this->note', '$this->type', '$this->institution_name', '$this->internal_or_external', '$this->location', '$this->number_of_hours', '$this->number_of_days')";

        $db->query($sql);
        $this->id = $db->getLastInsertedId();
    }

    public function update(MySQLConnector $db)
    {
        $sql = "UPDATE `program` SET `program_name` = '$this->name', `end` = '$this->end',`start` = '$this->start', `note` = '$this->note', `program_type` = '$this->type', `institution_name` = '$this->institution_name', `internal_or_external` = '$this->internal_or_external', `location` = '$this->location', `number_of_hours` = '$this->number_of_hours', `number_of_days` = '$this->number_of_days' WHERE `id` = $this->id";

        $db->query($sql);
    }

    static public function get($id, MySQLConnector $db)
    {
        $sql = "SELECT * FROM `program` WHERE `id` = $id";
        $result = $db->query($sql);
        $row = $result->fetch_assoc();
        $program = new Program();
        $program->setName($row['program_name'])
            ->setType($row['program_type'])
            ->setInstitution($row['institution_name'])
            ->setInternalOrExternal($row['internal_or_external'])
            ->setLocation($row['location'])
            ->setNumberOfHours($row['number_of_hours'])
            ->setNumberOfDays($row['number_of_days'])
            ->setEnd($row['end'])
            ->setStart($row['start'])
            ->id = $row['id'];

        $trainer = Trainer::get($row['trainer'], $db);
        $program->setTrainer($trainer);


        return $program;
    }

    static public function getByTrainer(Trainer $trainer, MySQLConnector $db)
    {

        $sql = "SELECT * FROM `program` WHERE `trainer` = $trainer->id";
        $result = $db->query($sql);
        $programs = [];
        while ($row = $result->fetch_assoc()) {
            $program = new Program();
            $program->setName($row['program_name'])
                ->setType($row['program_type'])
                ->setInstitution($row['institution_name'])
                ->setInternalOrExternal($row['internal_or_external'])
                ->setLocation($row['location'])
                ->setNumberOfHours($row['number_of_hours'])
                ->setNumberOfDays($row['number_of_days'])
                ->setNote($row['note'])
                ->setEnd($row['end'])
                ->setStart($row['start'])
                ->id = $row['id'];

            $trainer = Trainer::get($row['trainer'], $db);
            $program->setTrainer($trainer);
            $programs[] = $program;
        }
        return $programs;
    }

    static public function getAll(MySQLConnector $db)
    {
        $sql = "SELECT * FROM `program`";
        $result = $db->query($sql);
        $programs = [];
        while ($row = $result->fetch_assoc()) {
            $program = new Program();
            $program->setName($row['program_name'])
                ->setType($row['program_type'])
                ->setInstitution($row['institution_name'])
                ->setInternalOrExternal($row['internal_or_external'])
                ->setLocation($row['location'])
                ->setNumberOfHours($row['number_of_hours'])
                ->setNumberOfDays($row['number_of_days'])
                ->setEnd($row['end'])
                ->setStart($row['start'])
                ->id = $row['id'];

            $trainer = Trainer::get($row['trainer'], $db);
            $program->setTrainer($trainer);
            $programs[] = $program;
        }
        return $programs;
    }
}
