
<?php


class User
{
    public $name;
    public $email;
    public $password;
    public $role;
    public $id;
    public $employee;
    public $trainer;



    public function __construct()
    {
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }


    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    public function setEmployee($employee)
    {
        $this->employee = $employee;
        return $this;
    }

    public function setTrainer($trainer)
    {
        $this->trainer = $trainer;
        return $this;
    }



    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }


    public function setRole($role)
    {
        $this->role = $role;
        return $this;
    }


    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }


    public function changePassword($password, MySQLConnector $db)
    {
        $this->password = md5($password);

        $db->query("UPDATE user SET password = '$this->password' WHERE id = $this->id");


        return $this;
    }


    public function getRole()
    {
        switch ($this->role) {
            case '1':
                return 'RH_SPECIAL';
                break;
            case '2':
                return 'RH';
                break;
            case '3':
                return 'Trainer';
                break;
            default:
                return 'Employee';
                break;
        }
    }


    function update(MySQLConnector $db)
    {

        $employee = isset($this->employee) ? $this->employee : "NULL";
        $trainer = isset($this->trainer) ? $this->trainer : "NULL";

        $db->query("UPDATE users SET name = '$this->name', email = '$this->email', password = '$this->password', role = '$this->role', employee = $employee, trainer = $trainer WHERE id = $this->id");
    }



    static function get($id, MySQLConnector $db)
    {
        $req = $db->query("SELECT * FROM users WHERE id = $id");
        $item = $req->fetch_assoc();

        $user = new User();
        $user->setName($item['name'])
            ->setEmail($item['email'])
            ->setPassword($item['password'])
            ->setRole($item['role'])
            ->setId($item['id'])
            ->setEmployee($item['employee'])
            ->setTrainer($item['trainer']);

        return $user;
    }




    static function login($email, $password, MySQLConnector $db)
    {
        $md5Password = md5($password);
        $req = $db->query("SELECT * FROM users WHERE email = '$email' AND password = '$md5Password'");

        if ($req->num_rows == 0) {
            return false;
        }
        $item = $req->fetch_assoc();

        $user = new User();
        $user->setName($item['name'])
            ->setEmail($item['email'])
            ->setPassword($item['password'])
            ->setRole($item['role'])
            ->setId($item['id']);

        return $user;
    }




    static public function generateUser($userName, $role, MySQLConnector $db)
    {

        // insert the user and return User


        $user = new User();
        $user->setName($userName)
            ->setEmail($userName)
            ->setPassword(md5($userName))
            ->setRole($role);

        $db->query("INSERT INTO users (name, email, password, role) VALUES ('$user->name', '$user->email', '$user->password', '$user->role')");

        $user->setId($db->getLastInsertedId());

        return $user;
    }


    static function generateEmployee($userName, $employeeId, MySQLConnector $db)
    {

        $user = User::generateUser($userName, 5, $db);

        $user->setEmployee($employeeId);

        $user->update($db);


        return $user;
    }

    static function generateTrainer($userName, $trainerId, MySQLConnector $db)
    {

        $user = User::generateUser($userName, 3, $db);

        $user->setTrainer($trainerId);

        $user->update($db);

        return $user;
    }
}
