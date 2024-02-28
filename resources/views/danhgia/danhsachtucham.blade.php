@extends('dashboard')

@section('title', 'Danh sách Phiếu đánh giá')

@section('heading')
    Danh sách Phiếu Đánh giá
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-default">
                    {{-- <div class="card-header">
                        <div class="row">
                            <div class="col-auto">
                                <a href="{{ route('congchuc.create') }}"><button type="button"
                                        class="btn bg-olive text-white w-100 text-nowrap"><span>Tạo mới</span></button></a>
                            </div>
                        </div>
                    </div> --}}
                    <div class="card-body">
                        <table id="table" class="table table-bordered table-striped">
                            <colgroup>
                                <col style="width:5%;">
                                <col style="width:10%;">
                                <col style="width:10%;">
                                <col style="width:15%;">
                                <col style="width:10%;">
                                <col style="width:10%;">
                                <col style="width:10%;">
                                <col style="width:10%;">
                                <col style="width:10%;">
                                <col style="width:10%;">
                            </colgroup>
                            <thead style="text-align: center">
                                <tr>
                                    <th class="text-center">STT</th>
                                    <th class="text-center">Thời điểm đánh giá</th>
                                    <th class="text-center">Mã phiếu đánh giá</th>
                                    <th class="text-center">Họ và tên</th>
                                    <th class="text-center">Chức vụ</th>
                                    <th class="text-center">Phòng/Đội</th>
                                    <th class="text-center">Đơn vị</th>
                                    <th class="text-center">Điểm tự chấm</th>
                                    <th class="text-center">Điểm cấp trên đánh giá</th>
                                    <th class="text-center">Kết quả xếp loại</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach ($danh_sach_tu_cham as $danh_sach_tu_cham)
                                    <tr>
                                        <td class="text-center">{{ $i++ }}</td>
                                        <td class="text-center">@php echo substr($danh_sach_tu_cham->thoi_diem_danh_gia, 4, 2) @endphp/@php
                                        echo substr($danh_sach_tu_cham->thoi_diem_danh_gia, 0, 4); @endphp</td>
                                        <td class="text-center"><a
                                                href="{{ route('danhgia.phieudanhgia.show', $danh_sach_tu_cham->ma_phieu_danh_gia) }}">{{ $danh_sach_tu_cham->ma_phieu_danh_gia }}</a>
                                        </td>
                                        <td>{{ $danh_sach_tu_cham->name }}</td>
                                        <td class="text-center">{{ $danh_sach_tu_cham->ten_chuc_vu }}</td>
                                        <td class="text-center">{{ $danh_sach_tu_cham->ten_phong }}</td>
                                        <td class="text-center">{{ $danh_sach_tu_cham->ten_don_vi }}</td>
                                        <td class="text-center">{{ $danh_sach_tu_cham->tong_diem_tu_cham }}</td>
                                        <td class="text-center">{{ $danh_sach_tu_cham->tong_diem_danh_gia }}</td>
                                        <td class="text-center">{{ $danh_sach_tu_cham->ket_qua_xep_loai }}</td>
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
            $("#table").DataTable({
                // responsive: {
                //     details: {
                //         display: DataTable.Responsive.display.modal({
                //             header: function(row) {
                //                 var data = row.data();
                //                 return data[2];
                //             }
                //         }),
                //         renderer: DataTable.Responsive.renderer.tableAll({
                //             tableClass: 'table'
                //         })
                //     }
                // },
                // rowReorder: {
                //     selector: 'td:nth-child(2)'
                // },
                lengthChange: false,
                pageLength: 20,
                searching: true,
                autoWidth: false,
                dom: 'Bfrtip',
                buttons: [{
                        text: 'Tạo mới',
                        className: 'bg-olive',
                        action: function(e, dt, node, config) {
                            window.location = '{{ route('danhgia.phieudanhgia.create') }}';
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
            }).buttons().container().appendTo('#table_wrapper .col-md-6:eq(0)');
        });
    </script>
@stop
