package fina.student.smartgarbage;

import android.content.ActivityNotFoundException;
import android.content.Intent;
import android.graphics.Bitmap;
import android.net.Uri;
import android.os.Bundle;
import android.util.Log;
import android.view.MenuItem;
import android.webkit.JsResult;
import android.webkit.WebChromeClient;
import android.webkit.WebResourceRequest;
import android.webkit.WebView;
import android.webkit.WebViewClient;
import android.widget.Toast;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.google.android.material.bottomnavigation.BottomNavigationView;

import static fina.student.smartgarbage.constants.lat;
import static fina.student.smartgarbage.constants.lng;

public class DriverActivity extends AppCompatActivity {
    WebView web;
    BottomNavigationView bottomNavigationView;
    boolean flag=false;
    boolean CANTRACK=true;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_driver);
        bottomNavigationView=findViewById(R.id.nav);
        updateLocationAndTrack(!CANTRACK);
        bottomNavigationView.setOnNavigationItemSelectedListener(new BottomNavigationView.OnNavigationItemSelectedListener() {
            @Override
            public boolean onNavigationItemSelected(@NonNull MenuItem menuItem) {
                switch (menuItem.getItemId())
                {
                    case R.id.view:
                        flag=false;
                        web.loadUrl(constants.IP + "/smartbin/monitor.php?lat=" + lat + "&lng=" + lng);
                        break;
                    case R.id.collect:
                        updateLocationAndTrack(!CANTRACK);
                        startActivity(new Intent(getApplicationContext(),CollectActivity.class));
                        break;
                    case R.id.track:

                                  updateLocationAndTrack(CANTRACK);


                }
                return false;
            }
        });
         web=findViewById(R.id.webview);
        web.setScrollbarFadingEnabled(true);
        web.setVerticalScrollBarEnabled(false);
        web.setWebChromeClient(new WebChromeClient() {
            @Override
            public boolean onJsAlert(WebView view, String url, String message, JsResult result) {
                return super.onJsAlert(view, url, message, result);
            }
        });
        web.setWebViewClient(new WebViewClient(){


            @Override
            public boolean shouldOverrideUrlLoading(WebView view, WebResourceRequest request) {
                return super.shouldOverrideUrlLoading(view, request);
            }

            @Override
            public void onPageStarted(WebView view, String url, Bitmap favicon) {
                super.onPageStarted(view, url, favicon);


            }

            @Override
            public void onPageFinished(WebView view, String url) {
                super.onPageFinished(view, url);
               // p.setVisibility(View.INVISIBLE);
            }
        });


       web.clearCache(true);
        web.getSettings().setJavaScriptEnabled(true);
        web.getSettings().setGeolocationEnabled(true);
        web.getSettings().setJavaScriptCanOpenWindowsAutomatically(true);
        web.getSettings().setUseWideViewPort(true);
// Zoom out if the content width is greater than the width of the viewport
        web.getSettings().setLoadWithOverviewMode(true);
        web.getSettings().setAppCacheEnabled(true);
        web.getSettings().setDatabaseEnabled(true);
        web.getSettings().setDomStorageEnabled(true);
      //  web.loadUrl(constants.IP+"/smartbin/monitor.php?lat="+lat+"&lng="+lng);
           new locationProvider(this, new ilocation() {
           @Override
           public void getLocation(String lat, String lng) {
               constants.lat=lat;
               constants.lng=lng;
               if(!flag)
               {
                   flag=true;
                   web.loadUrl(constants.IP + "/smartbin/monitor.php?lat=" + lat + "&lng=" + lng);
                   updateLocationAndTrack(!CANTRACK);
               }


           }
       });


    }

    private void updateLocationAndTrack(final boolean cantrack) {
        if(!flag)
            return;

        RequestQueue queue = Volley.newRequestQueue(getApplicationContext());
        String url =constants.IP+"/api.php?type=1";

// Request a string response from the provided URL.
        StringRequest stringRequest = new StringRequest(Request.Method.GET, url,
                new Response.Listener<String>() {

                    @Override
                    public void onResponse(String response) {
                        // Display the first 500 characters of the response string.
                        Toast.makeText(DriverActivity.this, response, Toast.LENGTH_SHORT).show();
                        dataProvider.getInstance().locationModelList=constants.getLocationByRange(response);
                        if(!cantrack)
                            return;
                        String waypoints="";
                        for(LocationModel locationModel:dataProvider.getInstance().locationModelList){
                            waypoints+=locationModel.getLat()+","+locationModel.getLng()+"|";

                        }
//                    int pos=  waypoints.lastIndexOf('|');
//                      StringBuilder sb=new StringBuilder(waypoints);
//                      sb.deleteCharAt(pos);


                        Log.d("waypoints",waypoints);
                        Uri gmmIntentUri = Uri.parse("https://www.google.com/maps/dir/?api=1&origin="+ lat+","+lng+"&destination=12.8945647,74.9004492&waypoints="+waypoints+"&travelmode=driving");
                        Intent intent = new Intent(Intent.ACTION_VIEW, gmmIntentUri);
                        intent.setPackage("com.google.android.apps.maps");
                        try {
                            startActivity(intent);
                        } catch (ActivityNotFoundException ex) {
                            try {
                                Intent unrestrictedIntent = new Intent(Intent.ACTION_VIEW, gmmIntentUri);
                                startActivity(unrestrictedIntent);
                            } catch (ActivityNotFoundException innerEx) {
                                Toast.makeText(getApplication(), "Please install a maps application", Toast.LENGTH_LONG).show();
                            }
                        }
                    }
                }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Toast.makeText(DriverActivity.this, error.getMessage(), Toast.LENGTH_SHORT).show();
            }
        });

// Add the request to the RequestQueue.
        queue.add(stringRequest);
    }
}
