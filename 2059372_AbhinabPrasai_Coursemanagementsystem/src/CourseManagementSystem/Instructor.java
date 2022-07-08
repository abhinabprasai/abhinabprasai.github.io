package CourseManagementSystem;

import Utilities.DataBaseUtils;

import javax.swing.*;
import javax.swing.table.DefaultTableModel;
import javax.swing.text.View;
import java.awt.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.MouseEvent;
import java.awt.event.MouseListener;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;

public class Instructor extends JFrame {
    private JFrame InstructorFrame = new JFrame();
    private JPanel InstructorPanelContainer;
    private JTextField _EID ,_EName ,_phone;
    JComboBox<String> Modules = new JComboBox<>();


    public Instructor() throws SQLException {

        JFrame Instructor = new JFrame("Instructor");
        setTitle("Instructor");
        setVisible(true);
        setSize(400,400);
        setLocationRelativeTo(null);
        InstructorLayout();
        setDefaultCloseOperation(DISPOSE_ON_CLOSE);
        add(InstructorPanelContainer);
    }

    private void Search(String ID) throws SQLException {
         String sql = "SELECT * FROM INSTRUCTOR WHERE ID = ?";
         String[]assignedModules = new String[]{};
         try{
             if (DataBaseUtils.conn == null){
                 System.out.println("Connection is null");
             }
             PreparedStatement search =DataBaseUtils.conn.prepareStatement(sql);
             search.setString(1,ID);
             ResultSet rsl = search.executeQuery();
             if(rsl.next()==false){
                 JOptionPane.showMessageDialog(new Frame(),"Unmatching ID");
                 _EID.setText("");
                 _EName.setText("");
                 _phone.setText("");
             }else{
                 _EID.setText(rsl.getString("id"));
                 _EName.setText(rsl.getString("name"));
                 _phone.setText(rsl.getString("phone"));
             }
             search.executeQuery();
             search.close();
         }catch (SQLException ex){
             ex.printStackTrace();
         }
        String sqlII = "SELECT * FROM INSTRUCTOR_MODULE WHERE INS_ID = ?";
        try {
                PreparedStatement viewMod = DataBaseUtils.conn.prepareStatement(sqlII);
                viewMod.setString(1,ID);
                ResultSet rsl = viewMod.executeQuery();
                while (rsl.next()){
                    Modules.addItem(rsl.getString("MOD_ID"));
                }
         }catch (SQLException e){
            e.printStackTrace();
        }
    }

    private JPanel InstructorLayout(){
        InstructorPanelContainer = new JPanel();JPanel ActionPanel = new JPanel();
        JPanel OutputPanel = new JPanel();
        OutputPanel.setLayout(new GridLayout(3,2));
        InstructorPanelContainer.setLayout(new GridLayout(3,1,10,10));
        JPanel InputPanel = new JPanel();

        JLabel EID = new JLabel("Enter ID",SwingConstants.CENTER);
        _EID = new JTextField(10);
        InputPanel.setLayout(new GridLayout(3,2,10,10));
        InputPanel.add(EID);
        InputPanel.add(_EID);

        JButton ViewModules = new JButton("Search Details");

        ViewModules.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                String inputID = _EID.getText().toString();
                try {
                    Modules.removeAllItems();
                    Search(inputID);
                } catch (SQLException throwables) {
                    throwables.printStackTrace();
                }
            }
        });
        InputPanel.add(ViewModules);
        InstructorPanelContainer.add(InputPanel);

        ActionPanel.setLayout(new GridLayout(4,1));
        JLabel EName = new JLabel("Name :");
        _EName = new JTextField(10);
        OutputPanel.add(EName);
        OutputPanel.add(_EName);

        JLabel phone = new JLabel("Phone :");
        _phone = new JTextField(10);
        OutputPanel.add(phone);
        OutputPanel.add(_phone);

        JLabel module = new JLabel("Module(s) Assigned: ");
        OutputPanel.add(module);
        OutputPanel.add(Modules);

        JLabel More = new JLabel("More Actions");
        ActionPanel.add(More);
       JButton ViewStudents = new JButton("View Students of that Module");
       ViewStudents.addActionListener(new ActionListener() {
           @Override
           public void actionPerformed(ActionEvent e) {
                    StudentsOfTheModule(Modules.getSelectedItem().toString());
           }
       });
       ActionPanel.add(ViewStudents);

       JButton AddMarks = new JButton("Add Marks to Students of this Module");
       AddMarks.addActionListener(new ActionListener() {
           @Override
           public void actionPerformed(ActionEvent e) {
                    AssignMarks(Modules.getSelectedItem().toString());
           }
       });
       ActionPanel.add(AddMarks);

        InstructorPanelContainer.add(OutputPanel);
       InstructorPanelContainer.add(ActionPanel);


       return InstructorPanelContainer;
    }


    private void StudentsOfTheModule(String MOD_ID){  //views all the enrolled students of the module in the JText Area
                    JFrame Students = new JFrame();
                    Students.setSize(400,400);
                    Students.setVisible(true);
                    Students.setResizable(false);
                    Students.setLayout(new GridLayout());
                    Students.setLocationRelativeTo(null);

                    JPanel StudentBoard =  new JPanel();
                    StudentBoard.setBorder(BorderFactory.createTitledBorder("All the Students Enrolled in the selected modules :"));
                    JTextArea View = new JTextArea(10,20);

                    View.setText("");
                    String sql1 = "SELECT * FROM STUDENT_MODULE WHERE MOD_ID = ?";
                    String sql2 = "SELECT * FROM STUDENT WHERE ID = ?";
                    ArrayList<String> EnrolledStudnetsId = new ArrayList<>();
                    try {
                        PreparedStatement displayModule = DataBaseUtils.conn.prepareStatement(sql1);
                        displayModule.setString(1,MOD_ID);
                        ResultSet rsl = displayModule.executeQuery();
                        while (rsl.next()){
                            EnrolledStudnetsId.add(rsl.getString("STU_ID"));
                        }

                        //Displaying names based on ID
                        ArrayList<String> EnrolledNames = new ArrayList<>();
                        int times = EnrolledStudnetsId.size();
                        for (int i = 0 ; i <times; i++){
                            PreparedStatement viewNames = DataBaseUtils.conn.prepareStatement(sql2);
                            viewNames.setString(1,EnrolledStudnetsId.get(i));
                            ResultSet rsl2 = viewNames.executeQuery();
                            while (rsl2.next()){
                                EnrolledNames.add(rsl2.getString("NAME"));
                                EnrolledNames.add("\n");
                            }
                        }

                        View.setText(EnrolledNames.toString());
                        System.out.println(EnrolledStudnetsId);
                    } catch (SQLException Throwables) {
                        Throwables.printStackTrace();
                    }


        StudentBoard.add(View);
        Students.add(StudentBoard);


    }

    private void UpdateMarks(int Marks,String ID ){

            String sql = "UPDATE STUDENT_MARKS SET MARKS = ? WHERE STU_ID = ? ";

        try {
            PreparedStatement update = DataBaseUtils.conn.prepareStatement(sql);
            update.setInt(1,Marks);
            update.setString(2,ID);
            update.executeUpdate();
            JOptionPane.showMessageDialog(new Frame(),"Marks has beeen added /Updated");
            update.close();
        } catch (SQLException throwables) {
            throwables.printStackTrace();
        }

    }

    private void AssignMarks(String MOD_ID){  //addmarks to the students


            String ID = "";

            int giveMarks = 0;
            JFrame MarksBoard = new JFrame();
            MarksBoard.setSize(600,400);
            MarksBoard.setVisible(true);
            MarksBoard.setResizable(false);
        //    MarksBoard.setLayout(new GridLayout(1,2,20,20));
            MarksBoard.setLocationRelativeTo(null);


            JPanel Container = new JPanel();
           Container.setLayout(new GridLayout(2,2));
            JPanel InputPanel = new JPanel();
            InputPanel.setLayout(new GridLayout(4,2));

            JLabel ModuleCode = new JLabel("Module Code");
            JTextField _ModuleCode = new JTextField(10);
            _ModuleCode.setText(MOD_ID);

            JLabel StudentId = new JLabel("Student ID");
            JTextField _StudentId = new JTextField(10);

            JLabel Marks = new JLabel("Add Marks");
            JTextField _Marks = new JTextField(10);

            JButton Update= new JButton("Update/Add");
            Update.addActionListener(new ActionListener() {
                @Override
                public void actionPerformed(ActionEvent e) {
                            String m = _Marks.getText().toString();
                            UpdateMarks(Integer.parseInt(m),_StudentId.getText().toString());
                }
            });


            InputPanel.add(ModuleCode);
            InputPanel.add(_ModuleCode);
            InputPanel.add(StudentId);
            InputPanel.add(_StudentId);
            InputPanel.add(Marks);
            InputPanel.add(_Marks);
            InputPanel.add(Update);



            Container.add(InputPanel);

            JPanel TablePanel = new JPanel();
            TablePanel.setLayout(new GridLayout(2,1));
            TablePanel.setBorder(BorderFactory.createTitledBorder("STUDENT MARKS"));
            JTable T= new JTable();

            DefaultTableModel model = new DefaultTableModel();
            model.setColumnIdentifiers(new String[] {"Student ID","Marks"});
            T =new JTable(model);
            TablePanel.add(new JScrollPane(T));
            Container.add(TablePanel);
        try {
            PreparedStatement addInTable = DataBaseUtils.conn.prepareStatement("SELECT * FROM STUDENT_MARKS WHERE MOD_ID = ?");
            addInTable.setString(1,_ModuleCode.getText().toString());
            ResultSet rs = addInTable.executeQuery();
            int i = 0;
            while(rs.next()){
                ID = rs.getString("STU_ID");
                giveMarks = rs.getInt("Marks");
                model.addRow(new Object[]{ID,giveMarks});
            }
        } catch (SQLException throwables) {
            throwables.printStackTrace();
        }
        JTable finalT = T;
        T.addMouseListener(new MouseListener() {
                @Override
                public void mouseClicked(MouseEvent e) {
                        int selectedRow = finalT.getSelectedRow();
                        _StudentId.setText(finalT.getValueAt(selectedRow,0).toString());
                        _Marks.setText(finalT.getValueAt(selectedRow,1).toString());

                }

                @Override
                public void mousePressed(MouseEvent e) {

                }

                @Override
                public void mouseReleased(MouseEvent e) {

                }

                @Override
                public void mouseEntered(MouseEvent e) {

                }

                @Override
                public void mouseExited(MouseEvent e) {

                }
            });

        JPanel Info1 = new JPanel();
        Info1.setBorder(BorderFactory.createTitledBorder("Note:"));
        JLabel Message = new JLabel("Incase of Empty DataTable , Students are yet to get registered for the exams.");
        Info1.add(Message);
        TablePanel.add(Info1);
        Container.add(TablePanel);

        MarksBoard.add(Container);
    }

}


