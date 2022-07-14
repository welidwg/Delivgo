<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\MailController;
use App\Jobs\TestJob;
use App\Models\Code;
use Twilio\Rest\Client;

class UserController extends Controller
{
    private function sendMessage($message, $recipients)
    {
        $account_sid = getenv("TWILIO_SID");
        $auth_token = getenv("TWILIO_AUTH_TOKEN");

        $twilio_number = getenv("TWILIO_NUMBER");
        $client = new Client($account_sid, $auth_token);
        $client->messages->create(
            $recipients,
            ['from' => $twilio_number, 'body' => $message]
        );
    }

    //
    public function GenerateCode()
    {
        return \Str::random(5);
    }

    public function PasswordRecovery(Request $req)
    {
        $validate = Validator::make($req->all(), [
            'email' => "bail|required|email",
        ]);
        if ($validate->fails()) {
            return response(json_encode($validate->errors()), 500);
        }
        $email = $req->email;
        $user = User::where("email", $email)->first();
        if ($user) {
            if ($user->statut == 1) {
                return response(json_encode(["type" => "error", "message" => "You have not verified your email yet !"]), 500);
            } else {
                $mail = new MailController();
                $code = $this->GenerateCode();
                $codeModel = new Code;
                $current = date("Y-m-d H:i:s");
                $expirecy = date("Y-m-d H:i:s", strtotime($current . '+ 16 minute'));
                $codeModel->code = $code;
                $codeModel->expire = $expirecy;
                $codeModel->email = $email;
                $codeModel->type = "password";

                if ($codeModel->save()) {
                    $mail->SendPasswordRecovery($email, "recovery", $user->name, $code);
                    return response(json_encode(["type" => "success", "message" => "We have send you an email with a verification code , check your inbox or spam"]), 200);
                }
            }
        } else {
            return response(json_encode(["type" => "error", "message" => "There is no user registred with this email"]), 500);
        }
    }
    public function VerifyCodePassword(Request $req)
    {
        try {
            $code = $req->code;
            $validate = Validator::make($req->all(), [
                "code" => "required"
            ]);
            if ($validate->fails()) {
                return response(json_encode($validate->errors()), 500);
            }
            $codeverif = Code::where("code", $code)->first();
            if ($codeverif) {
                if ($codeverif->statut == "fresh") {
                    $email = $codeverif->email;
                    $codeverif->delete();
                    return response(json_encode(["type" => "success", "message" => "Good , now set up your  new password", "email" => $email]), 200);
                } else {

                    return response(json_encode(["type" => "error", "message" => "This code is expired ! Restart the operation "]), 500);
                }
            } else {
                return response(json_encode(["type" => "error", "message" => "This code is not valid"]), 500);
            }
        } catch (\Throwable $th) {
            return response(json_encode(["type" => "error", "message" => $th->getMessage()]), 500);
        }
    }
    public function UpdatePassword(Request $req)
    {

        try {
            $validate = Validator::make($req->all(), [
                "password" => "bail|required|min:8",
                "email" => "bail|required|email"
            ]);
            if ($validate->fails()) {
                return response(json_encode($validate->errors()), 500);
            }
            $password = $req->password;
            $email = $req->email;
            $user = User::where("email", $email)->first();
            if ($user) {
                $user->password = Hash::make($password);
                $user->save();
                return response(json_encode(["type" => "success", "message" => "Password updated successfully"]), 200);
            }
            return response(json_encode(["type" => "error", "message" => "User not found"]), 500);
        } catch (\Throwable $th) {
            return response(json_encode(["type" => "error", "message" => $th->getMessage()]), 500);
        }
    }
    // public function FirstRegister(Request $req)
    // {
    //     try {
    //         $email = $req->json("email");
    //         $name = $req->json("name");
    //         $mail = new MailController();
    //         $title = "E-mail Verification";
    //         $code = $this->GenerateCode();
    //         $codeModel = new Code;
    //         $current = date("Y-m-d H:i:s");
    //         $expirecy = date("Y-m-d H:i:s", strtotime($current . '+ 15 minute'));
    //         $codeModel->code = $code;
    //         $codeModel->expire = $expirecy;
    //         $codeModel->email = $email;
    //         $codeModel->type = "email";
    //         if ($mail->SendMail($email, $title, $name, $code)) {
    //             $codeModel->save();
    //             return response(json_encode(["type" => "success", "message" => "Email Sent Successfully"]), 200);
    //         } else {
    //             return response(json_encode(["type" => "error", "message" => "Something went wrong , please try again later ! "]), 500);
    //         }
    //     } catch (\Throwable $th) {
    //         return response(json_encode(["type" => "error", "message" => $th->getMessage()]), 500);
    //     }
    // }

    public function CreateUser(Request $req)
    {
        try {
            $validate = Validator::make($req->all(), [
                'email' => "bail|required|unique:users|email",
                'username' => "bail|required|unique:users",
                'name' => "bail|required",
                'phone' => "bail|required|unique:users",
                'password' => 'bail|min:8|required',
            ]);
            if ($validate->fails()) {
                return response(json_encode($validate->errors()), 500);
            }
            $email = $req->email;
            $username = $req->username;
            $name = $req->name;
            $password = Hash::make($req->password);
            $phone = $req->phone;
            $type = $req->type;
            $state = "Tunisia";
            $user = new User;
            if ($req->hasFile("avatar")) {
                $file = $req->file("avatar");
                $file_name = time() . "." . $file->getClientOriginalExtension();
                $file->move("uploads/logos", $file_name);
                $user->avatar = $file_name;
            } else {
                $user->avatar = "d3.jpg";
            }
            $statut = 1;
            $user->name = $name;
            $user->username = $username;
            $user->email = $email;
            $user->password = $password;
            $user->phone = $phone;
            $user->type = $type;
            $user->state = $state;

            $user->statut = $statut;
            $mail = new MailController();
            $title = "E-mail Verification";
            $code = $this->GenerateCode();
            $codeModel = new Code;
            $current = date("Y-m-d H:i:s");
            $expirecy = date("Y-m-d H:i:s", strtotime($current . '+ 15 minute'));
            $codeModel->code = $code;
            $codeModel->expire = $expirecy;
            $codeModel->email = $email;
            $codeModel->type = "email";

            if ($mail->SendMail($email, $title, $name, $code)) {
                if ($user->save()) {
                    $codeModel->save();
                    return response(json_encode(["type" => "success", "message" => "Account created successfully"]), 200);
                } else {
                    $user->delete();
                }
            } else {
                return response(json_encode(["type" => "error", "message" => "Something went wrong , please try again later ! "]), 500);
            }
        } catch (\Throwable $th) {
            return response(json_encode(["type" => "error", "message" => $th->getMessage()]), 500);
        }
    }



    public function VerifyCode(Request $req)
    {
        try {
            $code = $req->json("code");
            $validate = Validator::make($req->all(), [
                "code" => "required"
            ]);
            if ($validate->fails()) {
                return response(json_encode($validate->errors()), 500);
            }
            $codeverif = Code::where("code", $code)->first();
            if ($codeverif) {
                if ($codeverif->statut == "fresh") {
                    $user = User::where("email", $codeverif->email)->first();
                    $user->statut = 2;
                    $user->save();

                    $codeverif->delete();
                    return response(json_encode(["type" => "success", "message" => "All is good ! Welcome to Delivgo"]), 200);
                } else {

                    return response(json_encode(["type" => "error", "message" => "This code is expired ! Request another one "]), 500);
                }
            } else {
                return response(json_encode(["type" => "error", "message" => "This code is not valid"]), 500);
            }
        } catch (\Throwable $th) {
            return response(json_encode(["type" => "error", "message" => $th->getMessage()]), 500);
        }
    }
    public function Login(Request $req)
    {
        try {

            $validate = Validator::make($req->all(), [
                'email' => "bail|required|email",
                'password' => "bail|required"
            ]);

            if ($validate->fails()) {
                return response(json_encode($validate->errors()), 500);
            }

            $user = User::where("email", $req->email)->first();
            if ($user) {
                if ($user->statut == 1) {
                    return response(json_encode(["type" => "error", "message" => "You have not verified your email yet !", "email" => $req->email]), 500);
                }
                $cred = ["email" => $req->email, "password" => $req->password];
                if (Auth::attempt($cred)) {
                    return response(json_encode(["type" => "success", "message" => "logged in", "user" => $user->type]), 200);
                } else {
                    return response(json_encode(["type" => "error", "message" => "invalid credentials"]), 500);
                }
            }
            return response(json_encode(["type" => "error", "message" => "invalid credentials"]), 500);
        } catch (\Throwable $th) {
            return response(json_encode(["type" => "error", "message" => $th->getMessage()]), 500);
        }
    }
    public function ResendCode(Request $req)
    {

        try {
            $email = $req->email;
            $type = $req->type;
            $user = User::where("email", $email)->first();
            $codev = Code::where("email", $email)->where("type", $type)->first();
            $current = date("Y-m-d H:i:s");
            $expirecy = date("Y-m-d H:i:s", strtotime($current . '+ 15 minute'));
            $mail = new MailController();

            if ($codev) {
                if ($codev->statut == "expired") {
                    $codev->statut = 'fresh';
                    $codev->expire = $expirecy;
                }
                $code = $codev->code;
                $codev->save();
            } else {
                $code = $this->GenerateCode();
                $newCode = new Code;
                $newCode->code = $code;
                $newCode->expire = $expirecy;
                $newCode->statut = 'fresh';
                $newCode->type = 'email';
                $newCode->email = $email;
                $newCode->save();
            }

            if ($mail->SendMail($email, "Resend Code", $user->name, $code)) {
                return response(json_encode(["type" => "success", "message" => "We've resent you the verification code"]), 200);
            }
        } catch (\Throwable $th) {
            return response(json_encode(["type" => "error", "message" => $th->getMessage()]), 500);
        }
    }


    public function Logout()
    {
        Auth::logout();

        return redirect()->to("/");
    }



    public function GetUser($id)
    {
        $user = User::where("user_id", $id)->first();
        if ($user) {
            return response(json_encode($user), 200);
        }
        return response(json_encode(["type" => "error", "message" => "User not found"]), 500);
    }
    public function UpdateUser(Request $req, $id)
    {
        try {
            $id = $id;
            $user = User::where("user_id", $id)->first();
            if ($user) {
                $validate = Validator::make($req->all(), [
                    'email' => ["bail", "required", "email", Rule::unique("users")->ignore($user->user_id, "user_id")],
                    'username' => ["bail", "required", Rule::unique("users")->ignore($user->user_id, "user_id")],
                    'name' => "bail|required",
                    'address' => "bail|required",
                    'city' => "bail|required",
                    'phone' => ["bail", "required", Rule::unique("users")->ignore($user->user_id, "user_id")],
                ]);
                if ($validate->fails()) {
                    return response(json_encode($validate->errors()), 500);
                }
                $email = $req->email;
                $username = $req->username;
                $name = $req->name;
                $password = $user->password;
                if ($req->password) {

                    $password = Hash::make($req->password);
                }
                if ($user->type == 2) {
                    $user->deliveryPrice = $req->deliveryPrice;
                }
                $phone = $req->phone;
                $city = $req->city;
                $address = $req->address;
                $user->name = $name;
                $user->username = $username;
                $user->email = $email;
                $user->password = $password;
                $user->phone = $phone;
                $user->city = $city;
                $user->address = $address;
                if ($user->save()) {
                    return response(json_encode(["type" => "success", "message" => "Account updated successfully"]), 200);
                }
            }
        } catch (\Throwable $th) {
            //throw $th;
            return response(json_encode(["type" => "error", "message" => $th->getMessage()]), 500);
        }
    }
    public function UpdateLogo(Request $req, $id)
    {

        try {
            $user = User::where("user_id", $id)->first();
            if ($user->avatar != "") {
                unlink(base_path() . "/public/uploads/logos/$user->avatar");
            }
            $file = $req->file("avatar");
            $file_name = time() . "." . $file->getClientOriginalExtension();
            $file->move("uploads/logos", $file_name);
            $user->avatar = $file_name;
            $user->save();
            return response(json_encode(["type" => "success", "message" => "Logo Updated Successfully"]), 200);
        } catch (\Throwable $th) {
            // return response(json_encode(["type" => "error", "message" => $th->getMessage()]), 500);
        }
    }
    public function DeleteUser($id)
    {
        try {
            $user = User::where("user_id", $id)->first();
            $user->delete();
            return response(json_encode(["type" => "success", "message" => "Account deleted successfully"]), 200);
        } catch (\Throwable $th) {
            return response(json_encode(["type" => "error", "message" => $th->getMessage()]), 500);
        }
    }
    public function GetAllUsers()
    {
        try {
            $users = User::get();
            if ($users->count() > 0) {
                return response(json_encode($users), 200);
            }
            return response(json_encode(["type" => "error", "message" => "There is no users yet"]), 500);
        } catch (\Throwable $th) {
            return response(json_encode(["type" => "error", "message" => $th->getMessage()]), 500);
        }
    }
    public function GetAllRestau()
    {
        try {
            $users = User::where("type", 2)->with("products")->get();
            if ($users->count() > 0) {
                return response(json_encode($users), 200);
            }
            return response(json_encode(["type" => "error", "message" => "There is no restaurants yet"]), 500);
        } catch (\Throwable $th) {
            return response(json_encode(["type" => "error", "message" => $th->getMessage()]), 500);
        }
    }
}
