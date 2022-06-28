<?php

namespace App\Http\Controllers\admins;

use App\Models\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class adminsController extends Controller
{

    public function index(){
        if(auth()->check()){
       $admins = admin::get();
        return view('admins.index',['data'=>$admins]);
        }else{
            return redirect(url('login'));
        }
    }

    public function create(){
        return view('admins.create');
    }

    public function store(Request $request){
        $data = $this->validate($request,[
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required|min:6',
            'image'=>'required|image|mimes:png,jpg,jpeg,gif,svg|max:2048',
        ]);

        $data['password'] = bcrypt($data['password']);

        //uploading image to server
        $imageName = time().uniqid().'.'.$request->image->extension();
        $request->image->move(public_path('images/admins'),$imageName);
        $data['image'] = $imageName;
        ##########################################

        $op = admin::create($data);

        if($op){
            $message = "Admin Created Successfully";
            session()->flash('Message-success',$message);
        }else{
            $message = "Error occurred while Creating Data";
            session()->flash('Message-error',$message);
        }
        return redirect(url('admins/create'));
    }

    public function remove(Request $request){
        $admin = admin::find($request->id);
        $op = admin::where('id',$request->id)->delete();

        if($op){
            unlink(public_path('images/admins/'.$admin->image));
            $message = "Admin Removed Successfully";
            session()->flash('Message-success',$message);
        }else{
            $message = "Error occurred while Removing Data";
            session()->flash('Message-error',$message);
        }
        return redirect(url('admins'));
    }

    //get data by id to update it
    public function edit($id){
        # get Data
        $admin = admin::find($id);
        return view('admins.edit',['data'=>$admin]);
    }

    public function update(Request $request,$id){
        $data = $this->validate($request,[
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'nullable|min:6',
            'image'=>'required',
        ]);

        if($request->has('changePassword')){
            $data['password'] = bcrypt($request->password);
        }else{
            unset($data['password']);
        }

        $op = admin::where('id',$id)->update($data);
        if($op){
            $message = "Admin Updated Successfully";
            session()->flash('Message-success',$message);
        }else{
            $message = "Error occurred while Updating Data";
            session()->flash('Message-error',$message);
        }
        return redirect(url('admins'));
    }
}
