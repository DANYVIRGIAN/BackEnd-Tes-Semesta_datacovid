<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\datacovid;

use JWTAuth;
use DB;

class datacovidController extends Controller
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

	        foreach (datacovid::all() as $p) {
	            $item = [
	                "id"          		=> $p->id,
	                "kota"  => $p->kota,
	                "jumlah"  		=> $p->jumlah,
	            ];

	            array_push($datacovid, $item);
	        }
	        $data["datacovid"] = $datacovid;
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
			'kota' => 'required|string',
			'jumlah' => 'required|string',
		]);

		if($validator->fails()){
            return $this->response->errorResponse($validator->errors());
		}

		$datacovid = new datacovid();
		// $datacovid->id       = $this->user->id;
		$datacovid->kota    = $request->kota;
		$datacovid->jumlah   = $request->jumlah;
		$datacovid->save();

        $data = datacovid::where('id','=', $datacovid->id)->first();
        return $this->response->successResponseData('Data covid berhasil terkirim', $data);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
			'kota' => 'required|string',
			'jumlah' => 'required|string',
		]);

		if($validator->fails()){
            return $this->response->errorResponse($validator->errors());
		}

		$datacovid = datacovid::where('id', $id)->first();
        $datacovid->kota    = $request->kota;
		$datacovid->jumlah   = $request->jumlah;
		$datacovid->save();

        return $this->response->successResponse('Data covid berhasil diubah');
    }

    public function delete($id)
    {
        $delete = datacovid::where('id', $id)->delete();

        if($delete){
            return $this->response->successResponse('Data petugas berhasil dihapus');
        } else {
            return $this->response->errorResponse('Data petugas gagal dihapus');
        }
    }
    

}
