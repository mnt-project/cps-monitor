<?php


namespace App\cps\admin;


use App\Models\Connect;
use App\Models\Ip;

class Network
{
    protected $incoming;

    /**
     * Network constructor.
     */
    public function __construct($visitor,$user_id = 0,$agent = 'unknown',$route = 'unknown')
    {
        $ip = Ip::where('ip',$visitor)->first();
        if(empty($ip))
        {
            $ip = Ip::ipCreate($visitor,$user_id);
            //dd(__METHOD__,'empty',$ip);
        }
        if($ip->user_id == 0 and $user_id != 0)
        {
            $ip->user_id = $user_id;
            $ip->save();
        }
        $this->incoming = Connect::connectCreate($ip->id,$user_id,$visitor,$agent,$route);
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
}
