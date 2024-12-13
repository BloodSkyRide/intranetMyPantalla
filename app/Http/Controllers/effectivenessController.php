<?php

namespace App\Http\Controllers;
use App\Models\modelUser;
use App\Models\modelAtributes;
use App\Models\modelSaveDay;
use App\Models\modelPonderado;

use Illuminate\Http\Request;

class effectivenessController extends Controller
{



    private function separateAndSave($array_columns){

        $registers = modelSaveDay::getIdUser();

        foreach($array_columns as $column => $values){

            

            foreach($registers as $register){

                

                $flag = 0;

                $id_user = $register['id_user'];

                $nombre_atributo_ponderado = $column;

                $porcentaje_ponderado = modelAtributes::getPorcentual($column)->porcentaje_efectividad;

                $nombre_user = modelUser::getUserName($id_user)->nombre;

                $id_atributo = modelAtributes::getIdForName($column)->id_atributo;


                foreach($values as $dato){
                    

                    if(str_contains($dato, $register['id_user'])){

                        $flag++;
                        
                    }

                }

                $calculate_unit = ($porcentaje_ponderado / 7);

                
                $final_calculate = $calculate_unit * $flag;
                
                $number_format = number_format($final_calculate, 2);

                
                $verify_registers = modelPonderado::verifyRegisters($id_user);

                
                
                 if(count($verify_registers) < count($array_columns)){

                     $data_insert = ["id_user" => $id_user, "nombre_user" => $nombre_user, "id_atributo" => $id_atributo, "nombre_atributo_ponderado" => $nombre_atributo_ponderado, "ponderado" => $number_format];
     
                     $insert = modelPonderado::insertDataPonderado($data_insert);

                 }else {

                    $edit = modelPonderado::editExists($id_user, $column, $number_format);
                 }

            }

        }

    }


    private function savePonderados(){
        // funcion que obtiene todo lo que hay en la tabla y organiza en un array por columnas los atributos
        $data = self::getDataBaseDate();

        $data_atributes = modelAtributes::getColumnsAtributes();

        $columns =[];


        foreach($data_atributes as $datas){ // se mete en un array los nombres de las columnas

            array_push($columns,

                $datas["nombre_atributo"] );

        }

        
        
        $array_columns = array_fill_keys($columns, []);// metemos dentro de array_columns los nombres de las columnas y inicializamos con array vacio

        foreach($data as $dato){ // recorremos todos los strings obtenidos de la base de datos

            foreach ($columns as $columna) { // recorremos todos los nombres de las columnas
                
                
                
                if(str_contains($dato, $columna)){ // preguntamos si el string proveniente de la base de datos contiene la cadena del nombre de la columna
                    
                    $array_columns[$columna][] = $dato; // de ser cierto ingresamos al nombre de esa columna e insertamos esa cadena de texto
                }
            }

        }

        
        
        
        self::separateAndSave($array_columns);
        
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
        $aux_viernes = explode("/", $dato["viernes"]);

        $aux_array = [$aux_lunes, $aux_martes, $aux_miercoles, $aux_jueves, $aux_viernes, $aux_sabado, $aux_viernes]; // metemos los 7 arrays de los 7 dias de la semana en otro array

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
    

    public function getShowEffectiveness(Request $request){

        $ponderados = modelPonderado::getAllPonderados();
        

        $get_columns = modelAtributes::getColumnsAtributes();
        
        $users = modelUser::getNamdeAndId();
        
        $render = view("menuDashboard.effectiveness", ["atributos" => $get_columns, "users" => $users, "ponderados" => $ponderados])->render();

        $checkboxes = self::getDataBaseDate();

        return response()->json(["status" => true, "html" => $render, "checkboxes" => $checkboxes]);
    }

    public function mergeArrays(){

        $data = modelUser::getNamdeAndId()->toArray();

        
        $get_columns = modelAtributes::getColumnsAtributes()->toArray();


        foreach($data as $index => &$user){

            if(isset($get_columns[$index])){


                $user = array_merge($user, $get_columns[$index]);
            }
        }

        return $data;
    }


    public function insertAtribute(Request $request){


        $name_atribute = $request->name;
        $porcentaje = $request->porcentaje;
        $today = date("Y-m-d");

        $data = ["nombre_atributo" => $name_atribute, "porcentaje_efectividad" => $porcentaje, "fecha" => $today];


        $insert = modelAtributes::insertAtribute($data);

        if($insert){

            return response()->json(["status" => true]);

        }

    }


    public function saveDay(Request $request){


        $data = $request->data;

        $result = self::insertDataDay($data);

        //self::savePonderados();
        self::savePonderados();

        return response()->json(["status" => $result]);
    }

    function insertDataDay($data){

        $long = count($data);
        $flagg = 0;
        $truncate_table = modelSaveDay::truncateTable();
        foreach ($data as $date) {

            //este array tiene  posiciones [dia,id_atributo,id_user, nombre_atributo] TENERLO EN CUENTA OJO!
            
            $array = explode("-", $date);
            $dia1 = strtolower(iconv('UTF-8', 'ASCII//TRANSLIT', $array[0])) ;
            $dia = preg_replace('/[^a-zA-Z0-9_ -]/', '', $dia1);
            $id_atributo = $array[1];
            $id_user = $array[2];
            $nombre_atributo = $array[3];
            $fecha = date("Y-m-d");
            $name_user = modelUser::getName($id_user)->nombre;

            $date_save = $dia."-".$id_atributo."-".$id_user."-".$nombre_atributo;

            $query_register = modelSaveDay::getRegister($id_user);

            if(count($query_register) == 0){


                $dato = ["id_user" => $id_user, "nombre_user" => $name_user, "fecha" => $fecha];
                modelSaveDay::insertRegister($dato);
            }


            $consulta = modelSaveDay::getAtributeForDay($id_user,$dia);

            $content_day = $consulta->$dia;
            
            if(empty($content_day)){


                modelSaveDay::saveAtribute($id_user, $dia, $date_save."/");


            }
            else{


                $aux = $content_day.$date_save."/";

            
                modelSaveDay::saveAtribute($id_user, $dia, $aux);
            }

            $flagg ++;

        }

        

        return ($flagg === $long) ? true : false;

    }
}
 