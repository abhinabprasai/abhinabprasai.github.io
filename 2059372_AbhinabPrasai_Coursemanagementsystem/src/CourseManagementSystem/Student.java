package CourseManagementSystem;

import Utilities.DataBaseUtils;

import javax.swing.*;
import java.awt.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.Set;

public class Student extends JFrame {
    private JFrame Student;
    private JPanel StudentLayout; JComboBox<String> ViewCourses;
    private JLabel Tag;
    private JTextArea AvailableModules; String selectedCourse;
    private JButton Enroll;

    public Student(){
        Student = new JFrame();
        setTitle("Student");
        setVisible(true);
        setSize(500,400);
        setLocationRelativeTo(null);
        setLayout(new GridLayout(1,1,4,40));
        setDefaultCloseOperation(DISPOSE_ON_CLOSE);
        StudentLayout();
        add(StudentLayout);
        setResizable(false);
    }

    private JPanel StudentLayout(){
        StudentLayout = new JPanel();

        JPanel ID = new JPanel();
        ID.setLayout(new GridLayout(2,2));
        JLabel StudentID = new JLabel("Your ID:");
        JTextField _StudentID = new JTextField(10);
        ID.add(StudentID);
        ID.add(_StudentID);
        JLabel StudentName = new JLabel("Your Name");
        JTextField _StudentName = new JTextField();
        ID.add(StudentName);
        ID.add(_StudentName);

        StudentLayout.add(ID);

        JLabel View = new JLabel("Select a course to view modules:");
        StudentLayout.add(View);
        JPanel ContainDropDown = new JPanel();
        ContainDropDown.setLayout((new GridLayout(2,1)));
        ViewCourses = new JComboBox<>();
        ViewCourses.addItem(null);
        ContainDropDown.add(ViewCourses);
        StudentLayout.add(ContainDropDown);

        String sql = "SELECT DISTINCT COURSE FROM MODULES";

        try{
            PreparedStatement view = DataBaseUtils.conn.prepareStatement(sql);
            ResultSet rsl = view.executeQuery();
            while(rsl.next()){
                ViewCourses.addItem(rsl.getString("Course"));
            }
            view.executeQuery();
            view.close();
        }catch (SQLException ex){
            ex.printStackTrace();
        }

        ViewCourses.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                selectedCourse = ViewCourses.getSelectedItem().toString();
                getModules(selectedCourse);
            }
        });

        JPanel DisplayPanel = new JPanel();
        DisplayPanel.setLayout(new GridLayout(2,1));
        DisplayPanel.setBorder(BorderFactory.createTitledBorder(""));
        Tag = new JLabel("The modules currently present on the selected course are:",SwingConstants.CENTER);
        AvailableModules = new JTextArea(5,20);
        DisplayPanel.add(Tag);
        DisplayPanel.add(AvailableModules);
        StudentLayout.add(DisplayPanel);

        Enroll = new JButton("GET ENROLLED");
        Enroll.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                new ModuleRegistration().Register(_StudentID.getText().toString(),_StudentName.getText().toString(),selectedCourse);
            }
        });



        JButton ViewInstructors = new JButton("View Instructors");
        ViewInstructors.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                    ViewInstructors(_StudentID.getText().toString());
            }
        });

        JPanel EnrollmentPanel = new JPanel();
        EnrollmentPanel.setLayout(new GridLayout(2,1));
        JLabel Message = new JLabel("Enroll:");
        EnrollmentPanel.add(Message);
        JPanel BPanel1 = new JPanel();
        BPanel1.add(Enroll);
        EnrollmentPanel.add(BPanel1);
        JLabel Message2 = new JLabel("If Already Enrolled View Instructors:");
        EnrollmentPanel.add(Message2);
        JPanel BPanel2 = new JPanel();
        BPanel2.add(ViewInstructors);
        EnrollmentPanel.add(BPanel2);
        StudentLayout.add(EnrollmentPanel);

        return StudentLayout;
    }
    private String getModules(String selectedCourse){

        String sql = "SELECT NAME FROM MODULES WHERE COURSE = ?";
        String ModuleRes ="";

        try{
            PreparedStatement viewModule = DataBaseUtils.conn.prepareStatement(sql);
            viewModule.setString(1,selectedCourse);
            ResultSet rsl = viewModule.executeQuery();

            while (rsl.next()){
                ModuleRes += rsl.getString("name") + "\n";
                System.out.println(ModuleRes);
            }
            AvailableModules.setText(ModuleRes);
            viewModule.close();

        } catch (SQLException throwables) {
            throwables.printStackTrace();
        }
        return ModuleRes;
    }

    private void ViewInstructors(String ID){
        JFrame ViewInstructors = new JFrame();
        ViewInstructors.setSize(400,400);
        ViewInstructors.setVisible(true);
        ViewInstructors.setLocationRelativeTo(null);
        ViewInstructors.setLayout(new GridLayout());

        JPanel Contain = new JPanel();
        JLabel askId = new JLabel("Enter your ID");
        JTextField inputID = new JTextField(10);
        JButton show = new JButton("show");



        JPanel Output1 = new JPanel();
        JLabel Tag = new JLabel("You have been enrolled to:");
        JTextArea Res = new JTextArea(10,10);
        Output1.add(Tag);
        Output1.add(Res);
        Contain.add(askId);
        Contain.add(inputID);
        Contain.add(show);

        Contain.add(Output1);
        show.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                String sql = "SELECT * FROM STUDENT_MODULE WHERE STU_ID = ?";
                ArrayList<String> modules = new ArrayList<>();

                try {
                    Res.setText(" ");
                    modules.clear();
                    PreparedStatement viewModules = DataBaseUtils.conn.prepareStatement(sql);
                    viewModules.setString(1,inputID.getText().toString());
                    ResultSet rsl = viewModules.executeQuery();
                    while (rsl.next()){
                        modules.add(rsl.getString("MOD_ID"));
                        modules.add("\n");
                    }
                    Res.setText(modules.toString());
                } catch (SQLException Throwables) {
                    Throwables.printStackTrace();
                }

            }
        });

        JPanel section2 = new JPanel();
        section2.setLayout(new GridLayout(4,2));
        section2.setBorder(BorderFactory.createTitledBorder("Enter Module Code Only:"));
        JLabel guide = new JLabel("Enter Module Code");
        JTextField mcode = new JTextField(10);
        JLabel InstructorId = new JLabel("Instructor ID:");
        JTextField _InstructorId = new JTextField(10);
        JLabel InstructorName = new JLabel("Instructor Name");
        JTextField _InstructorName = new JTextField(10);

        section2.add(guide);
        section2.add(mcode);
        section2.add(InstructorId);
        section2.add(_InstructorId);
        section2.add(InstructorName);
        section2.add(_InstructorName);
        JButton show2 = new JButton("Fetch Details");
        section2.add(show2);
        show2.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                _InstructorId.setText("");
                _InstructorName.setText("");
                String sqlV = "SELECT * FROM INSTRUCTOR_MODULE WHERE MOD_ID = ?";

                try {
                    PreparedStatement InsId = DataBaseUtils.conn.prepareStatement(sqlV);
                    InsId.setString(1,mcode.getText().toString());
                    ResultSet rsl1 = InsId.executeQuery();
                    while (rsl1.next()){
                        _InstructorId.setText(rsl1.getString("INS_ID"));
                    }
                    rsl1.close();

                } catch (SQLException throwables) {
                    throwables.printStackTrace();
                }
                String pID = _InstructorId.getText().toString();
                String sqlVI = "SELECT * FROM INSTRUCTOR WHERE ID = ?";

                try {
                    PreparedStatement InsName = DataBaseUtils.conn.prepareStatement(sqlVI);
                    InsName.setString(1,pID);
                    ResultSet rsl2 = InsName.executeQuery();
                    while (rsl2.next()){
                        _InstructorName.setText(rsl2.getString("NAME"));
                    }
                    rsl2.close();
                } catch (SQLException throwables) {
                    throwables.printStackTrace();
                }
            }
        });

        Contain.add(section2);
        ViewInstructors.add(Contain);
    }
}
