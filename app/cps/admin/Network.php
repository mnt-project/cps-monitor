<?php


namespace App\cps\admin;


use App\Models\Connect;
use App\Models\Ip;
use Carbon\Carbon;

class Network
{
    protected $incoming;

    /**
     * Network constructor.
     */
    public function __construct($visitor, $user_id = 0, $agent = 'unknown', $route = 'unknown')
    {
        $ip = Ip::firstOrCreate(['ip' => $visitor], ['user_id' => $user_id]);
        if ($ip->user_id == 0 && $user_id != 0) {
            $ip->user_id = $user_id;
        }
        $ip->updated_at = Carbon::now();
        $ip->save();
        $this->incoming = Connect::connectCreate($ip->id, $user_id, $visitor, $agent, $route);
    }
    /**
     * @return mixed
     */
    public function getIncoming()
    {
        return $this->incoming;
    }
    public function getIp()
    {
        return $this->incoming->ip;
    }
    public function getIpBan()
    {
        return $this->incoming->ip->ban === 1;
    }
}
