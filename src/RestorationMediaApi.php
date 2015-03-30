<?php

namespace RestorationMedia;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Message\ResponseInterface;

class RestorationMediaApi
{

    /**
     * API URL
     *
     * @var string
     */
    protected $apiUrl = 'http://feeds.restorationmedia.net/partnersfeed.php';


    /**
     * @var ClientInterface
     */
    protected $client;


    /**
     * @var ResponseInterface
     */
    protected $response;


    /**
     * Parameters are required in this order to send to API.
     * I don't know why, but that's what the docs say.
     *
     * @var array
     */
    protected $fields = [
        'pid' => '',
        'email' => '',
        'fname' => '',
        'lname' => '',
        'addr1' => '',
        'addr2' => '',
        'city' => '',
        'state' => '',
        'zip' => '',
        'country' => '',
        'gender' => '',
        'dob' => '',
        'source' => '',
        'ip' => '',
        'date' => '',
        'jobtitle' => '',
        'industry' => '',
    ];


    /**
     * Instantiate class with minimal fields to be make valid request
     *
     * @param ClientInterface $client
     * @param string $pid
     * @param string $email
     * @param string $ip
     * @param string $source
     * @param string $date
     * @param array  $urlData
     */
    public function __construct(ClientInterface $client, $pid, $email, $ip, $source, $date, Array $urlData = array())
    {
        $this->setClient($client);
        $this->setPid($pid);
        $this->setEmail($email);
        $this->setIp($ip);
        $this->setSource($source);
        $this->setDate($date);
        $this->setParams($urlData);
    }


    /**
     * Set Client
     *
     * @param string $client
     *
     * @return $this
     */
    public function setClient($client)
    {
        $this->client = $client;

        return $this;
    }


    /**
     * Get Client
     *
     * @return ClientInterface
     */
    public function getClient()
    {
        return $this->client;
    }


    /**
     * Set URL Params from passed data
     *
     * @param array $urlData
     *
     * @return $this
     */
    public function setParams(Array $urlData)
    {
        foreach (array_keys($this->fields) as $key) {
            if (array_key_exists($key, $urlData)) {
                $this->fields[$key] = $urlData[$key];
            }
        }

        return $this;
    }


    /**
     * Set Pid
     *
     * @param string $pid
     *
     * @return $this
     */
    public function setPid($pid)
    {
        if (empty($pid) || is_null($pid)) {
            throw new \InvalidArgumentException('PID required parameter');
        }

        $this->fields['pid'] = $pid;

        return $this;
    }


    /**
     * Get Pid
     *
     * @return string
     */
    public function getPid()
    {
        return $this->fields['pid'];
    }


    /**
     * Set Email
     *
     * @param string $email
     *
     * @return $this
     */
    public function setEmail($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException('Valid email required parameter');
        }

        $this->fields['email'] = $email;

        return $this;
    }


    /**
     * Get Email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->fields['email'];
    }


    /**
     * Build URL for request
     *
     * @return string
     */
    public function getBuiltUrl()
    {
        return $this->apiUrl . '?' . http_build_query($this->fields);
    }


    /**
     * Set First Name
     *
     * @param string $firstName
     *
     * @return $this
     */
    public function setFname($firstName)
    {
        $this->fields['fname'] = $firstName;

        return $this;
    }


    /**
     * Get First Name
     *
     * @return string
     */
    public function getFname()
    {
        return $this->fields['fname'];
    }


    /**
     * Set Last Name
     *
     * @param string $lastName
     *
     * @return $this
     */
    public function setLname($lastName)
    {
        $this->fields['lname'] = $lastName;

        return $this;
    }


    /**
     * Get Last Name
     *
     * @return string
     */
    public function getLname()
    {
        return $this->fields['lname'];
    }


    /**
     * Set Addr1
     *
     * @param string $addr1
     *
     * @return $this
     */
    public function setAddr1($addr1)
    {
        $this->fields['addr1'] = $addr1;

        return $this;
    }


    /**
     * Get Addr1
     *
     * @return string
     */
    public function getAddr1()
    {
        return $this->fields['addr1'];
    }


    /**
     * Set Addr2
     *
     * @param string $addr2
     *
     * @return $this
     */
    public function setAddr2($addr2)
    {
        $this->fields['addr2'] = $addr2;

        return $this;
    }


    /**
     * Get Addr2
     *
     * @return string
     */
    public function getAddr2()
    {
        return $this->fields['addr2'];
    }


    /**
     * Set City
     *
     * @param string $city
     *
     * @return $this
     */
    public function setCity($city)
    {
        $this->fields['city'] = $city;

        return $this;
    }


    /**
     * Get City
     *
     * @return string
     */
    public function getCity()
    {
        return $this->fields['city'];
    }


    /**
     * Set State
     *
     * @param string $state
     *
     * @return $this
     */
    public function setState($state)
    {
        $this->fields['state'] = $state;

        return $this;
    }


    /**
     * Get State
     *
     * @return string
     */
    public function getState()
    {
        return $this->fields['state'];
    }


    /**
     * Set Zip
     *
     * @param string $zip
     *
     * @return $this
     */
    public function setZip($zip)
    {
        $this->fields['zip'] = $zip;

        return $this;
    }


    /**
     * Get Zip
     *
     * @return string
     */
    public function getZip()
    {
        return $this->fields['zip'];
    }


    /**
     * Set Country
     *
     * @param string $country
     *
     * @return $this
     */
    public function setCountry($country)
    {
        $this->fields['country'] = $country;

        return $this;
    }


    /**
     * Get Country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->fields['country'];
    }


    /**
     * Set Phone
     *
     * @param string $phone
     *
     * @return $this
     */
    public function setPhone($phone)
    {
        $this->fields['phone'] = $phone;

        return $this;
    }


    /**
     * Get Phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->fields['phone'];
    }


    /**
     * Set Mobile
     *
     * @param string $mobile
     *
     * @return $this
     */
    public function setMobile($mobile)
    {
        $this->fields['mobile'] = $mobile;

        return $this;
    }


    /**
     * Get Mobile
     *
     * @return string
     */
    public function getMobile()
    {
        return $this->fields['mobile'];
    }


    /**
     * Set Gender
     *
     * @param string $gender
     *
     * @return $this
     */
    public function setGender($gender)
    {
        $this->fields['gender'] = $gender;

        return $this;
    }


    /**
     * Get Gender
     *
     * @return string
     */
    public function getGender()
    {
        return $this->fields['gender'];
    }


    /**
     * Set Dob
     *
     * @param string $dob
     *
     * @return $this
     */
    public function setDob($dob)
    {
        $this->fields['dob'] = $dob;

        return $this;
    }


    /**
     * Get Dob
     *
     * @return string
     */
    public function getDob()
    {
        return $this->fields['dob'];
    }


    /**
     * Set Source
     *
     * @param string $source
     *
     * @return $this
     */
    public function setSource($source)
    {
        if (empty($source) || is_null($source)) {
            throw new \InvalidArgumentException('Source required parameter');
        }

        $this->fields['source'] = $source;

        return $this;
    }


    /**
     * Get Source
     *
     * @return string
     */
    public function getSource()
    {
        return $this->fields['source'];
    }


    /**
     * Set IP
     *
     * @param string $ipAddress
     *
     * @return $this
     */
    public function setIp($ipAddress)
    {
        if (empty($ipAddress) || is_null($ipAddress)) {
            throw new \InvalidArgumentException('IP required parameter');
        }

        $this->fields['ip'] = $ipAddress;

        return $this;
    }


    /**
     * Get IP
     *
     * @return string
     */
    public function getIp()
    {
        return $this->fields['ip'];
    }


    /**
     * Set Date
     *
     * @param string $date
     *
     * @return $this
     */
    public function setDate($date)
    {
        if (empty($date) || is_null($date)) {
            throw new \InvalidArgumentException('Date required parameter');
        }

        $this->fields['date'] = $date;

        return $this;
    }


    /**
     * Get Date
     *
     * @return string
     */
    public function getDate()
    {
        return $this->fields['date'];
    }


    /**
     * Set Job Title
     *
     * @param string $jobTitle
     *
     * @return $this
     */
    public function setJobTitle($jobTitle)
    {
        $this->fields['jobtitle'] = $jobTitle;

        return $this;
    }


    /**
     * Get Job Title
     *
     * @return string
     */
    public function getJobTitle()
    {
        return $this->fields['jobtitle'];
    }


    /**
     * Set Industry
     *
     * @param string $industry
     *
     * @return $this
     */
    public function setIndustry($industry)
    {
        $this->fields['industry'] = $industry;

        return $this;
    }


    /**
     * Get Industry
     *
     * @return string
     */
    public function getIndustry()
    {
        return $this->fields['industry'];
    }


    /**
     * Return last response
     *
     * @return ResponseInterface
     */
    public function getResponse()
    {
        return $this->response;
    }


    /**
     * Run request to Restoration Media
     */
    public function send()
    {
        $request = $this->client->createRequest('GET', $this->getBuiltUrl());
        $request->setHeader('User-Agent', 'github.com/caseyw/restorationmedia_php');

        $this->response = $this->client->send($request);

        /*
         * Restoration Media doesn't actually use HTTP Status Codes. I don't know why.
         */
        return ('success.' == $this->response->xml()) ? true : false;
    }
}
