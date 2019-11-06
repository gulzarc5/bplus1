<?php

namespace App\Http\Controllers\Admin\Orders;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function allOrders()
    {
        return view('admin.orders.all_orders');
    }

    public function ajaxAllOrders()
    {
        $query = DB::table('order_details')
        ->select('order_details.*','products.name as p_name','products.seller_id as seller_id')
        ->join('products','products.id','=','order_details.product_id')
        ->orderBy('order_details.id','desc');
            return datatables()->of($query->get())
            ->addIndexColumn()
            ->addColumn('action', function($row){
                   $btn = '<a href="'.route('admin.product_view', ['product_id' =>encrypt($row->product_id)]).'" class="btn btn-info btn-sm" target="_blank">View Product</a>
                   <a href="'.route('admin.single_order_view', ['order_id' =>encrypt($row->id)]).'" class="btn btn-primary btn-sm" target="_blank">View Order</a>';
                   if ($row->status == '1') {
                       $btn .= '<a href="'.route('admin.order_update',['order_details_id' =>encrypt($row->id),'status' =>encrypt(2)]).'" class="btn btn-warning btn-sm">Shipped</a>
                       <a href="'.route('admin.order_update', ['order_details_id' =>encrypt($row->id),'status' =>encrypt(4)]).'" class="btn btn-danger btn-sm">Cancel</a>';
                        return $btn;
                    }elseif($row->status == '2'){
                        $btn .= '<a href="'.route('admin.order_update',['order_details_id' =>encrypt($row->id),'status' =>encrypt(3)]).'" class="btn btn-primary btn-sm">Delivered</a>
                        <a href="'.route('admin.order_update', ['order_details_id' =>encrypt($row->id),'status' =>encrypt(4)]).'" class="btn btn-danger btn-sm">Cancel</a>';
                         return $btn;
                    }else{
                        $btn .= '<a  class="btn btn-success btn-sm">Order Processed</a>';
                         return $btn;
                     }
                    return $btn;
            })
            ->addColumn('status_tab', function($row){
                if ($row->status == '1') {
                   $btn = '<a href="#" class="btn btn-warning btn-sm">Pending</a>';
                    return $btn;
                }elseif($row->status == '2'){
                   $btn = '<a href="#" class="btn btn-info btn-sm">Dispatched</a>';
                    return $btn;
                }elseif($row->status == '3'){
                    $btn = '<a href="#" class="btn btn-primary btn-sm">Delivered</a>';
                     return $btn;
                 }else{
                    $btn = '<a href="#" class="btn btn-danger btn-sm">Cancelled</a>';
                     return $btn;
                 }
            })
            ->addColumn('total', function($row){
                $total = $row->price * $row->quantity;
                return $total;
            })
            ->addColumn('date', function($row){
                $date = $row->created_at;
                $date = Carbon::parse($row->created_at)->toDayDateTimeString();
                return $date;
            })
            ->addColumn('buyer_name', function($row){
                $buyer_detail = DB::table('seller')->select('name')->where('id',$row->user_id)->first();
                $buyer_name =  $buyer_detail->name;
                return $buyer_name;
            })
            ->addColumn('seller_name', function($row){
                $seller_detail = DB::table('seller')->select('name')->where('id',$row->seller_id)->first();
                $seller_name =  $seller_detail->name;
                return $seller_name;
            })
            ->addColumn('shipping_address', function($row){
                $shipping_detail = DB::table('shipping_address')
                    ->select('shipping_address.*','state.name as state_name','city.name as city_name')
                    ->where('shipping_address.id',$row->shipping_address_id)
                    ->join('state','shipping_address.state_id','=','state.id')
                    ->join('city','shipping_address.city_id','=','city.id')
                    ->first();
                $shipping_address =  $shipping_detail->address.",".$shipping_detail->city_name.",".$shipping_detail->state_name."-".$shipping_detail->pin;
                return $shipping_address;
            })
            ->rawColumns(['action','status_tab'])
            ->toJson();
    }

    public function orderUpdate($order_details_id,$status)
    {
       
        try {
            $order_details_id = decrypt($order_details_id);
            $status = decrypt($status);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        
        $update_order = DB::table('order_details')
            ->where('id',$order_details_id)
            ->update([
                'status' => $status,
                'updated_at' =>  Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        return redirect()->back()->with('message','Order Status Updated Successfully');
    }

    public function singleOrderView($order_id)
    {
        try {
            $order_id = decrypt($order_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $order_details = DB::table('order_details')->where('id',$order_id)->first();
        $buyer_info = DB::table('seller')->where('id',$order_details->user_id)->first();
        $seller_info = DB::table('products')
            ->select('seller.*')
            ->join('seller','seller.id','=','products.seller_id')
            ->where('products.id',$order_details->product_id)
            ->first();
        $orders = DB::table('order_details')
			->select('order_details.*','products.name as p_name')
			->join('products','products.id','=','order_details.product_id')
			->orderBy('order_details.id','desc')
            ->where('order_details.id',$order_id)
            ->first();
        $shipping_info = DB::table('order_details')
            ->select('shipping_address.*','state.name as s_name','city.name as c_name')
            ->join('shipping_address','order_details.shipping_address_id','=','shipping_address.id')
            ->join('state','shipping_address.state_id','=','state.id')
            ->join('city','shipping_address.city_id','=','city.id')
            ->where('order_details.id',$order_id)
            ->first();
        $color = null;
        if (!empty($order_details->color_id)) {
            $product_color = DB::table('product_colors')->where('id',$order_details->color_id)->first();
            $color = DB::table('color')->where('id',$product_color->color_id)->first();
        }
        $data = [
            'buyer_info' => $buyer_info,
            'seller_info' => $seller_info,
            'orders' => $orders,
            'shipping_info' => $shipping_info,
            'color' => $color,
        ];
        // dd($data);
        return view('admin.orders.order_details',compact('data'));
    }

    public function pendingOrders()
    {
        return view('admin.orders.pending_orders');
    }

    public function ajaxPendingOrders()
    {
        $query = DB::table('order_details')
        ->select('order_details.*','products.name as p_name','products.seller_id as seller_id')
        ->join('products','products.id','=','order_details.product_id')
        ->where('order_details.status',1)
        ->orderBy('order_details.id','desc');
            return datatables()->of($query->get())
            ->addIndexColumn()
            ->addColumn('action', function($row){
                   $btn = '<a href="'.route('admin.product_view', ['product_id' =>encrypt($row->product_id)]).'" class="btn btn-info btn-sm" target="_blank">View Product</a>
                   <a href="'.route('admin.single_order_view', ['order_id' =>encrypt($row->id)]).'" class="btn btn-primary btn-sm" target="_blank">View Order</a>';
                   if ($row->status == '1') {
                       $btn .= '<a href="'.route('admin.order_update',['order_details_id' =>encrypt($row->id),'status' =>encrypt(2)]).'" class="btn btn-warning btn-sm">Shipped</a>
                       <a href="'.route('admin.order_update', ['order_details_id' =>encrypt($row->id),'status' =>encrypt(4)]).'" class="btn btn-danger btn-sm">Cancel</a>';
                        return $btn;
                    }elseif($row->status == '2'){
                        $btn .= '<a href="'.route('admin.order_update',['order_details_id' =>encrypt($row->id),'status' =>encrypt(3)]).'" class="btn btn-primary btn-sm">Delivered</a>
                        <a href="'.route('admin.order_update', ['order_details_id' =>encrypt($row->id),'status' =>encrypt(4)]).'" class="btn btn-danger btn-sm">Cancel</a>';
                         return $btn;
                    }else{
                        $btn .= '<a  class="btn btn-success btn-sm">Order Processed</a>';
                         return $btn;
                     }
                    return $btn;
            })
            ->addColumn('status_tab', function($row){
                if ($row->status == '1') {
                   $btn = '<a href="#" class="btn btn-warning btn-sm">Pending</a>';
                    return $btn;
                }elseif($row->status == '2'){
                   $btn = '<a href="#" class="btn btn-info btn-sm">Dispatched</a>';
                    return $btn;
                }elseif($row->status == '3'){
                    $btn = '<a href="#" class="btn btn-primary btn-sm">Delivered</a>';
                     return $btn;
                 }else{
                    $btn = '<a href="#" class="btn btn-danger btn-sm">Cancelled</a>';
                     return $btn;
                 }
            })
            ->addColumn('total', function($row){
                $total = $row->price * $row->quantity;
                return $total;
            })
            ->addColumn('date', function($row){
                $date = $row->created_at;
                $date = Carbon::parse($row->created_at)->toDayDateTimeString();
                return $date;
            })
            ->addColumn('buyer_name', function($row){
                $buyer_detail = DB::table('seller')->select('name')->where('id',$row->user_id)->first();
                $buyer_name =  $buyer_detail->name;
                return $buyer_name;
            })
            ->addColumn('seller_name', function($row){
                $seller_detail = DB::table('seller')->select('name')->where('id',$row->seller_id)->first();
                $seller_name =  $seller_detail->name;
                return $seller_name;
            })
            ->addColumn('shipping_address', function($row){
                $shipping_detail = DB::table('shipping_address')
                    ->select('shipping_address.*','state.name as state_name','city.name as city_name')
                    ->where('shipping_address.id',$row->shipping_address_id)
                    ->join('state','shipping_address.state_id','=','state.id')
                    ->join('city','shipping_address.city_id','=','city.id')
                    ->first();
                $shipping_address =  $shipping_detail->address.",".$shipping_detail->city_name.",".$shipping_detail->state_name."-".$shipping_detail->pin;
                return $shipping_address;
            })
            ->rawColumns(['action','status_tab'])
            ->toJson();
    }

    public function deliveredOrders()
    {
        return view('admin.orders.delivered_orders');
    }

    public function ajaxDeliveredOrders()
    {
        $query = DB::table('order_details')
        ->select('order_details.*','products.name as p_name','products.seller_id as seller_id')
        ->join('products','products.id','=','order_details.product_id')
        ->where('order_details.status',3)
        ->orderBy('order_details.id','desc');
            return datatables()->of($query->get())
            ->addIndexColumn()
            ->addColumn('action', function($row){
                   $btn = '<a href="'.route('admin.product_view', ['product_id' =>encrypt($row->product_id)]).'" class="btn btn-info btn-sm" target="_blank">View Product</a>
                   <a href="'.route('admin.single_order_view', ['order_id' =>encrypt($row->id)]).'" class="btn btn-primary btn-sm" target="_blank">View Order</a>';
                   if ($row->status == '1') {
                       $btn .= '<a href="'.route('admin.order_update',['order_details_id' =>encrypt($row->id),'status' =>encrypt(2)]).'" class="btn btn-warning btn-sm">Shipped</a>
                       <a href="'.route('admin.order_update', ['order_details_id' =>encrypt($row->id),'status' =>encrypt(4)]).'" class="btn btn-danger btn-sm">Cancel</a>';
                        return $btn;
                    }elseif($row->status == '2'){
                        $btn .= '<a href="'.route('admin.order_update',['order_details_id' =>encrypt($row->id),'status' =>encrypt(3)]).'" class="btn btn-primary btn-sm">Delivered</a>
                        <a href="'.route('admin.order_update', ['order_details_id' =>encrypt($row->id),'status' =>encrypt(4)]).'" class="btn btn-danger btn-sm">Cancel</a>';
                         return $btn;
                    }else{
                        $btn .= '<a  class="btn btn-success btn-sm">Order Processed</a>';
                         return $btn;
                     }
                    return $btn;
            })
            ->addColumn('status_tab', function($row){
                if ($row->status == '1') {
                   $btn = '<a href="#" class="btn btn-warning btn-sm">Pending</a>';
                    return $btn;
                }elseif($row->status == '2'){
                   $btn = '<a href="#" class="btn btn-info btn-sm">Dispatched</a>';
                    return $btn;
                }elseif($row->status == '3'){
                    $btn = '<a href="#" class="btn btn-primary btn-sm">Delivered</a>';
                     return $btn;
                 }else{
                    $btn = '<a href="#" class="btn btn-danger btn-sm">Cancelled</a>';
                     return $btn;
                 }
            })
            ->addColumn('total', function($row){
                $total = $row->price * $row->quantity;
                return $total;
            })
            ->addColumn('date', function($row){
                $date = $row->created_at;
                $date = Carbon::parse($row->created_at)->toDayDateTimeString();
                return $date;
            })
            ->addColumn('buyer_name', function($row){
                $buyer_detail = DB::table('seller')->select('name')->where('id',$row->user_id)->first();
                $buyer_name =  $buyer_detail->name;
                return $buyer_name;
            })
            ->addColumn('seller_name', function($row){
                $seller_detail = DB::table('seller')->select('name')->where('id',$row->seller_id)->first();
                $seller_name =  $seller_detail->name;
                return $seller_name;
            })
            ->addColumn('shipping_address', function($row){
                $shipping_detail = DB::table('shipping_address')
                    ->select('shipping_address.*','state.name as state_name','city.name as city_name')
                    ->where('shipping_address.id',$row->shipping_address_id)
                    ->join('state','shipping_address.state_id','=','state.id')
                    ->join('city','shipping_address.city_id','=','city.id')
                    ->first();
                $shipping_address =  $shipping_detail->address.",".$shipping_detail->city_name.",".$shipping_detail->state_name."-".$shipping_detail->pin;
                return $shipping_address;
            })
            ->rawColumns(['action','status_tab'])
            ->toJson();
    }
}
