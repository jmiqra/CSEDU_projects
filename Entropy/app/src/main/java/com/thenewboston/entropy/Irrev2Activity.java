package com.thenewboston.entropy;

import android.graphics.drawable.AnimationDrawable;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.Menu;
import android.view.View;
import android.view.View.OnClickListener;
import android.view.MenuItem;
import android.widget.TextView;
import android.widget.ImageView;
import android.widget.Button;


public class Irrev2Activity extends AppCompatActivity implements OnClickListener{

    Button b3;
    ImageView iw;
    Button b4;
    int a = 0;
    int b = 0;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_irrev2);

        b3 = (Button) findViewById(R.id.irrevnext);
        b3.setOnClickListener(this);
        b4 = (Button) findViewById(R.id.irrevprev);
        b4.setOnClickListener(this);
        iw = (ImageView) findViewById(R.id.iv_irrev);
    }

    @Override
    public void onClick(View v) {
        // TODO Auto-generated method stub
        if (v == b3) {
            if(a==0)
            {
                iw.setImageResource(R.drawable.egg2);
                a=a+1;
            }
            else if (a==1)
            {
                iw.setImageResource(R.drawable.egg3);
                a=a+1;
            }
            else if (a==2)
            {
                iw.setImageResource(R.drawable.egg4);
                a=a+1;
            }
        }
        else if(v==b4){
            if(a==1)
            {
                iw.setImageResource(R.drawable.egg1);
                a=a-1;
            }
            else if (a==2)
            {
                iw.setImageResource(R.drawable.egg2);
                a=a-1;
            }
            else if (a==3)
            {
                iw.setImageResource(R.drawable.egg3);
                a=a-1;
            }
        }
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_irrev2, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up button, so long
        // as you specify a parent activity in AndroidManifest.xml.
        int id = item.getItemId();

        //noinspection SimplifiableIfStatement
        if (id == R.id.action_settings) {
            return true;
        }

        return super.onOptionsItemSelected(item);
    }
}
