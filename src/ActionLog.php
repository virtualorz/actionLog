<?php

namespace Virtualorz\ActionLog;

use Virtualorz\ActionLog\system_log;
use DB;
use Session;
use Route;

class ActionLog
{

    protected static $message= [
        'status' => 0,
        'status_string' => '',
        'message' => '',
        'data' => []
    ];

    public static $before = [];
    public static $after = [];

    /**
     * push key value to self before value array
     * @param $key
     * @param $value
     */
    public function pushBefore($key, $value)
    {
        if(!isset(self::$before[$key])){
            self::$before[$key] = [];
        }
        array_push(self::$before[$key],$value);
    }

    /**
     * push key value to self after value array
     * @param $key
     * @param $value
     */
    public function pushAfter($key, $value)
    {
        if(!isset(self::$after[$key])){
            self::$after[$key] = [];
        }
        array_push(self::$after[$key],$value);
    }

    /**
     * save action log to DB
     * @param $page
     * @param $action
     * @param $update_member_id
     */
    public function save($page,$action,$remark,$object = null,$target_id = null)
    {
        system_log::create([
            'page' => $page,
            'target_id' => ($target_id != null) ? $target_id : $object->id,
            'before' => ($object != null) ? json_encode($object->getOriginal()) : json_encode(self::$before),
            'after' => ($object != null) ? json_encode($object) : json_encode(self::$after),
            'action' => $action,
            'remark' => $remark,
            'update_member_id' => session(env('LOGINSESSION','virtualorz_default'))['login_user']['id']
        ]);
    }

}
