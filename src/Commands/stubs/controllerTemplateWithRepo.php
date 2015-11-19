<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Model;
use \App\Repositories\ModelRepository;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class controller extends Controller
{

    protected $viewDir;
    
 
    public function __construct(ModelRepository $ModelRepository)
    {
        $this->viewDir='folder.';

        $this->repo=$ModelRepository;

    }     
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $datas = $this->repo->paginate();

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
        $data = $this->repo->create($request->all());

        return redirect()->route('routename.index')->with('status','Successfully Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $data = $this->repo->getById($id);

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
        $data= $this->repo->getById($id);

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
        $data = $this->repo->update($request->all(),$id);

        return redirect()->route('routename.index')->with('status','Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $data = $this->repo->destroy($id);

        $data->delete();

        return redirect()->route('routename.index')->with('status','Successfully Deleted');
    }
}
