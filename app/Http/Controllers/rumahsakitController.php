<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\rumahsakit;

use JWTAuth;
use DB;

class rumahsakitController extends Controller
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
	        $data["count"] = rumahsakit::count();
	        $rumahsakit = array();

	        foreach (rumahsakit::all() as $p) {
	            $item = [
	                "id"          		=> $p->id,
	                "nama_rs"              => $p->nama_rs,
	                "alamat"  		    => $p->alamat,
	            ];

	            array_push($rumahsakit, $item);
	        }
	        $data["rumahsakit"] = $rumahsakit;
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
			'nama_rs' => 'required|string',
			'alamat' => 'required|string',
		]);

		if($validator->fails()){
            return $this->response->errorResponse($validator->errors());
		}

		$rumahsakit = new rumahsakit();
		$rumahsakit->nama_rs    = $request->nama_rs;
		$rumahsakit->alamat   = $request->alamat;
		$rumahsakit->save();

        $data = rumahsakit::where('id','=', $rumahsakit->id)->first();
        return $this->response->successResponseData('Data rs berhasil terkirim', $data);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
			'nama_rs' => 'required|string',
			'alamat' => 'required|string',
		]);

		if($validator->fails()){
            return $this->response->errorResponse($validator->errors());
		}

		$rumahsakit = rumahsakit::where('id', $id)->first();
        $rumahsakit->nama_rs    = $request->nama_rs;
		$rumahsakit->alamat   = $request->alamat;
		$rumahsakit->save();

        return $this->response->successResponse('Data rs berhasil diubah');
    }

    public function delete($id)
    {
        $delete = rumahsakit::where('id', $id)->delete();

        if($delete){
            return $this->response->successResponse('Data rs berhasil dihapus');
        } else {
            return $this->response->errorResponse('Data rs gagal dihapus');
        }
    }
    

}
