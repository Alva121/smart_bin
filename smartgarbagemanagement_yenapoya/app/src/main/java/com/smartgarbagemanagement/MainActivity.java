package com.smartgarbagemanagement;

import android.content.Intent;
import android.location.Location;
import android.net.Uri;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.DefaultItemAnimator;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.util.Log;
import android.view.View;
import android.widget.Toast;

import org.eclipse.paho.client.mqttv3.IMqttDeliveryToken;
import org.eclipse.paho.client.mqttv3.MqttCallbackExtended;
import org.eclipse.paho.client.mqttv3.MqttMessage;

import java.util.ArrayList;
import java.util.List;

public class MainActivity extends AppCompatActivity {
    float[] results = new float[1];
    double [][]myloc= {
            {
                    12.502698,75.0835436   //EEE
            },
            {
                    12.504265,75.0815797//LBS store
            },
            {
                    12.5073378,75.0801816 //AJMAL
            },
            {
                    12.5035945,75.0799921//LBS ground
            }
    };
 final    float th=200000;
    String prev1,prev2,prev3;
    double latitude;
    double longitude;
    private List<binModel> binList = new ArrayList<>();
    private RecyclerView recyclerView;
    private Adapter mAdapter;
    binModel bm;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        recyclerView = (RecyclerView) findViewById(R.id.recyclerview);

        mAdapter = new Adapter(binList);
        RecyclerView.LayoutManager mLayoutManager = new LinearLayoutManager(getApplicationContext());
        recyclerView.setLayoutManager(mLayoutManager);
        recyclerView.setItemAnimator(new DefaultItemAnimator());
        recyclerView.setAdapter(mAdapter);
       recyclerView.addOnItemTouchListener(new RecyclerItemClickListener(getApplicationContext(), recyclerView, new RecyclerItemClickListener.OnItemClickListener() {
           @Override
           public void onItemClick(View view, int position) throws Exception {
               if(position==0)
                   throw new Exception("main");
            binModel bm=binList.get(position);
               Intent intent = new Intent(android.content.Intent.ACTION_VIEW,
                       Uri.parse("google.navigation:q="+bm.getLon()+","+bm.getLng()));
               startActivity(intent);
           }

           @Override
           public void onItemLongClick(View view, int position) {

           }
       }));


        bm=new binModel("Bin Location", myloc[2][0]+"", myloc[2][1]+"","Distance(m)\n in Radius","Status");
        binList.add(bm);
        mAdapter.notifyDataSetChanged();

ini_bin();
startMqtt();
    }

    private void startMqtt() {
        MqttHelper mqttHelper = new MqttHelper(getApplicationContext());
        mqttHelper.setCallback(new MqttCallbackExtended() {
            @Override

            public void connectComplete(boolean b, String s) {
                Toast.makeText(getApplicationContext(),"connected",Toast.LENGTH_SHORT).show();
            }

            @Override
            public void connectionLost(Throwable throwable) {
                Toast.makeText(getApplicationContext(),"Dis-connected",Toast.LENGTH_SHORT).show();
            }

            @Override
            public void messageArrived(String topic, MqttMessage mqttMessage) throws Exception {
                Log.w("Debug", mqttMessage.toString());


                GPSTracker gps = new GPSTracker(MainActivity.this);
                // check if GPS enabled
                if (gps.canGetLocation()) {
                    latitude = gps.getLatitude();
                    longitude = gps.getLongitude();
                    // \n is for new line
                    //Toast.makeText(getApplicationContext(), "Your Location is - \nLat: " + latitude + "\nLong: " + longitude, Toast.LENGTH_LONG).show();
                }
                //  dataReceived.setText(mqttMessage.toString());
               // Toast.makeText(MainActivity.this,mqttMessage.toString(),Toast.LENGTH_SHORT).show();
           binList.clear();

                bm=new binModel("Bin Location", myloc[2][0]+"", myloc[2][1]+"","Distance(m)\n in Radius","Status");
                binList.add(bm);
                mAdapter.notifyDataSetChanged();
                Location.distanceBetween(latitude,longitude,
                        myloc[0][0], myloc[0][1],
                        results);
                float r1=results[0];
                if(r1<=th)
                {
                    if((mqttMessage.toString().contains("BNR")))
                    {
                        bm=new binModel("EEE", myloc[0][0]+"", myloc[0][1]+"",r1+"",mqttMessage.toString().replace("BNR",""));
                        binList.add(bm);
                    prev1=mqttMessage.toString().replace("BNR","");
                    }else
                    {
                        bm=new binModel("EEE", myloc[0][0]+"", myloc[0][1]+"",r1+"",prev1);
                        binList.add(bm);
                    }

                    mAdapter.notifyDataSetChanged();
                }

                Location.distanceBetween(latitude,longitude,
                        myloc[1][0], myloc[1][1],
                        results);
                float r2=results[0];
                if(r2<=th)
                {
                    if((mqttMessage.toString().contains("NAG"))) {
                        bm = new binModel("LBS Store", myloc[1][0] + "", myloc[1][1] + "", r2 + "", mqttMessage.toString().replace("NAG",""));
                        binList.add(bm);
                        prev2=mqttMessage.toString().replace("NAG","");
                    }
                    else
                    {
                        bm=new binModel("LBS Store", myloc[1][0]+"", myloc[1][1]+"",r2+"",prev2);
                        binList.add(bm);
                    }
                    mAdapter.notifyDataSetChanged();
                }
                Location.distanceBetween(latitude,longitude,
                        myloc[2][0], myloc[2][1],
                        results);
                float r3=results[0];
                if(r3<=th)
                {
                    bm=new binModel("AJMAL", myloc[2][0]+"", myloc[2][1]+"",r3+"","Not working");
                    binList.add(bm);
                    mAdapter.notifyDataSetChanged();
                }
                Location.distanceBetween(latitude,longitude,
                        myloc[3][0], myloc[3][1],
                        results);
                float r4=results[0];

                if(r4<=th)
                {
                    if((mqttMessage.toString().contains("BOL"))) {
                        bm = new binModel("LBS ground", myloc[3][0]+"", myloc[3][1]+"",r4+"", mqttMessage.toString().replace("BOL",""));
                        binList.add(bm);
                        prev3=mqttMessage.toString().replace("BOL","");
                    }
                    else
                    {
                        bm=new binModel("LBS ground", myloc[3][0]+"", myloc[3][1]+"",r4+"",prev3);
                        binList.add(bm);
                    }
                    mAdapter.notifyDataSetChanged();



                }
            }

            @Override
            public void deliveryComplete(IMqttDeliveryToken iMqttDeliveryToken) {

            }
        });
    }
 void   ini_bin()
    {
        GPSTracker gps = new GPSTracker(MainActivity.this);

        // check if GPS enabled
        if (gps.canGetLocation()) {

            latitude = gps.getLatitude();
            longitude = gps.getLongitude();

            // \n is for new line
            //Toast.makeText(getApplicationContext(), "Your Location is - \nLat: " + latitude + "\nLong: " + longitude, Toast.LENGTH_LONG).show();
        } else {
            // can't get location
            // GPS or Network is not enabled
            // Ask user to enable GPS/network in settings
            gps.showSettingsAlert();
        }

        Location.distanceBetween(latitude,longitude,
                myloc[0][0], myloc[0][1],
                results);
        float r1=results[0];
        if(r1<=th)
        {
            bm=new binModel("EEE", myloc[0][0]+"", myloc[0][1]+"",r1+"","Not working");
            binList.add(bm);

            mAdapter.notifyDataSetChanged();
        }

        Location.distanceBetween(latitude,longitude,
                myloc[1][0], myloc[1][1],
                results);
        float r2=results[0];
        if(r2<=th)
        {
            bm=new binModel("LBS Store", myloc[1][0]+"", myloc[1][1]+"",r2+"", "Not working");
            binList.add(bm);
            mAdapter.notifyDataSetChanged();
        }
        Location.distanceBetween(latitude,longitude,
                myloc[2][0], myloc[2][1],
                results);
        float r3=results[0];
        if(r3<=th)
        {
            bm=new binModel("AJMAL", myloc[2][0]+"", myloc[2][1]+"",r3+"","Not working");
            binList.add(bm);
            mAdapter.notifyDataSetChanged();
        }
        Location.distanceBetween(latitude,longitude,
                myloc[3][0], myloc[3][1],
                results);
        float r4=results[0];

        if(r4<=th)
        {
            bm=new binModel("LBS Ground", myloc[3][0]+"", myloc[3][1]+"",r4+"","Not working");
            binList.add(bm);
            mAdapter.notifyDataSetChanged();
        }
    }
}
