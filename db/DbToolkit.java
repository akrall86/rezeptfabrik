package net.dioptrical.app.db;

import io.github.cdimascio.dotenv.Dotenv;

import java.sql.*;
import java.util.ArrayList;
import java.util.List;

public class DbToolkit {

    public static Connection getConnectionTo(Dotenv dotenv) {
        try {
            Connection connection = DriverManager.getConnection(dotenv.get("DB_URL"), dotenv.get("DB_USER"), dotenv.get("DB_PWD"));
            return connection;
        } catch (SQLException sqle) {
            sqle.printStackTrace();
            return null;
        }
    }

    public static void dumpToStdOut(String table) throws Exception {
        Dotenv dotenv = Dotenv.load();
        String q = "SELECT * FROM " + table;
        List<String> columnnames = getColumnNames(table);
        for (int i = 0; i <= columnnames.size() -1; i++) {
            if (i == 4) {
                System.out.printf("%-65s",columnnames.get(i));
            } else {
                System.out.printf("%-15s", columnnames.get(i));
            }
        }
        System.out.println();
        try (Connection connection = getConnectionTo(dotenv)) {
            ResultSet rs = connection.prepareStatement(q).executeQuery();
            while (rs.next()) {
                int columnCount = getColumnCount(table);
                for (int i = 1; i <= columnCount; i++) {
                    if (i == 5) {
                        System.out.printf("%-65s", rs.getString(i));
                    } else {
                        System.out.printf("%-15s", rs.getString(i));
                    }
                }
                System.out.println();
            }
            System.out.println();
        }
    }

    public static List<String> getColumnNames(String table) throws Exception {
        Dotenv dotenv = Dotenv.load();
        List<String> columnNames = new ArrayList<>();
        String q = "SELECT * FROM " + table + " LIMIT 1";
        try (Connection connection = getConnectionTo(dotenv)) {
            ResultSet rs = connection.prepareStatement(q).executeQuery();
            ResultSetMetaData rsmd = rs.getMetaData();
            for (int i = 1; i <= getColumnCount(table); i++) {
                columnNames.add(rsmd.getColumnName(i));
            }
        }
        return columnNames;
    }

    public static int getColumnCount(String table) throws Exception {
        Dotenv dotenv = Dotenv.load();
        int columnCount = 0;
        String q = "SELECT * FROM " + table;
        try (Connection connection = getConnectionTo(dotenv)) {
            ResultSet rs = connection.prepareStatement(q).executeQuery();
            ResultSetMetaData rsmd = rs.getMetaData();
            columnCount = rsmd.getColumnCount();
            return columnCount;
        }
    }

    public static int getRowCount(String table) throws Exception {
        Dotenv dotenv = Dotenv.load();
        int RowCount = 0;
        String q = "SELECT id FROM " + table;
        try (Connection connection = getConnectionTo(dotenv)) {
            ResultSet rs = connection.prepareStatement(q).executeQuery();
            while (rs.next()) {
                RowCount++;
            }
            return RowCount;
        }
    }
}
