@extends('cms::layouts.cms')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card card-default card-table">
            <div class="card-body">
                <div id="table1_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                    @include('cms::partials.header')
                    <div class="row mai-datatable-body">
                        <div class="col-sm-12">
                            <table class="table table-striped table-hover no-footer" id="" role="grid" aria-describedby="">
                                <thead>
                                    <tr role="row">
                                        <th>{{ __('ID') }}</th>
                                        <th>{{ __('Name') }}</th>
                                        <th>{{ __('标题') }}</th>
                                        <th>{{ __('描述') }}</th>
                                        <th>{{ __('创建时间') }}</th>
                                        <th>{{ __('操作') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($items as $k=>$item)
                                        <tr role="row" class="row-check {{ $k%2==1?'odd':'even' }}">
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->title['zh-CN']??'' }}</td>
                                            <td>{{ $item->descr['zh-CN']??'' }}</td>
                                            <td>{{ $item->created_at }}</td>
                                            <td>
                                                <div class="btn-group btn-group-sm">
                                                    <a href="{{ route('cms.posts.edit',$item) }}" class="btn btn-secondary">{{ __('编辑') }}</a>
                                                    <a href="#" data-method="DELETE" data-url="{{ route('cms.posts.destroy',$item) }}" class="btn btn-secondary destroy">{{ __('删除') }}</a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row mai-datatable-footer">
                        <div class="col-sm-5">
                            <div class="dataTables_info" id="table1_info" role="status" aria-live="polite">
                                {{ __('总计') }}:{{ $items->total() }}</div>
                        </div>
                        <div class="col-sm-7">
                            <div class="dataTables_paginate paging_simple_numbers" id="table1_paginate">
                                {{ $items->appends(request()->except(['page','_token']))->links('vendor.pagination.bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $("#page-select").val("{{ request()->input('perPage')?:25 }}");
        $("#page-select").change(function() {
            location.href = $("#page-select option:selected").data('url');
        });
        $("input[name='all']").change(function() {
            if ($(this).prop("checked") === true) {
                $("input[name='id[]']").prop("checked", true);
            } else {
                $("input[name='id[]']").prop("checked", false);
            }
        })
        $("input[name='id[]']").change(function() {
            var allSelected = true;
            $("input[name='id[]']").each(function(i) {
                if ($("input[name='id[]']").eq(i).prop("checked") === false) {
                    allSelected = false;
                }
            })
            $("input[name='all']").prop("checked", allSelected);
        });
        $(".row-check td").click(function() {
            var that = $(this).parent("tr");
            that.find("input").prop("checked", !that.find("input").prop("checked"));
        });
    });
</script>
@append
