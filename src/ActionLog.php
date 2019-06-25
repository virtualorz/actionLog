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

    /**
     * get log list
     * @param int $page
     * @return log list
     */
    public function logList($page=15){
        $log = system_log::orderBy('created_at','DESC')
            ->paginate(15);

        return $log;
    }

    /**
     * get log content
     * @param $id
     * @return log content
     */
    public function logContent($id){
        $log = system_log::findOrFail($id);

        $log->before = json_decode($log->before,true);
        $log->after = json_decode($log->after,true);


        if(!is_array($log->before[array_key_first($log->before)])){
            $tmp_1 = [];
            $tmp_2 = [];
            $tmp_3 = [];

            array_push($tmp_1,$log->before);
            array_push($tmp_2,$tmp_1);
            array_push($tmp_3,$tmp_2);
            $log->before = $tmp_2;
        }


        if(!is_array($log->after[array_key_first($log->after)])){
            $tmp_1 = [];
            $tmp_2 = [];
            $tmp_3 = [];

            array_push($tmp_1,$log->after);
            array_push($tmp_2,$tmp_1);
            array_push($tmp_3,$tmp_2);
            $log->after = $tmp_3;
        }

        return $log;
    }

}
