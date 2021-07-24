<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\daftarvaksin;

use JWTAuth;
use DB;

class daftarvaksinController extends Controller
{
    public $response;
    public $user;
    public function __construct(){
        $this->response = new ResponseHelper();

        $this->user = JWTAuth::parseToken()->authenticate();
    }

    public function index()
    {
    	try{
	        $data["count"] = datacovid::count();
	        $datacovid = array();

	        foreach (daftarvaksin::all() as $p) {
	            $item = [
	                "id"          		=> $p->id,
	                "nama"  => $p->nama,
	                "alamat"  		=> $p->alamat,
	                "umur"  		=> $p->umur,
	            ];

	            array_push($daftarvaksin, $item);
	        }
	        $data["daftarvaksin"] = $daftarvaksin;
	        $data["status"] = 1;
	        return response($data);

	    } catch(\Exception $e){
			return response()->json([
			  'status' => '0',
			  'message' => $e->getMessage()
			]);
      	}
    }

    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
			'nama' => 'required|string',
			'alamat' => 'required|string',
			'umur' => 'required|integer',
		]);

		if($validator->fails()){
            return $this->response->errorResponse($validator->errors());
		}

		$daftarvaksin = new daftarvaksin();
		$daftarvaksin->nama    = $request->nama;
		$daftarvaksin->alamat   = $request->alamat;
		$daftarvaksin->umur   = $request->umur;
		$daftarvaksin->save();

        $data = daftarvaksin::where('id','=', $daftarvaksin->id)->first();
        return $this->response->successResponseData('Data daftar vaksin berhasil terkirim', $data);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
			'nama' => 'required|string',
			'alamat' => 'required|string',
			'umur' => 'required|integer',
		]);

		if($validator->fails()){
            return $this->response->errorResponse($validator->errors());
		}

		$daftarvaksin = daftarvaksin::where('id', $id)->first();
        $daftarvaksin->nama    = $request->nama;
		$daftarvaksin->alamat   = $request->alamat;
		$daftarvaksin->umur   = $request->umur;
		$daftarvaksin->save();

        return $this->response->successResponse('Data covid berhasil diubah');
    }

    public function delete($id)
    {
        $delete = daftarvaksin::where('id', $id)->delete();

        if($delete){
            return $this->response->successResponse('Data petugas berhasil dihapus');
        } else {
            return $this->response->errorResponse('Data petugas gagal dihapus');
        }
    }
    

}
