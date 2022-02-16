<?php

namespace App\Http\Controllers;


//use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
//use Illuminate\Foundation\Bus\DispatchesJobs;
//use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\ClientException;
use App\Traits\PaginationTrait;

use App\User;

class ApiController extends BaseController
{
    //use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    use PaginationTrait;

    public $api_url = '';
    public $api_endpoint = '';
    public $size = 0;

    public function __construct(){
        $this->api_url = env('API_URL');
        $this->api_endpoint = env('API_ENDPOINT');
        $this->size = env('PAGE_SIZE');
    }


    /**
     * Obtengo las propiedades
     */
    public function getProperties(Request $request)
    {
     
        $properties = [];
        
        $result_rent = [];
        $result_buy = [];

        $call_rent = false;
        $call_buy = false;

        // Creating a Client
        $client = new Client(['base_uri' => $this->api_url]);

        try {

            if(isset($request->type)){
                
                switch ($request->type) {
                    case 'rent':
                        $call_rent = true;
                        break;
                    case 'buy':
                        $call_buy = true;
                        break;
                }

            }else{

                $call_rent = true;
                $call_buy = true;

            }

            if($call_rent){
                $response = $client->request('GET', $this->api_endpoint . 'rent/properties');
                $properties = json_decode($response->getBody()->getContents());
                $result_rent = $this->addResult($request, $properties, 'rent');
        
            }

            if($call_buy) {
        
                $response = $client->request('GET', $this->api_endpoint . 'buy/properties');
                $properties = json_decode($response->getBody()->getContents());
                $result_buy = $this->addResult($request, $properties, 'buy');
        
            }



        } catch (ClientException $e) {
            
            echo Psr7\Message::toString($e->getRequest());
            echo Psr7\Message::toString($e->getResponse());

        }

        // combine arrays
        $properties_response = array_merge($result_rent, $result_buy);

        // set page
        $page = isset($request->page) ? $request->page : 1;

        //response
        return $this->paginate($properties_response, $this->size, $page);

    }

    /**
     * Agrego las propiedades al array final
     */
    private function addResult($request, $properties, $type)
    {
        $response = [];

        foreach ($properties as $property) {
            $property->type = $type;
            
            // filtro para el detalle
            if (isset($request->name)) {
                if ($request->name == $property->name) {
                    $response[] = $property;
                    break;
                }
            }else{
                if (!isset($request->cost) || (isset($request->cost) && $request->cost == $property->cost)) {
                    $response[] = $property;
                }
            }


        }

        return $response;
    }

    /**
     * Registro de usuario
     */
    public function signUp(Request $request)
    {
        // validación de parámetros
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string'
        ]);

        // creación del usuario
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        // creación de token
        $tokenResult = $user->createToken('Personal Access Token');

        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();

        // response
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse($token->expires_at)->toDateTimeString()
        ], 201);
    }

    /**
     * Inicio de sesión y creación de token
     */
    public function login(Request $request)
    {
        // validación de parámetros
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);

        $credentials = request(['email', 'password']);

        // autenticación del usuario
        if (!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);

        // creación de token
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');

        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();

        // response
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse($token->expires_at)->toDateTimeString()
        ]);
    }
}