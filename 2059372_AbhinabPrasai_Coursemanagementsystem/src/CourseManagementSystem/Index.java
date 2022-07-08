package CourseManagementSystem;

import Utilities.DataBaseUtils;
import com.sun.tools.javac.Main;

import javax.swing.*;
import java.awt.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.sql.Connection;
import java.sql.SQLException;

public class Index extends JFrame implements ActionListener {
    private JFrame IndexPage;
    private JPanel LoginSection = new JPanel();
    private JButton btnA , btnS , btnI;
    Font f;

    public Index() throws SQLException {

        IndexPage = new JFrame("Course Management System");
        IndexPage.setSize(500, 400);
        IndexPage.setResizable(false);
        IndexPage.setLocationRelativeTo(null);
        IndexPage.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);

        Layout();

        IndexPage.add(LoginSection);
        IndexPage.setVisible(true);
    }

    public JPanel Layout() {
        LoginSection.setLayout(new GridBagLayout());
        GridBagConstraints g = new GridBagConstraints();

        JLabel Header = new JLabel("USE AS:");
        f = new Font("Arial",Font.BOLD,13);
        Header.setFont(f);
        LoginSection.add(Header);
        g.gridx=6;
        g.gridy=7;
        g.weightx= 20;
        g.ipady=20;
        LoginSection.add(Header,g);
        btnA = new JButton("ADMIN");
        btnA.setFont(f);
        btnA.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent e) {
             new Administrator();
            }
        });
        g.gridx=6;
        g.gridy=70;
        g.ipady=20;
        LoginSection.add(btnA,g);

        btnI = new JButton("INSTRUCTOR");
        btnA.setFont(f);
        btnI.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent e) {
                try {
                    new Instructor();
                } catch (SQLException throwables) {
                    throwables.printStackTrace();
                }
            }
        });
        g.gridx=5;
        g.gridy=30;
        g.ipady=20;
        LoginSection.add(btnI,g);
        btnS = new JButton("STUDENT");
        btnS.setFont(f);
        btnS.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent e) {
               new Student();
            }
        });
        g.gridx=7;
        g.gridy=30;
        g.ipady=20;
        LoginSection.add(btnS,g);
        return LoginSection;
    }

    public static void main(String[] args) throws SQLException {
        new DataBaseUtils().getdbConnection();
        new Index();
    }
    @Override
    public void actionPerformed(ActionEvent e) {

    }


}

