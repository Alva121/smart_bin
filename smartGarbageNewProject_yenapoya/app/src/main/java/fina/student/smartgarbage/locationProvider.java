package fina.student.smartgarbage;

import android.Manifest;
import android.content.Context;
import android.content.pm.PackageManager;
import android.location.Location;
import android.location.LocationListener;
import android.location.LocationManager;
import android.os.Bundle;
import android.widget.Toast;

import androidx.core.app.ActivityCompat;

interface ilocation{
    void getLocation(String lat,String lng);
}
public class locationProvider {
        locationProvider(final Context context, final ilocation ilocation){
        LocationManager locationManager =
                (LocationManager) context.getSystemService(Context.LOCATION_SERVICE);
        // Define a listener that responds to location updates
        LocationListener locationListener = new LocationListener() {
            public void onLocationChanged(Location location) {


                //web.loadUrl("http://192.168.2.15/myhtdocs/hump_api/?lat="+location.getLatitude()+"&lng="+location.getLongitude());

                // Called when a new location is found by the network location provider.
                String lat = Double.toString(location.getLatitude());
                String lon = Double.toString(location.getLongitude());

                Toast.makeText(context, "Your LocationModel is:" + lat + "--" + lon, Toast.LENGTH_SHORT).show();
                ilocation.getLocation(lat,lon);
                // tv.setText();
            }

            public void onStatusChanged(String provider, int status, Bundle extras) {
            }

            public void onProviderEnabled(String provider) {
            }

            public void onProviderDisabled(String provider) {
            }
        };
        // Register the listener with the LocationModel Manager to receive location updates
        if (ActivityCompat.checkSelfPermission(context, Manifest.permission.ACCESS_FINE_LOCATION) != PackageManager.PERMISSION_GRANTED && ActivityCompat.checkSelfPermission(context, Manifest.permission.ACCESS_COARSE_LOCATION) != PackageManager.PERMISSION_GRANTED) {
            // TODO: Consider calling
            //    ActivityCompat#requestPermissions
            // here to request the missing permissions, and then overriding
            //   public void onRequestPermissionsResult(int requestCode, String[] permissions,
            //                                          int[] grantResults)
            // to handle the case where the user grants the permission. See the documentation
            // for ActivityCompat#requestPermissions for more details.
            Toast.makeText(context, "please Enable gps", Toast.LENGTH_SHORT).show();

            return;
        }
        try
        {
        locationManager.requestLocationUpdates(LocationManager.GPS_PROVIDER, 30, 0, locationListener);
        locationManager.requestLocationUpdates(LocationManager.NETWORK_PROVIDER, 30, 0, locationListener);

        }catch (Exception e)
        {

        }



    }
}
