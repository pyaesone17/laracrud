<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Model;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class controller extends Controller
{

    protected $viewDir;
    
 
    public function __construct()
    {
        $this->viewDir='folder.';

    }     
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $datas = Model::all();

        return view($this->viewDir.'all',compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view($this->viewDir.'create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $data =Model::create($request->all());

        return redirect()->route('routename')->with('status','Successfully Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $data = Model::findOrFail($id);

        return view($this->viewDir.'show',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $data= Model::findOrFail($id);

        return view($this->viewDir.'edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request,$id)
    {
        $data = Model::findOrFail($id);

        $data->update($request->all());

        return redirect()->route('routename')->with('status','Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $data = Model::findOrFail($id);

        $data->delete();

        return redirect()->route('routename')->with('status','Successfully Deleted');
    }
}
