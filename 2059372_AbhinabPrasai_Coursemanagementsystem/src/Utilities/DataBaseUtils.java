package Utilities;

import java.io.ObjectInputFilter;
import java.sql.*;

class Configurations {
    static String dbHost = "localhost";
    static String dbPort = "3306";
    static String dbUser = "root";
    static String dbPass = "";
    static String dbName = "COURSE_MANAGEMENT_SYSTEM";

}

//import ScriptRunner;

 public class DataBaseUtils {
     public static Statement stmt;
     public static Connection conn;
     int exist = 0;

     public DataBaseUtils() throws SQLException { // if db exists?

         Connection con = null;
         ResultSet rs = null;

         String url = "jdbc:mysql://localhost:3306?useSSL=false";
         String user = "root";
         String password = "";

         try {
             Class.forName("com.mysql.jdbc.Driver");
             con = DriverManager.getConnection(url, user, password);
             if (con != null) {
                 System.out.println("check if a database exists using java");
                 rs = con.getMetaData().getCatalogs();
                 while (rs.next()) {
                     String catalogs = rs.getString(1);
                     if (Configurations.dbName.equals(catalogs)) {
                         System.out.println("the database " + Configurations.dbName + " exists");
                         exist = 1;
                     }
                 }
             } else {
                 System.out.println("unable to create database connection");
             }
         } catch (Exception ex) {
             ex.printStackTrace();
         } finally {
             if (rs != null) {
                 try {
                     rs.close();
                 } catch (SQLException ex) {
                     ex.printStackTrace();
                 }
             }
             if (con != null) {
                 try {
                     con.close();
                 } catch (SQLException ex) {
                     ex.printStackTrace();
                 }
             }
         }
     }

     public static Connection getdbConnection() throws SQLException {

         String connectionString = " ";

         // Registering JDBC driver
         try {
             Class.forName("com.mysql.jdbc.Driver");
         } catch (ClassNotFoundException ce) {
             System.out.println("Something is wrong with mysql driver.");
         }


         if (new DataBaseUtils().exist == 0) {
             try {
                 // Opening a connection
                 System.out.println("Connecting to database...");
                 conn = DriverManager.getConnection("jdbc:mysql://" + Configurations.dbHost + "/", Configurations.dbUser, Configurations.dbPass);
                 System.out.println(Configurations.dbHost + "/" + Configurations.dbUser + Configurations.dbPass);

                 // Executing a query
                 System.out.println("Creating database...");
                 stmt = conn.createStatement();

                 String sql = "CREATE DATABASE COURSE_MANAGEMENT_SYSTEM";
                 // PreparedStatement statement = conn.prepareStatement(sql);
                 // statement.setString(1, Config.dbName);

                 stmt.executeUpdate(sql);
                 System.out.println("Database created successfully...");

                 System.out.println("Creating tables! ");

                 String selectDB = "use COURSE_MANAGEMENT_SYSTEM;";
                 stmt.executeUpdate(selectDB);


                 String table1 = "CREATE TABLE `instructor` (\n" +
                         "  `id` varchar(10) NOT NULL,\n" +
                         "  `name` varchar(40) DEFAULT NULL,\n" +
                         "  `phone` varchar(15) DEFAULT NULL,\n" +
                         "  `module` varchar(50) DEFAULT NULL,\n" +
                         "  PRIMARY KEY (`id`)\n" +
                         ")";
                 stmt.executeUpdate(table1);

                 String table2 = "CREATE TABLE `modules` (\n" +
                         "  `id` varchar(10) NOT NULL,\n" +
                         "  `name` varchar(50) DEFAULT NULL,\n" +
                         "  `course` varchar(50) DEFAULT NULL,\n" +
                         "  PRIMARY KEY (`id`)\n" +
                         ")";
                 stmt.executeUpdate(table2);

                 String table3 = "CREATE TABLE `student` (\n" +
                         "  `id` varchar(10) NOT NULL,\n" +
                         "  `name` varchar(40) DEFAULT NULL,\n" +
                         "  `course` varchar(50) DEFAULT NULL,\n" +
                         "  PRIMARY KEY (`id`)\n" +
                         ")";
                 stmt.executeUpdate(table3);

                 String table4 = "CREATE TABLE `student_marks` (\n" +
                         "  `stu_id` varchar(10) DEFAULT NULL,\n" +
                         "  `mod_id` varchar(10) DEFAULT NULL,\n" +
                         "  `marks` int(11) DEFAULT NULL,\n" +
                         "  KEY `stu_id` (`stu_id`),\n" +
                         "  KEY `mod_id` (`mod_id`),\n" +
                         "  CONSTRAINT `student_marks_ibfk_1` FOREIGN KEY (`stu_id`) REFERENCES `student` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,\n" +
                         "  CONSTRAINT `student_marks_ibfk_2` FOREIGN KEY (`mod_id`) REFERENCES `modules` (`id`) ON UPDATE CASCADE ON DELETE CASCADE\n" +
                         ")";
                 stmt.executeUpdate(table4);

                 String table5 = "CREATE TABLE `student_module` (\n" +
                         "  `stu_id` varchar(10) DEFAULT NULL,\n" +
                         "  `mod_id` varchar(10) DEFAULT NULL,\n" +
                         "  KEY `stu_id` (`stu_id`),\n" +
                         "  KEY `mod_id` (`mod_id`),\n" +
                         "  CONSTRAINT `student_module_ibfk_1` FOREIGN KEY (`stu_id`) REFERENCES `student` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,\n" +
                         "  CONSTRAINT `student_module_ibfk_2` FOREIGN KEY (`mod_id`) REFERENCES `modules` (`id`) ON UPDATE CASCADE ON DELETE CASCADE\n" +
                         ")";
                 stmt.executeUpdate(table5);

                 String table6 = "CREATE TABLE `instructor_module` (\n" +
                         "  `ins_id` varchar(10) DEFAULT NULL,\n" +
                         "  `mod_id` varchar(10) DEFAULT NULL,\n" +
                         "  KEY `ins_id` (`ins_id`),\n" +
                         "  KEY `mod_id` (`mod_id`),\n" +
                         "  CONSTRAINT `instructor_module_ibfk_1` FOREIGN KEY (`ins_id`) REFERENCES `instructor` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,\n" +
                         "  CONSTRAINT `instructor_module_ibfk_2` FOREIGN KEY (`mod_id`) REFERENCES `modules` (`id`) ON UPDATE CASCADE ON DELETE CASCADE\n" +
                         ")";
                 stmt.executeUpdate(table6);


                 String dummydata_instructor = "INSERT INTO `instructor` VALUES ('E1','Raj Shrestha','9840378988','BIT'),('E2','Mahesh KC','9840378228','BBA'),('E3','Arjun Thapa','9860468944','BIT'),('E4','Aakash Surohit','9860477776','BIT'),('E5','Chandani Sigdel','9870898967','BBA');";
                 stmt.executeUpdate(dummydata_instructor);

                 String dummydata_module = "INSERT INTO `modules` VALUES ('CS01','Computer Architecture','BIT'),('CS02','Concepts of AI','BIT'),('BA01','Human Resources','BBA'),('BA02','Accounting & Finance','BBA'),('BA03','Development Science','BBA');";
                 stmt.executeUpdate(dummydata_module);

                 String dummydata_instructor_module = "INSERT INTO `instructor_module` VALUES ('E2','BA01'),('E2','BA02'),('E2','BA03'),('E1','CS01'),('E3','CS02'),('E5','BA02');";
                 stmt.executeUpdate(dummydata_instructor_module);


                 String dummydata_student = "INSERT INTO `student` VALUES ('1','Roshan Parajuli','BIT'),('2','Prakriti Regmi','BIT'),('3','Subiran Khanal','BBA'),('4','Swkriti Dahal','BBA'),('5','Rajesh Oli','BIT'),('6','Aman Oli','BBA');";
                 stmt.executeUpdate(dummydata_student);


                 String dummydata_student_marks = "INSERT INTO `student_marks` VALUES ('1','CS01',90),('1','CS02',90),('2','CS01',87),('2','CS02',99),('3','BA01',65),('4','CS02',89);";
                 stmt.executeUpdate(dummydata_student_marks);

                 String dummydata_student_module = "INSERT INTO `student_module` VALUES ('1','CS01'),('1','CS02'),('2','CS01'),('2','CS02'),('3','BA01'),('3','BA02'),('4','BA01'),('4','BA02'),('5','CS01'),('5','CS02');";
                 stmt.executeUpdate(dummydata_student_module);


             } catch (SQLException se) {
                 // Error Handling for JDBC
                 se.printStackTrace();
             } catch (Exception e) {
                 //  Error Handling for Class.forName
                 e.printStackTrace();
             } finally {
                 //  close resources
                 try {
                     if (stmt != null)
                         stmt.close();
                 } catch (SQLException se2) {
                 }
                 try {
                     if (conn != null)
                         conn.close();
                 } catch (SQLException se) {
                     se.printStackTrace();
                 }
             }
             }

             connectionString = "jdbc:mysql://" + Configurations.dbHost + ":" + Configurations.dbPort + "/" + Configurations.dbName+
                     "?useSSL=false";
            conn = DriverManager.getConnection(connectionString, Configurations.dbUser, Configurations.dbPass);
         return conn;
         }

 }
