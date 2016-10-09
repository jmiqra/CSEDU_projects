package com.thenewboston.entropy;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.TextView;
import android.widget.ImageView;
import android.widget.Button;


public class MainActivity extends AppCompatActivity {

    ImageView iw;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        final Button click = (Button) findViewById(R.id.button);
        click.setOnClickListener(new View.OnClickListener() {
            public void onClick(View v) {
                Intent launchactivity = new Intent(MainActivity.this, DefActivity.class);
                startActivity(launchactivity);
            }
        });

        final Button click1 = (Button) findViewById(R.id.button1);
        click1.setOnClickListener(new View.OnClickListener() {
            public void onClick(View v) {
                Intent launchactivity = new Intent(MainActivity.this, RevActivity.class);
                startActivity(launchactivity);
            }
        });

        final Button click2 = (Button) findViewById(R.id.button2);
        click2.setOnClickListener(new View.OnClickListener() {
            public void onClick(View v) {
                Intent launchactivity = new Intent(MainActivity.this, IrrevmActivity.class);
                startActivity(launchactivity);
            }
        });

        final Button click3 = (Button) findViewById(R.id.button4);
        click3.setOnClickListener(new View.OnClickListener() {
            public void onClick(View v) {
                Intent launchactivity = new Intent(MainActivity.this, DiffActivity.class);
                startActivity(launchactivity);
            }
        });


        final Button click4 = (Button) findViewById(R.id.button3);
        click4.setOnClickListener(new View.OnClickListener() {
            public void onClick(View v) {
                Intent launchactivity = new Intent(MainActivity.this, CalcActivity.class);
                startActivity(launchactivity);
            }
        });

        final Button btn = (Button) findViewById(R.id.credits);
        btn.setOnClickListener(new View.OnClickListener() {
            public void onClick(View v) {
                Intent launchactivity = new Intent(MainActivity.this, CreditsActivity.class);
                startActivity(launchactivity);
            }
        });
}

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_main, menu);
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
