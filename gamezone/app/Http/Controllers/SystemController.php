<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class SystemController extends Controller
{
    public function listUse(){
        $user_id_sign_in = Auth::id();
        $list_use = DB::table('manager_user')->get();
//        dd($user_id_sign_in);
        return view('System.system_list')->with(['list_use'=>$list_use,'user_id_sign_in'=>$user_id_sign_in]);
    }

    public function updateUseView($id){
        $data = DB::table('manager_user')
            ->find($id);
        return view('System.infor_use')->with('data',$data);
    }

    public function updateUseViewInfor(Request  $request){
        $id_auth = Auth::id();
        $user_update = DB::table('manager_user')
            ->find($id_auth);
        $data = DB::table('manager_user')
            ->find($request->user_id);
        $password = "";
        if(!Hash::check($request->txtPass,$data->password)) {
            $password = Hash::make($request->txtPass);
        }else{
            $password = $request->txtPass;
        }
        $dataupdate = DB::table('manager_user')->where('id','=',$request->user_id)
                    ->update([
                        'login'=>$request->txtNumber,
                        'password'=>$password,
                        'first_name'=>$request->txtFName,
                        'last_name'=>$request->txtLName,
                        'email'=>$request->txtEmail,
                        'image_url'=>$data->image_url,
                        "activated"=>$data->activated,
                        "lang_key"=>$data->lang_key,
                        "activation_key"=>$data->activation_key,
                        "reset_key"=>$data->reset_key,
                        "created_by"=>$data->created_by,
                        "created_date"=>$data->created_date,
                        "reset_date"=>$data->reset_date,
                        "last_modified_by"=>$user_update->login,
                        "last_modified_date"=>$data->last_modified_date]);
        if($dataupdate = 1){
            $notification = array(
                'message' => 'Cập nhật thông tin thành công!',
                'alert-type' => 'success'
            );
        }else{
            $notification = array(
                'message' => 'Cập nhật thông tin không thành công!',
                'alert-type' => 'success'
            );
        }
        return Redirect::back()->with($notification);
    }

}
