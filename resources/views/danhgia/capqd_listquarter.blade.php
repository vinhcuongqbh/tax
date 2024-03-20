@extends('dashboard')

@section('title', 'Danh sách Phiếu đánh giá')

@section('heading')
    Hội đồng TĐKT / Cấp có thẩm quyền quyết định
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-default">
                    <div class="card-body">
                        <table id="table" class="table table-bordered table-striped">
                            <colgroup>
                                <col style="width:5%;">
                                <col style="width:15%;">
                                <col style="width:10%;">
                                <col style="width:15%;">
                                <col style="width:15%;">
                                <col style="width:10%;">
                                <col style="width:10%;">
                                <col style="width:10%;">
                                <col style="width:10%;">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th class="text-center align-middle">STT</th>
                                    <th class="text-center align-middle">Họ và tên</th>
                                    <th class="text-center align-middle">Chức vụ</th>
                                    <th class="text-center align-middle">Phòng/Đội</th>
                                    <th class="text-center align-middle">Đơn vị</th>
                                    <th class="text-center align-middle">Tháng
                                        {{ substr($thang[0], 4, 2) }}/{{ substr($thang[0], 0, 4) }}</th>
                                    <th class="text-center align-middle">Tháng
                                        {{ substr($thang[1], 4, 2) }}/{{ substr($thang[1], 0, 4) }}</th>
                                    <th class="text-center align-middle">Tháng
                                        {{ substr($thang[2], 4, 2) }}/{{ substr($thang[2], 0, 4) }}</th>
                                    <th class="text-center align-middle">Kết quả xếp loại Quý</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @if (isset($danh_sach))
                                    @foreach ($danh_sach as $ds)
                                        <tr>
                                            <td class="text-center">{{ $i++ }}</td>
                                            <td>{{ $ds['name'] }}</a></td>
                                            <td class="text-center">{{ $ds['ten_chuc_vu'] }}</td>
                                            <td class="text-center">{{ $ds['ten_phong'] }}</td>
                                            <td class="text-center">{{ $ds['ten_don_vi'] }}</td>
                                            <td class="text-center">{{ $ds['xep_loai_1'] }}</td>
                                            <td class="text-center">{{ $ds['xep_loai_2'] }}</td>
                                            <td class="text-center">{{ $ds['xep_loai_3'] }}</td>
                                            <td class="text-center">{{ $ds['ket_qua_xep_loai'] }}</td>
                                        </tr>
                                    @endforeach
                                @endif
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
                lengthChange: false,
                searching: true,
                autoWidth: false,
                ordering: false,
                paging: false,
                scrollCollapse: true,
                scrollX: true,
                scrollY: 1000,
                dom: 'Bfrtip',
                buttons: [{
                        text: 'Phê duyệt',
                        className: 'bg-olive',
                        action: function(e, dt, node, config) {
                            window.location = '{{ route('phieudanhgia.capqd.approve') }}';
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
