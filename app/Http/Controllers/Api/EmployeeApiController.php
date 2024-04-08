<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\EmployeeOrderGift;
use App\Models\EmployeeOrderProduct;
use App\Models\EmployeeTravelFare;
use App\Models\EmployeeVisit;
use App\Models\Gift;
use App\Models\ItemStock;
use App\Models\Product;
use App\Models\ProductStock;
use App\Models\TourPrograme;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class EmployeeApiController extends Controller
{
    public function sendOtp(Request $request)
    {
        try {

            // $otpNumber = (string)random_int(100000, 999999);
            $mobilenumber = request()->query("mobilenumber");

            if (!$mobilenumber) {
                return response()->json(["status" => 401, "message" => "mobile number required!", "data" =>  []], 401);
            }

            // $otp =  Http::get(
            //     "http://sms.shivmaytechs.com/sms-panel/api/http/index.php?username=Opucation&apikey=62C87-FDFFE&apirequest=Text&sender=OPUCAN&mobile=$mobilenumber&message=Your One-Time Password (OTP) for login is:$otpNumber This code is valid for the next 5 minutes. Do not share this code with anyone.OPUCATION E-LEARNING&route=OTP&TemplateID=1707169831356992777&format=JSON"
            // );

            // if (json_decode($otp)->status == "success") {

            if (Employee::wherePhnNo($mobilenumber)->first()) {
                $user = Employee::where('phn_no', $mobilenumber)->update(['otp' => '123456']);
                return response()->json(["status" => 200, "message" => "Otp send successfully to your number", "data" =>  []], 200);
            } else {
                return response()->json(["status" => 401, "message" => "employee not exist!", "data" =>  []], 401);
            }
            // } else {
            //     return response()->json(["status" => 401, "message" => json_decode($otp)->message, "data" =>  []], 401);
            // }
        } catch (Exception $e) {
            return response()->json(["status" => 500, "message" => $e->getMessage(), "data" => []], 500);
        }
    }

    public function verifyOtp(Request $request)
    {
        try {

            $employee = Employee::where(['phn_no' => $request->mobilenumber, 'otp' => $request->otp])->first();

            if ($employee) {
                return response()->json(["status" => 200, "message" => "Login successful", "data" =>  $employee], 200);
            } else {
                return response()->json(["status" => 401, "message" => "wrong otp", "data" =>  []], 401);
            }
        } catch (Exception $e) {
            return response()->json(["status" => 500, "message" => $e->getMessage(), "data" => []], 500);
        }
    }

    public function updateFcmToken(Request $request)
    {
        try {


            if (!$request->fcmToken) {
                return response()->json(["status" => 400, "message" => "fcm token required!", "data" =>  []], 400);
            }

            $employee = Employee::where('phn_no', $request->mobilenumber)->first();

            if ($employee) {
                Employee::where('phn_no', $request->mobilenumber)->update(['fcm_token' => $request->fcmToken]);
                return response()->json(["status" => 200, "message" => "fcm token updated!", "data" =>  []], 200);
            } else {
                return response()->json(["status" => 400, "message" => "employee not exist!", "data" =>  []], 400);
            }
        } catch (Exception $e) {
            return response()->json(["status" => 500, "message" => $e->getMessage(), "data" => []], 500);
        }
    }


    public function tourProgrameByEmployee(Request $request)
    {
        try {
            $employee = TourPrograme::where(['employee_id' => $request->employeeId, 'tour_date' => Carbon::now()->format('Y-m-d')])->get();
            return response()->json(["status" => 200, "message" => "success", "data" =>  $employee], 200);
        } catch (Exception $e) {
            return response()->json(["status" => 500, "message" => $e->getMessage(), "data" => []], 500);
        }
    }

    public function startTourProgrameByEmployee(Request $request)
    {
        try {

            if (!$request->tourDate) {
                return response()->json(["status" => 400, "message" => 'Tour date required!', "data" => []], 400);
            }

            if (!$request->employeeId) {
                return response()->json(["status" => 400, "message" => 'Employee id required!', "data" => []], 400);
            }

            if (!$request->startLocation) {
                return response()->json(["status" => 400, "message" => 'Start Location required!', "data" => []], 400);
            }

            if (!$request->endLocation) {
                return response()->json(["status" => 400, "message" => 'End Location required!', "data" => []], 400);
            }

            $tourPrograme = new TourPrograme();
            $tourPrograme->employee_id = $request->employeeId;
            $tourPrograme->tour_date = $request->tourDate;
            $tourPrograme->start_location = $request->startLocation;
            $tourPrograme->end_location = $request->endLocation;
            $tourPrograme->save();


            return response()->json(["status" => 200, "message" => "update success", "data" =>  []], 200);
        } catch (Exception $e) {
            return response()->json(["status" => 500, "message" => $e->getMessage(), "data" => []], 500);
        }
    }

    public function startTourPrograme(Request $request)
    {
        try {

            if (!$request->startTime) {
                return response()->json(["status" => 400, "message" => 'Start time required!', "data" => []], 400);
            }

            if (!$request->startLat) {
                return response()->json(["status" => 400, "message" => 'Start Latitude required!', "data" => []], 400);
            }

            if (!$request->startLong) {
                return response()->json(["status" => 400, "message" => 'Start Longitude required!', "data" => []], 400);
            }

            TourPrograme::whereId($request->query('tourId'))
                ->update([
                    'starting_date_time' => $request->startTime,
                    'starting_lat' => $request->startLat,
                    'starting_long' => $request->startLong
                ]);

            return response()->json(["status" => 200, "message" => "update success", "data" =>  []], 200);
        } catch (Exception $e) {
            return response()->json(["status" => 500, "message" => $e->getMessage(), "data" => []], 500);
        }
    }

    public function endTourPrograme(Request $request)
    {
        try {

            if (!$request->endedTime) {
                return response()->json(["status" => 400, "message" => 'Ended time required!', "data" => []], 400);
            }

            if (!$request->endedLat) {
                return response()->json(["status" => 400, "message" => 'Ended Latitude required!', "data" => []], 400);
            }

            if (!$request->endedLong) {
                return response()->json(["status" => 400, "message" => 'Ended Longitude required!', "data" => []], 400);
            }

            TourPrograme::whereId($request->query('tourId'))
                ->update([
                    'ended_date_time' => $request->endedTime,
                    'ended_lat' => $request->endedLat,
                    'ended_long' => $request->endedLong
                ]);

            return response()->json(["status" => 200, "message" => "update success", "data" =>  []], 200);
        } catch (Exception $e) {
            return response()->json(["status" => 500, "message" => $e->getMessage(), "data" => []], 500);
        }
    }


    public function get_gifts(Request $request)
    {
        try {
            $gifts_data = Gift::whereStatus(true)->get()->append('stock_count');

            return response()->json(["status" => 200, "message" => "success", "data" =>  $gifts_data], 200);
        } catch (Exception $e) {
            return response()->json(["status" => 500, "message" => $e->getMessage(), "data" => []], 500);
        }
    }

    public function get_products(Request $request)
    {
        try {
            $products_data = Product::whereStatus(true)->get()->append('stock_count');

            return response()->json(["status" => 200, "message" => "success", "data" =>  $products_data], 200);
        } catch (Exception $e) {
            return response()->json(["status" => 500, "message" => $e->getMessage(), "data" => []], 500);
        }
    }


    public function post_visit(Request $request)
    {
        try {

            if (!$request->query('employeeId')) {
                return response()->json(["status" => 400, "message" => "EmployeeId required!", "data" => []], 400);
            }

            if (!$request->query('tourId')) {
                return response()->json(["status" => 400, "message" => "Tour Id  required!", "data" => []], 400);
            }

            if ($request->file('visitSelfie')) {
                $selfieImage = $request->file('visitSelfie');

                $path = $selfieImage->store('images/visits', 'public');
            } else {
                return response()->json(["status" => 400, "message" => "Visit Selfie Required!", "data" => []], 400);
            }

            if (!$request->partyName) {
                return response()->json(["status" => 400, "message" => "Part name Required!", "data" => []], 400);
            }

            $employee_visit = new EmployeeVisit();
            $employee_visit->visit_selfie = $path;
            $employee_visit->party_type = $request->partyType;
            $employee_visit->employee_id = $request->query('employeeId');
            $employee_visit->party_name = $request->partyName;
            $employee_visit->visit_address = $request->visitAddress;
            $employee_visit->visit_latitude = $request->visitLat;
            $employee_visit->visit_longitude = $request->visitLong;
            $employee_visit->tour_id = $request->query('tourId');
            $employee_visit->save();

            if ($request->orderProduct) {

                $order_product = json_decode($request->orderProduct);

                foreach ($order_product as $item) {
                    // $product_stock = ProductStock::where("product_id",$item->id)->get();

                    // $actual_quantity = $item->quantity;

                    // foreach ($product_stock as $stockItem) {
                    //     if ($actual_quantity > 0 && $stockItem->quantity > 0) {
                    //         if ($stockItem->quantity >= $actual_quantity) {
                    //             $updateProductStock = $stockItem->quantity - $actual_quantity;
                    //             $actual_quantity = 0;
                    //             ProductStock::whereId($stockItem->id)->update(["quantity" => $updateProductStock]);
                    //         } else {
                    //             $actual_quantity = $actual_quantity - $stockItem->quantity;
                    //             ProductStock::whereId($stockItem->id)->update(["quantity" => 0]);
                    //         }
                    //     }
                    // }

                    $employeeOrder = new EmployeeOrderProduct();
                    $employeeOrder->visit_id = $employee_visit->id;
                    $employeeOrder->employee_id = $request->query('employeeId');
                    $employeeOrder->product_id = $item->id;
                    $employeeOrder->quantity = $item->quantity;
                    $employeeOrder->save();
                }
            }

            if ($request->gifts) {
                $order_gift = json_decode($request->gifts);
                foreach ($order_gift as $item) {
                    $product_stock = ItemStock::where("item_id", $item->id)->get();

                    $actual_quantity = $item->quantity;

                    foreach ($product_stock as $stockItem) {
                        if ($actual_quantity > 0 && $stockItem->quantity > 0) {
                            if ($stockItem->quantity >= $actual_quantity) {
                                $updateProductStock = $stockItem->quantity - $actual_quantity;
                                $actual_quantity = 0;
                                ItemStock::whereId($stockItem->id)->update(["quantity" => $updateProductStock]);
                            } else {
                                $actual_quantity = $actual_quantity - $stockItem->quantity;
                                ItemStock::whereId($stockItem->id)->update(["quantity" => 0]);
                            }
                        }
                    }
                }
            }

            return response()->json(["status" => 200, "message" => "success", "data" => ["visitId" => $employee_visit->id]], 200);
        } catch (Exception $e) {
            return response()->json(["status" => 500, "message" => $e->getMessage(), "data" => []], 500);
        }
    }

    public function get_employee_tracking(Request $request)
    {
        try {

            if ($request->query('startDate') && $request->query('endDate')) {
                $tourPrograme = TourPrograme::where("employee_id", $request->query('employeeId'))
                    ->whereBetween('tour_date', [$request->query('startDate'), $request->query('endDate')])->get();
            } else {
                $tourPrograme = TourPrograme::where("employee_id", $request->query('employeeId'))->get();
            }


            $distanceFare = EmployeeTravelFare::whereId(1)->first();


            $trackingData = [];

            foreach ($tourPrograme as $item) {
                $totalDistance = 0.00;
                if ($item->starting_long != null && $item->ended_long != null && $item->starting_lat != null &&  $item->ended_lat != null) {
                    $employeeVisit = EmployeeVisit::where("tour_id", $item->id)->get();


                    $startDistance = $this->getTotalDistance($item->starting_lat, $item->starting_long, $employeeVisit[0]->visit_latitude, $employeeVisit[0]->visit_longitude);
                    $totalDistance = $totalDistance + $startDistance;
                    for ($i = 0; $i < count($employeeVisit); $i++) {
                        if ($i + 1 < count($employeeVisit)) {
                            $totalDistance = $totalDistance +
                                $this->getTotalDistance(
                                    $employeeVisit[$i]->visit_latitude,
                                    $employeeVisit[$i]->visit_longitude,
                                    $employeeVisit[$i + 1]->visit_latitude,
                                    $employeeVisit[$i + 1]->visit_longitude
                                );
                        } else {
                            $totalDistance = $totalDistance + $this->getTotalDistance(
                                $employeeVisit[$i]->visit_latitude,
                                $employeeVisit[$i]->visit_longitude,
                                $item->ended_lat,
                                $item->ended_long
                            );
                        }
                    }

                    $trackingDataLoop['tour_date'] = $item->tour_date;
                    $trackingDataLoop['total_distance'] = $totalDistance;
                    $trackingDataLoop['total_fare'] = $totalDistance * $distanceFare->fare;
                    $trackingData[] = $trackingDataLoop;
                }
            }




            return response()->json(["status" => 200, "message" => "success", "data" => $trackingData], 200);
        } catch (Exception $e) {
            return response()->json(["status" => 500, "message" => $e->getMessage(), "data" => []], 500);
        }
    }

    private function getTotalDistance($startLat, $startLong, $endLat, $endLong)
    {
        $theta = $startLong - $endLong;
        $dist = sin(deg2rad($startLat)) * sin(deg2rad($endLat)) +  cos(deg2rad($startLat)) * cos(deg2rad($endLat)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        return  round($miles * 1.609344, 2);
    }

    public function post_add_order_product(Request $request)
    {
        try {

            if (!$request->query('visitId')) {
                return response()->json(["status" => 500, "message" => "visit id required!", "data" => []], 500);
            }

            if ($request->orderProduct) {

                $order_product = json_decode($request->orderProduct);

                foreach ($order_product as $item) {

                    $employeeOrder = new EmployeeOrderProduct();
                    $employeeOrder->visit_id = $request->query("visitId");
                    $employeeOrder->employee_id = $request->query('employeeId');
                    $employeeOrder->product_id = $item->id;
                    $employeeOrder->quantity = $item->quantity;
                    $employeeOrder->save();
                }
            }

            if ($request->gifts) {
                $order_gift = json_decode($request->gifts);
                foreach ($order_gift as $item) {
                    $product_stock = ItemStock::where("item_id", $item->id)->get();

                    $actual_quantity = $item->quantity;

                    foreach ($product_stock as $stockItem) {
                        if ($actual_quantity > 0 && $stockItem->quantity > 0) {
                            if ($stockItem->quantity >= $actual_quantity) {
                                $updateProductStock = $stockItem->quantity - $actual_quantity;
                                $actual_quantity = 0;
                                ItemStock::whereId($stockItem->id)->update(["quantity" => $updateProductStock]);
                            } else {
                                $actual_quantity = $actual_quantity - $stockItem->quantity;
                                ItemStock::whereId($stockItem->id)->update(["quantity" => 0]);
                            }
                        }
                    }

                    $employeeGift = new EmployeeOrderGift();
                    $employeeGift->visit_id = $request->query('visitId');
                    $employeeGift->employee_id  = $request->query('employeeId');
                    $employeeGift->gift_id  = $item->id;
                    $employeeGift->quantity  = $item->quantity;
                    $employeeGift->save();
                }
            }

            return response()->json(["status" => 200, "message" => "success", "data" =>  []], 200);
        } catch (Exception $e) {
            return response()->json(["status" => 500, "message" => $e->getMessage(), "data" => []], 500);
        }
    }

    public function getVisits(Request $request)
    {
        try {
            $products_data = EmployeeVisit::whereTourId($request->query("tourId"))->get();

            return response()->json(["status" => 200, "message" => "success", "data" =>  $products_data], 200);
        } catch (Exception $e) {
            return response()->json(["status" => 500, "message" => $e->getMessage(), "data" => []], 500);
        }
    }
}
