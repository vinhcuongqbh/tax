@extends('dashboard')

@section('title', 'Tạo mới Đánh giá, xếp loại')

@section('heading')
    Tạo mới Đánh giá, xếp loại
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
                        <table id="table" class="table table-bordered table-striped">
                            <colgroup>
                                <col style="width:5%;">
                                <col style="width:65%;">
                                <col style="width:10%;">
                                <col style="width:10%;">
                                <col style="width:10%;">
                            </colgroup>
                            <thead style="text-align: center">
                                <tr>
                                    <th class="text-center">STT</th>
                                    <th class="text-center">Nội dung đánh giá</th>
                                    <th class="text-center">Điểm tối đa</th>
                                    <th class="text-center">Điểm cá nhân tự chấm</th>
                                    <th class="text-center">Cấp có thẩm quyền đánh giá</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mau_danh_gia as $mau_danh_gia)
                                    <tr>
                                        <td
                                            class="text-center
                                        @if ($mau_danh_gia->loai_tieu_chi != 'cham_diem' && $mau_danh_gia->loai_tieu_chi != 'phuong_an') text-bold @endif">
                                            {{ $mau_danh_gia->tt }}</td>
                                        <td
                                            class="text-justify 
                                            @if ($mau_danh_gia->loai_tieu_chi != 'cham_diem' && $mau_danh_gia->loai_tieu_chi != 'phuong_an') text-bold @endif">
                                            {{ $mau_danh_gia->noi_dung }}</td>
                                        <td class="text-center pt-3 @if ($mau_danh_gia->loai_tieu_chi != 'cham_diem' && $mau_danh_gia->loai_tieu_chi != 'phuong_an') text-bold @endif">
                                            {{ $mau_danh_gia->diem_toi_da }}</td>
                                        <td class="text-center">
                                            <input type="number" id="{{ $mau_danh_gia->ma_tieu_chi }}"
                                                name="{{ $mau_danh_gia->ma_tieu_chi }}" min="0"
                                                max="{{ $mau_danh_gia->diem_toi_da }}"
                                                value="{{ $mau_danh_gia->diem_toi_da }}"
                                                @if ($mau_danh_gia->loai_tieu_chi != 'cham_diem' && $mau_danh_gia->loai_tieu_chi != 'phuong_an') disabled @endif class="form-control">
                                        </td>
                                        <td>
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
@stop
