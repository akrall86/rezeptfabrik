<?php
require_once __DIR__ . '/../model/type.php';

/**
 * The TypeManager class contains methods for editing the table type.
 */
class TypeManager
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
     * inserts type into DB
     * @param string $name the name of the type
     */
    function createType(string $name)
    {
        $ps = $this->conn->prepare('INSERT INTO type (name) VALUES (:name)');
        $ps->bindValue('name', $name);
        $ps->execute();
    }

    /**
     * gets one type from DB
     * @param int $id the id of the type
     * @return Type
     */
    function getTypeById($id): Type
    {
        $result = $this->conn->query("SELECT * FROM type WHERE id='$id'");
        if ($row = $result->fetch()) {
            $type = new Type($row['id'], $row['name']);
        }
        return $type;
    }

    /**
     * gets all types from db
     * @return array array of types
     */
    function getTypes(): array
    {
        $result = $this->conn->query('SELECT * FROM type');
        $types = [];
        while ($row = $result->fetch()) {
            $types[] = new Type($row['id'], $row['name']);
        }
        return $types;
    }

    /**
     * gets the id of the type
     * @param string $name the name of the type
     * @return int|bool the id or false if there is no match
     */
    function getTypeId(string $name): int|bool
    {
        $result = $this->conn->query("SELECT id FROM type WHERE name = '$name'");
        if ($row = $result->fetch()) {
            return $row['id'];
        }
        return false;
    }

    /**
     * deletes one type from db
     * @param string $name the name of the type to be deleted
     */
    function deleteType(string $name)
    {
        $ps = $this->conn->query('DELETE FROM type WHERE name = (:name)');
        $ps->bindValue('name', $name);
        $ps->execute();
    }

}