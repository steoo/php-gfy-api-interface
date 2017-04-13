# gfycat.com php api interface
An interface for calling gfycat.com API via curl with php


## Introduction
gfycat.com expose API to interact with its services. The complete documentation can be found 
 at https://developers.gfycat.com/api
 
 
 ## Usage
You need a `client_id` and a `client_secret`. You can obtain those by creating a new
gfycat app at https://developers.gfycat.com/signup


 ```
    $api = new GFYAPI("YOUR_CLIENT_ID", "YOUR_SECRET_ID");
    
    // Call whatever you want to call
 ```