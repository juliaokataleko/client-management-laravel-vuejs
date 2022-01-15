<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClientResource;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = Client::query();
        $clients = $query->orderBy('id', 'desc')->get();
        return ClientResource::collection($clients);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $data = $request->validate([
            'name' => 'required',
            'email' => 'nullable',
            'phone' => 'nullable',
            'birthday' => 'nullable',
            'state_id' => 'nullable',
            'country_id' => 'nullable',
            'city_id' => 'nullable',
            'address' => 'nullable'
        ]);

        if (isset($request->id) && $request->id != '' && $request->id != '0') {
            $client = Client::find($request->id);
            $client->update($data);
        } else {
            $client = Client::create($data);
            
        }

        $this->updateAvatar($request, $client);

        return response()->json([
            'success' => 'Cliente Cadastrado.'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $query = Client::query();
        $query->where('id', $id);
        $clients = $query->orderBy('id', 'desc')->get();
        return ClientResource::collection($clients);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        dd($request->all());

        $data = $request->validate([
            'name' => 'required',
            'email' => 'nullable',
            'phone' => 'nullable',
            'birthday' => 'nullable',
            'state_id' => 'nullable',
            'country_id' => 'nullable',
            'city_id' => 'nullable',
            'address' => 'nullable'
        ]);


        $client->update($data);

        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $this->updateAvatar($request, $client);
        }

        return response()->json([
            'success' => 'Cliente atualizado.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        // excluir foto
        if (null != $client->photo && file_exists('uploads/clients/' . $client->photo)) {
            if (unlink('uploads/clients/' . $client->photo)) {
            }
        }

        $client->delete();

        return response()->json([
            'success' => 'Cliente excluído.'
        ]);
    }

    public function updateAvatar(Request $request, $client)
    {
        $path = "uploads/clients";

        // Check if is there a photo upload
        if (isset($_FILES['file']) && !empty($_FILES['file']['tmp_name'])) {

            $permitidos = array(
                'image/jpeg', 'image/jpg', 'image/png'
            );

            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            if (in_array($_FILES['file']['type'], $permitidos)) {


                $nome = time() . rand(0, 9999) . '.jpg';

                if (!null == $client->photo && file_exists("$path/" . $client->photo)) {
                    if (unlink("$path/" . $client->photo)) {
                    }
                }

                if (move_uploaded_file($_FILES['file']['tmp_name'], "$path/" . $nome)) {

                    $tipo = $_FILES['file']['type'];

                    $tmpname = $nome;

                    list($width_orig, $height_orig) = getimagesize('uploads/clients/' . $tmpname);
                    $ratio = $width_orig / $height_orig;

                    $width = $width_orig;
                    $height = $height_orig;

                    $img = imagecreatetruecolor($width, $height);
                    if ($tipo == 'image/jpeg') {
                        $origi = imagecreatefromjpeg('uploads/clients/' . $tmpname);
                    } else if ($tipo == 'image/png') {
                        $origi = imagecreatefrompng('uploads/clients/' . $tmpname);
                    }

                    imagecopyresampled($img, $origi, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
                    imagejpeg($img, 'uploads/clients/' . $tmpname, 90);

                    $client->update([
                        'photo' => $nome
                    ]);
                }
            }
        }

        // Check if want to delete the avatar
        if ((!empty($request->delete_avatar) || !is_null($request->delete_avatar)) && $request->delete_avatar == "1") {
            if (!null == $client->photo && file_exists("$path/" . $client->photo)) {
                if (unlink("$path/" . $client->photo)) {
                    $client->photo = null;
                    $client->save();
                }
            }
        }
    }
}
