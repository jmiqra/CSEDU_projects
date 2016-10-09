package game2;

import java.awt.Color;
import java.awt.Graphics;
import java.awt.Image;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.KeyEvent;
import java.awt.event.KeyListener;
import javax.swing.ImageIcon;
import javax.swing.JPanel;
import javax.swing.Timer;


public class Balloon extends Action implements ActionListener, KeyListener
{
    //int n,i,j,a,b=0,c=-1;
    //Action ac=new Action();
    Timer tm=new Timer(10,this);
    //int x=0,y=0,velX=0,velY=0,x1=450,y1=0,x2=-55,y2=-22,velBow=0;//y2 first e -30 chilo
    //int a1=x1,a2=x1+80,a3=x1+160,a4=x1+240,a5=x1+320;
    
    
    public Balloon()
    {
        tm.start();
        addKeyListener(this);
        setFocusable(true);
        setFocusTraversalKeysEnabled(false);
        
    }
    
    public void paintComponent(Graphics g)
    {
        super.paintComponent(g);
        Image image,image2;
        ImageIcon i=new ImageIcon("image/back.jpg");
        image =i.getImage();
        g.drawImage(image, 0 , 0 , null);
        
        if(c<0)
        {
            Image start;
            ImageIcon s=new ImageIcon("image/game.jpg");
            start =s.getImage();
            g.drawImage(start, 0 , 0 , null);

            Image press;
            ImageIcon p=new ImageIcon("image/Startf.gif");
            press =p.getImage();
            g.drawImage(press, 100 , 450 , null);

        }
        
        
        
        else
        {
            if((x2-x)==-55)
                y2=y-22;

            ImageIcon i2=new ImageIcon("image/Bowr.gif");
            image =i2.getImage();
            g.drawImage(image, x2 , y2 , null);

            System.out.println("bow= "+x2+" " +y2);
            

            Image image3;
            ImageIcon i3=new ImageIcon("image/Robin.gif");
            image3 =i3.getImage();
            g.drawImage(image3, 0 , y , null);

            g.setColor(Color.MAGENTA);
            g.fillOval(a1, y1, 40, 60);
            

            g.setColor(Color.GREEN);
            g.fillOval(a2, y1-80, 40, 60);

            g.setColor(Color.RED);
            g.fillOval(a3, y1, 40, 60);

            g.setColor(Color.BLUE);
            g.fillOval(a4, y1-80, 40, 60);

            g.setColor(Color.YELLOW);
            g.fillOval(a5, y1, 40, 60);


            System.out.println(x+ " " + y);

            if(collision1)
            {
                
                a1=-1000;
            }
            if(collision2)
            {
                
                a2=-1000;
            }
            if(collision3)
            {
               
                a3=-1000;
            }
            if(collision4)
            {
                
                a4=-1000;
            }
            if(collision5)
            {
                
                a5=-1000;
            }
            
            if(collision1 && collision2 && collision3 && collision4 && collision5)
            {
                Image win,wtext;
                ImageIcon w=new ImageIcon("image/won.jpg");
                win =w.getImage();
                g.drawImage(win, 0 , 0 , null);
                ImageIcon wt=new ImageIcon("image/abc.PNG");
                wtext =wt.getImage();
                g.drawImage(wtext, 180 , 520 , null);
                
            }
            
            if(c>=6)

            {   Image over,text;
                ImageIcon o=new ImageIcon("image/gameo.png");
                over =o.getImage();
                g.drawImage(over, 0 , 0 , null);
                ImageIcon t=new ImageIcon("image/Text.gif");
                text =t.getImage();
                g.drawImage(text, 180 , 520 , null);
            
            }
        }
            
    }    
    @Override
    public void actionPerformed(ActionEvent e) 
    {
        repaint();
        Collision(); 
            
        if(y<0)
        {
            y=0;
        }
        if(y>532)
        {
            y=532;
        }
        if(y1<-80)
        {
            y1=612;
        }

        x=x+velX;
        y=y+velY;
        y1=y1-1;
        velBow=2;
        if(a==1)
        {
            x2=x2+velBow;
        }   
    }
    
    public void keyPressed(KeyEvent e) 
    {
        n=e.getKeyCode();
        System.out.println("Key pressed");
        //int m=e.getKeyCode();
        if(n==KeyEvent.VK_UP)
            up();
        if(n==KeyEvent.VK_DOWN)
            down();
        if(n==KeyEvent.VK_SPACE)
            space();
       
        if(n==KeyEvent.VK_ENTER)
        {
            enter();
            if(c>=0)
                c++;
           
        }
    }
    
    @Override
    public void keyReleased(KeyEvent e) 
    {
        
        velX=0;
        velY=0;
        velBow=0; 
        if(n==KeyEvent.VK_ENTER)
        {
        if(x2>682)
        {
            x2=-55;
            y2=y-22;
        }
        }
    }

    @Override
    public void keyTyped(KeyEvent e) {
        throw new UnsupportedOperationException("Not supported yet."); //To change body of generated methods, choose Tools | Templates.
    }
}

    
