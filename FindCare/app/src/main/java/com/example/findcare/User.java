package com.example.findcare;

public class User {
    private String userId;
    private String name;
    private String email;
    private String location;
    private double latitude;
    private double longitude;

    public User(String userId, String name, String email, String location, double latitude, double longitude) {
        this.userId = userId;
        this.name = name;
        this.email = email;
        this.location = location;
        this.latitude = latitude;
        this.longitude = longitude;
    }

    // Getter and Setter methods
    public String getUserId() {
        return userId;
    }

    public void setUserId(String userId) {
        this.userId = userId;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getEmail() {
        return email;
    }

    public void setEmail(String email) {
        this.email = email;
    }

    public String getLocation() {
        return location;
    }

    public void setLocation(String location) {
        this.location = location;
    }

    public double getLatitude() {
        return latitude;
    }

    public void setLatitude(double latitude) {
        this.latitude = latitude;
    }

    public double getLongitude() {
        return longitude;
    }

    public void setLongitude(double longitude) {
        this.longitude = longitude;
    }
}
