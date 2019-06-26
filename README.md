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

###### pushBefore
`add before value to object manual`

###### pushAfter
`add after value to object manual`

###### save
`$page as page name ,$action as action type ,$remark as remark text,$object = null as model object ,$target_id = null as modify target id`
`save the model object before after value to database`

###### logList($page=15)
`return the log list result paginate by $page`

###### logContent($id)
`return the content HTML of log id=$id , you can use {!! $RESULT_HTML !!} in blade to show the log content`

# Example for manual add value
    ActionLog::pushBefore('system_permission', system_permission::where('member_id', $request->get('id'))->get());
    ...
    //do some thing
    ...
    ActionLog::pushAfter('system_permission', system_permission::where('member_id', $request->get('id'))->get());
    
    ActionLog::save(Route::getCurrentRoute()->action['parent'],0,'remark text',null,$request->get('id'));

# Example for save model value
    ActionLog::save(Route::getCurrentRoute()->action['parent'],2,'remark text',$system_permission);
   
