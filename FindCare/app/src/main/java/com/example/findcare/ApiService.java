package com.example.findcare;

import retrofit2.Call;
import retrofit2.http.Body;
import retrofit2.http.POST;

public interface ApiService {
    @POST("/saveUser")
    Call<ApiResponse> saveUser(@Body User user);
}
