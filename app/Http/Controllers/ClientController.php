<?php

namespace App\Http\Controllers;

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
        
        return view('client.index')->with('clients',Client::orderBy('id','desc')->paginate(20));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('client.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'phone' => 'required',
            'plate_number' => 'required',
        ]);

        $client = Client::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'plate_number' => $request->plate_number
        ]);

    
        if($client){
            return redirect()->route('client.index')->with('success','تم حفظ العميل بنجاح');
        }else {
            return back()->with('error','حصل خطاء حاول مرة اخري');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {

       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return view('client.edit')->with('client',$client);
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
        $this->validate($request,[
            'name' => 'required',
            'phone' => 'required',
            'plate_number' => 'required',
        ]);

        $data = [
            'name' => $request->name,
            'phone' => $request->phone,
            'plate_number' => $request->plate_number
        ];

        if($client->update($data)){
            return redirect()->route('client.index')->with('success','تم تحديث العميل بنجاح');
        }else {
            return back()->with('error','حصل خطاء حاول مرة اخري');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client->delete();
        return back()->with('success','تم حذف العميل بنجاح');
    }

    public function getClients(Request $request)
    {
        $response = array();

        if($request->search == ''){
            $clients = Client::orderBy('id','desc')->limit(5)->get();
        }else {
            $clients = Client::where('name','like',"%".$request->search."%")->get();

        }

        foreach ($clients as $client) {
            $response[] = array(
               'id' => $client->id ,
               'text' => $client->name
            );
        }

        echo json_encode($response);
    }
}
