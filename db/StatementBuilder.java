package net.dioptrical.app.db;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.SQLException;

public class StatementBuilder {

    public static PreparedStatement insertStatement(Connection connection, String table) throws SQLException {
        String q = "INSERT INTO " + table + "(itemnumber, item, name, ingredients, price)" +
                "VALUES (?, ?, ?, ?, ?)";
        return connection.prepareStatement(q);
    }

    public static PreparedStatement readStatement(Connection connection, String table, String column) throws SQLException {
        String q = "SELECT * FROM " + table + " WHERE " + column + " = ?";
        return connection.prepareStatement(q);
    }

    public static PreparedStatement readAllStatement(Connection connection, String table) throws SQLException {
        String q = "SELECT * FROM " + table;
        return connection.prepareStatement(q);
    }

    public static PreparedStatement updateStatement(Connection connection, String table, String column, String selectedColumn) throws SQLException {
        String q = "UPDATE " + table + " SET " + selectedColumn + " = ? " +
                 "WHERE " + column + " = ?";
        return connection.prepareStatement(q);
    }

    public static PreparedStatement deleteStatement(Connection connection, String table, String column) throws SQLException {
        String q = "DELETE FROM " + table + " WHERE " + column + " = ?";
        return connection.prepareStatement(q);
    }

    public static PreparedStatement createTableStatement(Connection connection, String scheme) throws SQLException {
        return connection.prepareStatement(scheme);
    }

}