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
use App\Models\Region;
use App\Models\RestoConfig;
use Nette\Utils\Random;
use Twilio\Rest\Client;

class UserController extends Controller
{
    public function sendMessage($message, $recipients)
    {
        // $account_sid = getenv("TWILIO_SID");
        // $auth_token = getenv("TWILIO_AUTH_TOKEN");
        $key = getenv("MESSAGE_BIRD_KEY");
        $id = getenv("MESSAGE_BIRD_ID");
        $messagebird = new \MessageBird\Client($key);
        $message = new \MessageBird\Objects\Message;
        $message->originator = 'SDKDemo';
        $message->recipients = ['+21697488241'];
        $message->body = 'Hello World, I am a text message and I was hatched by PHP code!';
        $response = $messagebird->messages->create($message);
        var_dump($response);



        // $twilio_number = getenv("TWILIO_NUMBER");
        // $client = new Client($account_sid, $auth_token);
        // $client->messages->create(
        //     $recipients,
        //     ['from' => $twilio_number, 'body' => $message]
        // );

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
                return response(json_encode(["type" => "error", "message" => "Vous n'avez pas encore vérifier votre email!"]), 500);
            } else {
                $mail = new MailController();
                $code = $this->GenerateCode();
                $codeModel = new Code;
                $current = date("Y-m-d H:i:s");
                $expirecy = date("Y-m-d H:i:s", strtotime($current . '+ 15 minute'));
                $codeModel->code = $code;
                $codeModel->expire = $expirecy;
                $codeModel->email = $email;
                $codeModel->type = "password";

                if ($codeModel->save()) {
                    $mail->SendPasswordRecovery($email, "recovery", $user->name, $code);
                    return response(json_encode(["type" => "success", "message" => "Nous avons envoyer un email content un code de verification."]), 200);
                }
            }
        } else {
            return response(json_encode(["type" => "error", "message" => "Aucun utilisateur est enregistré avec cet email !"]), 500);
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
                    return response(json_encode(["type" => "success", "message" => "Bien , maintenant changer votre mot de passe", "email" => $email]), 200);
                } else {

                    return response(json_encode(["type" => "error", "message" => "TCe code est expiré ! Recommencez l'opération. "]), 500);
                }
            } else {
                return response(json_encode(["type" => "error", "message" => "Ce code n'est pas valide"]), 500);
            }
        } catch (\Throwable $th) {
            return response(json_encode(["type" => "error", "message" => $th->getMessage()]), 500);
        }
    }
    public function UpdatePassword(Request $req)
    {

        try {
            $message = [
                "required" => "le champ :attribute est requis",
                "min" => "le mot de passe doit comporte au minimum :min caractere"
            ];
            $validate = Validator::make($req->all(), [
                "password" => "bail|required|min:8",
                "email" => "bail|required|email"
            ], $message);
            if ($validate->fails()) {
                return response(json_encode($validate->errors()), 500);
            }
            $password = $req->password;
            $email = $req->email;
            $user = User::where("email", $email)->first();
            if ($user) {
                $user->password = Hash::make($password);
                $user->save();
                return response(json_encode(["type" => "success", "message" => "Mot de passe modifiée avec succès"]), 200);
            }
            return response(json_encode(["type" => "error", "message" => "Utilisateur non trouvé"]), 500);
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
            $customMessages = [
                'required' => 'Le :attribute est requis.',
                'unique' => 'Ce :attribute est déjà utlisé.',
                'min' => 'Le mot de passe doit comporter au minimum :min caractères',
            ];

            $validate = Validator::make($req->all(), [
                'email' => "bail|required|unique:users|email",
                'name' => "bail|required",
                'phone' => "bail|required|unique:users",
                'password' => 'bail|min:8|required',
            ], $customMessages);
            if ($validate->fails()) {
                return response(json_encode($validate->errors()->all()), 500);
            }
            $email = $req->email;
            $name = $req->name;
            $password = Hash::make($req->password);
            $phone = $req->phone;
            // $phone2 = $req->phone2;
            if (substr($phone, 0, 1) !== "9" &&  substr($phone, 0, 1) !== "2" && substr($phone, 0, 1) !== "5" && substr($phone, 0, 1) !== "4") {
                return response(json_encode(["type" => "error", "message" => "Veuillez introduire un numéro valide"]), 500);
            }
            $type = $req->type;
            $state = "Tunisia";
            $user = new User;
            if ($req->hasFile("avatar")) {
                $file = $req->file("avatar");
                $file_name = time() . "." . $file->getClientOriginalExtension();
                $file->move("uploads/logos", $file_name);
                $user->avatar = $file_name;
            } else {
                $user->avatar = "default.jpg";
            }
            $statut = 2;
            $user->name = $name;
            $user->username = Random::generate(6, "0-9a-z");
            $user->email = $email;
            $user->password = $password;
            $user->phone = $phone;
            // $user->phone2 = $phone2;
            $user->type = $type;
            $user->state = $state;

            $user->statut = $statut;


            if ($user->save()) {
                if (Auth::check()) {
                    if (Auth::user()->type == 4) {
                        $mail = new MailController();
                        $mail->NewAccount($email, $req->password);
                    }
                }
                return response(json_encode(["type" => "success", "message" => "Compte crée avec succès"]), 200);
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
                    return response(json_encode(["type" => "success", "message" => "Tout va bien ! Bienvnue chez Delivgo"]), 200);
                } else {

                    return response(json_encode(["type" => "error", "message" => "Ce code est expiré ! Demandez un autre "]), 500);
                }
            } else {
                return response(json_encode(["type" => "error", "message" => "Ce code n'est pas valide"]), 500);
            }
        } catch (\Throwable $th) {
            return response(json_encode(["type" => "error", "message" => $th->getMessage()]), 500);
        }
    }
    public function Login(Request $req)
    {
        try {
            $customMessages = [
                'required' => 'Numéro et mot de passe sont requis',
            ];

            $validate = Validator::make($req->all(), [
                'phone' => "bail|required|",
                'password' => "bail|required"
            ], $customMessages);

            if ($validate->fails()) {
                return response(json_encode($validate->errors()), 500);
            }

            $user = User::where("phone", $req->phone)->first();
            if ($user) {
                // if ($user->statut == 1) {
                //     return response(json_encode(["type" => "error", "message" => "Vous n'avez pas encore vérifier votre email!", "email" => $req->email]), 500);
                // }
                $cred = ["phone" => $req->phone, "password" => $req->password];
                if (Auth::attempt($cred)) {
                    return response(json_encode(["type" => "success", "message" => "Bien connecté", "user" => $user->type, "id" => $user->user_id]), 200);
                } else {
                    return response(json_encode(["type" => "error", "message" => "Numéro ou mot de passe non valide"]), 500);
                }
            }
            return response(json_encode(["type" => "error", "message" => "Téléphone ou mot de passe non valide"]), 500);
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
                return response(json_encode(["type" => "success", "message" => "Code renvoyé"]), 200);
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
            $customMessages = [
                'required' => 'Le :attribute est requis.',
                'min' => 'Le mot de passe doit comporter au minimum :min caractères',
            ];
            if ($user) {
                $validate = Validator::make($req->all(), [
                    'email' => ["bail", "required", "email", Rule::unique("users")->ignore($user->user_id, "user_id")],
                    'name' => "bail|required",
                    'address' => "bail|required",
                    'city' => "bail|required",
                    'phone' => ["bail", "required", Rule::unique("users")->ignore($user->user_id, "user_id")],
                ], $customMessages);
                if ($validate->fails()) {
                    return response(json_encode($validate->errors()), 500);
                }
                $email = $req->email;
                $name = $req->name;
                $password = $user->password;
                if ($req->password) {

                    $password = Hash::make($req->password);
                }
                if ($user->type == 2) {
                    // $user->deliveryPrice = $req->deliveryPrice;
                    $check = RestoConfig::where("resto_id", $id)->first();
                    if ($check) {
                        $check->perSupp = $req->perSupp;
                        $check->perTopp = $req->perTopp;
                        $check->perSauce = $req->perSauce;
                        $check->perDrink = $req->perDrink;
                        $check->save();
                    } else {
                        $newConfig = new RestoConfig;
                        $newConfig->resto_id = $id;

                        $newConfig->perSupp = $req->perSupp;
                        $newConfig->perTopp = $req->perTopp;
                        $newConfig->perSauce = $req->perSauce;
                        $newConfig->perDrink = $req->perDrink;
                        $newConfig->save();
                    }
                }
                $phone = $req->phone;
                $city = $req->city;
                $address = $req->address;
                $user->name = $name;
                $user->email = $email;
                $user->password = $password;
                $user->phone = $phone;
                $user->city = $city;
                $user->address = $address;
                if ($user->save()) {
                    return response(json_encode(["type" => "success", "message" => "Compte mis à jour"]), 200);
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
            if ($user->avatar != "" && $user->avatar != "default.jpg") {
                unlink(base_path() . "/public/uploads/logos/$user->avatar");
            }
            $file = $req->file("avatar");
            $file_name = time() . "." . $file->getClientOriginalExtension();
            $file->move("uploads/logos", $file_name);
            $user->avatar = $file_name;
            $user->save();
            return response(json_encode(["type" => "success", "message" => "Avatar modifié"]), 200);
        } catch (\Throwable $th) {
            return response(json_encode(["type" => "error", "message" => $th->getMessage()]), 500);
        }
    }
    public function DeleteUser($id)
    {
        try {
            $user = User::where("user_id", $id)->first();
            $user->delete();
            return response(json_encode(["type" => "success", "message" => "Compte supprimé"]), 200);
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
    public function DutyManager($id)
    {
        try {
            $user = User::where("user_id", $id)->first();
            if ($user->onDuty) {
                $user->onDuty = 0;
            } else {
                $user->onDuty = 1;
            }
            $user->save();
            return response(json_encode(["type" => "success", "message" => "Disponibilité modifiée"]), 200);
        } catch (\Throwable $th) {
            return response(json_encode(["type" => "error", "message" => $th->getMessage()]), 500);
        }
    }
    public function UpdateAddress(Request $req, $id)
    {
        $user = User::where("user_id", $id)->first();
        $zone = $req->address;
        if (strpos($req->address, '%20') !== false) {
            $zone = str_replace("%20", " ", $req->address);
        }
        $check = Region::where("label", $zone)->first();
        if ($check) {
            $user->city = $check->id;
            $user->save();
            return response(json_encode(["type" => "success", "message" => "Ville à jour", "ville" => $req->address]), 200);
        } else {
            return response(json_encode(["type" => "error", "message" => "Ville n'est pas supportée", "address" => $req->address]), 500);
        }
    }
}
