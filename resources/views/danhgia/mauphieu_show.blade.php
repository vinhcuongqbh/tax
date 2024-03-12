@extends('dashboard')

@section('title', 'Kết quả Đánh giá, xếp loại')

@section('heading')
    Kết quả Đánh giá, xếp loại
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
                                        @if ($ket_qua_muc_A->loai_tieu_chi == 'phuong_an')
                                            <td class="align-middle text-center">
                                                <input class="m-0" type="radio"
                                                    value="{{ $ket_qua_muc_A->diem_toi_da }}"
                                                    @if ($ket_qua_muc_A->diem_toi_da == $ket_qua_muc_A->where('ma_tieu_chi', 'tc_230')->first()->diem_tu_cham) checked @else disabled @endif></label>
                                            </td>
                                        @else
                                            <td
                                                class="text-center align-middle @if ($tinh_diem == 0) text-bold @endif">
                                                {{ $ket_qua_muc_A->diem_tu_cham }}
                                            </td>
                                        @endif
                                        @if ($ket_qua_muc_A->loai_tieu_chi == 'phuong_an')
                                            <td class="align-middle text-center">
                                                <input class="m-0" type="radio"
                                                    value="{{ $ket_qua_muc_A->diem_toi_da }}"
                                                    @if ($ket_qua_muc_A->diem_toi_da == $ket_qua_muc_A->where('ma_tieu_chi', 'tc_230')->first()->diem_danh_gia) checked @else disabled @endif></label>
                                            </td>
                                        @else
                                            <td
                                                class="text-center align-middle @if ($tinh_diem == 0) text-bold @endif">
                                                {{ $ket_qua_muc_A->diem_danh_gia }}
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                                <tr>
                                    <td></td>
                                    <td class="align-middle text-bold">TỔNG CỘNG</td>
                                    <td></td>
                                    <td class="align-middle text-center text-bold display-4 p-0" id="tong_diem_tu_cham">
                                        {{ $mau_phieu_danh_gia->tong_diem_tu_cham }}
                                    </td>
                                    <td class="align-middle text-center text-bold display-4 p-0" id="tong_diem_dang_gia">
                                        {{ $mau_phieu_danh_gia->tong_diem_danh_gia }}
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
                                                @if ($ket_qua_muc_B->nhiem_vu_phat_sinh == 1) checked @else disabled @endif></td>
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
                <input type="hidden" name="mau_phieu_danh_gia" value="mau01B">
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

        input[type="checkbox"] {
            pointer-events: none;
        }

        input[type="radio"] {
            pointer-events: none;
        }
    </style>
@stop

@section('js')
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
        })
    </script>
@stop
