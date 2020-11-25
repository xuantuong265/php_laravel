<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Cart;
use Session;
use App\Model\orders;
use App\Model\detail_orders;

class adminCartController extends Controller
{
    public function listCartMana() // Danh sách hóa đơn, đơn hàng
    {
        $orders = orders::all();
        return view('admin.carts.list-cart')->with([
            'orders'           => $orders
        ]);
    }

    public function detailCartMana($id_orders) // Chi tiết hóa đơn
    {
        $detail_orders = detail_orders::where('id_od', $id_orders)->get();
        return view('admin.carts.detail-cart')->with([
            'detail_orders'         => $detail_orders
        ]);
    }

    public function deleteDetailCart($id) // Chi tiết hóa đơn
    {
        $detail_orders = detail_orders::find($id);
        $detail_orders->delete();
        return redirect( Route('listCartMana') );
    }

    public function deleteOrders($id) // Hóa đơn
    {
        $orders = orders::find($id);
        $orders->delete();
        return redirect( Route('listCartMana') );
    }

    public function searchCart(Request $request)
    {
        $orders = orders::select("tbl_orders.*")
                ->whereBetween('date', [$request->ngaydau, $request->ngaycuoi])
                ->get();
        return view('admin.carts.search-cart')->with([
            'list'      => $orders
        ]);
    }

    public function doanhThu()
    {
        $datas = DB::table('tbl_orders')
                ->select(DB::raw('count(*) as sodonhang, date'), DB::raw('SUM(total) as tongtien'))
                ->groupBy('date')
                ->get();

        
        $products = DB::table('tbl_detail_orders')
                    ->select(DB::raw('SUM(amounts) as tongsanpham'))
                    ->get();

        return view('admin.carts.doanhthu')->with([
            'doanhthu'          => $datas,
            'products'          => $products
        ]);
    }

    public function searchDoanhThu(Request $request)
    {

        $orders = DB::table('tbl_orders')
                ->select(DB::raw('count(*) as sodonhang, date'), DB::raw('SUM(total) as tongtien'))
                ->whereBetween('date', [$request->ngaydau, $request->ngaycuoi])
                ->groupBy('date')
                ->get();

        $products = DB::table('tbl_detail_orders')
                    ->select(DB::raw('SUM(amounts) as tongsanpham'))
                    ->whereBetween('date', [$request->ngaydau, $request->ngaycuoi])
                    ->get();

        return view('admin.carts.search-doanhthu')->with([
            'doanhthu'      => $orders,
            'products'      => $products
        ]);
    }

}
