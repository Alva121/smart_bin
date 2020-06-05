package fina.student.smartgarbage;

import android.net.Uri;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

public class Feedback extends AppCompatActivity {
EditText name,phone,msg;
Button submit;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_feedback);
        name=findViewById(R.id.name);
        phone=findViewById(R.id.phone);
        msg=findViewById(R.id.msg);
submit=findViewById(R.id.submit);
        submit.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                StringRequest stringRequest = new StringRequest(Request.Method.GET, constants.IP+"/api.php?"+constants.TYPE2+
                        "&msg="+ Uri.encode(msg.getText().toString())
                        +"&phone="+phone.getText().toString()
                        +"&name="+name.getText().toString()
                        +"&lat="+constants.lat
                        +"&lng="+constants.lng
                        ,
                        new Response.Listener<String>() {
                            @Override
                            public void onResponse(String response) {
                                Toast.makeText(Feedback.this, response, Toast.LENGTH_SHORT).show();
                                if(response.equals("0")) {
                                    Toast.makeText(getApplicationContext() , "successfully submitted", Toast.LENGTH_SHORT).show();
                                    finish();
                                }
                                else
                                    Toast.makeText(getApplicationContext(), "Error,", Toast.LENGTH_SHORT).show();
                            }
                        }, new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        //  textView.setText("That didn't work!");
                    }
                });
                RequestQueue queue = Volley.newRequestQueue(getApplicationContext());
// Add the request to the RequestQueue.
                queue.add(stringRequest);
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
}
