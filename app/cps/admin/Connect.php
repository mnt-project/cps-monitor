<?php


namespace App\cps\admin;
use App\Http\Requests\PasswordRequest;
use App\Models\Connections;


class Connect
{
    protected $ip;
    protected $lastconnect;
    /**
     * Connect constructor.
     */
    public function __construct($adress)
    {
        $this->ip=Connections::where('visitor',$adress)->first();
        if(!is_null($this->ip))
        {
            $this->lastconnect = $this->ip->updated_at;
            $this->ip->visits++;
            $this->ip->save();
        }
        else
        {
            $this->ip=Connections::create([
                'visitor' => $adress,
                'visits' => 1
            ]);
            $this->lastconnect = $this->ip->created_at;
        }
    }
    public static function getConnectionsCount()
    {
        return Connections::get()->count();
    }
    public static function getAllConnectionsCount()
    {
        $connections = Connections::get();
        $count = 0;
        foreach ($connections as $connect)
        {
            $count+=$connect->visits;
        }
        return $count;
     }
    /**
     * @return mixed
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @return mixed
     */
    public function getLastconnect()
    {
        return $this->lastconnect;
    }

}
