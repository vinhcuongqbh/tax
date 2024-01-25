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
                    <div class="card-header">
                        <div class="row">
                            <div class="col-auto">
                                <a href="{{ route('donvi.create') }}"><button type="button"
                                        class="btn bg-olive text-white w-100 text-nowrap"><span>Tạo mới</span></button></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-default">
                    <div class="card-body">    
                        <table id="donvi-table" class="table table-bordered table-striped">
                            <colgroup>
                                <col style="width:5%;">
                                <col style="width:20%;">
                                <col style="width:30%;">
                                <col style="width:30%;">
                                <col style="width:15%;">
                            </colgroup>
                            <thead style="text-align: center">
                                <tr>
                                    <th>STT</th>
                                    <th>Mã đơn vị</th>
                                    <th>Tên đơn vị</th>
                                    <th>Đơn vị cấp trên</th>
                                    <th>Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($don_vi as $don_vi)
                                    <tr>
                                        <td style="text-align: center">{{ $don_vi->id }}</td>
                                        <td><a href="{{ route('donvi.show', $don_vi->ma_don_vi) }}">{{ $don_vi->ma_don_vi }}</a>
                                        </td>
                                        <td>{{ $don_vi->ten_don_vi }}</td>                                        
                                        <td>{{ $don_vi->ma_don_vi_cap_tren }}</td>                                                                          
                                        <td>
                                            @if ($don_vi->id_trang_thai == 1)
                                                <a class="btn bg-danger text-white w-100 text-nowrap"
                                                    href="{{ route('donvi.delete', $don_vi->ma_don_vi) }}"
                                                    onclick="return confirm('Bạn muốn ẩn đơn vị này?')">
                                                    Ẩn
                                                </a>
                                            @else
                                                <a class="btn bg-olive text-white w-100 text-nowrap"
                                                    href="{{ route('donvi.restore', $donvi->ma_don_vi) }}"
                                                    onclick="return confirm('Bạn muốn phục hồi đơn vị này?')">
                                                    Phục hồi
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
    <!-- DataTables -->
    <link rel="stylesheet" href="/vendor/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/vendor/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="/vendor/datatables-buttons/css/buttons.bootstrap4.min.css">
@stop

@section('js')
    <!-- DataTables  & Plugins -->
    <script src="/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="/vendor/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="/vendor/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/vendor/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="/vendor/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="/vendor/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="/vendor/jszip/jszip.min.js"></script>
    <script src="/vendor/pdfmake/pdfmake.min.js"></script>
    <script src="/vendor/pdfmake/vfs_fonts.js"></script>
    <script src="/vendor/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="/vendor/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="/vendor/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- Page specific script -->
    <script>
        $(function() {
            $("#donvi-table").DataTable({
                "responsive": true,
                "lengthChange": false,
                "pageLength": 25,
                "searching": true,
                "autoWidth": false,
                "ordering": false,
                "buttons": ["copy", "excel", "pdf", "print"],                
            }).buttons().container().appendTo('#donvi-table_wrapper .col-md-6:eq(0)');
        });
    </script>
@stop