<?php

//Credentials to connect to the API
$apiKey = "5d3164684aea1bef6f3358e87e9ac2c3";

// Method: POST, PUT, GET etc
// Data: array("param" => "value") ==> index.php?param=value

function CallAPI($method, $url, $data = false)
{
    $curl = curl_init();

    GLOBAL $apiKey;

    $headers = [
        'X-API-Key: '.$apiKey
               ];

    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);


    switch ($method)
    {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);

            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_PUT, 1);
            break;
        default:
            if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
    }

    // Optional Authentication:
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($curl, CURLOPT_USERPWD, "username:password");

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($curl);

    curl_close($curl);

    return $result;
}

$json = CallApi("GET","https://ha.iadvize.com/api/2/website");

var_dump(json_decode($json));

//phpinfo();

?>
