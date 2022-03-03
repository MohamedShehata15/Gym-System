<?php

namespace App\Http\Controllers;
use App\Models\Session;
use App\Models\Staff;
use Illuminate\Http\Request;
use App\Models\GymCoaches;
use App\Models\User;
use App\Models\SessionUser;
use App\Models\SessionStaff;
use App\DataTables\SessionDataTable;
use App\Http\Requests\SessionRequest;



class SessionController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            return datatables()->of(Session::latest()->get())
            ->addColumn('Coaches', function (Session $session) {
                $coaches=$session->coaches->pluck('name'); //extract name keys from data
                foreach ($coaches as $coach) {
                    return  $coaches->implode(' , ');
                }
            })

            ->addColumn('action', function ($data) {
                $button='<a
                onClick="EditSession('.$data->id.')"
                class="edit btn btn-primary mx-4">Edit</a>';

                $button.='<a
                onClick="DeleteSession('.$data->id.')"
                class="delete btn btn-danger mx-4">Delete</a>';
                return $button;
            })
          
            
            ->rawColumns(array('action')) //for cells have html
            ->make(true);
        }
        return view('sessions.index');
    }

    public function create()
    {
        $coaches=Staff::all()->where('role', '=', 'coach');
        return view('sessions.create', [
            'coaches' =>$coaches
        ]);
    }


    public function store(SessionRequest $request)
    {
        $requestData = request()->all();

        $dataTimeStart=$requestData['day']." ".$requestData['start']; //concat date with time
        $dateTimeFinish=$requestData['day']." ".$requestData['finish'];

        $SessionIsExist = Session::where('start_at', '<=',$dataTimeStart)->where('finish_at', '>=',$dateTimeFinish)->exists();
        if (!$SessionIsExist) {
            $session= Session::create([
            'name' => $requestData['name'],
            'start_at' =>$dataTimeStart,
            'finish_at' =>$dateTimeFinish,
        ]);

            $coaches=$requestData['coaches'];
            $coaches=array_values($coaches);
            $data=Staff::find($coaches);
            $session->coaches()->attach($data); //assign coaches to the session
    
       
            return redirect()->route('sessions.index');
        }

        else if($SessionIsExist){
          return  redirect()->back()->withErrors(['There is already session at this time :(']);}
    }

    public function destroy(Request $request)
    {
       $SomeoneAttend=SessionUser::where('session_id', '=',$request->id)->exists();
       if (!$SomeoneAttend) {
           $session=Session::where('id', $request->id)->delete();
           return (Response()->json($session));
       }
       else if($SomeoneAttend)
       {
        return  redirect();

       }
    }


    public function edit(Request $request)
    {
      $coaches=Staff::select('name')->where('role', '=', 'coach')->pluck('name');
      $coachesid=Staff::select('id')->where('role', '=', 'coach')->pluck('id');

      $session=Session::find($request->id);
      $output=array(
        'name' => $session->name,
        'start_at' => $session->start_at,
        'finish_at' => $session->finish_at,
        'coaches' => $coaches,
        'coachesid'=>$coachesid
      );
        echo json_encode($output);
    }


    public function update(SessionRequest $request)
    {
        $requestData = request()->all();

            //check if any one attend this session 
            $SomeoneAttend=SessionUser::where('session_id', '=',$requestData['id'])->exists();
            $CurrentSession=Session::find($request->id);
             $startdate=$CurrentSession->start_at;
             $finishdate=$CurrentSession->finish_at;
             $changedStartDate=$requestData['day']." ".$requestData['start'];
             $changedFinishDate=$requestData['day']." ".$requestData['finish'];

            if(($changedStartDate!= $startdate || $changedFinishDate!= $finishdate) && $SomeoneAttend) 
            {
                    return  redirect()->back()->withErrors(['There is people attend this session you cannot change the date :(']);
            }
            else{
                Session::where('id', $requestData['id'])->update([
                    'name'=>$requestData['name'],
                    'start_at' =>$requestData['day']." ".$requestData['start'],
                    'finish_at' =>$requestData['day']." ".$requestData['finish']]);    
                $coaches=$requestData['coaches'];
                $coaches=array_values($coaches);
                $data=Staff::find($coaches);
                $CurrentSession->coaches()->sync($data); //assign coaches to the session
        
                // foreach ($coaches as $coach) {
                //  SessionStaff::where('session_id', $requestData['id'])->update(['staff_id'=>$coach]);
                // }
                return redirect()->route('sessions.index');  

            }

          }

}
  
    