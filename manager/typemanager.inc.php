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
     * insert type into DB
     * @param string $name the name of the type
     */
    function createType(string $name)
    {
        $ps = $this->conn->prepare('INSERT INTO type (name) VALUES (:name)');
        $ps->bindValue('name', $name);
        $ps->execute();
    }

    /**
     * get all types from db
     * @return array of types
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