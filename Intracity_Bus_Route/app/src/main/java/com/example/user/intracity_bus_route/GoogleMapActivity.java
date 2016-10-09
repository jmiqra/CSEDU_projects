package com.example.user.intracity_bus_route;

import android.Manifest;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.graphics.Color;
import android.location.Address;
import android.location.Geocoder;
import android.support.v4.app.ActivityCompat;
import android.support.v4.app.FragmentActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.EditText;

import com.google.android.gms.maps.CameraUpdateFactory;
import com.google.android.gms.maps.GoogleMap;
import com.google.android.gms.maps.OnMapReadyCallback;
import com.google.android.gms.maps.SupportMapFragment;
import com.google.android.gms.maps.model.LatLng;
import com.google.android.gms.maps.model.MarkerOptions;
import com.google.android.gms.maps.model.Polygon;
import com.google.android.gms.maps.model.PolygonOptions;

import java.io.IOException;
import java.util.List;

public class GoogleMapActivity extends FragmentActivity implements OnMapReadyCallback {

    private GoogleMap mMap;
    private int counter = 0;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_google_map);
        // Obtain the SupportMapFragment and get notified when the map is ready to be used.
        SupportMapFragment mapFragment = (SupportMapFragment) getSupportFragmentManager()
                .findFragmentById(R.id.map);
        mapFragment.getMapAsync(this);
    }


    /**
     * Manipulates the map once available.
     * This callback is triggered when the map is ready to be used.
     * This is where we can add markers or lines, add listeners or move the camera. In this case,
     * we just add a marker near Sydney, Australia.
     * If Google Play services is not installed on the device, the user will be prompted to install
     * it inside the SupportMapFragment. This method will only be triggered once the user has
     * installed Google Play services and returned to the app.
     */
    @Override
    public void onMapReady(GoogleMap googleMap) {
        mMap = googleMap;

        // Add a marker in Sydney and move the camera
        LatLng dhaka = new LatLng(23.43, 90.26);
        LatLng tejgaon = new LatLng(23.759739,90.392418);
        LatLng uttora = new LatLng(23.873751,90.396454);

        PolygonOptions poption = new PolygonOptions().add(tejgaon).add(uttora).add(tejgaon);
        poption.strokeColor(Color.BLUE);
        poption.strokeWidth(5);
        poption.geodesic(true);

        Polygon polygon = mMap.addPolygon(poption);
        mMap.addMarker(new MarkerOptions().position(uttora).title("Mark"));
        mMap.moveCamera(CameraUpdateFactory.newLatLngZoom(tejgaon,15));







        //mMap
        // .addMarker(new MarkerOptions().position(dhaka).title("Marker in Dhaka"));
        //mMap.moveCamera(CameraUpdateFactory.newLatLng(dhaka));

        //mMap.setMyLocationEnabled(true);
    }


    public void onSearch(View view)
    {
        EditText location1 = (EditText)findViewById(R.id.input);
        String location = location1.getText().toString();
        List<Address> addressList = null;
        if(location!=null || location.equals(""))
        {
            Geocoder geocoder = new Geocoder(this);
            try {
                addressList = geocoder.getFromLocationName(location,1);
            } catch (IOException e) {
                e.printStackTrace();
            }

            Address address = addressList.get(0);
            LatLng latlang = new LatLng(address.getLatitude(),address.getLongitude());
            mMap.addMarker(new MarkerOptions().position(latlang).title("Mark"));
            mMap.animateCamera(CameraUpdateFactory.newLatLng(latlang));


        }
    }

    public void changeType(View view)
    {
        if(counter==0)
        {
            mMap.setMapType(GoogleMap.MAP_TYPE_NORMAL);
            //counter++;

        }
        else if(counter==2)
        {
            mMap.setMapType(GoogleMap.MAP_TYPE_SATELLITE);
            //counter++;
        }
        else if(counter==1)
        {
            mMap.setMapType(GoogleMap.MAP_TYPE_TERRAIN);
            //counter++;
        }
        else if(counter==3)
        {
            mMap.setMapType(GoogleMap.MAP_TYPE_HYBRID);
            //counter++;
        }
        counter++;
        if(counter>3)
            counter = 0;

    }

    public void onZoom(View view) {
        if (view.getId() == R.id.zoomout) {
            mMap.animateCamera(CameraUpdateFactory.zoomOut());
        }
        if (view.getId() == R.id.zoomin) {
            mMap.animateCamera((CameraUpdateFactory.zoomIn()));
        }

    }
}
