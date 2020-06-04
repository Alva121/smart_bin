package com.smartgarbagemanagement;

/**
 * Created by scchethu on 25/04/2018.
 */

public class binModel {
private String name,lon,lng,dist,status;

    public binModel(String name, String lon, String lng, String dist, String status) {
        this.name = name;
        this.lon = lon;
        this.lng = lng;
        this.dist = dist;
        this.status = status;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getLon() {
        return lon;
    }

    public void setLon(String lon) {
        this.lon = lon;
    }

    public String getLng() {
        return lng;
    }

    public void setLng(String lng) {
        this.lng = lng;
    }

    public String getDist() {
        return dist;
    }

    public void setDist(String dist) {
        this.dist = dist;
    }

    public String getStatus() {
        return status;
    }

    public void setStatus(String status) {
        this.status = status;
    }
}
