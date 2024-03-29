<?php
require_once __DIR__ . '/../model/user.php';
require_once __DIR__ . '/../model/role.php';

/**
 * The UserManager class contains methods for editing the table user
 */
class UserManager
{
    private PDO $conn;

    /**
     * @param PDO $conn the connection to the db
     */
    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    /**
     * inset user into DB
     * Password hash with BCrypt
     * check email in DB if it exists, if not return false
     * check user_name in DB if it exists, if not return false
     * set Role to USER
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

        // insert user into DB
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
     * get all Roles take the USER role and set the Role with user id and User role
     * @param int $id
     * @return void
     */
    function setUserRoleToUserById(int $id): void
    {
        $roles = $this->getRoles();
        $user_role = "";

        foreach ($roles as $role) {
            if (($role->name) === 'USER') {
                $user_role = $role->name;
            }
        }
        $ps = $this->conn->prepare('INSERT INTO user_has_role (user_id, role_name)
                                    VALUES (:user_id, :role_name)');
        $ps->bindValue('user_id', $id);
        $ps->bindValue('role_name', $user_role);
        $ps->execute();
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

    /**
     * checks e-mail and password and add user data to Session if they are correct
     * @param string $email
     * @param string $password
     * @return User|bool if Login is true returns User object, false otherwise
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
        // add Userdata to Session

        $_SESSION['loggedin'] = true;
        $_SESSION['user_id'] = $user->id;
        $roles = $this->getUserRoles($user->id);
        foreach ($roles as $role) {
            if ($role->name === 'ADMIN') {
                $_SESSION['admin'] = true;
            }
            if ($role->name === 'USER') {
                $_SESSION['user'] = true;
            }
        }
        return $user;
    }

    /**
     * Search in DB with email
     * if email was found returns new User object with data from DB
     * if email not found returns false
     * @param $email
     * @return User|bool if true return user, If not return false
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
     * @param $user_id
     * @return array
     */
    function getUserRoles($user_id): array
    {
        $ps = $this->conn->prepare('SELECT * FROM user_has_role WHERE user_id = :user_id');
        $ps->bindValue('user_id', $user_id);
        $ps->execute();
        $roles = [];
        while ($row = $ps->fetch()) {
            $roles[] = new Role($row['role_name']);
        }
        return $roles;
    }

    /**
     * control method for $_SESSION['admin']
     * @return bool
     */
    function isAdmin(): bool
    {
        if ($this->isLoggedIn() && isset($_SESSION['admin']) && $_SESSION['admin'] === true) {
            return true;
        }
        return false;
    }

    /**
     * control methods for $_SESSION['loggedin']
     * @return bool
     */
    function isLoggedIn(): bool
    {
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true && isset($_SESSION['user_id'])) {
            return true;
        }
        return false;
    }

    /**
     * methods for logout destroy the Session
     */
    function logout()
    {
        if ($this->isLoggedIn()) {
            $_SESSION['loggedin'] = false;
            $_SESSION['user_id'] = '';
            $_SESSION['user'] = false;
            $_SESSION['admin'] = false;
            session_destroy();
        }
    }

    /**
     * @return array
     */
    function getUsers(): array
    {
        $result = $this->conn->query('SELECT * FROM user');

        $users = [];
        while ($row = $result->fetch()) {
            $users[] = new User($row['id'], $row['firstname'], $row['lastname'],
                $row['user_name'], $row['email'], $row['password']);
        }
        return $users;
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
     * @param int $id
     * @param $name
     */
    function setRoleToUserByIdAndName(int $id, $name)
    {
        $ps = $this->conn->prepare('INSERT INTO user_has_role (user_id, role_name) VALUES (:user_id, :role_name)');
        $ps->bindValue('user_id', $id);
        $ps->bindValue('role_name', $name);
        $ps->execute();
    }

    /**
     * @param User $user
     * @return void
     */
    function updateUser(User $user)
    {
        $passwordhash = password_hash($user->password, PASSWORD_BCRYPT);
        $user->setPassword($passwordhash);
        $this->updateStatement($user);
    }

    /**
     * @param $user
     * @return void
     */
    function updateStatement($user)
    {
        $ps = $this->conn->prepare('UPDATE user
        SET firstname = :firstname, lastname = :lastname, user_name = :user_name, email = :email, password = :password
        WHERE  id = :id');
        $ps->bindValue('firstname', $user->firstname);
        $ps->bindValue('lastname', $user->lastname);
        $ps->bindValue('user_name', $user->user_name);
        $ps->bindValue('email', $user->email);
        $ps->bindValue('password', $user->password);
        $ps->bindValue('id', $user->id);
        $ps->execute();
    }

    /**
     * @param $user
     * @return void
     */
    function updateUserWithOutHash($user)
    {
        $this->updateStatement($user);
    }

    /**
     * @param int $id
     * @return void
     */
    function deleteUserById(int $id)
    {
        $this->deleteUser_has_roleById($id);
        $this->conn->query("DELETE FROM user WHERE id = $id");

    }

    /**
     * @param $id
     * @return void
     */
    function deleteUser_has_roleById($id)
    {
        $this->conn->query("DELETE FROM user_has_role WHERE user_id = $id");
    }
}