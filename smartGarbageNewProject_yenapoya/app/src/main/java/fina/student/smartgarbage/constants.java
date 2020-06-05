package fina.student.smartgarbage;

import android.location.Location;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;

public class constants {
    public  static final String IP  ="http://192.168.43.222/smart_bin";
    public static String lat="";
    public static int TYPE1=1;
    public static String TYPE2="type=2";
    public static String TYPE4="type=4";
    public static String TYPE5="type=5";
    public  static final String DRIVER="0";
    public static final String USER="1";
    public static String lng="";
    public static int rad=10000;


    public static JSONArray getLocationJSON(String markers){

        try {
           return new JSONArray(markers);

        } catch (JSONException e) {
            e.printStackTrace();
        }
        return null;
    }


    public static List<LocationModel> getLocationByRange(String markers) {
        JSONArray jsonArray=getLocationJSON(markers);
        List<LocationModel>locationModelList=new ArrayList<>();

        for(int i=0;i<jsonArray.length();i++){

            JSONObject ob = null;
            try {
                ob = jsonArray.getJSONObject(i);
            } catch (JSONException e) {
                e.printStackTrace();
            }

            LocationModel locationModel = null;
            try {
                locationModel = new LocationModel(ob.getString("lat"),ob.getString("lng"),ob.getString("name"),ob.getString("id"),ob.getString("status"));
            } catch (JSONException e) {
                e.printStackTrace();
            }

            Location locationA = new Location("point A");

            locationA.setLatitude(Double.parseDouble(constants.lat));
            locationA.setLongitude(Double.parseDouble(constants.lng));

            Location locationB = new Location("point B");

            locationB.setLatitude(Double.parseDouble(locationModel.getLat()));
            locationB.setLongitude(Double.parseDouble(locationModel.getLng()));

            float distance = locationA.distanceTo(locationB);
           if(  distance<rad&& locationModel.status.equals("3"))
            {
                locationModelList.add(locationModel);

            }


        }

        return locationModelList;
    }
}
