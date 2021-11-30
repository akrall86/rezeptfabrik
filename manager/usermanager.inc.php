<?php
require_once __DIR__ . '/../model/user.inc.php';
require_once __DIR__ . '/../model/role.inc.php';

class UserManager
{
    private PDO $conn;

    /**
     * @param PDO $conn
     */
    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    /**
     * Password hash with BCrypt
     * check email in DB if it exists, if not return false
     * check user_name in DB if it exists, if not return false
     * insert user in DB
     * set Role to USER
     * return id
     * @param string $firstname
     * @param string $lastname
     * @param string $user_name
     * @param string $email
     * @param string $password
     * @return string
     */
    function createUser(string $firstname, string $lastname, string $user_name, string $email, string $password): string
    {
        // password hash
        $password = password_hash($password, PASSWORD_BCRYPT);

        // check email of it exist
        if ($this->getUserByEmail($email) == true) {
            return false;
        }
        // check user_name of it exist
        if ($this->getUserByUser_Name($user_name) == true) {
            return false;
        }

        // insert user in the DB
        $ps = $this->conn->prepare('INSERT INTO user 
                                            (firstname, lastname, user_name, email, password) 
                                            VALUES 
                                            (:firstname, :lastname, :user_name, :email, :password)');

        $ps->bindValue('firstname', $firstname);
        $ps->bindValue('lastname', $lastname);
        $ps->bindValue('user_name', $user_name);
        $ps->bindValue('email', $email);
        $ps->bindValue('password', $password);

        $ps->execute();

        // set USER role to user
        $this->setUserRoleToUserById((int)$this->conn->lastInsertId());
        return $this->conn->lastInsertId();
    }

    /**
     * if Login true returns User object and set Session
     * if Login false returns false
     * @param string $email
     * @param string $password
     * @return User|bool
     */
    function login(string $email, string $password): User|bool
    {
        $user = $this->getUserByEmail($email);
        if ($user == false) {
            return false;
        }

        if (!password_verify($password, $user->password)) {
            return false;
        }

        // add to Session from User
        $_SESSION['loggedin'] = true;
        $_SESSION['user_id'] = $user->id;
        $roles = $this->getUserRoles($user->id);
        if (in_array('ADMIN', $roles)) {
            $_SESSION['admin'] = true;
        }


        return $user;
    }

    /**
     * @return bool
     */
    function isLoggedIn(): bool
    {
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true && isset($_SESSION['user_id'])) {
            return true;
        }
        return false;
    }

    function logout() {
        if ($this->isLoggedIn()) {
            $_SESSION['loggedin'] = false;
            $_SESSION['user_id'] = '';
            $_SESSION['admin'] = false;
            session_destroy();
        }
    }

    /**
     * Search in DB with email
     * if email was found returns new User object with data from DB
     * if email not found returns false
     * @param $email
     * @return User|bool
     */
    function getUserByEmail($email): User|bool
    {
        $ps = $this->conn->prepare('SELECT * FROM user WHERE email = :email');
        $ps->bindValue('email', $email);
        $ps->execute();

        if ($row = $ps->fetch()) {
            return new User($row['id'], $row['firstname'], $row['lastname'], $row['user_name'], $row['email'], $row['password']);
        }
        return false;
    }

    /**
     * search in DB with user_name
     * if user_name was found returns new User object with data from DB
     * if user_name not found returns false
     * @param $user_name
     * @return User|bool
     */
    function getUserByUser_Name($user_name): User|bool
    {
        $ps = $this->conn->prepare('SELECT * FROM user WHERE user_name = :user_name');
        $ps->bindValue('user_name', $user_name);
        $ps->execute();

        if ($row = $ps->fetch()) {
            return new User($row['id'], $row['firstname'], $row['lastname'], $row['user_name'], $row['email'], $row['password']);
        }
        return false;
    }

    /**
     * search in DB with id
     * if id was found returns new User object with data from DB
     * if id not found returns false
     * @param int $id
     * @return User|bool
     */
    function getUserById(int $id): User|bool
    {
        $ps = $this->conn->prepare('SELECT * FROM user WHERE id = :id');
        $ps->bindValue('id', $id);
        $ps->execute();

        if ($row = $ps->fetch()) {
            return new User($row['id'], $row['firstname'], $row['lastname'], $row['user_name'], $row['email'], $row['password']);
        }
        return false;
    }

    /**
     * Get all Roles from DB and save it in an Array and returns the Array
     * @return array
     */
    function getRoles(): array
    {
        $result = $this->conn->query('SELECT * FROM role');

        $roles = [];
        while ($row = $result->fetch()) {
            $roles[] = new Role($row['name']);
        }
        return $roles;
    }

    function getUserRoles($user_id): array
    {
        $result = $this->conn->query('SELECT * FROM user_has_role WHERE user_id = $user_id');
        $roles = [];
        while ($row = $result->fetch()) {
            $roles[] = new Role($row['role_id']);
        }
        return $roles;
    }

    /**
     * get all Roles take the USER role and set the Role with user id and User role
     * @param int $id
     * @return false|void
     */
    function setUserRoleToUserById(int $id)
    {
        $roles[] = $this->getRoles();
        if (count($roles) == 0) {
            return false;
        }
        foreach ($roles as $role) {
            if (($role->name) === 'USER') {
                $user = $role;
            }
        }
        $ps = $this->conn->prepare('INSERT INTO user_has_role (user_id, role_id)  VALUES (:user_id, :role_id)');
        $ps->bindValue('user_id', $id);
        $ps->bindValue('role_id', $user->getName());
    }

}