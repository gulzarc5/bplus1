<?php

namespace App\Http\Controllers\Admin\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class UsersController extends Controller
{
    public function allSellers()
    {
    	return view('admin.users.sellers');
    }

    public function ajaxAllSellers()
    {
    	$query = DB::table('seller')        
        ->whereNull('deleted_at')
        ->where('user_role',2);
       
            return datatables()->of($query->get())
            ->addIndexColumn()
            ->addColumn('action', function($row){
                   $btn = '
                   <a href="'.route('admin.seller_view',['seller_id'=>encrypt($row->id)]).'" class="btn btn-info btn-sm" target="_blank">View</a>';
                   if ($row->verification_status == 2) {
                     $btn .= '<a href="'.route('admin.seller_view',['seller_id'=>encrypt($row->id)]).'" class="btn btn-warning btn-sm" target="_blank">Verify</a>';
                   }
                    if ($row->status == 1) {  
                        $btn .= '<a href="'.route('admin.sellerUpdateStatus',['seller_id'=>encrypt($row->id),'status'=>encrypt(2)]).'" class="btn btn-danger btn-sm">DeActivate</a>';
                    }else{
                        $btn .= '<a href="'.route('admin.sellerUpdateStatus',['seller_id'=>encrypt($row->id),'status'=>encrypt(1)]).'" class="btn btn-primary btn-sm">Activate</a>';
                    }
                    
             
                    return $btn;
            })
            ->addColumn('status_tab', function($row){
                if ($row->status == 1) {
                    $btn = '<a href="#" class="btn btn-success btn-sm">Enabled</a>';
                }else{
                    $btn = '<a href="#" class="btn btn-danger btn-sm">Disabled</a>';
                }
                return $btn;
            })
            ->addColumn('verification_status', function($row){
                if ($row->verification_status == 3) {
                    $btn = '<a href="#" class="btn btn-success btn-sm">Verified</a>';
                }elseif ($row->verification_status == 2) {
                     $btn = '<a href="#" class="btn btn-warning btn-sm">Under Review</a>';
                }else{
                    $btn = '<a href="#" class="btn btn-danger btn-sm">Details Not Set</a>';
                }
                return $btn;
            })
            ->rawColumns(['action','status_tab','verification_status'])
            ->toJson();
    }

    public function allBuyers()
    {
    	return view('admin.users.buyer_list');
    }

    public function ajaxAllBuyers()
    {
    	$query = DB::table('seller')        
        ->whereNull('deleted_at')
        ->where('user_role',1);
       
            return datatables()->of($query->get())
            ->addIndexColumn()
            ->addColumn('action', function($row){
                   $btn = '
                   <a href="#" class="btn btn-info btn-sm" target="_blank">View</a>
                   <a href="#" class="btn btn-warning btn-sm">Verify</a>   
                   <a href="#" class="btn btn-warning btn-sm">Active</a>';
             
                    return $btn;
            })
            ->addColumn('status_tab', function($row){

                   $btn = '<a href="#" class="btn btn-success btn-sm">Enabled</a>';
                    return $btn;
            })
            ->rawColumns(['action','status_tab'])
            ->toJson();
    }

    public function sellerView($seller_id)
    {
        try {
            $seller_id = decrypt($seller_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $seller = DB::table('seller')
        ->select('seller.id as seller_id','seller.name as name','seller.verification_status as verification_status','seller.email as email', 'seller.mobile as mobile','seller_details.dob as dob','seller_details.pan as pan', 'seller_details.gst as gst','seller_details.gender as gender','seller_details.state_id as state', 'seller_details.city_id as city','seller_details.pin as pin','seller_details.address as address','seller_bank.bank_name as bank_name','seller_bank.branch_name as branch_name','seller_bank.account as account','seller_bank.ifsc as ifsc','seller_bank.micr as micr')
        ->join('seller_bank','seller.id','=','seller_bank.seller_id')
        ->join('seller_details','seller.id','=','seller_details.seller_id')
        ->where('seller.id',$seller_id)
        ->first();

        $state = DB::table('state')->whereNull('deleted_at')->get();

        $city = null;
        if (!empty($seller->state)) {
            $city = DB::table('city')
            ->where('state_id',$seller->state)
            ->get();
        }
        
        return view('admin.users.user_details',compact('seller','state','city'));
    }

    public function sellerUpdateVerification($seller_id)
    {
        try {
            $seller_id = decrypt($seller_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $seller_update = DB::table('seller')
        ->where('id',$seller_id)
        ->update([
            'verification_status'=>3,
        ]);
        return redirect()->back();
    }

    public function sellerUpdateStatus($seller_id,$status)
    {
        try {
            $seller_id = decrypt($seller_id);
            $status = decrypt($status);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $seller_update = DB::table('seller')
        ->where('id',$seller_id)
        ->update([
            'status'=>$status,
        ]);
        return redirect()->back();
    }
}
