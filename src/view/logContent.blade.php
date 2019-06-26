<div class="row">
    <div class="col-xs-12">
        <div class="box box-warning">
            <div class="box-header">
                異動資料 :
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <td>頁面</td>
                        <td>操作</td>
                        <td>動作</td>
                        <td>操作時間</td>
                        <td>操作人員</td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{ $log->page }}</td>
                        <td>{{ $log_action[$log->action] }}</td>
                        <td>{{ $log->remark }}</td>
                        <td>{{ $log->created_at }}</td>
                        <td>{{ session('js_promote.member')[$log->update_member_id]['name'] }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="box-footer">

            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="box box-warning">
            <div class="box-header">
                差異記錄 :
            </div>
            <div class="box-body">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Before </label>
                        <p></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>After</label>
                        <p></p>
                    </div>
                </div>
                <div class="col-md-6">
                    @foreach($log->before as $k=>$v)
                        <div class="form-group">
                            <label>{{$k}}</label>
                            <p>
                                @foreach($v as $k1=>$v1)
                                    @foreach($v1 as $k2=>$v2)
                                        @if(!is_array($v2))
                                            @if($k2 != 'id' && $k2 != 'created_at' && $k2 != 'updated_at' && $k2 != 'deleted_at')
                                                {{ $k2 }} => <span class="before_{{$k}}_{{$k2}}" style="word-break: break-all;">{{ $v2 }}</span> <br>
                                            @endif
                                        @else
                                            @foreach($v2 as $k3=>$v3)
                                                @if($k3 != 'id' && $k3 != 'created_at' && $k3 != 'updated_at' && $k3 != 'deleted_at' && !is_array($v3))
                                                    {{ $k3 }} => <span class="before_{{$k}}_{{$k3}}" style="word-break: break-all;">{{ $v3 }}</span> <br>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                @endforeach
                            </p>
                        </div>
                    @endforeach
                </div>
                <div class="col-md-6">
                    @foreach($log->after as $k=>$v)
                        <div class="form-group">
                            <label>{{$k}}</label>
                            <p>
                                @foreach($v as $k1=>$v1)
                                    @foreach($v1 as $k2=>$v2)
                                        @if(!is_array($v2))
                                            @if($k2 != 'id' && $k2 != 'created_at' && $k2 != 'updated_at' && $k2 != 'deleted_at')
                                                {{ $k2 }} => <span class="after" data-id="{{$k}}_{{$k2}}" style="word-break: break-all;">{{ $v2 }}</span> <br>
                                            @endif
                                        @else
                                            @foreach($v2 as $k3=>$v3)
                                                @if($k3 != 'id' && $k3 != 'created_at' && $k3 != 'updated_at' && $k3 != 'deleted_at' && !is_array($v3))
                                                    {{ $k3 }} => <span class="after" data-id="{{$k}}_{{$k3}}" style="word-break: break-all;">{{ $v3 }}</span> <br>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                @endforeach
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="box-footer">
                <button type="button" class="btn btn-default btn-back">回上一頁</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $(".after").each(function(){
            var id = $(this).attr('data-id');
            if(typeof $(".before_"+id).html() == 'nudefined' || $(this).html() != $(".before_"+id).html()){
                $(this).css('color','red');
            }
        })
    });

</script>
