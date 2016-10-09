package game1;

import game2.*;
import javax.swing.JFrame;


public class Main extends JFrame
{
    public static void main(String args[])
    {
        JFrame jfrm= new JFrame("BALLOON GAMES");
        jfrm.setSize(840,640);
        jfrm.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        jfrm.setResizable(false);
        //getContentPane().setBackground(Color.BLUE);
        //JLabel jlab=new JLabel(new imageIcon("C:\\Users\\PIAL\\Downloads\\a.jpj"));
        //JLabel background=new JLabel(new ImageIcon("C:\\Users\\PIAL\\Desktop\\i.jpg"));
        Balloon pial=new Balloon();
        jfrm.add(pial);
        jfrm.setVisible(true);
        Music iqra=new Music();
        iqra.music();
        //music();
    }
}
