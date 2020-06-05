package fina.student.smartgarbage;

import android.content.Intent;
import android.graphics.Bitmap;
import android.os.Bundle;
import android.view.MenuItem;
import android.webkit.GeolocationPermissions;
import android.webkit.JsResult;
import android.webkit.WebChromeClient;
import android.webkit.WebResourceRequest;
import android.webkit.WebView;
import android.webkit.WebViewClient;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;

import com.google.android.material.bottomnavigation.BottomNavigationView;

import static fina.student.smartgarbage.constants.lat;
import static fina.student.smartgarbage.constants.lng;

public class UserActivity extends AppCompatActivity {
    WebView web;
    BottomNavigationView bottomNavigationView;
    boolean flag=false;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_user);
        bottomNavigationView=findViewById(R.id.nav);
        bottomNavigationView.setOnNavigationItemSelectedListener(new BottomNavigationView.OnNavigationItemSelectedListener() {
            @Override
            public boolean onNavigationItemSelected(@NonNull MenuItem menuItem) {
                switch (menuItem.getItemId())
                {
                    case R.id.view:
                        flag=false;
                        web.loadUrl(constants.IP + "/smartbin/monitor.php?lat=" + lat + "&lng=" + lng);
                        break;
                    case R.id.track:



                      startActivity(new Intent(getApplicationContext(),Feedback.class));


                }
                return false;
            }
        });
        web=findViewById(R.id.webview);
        web.setScrollbarFadingEnabled(true);
        web.setVerticalScrollBarEnabled(false);
        web.getSettings().setGeolocationEnabled(true);
        web.getSettings().setJavaScriptCanOpenWindowsAutomatically(true);
        web.getSettings().setGeolocationDatabasePath( getApplication().getFilesDir().getPath() );
        web.setWebChromeClient(new WebChromeClient() {
            @Override
            public boolean onJsAlert(WebView view, String url, String message, JsResult result) {
                return super.onJsAlert(view, url, message, result);
            }
            @Override
            public void onGeolocationPermissionsShowPrompt(String origin,
                                                           GeolocationPermissions.Callback callback) {
                // Always grant permission since the app itself requires location
                // permission and the user has therefore already granted it
                callback.invoke(origin, true, false);
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


        //web.clearCache(true);
        web.getSettings().setJavaScriptEnabled(true);
        web.getSettings().setGeolocationEnabled(true);
        web.getSettings().setJavaScriptCanOpenWindowsAutomatically(true);
        web.getSettings().setUseWideViewPort(true);
// Zoom out if the content width is greater than the width of the viewport
        web.getSettings().setLoadWithOverviewMode(true);
        web.getSettings().setAppCacheEnabled(true);
        web.getSettings().setDatabaseEnabled(true);
        web.getSettings().setDomStorageEnabled(true);
    //    web.loadUrl(constants.IP+"/smartbin/monitor.php?lat="+lat+"&lng="+lng);
        new locationProvider(this, new ilocation() {
            @Override
            public void getLocation(String lat, String lng) {
                constants.lat=lat;
                constants.lng=lng;
                if(!flag)
                {
                    flag=true;
                    web.loadUrl(constants.IP + "/smartbin/monitor.php?lat=" + lat + "&lng=" + lng);
                }


            }
        });


    }

}
