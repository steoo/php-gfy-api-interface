<?php

class GFYAPI
{
    private $client_id = "";
    private $client_secret = "";
    const grant_type = "client_credentials";
    const authUrl = "https://api.gfycat.com/v1/oauth/token";
    const getUrl = "https://api.gfycat.com/v1/gfycats/";

    public function __construct($client_id = "", $client_secret = "")
    {
        // Error handling
        if(!$client_id) {
            return;
        }
        // Error handling
        if($client_secret){
            return;
        }

        $this->client_id = $client_id;

        $this->client_secret = $client_secret;
    }

    /*
     *  Authorize
     *  @return {string}
     * curl -v -XPOST -d
     * '{"client_id":"YOUR_ID_HERE", "client_secret": "YOUR_SECRET_HERE", "grant_type": "client_credentials"}' https://api.gfycat.com/v1/oauth/token
     */
    public function __auth()
    {
        // Error handling
        if(!$this->client_id || !$this->client_secret) {
            return;
        }

        $fields = array("client_id" => self::client_id, "client_secret" => self::client_secret, "grant_type" => self::grant_type);
        $curl = curl_init(self::authUrl);

        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_VERBOSE, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($fields));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $result = curl_exec($curl);

        // access_token, to be appended as 'Authorizaztion' header
        $resultArray = json_decode($result, true);

        curl_close($curl);

//        echo("Generated access_token: ");
//        echo($resultArray["access_token"]);
        return $resultArray["access_token"];
    }

    /*
     *  Get GFY by id
     *  curl -v -X GET
     *      https://api.gfycat.com/v1/gfycats/{gfyid}  -H "Authorization: Bearer <<token>>"
     * */
    public function getById($id = "")
    {
        $accessToken = self::__auth();
        $header = array();
        $header[] = 'Authorization: ' . $accessToken;

        if (!id) {
//            var_dump("no id provided");
            return false;
        }
        // Builds the url
        $url = join("", array(self::getUrl, $id));

        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);

        $result = curl_exec($curl);

        $resultArray = json_decode($result);

        curl_close($curl);

        return $resultArray;
    }

}