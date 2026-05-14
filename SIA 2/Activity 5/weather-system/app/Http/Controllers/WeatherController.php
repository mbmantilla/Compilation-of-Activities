<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use App\Models\User;

class WeatherController extends Controller
{
    public function dashboard(Request $request)
    {
        // Default city if none entered
        $city = $request->input('city', 'Cebu City');
        
        // Cache API results for 30 minutes to improve performance and meet challenge
        $weather = Cache::remember("weather_{$city}", 1800, function () use ($city) {
            $response = Http::get(
                "https://api.openweathermap.org/data/2.5/weather",
                [
                    'q' => $city,
                    'appid' => 'f9e30614b26735ab6b7283cbd901fb25',
                    'units' => 'metric'
                ]
            );

            if ($response->failed()) {
                return null;
            }

            return $response->json();
        });

        // Handle API errors gracefully
        if (!$weather) {
            session()->flash('error', "Could not fetch weather data for {$city}. Please check the city name.");
            $weather = [];
        }

        $users = User::all();

        return view('dashboard', compact('weather', 'users', 'city'));
    }
}