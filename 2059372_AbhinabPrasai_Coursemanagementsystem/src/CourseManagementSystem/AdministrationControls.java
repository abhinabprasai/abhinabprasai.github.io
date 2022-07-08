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

interface AdminControl{
    void IntroduceCourse();
    void IntroduceModule(String ID , String Name , String Course);
}

class AdministrationControls implements AdminControl{

    @Override
    public void IntroduceCourse() {

    }
    @Override
    public void IntroduceModule(String ID, String Name, String Course) {
        String sql = "INSERT INTO MODULES VALUES(? , ? , ?)";

        try {
            PreparedStatement addModule = DataBaseUtils.conn.prepareStatement(sql);
            addModule.setString(1,ID);
            addModule.setString(2,Name);
            addModule.setString(3,Course);
            addModule.executeUpdate();
            addModule.close();
            JOptionPane.showMessageDialog(new Frame(),"Module  has been Sucessfully Added");
        } catch (SQLException throwables) {
            throwables.printStackTrace();
        }

    }
}

class GenerateResult extends JFrame{

            private JFrame DisplayReportCard = new JFrame();
            private JPanel InputPanel , ResultContainer;
            private JTextField _SId ,_SName ,_Course;
            private ArrayList<Integer> scores;
            private JTextArea ResultSlipL;
            public GenerateResult(){
                  setVisible(true);
                  setSize(500,400);
                  setTitle("Get Result");
                  setLocationRelativeTo(null);
                  setResizable(false);
                  Layout();
                  add(InputPanel);
            }

            private void fetch(String Id){

                String sql = "SELECT * FROM STUDENT WHERE ID = ?";
                try {
                    PreparedStatement getValues = DataBaseUtils.conn.prepareStatement(sql);
                    getValues.setString(1,Id);
                    ResultSet rsl = getValues.executeQuery();
                    boolean flag = false;
                    while (rsl.next()){
                        System.out.println(rsl.getString("NAME"));
                        _SName.setText(rsl.getString("NAME"));
                        _Course.setText(rsl.getString("COURSE"));
                        flag = true;
                    }
                    getValues.close();
                    if(!flag){
                        JOptionPane.showMessageDialog(new Frame(),"No related data was found.","ERROR",JOptionPane.ERROR_MESSAGE);
                    }
                } catch (SQLException throwables) {
                    throwables.printStackTrace();
                }


            }


            private JPanel Layout(){

                InputPanel = new JPanel();
                JPanel InputPanelJr = new JPanel();
                InputPanelJr.setBorder(BorderFactory.createTitledBorder("Input ID:"));
                InputPanelJr.setLayout(new GridLayout(4,2));
                JLabel SId = new JLabel("Student ID");
                _SId = new JTextField(10);
                JLabel SName = new JLabel("Student Name");
                _SName = new JTextField(20);
                JLabel Course = new JLabel("Course Enrolled in:");
                _Course = new JTextField(10);


                JPanel BPanel = new JPanel();
                JButton _BPanel = new JButton("Get Info");
                _BPanel.addActionListener(new ActionListener() {
                    @Override
                    public void actionPerformed(ActionEvent e) {
                        System.out.println(_SId.getText().toString());
                            fetch(_SId.getText().toString());

                    }
                });
                BPanel.add(_BPanel);

                InputPanelJr.add(SId);
                InputPanelJr.add(_SId);
                InputPanelJr.add(SName);
                InputPanelJr.add(_SName);
                InputPanelJr.add(Course);
                InputPanelJr.add(_Course);
                InputPanelJr.add(BPanel);

                JPanel InputPanelSr = new JPanel();
                InputPanelSr.setLayout(new GridLayout());
                JButton Generate = new JButton("Generate Result for this Student");
                InputPanelSr.add(Generate);
                Generate.addActionListener(new ActionListener() {
                    @Override
                    public void actionPerformed(ActionEvent e) {
                            ResultSlip();
                    }
                });

                InputPanel.add(InputPanelJr);
                InputPanel.add(InputPanelSr);
                return InputPanel;
            }


    public void ResultSlip(){

        JFrame Result = new JFrame();
        setTitle("Result Slip");
        Result.setSize(600,300);
        Result.setLocationRelativeTo(null);
        Result.setResizable(false);
        ResultSlipLayout();
        Result.add(ResultContainer);
        CalculateScore(_SId.getText().toString());
        Result.setVisible(true);

    }

    private JPanel ResultSlipLayout(){

        ResultContainer = new JPanel();
       ResultContainer.setLayout(new GridLayout(3,1));
        JPanel tag = new JPanel();
        JLabel res = new JLabel("Result : \n");
        tag.add(res);
        JPanel Output = new JPanel();
        ResultSlipL = new JTextArea(50,45);
        Output.add(ResultSlipL);

        ResultContainer.add(tag);
        ResultContainer.add(Output);
        JPanel Notepad  = new JPanel();
        Notepad.setBorder(BorderFactory.createTitledBorder("Please Note that:"));
        JLabel Note = new JLabel("In case of an empty result slip , the student has not been marked.");
        Notepad.add(Note);
        ResultContainer.add(Notepad);
        return ResultContainer;
    }

    private void CalculateScore(String Id){

        String sql = "SELECT * FROM STUDENT_MARKS WHERE STU_ID = ?";
        scores = new ArrayList();
        try {
            System.out.println("ID ="+Id);
            PreparedStatement getScores = DataBaseUtils.conn.prepareStatement(sql);
            getScores.setString(1,Id);  //use of parent class attribute
            ResultSet rsl = getScores.executeQuery();
            while (rsl.next()){
                scores.add(rsl.getInt("MARKS"));

            }
            System.out.println(scores);

        } catch (SQLException throwables) {
            throwables.printStackTrace();
        }
        int n = scores.size();

        float FM = n*100;
        float TM= 0;
        for (int i = 0; i < n;i++){
            TM += scores.get(i);
        }
        float FinalScore = (TM/FM)*100;

        System.out.println(FinalScore);

        if (FinalScore < 40.0){
            ResultSlipL.setText( "Full Score :\t"+ FM + "\n" +
                                "Total Obtained Score :\t"  + TM + "\n" +
                                "Final Score :\t" +FinalScore+ "\n" +
                                "\n\n\n" +
                                "RESULT : FAILED"+ "\n" +
                                "GRADE : *"+ "\n" +
                                "REMARK : Student isn't preceded to the next level."
            );
        }else if (FinalScore >= 40.0 && FinalScore < 60){
            ResultSlipL.setText( "Full Score :\t"+ FM + "\n" +
                    "Total Obtained Score :\t"  + TM + "\n" +
                    "Final Score :\t" +FinalScore+ "\n" +
                    "\n\n\n" +
                    "RESULT : PASSED"+ "\n" +
                    "GRADE : B"+ "\n" +
                    "REMARK : Student is preceded to the next level."
            );

        }else if (FinalScore >= 60 && FinalScore <70){
            ResultSlipL.setText( "Full Score :\t"+ FM + "\n" +
                    "Total Obtained Score :\t"  + TM + "\n" +
                    "Final Score :\t" +FinalScore+ "\n" +
                    "\n\n\n" +
                    "RESULT : PASSED"+ "\n" +
                    "GRADE : A"+ "\n" +
                    "REMARK : Student is preceded to the next level."
            );
        }else if (FinalScore > 70.0 && FinalScore <= 100.00){
            ResultSlipL.setText( "Full Score :\t"+ FM + "\n" +
                    "Total Obtained Score :\t"  + TM + "\n" +
                    "Final Score :\t" +FinalScore+ "\n" +
                    "\n\n\n" +
                    "RESULT : PASSED"+ "\n" +
                    "GRADE : A+"+ "\n" +
                    "REMARK : Student is preceded to the next level."
            );

        }
    }


}


