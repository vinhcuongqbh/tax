<?php

namespace App\Http\Controllers;

use App\Models\ChucVu;
use App\Models\DonVi;
use App\Models\GioiTinh;
use App\Models\Ngach;
use App\Models\Phong;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        //Hiển thị danh sách User
        $users = User::leftjoin('chuc_vu', 'chuc_vu.ma_chuc_vu', 'users.ma_chuc_vu')
            ->leftjoin('phong', 'phong.ma_phong', 'users.ma_phong')
            ->leftjoin('don_vi', 'don_vi.ma_don_vi', 'users.ma_don_vi')
            ->select(
                'users.so_hieu_cong_chuc',
                'users.name',
                'users.ngay_sinh',
                'chuc_vu.ten_chuc_vu',
                'phong.ten_phong',
                'don_vi.ten_don_vi',
                'users.name',
                'users.ma_trang_thai'
            )
            ->get();

        return view('congchuc.index', ['cong_chuc' => $users]);
    }


    //Tạo mới User
    public function create()
    {
        $gioi_tinh = GioiTinh::all();
        $ngach = Ngach::where('ma_trang_thai', 1)->get();
        $chuc_vu = ChucVu::where('ma_trang_thai', 1)->get();
        $don_vi = DonVi::where('ma_trang_thai', 1)->get();

        return view('congchuc.create', [
            'gioi_tinh' => $gioi_tinh,
            'ngach' => $ngach,
            'chuc_vu' => $chuc_vu,
            'don_vi' => $don_vi,
        ]);
    }


    //Lưu trữ thông tin User
    public function store(Request $request)
    {
        //Kiểm tra thông tin đầu vào
        $validated = $request->validate([
            'so_hieu_cong_chuc' => 'required|unique:App\Models\User,so_hieu_cong_chuc',
            'name' => 'required',
            'ngay_sinh' => 'required',
            'gioi_tinh' => 'required',
            'don_vi' => 'required',
            'phong' => 'required'
        ]);

        $user = new User();
        $user->so_hieu_cong_chuc = $request->so_hieu_cong_chuc;
        $user->name = $request->name;
        $user->ngay_sinh = $request->ngay_sinh;
        $user->ma_gioi_tinh = $request->gioi_tinh;
        $user->ma_ngach = $request->ngach;
        $user->ma_don_vi = $request->don_vi;
        $user->ma_phong = $request->phong;
        $user->email = $request->email;
        $user->password = Hash::make('123456');
        $user->ma_trang_thai = 1;
        $user->save();

        return redirect()->route('congchuc.edit', ['id' => $request->so_hieu_cong_chuc])->with('message', 'Đã tạo mới Người dùng thành công');
    }


    //Sửa thông tin User
    public function edit($id)
    {
        $user = User::where('so_hieu_cong_chuc', $id)->first();
        $gioi_tinh = GioiTinh::all();
        $ngach = Ngach::where('ma_trang_thai', 1)->get();
        $chuc_vu = ChucVu::where('ma_trang_thai', 1)->get();
        $don_vi = DonVi::where('ma_trang_thai', 1)->get();
        $phong = Phong::where('ma_trang_thai', 1)
            ->where('ma_don_vi_cap_tren', $user->ma_don_vi)
            ->get();

        return view('congchuc.edit', [
            'cong_chuc' => $user,
            'gioi_tinh' => $gioi_tinh,
            'ngach' => $ngach,
            'chuc_vu' => $chuc_vu,
            'don_vi' => $don_vi,
            'phong' => $phong
        ]);
    }


    //Cập nhật thông tin User
    public function update(Request $request, $id)
    {
        //Kiểm tra thông tin đầu vào
        $validated = $request->validate([
            //'ma_user' => 'required|unique:App\Models\User,ma_user',
            'name' => 'required',
            'ngay_sinh' => 'required',
            'gioi_tinh' => 'required',
            'don_vi' => 'required',
            'phong' => 'required',
            'email' => 'required',
        ]);

        $user = User::where('so_hieu_cong_chuc', $request->so_hieu_cong_chuc)->first();
        $user->name = $request->name;
        $user->ngay_sinh = $request->ngay_sinh;
        $user->ma_gioi_tinh = $request->gioi_tinh;
        $user->ma_ngach = $request->ngach;
        $user->ma_chuc_vu = $request->chuc_vu;
        $user->ma_don_vi = $request->don_vi;
        $user->ma_phong = $request->phong;
        $user->email = $request->email;
        $user->save();
        return redirect()->route('congchuc.edit', ['id' => $user->so_hieu_cong_chuc])->with('message', 'Đã cập nhật Người dùng thành công');
    }


    //Khóa User
    public function destroy($id)
    {
        $user = User::where('so_hieu_cong_chuc', $id)->first();
        $user->ma_trang_thai = 0;
        $user->save();

        return back()->with('message', 'Đã khóa Người dùng');
    }


    //Mở khóa User
    public function restore($id)
    {
        $user = User::where('so_hieu_cong_chuc', $id)->first();
        $user->ma_trang_thai = 1;
        $user->save();

        return back()->with('message', 'Đã mở khóa Người dùng');
    }
}
