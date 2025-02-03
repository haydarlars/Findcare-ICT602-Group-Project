package com.example.findcare;

import androidx.core.app.ActivityCompat;
import androidx.core.content.ContextCompat;
import androidx.fragment.app.FragmentActivity;

import android.Manifest;
import android.annotation.SuppressLint;
import android.content.pm.PackageManager;
import android.os.Bundle;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.Volley;
import com.google.android.gms.maps.CameraUpdateFactory;
import com.google.android.gms.maps.GoogleMap;
import com.google.android.gms.maps.OnMapReadyCallback;
import com.google.android.gms.maps.SupportMapFragment;
import com.google.android.gms.maps.model.LatLng;
import com.google.android.gms.maps.model.MarkerOptions;
import com.example.findcare.databinding.ActivityMapsBinding;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.Vector;

public class MapsActivity extends FragmentActivity implements OnMapReadyCallback {

    private GoogleMap mMap;
    private ActivityMapsBinding binding;

    LatLng centerlocation;
    Vector<MarkerOptions> markerOptions;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        binding = ActivityMapsBinding.inflate(getLayoutInflater());
        setContentView(binding.getRoot());

        SupportMapFragment mapFragment = (SupportMapFragment) getSupportFragmentManager()
                .findFragmentById(R.id.map);
        mapFragment.getMapAsync(this);

        centerlocation = new LatLng(3.0, 101);
        markerOptions = new Vector<>();

        // Hardcoded branch locations
        markerOptions.add(new MarkerOptions().title("Klinik Hj. Adnan, Branch Kangar")
                .position(new LatLng(6.440745971355241, 100.20124493477769))
                .snippet("Open Mon-Fri : 8am - 5pm"));

        markerOptions.add(new MarkerOptions().title("Klinik Hj. Adnan, Branch Arau")
                .position(new LatLng(6.441977573242018, 100.26266101596272))
                .snippet("Open Mon-Fri : 8am - 5pm"));

        markerOptions.add(new MarkerOptions().title("Klinik Hj. Adnan, Branch Kuala Perlis")
                .position(new LatLng(6.397775477837341, 100.13129116336924))
                .snippet("Open Mon-Fri : 8am - 5pm"));

        markerOptions.add(new MarkerOptions().title("Klinik Hj. Adnan, Branch Simpang Ampat")
                .position(new LatLng(6.334309786110492, 100.1587550788988))
                .snippet("Open Mon-Fri : 8am - 5pm"));

        markerOptions.add(new MarkerOptions().title("Klinik Hj. Adnan, Branch Padang Besar")
                .position(new LatLng(6.662448276083791, 100.3190046306274))
                .snippet("Open Mon-Fri : 8am - 5pm"));

        markerOptions.add(new MarkerOptions().title("Klinik Hj. Adnan, Branch Kaki Bukit")
                .position(new LatLng(6.649026518451656, 100.19117576158075))
                .snippet("Open Mon-Fri : 8am - 5pm"));
    }

    @Override
    public void onMapReady(GoogleMap googleMap) {
        mMap = googleMap;

        // Add hardcoded markers
        for (MarkerOptions mark : markerOptions) {
            mMap.addMarker(mark);
        }

        enableMyLocation();
        fetchLocationsFromServer();
        mMap.moveCamera(CameraUpdateFactory.newLatLngZoom(centerlocation, 8));
    }

    @SuppressLint("MissingPermission")
    private void enableMyLocation() {
        if (ContextCompat.checkSelfPermission(this, Manifest.permission.ACCESS_FINE_LOCATION)
                == PackageManager.PERMISSION_GRANTED
                || ContextCompat.checkSelfPermission(this, Manifest.permission.ACCESS_COARSE_LOCATION)
                == PackageManager.PERMISSION_GRANTED) {
            mMap.setMyLocationEnabled(true);
            return;
        }
        ActivityCompat.requestPermissions(this, new String[]{Manifest.permission.ACCESS_FINE_LOCATION}, 200);
    }

    private void fetchLocationsFromServer() {
        String url = "http://10.0.2.2/findcare_api/get_locations.php"; // Replace with actual server URL
        RequestQueue queue = Volley.newRequestQueue(this);

        JsonArrayRequest jsonArrayRequest = new JsonArrayRequest(Request.Method.GET, url, null,
                response -> {
                    try {
                        for (int i = 0; i < response.length(); i++) {
                            JSONObject location = response.getJSONObject(i);

                            double lat = location.getDouble("latitude");
                            double lng = location.getDouble("longitude");
                            String name = location.getString("name");
                            String description = location.getString("description");

                            LatLng latLng = new LatLng(lat, lng);
                            MarkerOptions marker = new MarkerOptions()
                                    .title(name)
                                    .position(latLng)
                                    .snippet(description);

                            mMap.addMarker(marker);
                        }
                        // Move camera to first fetched location
                        if (response.length() > 0) {
                            JSONObject firstLocation = response.getJSONObject(0);
                            LatLng firstLatLng = new LatLng(firstLocation.getDouble("latitude"), firstLocation.getDouble("longitude"));
                            mMap.moveCamera(CameraUpdateFactory.newLatLngZoom(firstLatLng, 10));
                        }
                    } catch (JSONException e) {
                        e.printStackTrace();
                    }
                }, error -> {
            error.printStackTrace();
        });

        queue.add(jsonArrayRequest);
    }
}
