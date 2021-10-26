<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Settings;
use App\Models\Membership;
use Illuminate\Http\Request;
use DB;

class MembershipController extends Controller
{
    public function membership(){
        return view('membership.list');
    }

    public function membershipList(Request $request){
        {
            $membership = Membership::select('fkorderId', 'fkcustomerId', 'point', 'membershipId', 'cause', 'user.firstName',
                DB::raw('sum(point) as total'))
                ->leftJoin('customer', 'membership.fkcustomerId', '=', 'customer.customerId')
                ->leftJoin('user', 'user.userId', '=', 'customer.fkuserId')
                ->orderBy('membershipId', 'asc')
                ->groupBy('membership.fkcustomerId');

            $membership = $membership->get();

            $datatables = Datatables::of($membership);

            return $datatables->make(true);
        }
    }

    public function membershipDetail($id){
        $customerId = $id;
        return view('membership.detail', compact('customerId'));

    }
    public function membershipDetailShow(Request $request){
        $membershipDetail = Membership::select('fkorderId', 'fkcustomerId', 'point', 'membershipId', 'cause', 'user.firstName')
            ->leftJoin('customer', 'membership.fkcustomerId', '=', 'customer.customerId')
            ->leftJoin('user', 'user.userId', '=', 'customer.fkuserId')
            ->where('membership.fkcustomerId', $request->customerId)
            ->orderBy('membershipId', 'asc');

        $membershipDetail = $membershipDetail->get();

        $datatables = Datatables::of($membershipDetail);

        return $datatables->make(true);

    }

    public static function addPointToMemeber($orderData){
        $pointUnit=Settings::first();
        $achivedPoint=intval($orderData['orderTotal'])*(intval($pointUnit->point)/100);
        $membership=new Membership();
        $membership->fkcustomerId=$orderData['customerId'];
        $membership->fkorderId=$orderData['orderId'];
        if(!empty($orderData['type'])){
            $membership->cause='out';
            $membership->point= -$orderData['point'];
        }
        else{
            $membership->cause='in';
            $membership->point= $achivedPoint;
        }
        $membership->save();
    }
}
