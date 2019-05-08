<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\Room;
use App\Passenger;
use App\PassengerGroup;
use App\Reservation;
use App\Country;
use Carbon\Carbon;
use Jenssegers\Date\Date;
use Illuminate\Support\Facades\Validator;
use Image;


class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        //user cannot see cancelled or finished
        $Reservations = Reservation::all()->where('status', '!=', 'cancelled')->where('status', '!=', 'finished');

        $events = [];
        foreach($Reservations as $r)

            if($r->roomType == 'single'){
                $events[] = \Calendar::event(
                    $r->roomType.' '.$r->room_id, //event title
                    true, //full day event?
                    new \DateTime($r->check_in),
                    new \DateTime($r->check_out.' +1 day'),
                    $r->id_res,
                    [
                    'color' => '#d81b60',
                ]);
            }
            elseif($r->roomType == 'shared'){
                $events[] = \Calendar::event(
                    $r->roomType.' '.$r->room_id, //event title
                    true, //full day event?
                    new \DateTime($r->check_in),
                    new \DateTime($r->check_out.' +1 day'),
                    $r->id_res,
                    [
                    'color' => '#605ca8',
                ]);
            }
            elseif($r->roomType == 'matrimonial'){
                $events[] = \Calendar::event(
                    $r->roomType.' '.$r->room_id, //event title
                    true, //full day event?
                    new \DateTime($r->check_in),
                    new \DateTime($r->check_out.' +1 day'),
                    $r->id_res,
                    [
                    'color' => 'orange',
                ]);
            }



        $calendar = \Calendar::addEvents($events); //add an array with addEvents


        return view('/user/index', compact('calendar', 'events'));
    }

    public function postMakeReserv(Request $request)
    {
        $passengers = Passenger::all();

        Date::setLocale('es');
        if($request->chIn_submit != null){
            $check_in = new Date($request->chIn_submit);
            $check_in = $check_in->format('l j \d\e F \d\e Y');
        }else{$check_in = '';}
        if($request->chOut_submit != null){
            $check_out = new Date($request->chOut_submit);
            $check_out = $check_out->format('l j \d\e F \d\e Y');
        }else{$check_out = '';}

        $country = Country::all();

        return view('/user/make_reservation', compact('passengers', 'country','check_in','check_out'));
    }

    public function postLoadGuest(Request $request)
    {
        $passenger = Passenger::where('id_passenger', $request->idP)->first();
        $data = [
            'name_1' => $passenger->name_1,
            'lName_1' => $passenger->lName_1,
            'lName_2' => $passenger->lName_2,
            'nationality' => $passenger->nationality,
            'email' => $passenger->email,
            'phone' => $passenger->phone,
            'university' => $passenger->university,
            'country_o' => $passenger->country_o,
            'country_r' => $passenger->country_r,
        ];



        if($request->ajax()){
            return  $data;

        }
        else
        {

            return "no ajax";
        }
    }
    // verificar si este era necesario
    public function postLoadGuest2(Request $request)
    {

        dd('entre en el 2');
        $passenger = Passenger::where('id_passenger', $request->idP)->first();
        $data = [
            'name_1' => $passenger->name_1,
            'lName_1' => $passenger->lName_1,
            'lName_2' => $passenger->lName_2,
            'nationality' => $passenger->nationality,
            'email' => $passenger->email,
            'phone' => $passenger->phone,
            'university' => $passenger->university,
            'country_o' => $passenger->country_o,
            'country_r' => $passenger->country_r,
        ];



        if($request->ajax()){
            return  $data;

        }
        else
        {

            return "no ajax";
        }
    }

    public function postValidateGuest(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'name_1' => 'required|string|max:255',
            'lName_1' => 'required|string|max:255',
            'lName_2' => 'required|string|max:255',
            'university' => 'required|string|max:255',
            'country_r' => 'required',
            'country_o' => 'required',
            'nationality' => 'required|string|max:100',
            'phone' => 'required|string|max:255|regex:/^\+56?[0-9]+$/',
            'email' => 'required|string|email|max:255',
        ]);
        
        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all(),
            'passenger'=> "",
            'passengerNew' => ""]);
        }

        $passenger = Passenger::where('email', '=', $request->email)->first();
        if ($passenger === null) 
        {
            $co = Country::where('iso', '=', $request->country_o)->first();
            $cr = Country::where('iso', '=', $request->country_r)->first();

            $passengerNew = Passenger::create([
            'name_1' => $request->name_1,
            'lName_1' => $request->lName_1,
            'lName_2' => $request->lName_2,
            'university' => $request->university,
            'pAvatar' => '/img/icons/icon-user.png',
            'country_r' => $cr->id_country,
            'country_o' => $co->id_country,
            'nationality' => $request->nationality,
            'email' => $request->lName_1,
            'phone' => $request->phone,
        ]);

            return response()->json(['passenger'=>"",
                                    'errors'=>"",
                                    'passengerNew'=>$passengerNew]);
        }
        else
        {
            return response()->json(['passenger'=>$passenger,
                                    'errors'=> "",
                                    'passengerNew'=>""]);
        }
    }

    public function postCreateReservation(Request $request)
    {
        $p1 = Passenger::where('id_passenger', $request->passenger1)->first();
        $p2 = Passenger::where('id_passenger', $request->passenger2)->first();
        $r = Room::where('type', $request->roomType, '')->where('status', 'free')->firstOrFail();
        $uid = \Auth::id();
        
        //create reservation first
        $Reserv = Reservation::create([
            'motive' => $request->motive,
            'program' => $request->program,
            'status' => 'waiting',
            'check_in' => $request->checkin,
            'check_out' => $request->checkout,
            'payment_m' => $request->payment_m,
            'roomType' => $r->type,
            'user_id' => $uid,
        ]);


        $pGrp = PassengerGroup::create([
            'reservation_id' => $Reserv->id_res,
            'passenger_id' => $request->passenger1,
        ]);

        if($p2 != null){
        $pGrp = PassengerGroup::create([
            'reservation_id' => $Reserv->id_res,
            'passenger_id' => $request->passenger2,
        ]);
        }

        return response()->json(['success'=>"Reserva registrada, enviaremos un correo con mayor información"]);
    }

    public function getMyPassengers()
    {
        $passengers = Passenger::all();
        return view('user/my_passengers', compact('passengers'));
    }

    public function getPassengerProfile($id)
    {
        $passenger = Passenger::where('id_passenger',$id) -> first();
        return view('/user/passenger_profile', compact('passenger'));      
    }

    public function postUpdatePassengerAvatar(Request $request)
    {
        if($request->hasFile('updAvatar'))
        {
            $avatar = $request->file('updAvatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300, 300)->save( public_path('/uploads/avatars/' . $filename ) );
            $passenger = Passenger::where('id_passenger', $request->id)->first();
            $passenger->pAvatar = '/uploads/avatars/' . $filename;
            $passenger->save();
            return \Redirect::back();
        }

        //add log
    }

    public function getMyReservations()
    {
        $reservs = Reservation::where('user_id', \Auth::id())->get();
        //dd($reservs == null);
        $pGroups = PassengerGroup::all();
        return view('/user/my_reservations', compact('reservs', 'pGroups'));
    }

}