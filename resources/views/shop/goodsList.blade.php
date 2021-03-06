@extends('admin.layouts')

@section('css')
    <link href="/assets/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet" type="text/css" />
    <style>
        .fancybox > img {
            width: 75px;
            height: 75px;
        }
    </style>
@endsection
@section('title', '控制面板')
@section('content')
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE BREADCRUMB -->
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="{{url('shop/goodsList')}}">商品管理</a>
                <i class="fa fa-circle"></i>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMB -->
        <!-- BEGIN PAGE BASE CONTENT -->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-dark">
                            <i class="icon-list font-dark"></i>
                            <span class="caption-subject bold uppercase"> 商品列表 </span>
                        </div>
                        <div class="actions">
                            <div class="btn-group">
                                <button class="btn sbold blue" onclick="addGoods()"> 新增
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-scrollable">
                            <table class="table table-striped table-bordered table-hover table-checkable order-column">
                                <thead>
                                <tr>
                                    <th> ID </th>
                                    <th> 名称 </th>
                                    <th> 图片 </th>
                                    <th> 内含流量 </th>
                                    <th> 售价 </th>
                                    <th> 所需积分 </th>
                                    <th> 状态 </th>
                                    <th> 操作 </th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($goodsList->isEmpty())
                                    <tr>
                                        <td colspan="8">暂无数据</td>
                                    </tr>
                                @else
                                    @foreach($goodsList as $goods)
                                        <tr class="odd gradeX">
                                            <td> {{$goods->id}} </td>
                                            <td> {{$goods->name}} </td>
                                            <td> @if($goods->logo) <a href="{{$goods->logo}}" class="fancybox"><img src="{{$goods->logo}}"/></a> @endif </td>
                                            <td> {{$goods->traffic}} </td>
                                            <td> <span class="label label-danger">{{$goods->price}}元</span> </td>
                                            <td> <span class="label label-danger">{{$goods->score}}</span> </td>
                                            <td> <span class="label label-danger">{{$goods->status ? '下架' : '上架'}}</span> </td>
                                            <td>
                                                <button type="button" class="btn btn-sm blue btn-outline" onclick="editGoods('{{$goods->id}}')">编辑</button>
                                                <button type="button" class="btn btn-sm red btn-outline" onclick="delGoods('{{$goods->id}}')">删除</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-5 col-sm-5">
                                <div class="dataTables_info" role="status" aria-live="polite">共 {{$goodsList->total()}} 个商品</div>
                            </div>
                            <div class="col-md-7 col-sm-7">
                                <div class="dataTables_paginate paging_bootstrap_full_number pull-right">
                                    {{ $goodsList->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
        <!-- END PAGE BASE CONTENT -->
    </div>
    <!-- END CONTENT BODY -->
@endsection
@section('script')
    <script src="/assets/global/plugins/bootbox/bootbox.min.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/fancybox/source/jquery.fancybox.js" type="text/javascript"></script>

    <script type="text/javascript">
        function addGoods() {
            window.location.href = '{{url('shop/addGoods')}}';
        }

        // 编辑商品
        function editGoods(id) {
            window.location.href = '{{url('shop/editGoods?id=')}}' + id;
        }

        // 删除商品
        function delGoods(id) {
            bootbox.confirm({
                message: "确定删除该商品？",
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
                        $.post("{{url('shop/delGoods')}}", {id:id, _token:'{{csrf_token()}}'}, function(ret){
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

        // 查看商品图片
        $(document).ready(function () {
            $('.fancybox').fancybox({
                openEffect: 'elastic',
                closeEffect: 'elastic'
            })
        })
    </script>
@endsection
