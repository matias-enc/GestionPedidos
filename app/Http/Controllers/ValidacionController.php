<?php

namespace App\Http\Controllers;

use App\Documentacion;
use App\Events\ValidacionSolicitada;
use App\Validacion;
use Illuminate\Http\Request;
use Cardumen\ArgentinaProvinciasLocalidades\Models\Pais;
use Cardumen\ArgentinaProvinciasLocalidades\Models\Provincia;
use Cardumen\ArgentinaProvinciasLocalidades\Models\Localidad;

class ValidacionController extends Controller
{
    public function validacion_datos()
    {
        $user = auth()->user();
        if ($user->validacion->aprobado == false) {
            if (sizeof($user->validacion->documentaciones) > 0) {
                return view('admin_panel.validacion.pendiente', compact('user'));
            }
            if ($user->dni == null) {
                $paises = Pais::all();
                return view('admin_panel.validacion.datos', compact('user', 'paises'));
            } else {
                return view('admin_panel.validacion.documentacion', compact('user'));
            }
        } else {
            return redirect()->route('auto_gestion')->withErrors('Usted ya se Encuentra Validado');
        }
    }
    public function validacion_provincias($pais)
    {
        $provincias = Provincia::all()->where('pais_id', $pais);
        return $provincias;
    }

    public function validacion_localidad($provincia)
    {
        $localidades = Localidad::where('provincia_id', $provincia)->get();
        // $localidades;
        return $localidades;
    }

    public function cargar_datos(Request $request)
    {
        // return $request;
        $user = auth()->user();
        $user->apellido = $request->apellido;
        $user->direccion = $request->direccion;
        $user->dni = $request->dni;
        $user->telefono = $request->telefono;
        $user->celular = $request->celular;
        $user->pais_id = $request->seleccionPais;
        $user->provincia_id = $request->seleccionProvincia;
        $user->localidad_id = $request->seleccionLocalidad;
        $user->postal = $request->postal;
        $user->save();
        return redirect()->route('validacion_datos');
    }
    public function enviar_datos(Request $request)
    {
        // return $request;
        $usuario = auth()->user();

        $frontal = $request->file('fotoFrontal');
        $nomFrontal = 'dni-frontal.' . $frontal->getClientOriginalExtension();
        $frontal->move(public_path('/documentacion/validacion/' . $usuario->dni), $nomFrontal);
        $dorso = $request->file('fotoDorso');
        $nomDorso = 'dni-dorso.' . $dorso->getClientOriginalExtension();
        $dorso->move(public_path('/documentacion/validacion/' . $usuario->dni), $nomDorso);
        $validacion = $usuario->validacion;
        $validacion->estado = 'Pendiente';
        $docFrontal = new Documentacion();
        $docFrontal->descripcion = 'Foto Frontal DNI';
        $docFrontal->documento = '/' . $usuario->dni . '/' . $nomFrontal;
        $docFrontal->validacion_id = $validacion->id;
        $docFrontal->save();
        $docDorso = new Documentacion();
        $docDorso->descripcion = 'Foto Dorso DNI';
        $docDorso->documento = '/' . $usuario->dni . '/' . $nomDorso;
        $docDorso->validacion_id = $validacion->id;
        $docDorso->save();
        $validacion->save();
        event(new ValidacionSolicitada('Nuevo Usuario ha solicitado su validacion!'));
        return redirect()->route('validacion_datos');
    }
    public function validacion_pendiente()
    {
        $validaciones = Validacion::all()->where('estado', 'Pendiente');
        return view('admin_panel.validacion.validaciones', compact('validaciones'));
    }

    public function ver_validacion_pendiente(Validacion $validacion)
    {
        if ($validacion->estado == 'Pendiente') {
            $usuario = $validacion->usuario;
            $frontal = $validacion->documentaciones->where('descripcion', 'Foto Frontal DNI')->first();
            $dorso = $validacion->documentaciones->where('descripcion', 'Foto Dorso DNI')->first();
            return view('admin_panel.validacion.ver_validacion', compact('validacion', 'usuario', 'frontal', 'dorso'));
        } else {
            return redirect()->back();
        }
    }
    public function aceptar_validacion(Validacion $validacion)
    {
        $usuario = $validacion->usuario;
        $usuario->removeRoles('sin_validacion');
        $usuario->assignRoles('usuario');
        $usuario->save();
        $validacion->aprobado = true;
        $validacion->estado = 'Aprobado';
        $validacion->save();
        return redirect()->route('validacion_pendiente');
    }
    public function cancelar_validacion(Validacion $validacion)
    {

        $validacion->aprobado = false;
        $validacion->estado = 'Desaprobado';
        $validacion->save();
        return redirect()->route('validacion_pendiente');
    }

    public function cantidad_validaciones()
    {
        // return 1;
        return sizeof(Validacion::all()->where('estado', 'Pendiente'));
    }
}
