# Usage
Use for Laravel website to log CRUD befor after value

# Install
    composer require virtualorz/actionLog
    
# Config
edit config/app.php
    
    'providers' => [
        ...
        Virtualorz\ActionLog\ActionLogServiceProvider::class
    ]
    
    'aliases' => [
        ...
        'ActionLog' => Virtualorz\ActionLog\Facades\ActionLog::class,
    ]
   
# Publish data
    php artisan vendor:publish --provider="Virtualorz\ActionLog\ActionLogServiceProvider"
    
# Run Migration
    php artisan migrate --path=/vendor/virtualorz/actionlog/src/migrations
    
# Edit Config
edit config/actionLog_logAction , <br />
for three type to the name you want
    
# Method

###### pushBefore($key, $value)
    add before value to object manual, $key for table name, $value for row value

###### pushAfter($key, $value)
    add after value to object manual, $key for table name, $value for row value

###### save($page,$action,$remark,$object = null,$target_id = null)
    save before after value to database,
    $page for page name,
    $action for action type, the key of log_action,
    $remark for remark text,
    $object = null for model object , if null will get the before and after value add manual
    $target_id = null for modify target id, if null will get the primary if in model object
    save the model object before after value to database

###### logList($page=15)
    return the log list result paginate by $page

###### logContent($id)
    return the content HTML of log id=$id,
    you can use {!! $RESULT_HTML !!} in blade to show the log content
    $RESULT_HTML for logContent() method result

# Example for manual add value
    ActionLog::pushBefore('system_permission', system_permission::where('member_id', $request->get('id'))->get());
    ...
    //do some thing
    ...
    ActionLog::pushAfter('system_permission', system_permission::where('member_id', $request->get('id'))->get());
    
    ActionLog::save(Route::getCurrentRoute()->action['parent'],0,'remark text',null,$request->get('id'));

# Example for save model value
    ActionLog::save(Route::getCurrentRoute()->action['parent'],2,'remark text',$system_permission);
   
