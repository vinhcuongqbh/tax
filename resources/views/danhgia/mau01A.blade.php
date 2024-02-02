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
                                <?php $i = 1; ?>
                                @for ($n = 0; $n < 10; $i++)
                                    The current value is {{ $i }}
                                @endfor

                                ($mau_danh_gia as $mau_danh_gia)
                                <tr>
                                    <td class="text-center">{{ $i++ }}</td>
                                    <td class="text-center">{{ $don_vi->ma_don_vi }}</td>
                                    <td><a
                                            href="{{ route('donvi.edit', $don_vi->ma_don_vi) }}">{{ $don_vi->ten_don_vi }}</a>
                                    </td>
                                    <td>{{ $don_vi->ten_don_vi_cap_tren }}</td>
                                    <td class="text-center">
                                        @if ($don_vi->ma_trang_thai == 1)
                                            <a class="btn bg-danger text-nowrap w-100"
                                                href="{{ route('donvi.delete', $don_vi->ma_don_vi) }}">
                                                Khóa
                                            </a>
                                        @else
                                            <a class="btn bg-olive text-nowrap w-100"
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
@stop
