<?php

namespace App\Http\Controllers;

use App\Http\Resources\PermissionResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\ClientResource;
use App\Laravue\Acl;
use App\Laravue\JsonResponse;
use App\Laravue\Models\Permission;
use App\Laravue\Models\Role;
use App\Laravue\Models\User;
use App\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Validator;
class ClientController extends Controller
{
    const ITEM_PER_PAGE = 15;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $searchParams = $request->all();
        $userQuery = Client::query();
        $limit = Arr::get($searchParams, 'limit', static::ITEM_PER_PAGE);
        $role = Arr::get($searchParams, 'role', '');
        $keyword = Arr::get($searchParams, 'keyword', '');
        
        if (!empty($role)) {
            $userQuery->whereHas('roles', function($q) use ($role) { $q->where('name', $role); });
           
        }
        
        if (!empty($keyword)) {
            $userQuery->where('name', 'LIKE', '%' . $keyword . '%');
            $userQuery->where('email', 'LIKE', '%' . $keyword . '%');
            
        }
       
        return ClientResource::collection($userQuery->paginate($limit));
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
        //
        sleep(1);
        $params = $request->all();
        $user = Client::create([
            'name' => $params['name'],
            'email' => $params['email'],
            'company' => $params['company'],
            'phone' => $params['phone'],
            'open_balance' => $params['open_balance'],
            'fax' => $params['fax'],
            'website' => $params['website'],
            'billing_address' => $params['billing_address'],
            'shipping_address' => $params['shipping_address'],
            'note' => $params['note'],
        ]);
        return new ClientResource($user);
    }

    public function downloadClientSample(){
        // Check if file exists in app/storage/file folder
        $file_path = storage_path() . "/app/downloads/client.csv";
        $headers = array(
            'Content-Type: csv',
            'Content-Disposition: attachment; filename=client.csv',
        );
        if (file_exists($file_path)) {
            // Send Download
            flash()->success('File Downloaded');
            // Session::flash('success', 'File Downloaded');
            return Response::download($file_path, 'client.csv', $headers);
        } else {
            // Error
            flash()->error('Something went wrong!');
            // Session::flash('failure', 'Something went wrong!');
        }
        $clients = Client::all();
        return redirect()->route('client.index',['clients'=>$clients]);
    }

    public function import(Request $request){
        $this->validate($request, array(
            'import_file'      => 'required'
        ));
        $client_name = [];
        if ($request->hasFile('import_file')) {
            $extension = File::extension($request->import_file->getClientOriginalName());
            if ($extension == "csv") {
                $path = $request->import_file->getRealPath();
                $data = Excel::load($path, function($reader) {})->get();
                if(!empty($data) && $data->count()){
                    foreach($data as $record){
                        if(in_array($record->client_name,$client_name)){
                            continue;   
                        }else if(Client::where('name','=',$record->client_name)->exists()){
                            continue;
                        }else if($record->client_name == NULL || $record->client_name == "-"){
                            continue;
                        }else{
                            $client_name[] = $record->client_name;
                            $insert_client_data[] = [
                                'name' => $record->client_name, 
                                'company' => $record->company,
                                'phone' => $record->phone,
                                'fax' => $record->fax,
                                'email' => $record->email,
                                'website' => $record->website,
                                'billing_address' => $record->billing_address,
                                'shipping_address' => $record->shipping_address,
                                'note' => $record->note
                            ];
                        }
                    }
                    if(!empty($insert_client_data)){
                        $insert_client = DB::table('clients')->insert($insert_client_data);
                        flash()->success('Clients Data Imported!');
                        // Session::flash('success', 'Clients Data Imported!');
                    }else{
                        flash()->warning('Duplicated record, please check your csv file!');
                        // Session::flash('warning', 'Duplicated record, please check your csv file!');
                    }
                }else{
                    flash()->warning('There is no data in csv file!');
                    // Session::flash('warning', 'There is no data in csv file!');
                }
            }else{
                flash()->warning('Selected file is not csv!');
                // Session::flash('warning', 'Selected file is not csv!');
            }
        }else{
            flash()->error('Something went wrong!');
            // Session::flash('failure', 'Something went wrong!');
        }
        $clients = Client::all();
        return redirect()->route('client.index',['clients'=>$clients]);    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
        //return response()->json($client);
        return new ClientResource($client);
        $client = Client::where('id',$client->id)->get();
        return response()->json(['client'=>$client]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        //
        return new ClientResource($user);
        $data = Client::where('id',$client->id)->get();
        return response()->json(['client'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        if ($client === null) {
            return response()->json(['error' => 'User not found'], 404);
        }
        // if ($client->isAdmin()) {
        //     return response()->json(['error' => 'Admin can not be modified'], 403);
        // }

        // $validator = Validator::make($request->all(), $this->getValidationRules(false));
        // if ($validator->fails()) {
        //     return response()->json(['errors' => $validator->errors()], 403);
        // } else {
            $email = $request->get('email');
            $found = Client::where('email', $email)->first();
            if ($found && $found->id !== $client->id) {
                return response()->json(['error' => 'Email has been taken'], 403);
            }

            $client->name = $request->get('name');
            $client->email = $email;
            $client->website = $request->get('website');
            $client->phone   = $request->get('phone');
            $client->company = $request->get('company');
            $client->billing_address = $request->get('billing_address');
            $client->shipping_address = $request->get('shipping_address');
            $client->note = $request->get('note');
            $client->fax = $request->get('fax');
            $client->open_balance = $request->get('open_balance');
            $client->save();
            return new ClientResource($client);
        // }
        //
        // $update = Client::where('id',$client->id)->update([
        //     'name'=>$request->name,
        //     'company'=>$request->company_name,
        //     'phone'=>$request->phone,
        //     'fax'=>$request->fax,
        //     'email'=>$request->email,
        //     'website'=>$request->website,
        //     'billing_address'=>$request->b_address,
        //     'shipping_address'=>$request->s_address,
        //     'note'=>$request->note
        // ]);
        // if($update){
        //     flash()->success('Clients Data Updated!');
        //     // Session::flash('success', 'Clients Data Updated!');
        // }else{
        //     flash()->error('Something went wrong!');
        //     // Session::flash('failure', 'Something went wrong!');
        // }
        // $clients = Client::all();
        // return redirect()->route('client.index',['clients'=>$clients]);    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        //
        try {
            $client->delete();
        } catch (\Exception $ex) {
            response()->json(['error' => $ex->getMessage()], 403);
        }

        return response()->json(null, 204);
    }

    /**
     * Get permissions from role
     *
     * @param User $user
     * @return array|\Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function permissions(User $user)
    {
        try {
            return new JsonResponse([
                'user' => PermissionResource::collection($user->getDirectPermissions()),
                'role' => PermissionResource::collection($user->getPermissionsViaRoles()),
            ]);
        } catch (\Exception $ex) {
            response()->json(['error' => $ex->getMessage()], 403);
        }
    }

    /**
     * @param bool $isNew
     * @return array
     */
    private function getValidationRules($isNew = true)
    {

        return [
            'name' => 'required',
            'email' => $isNew ? 'required|email|unique:users' : 'required|email',
            'roles' => [
                'required',
                'array'
            ],
        ];
    }
    // public function delete(Client $client)
    // {
    //     $data = Client::find($client->id);
    //     $data->delete();
    //     if($data){
    //         flash()->success('Clients Data Deleted!');
    //         // Session::flash('success', 'Clients Data Deleted!');
    //     }else{
    //         flash()->error('Something went wrong!');
    //         // Session::flash('failure', 'Something went wrong!');
    //     }
    //     $clients = Client::all();
    //     return redirect()->route('client.index',['clients'=>$clients]);    

    // }
}
