<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
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

            $employee = Employee::whereId($request->query('employeeId'))->with('tour_programmes')->get();
            return response()->json(["status" => 200, "message" => "success", "data" =>  $employee], 200);
        } catch (Exception $e) {
            return response()->json(["status" => 500, "message" => $e->getMessage(), "data" => []], 500);
        }
    }






}
