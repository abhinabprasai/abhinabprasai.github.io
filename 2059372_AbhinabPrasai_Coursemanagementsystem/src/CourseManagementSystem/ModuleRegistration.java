package CourseManagementSystem;

import Utilities.DataBaseUtils;

import javax.swing.*;
import javax.swing.text.View;
import java.awt.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.SQLIntegrityConstraintViolationException;
import java.util.ArrayList;

interface Register{
    void Register(String ID , String Name , String Course);
}

public class ModuleRegistration implements Register{  //class to students to get enrolled in the modules available in the course.

     @Override
     public void Register(String ID, String Name, String Course) {
        String sql = "INSERT INTO STUDENT VALUES(?,?,?)";
        try{
            PreparedStatement add = DataBaseUtils.conn.prepareStatement(sql);
            add.setString(1,ID);
            add.setString(2,Name);
            add.setString(3,Course);
            add.executeUpdate();
            add.close();
           // JOptionPane.showMessageDialog(new Frame(),"You have been enrolled to the course");
        } catch (SQLException Throwables) {
            Throwables.printStackTrace();
            System.out.println("Couldn't Enroll");
        }
        RegisterModule(ID,Course);
     }

     public void RegisterModule(String ID ,String COURSE){

         String sql1= "SELECT * FROM MODULES WHERE COURSE = ?";
         ArrayList<String> Mod_IDs = new ArrayList<>();
         try{
             PreparedStatement getModules = DataBaseUtils.conn.prepareStatement(sql1);
             getModules.setString(1,COURSE);
             ResultSet rsl = getModules.executeQuery();

             while (rsl.next()){
                 Mod_IDs.add(rsl.getString("id"));
             }
             System.out.println(Mod_IDs);
         } catch (SQLException Throwables) {
             Throwables.printStackTrace();
         }

         int count = Mod_IDs.size();
         String sql2 = "INSERT INTO STUDENT_MODULE VALUES (?,?)"; int flag = 0;
         for (int i =0 ; i <count; i++){
             try {
                 PreparedStatement addModule = DataBaseUtils.conn.prepareStatement(sql2);
                 addModule.setString(1,ID);
                 addModule.setString(2,Mod_IDs.get(i));
                 addModule.executeUpdate();
                 flag = 1;
                 addModule.close();
             } catch (SQLException Throwables ) {
                 Throwables.printStackTrace();
             }catch (NullPointerException e){
                 e.printStackTrace();
                 flag = 0;
                 JOptionPane.showMessageDialog(new Frame(),"Input Values in the Missing Field.");
             }
         }
         if(flag == 1){
             JOptionPane.showMessageDialog(new Frame(),"You have been successfully enrolled to " +count+"modules of the course");
         }

     }
 }