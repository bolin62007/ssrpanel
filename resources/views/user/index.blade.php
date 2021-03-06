@extends('user.layouts')

@section('css')
    <style type="text/css">
        .ticker {
            background-color: #fff;
            margin-bottom: 20px;
            border: 1px solid #e7ecf1!important;
            border-radius: 4px;
            -webkit-border-radius: 4px;
        }
        .ticker ul {
            padding: 0;
        }
        .ticker li {
            list-style: none;
            padding: 15px;
        }
    </style>

    <style type="text/css">
        #lottery{width:574px;height:584px;margin:20px auto;background:url(/assets/images/bg.jpg) no-repeat;padding:50px 55px;}
        #lottery table td{width:142px;height:142px;text-align:center;vertical-align:middle;font-size:24px;color:#333;font-index:-999}
        #lottery table td a{width:284px;height:284px;line-height:150px;display:block;text-decoration:none;}
        #lottery table td.active{background-color:#ea0000;}

    </style>


@endsection
@section('title', '控制面板')
@section('content')
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE BASE CONTENT -->
        <div class="row">
            <div class="col-md-12">
                <div class="ticker">
                    @if(!$articleList->isEmpty())
                        <ul>
                            @foreach($articleList as $k => $article)
                                <li>
                                    <i class="fa fa-bell-o"></i>
                                    <a href="{{url('user/article?id=') . $article->id}}" class="alert-link" target="_blank"> {{$article->title}} </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
        @if (Session::has('successMsg'))
            <div class="alert alert-success">
                <button class="close" data-close="alert"></button>
                {{Session::get('successMsg')}}
            </div>
        @endif
        <div class="row">
            <div class="col-md-6">
                <!-- BEGIN PORTLET -->
                <div class="portlet light bordered">
                    <div class="portlet-title tabbable-line">
                        <div class="caption caption-md">
                            <i class="icon-globe theme-font hide"></i>
                            <span class="caption-subject font-blue-madison bold uppercase"> 账号信息 </span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="row">
                            <div class="col-md-12">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        等级：普通会员
                                    </li>
                                    <li class="list-group-item">
                                        余额：{{$info['balance']}}
                                        <span class="badge badge-danger"><a href="{{url('user/charge')}}">充值</a></span>
                                    </li>
                                    <li class="list-group-item">
                                        积分：{{$info['score']}}
                                        <span class="badge badge-default"><a href="{{url('user/goodsList')}}">兑换</a></span>
                                    </li>
                                    <li class="list-group-item">
                                        最后登录：{{empty($info['last_login']) ? '未登录' : date('Y-m-d H:i:s', $info['last_login'])}}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <!-- BEGIN PORTLET -->
                <div class="portlet light bordered">
                    <div class="portlet-title tabbable-line">
                        <div class="caption caption-md">
                            <i class="icon-globe theme-font hide"></i>
                            <span class="caption-subject font-blue-madison bold uppercase"> SS(R)信息 </span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="row">
                            <div class="col-md-12">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        端口：{{$info['port']}}
                                    </li>
                                    <li class="list-group-item">
                                        加密方式：{{$info['method']}}
                                        <span class="badge badge-warning"><a href="{{url('user/profile#tab_2')}}">修改</a></span>
                                    </li>
                                    <li class="list-group-item">
                                        连接密码：{{$info['passwd']}}
                                        <span class="badge badge-warning"><a href="{{url('user/profile#tab_2')}}">修改</a></span>
                                    </li>
                                    <li class="list-group-item">
                                        协议：{{$info['protocol']}}
                                        <span class="badge badge-warning"><a href="{{url('user/profile#tab_2')}}">修改</a></span>
                                    </li>
                                    <li class="list-group-item">
                                        混淆：{{$info['obfs']}}
                                        <span class="badge badge-warning"><a href="{{url('user/profile#tab_2')}}">修改</a></span>
                                    </li>
                                    <li class="list-group-item">
                                        最后使用：{{empty($info['t']) ? '未使用' : date('Y-m-d H:i:s', $info['t'])}}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <!-- BEGIN PORTLET -->
                <div class="portlet light bordered">
                    <div class="portlet-title tabbable-line">
                        <div class="caption caption-md">
                            <i class="icon-globe theme-font hide"></i>
                            <span class="caption-subject font-blue-madison bold uppercase"> 快速工单 </span>
                        </div>
                    </div>
                    <div class="portlet-body overflow-h">
                        <input type="text" name="title" id="title" placeholder="标题" class="form-control margin-bottom-20">
                        <textarea name="content" id="content" placeholder="内容" class="form-control margin-bottom-20" rows="4"></textarea>
                        <button class="btn red-sunglo pull-right" type="button" onclick="addTicket()">提交</button>
                    </div>
                </div>
            </div>
            <div class="col-md-6"></div>
        </div>
        <!-- END PAGE BASE CONTENT -->
    </div>
    <!-- END CONTENT BODY -->
@endsection
@section('script')
    <script src="/assets/global/plugins/jquery-knob/js/jquery.knob.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/jquery-easyticker/test/jquery.easing.min.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/jquery-easyticker/jquery.easy-ticker.min.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/bootbox/bootbox.min.js" type="text/javascript"></script>

    <script>
        // 流量饼图
        $(function() {
            $(".knob").knob({
                'readOnly':true,
                'angleoffset':0,
                'width':150,
                'height':150
            });
        });

        // 公告
        $(function(){
            $('.ticker').easyTicker({
                direction: 'up',
                easing: 'easeInOutBack',
                speed: 'slow',
                interval: 2000,
                height: 'auto',
                visible: 1,
                mousePause: 1,
                controls: {
                    up: '.up',
                    down: '.down',
                    toggle: '.toggle',
                    stopText: 'Stop !!!'
                }
            }).data('easyTicker');
        });

        // 提交工单
        function addTicket() {
            var title = $("#title").val();
            var content = $("#content").val();

            if (title == '' || title == undefined) {
                bootbox.alert('工单标题不能为空');
                return false;
            }

            if (content == '' || content == undefined) {
                bootbox.alert('工单内容不能为空');
                return false;
            }

            bootbox.confirm({
                message: "确定提交工单？",
                buttons: {
                    confirm: {
                        label: '确定',
                        className: 'btn-success'
                    },
                    cancel: {
                        label: '取消',
                        className: 'btn-danger'
                    }
                },
                callback: function (result) {
                    if (result) {
                        $.post("{{url('user/addTicket')}}", {_token:'{{csrf_token()}}', title:title, content:content}, function(ret){
                            if (ret.status == 'success') {
                                bootbox.alert(ret.message, function(){
                                    window.location.reload();
                                });
                            } else {
                                bootbox.alert(ret.message);
                            }
                        });
                    }
                }
            });
        }

    </script>
@endsection
