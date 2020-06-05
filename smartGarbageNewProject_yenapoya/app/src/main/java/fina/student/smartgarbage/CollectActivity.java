package fina.student.smartgarbage;

import android.location.Location;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import java.util.Iterator;

public class CollectActivity extends AppCompatActivity {
Button wet,dry;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_collect);
        wet=findViewById(R.id.wet);
        dry=findViewById(R.id.dry);
        wet.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {

                updateCollectStatus(0);
            }
        });

        dry.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                updateCollectStatus(1);
            }
        });
        new locationProvider(this, new ilocation() {
            @Override
            public void getLocation(String lat, String lng) {
                constants.lat=lat;
                constants.lng=lng;



            }
        });
    }



    void   updateCollectStatus(int _type){
      //  Toast.makeText(this, "press", Toast.LENGTH_SHORT).show();
        Location locationA = new Location("point A");

        locationA.setLatitude(Double.parseDouble(constants.lat));
        locationA.setLongitude(Double.parseDouble(constants.lng));



        Iterator iterator=dataProvider.getInstance().locationModelList.iterator();
        Toast.makeText(this,dataProvider.getInstance().locationModelList.size()+"" , Toast.LENGTH_SHORT).show();
        while (iterator.hasNext()) {
            Location locationB = new Location("point B");
            LocationModel model=((LocationModel)iterator.next());
            locationB.setLatitude(Double.parseDouble(model.getLat()));
            locationB.setLongitude(Double.parseDouble(model.getLng()));

            float distance = locationA.distanceTo(locationB);
            Toast.makeText(this, distance+"", Toast.LENGTH_SHORT).show();
            if (distance < 1000)
            {
                Toast.makeText(CollectActivity.this,"Identified Bin:"+ model.getName(), Toast.LENGTH_SHORT).show();

                StringRequest stringRequest=new StringRequest(Request.Method.GET, constants.IP + "/api.php?type=6&_type="+_type
                        +"&lat="+model.getLat()
                        +"&lng="+model.getLng()
                        +"&name="+model.getName()
                        ,
                        new Response.Listener<String>() {
                            @Override
                            public void onResponse(String response) {
                                if (response.equals("0")) {
                                    Toast.makeText(CollectActivity.this, "Successfully Updated", Toast.LENGTH_SHORT).show();
                                    finish();
                                }else
                                {
                                    Toast.makeText(CollectActivity.this, "error", Toast.LENGTH_SHORT).show();
                                }

                            }
                        }, new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Toast.makeText(CollectActivity.this, "error in server", Toast.LENGTH_SHORT).show();
                    }
                }
                );
                RequestQueue queue = Volley.newRequestQueue(getApplicationContext());
// Add the request to the RequestQueue.
                queue.add(stringRequest);


                return;
            }
        }
    }


}
