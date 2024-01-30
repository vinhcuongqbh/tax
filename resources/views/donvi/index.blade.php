@extends('dashboard')

@section('title', 'Danh mục Đơn vị')

@section('heading')
    Danh mục Đơn vị
@stop

@section('content')
    @if (session()->has('message'))
        <script>
            Swal.fire({
                icon: 'success',
                text: `{{ session()->get('message') }}`,
                showConfirmButton: false,
                timer: 2000
            })
        </script>
    @endif
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
                        <table id="donvi-table" class="table table-bordered table-striped table-responsive">
                            <colgroup>
                                <col style="width:5%;">
                                <col style="width:15%;">
                                <col style="width:35%;">
                                <col style="width:40%;">
                                <col style="width:5%;">
                            </colgroup>
                            <thead style="text-align: center">
                                <tr>
                                    <th class="text-center">STT</th>
                                    <th class="text-center">Mã đơn vị</th>
                                    <th class="text-center">Tên đơn vị</th>
                                    <th class="text-center">Đơn vị cấp trên</th>
                                    <th class="text-center">Mở/Khóa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($don_vi as $don_vi)
                                    <tr>
                                        <td class="text-center" data-title="STT">{{ $don_vi->id }}</td>
                                        <td class="text-center" data-title="Mã đơn vị">{{ $don_vi->ma_don_vi }}</td>
                                        <td data-title="Tên đơn vị"><a
                                                href="{{ route('donvi.edit', $don_vi->ma_don_vi) }}">{{ $don_vi->ten_don_vi }}</a>
                                        </td>
                                        <td data-title="Đơn vị cấp trên">{{ $don_vi->ten_don_vi_cap_tren }}</td>
                                        <td class="text-center" data-title="Mở/Khóa">
                                            @if ($don_vi->id_trang_thai == 1)
                                                <a class="btn bg-danger text-white text-nowrap w-100"
                                                    href="{{ route('donvi.delete', $don_vi->ma_don_vi) }}">
                                                    Khóa
                                                </a>
                                            @else
                                                <a class="btn bg-olive text-white text-nowrap w-100"
                                                    href="{{ route('donvi.restore', $don_vi->ma_don_vi) }}">
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
    <!-- Datatable -->
    <script>
        $(function() {
            $("#donvi-table").DataTable({
                responsive: {
                    details: {
                        display: DataTable.Responsive.display.modal({
                            header: function(row) {
                                var data = row.data();
                                return data[2];
                            }
                        }),
                        renderer: DataTable.Responsive.renderer.tableAll({
                            tableClass: 'table'
                        })
                    }
                },
                rowReorder: {
                    selector: 'td:nth-child(2)'
                },
                lengthChange: false,
                pageLength: 25,
                searching: true,
                autoWidth: false,
                //ordering: false,
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
                    //'csv',
                    'excel',
                    'pdf',
                ],
                language: {
                    url: '/plugins/datatables/vi.json'
                },
            }).buttons().container().appendTo('#donvi-table_wrapper .col-md-6:eq(0)');
        });
    </script>
@stop
