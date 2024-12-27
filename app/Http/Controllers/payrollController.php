<?php

namespace App\Http\Controllers;

use App\Models\modelUser;
use App\Models\modelPayRoll;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class payrollController extends Controller
{

    public function getshowpayroll(Request $request)
    {



        $users_id = modelUser::getAllUsers();


        $render = view("menuDashboard.payRoll", ["users" => $users_id])->render();

        return response()->json(["status" => true, "html" => $render]);
    }



    public function getHistoryPayRoll(Request $request)
    {


        $cedula = $request->query("cedula");


        $token_header = $request->header("Authorization");

        $replace = str_replace("Bearer ", "", $token_header);

        $decode_token = JWTAuth::setToken($replace)->authenticate();

        $rol = $decode_token["rol"];


        $history = modelPayRoll::getHistoryPayRoll($cedula);


        $nombre = modelUser::getName($cedula)->nombre;
        $apellido = modelUser::getLastName($cedula)->apellido;
        $render = view("menuDashboard.payRollHistory", ["history" => $history, "nombre" => $nombre, "apellido" => $apellido, "rol" => $rol])->render();

        return response()->json(["status" => true, "html" => $render]);
    }

    public function downloadPdf($nombre_archivo)
    {

        $ruta = storage_path('app/public/nominas/' . $nombre_archivo);

        $route = "storage/nominas/prueba_12345_2024-11-21.pdf";

        $url_end = str_replace("storage/", "", $route);



        if (Storage::disk('public')->exists($ruta)) {


            return response()->download($ruta);
        }

        print("NO existe el archivo");
    }


    public function insertsPdfs(Request $request)
    {


        $request->validate([
            'file.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        $pdfs = $request->allFiles();



        $names_pdfs_array = self::savePdf($pdfs);


        if ($names_pdfs_array) {


            return response()->json(["status" => true]);
        }


        return response()->json(["status" => false]);
    }


    public function savePdf($array_pdf)
    {

        $hoy = Carbon::now()->format('Y-m-d');

        $validation = 0;


        try {

            foreach ($array_pdf as $user => $pdf) {

                $user_id = str_replace('user_', '', $user); // extraemos de la clave la cedula de cada usuario

                $imageData = file_get_contents($pdf->getRealPath());
                $imageBase64 = 'data:' . $pdf->getMimeType() . ';base64,' . base64_encode($imageData);
                
                // Imprimir el resultado para verificar:
                
                $jpg = PDF::loadView('menuDashboard.template_pdf', ["image" => $imageBase64, "id_user" => $user_id]);

                $file_name = $pdf->getClientOriginalName(); //se extrae el nombre del archivo
                $base_name = pathinfo($file_name, PATHINFO_FILENAME);


                $name_final = $base_name . "_" . $user_id . "_" . $hoy; // concatenamos el nombre del archivo con el id del user y la fecha en la que fue cargada

                $root_path1 = 'storage/nominas';

                $file_path = storage_path("app/public/nominas/{$name_final}.pdf");
                $path = $jpg->save($file_path);


                if ($path) {

                    $nombre = modelUser::getName($user_id);
                    $apellido = modelUser::getLastName($user_id);

                    $data = ["id_user" => $user_id, "nombre" => $nombre->nombre, "apellido" => $apellido->apellido, "url" => $root_path1 . "/" . $name_final . ".pdf", "fecha" => $hoy];

                    $insert = modelPayRoll::insertPDF($data);

                    if ($insert) {


                        $validation++;
                    }
                }
            }



            return ($validation ===  count($array_pdf)) ? true : false;
        } catch (\Exception $e) {


            return response()->json(["error" => $e->getMessage()]);
        }
    }
}
