<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/* Route::get("posts", function () {
    return response()->json([
        "id" => 1,
        "title" => "Sample Post",
        "content" => "This is a sample post content."
    ]);
}); */





Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
