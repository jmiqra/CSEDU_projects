package com.example.user.intracity_bus_route;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
        import android.os.Bundle;
        import android.widget.AdapterView;
        import android.widget.ArrayAdapter;
        import android.widget.Button;
        import android.widget.Spinner;
        import java.util.ArrayList;
        import java.util.Collection;
        import java.util.Comparator;
        import android.app.Activity;
        import android.content.Context;
        import android.database.DataSetObserver;
        import android.util.Log;
        import android.view.LayoutInflater;
        import android.view.Menu;
        import android.view.View;
        import android.view.ViewGroup;
        import android.widget.BaseAdapter;
        import android.widget.Filter;
        import android.widget.ImageView;
        import android.widget.ListView;
        import android.widget.TextView;
        import android.widget.Toast;


public class MainActivity extends AppCompatActivity {

    Spinner spinner1,spinner2,spinner3;
    ArrayAdapter<CharSequence> adapter,adapter3;
    TextView result;
    Button btn,btnmap;
    ImageView iv;
    String str,str1,str2,str3;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        spinner1 = (Spinner)findViewById(R.id.dropdown1);
        spinner2 = (Spinner)findViewById(R.id.dropdown2);
        spinner3 = (Spinner)findViewById(R.id.dropdown3);

        adapter = ArrayAdapter.createFromResource(this,R.array.location_names,android.R.layout.simple_spinner_item);
        adapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
        spinner1.setAdapter(adapter);
        spinner1.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener()
        {

            @Override
            public void onItemSelected(AdapterView<?> parent, View view, int position, long id) {
                Toast.makeText(getBaseContext(),parent.getItemAtPosition(position)+" is selected " ,Toast.LENGTH_LONG).show();
                //str=(String)parent.getAdapter().getItem(position);
                str1=(String)parent.getItemAtPosition(position);
            }

            @Override
            public void onNothingSelected(AdapterView<?> parent) {

            }
        });

        spinner2.setAdapter(adapter);
        spinner2.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener()
        {

            @Override
            public void onItemSelected(AdapterView<?> parent, View view, int position, long id) {
                Toast.makeText(getBaseContext(),parent.getItemAtPosition(position)+" is selected " ,Toast.LENGTH_LONG).show();
                str2=(String)parent.getItemAtPosition(position);
            }

            @Override
            public void onNothingSelected(AdapterView<?> parent) {

            }
        });

        adapter3 = ArrayAdapter.createFromResource(this,R.array.options,android.R.layout.simple_spinner_item);
        adapter3.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
        spinner3.setAdapter(adapter3);
        spinner3.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener()
        {

            @Override
            public void onItemSelected(AdapterView<?> parent, View view, int position, long id) {
                Toast.makeText(getBaseContext(),parent.getItemAtPosition(position)+" option is selected " ,Toast.LENGTH_LONG).show();
                str3=(String)parent.getItemAtPosition(position);
            }

            @Override
            public void onNothingSelected(AdapterView<?> parent) {

            }
        });
        /////////////////////////////////////////////////////////////
        final Button click = (Button) findViewById(R.id.button1);
        click.setOnClickListener(new View.OnClickListener() {
            public void onClick(View v) {
                Intent launchactivity = new Intent(MainActivity.this, MapActivity.class);
                startActivity(launchactivity);
            }
        });

        /*
        result = (TextView)findViewById(R.id.resulttxt);
        btn = (Button)findViewById(R.id.button);

        btn.setOnClickListener(new View.OnClickListener() {
            public void onClick(View v) {
                // code will be here
            }
        });

        btn.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                //num1 = Double.parseDouble(firstNumber.getText().toString());
                //num2 = Double.parseDouble(secondNumber.getText().toString());
                //sum = Math.log(num2) - Math.log(num1);
                result.setText("done "+str1+" to "+str2+" by "+str3);
            }
        });
        */

        final Button click1 = (Button) findViewById(R.id.button);
        click1.setOnClickListener(new View.OnClickListener() {
            public void onClick(View v) {
                Intent launchactivity = new Intent(MainActivity.this, BusRoute.class);
                Bundle bundle = new Bundle();
                bundle.putString("s1", str1);
                bundle.putString("s2", str2);
                bundle.putString("s3", str3);
                launchactivity.putExtras(bundle);
                startActivity(launchactivity);
            }
        });

        final Button click2 = (Button) findViewById(R.id.button2);
        click2.setOnClickListener(new View.OnClickListener() {
            public void onClick(View v) {
                Intent launchactivity = new Intent(MainActivity.this, GoogleMapActivity.class);
                Bundle bundle = new Bundle();
                bundle.putString("s1", str1);
                bundle.putString("s2", str2);
                bundle.putString("s3", str3);
                launchactivity.putExtras(bundle);
                startActivity(launchactivity);
            }
        });

    }

}

