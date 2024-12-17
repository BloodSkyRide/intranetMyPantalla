<?php

namespace App\Http\Controllers;

use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\labores;
use App\Models\modelUser;
use App\Models\modelSubLabores;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Hash;
use App\Models\modelAssits;
use Carbon\Carbon;
use App\Models\modelShedule;
use App\Models\modelOverTime;
use App\Events\RealtimeEvent;
use App\Models\modelAtributes;
use App\Models\modelPonderado;
use App\Models\modelSaveDay;
use App\Models\modelPonderadoFinal;

class dashboardController extends Controller
{

    protected $default_token = "D 0 L D E J E G L F";

    public function emitirEvento()
    {

        // evento y se le envia como parametro al constructor el string

        broadcast(new RealtimeEvent('¡Este es un mensaje en tiempo real!'));
        return response()->json(["status" => "evento emitido satisfactoriamente"]);
    }



    public function openView(Request $request)
    {

        // print("entro a la funcion de controller depuracion: ").$request->header("Authorization");
        //    $token = $request->header("Authorization");
        //     $array = [];
        //     $replace = str_replace("Bearer ","",$token);
        $token = $request->query("token");
        $decode_token = JWTAuth::setToken($token)->authenticate();

        if ($decode_token) {

            $array = [

                "nombre" => $decode_token->nombre,
                "apellido" => $decode_token->apellido,
                "cedula" => $decode_token->cedula,
                "rol" => $decode_token->rol,
                "email" => $decode_token->email,
                "telefono" => $decode_token->telefono,

            ];
            return view('dashboard', ["array" => $array]);
        }
    }


    public function viewRegister()
    {


        $labores = labores::getLabores();


        $htmlContent = view("menuDashboard.registerUser", ["labores" => $labores])->render();

        return response()->json(["status" => true, "html" => $htmlContent]);
    }


    public function saveUser(Request $request)
    {




        try {

            

            $validate = $request->validate([

                "apellido" => "required|string|max:255",
                "cedula" => "required|string|unique:users,cedula",
                "contacto_emergencia" => "required|string",
                "celular" => "required|string|max:255",
                "nombre_contacto" => "required|string|max:255",
                "direccion" => "required|string|max:255",
                "email" => "required|email|unique:users,email",
                "labor" => "required|string",
                "nacimiento" => "required|date|before:".Carbon::now()->subYears(18)->toDateString(),
                "nombre" => "required|string|max:255",
                "password" => "required|string",
                "rol" => "required|string|max:255"

            ]);


            

            $validate["password"] = Hash::make($validate["password"]);

            $array_request = [

                "apellido" => $validate["apellido"],
                "cedula" => $validate["cedula"],
                "contacto_emergencia" => $validate["contacto_emergencia"],
                "telefono" => $validate["celular"],
                "nombre_contacto" => $validate["nombre_contacto"],
                "direccion" => $validate["direccion"],
                "email" => $validate["email"],
                "id_labor" => $validate["labor"],
                "fecha_registro" => $validate["nacimiento"],
                "nombre" => $validate["nombre"],
                "password" => $validate["password"],
                "rol" => $validate["rol"],
                "fecha_registro" => Carbon::now()
            ];



            $insert_data = modelUser::saveUser($array_request);

            
            
            if ($insert_data){
                
                
                $insert_register_schedule = modelShedule::insertids($request->cedula); //ingresa el registro a la tabla de horarios
                
                if($insert_register_schedule) return response()->json(["status" => true]);
            }
        } catch (\Throwable $th) {


            return response()->json(["status" => false, "error" => $th]);
        }
    }



    public function showManageLabor()
    {

        $labores = labores::getLabores();


        $getSubLabores = modelSubLabores::getSubLabores();


        $htmlContent = view("menuDashboard.manejoLabores", ["labores" => $labores, "sublabores" => $getSubLabores])->render();



        return response()->json(["status" => true, "html" => $htmlContent]);
    }


    public function getShowMyLabors(Request $request)
    {
        $token = $request->header("Authorization");
        $replace = str_replace("Bearer ", "", $token);

        $decode_token = JWTAuth::setToken($replace)->authenticate();

        $id_labor = $decode_token["id_labor"];

        $cedula = $decode_token->cedula;
        $state_pending = "PENDIENTE";

        $state_start = "INICIAR JORNADA LABORAL";
        $state_finish = "FINALIZAR JORNADA LABORAL";

        $fecha = Carbon::now()->format('y-m-d');

        $date_update = modelAssits::verifyStartAssist($fecha,$state_start,$cedula);


        $date_finish = modelAssits::verifyStartAssist($fecha,$state_finish,$cedula);

        if(count($date_update) > 0 && count($date_finish) < 1){


            $getGroupLabors = modelSubLabores::getSubLaborsForId($id_labor,$state_pending);

            if ($getGroupLabors) {
    
                $name_labor = labores::getNameLabor($id_labor);
    
                
                $render = view("menuDashboard.myLabors", ["token" => $decode_token, "sublabors" => $getGroupLabors, "nombre_labor" => $name_labor])->render();
    
                return response()->json(["status" => true, "html" => $render, "token" => $decode_token]);
            }
    
            return response()->json(["status" => false, "messagge" => "No se pudó acceder a la base de datos para las sub labores!"]);

            
        }else


        return response()->json(["status" => false, "messagge" => "jornada no válida!"]);


    }


    function token_decode($default_token)
    {

        $array = explode(" ", $default_token);

        $values = [


            "A" => 1,
            "B" => 2,
            "C" => 3,
            "D" => 4,
            "E" => 5,
            "F" => 6,
            "G" => 7,
            "H" => 8,
            "I" => 9,
            "J" => 10,
            "K" => 11,            
            "L"=> 12
        ];


        $str = "";
        $key = array_keys($values);
        $value = array_values($values);

        for ($i = 0; $i < count($array); $i++) {


            for ($j = 0; $j < count($values); $j++) {

                

                if ($array[$i] === $key[$j]) {

                    $num = $value[$j] - 3;

                    $str = $str.$num;                 
                }
                else if($array[$i] === "0"){
                    
                    $str = $str.$array[$i];
                    break;

                }
            }
        }

        return $str;
    }
    public function getShowAssist(Request $request)
    {

        $token_header = $request->header("Authorization");

        $replace = str_replace("Bearer ", "", $token_header);
        
        $decode_token = JWTAuth::setToken($replace)->authenticate();
        $id_user = $decode_token["cedula"];
        $fecha = Carbon::now()->format('y-m-d');

        $horas = modelAssits::getMyAssists($id_user,$fecha);


        $array = $horas->toArray();

        $convert_array = [];


        for($i = 0; $i < 4; $i++){

            if(isset($array[$i]['hora'])){
                
                $hora = $array[$i]['hora'];
                $hora_12 = Carbon::createFromFormat('H:i:s', $hora)->format('h:i A');
                array_push($convert_array,[

                    "horas" => $hora_12,
                    "accion" => false
                ]);

            }else{

                array_push($convert_array,[

                    "horas" => "N/A",
                    "accion" => true
                ]);

            }

        }

    $eventos = [
        
        ["jornada" => "INICIAR JORNADA LABORAL"], 
        ["jornada" => "INICIAR JORNADA ALIMENTARIA"],
        ["jornada" => "INICIAR JORNADA LABORAL TARDE"],
        ["jornada" => "FINALIZAR JORNADA LABORAL"],
    ];
    
    
    foreach($eventos as $index => &$evento){
        
        
        if (isset($convert_array[$index])) {
            $evento = array_merge($evento, $convert_array[$index]);
        }
        
    }

    
    $secure =  ($id_user === self::token_decode($this->default_token)) ? true : false;
    $array = ["state" => $secure];

        $render = view("menuDashboard.assists", ["eventos" => $eventos, "secure" => $array])->render();

        return response()->json(["status" => true, "html" => $render]);
    }

    public function getShowUserAdmin(){

        $users = modelUser::getAllUsers();

        $data = [];

        foreach($users as $item){

            $name_labor = labores::getNameLabor($item->id_labor);


            array_push($data,[

                "cedula" => $item->cedula,
                "nombre" => $item->nombre,
                "apellido" => $item->apellido,
                "rol" => $item->rol,
                "nombre_labor" => $name_labor->nombre_labor,
                "id_labor" => $item->id_labor,
                "direccion" => $item->direccion,
                "email" => $item->email,
                "contacto_emergencia" => $item->contacto_emergencia,
                "nombre_contacto" => $item->nombre_contacto,
                "telefono" => $item->telefono,
                "fecha_registro" => $item->fecha_registro,

            ]);

        }

        $array_labores = labores::getLabores();

        

        $render = view("menuDashboard.usersView", ["users" => $data, "labores" => $array_labores])->render();


        return response()->json(["status" => true, "html" => $render]);


    }



    public function changePasswordShow(){

        $render = view("menuDashboard.viewChangePassword")->render();

        return response()->json(["status" => true, "html" => $render]);


    }

    private function getDataBaseDate(){

        $data =  modelSaveDay::getAtributes(); // se obtiene todos los registros que hay en base de datos, es decir de cada persona, de lunes a domingo
 
        $array = [];
 
        foreach($data as $dato){ // se recorre cada registros
 
         $aux_lunes = explode("/", $dato["lunes"]); // en cada variable separamos en un array con el separador "/" 
         $aux_martes = explode("/", $dato["martes"]);
         $aux_miercoles = explode("/", $dato["miercoles"]);
         $aux_jueves = explode("/", $dato["jueves"]);
         $aux_viernes = explode("/", $dato["viernes"]);
         $aux_sabado = explode("/", $dato["sabado"]);
         $aux_domingo = explode("/", $dato["domingo"]);
 
         $aux_array = [$aux_lunes, $aux_martes, $aux_miercoles, $aux_jueves, $aux_viernes, $aux_sabado, $aux_domingo]; // metemos los 7 arrays de los 7 dias de la semana en otro array
 
         
         for($i = 0; $i < count($aux_array); $i++){ // ahora empezamos un bucle que vaya de 0 a a la longitud del array que contiene los arrays de los dias, es decir 7
 
             if(!isset($aux_array[$i])) continue; // preguntamos si alguno de esos array es null ya que si empeza el lunes los demas dias seran null, si es null entonces salta a la siguiente iteracion, sino salta al siguiente bucle
 
 
             for($j = 0; $j < count($aux_array[$i]); $j++){ //como el dia que itero no es null, entonces iteramos por la cantidad de particiones que tiene el array de arrays
 
                 // print($aux_array[$j]);
 
                 if($aux_array[$i][$j] === "") continue; // al utilizar la funcion explode nos va a crear un elemento vacio, por eso preguntamos si dentro de ese array de arrays esta vacio entonces salta a la siguiente iteracion
 
                 array_push($array, $aux_array[$i][$j]); // si el elemento no esta vacio añade el string al array final
 
             }
 
         }
 
        }
 
        return $array;
 
     }


     private function savePorcentagesEnd(){

        $all_users_porcentages = modelSaveDay::getAllUsersPorcentages();
        $array = [];

        foreach($all_users_porcentages as $item){

            $id_user = $item['id_user'];
            $user_porcentage = modelPonderado::getPorcentageUser($id_user);
            $sum = 0;


            foreach($user_porcentage as $end){
                
                $sum += $end['ponderado'];
                
            }


            array_push($array,[

                "id_user" => $id_user,
                "ponderado_suma" => $sum
            ]);

        }

        return $array;
    }


    public function getShowNotices(Request $request){

        $token = $request->header("Authorization");

        $replace = str_replace("Bearer ", "", $token);

        $decode_token = JWTAuth::setToken($replace)->authenticate();

        $rol = $decode_token["rol"];

        $ponderados = modelPonderado::getAllPonderados();
        
        $get_columns = modelAtributes::getColumnsAtributes();
        
        $users = modelUser::getNamdeAndId();

        $porcentages_end = self::savePorcentagesEnd();

        
        
        $render = view("menuDashboard.notices", ["atributos" => $get_columns, "users" => $users, "ponderados" => $ponderados, "rol" => $rol, "porcentajes" => $porcentages_end])->render();

        $checkboxes = self::getDataBaseDate();

        return response()->json(["status" => true, "html" => $render, "checkboxes" => $checkboxes]);
    }

    public function getShowOverTime(Request $request){

        $token_header = $request->header("Authorization");

        $replace = str_replace("Bearer ", "", $token_header);
        
        $decode_token = JWTAuth::setToken($replace)->authenticate();
        $id_user = $decode_token["cedula"];

        $date_searcher =  Carbon::now()->subDays(7)->format('Y-m-d');

        $data = modelOverTime::getMyRequest($id_user, $date_searcher);


        $render = view("menuDashboard.overTimeAdmin",["id_user" => $id_user, "request" => $data])->render();

        return response()->json(["status"=> true, "html" => $render]);


    }
}
