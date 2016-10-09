package game2;

import java.awt.Rectangle;
import java.awt.event.KeyEvent;
import java.awt.event.KeyListener;
import javax.swing.JPanel;
import javax.swing.Timer;

public class Action extends JPanel
{   
    
    int n,i,j,a,b=0,c=-1;
    //Action ac=new Action();
    //Timer tm=new Timer(10,this);
    int x=0,y=0,velX=0,velY=0,x1=450,y1=0,x2=-55,y2=-22,velBow=0;//y2 first e -30 chilo
    int a1=x1,a2=x1+80,a3=x1+160,a4=x1+240,a5=x1+320;
    boolean collision1=false;
    boolean collision2=false;
    boolean collision3=false;
    boolean collision4=false;
    boolean collision5=false;
    public Action()
    {
        super();
        
        /*addKeyListener(this);
        setFocusable(true);
        setFocusTraversalKeysEnabled(false);*/
        
    }
    public void down()
    {
        velX=0;
        velY=1;
        
    }
    public void up()
    {
        velX=0;
        velY=-1;
    }
    public void right()
    {
        velX=1;
        velY=0;
    }
    public void left()
    {
        velX=-1;
        velY=0;
    }
    
    void space()
    {
        c=0;
    }
    
    void enter()
    {
        if(c<=6)
        a=1;
        else
            a=0;
    }
    
    
    public void Collision()
    {
        Rectangle r1=new Rectangle(a1+20,y1-30,40,60);
        Rectangle r2=new Rectangle(a2+20,y1-120,40,60);
        Rectangle r3=new Rectangle(a3+20,y1-30,40,60);
        Rectangle r4=new Rectangle(a4+20,y1-110,40,60);
        Rectangle r5=new Rectangle(a5+20,y1-30,40,60);

        Rectangle rbow=new Rectangle(x2,y2,90,4);
        
        if(r1.intersects(rbow))
        {
            collision1=true;
            
        }
        if(r2.intersects(rbow))
        {
            collision2=true;
            
        }
        if(r3.intersects(rbow))
        {
            collision3=true;
            
        }
        if(r4.intersects(rbow))
        {
            collision4=true;
            
        }
        if(r5.intersects(rbow))
        {
            collision5=true;
            
        }
    }
    
    
}
