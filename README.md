Restoration Media PHP Library
=============================
[![Build Status](https://travis-ci.org/caseyw/restorationmedia_php.svg?branch=master)](https://travis-ci.org/caseyw/restorationmedia_php)

Small project needed to interface with Restoration Media.

Needed to have a simple way to pass in the correct data, and know if responses were sound.

```php
$client = new GuzzleHttp\Client();

// Required API fields are constructor injected
$api = new \RestorationMedia\RestorationMediaApi(
    $client, 
    $pid, 
    $email, 
    $ipAddress, 
    $source, 
    $date, 
    $params // Optional fields as array
);

if (!$api->send()) {
    // We can examine the response... but they always return 200...
    $api->getResponse()->getStatusCode();
    
    // We can check for what response came up
    $response = $api->getResponse()->xml();
    
    switch ($response) {
        case 'Invalid Email.':
            // Do logic for Invalid Email according to their API
        break;
        case 'Invalid Source.':
            // Do logic for Invalid Source according to their API
        break;
    }
}
```

Currently known responses:
* success.
* Invalid Email.
* Invalid Source Url.
* Invalid Ip Address.
* Invalid Date.


Thanks,

-Casey
