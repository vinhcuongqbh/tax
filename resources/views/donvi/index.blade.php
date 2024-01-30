@extends('dashboard')

@section('title', 'Danh mục Đơn vị')

@section('heading')
    Danh mục Đơn vị
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-default">
                    {{-- <div class="card-header">
                        <div class="row">
                            <div class="col-auto">
                                <a href="{{ route('donvi.create') }}"><button type="button"
                                        class="btn bg-olive text-white w-100 text-nowrap"><span>Tạo mới</span></button></a>
                            </div>
                        </div>
                    </div> --}}
                    <div class="card-body">
                        <table id="donvi-table" class="table table-bordered table-striped">
                            <colgroup>
                                <col style="width:5%;">
                                <col style="width:10%;">
                                <col style="width:35%;">
                                <col style="width:40%;">
                                <col style="width:10%;">
                            </colgroup>
                            <thead style="text-align: center">
                                <tr>
                                    <th>STT</th>
                                    <th>Mã đơn vị</th>
                                    <th>Tên đơn vị</th>
                                    <th>Đơn vị cấp trên</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($don_vi as $don_vi)
                                    <tr>
                                        <td class="text-center">{{ $don_vi->id }}</td>
                                        <td class="text-center">{{ $don_vi->ma_don_vi }}</td>
                                        <td><a
                                                href="{{ route('donvi.show', $don_vi->ma_don_vi) }}">{{ $don_vi->ten_don_vi }}</a>
                                        </td>
                                        <td>{{ $don_vi->ten_don_vi_cap_tren }}</td>
                                        <td>
                                            @if ($don_vi->id_trang_thai == 1)
                                                <a class="btn bg-danger text-white w-100 text-nowrap"
                                                    href="{{ route('donvi.delete', $don_vi->ma_don_vi) }}"
                                                    onclick="return confirm('Bạn muốn ẩn đơn vị này?')">
                                                    Khóa
                                                </a>
                                            @else
                                                <a class="btn bg-olive text-white w-100 text-nowrap"
                                                    href="{{ route('donvi.restore', $don_vi->ma_don_vi) }}"
                                                    onclick="return confirm('Bạn muốn phục hồi đơn vị này?')">
                                                    Mở
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
@stop

@section('css')
@stop

@section('js')
    <!-- Page specific script -->
    <script>
        $(function() {
            $("#donvi-table").DataTable({
                responsive: true,
                lengthChange: false,
                pageLength: 25,
                searching: true,
                autoWidth: false,
                ordering: false,
                dom: 'Bfrtip',
                buttons: [{
                        text: 'Tạo mới',
                        className: 'bg-olive',
                        action: function(e, dt, node, config) {
                            window.location = '{{ route('donvi.create') }}';
                        },
                    },
                    {
                        extend: 'spacer',
                        style: 'bar',
                        text: 'Xuất:'
                    },
                    'csv',
                    'excel',
                    'pdf'


                    // {
                    //     text: 'Xuất Excel',
                    //     className: 'btn',
                    //     extend: 'excelHtml5',
                    // }
                ],
                language: {
                    url: '/plugins/datatables/vi.json'
                },
            }).buttons().container().appendTo('#donvi-table_wrapper .col-md-6:eq(0)');
        });
    </script>
@stop
