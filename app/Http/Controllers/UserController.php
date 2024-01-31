<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
        $users = User::where('ma_trang_thai', 1)->get();

        return view('user.create', ['users' => $users]);
    }


    //Lưu trữ thông tin User
    public function store(Request $request)
    {
        //Kiểm tra thông tin đầu vào
        $validated = $request->validate([
            'ma_user' => 'required|unique:App\Models\User,ma_user',
            'ten_user' => 'required',
        ]);

        $user = new User();
        $user->ma_user = $request->ma_user;
        $user->ten_user = $request->ten_user;
        $user->ma_users_cap_tren = $request->ma_users_cap_tren;
        $user->ma_trang_thai = 1;
        $user->save();

        return redirect()->route('user.edit', ['id' => $request->ma_user])->with('message', 'Đã tạo mới User thành công');
    }


    //Sửa thông tin User
    public function edit($id)
    {
        $user = User::where('ma_user', $id)->first();
        $users = User::all();


        return view('user.edit', [
            'user' => $user,
            'users' => $users
        ]);
    }


    //Cập nhật thông tin User
    public function update(Request $request, $id)
    {
        //Kiểm tra thông tin đầu vào
        $validated = $request->validate([
            //'ma_user' => 'required|unique:App\Models\User,ma_user',
            'ten_user' => 'required',
        ]);

        $user = User::where('ma_user', $request->ma_user)->first();
        $user->ten_user = $request->ten_user;
        $user->ma_users_cap_tren = $request->ma_users_cap_tren;
        $user->save();
        return redirect()->route('user.edit', ['id' => $user->ma_user])->with('message', 'Đã cập nhật User thành công');
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
