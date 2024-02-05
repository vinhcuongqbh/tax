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
                        <table class="table table-borderless">
                            <h6 class="font-italic text-bold text-right">Mẫu số 01A</h6>
                            <tbody>
                                <tr>
                                    <td class="text-center py-0">TỔNG CỤC THUẾ</td>
                                    <td class="text-center text-bold py-0">CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</td>
                                </tr>
                                <tr class="px-0">
                                    <td class="text-center text-bold py-0">CỤC <u>THUẾ TỈNH QUẢNG</u> BÌNH</td>
                                    <td class="text-center text-bold py-0"><u>Độc lập - Tự do - Hạnh phúc</u></td>
                                </tr>
                            </tbody>
                        </table>
                        <br>
                        <br>
                        <h4 class="text-center text-bold my-0">PHIẾU ĐÁNH GIÁ, XẾP LOẠI CHẤT LƯỢNG HẰNG THÁNG</h4>
                        <h6 class="text-center font-italic my-0">(Áp dụng đối với công chức giữ chức vụ lãnh đạo, quản lý)
                        </h6>
                        <?php $now = new DateTime(); ?>
                        <h6 class="text-center my-0">Tháng:
                            {{ $thoi_diem_danh_gia->month }}/{{ $thoi_diem_danh_gia->year }}</h6>
                        <br>
                        <h6>&emsp;&emsp;&emsp;- Họ và tên: {{ $user->name }}</h6>
                        <h6>&emsp;&emsp;&emsp;- Chức vụ: {{ $user->ten_chuc_vu }}</h6>
                        <h6>&emsp;&emsp;&emsp;- Đơn vị: {{ $user->ten_don_vi }}</h6>
                        <br>
                        <h6 class="text-bold">&emsp;&emsp;&emsp;A. Điểm đánh giá</h6>

                        <table id="danh-gia" class="table table-bordered">
                            <colgroup>
                                <col style="width:5%;">
                                <col style="width:65%;">
                                <col style="width:10%;">
                                <col style="width:10%;">
                                <col style="width:10%;">
                            </colgroup>
                            <thead style="text-align: center">
                                <tr>
                                    <th class="align-middle" rowspan="2">STT</th>
                                    <th class="align-middle" rowspan="2">Nội dung đánh giá</th>
                                    <th class="align-middle" rowspan="2">Điểm tối đa</th>
                                    <th class="align-middle" colspan="2">Kết quả đánh giá</th>
                                </tr>
                                <tr>
                                    <th class="align-middle">Điểm cá nhân tự chấm</th>
                                    <th class="align-middle">Cấp có thẩm quyền đánh giá</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mau_danh_gias as $mau_danh_gia)
                                    @php
                                        if ($mau_danh_gia->loai_tieu_chi == 'muc_lon' || $mau_danh_gia->loai_tieu_chi == 'muc_nho' || $mau_danh_gia->loai_tieu_chi == 'lua_chon' || $mau_danh_gia->loai_tieu_chi == 'tong_diem' || $mau_danh_gia->loai_tieu_chi == 'cong') {
                                            $tinh_diem = 0;
                                        } else {
                                            $tinh_diem = 1;
                                        }
                                    @endphp
                                    <tr>
                                        <td class="text-center @if ($tinh_diem == 0) text-bold @endif">
                                            {{ $mau_danh_gia->tt }}
                                        </td>
                                        <td class="text-justify @if ($tinh_diem == 0) text-bold @endif">
                                            {{ $mau_danh_gia->noi_dung }}
                                        </td>
                                        <td
                                            class="text-center align-middle @if ($tinh_diem == 0) text-bold @endif">
                                            {{ $mau_danh_gia->diem_toi_da }}
                                        </td>
                                        @if ($mau_danh_gia->loai_tieu_chi == 'phuong_an')
                                            <td class="align-middle text-center">
                                                <input class="m-0" type="radio" name="{{ $mau_danh_gia->tieu_chi_me }}"
                                                    value="{{ $mau_danh_gia->diem_toi_da }}"
                                                    id="{{ $mau_danh_gia->ma_tieu_chi }}"
                                                    @if ($mau_danh_gia->diem_toi_da == 50) checked @endif
                                                    onchange="tong_{{ $mau_danh_gia->tieu_chi_me }}(); tong_100(); tong_200(); tong_300()"></label>
                                            </td>
                                        @else
                                            <td class="align-middle @if ($tinh_diem == 0) text-bold @endif">
                                                <input type="number" id="{{ $mau_danh_gia->ma_tieu_chi }}"
                                                    name="{{ $mau_danh_gia->ma_tieu_chi }}" min="0"
                                                    max="{{ $mau_danh_gia->diem_toi_da }}"
                                                    value="{{ $mau_danh_gia->diem_toi_da }}"
                                                    class="text-center form-control pl-4"
                                                    @if ($tinh_diem == 0) disabled @endif
                                                    onchange="tong_{{ $mau_danh_gia->tieu_chi_me }}(); tong_100(); tong_200(); tong_300()">
                                            </td>
                                        @endif
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
    <script>
        function tong_110() {
            let tieu_chi_110 = parseInt(document.getElementById("110").value);
            let tieu_chi_111 = parseInt(document.getElementById("111").value);
            let tieu_chi_112 = parseInt(document.getElementById("112").value);
            let tieu_chi_113 = parseInt(document.getElementById("113").value);
            let tieu_chi_114 = parseInt(document.getElementById("114").value);
            tieu_chi_110 = tieu_chi_111 + tieu_chi_112 + tieu_chi_113 + tieu_chi_114;
            document.getElementById("110").value = tieu_chi_110;
        }

        function tong_130() {
            let tieu_chi_130 = parseInt(document.getElementById("130").value);
            let tieu_chi_131 = parseInt(document.getElementById("131").value);
            let tieu_chi_132 = parseInt(document.getElementById("132").value);
            let tieu_chi_133 = parseInt(document.getElementById("133").value);
            let tieu_chi_134 = parseInt(document.getElementById("134").value);
            tieu_chi_130 = tieu_chi_131 + tieu_chi_132 + tieu_chi_133 + tieu_chi_134;
            document.getElementById("130").value = tieu_chi_130;
        }

        function tong_150() {
            let tieu_chi_150 = parseInt(document.getElementById("150").value);
            let tieu_chi_151 = parseInt(document.getElementById("151").value);
            let tieu_chi_152 = parseInt(document.getElementById("152").value);
            let tieu_chi_153 = parseInt(document.getElementById("153").value);
            let tieu_chi_154 = parseInt(document.getElementById("154").value);
            tieu_chi_150 = tieu_chi_151 + tieu_chi_152 + tieu_chi_153 + tieu_chi_154;
            document.getElementById("150").value = tieu_chi_150;

        }

        function tong_170() {
            let tieu_chi_170 = parseInt(document.getElementById("170").value);
            let tieu_chi_171 = parseInt(document.getElementById("171").value);
            let tieu_chi_172 = parseInt(document.getElementById("172").value);
            let tieu_chi_173 = parseInt(document.getElementById("173").value);
            tieu_chi_170 = tieu_chi_171 + tieu_chi_172 + tieu_chi_173;
            document.getElementById("170").value = tieu_chi_170;
        }

        function tong_210() {
            let tieu_chi_210 = parseInt(document.getElementById("210").value);
            let tieu_chi_211 = parseInt(document.getElementById("211").value);
            let tieu_chi_212 = parseInt(document.getElementById("212").value);
            let tieu_chi_213 = parseInt(document.getElementById("213").value);
            let tieu_chi_214 = parseInt(document.getElementById("214").value);
            let tieu_chi_215 = parseInt(document.getElementById("215").value);
            let tieu_chi_216 = parseInt(document.getElementById("216").value);
            let tieu_chi_217 = parseInt(document.getElementById("217").value);
            let tieu_chi_218 = parseInt(document.getElementById("218").value);
            let tieu_chi_219 = parseInt(document.getElementById("219").value);
            let tieu_chi_220 = parseInt(document.getElementById("220").value);
            tieu_chi_210 = tieu_chi_211 + tieu_chi_212 + tieu_chi_213 + tieu_chi_214 + tieu_chi_215 + tieu_chi_216 +
                tieu_chi_217 + tieu_chi_218 + tieu_chi_219 + tieu_chi_220;
            document.getElementById("210").value = tieu_chi_210;
        }

        function tong_230() {
            var tieu_chi_230 = document.querySelector('input[name="230"]:checked').value;
            document.getElementById("230").value = tieu_chi_230;
        }

        function tong_100() {
            let tieu_chi_100 = parseInt(document.getElementById("100").value);
            let tieu_chi_110 = parseInt(document.getElementById("110").value);
            let tieu_chi_130 = parseInt(document.getElementById("130").value);
            let tieu_chi_150 = parseInt(document.getElementById("150").value);
            let tieu_chi_170 = parseInt(document.getElementById("170").value);
            tieu_chi_100 = tieu_chi_110 + tieu_chi_130 + tieu_chi_150 + tieu_chi_170;
            document.getElementById("100").value = tieu_chi_100;
        }

        function tong_200() {
            let tieu_chi_200 = parseInt(document.getElementById("200").value);
            let tieu_chi_210 = parseInt(document.getElementById("210").value);
            let tieu_chi_230 = parseInt(document.getElementById("230").value);
            tieu_chi_200 = tieu_chi_210 + tieu_chi_230;
            document.getElementById("200").value = tieu_chi_200;
        }

        function tong_300() {
            let tieu_chi_300 = parseInt(document.getElementById("300").value);
            let tieu_chi_100 = parseInt(document.getElementById("100").value);
            let tieu_chi_200 = parseInt(document.getElementById("200").value);
            tieu_chi_300 = tieu_chi_100 + tieu_chi_200;
            document.getElementById("300").value = tieu_chi_300;
        }
    </script>
@stop
