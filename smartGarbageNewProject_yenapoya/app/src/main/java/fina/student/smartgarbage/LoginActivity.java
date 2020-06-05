package fina.student.smartgarbage;
import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
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

public class LoginActivity extends AppCompatActivity {
Button login;
Button reg; String type;
EditText user,pass;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);
        login=findViewById(R.id.login);
        user=findViewById(R.id.user);
        pass=findViewById(R.id.pass);
        reg=findViewById(R.id.reg);
        Intent intent=getIntent();
       type=intent.getStringExtra("type");
      //  Toast.makeText(this, type, Toast.LENGTH_SHORT).show();
        if(type.equals(constants.DRIVER))
            reg.setVisibility(View.INVISIBLE);
        login.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(final View view) {
                Log.d("login",constants.IP+"/api.php?"+constants.TYPE5+"&email="+user.getText().toString()
                        +"&password="+pass.getText().toString()+
                        "&_type="+type);
                StringRequest stringRequest = new StringRequest(Request.Method.GET, constants.IP+"/api.php?"+constants.TYPE5+"&email="+user.getText().toString()
                        +"&password="+pass.getText().toString()+
                        "&_type="+type,
                        new Response.Listener<String>() {
                            @Override
                            public void onResponse(String response) {

                         if(response.equals("-1")) {
                             Toast.makeText(LoginActivity.this, "Invalid login credential", Toast.LENGTH_SHORT).show();
                            // return;
                         }
                           if(type.equals(constants.DRIVER))
                           {
                            startActivity(new Intent(getApplicationContext(),DriverActivity.class));
                            finish();
                           }else{
                               startActivity(new Intent(getApplicationContext(),UserActivity.class));
                               finish();
                           }
                            }
                        }, new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Toast.makeText(LoginActivity.this, error.getMessage(), Toast.LENGTH_SHORT).show();
                    }
                });
                if(type.equals(constants.DRIVER))
                {
                    startActivity(new Intent(getApplicationContext(),DriverActivity.class));
                    finish();
                }else{
                    startActivity(new Intent(getApplicationContext(),UserActivity.class));
                    finish();
                }
                RequestQueue queue = Volley.newRequestQueue(getApplicationContext());
// Add the request to the RequestQueue.
                queue.add(stringRequest);

            }
        });

        reg.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent=new Intent(view.getContext(),Registration.class);
                startActivity(intent);
            }
        });
    }
}
