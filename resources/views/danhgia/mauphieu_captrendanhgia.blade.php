@extends('dashboard')

@section('title', 'Cấp trên Đánh giá, xếp loại')

@section('heading')
    Cấp trên Đánh giá, xếp loại
@stop

@section('content')
    @if (session()->has('msg_success'))
        <script>
            Swal.fire({
                icon: 'success',
                text: `{{ session()->get('msg_success') }}`,
                showConfirmButton: false,
                timer: 3000
            })
        </script>
    @elseif (session()->has('msg_error'))
        <script>
            Swal.fire({
                icon: 'error',
                text: `{{ session()->get('msg_error') }}`,
                showConfirmButton: false,
                timer: 3000
            })
        </script>
    @endif
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <form action="/phieudanhgia/store" method="post" id="maudanhgia-captrendanhgia">
                    @csrf
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
                                <h6 class="font-italic text-bold text-right">{{ $ten_mau }}</h6>
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
                            <h6 class="text-center font-italic my-0">(Áp dụng đối với {{ $doi_tuong_ap_dung }})
                            </h6>
                            <h6 class="text-center align-middle my-0">Tháng
                                {{ substr($mau_phieu_danh_gia->thoi_diem_danh_gia, 4, 2) }}/{{ substr($mau_phieu_danh_gia->thoi_diem_danh_gia, 0, 4) }}
                            </h6>
                            <br>
                            <h6>&emsp;&emsp;&emsp;- Họ và tên: {{ $mau_phieu_danh_gia->name }}</h6>
                            @if ($mau_phieu_danh_gia->mau_phieu_danh_gia == 'mau01A')
                                <h6>&emsp;&emsp;&emsp;- Chức vụ: {{ $mau_phieu_danh_gia->ten_chuc_vu }}</h6>
                            @endif
                            <h6>&emsp;&emsp;&emsp;- Đơn vị: {{ $mau_phieu_danh_gia->ten_don_vi }}</h6>
                            <br>
                            <h6 class="text-bold">&emsp;&emsp;&emsp;A. Điểm đánh giá</h6>

                            <table id="danh-gia" class="table table-bordered">
                                <colgroup>
                                    <col style="width:4%;">
                                    <col style="width:60%;">
                                    <col style="width:12%;">
                                    <col style="width:12%;">
                                    <col style="width:12%;">
                                </colgroup>
                                <thead class="text-center">
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
                                    @foreach ($ket_qua_muc_A as $ket_qua_muc_A)
                                        @php
                                            if (
                                                $ket_qua_muc_A->loai_tieu_chi == 'muc_lon' ||
                                                $ket_qua_muc_A->loai_tieu_chi == 'muc_nho' ||
                                                $ket_qua_muc_A->loai_tieu_chi == 'lua_chon' ||
                                                $ket_qua_muc_A->loai_tieu_chi == 'tong_diem' ||
                                                $ket_qua_muc_A->loai_tieu_chi == 'cong'
                                            ) {
                                                $tinh_diem = 0;
                                            } else {
                                                $tinh_diem = 1;
                                            }
                                        @endphp
                                        <tr>
                                            <td class="text-center @if ($tinh_diem == 0) text-bold @endif">
                                                {{ $ket_qua_muc_A->tt }}
                                            </td>
                                            <td class="text-justify @if ($tinh_diem == 0) text-bold @endif">
                                                {{ $ket_qua_muc_A->noi_dung }}
                                            </td>
                                            <td
                                                class="text-center align-middle @if ($tinh_diem == 0) text-bold @endif">
                                                {{ $ket_qua_muc_A->diem_toi_da }}
                                            </td>
                                            <td
                                                class="text-center align-middle @if ($tinh_diem == 0) text-bold @endif">
                                                {{ $ket_qua_muc_A->diem_tu_cham }}
                                            </td>
                                            @if ($ket_qua_muc_A->loai_tieu_chi == 'phuong_an')
                                                <td class="align-middle text-center">
                                                    <input class="m-0" type="radio"
                                                        name="{{ $ket_qua_muc_A->tieu_chi_me }}"
                                                        value="{{ $ket_qua_muc_A->diem_tu_cham }}"
                                                        id="{{ $ket_qua_muc_A->ma_tieu_chi }}"
                                                        @if ($ket_qua_muc_A->diem_toi_da == 50) checked @endif
                                                        onchange="tong_{{ $ket_qua_muc_A->tieu_chi_me }}(); tong_100(); tong_200(); tong_300(); tong_cong(); tu_xep_loai()"></label>
                                                </td>
                                            @else
                                                <td class="align-middle @if ($tinh_diem == 0) text-bold @endif">
                                                    <input type="number" id="{{ $ket_qua_muc_A->ma_tieu_chi }}"
                                                        name="{{ $ket_qua_muc_A->ma_tieu_chi }}" min="0"
                                                        max="{{ $ket_qua_muc_A->diem_toi_da }}"
                                                        value="{{ $ket_qua_muc_A->diem_tu_cham; }}"
                                                        class="text-center form-control pl-4"
                                                        @if ($tinh_diem == 0) readonly @endif
                                                        onchange="tong_{{ $ket_qua_muc_A->tieu_chi_me }}(); tong_100(); tong_200(); tong_300(); tong_cong(); tu_xep_loai()">
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td></td>
                                        <td class="align-middle text-bold">TỔNG CỘNG</td>
                                        <td></td>
                                        <td class="align-middle text-center text-bold display-4 p-0"
                                            id="tong_diem_tu_danh_gia">{{ $mau_phieu_danh_gia->tong_diem_tu_cham }}
                                        </td>
                                        <td class="align-middle text-center text-bold display-4 p-0" id="tong_cong">
                                            {{ $mau_phieu_danh_gia->tong_diem_tu_cham }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <br>
                        <h6 class="text-bold">&emsp;&emsp;&emsp;B. Số liệu thống kê kết quả thực hiện nhiệm vụ</h6>
                        <h6>&emsp;&emsp;&emsp;- Nhiệm vụ theo chương trình, kế hoạch và nhiệm vụ phát sinh:
                            <i>(Thống kê
                                các
                                nhiệm vụ và đánh dấu X vào một trong 4 ô sau cùng tương ứng)</i>
                        </h6>
                        <table id="nhiem-vu" class="table table-bordered">
                            <colgroup>
                                <col style="width:5%;">
                                <col style="width:45%;">
                                <col style="width:10%;">
                                <col style="width:10%;">
                                <col style="width:10%;">
                                <col style="width:10%;">
                                <col style="width:10%;">
                            </colgroup>
                            <thead>
                                <tr class="text-center">
                                    <th class="align-middle text-bold">TT</th>
                                    <th class="align-middle text-bold">Nhiệm vụ</th>
                                    <th class="align-middle text-bold">Nhiệm vụ phát sinh (đánh dấu x)</th>
                                    <th class="align-middle text-bold">Trước hạn</th>
                                    <th class="align-middle text-bold">Đúng hạn</th>
                                    <th class="align-middle text-bold">Quá hạn</th>
                                    <th class="align-middle text-bold">Lùi, chưa triển khai</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ket_qua_muc_B as $ket_qua_muc_B)
                                    <tr>
                                        <td>+</td>
                                        <td class="text-justify">
                                            <p>{{ $ket_qua_muc_B->noi_dung }}</p>
                                        </td>
                                        <td><input type="checkbox" value="1"
                                                @if ($ket_qua_muc_B->nhiem_vu_phat_sinh == 1) checked @endif disabled></td>
                                        <td><input type="radio" value="truoc_han"
                                                @if ($ket_qua_muc_B->hoan_thanh_nhiem_vu == 'truoc_han') checked @else disabled @endif></td>
                                        <td><input type="radio" value="dung_han"
                                                @if ($ket_qua_muc_B->hoan_thanh_nhiem_vu == 'dung_han') checked @else disabled @endif></td>
                                        <td><input type="radio" value="qua_han"
                                                @if ($ket_qua_muc_B->hoan_thanh_nhiem_vu == 'qua_han') checked @else disabled @endif></td>
                                        <td><input type="radio" value="lui_han"
                                                @if ($ket_qua_muc_B->hoan_thanh_nhiem_vu == 'lui_han') checked @else disabled @endif></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <br>
                        <h6>&emsp;&emsp;&emsp;- Các nhiệm vụ có sáng kiến, đổi mới, sáng tạo, mang lại hiệu quả được
                            áp
                            dụng
                            điểm thưởng: <i>(mô tả tóm tắt cách thức, hiệu quả mang lại)</i></h6>
                        <div class="form-group">
                            <textarea class="form-control" id="ly_do_diem_cong" name="ly_do_diem_cong" rows="7" readonly>{{ $ly_do_diem_cong->noi_dung }}</textarea>
                        </div>
                        <h6>&emsp;&emsp;&emsp;- Lý do áp dụng điểm trừ: <i>(mô tả tóm tắt)</i></h6>
                        <div class="form-group">
                            <textarea class="form-control" id="ly_do_diem_tru" name="ly_do_diem_tru" rows="7" readonly>{{ $ly_do_diem_tru->noi_dung }}</textarea>
                        </div>
                        <h6 class="text-bold">&emsp;&emsp;&emsp;C. Cá nhân tự xếp loại: <i>(Chọn 01 trong 04
                                ô tương ứng dưới đây)</i></h6>
                        <table class="table table-borderless">
                            <colgroup>
                                <col style="width:20%;">
                                <col style="width:5%;">
                                <col style="width:20%;">
                                <col style="width:5%;">
                                <col style="width:20%;">
                                <col style="width:5%;">
                                <col style="width:20%;">
                            </colgroup>
                            <tbody>
                                <tr>
                                    <td class="text-center">
                                        <input type="radio" name="tu_danh_gia" value="hoan_thanh_xuat_sac"
                                            id="hoan_thanh_xuat_sac" class="form-control"
                                            @if ($mau_phieu_danh_gia->ca_nhan_tu_xep_loai == 'hoan_thanh_xuat_sac') checked @else disabled @endif>
                                        <b>Hoàn thành suất sắc <br>nhiệm vụ<br>(Loại A)</b><br>92 điểm trở lên
                                    </td>
                                    <td></td>
                                    <td class="text-center">
                                        <input type="radio" name="tu_danh_gia" value="hoan_thanh_tot"
                                            id="hoan_thanh_tot" class="form-control"
                                            @if ($mau_phieu_danh_gia->ca_nhan_tu_xep_loai == 'hoan_thanh_tot') checked @else disabled @endif>
                                        <b>Hoàn thành tốt <br>nhiệm vụ<br>(Loại B)</b><br>Từ 71 điểm đến 91
                                        điểm
                                    </td>
                                    <td></td>
                                    <td class="text-center">
                                        <input type="radio" name="tu_danh_gia" value="hoan_thanh" id="hoan_thanh"
                                            class="form-control"
                                            @if ($mau_phieu_danh_gia->ca_nhan_tu_xep_loai == 'hoan_thanh') checked @else disabled @endif>
                                        <b>Hoàn thành <br>nhiệm vụ<br>(Loại C)</b><br>Từ 51 điểm đến 70 điểm
                                    </td>
                                    <td></td>
                                    <td class="text-center">
                                        <input type="radio" name="tu_danh_gia" value="khong_hoan_thanh"
                                            id="khong_hoan_thanh" class="form-control"
                                            @if ($mau_phieu_danh_gia->ca_nhan_tu_xep_loai == 'khong_hoan_thanh') checked @else disabled @endif>
                                        <b>Không hoàn thành <br>nhiệm vụ<br>(Loại D)</b><br>Từ 50 điểm trở
                                        xuống
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                            <br>
                            <table class="table table-borderless">
                                <colgroup>
                                    <col style="width:40%;">
                                    <col style="width:20%;">
                                    <col style="width:40%;">
                                </colgroup>
                                <tbody>
                                    <tr>
                                        <td class="py-0"></td>
                                        <td class="py-0"></td>
                                        <td class="text-center font-italic py-0">Ngày {{ $date->day }} tháng
                                            {{ $date->month }} năm {{ $date->year }} </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center text-bold py-0">LÃNH ĐẠO ĐƠN VỊ</td>
                                        <td class="py-0"></td>
                                        <td class="text-center text-bold py-0">
                                            NGƯỜI TỰ ĐÁNH GIÁ
                                            <br><br><br><br><br>
                                            {{ $mau_phieu_danh_gia->name }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <br>
                        </div>
                    </div>
                    <!-- /.card -->
                    <div class="text-right">
                        <button type="submit" class="btn bg-olive text-nowrap mb-2 col-1" id="submitForm">ĐÁNH
                            GIÁ</button>
                    </div>
                    <input type="hidden" name="mau_phieu_danh_gia"
                        value="{{ $mau_phieu_danh_gia->ma_phieu_danh_gia }}">
                </form>
                <!-- /.card-body -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
@stop

@section('css')
    <style>
        table.dataTable tbody tr.selected>* {
            box-shadow: inset 0 0 0 9999px rgb(184, 184, 184) !important;
        }
    </style>
@stop

@section('js')
    <!-- jquery-validation -->
    <script src="/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="/plugins/jquery-validation/additional-methods.min.js"></script>
    <script>
        $(function() {
            $('#maudanhgia-captrendanhgia').validate({
                rules: {
                    @php
                        foreach ($so_tieu_chi as $so_tieu_chi) {
                            echo '
                            ' .
                                $so_tieu_chi->ma_tieu_chi .
                                ': 
                            {
                                required: true,
                                min: 0,
                                max: ' .
                                $so_tieu_chi->diem_toi_da .
                                '
                            },';
                        }
                    @endphp
                },
                messages: {
                    @php
                        foreach ($so_tieu_chi_2 as $so_tieu_chi_2) {
                            echo '
                            ' .
                                $so_tieu_chi_2->ma_tieu_chi .
                                ': 
                            {
                                required: true,
                                min: "Không nhập số âm",
                                max: "Lớn hơn điểm tối đa",
                            },';
                        }
                    @endphp
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.align-middle').append(error);

                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
    <script>
        function tong_tc_110() {
            let tieu_chi_110 = parseInt(document.getElementById("tc_110").value);
            let tieu_chi_111 = parseInt(document.getElementById("tc_111").value);
            let tieu_chi_112 = parseInt(document.getElementById("tc_112").value);
            let tieu_chi_113 = parseInt(document.getElementById("tc_113").value);
            let tieu_chi_114 = parseInt(document.getElementById("tc_114").value);
            tieu_chi_110 = tieu_chi_111 + tieu_chi_112 + tieu_chi_113 + tieu_chi_114;
            document.getElementById("tc_110").value = tieu_chi_110;
        }

        function tong_tc_130() {
            let tieu_chi_130 = parseInt(document.getElementById("tc_130").value);
            let tieu_chi_131 = parseInt(document.getElementById("tc_131").value);
            let tieu_chi_132 = parseInt(document.getElementById("tc_132").value);
            let tieu_chi_133 = parseInt(document.getElementById("tc_133").value);
            let tieu_chi_134 = parseInt(document.getElementById("tc_134").value);
            tieu_chi_130 = tieu_chi_131 + tieu_chi_132 + tieu_chi_133 + tieu_chi_134;
            document.getElementById("tc_130").value = tieu_chi_130;
        }

        function tong_tc_150() {
            let tieu_chi_150 = parseInt(document.getElementById("tc_150").value);
            let tieu_chi_151 = parseInt(document.getElementById("tc_151").value);
            let tieu_chi_152 = parseInt(document.getElementById("tc_152").value);
            let tieu_chi_153 = parseInt(document.getElementById("tc_153").value);
            let tieu_chi_154 = parseInt(document.getElementById("tc_154").value);
            tieu_chi_150 = tieu_chi_151 + tieu_chi_152 + tieu_chi_153 + tieu_chi_154;
            document.getElementById("tc_150").value = tieu_chi_150;

        }

        function tong_tc_170() {
            let tieu_chi_170 = parseInt(document.getElementById("tc_170").value);
            let tieu_chi_171 = parseInt(document.getElementById("tc_171").value);
            let tieu_chi_172 = parseInt(document.getElementById("tc_172").value);
            let tieu_chi_173 = parseInt(document.getElementById("tc_173").value);
            tieu_chi_170 = tieu_chi_171 + tieu_chi_172 + tieu_chi_173;
            document.getElementById("tc_170").value = tieu_chi_170;
        }

        function tong_tc_210() {
            let tieu_chi_210 = parseInt(document.getElementById("tc_210").value);
            let tieu_chi_211 = parseInt(document.getElementById("tc_211").value);
            let tieu_chi_212 = parseInt(document.getElementById("tc_212").value);
            let tieu_chi_213 = parseInt(document.getElementById("tc_213").value);
            let tieu_chi_214 = parseInt(document.getElementById("tc_214").value);
            let tieu_chi_215 = parseInt(document.getElementById("tc_215").value);
            let tieu_chi_216 = parseInt(document.getElementById("tc_216").value);
            let tieu_chi_217 = parseInt(document.getElementById("tc_217").value);
            let tieu_chi_218 = parseInt(document.getElementById("tc_218").value);
            let tieu_chi_219 = parseInt(document.getElementById("tc_219").value);
            let tieu_chi_220 = parseInt(document.getElementById("tc_220").value);
            tieu_chi_210 = tieu_chi_211 + tieu_chi_212 + tieu_chi_213 + tieu_chi_214 + tieu_chi_215 + tieu_chi_216 + tieu_chi_217 + tieu_chi_218 + tieu_chi_219 + tieu_chi_220;
            document.getElementById("tc_210").value = tieu_chi_210;
        }

        function tong_tc_230() {
            var tieu_chi_230 = document.querySelector('input[name="tc_230"]:checked').value;
            document.getElementById("tc_230").value = tieu_chi_230;
        }

        function tong_100() {
            let tieu_chi_100 = parseInt(document.getElementById("tc_100").value);
            let tieu_chi_110 = parseInt(document.getElementById("tc_110").value);
            let tieu_chi_130 = parseInt(document.getElementById("tc_130").value);
            let tieu_chi_150 = parseInt(document.getElementById("tc_150").value);
            let tieu_chi_170 = parseInt(document.getElementById("tc_170").value);
            tieu_chi_100 = tieu_chi_110 + tieu_chi_130 + tieu_chi_150 + tieu_chi_170;
            document.getElementById("tc_100").value = tieu_chi_100;
        }

        function tong_200() {
            let tieu_chi_200 = parseInt(document.getElementById("tc_200").value);
            let tieu_chi_210 = parseInt(document.getElementById("tc_210").value);
            let tieu_chi_230 = parseInt(document.getElementById("tc_230").value);
            tieu_chi_200 = tieu_chi_210 + tieu_chi_230;
            document.getElementById("tc_200").value = tieu_chi_200;
        }

        function tong_300() {
            let tieu_chi_300 = parseInt(document.getElementById("tc_300").value);
            let tieu_chi_100 = parseInt(document.getElementById("tc_100").value);
            let tieu_chi_200 = parseInt(document.getElementById("tc_200").value);
            tieu_chi_300 = tieu_chi_100 + tieu_chi_200;
            document.getElementById("tc_300").value = tieu_chi_300;
        }

        function tong_cong() {
            let tong_cong = parseInt(document.getElementById("tong_cong").value);
            let tieu_chi_300 = parseInt(document.getElementById("tc_300").value);
            let tieu_chi_400 = parseInt(document.getElementById("tc_400").value);
            let tieu_chi_500 = parseInt(document.getElementById("tc_500").value);
            tong_cong = tieu_chi_300 + tieu_chi_400 - tieu_chi_500;
            document.getElementById("tong_cong").innerHTML = tong_cong;
        }

        function tong_() {}
    </script>

    <script>
        $(function() {
            const table = $("#nhiem-vu").DataTable({
                lengthChange: false,
                pageLength: 20,
                searching: false,
                autoWidth: false,
                paging: false,
                ordering: false,
                info: false,
                columnDefs: [
                    // Center align both header and body content of columns 1, 2 & 3
                    {
                        className: "dt-center",
                        targets: [0, 1, 2, 3, 4, 5, 6]
                    }
                ],
            })
            let ma_tieu_chi = 1;

            //Xóa Dòng
            table.on('click', 'tbody tr', (e) => {
                let classList = e.currentTarget.classList;

                table.rows('.selected').nodes().each((row) => row.classList.remove('selected'));
                classList.add('selected');
            });

            document.querySelector('#removeRow').addEventListener('click', function() {
                table.row('.selected').remove().draw(false);
            });

            //Thêm Dòng
            function addNewRow() {
                if (ma_tieu_chi <= 50) {
                    table.row
                        .add([
                            '+',
                            '<textarea class="form-control" id="' + ma_tieu_chi + '_noi_dung_nhiem_vu" name="' +
                            ma_tieu_chi + '_noi_dung_nhiem_vu" rows="2"></textarea>',
                            '<input type="checkbox" name="' + ma_tieu_chi +
                            '_nhiem_vu_phat_sinh" value="1">',
                            '<input type="radio" name="' + ma_tieu_chi +
                            '_hoan_thanh_nhiem_vu" value="truoc_han">',
                            '<input type="radio" name="' + ma_tieu_chi +
                            '_hoan_thanh_nhiem_vu" value="dung_han" checked>',
                            '<input type="radio" name="' + ma_tieu_chi +
                            '_hoan_thanh_nhiem_vu" value="qua_han">',
                            '<input type="radio" name="' + ma_tieu_chi +
                            '_hoan_thanh_nhiem_vu" value="lui_han">',
                        ])
                        .draw(false);
                }
                ma_tieu_chi++;
            };

            document.querySelector('#addRow').addEventListener('click', addNewRow);

            // Automatically add a first row of data
            addNewRow();
        });
    </script>
    <script>
        let diem_tu_cham;
        tu_xep_loai();

        function tu_xep_loai() {
            diem_tu_cham = document.querySelector('#tong_cong').innerHTML;
            if (diem_tu_cham >= {{ $xep_loai[0]['diem_toi_thieu'] }}) {
                document.getElementById("hoan_thanh_xuat_sac").checked = true;
                document.getElementById("hoan_thanh_xuat_sac").disabled = false;
                document.getElementById("hoan_thanh_tot").disabled = true;
                document.getElementById("hoan_thanh").disabled = true;
                document.getElementById("khong_hoan_thanh").disabled = true;
            } else if (diem_tu_cham >= {{ $xep_loai[1]['diem_toi_thieu'] }}) {
                document.getElementById("hoan_thanh_tot").checked = true;
                document.getElementById("hoan_thanh_tot").disabled = false;
                document.getElementById("hoan_thanh_xuat_sac").disabled = true;
                document.getElementById("hoan_thanh").disabled = true;
                document.getElementById("khong_hoan_thanh").disabled = true;
            } else if (diem_tu_cham >= {{ $xep_loai[2]['diem_toi_thieu'] }}) {
                document.getElementById("hoan_thanh").checked = true;
                document.getElementById("hoan_thanh").disabled = false;
                document.getElementById("hoan_thanh_xuat_sac").disabled = true;
                document.getElementById("hoan_thanh_tot").disabled = true;
                document.getElementById("khong_hoan_thanh").disabled = true;
            } else {
                document.getElementById("khong_hoan_thanh").checked = true;
                document.getElementById("khong_hoan_thanh").disabled = false;
                document.getElementById("hoan_thanh_xuat_sac").disabled = true;
                document.getElementById("hoan_thanh_tot").disabled = true;
                document.getElementById("hoan_thanh").disabled = true;
            }
        }
    </script>
@stop
