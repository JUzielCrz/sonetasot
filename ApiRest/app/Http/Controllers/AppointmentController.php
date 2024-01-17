<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\User;
use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return response()->json([ 'msg_text'=>'Registrado Correctamente']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAppointmentRequest $request)
    {
        DB::beginTransaction();

        try {

            // Crear el nuevo usuario
            $user = User::where('email',$request->email)->first();
            if (!$user) {
                $user =new User();
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = Hash::make($request->password) ;
                $user->save();
            }

            // Crear la cita relacionada con el usuario
            $appointment = $user->appointments()->create([
                'name' => $request->input('name'),
                'last_name' => $request->input('last_name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'date' => $request->input('date'),
                'curp' => $request->input('curp'),
                'user_id' => $user->id,
            ]);

            DB::commit();
            return response()->json(['data' => $appointment], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        try {
            return response()->json(['appointment' => $appointment], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAppointmentRequest $request, Appointment $appointment)
    {
        DB::beginTransaction();

        try {
            $idUser = Auth::id();

            if ($idUser != $appointment->user_id) {
                return response()->json(['error' => 'No cuentas con permisos suficientes'], 200);
            }

            // Crear el nuevo usuario
            $user =User::find($appointment->user_id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password) ;
            $user->save();

            // Crear la cita relacionada con el usuario
            $appointment->name =  $request->name;
            $appointment->last_name =  $request->last_name;
            $appointment->email =  $request->email;
            $appointment->phone =  $request->phone;
            $appointment->date =  $request->date;
            $appointment->curp =  $request->curp;
            $appointment->save();

            DB::commit();

            return response()->json(['data' => $appointment], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        try {
            $idUser = Auth::id();

            if ($idUser == $appointment->user_id) {
                $appointment->delete();
                return response()->json(['success' => 'Eliminado Correctamente'], 200);
            }

            return response()->json(['error' => 'No tienes los suficientes permisos'], 403);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
