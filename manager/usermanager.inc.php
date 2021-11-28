<?php
require_once __DIR__ . '/../model/user.inc.php';

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

    function createUser(string $firstname, string $lastname, string $user_name, string $email, string $password): string
    {
        // password hash
        $password = password_hash($password, PASSWORD_DEFAULT);

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

        return $this->conn->lastInsertId();
    }

    // if Login true returns User object, if false returns false
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


        return $user;
    }

    /**
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

    function getRoles(){
        $ps = $this->conn->query('SELECT * FROM role');

    }


    function setUserRoleToUserById(int $id) {
        $ps = $this->conn->prepare('INSERT INTO user_has_role (user_id, role_id)  VALUES (:user_id, :role_id)');
        $ps->bindValue('user_id', $id);
        $ps->bindValue('role_id', );
    }

}