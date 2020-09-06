<?php
/**
 * Class NetBox
 * Author: Mohammad A. Souri (MAS)
 * Email: Souri.blackhat@gmail.com
 * Created date: 2020-08-27
 * All right reserved©.
 */


class Netbox {
    const LIMIT = 9000000;
    private $url;
    private $token;

    /**
     * Netbox constructor.
     * @param $host
     * http://IP-ADDRESS:8080
     * @param $token
     */
    public function __construct($host, $token)
    {
        $this->url = $this->normalize_url($host);
        $this->token = $token;
    }

    public function ipam_get_ip_addresses($limit = self::LIMIT){
        return $this->request('ipam/ip-addresses/?limit='.$limit);
    }

    public function ipam_get_vlans($limit = self::LIMIT){
        return $this->request('ipam/vlans/?limit='.$limit);
    }

    public function ipam_get_vlan_groups($limit = self::LIMIT){
        return$this->request('ipam/vlan-groups/?limit='.$limit);
    }

    public function ipam_get_roles($limit = self::LIMIT){
        return $this->request('ipam/roles/?limit='.$limit);
    }

    public function ipam_get_services($limit = self::LIMIT){
        return $this->request('ipam/services/?limit='.$limit);
    }

    public function ipam_get_aggregates($limit = self::LIMIT){
        return $this->request('ipam/aggregates/?limit='.$limit);
    }

    public function ipam_get_prefixes($limit = self::LIMIT){
        return $this->request('ipam/prefixes/?limit='.$limit);
    }

    private function request($url, $method = 'GET', $header = null){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url . $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        $headers = array();
        $headers[] = 'Authorization: Token '.$this->token;
        $headers[] = 'Accept: application/json;';
        if ($header != null)
            $headers[] = $header;

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        return $result;
    }

    private function normalize_url($url){
        if(substr($url, -1) != '/')
            return $url . '/api/';
        return $url . '/api/';
    }
}
