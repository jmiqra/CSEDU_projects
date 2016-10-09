package com.example.user.intracity_bus_route;

import android.content.res.Resources;
import android.content.res.TypedArray;
import android.net.Uri;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.text.Layout;
import android.widget.TextView;

import com.google.android.gms.appindexing.Action;
import com.google.android.gms.appindexing.AppIndex;
import com.google.android.gms.common.api.GoogleApiClient;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;

import java.util.*;
import java.io.FileNotFoundException;
import java.io.FileReader;
import java.util.ArrayList;
import java.util.Arrays;
import java.util.Comparator;
import java.util.HashMap;
import java.util.List;
import java.util.PriorityQueue;
import java.util.Scanner;

class Node {
    int val;
    double myDis;
    //double myTime;
    //double myFare;
    Node(int _val, double _myDis)
    {
        val=_val;
        myDis=_myDis;
        //myTime=_myTime;
        //myFare=_myFare;
    }
}


class NodeComparator implements Comparator<Node>
{
    @Override
    public int compare(Node x, Node y)
    {
        return (int) (x.myDis - y.myDis);
    }
}

public class BusRoute extends AppCompatActivity {

    /**
     * ATTENTION: This was auto-generated to implement the App Indexing API.
     * See https://g.co/AppIndexing/AndroidStudio for more information.
     */
    private GoogleApiClient client;
    String[] sfedges, sfstop;
    int i, k;
/*
    public String add(String str1, String str2, String str3) {
        String ret = "";
        if (str1.equals("Airport")) {
            ret = sfedges[0] + " " + sfstop[0] + " " + str1 + " " + str2 + " " + str3;
        } else
            ret = sfedges[6] + " " + sfstop[2] + " " + str1 + " " + str2 + " " + str3;
        return ret;
    }
*/
    ////////////////////////////////////////////////////
    int G[][];
    double distance[][][];
    double time[][][];
    double fare[][][];
    int option[][][];
    int fmediaInt[][];
    int MAX = 10000005;
    int u, v, cost;
    //boolean visited[];
    int res;
    double d[];
    int par[];
    PriorityQueue<Node> pq;
    int Nplace, Nedge, Nmed = 0;
    HashMap<String, Integer> map1;
    HashMap<Integer, String> map2;
    HashMap<String, Integer> map3;
    HashMap<Integer, String> map4;

    double dijkstra(int src, int dest, int via) {
        Comparator<Node> comparator = new NodeComparator();
        pq = new PriorityQueue<Node>(Nplace + 2, comparator);
        d = new double[Nplace + 2];
        par = new int[Nplace + 2];
        Node temp;
        initDijkstra();
        d[src] = 0;
        par[src] = src;
        pq.add(new Node(src, 0));
        while (pq.isEmpty() == false) {
            temp = pq.poll();
            u = temp.val;
            if (u == dest)
                return d[u];
            System.out.println("in pq: " + u);
            for (int v = 0; v < Nplace; v++) {
                if (G[u][v] >= 1) {
                    for (int j = 0; j < G[u][v]; j++) {
                        int med = option[u][v][j];
                        System.out.println(u + " hi " + v + " " + med + " " + via);
                        if (via == 1) {
                            if (d[v] > d[u] + distance[u][v][med]) {
                                par[v] = u;
                                fmediaInt[u][v] = med;
                                d[v] = d[u] + distance[u][v][med];
                                pq.add(new Node(v, d[v]));
                            }
                        } else if (via == 2) {
                            if (d[v] > d[u] + time[u][v][med]) {
                                par[v] = u;
                                fmediaInt[u][v] = med;
                                d[v] = d[u] + time[u][v][med];
                                pq.add(new Node(v, d[v]));
                            }
                        } else if (via == 3) {
                            System.out.println(u + " hi2 " + v + " " + med + " " + via + " " + d[u] + " " + d[v]);
                            if (d[v] > d[u] + fare[u][v][med]) {
                                System.out.println(u + " " + v + " " + med + " " + via);
                                par[v] = u;
                                fmediaInt[u][v] = med;
                                d[v] = d[u] + fare[u][v][med];
                                pq.add(new Node(v, d[v]));
                            }
                        }
                    }
                }
            }
        }
        return -1;
    }

    String DisRoute(String source, String dest) {
        String myRoute = "";
        int i = 0, k = 0;
        int temp[] = new int[1005];
        int temp1[] = new int[1005];
        int n1 = map1.get(dest), n2 = map1.get(source);
        temp[i++] = n1;
        while (true) {
            n1 = par[n1];
            temp[i++] = n1;
            if (n2 == n1)
                break;
        }
        for (int j = 0; j < i; j++) System.out.print(temp[j] + " ");
        System.out.println();
        for (int j = i - 1; j >= 0; j--) temp1[k++] = temp[j];
        for (int j = 0; j < i; j++) temp[j] = temp1[j];
        //Collections.reverse(Arrays.asList(temp));
        for (int j = 0; j < i; j++) System.out.print(temp[j] + " ");
        System.out.println();
        System.out.println("hi " + temp);
        myRoute += "1. ";
        myRoute += "First, start from ";
        myRoute += map2.get(temp[0]);
        myRoute += "\n";
        for (int j = 1; j < i; j++) {
            myRoute += (j + 1);
            myRoute += ". Then, go to ";
            myRoute += map2.get(temp[j]);
            myRoute += " Via ";
            myRoute += map4.get(fmediaInt[temp[j - 1]][temp[j]]);
            myRoute += ", distance=";
            myRoute += distance[temp[j - 1]][temp[j]][fmediaInt[temp[j - 1]][temp[j]]];
            myRoute += "km, will take time=";
            myRoute += (int) (time[temp[j - 1]][temp[j]][fmediaInt[temp[j - 1]][temp[j]]] / 60);
            myRoute += "hr ";
            myRoute += (time[temp[j - 1]][temp[j]][fmediaInt[temp[j - 1]][temp[j]]] % 60);
            myRoute += "min, ";
            myRoute += "fare=";
            myRoute += fare[temp[j - 1]][temp[j]][fmediaInt[temp[j - 1]][temp[j]]];
            myRoute += "/-.\n";
        }
        myRoute += "You have reached your destnation";
        return myRoute;
    }

    String findDistance(String source, String dest, String via) {
        int src = map1.get(source);
        int dst = map1.get(dest);
        int _via = 0;
        if (via.equalsIgnoreCase("Distance")) _via = 1;
        else if (via.equalsIgnoreCase("Time")) _via = 2;
        else if (via.equalsIgnoreCase("Fare")) _via = 3;
        double res1 = dijkstra(src, dst, _via);
        //System.out.println(bestDis[src][dst]);
        if (res1 != -1)
            return DisRoute(source, dest);
        else
            return "";
    }

    void initDijkstra() {
        for (int i = 0; i < Nplace; i++) {
            //visited[i]=false;
            d[i] = MAX;
            par[i] = -1;
        }
    }

    void takeInput() throws FileNotFoundException {
        //System.out.println(_in.length);
        int l = k;
        int i, n1, n2, n3;
        double dist, tm, fr;
        String name1, name2, md;
        Nplace = k;
        //System.out.println("nplace="+Nplace);
        for (i = 0; i < Nplace; i++) {
            name1 = sfstop[i];
            map1.put(name1, i);
            map2.put(i, name1);
            //System.out.println("name1="+name1);
        }
        Nedge = i;
        //System.out.println("nedge="+Nedge);
        for (i = 0; i < (Nedge * 6); i += 6) {
            name1 = sfedges[i];
            name2 = sfedges[i + 1];
            //System.out.println("name1="+name1+" name2="+name2);
            dist = Double.parseDouble(sfedges[i + 2]);
            tm = Double.parseDouble(sfedges[i + 3]);
            fr = Double.parseDouble(sfedges[i + 4]);
            md = sfedges[i + 5];
            //System.out.println(dist+","+tm+","+fr+","+md);
            Object value = map3.get(md);
            if (value == null) {
                map3.put(md, Nmed);
                map4.put(Nmed++, md);
            }
            //System.out.println(dist+","+tm+","+fr+","+md);
            n1 = map1.get(name1);
            n2 = map1.get(name2);
            n3 = map3.get(md);
            //System.out.println(n1);
            //System.out.println(n2);
            //System.out.println(n3);
            //System.out.println(G[n1][n2]);
            option[n1][n2][G[n1][n2]++] = n3;
            distance[n1][n2][n3] = dist;
            time[n1][n2][n3] = tm;
            fare[n1][n2][n3] = fr;
        }
    }

    void init() throws FileNotFoundException {
        G = new int[305][305];
        distance = new double[305][305][20];
        time = new double[305][305][20];
        fare = new double[305][305][20];
        option = new int[305][305][20];
        fmediaInt = new int[305][305];
        map1 = new HashMap<String, Integer>();
        map2 = new HashMap<Integer, String>();
        map3 = new HashMap<String, Integer>();
        map4 = new HashMap<Integer, String>();
        //String _in[] ={"md","dh","mir","sh","ScienceLab","DhakaUniversity","Mdpur","md", "dh", "2", "20", "10", "bus","dh", "mir", "5", "40", "20", "bus","mir", "md", "4", "30", "15", "bus","mir", "sh", "1", "10", "5", "bus","sh", "md", "2", "10", "10", "bus","ScienceLab", "Mdpur", "1", "40", "100", "rickshaw","ScienceLab", "DhakaUniversity", "0.5", "10", "40", "rickshaw","DhakaUniversity", "Mdpur", "1.5", "30", "0", "DUbus"};
        takeInput();
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_bus_route);
        Bundle bundle = getIntent().getExtras();
        String s1 = bundle.getString("s1");
        String s2 = bundle.getString("s2");
        String s3 = bundle.getString("s3");
        TextView textView = (TextView) findViewById(R.id.busroute);
        //textView.setText(s1+" to "+s2+" by "+s3);
        String line = "";
        StringBuilder finalString = new StringBuilder();
        InputStream istream = getResources().openRawResource(R.raw.edge);
        BufferedReader breader = new BufferedReader(new InputStreamReader(istream));
        i = 0;
        int j = 0;
        String[] splited;
        sfedges = new String[9000];
        sfstop = new String[1000];

        InputStream istream1 = getResources().openRawResource(R.raw.stoppage);
        BufferedReader breader1 = new BufferedReader(new InputStreamReader(istream1));
        k = 0;
        try {
            while ((line = breader1.readLine()) != null) {
                sfstop[k] = line.toString();
                k++;
            }
        } catch (IOException e) {
            e.printStackTrace();
        }

        try {
            while ((line = breader.readLine()) != null) {
                //finalString.append(line);
                splited = line.split(",");
                //finalString.append(splited[0]+" "+splited[1]+" "+splited[2]+" "+splited[3]+" "+splited[4]+" "+"\n");
                for (j = 0; j < 6; j++) {
                    sfedges[i] = splited[j];
                    i++;
                }
            }
        } catch (IOException e) {
            e.printStackTrace();
        }

        //String str =add(s1,s2,s3);
        try {
            init();
        } catch (FileNotFoundException e) {
            e.printStackTrace();
        }
        String str = findDistance(s1, s2, s3);
        //System.out.println(str);
        textView.setText(str);

        //textView.setText(sfedges[0]+" "+sfedges[6]+"\n"+sfstop[0]+" "+sfstop[2]);
        /*
        Resources res = getResources();
        TypedArray ta = res.obtainTypedArray(R.array.input);
        int n = ta.length();
        String[][] array = new String[n][];
        String out = "";
        for (int i = 0; i < n; i++) {
            int id = ta.getResourceId(i, 0);
            if (id > 0) {
                array[i] = res.getStringArray(id);
                out+=array[i];
            } else {
                // something wrong with the XML
            }
        }
        */
        //String[] iqr=array[0];
        //String[] iqr1=array[1];
        //ta.recycle(); // Important!
        //textView.setText(out);
        // ATTENTION: This was auto-generated to implement the App Indexing API.
        // See https://g.co/AppIndexing/AndroidStudio for more information.
        client = new GoogleApiClient.Builder(this).addApi(AppIndex.API).build();
    }

    @Override
    public void onStart() {
        super.onStart();

        // ATTENTION: This was auto-generated to implement the App Indexing API.
        // See https://g.co/AppIndexing/AndroidStudio for more information.
        client.connect();
        Action viewAction = Action.newAction(
                Action.TYPE_VIEW, // TODO: choose an action type.
                "BusRoute Page", // TODO: Define a title for the content shown.
                // TODO: If you have web page content that matches this app activity's content,
                // make sure this auto-generated web page URL is correct.
                // Otherwise, set the URL to null.
                Uri.parse("http://host/path"),
                // TODO: Make sure this auto-generated app URL is correct.
                Uri.parse("android-app://com.example.user.intracity_bus_route/http/host/path")
        );
        AppIndex.AppIndexApi.start(client, viewAction);
    }

    @Override
    public void onStop() {
        super.onStop();

        // ATTENTION: This was auto-generated to implement the App Indexing API.
        // See https://g.co/AppIndexing/AndroidStudio for more information.
        Action viewAction = Action.newAction(
                Action.TYPE_VIEW, // TODO: choose an action type.
                "BusRoute Page", // TODO: Define a title for the content shown.
                // TODO: If you have web page content that matches this app activity's content,
                // make sure this auto-generated web page URL is correct.
                // Otherwise, set the URL to null.
                Uri.parse("http://host/path"),
                // TODO: Make sure this auto-generated app URL is correct.
                Uri.parse("android-app://com.example.user.intracity_bus_route/http/host/path")
        );
        AppIndex.AppIndexApi.end(client, viewAction);
        client.disconnect();
    }

    public String[] getStredge() {
        return sfedges;
    }

    public String[] getSfstop() {
        return sfstop;
    }
}