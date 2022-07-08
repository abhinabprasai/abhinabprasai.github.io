package CourseManagementSystem;


import Utilities.DataBaseUtils;


import javax.swing.*;
import java.awt.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.io.*;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;

public class Administrator extends JFrame {
    private JPanel AdminContainer;

    public Administrator() {
        JFrame Administrator = new JFrame("Administrator");
        setTitle("Administrator");

        setSize(400, 600);
        setLocationRelativeTo(null);
        ContainerLayout();
        setDefaultCloseOperation(DISPOSE_ON_CLOSE);

        add(AdminContainer);
        setVisible(true);
    }

    private void UpdateModule(String ID , String Name , String Course){

        String  sql = "UPDATE MODULES SET NAME = ? , COURSE = ? WHERE ID = ?";

        try {
            PreparedStatement update = DataBaseUtils.conn.prepareStatement(sql);
            update.setString(1,Name);
            update.setString(2,Course);
            update.setString(3,ID);
            update.executeUpdate();
            JOptionPane.showMessageDialog(new Frame(),"Update Successful.");
            update.close();
        } catch (SQLException Throwables) {
            Throwables.printStackTrace();
        }
    }

    private JPanel ContainerLayout() {

        AdminContainer = new JPanel();
        AdminContainer.setLayout(new GridLayout(5,1));

        JPanel AddModule = new JPanel();
        AddModule.setLayout(new GridLayout(4,1,5,3));
        AddModule.setBorder(BorderFactory.createTitledBorder("Add a Module"));
        JLabel ID = new JLabel("Module Id");
        JTextField _ID= new JTextField(10);
        JLabel Name = new JLabel("Module Name:");
        JTextField _Name = new JTextField(10);
        JLabel Course = new JLabel("Course");
        JComboBox<String> _Course = new JComboBox<>();
        _Course.addItem(null);
        String sql = "SELECT DISTINCT COURSE FROM MODULES";
        try{
            PreparedStatement search =DataBaseUtils.conn.prepareStatement(sql);
            ResultSet rsl = search.executeQuery();
            while(rsl.next()!=false){
                _Course.addItem(rsl.getString("course"));
            }
            search.close();
        }catch (SQLException ex){
            ex.printStackTrace();
        }

        AddModule.add(ID);
        AddModule.add(_ID);
        AddModule.add(Name);
        AddModule.add(_Name);
        AddModule.add(Course);
        AddModule.add(_Course);
        JButton BAddModule = new JButton("Add");
        JButton BEditModule = new JButton("Update");
        BAddModule.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                try {
                    new AdministrationControls().IntroduceModule(_ID.getText().toString(),_Name.getText().toString(),_Course.getSelectedItem().toString());
                    _ID.setText("");
                    _Name.setText("");
                } catch (NullPointerException et){
                    JOptionPane.showMessageDialog(new Frame(),"Enter values to the fields.");
                    et.printStackTrace();
                }

            }
        });

        AddModule.add(BAddModule);

        BEditModule.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {

                UpdateModule(_ID.getText().toString(),_Name.getText().toString(),_Course.getSelectedItem().toString());
                _ID.setText("");
                _Name.setText("");
            }
        });
        AddModule.add(BEditModule);



        AdminContainer.add(AddModule);


        JPanel CancelCourse = new JPanel();
        CancelCourse.setLayout(new GridLayout(3,2));
        CancelCourse.setBorder(BorderFactory.createTitledBorder("Cancel A Course"));
        JLabel CCourseName = new JLabel("Course Name :");
        JTextField _CCourseName = new JTextField(10);
        JLabel CLevels = new JLabel("Number of Levels:");
        JTextField _CLevels = new JTextField(10);
        JButton Cancel = new JButton("Cancel the Course");
        Cancel.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                String file = "src/CourseManagementSystem/Cancelled.txt";
                try {
                    FileWriter fw = new FileWriter(file,true);
                    BufferedWriter bw = new BufferedWriter(fw);
                    bw.write(_CCourseName.getText().toString());
                    bw.write(",");
                    bw.write(_CLevels.getText().toString());
                    bw.write(",");
                    bw.newLine();
                    bw.close();
                    JOptionPane.showMessageDialog(new Frame() ,"Course had been added to the canceled list.");
                    _CCourseName.setText("");
                    _CLevels.setText("");
                } catch (IOException exception){
                    exception.printStackTrace();
                }
            }
        });
        JButton Delete = new JButton("Delete the Course");
        Delete.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                    String file = "src/CourseManagementSystem/Deleted.txt";
                try {
                    FileWriter fw = new FileWriter(file,true);
                    BufferedWriter bw = new BufferedWriter(fw);
                    bw.write(_CCourseName.getText().toString());
                    bw.write(",");
                    bw.write(_CLevels.getText().toString());
                    bw.write(",");
                    bw.newLine();
                    bw.close();
                    JOptionPane.showMessageDialog(new Frame() ,"Course had been added to the deleted list.");
                    _CCourseName.setText("");
                    _CLevels.setText("");
                } catch (IOException exception){
                    exception.printStackTrace();
                }


            }
        });

        CancelCourse.add(CCourseName);
        CancelCourse.add(_CCourseName);
        CancelCourse.add(CLevels);
        CancelCourse.add(_CLevels);
        CancelCourse.add(Cancel);
        CancelCourse.add(Delete);

        AdminContainer.add(CancelCourse);

        JPanel AddCourse = new JPanel();
        AddCourse.setBorder(BorderFactory.createTitledBorder("Add A Course"));
        AddCourse.setLayout(new GridLayout(3,2,5,3));
        JLabel CourseName = new JLabel("Course Name :");
        JTextField _CourseName = new JTextField(10);
        JLabel Levels = new JLabel("Number of Levels:");
        JTextField _Levels = new JTextField(10);
        JButton Add = new JButton("Add");
        Add.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                String file = "src/CourseManagementSystem/Courses.txt";
                try {
                    FileWriter fw = new FileWriter(file,true);
                    BufferedWriter bw = new BufferedWriter(fw);
                    bw.write(_CourseName.getText().toString());
                    bw.write(",");
                    bw.write(_Levels.getText().toString());
                    bw.write(",");
                    bw.newLine();
                    bw.close();
                    JOptionPane.showMessageDialog(new Frame() ,"Course had been Introduced.");
                    _CourseName.setText("");
                    _Levels.setText("");
                } catch (IOException exception){
                    exception.printStackTrace();
                }
            }
        });
        AddCourse.add(CourseName);
        AddCourse.add(_CourseName);
        AddCourse.add(Levels);
        AddCourse.add(_Levels);
        AddCourse.add(Add);

        AdminContainer.add(AddCourse);


        JPanel AssignCourse = new JPanel();
        AssignCourse.setBorder(BorderFactory.createTitledBorder("Assign A Course"));
        JButton Assign = new JButton("Proceed with Assignment");
        Assign.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                new InstructorAssignment();
            }
        });

        AssignCourse.add(Assign);
        AdminContainer.add(AssignCourse);

        JPanel GenerateResult = new JPanel();
        GenerateResult.setBorder(BorderFactory.createTitledBorder("Generate Result of the Students:"));
        JButton Result = new JButton("Get Result");
        GenerateResult.add(Result);
        Result.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                new GenerateResult();
            }
        });

        AdminContainer.add(GenerateResult);


        return  AdminContainer;
    }
}

class InstructorAssignment extends JFrame{

    private JPanel Container = new JPanel();
    private JTextArea Assigned;int count;

    public InstructorAssignment(){
        JFrame AssignmentFrame = new JFrame();
        setSize(600,400);
        setVisible(true);
        setTitle("Assign and Instructor");
        setLayout(new GridLayout());
        setResizable(false);
        setLocationRelativeTo(null);
        Layout();
        add(Container);
    }

    private JPanel Layout(){

        Container.setLayout(new GridLayout(3,2,10,10));
        Container.setBorder(BorderFactory.createTitledBorder("Follow Through: "));

        JLabel Tag = new JLabel("Enter the Instructor ID:");
        JPanel TPanel = new JPanel();
        TPanel.setLayout(new GridLayout(3,1));
        JTextField I_ID = new JTextField(5);
        TPanel.add(Tag);
        TPanel.add(I_ID);

        JButton ViewDetails = new JButton("View Related Details ");
        ViewDetails.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                Assigned.setText("");
                String sql = "SELECT * FROM INSTRUCTOR_MODULE WHERE INS_ID = ?"; int flag = 0;
                ArrayList<String> AssignedModIds = new ArrayList<String>();
                try {

                    PreparedStatement getAssigned = DataBaseUtils.conn.prepareStatement(sql);
                    getAssigned.setString(1,I_ID.getText().toString());
                    ResultSet rsl = getAssigned.executeQuery();

                    while ((rsl.next())){
                        flag = 1;
                        AssignedModIds.add(rsl.getString("MOD_ID"));
                    }
                    if (flag==0){
                        JOptionPane.showMessageDialog(new Frame(),"UNRECORDED ID ENCOUNTER!");
                    }else {
                        String sqlII = "SELECT * FROM MODULES WHERE ID = ?";
                        count = AssignedModIds.size();
                        System.out.println(AssignedModIds);
                        if (count >= 4) {
                            JOptionPane.showMessageDialog(new Frame(),
                                    "THIS INSTRUCTOR HAS ALREADY BEEN ASSIGNED 4 MODULES",
                                    "ERROR",
                                    JOptionPane.ERROR_MESSAGE);
                        } if (count == 0) {
                            Assigned.setText("**Looks like the Instructor \nhasn't yet been assigned \nany module.**\n");
                        }
                            try {
                                String setTextArea = "";
                                for (int i = 0; i < count; i++) {
                                    PreparedStatement viewModuleName = DataBaseUtils.conn.prepareStatement(sqlII);
                                    viewModuleName.setString(1, AssignedModIds.get(i).toString());
                                    ResultSet rs = viewModuleName.executeQuery();
                                    while (rs.next()) {
                                        System.out.println(rs.getString("name"));
                                        setTextArea += rs.getString("name") + ":" + AssignedModIds.get(i) + "\n";
                                    }
                                    System.out.println(setTextArea);

                                    viewModuleName.close();
                                }
                                Assigned.setText(setTextArea);
                            } catch (SQLException throwables) {
                                throwables.printStackTrace();
                            }
                    }

                    getAssigned.close();
                } catch (SQLException throwables) {
                    throwables.printStackTrace();
                }

            }
        });
        JPanel Cover  = new JPanel();
        JLabel Info = new JLabel("Assigned Modules:");
        Assigned = new JTextArea(10,20);

        Cover.add(Info);
        Cover.add(Assigned);

        TPanel.add(ViewDetails);
        Container.add(TPanel);
        Container.add(Cover);


        JPanel CPanel = new JPanel();
        CPanel.setLayout(new GridLayout(2,1));
        JLabel Title = new JLabel("Select a new Module for Assignment:\t");
        JComboBox Assign = new JComboBox();
        //add module ids to the combo box. use table modules

        String sqlIII = "SELECT * FROM MODULES";

        try {
            PreparedStatement comboDisplay = DataBaseUtils.conn.prepareStatement(sqlIII);
            ResultSet rsl = comboDisplay.executeQuery();
            while(rsl.next()){
                Assign.addItem(rsl.getString("ID"));
            }
            comboDisplay.executeQuery();
            comboDisplay.close();
        }catch (SQLException ex){
            ex.printStackTrace();
        }


        CPanel.add(Title);
        CPanel.add(Assign);

        Container.add(CPanel);

        JButton Submit = new JButton("Submit Assignment");
        Submit.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                String sql = "INSERT INTO INSTRUCTOR_MODULE VALUES(?,?)";
                try {
                    System.out.println(count);
                    if (count < 4 ){
                        PreparedStatement submit = DataBaseUtils.conn.prepareStatement(sql);
                        submit.setString(1,I_ID.getText().toString());
                        submit.setString(2,Assign.getSelectedItem().toString());
                        submit.executeUpdate();
                        JOptionPane.showMessageDialog(new Frame() ,"Successfully Assigned.");
                        Assigned.setText("");
                    }else{
                        JOptionPane.showMessageDialog(new Frame(),"Cannot assign select a different instructor");
                    }
                } catch (SQLException Throwables) {
                    Throwables.printStackTrace();
                }

            }
        });
        JPanel BPanel = new JPanel();
        BPanel.add(Submit);
        Container.add(BPanel);

        return  Container;
    }
}



