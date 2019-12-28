<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Day;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class DaysController extends Controller
{
      public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
       //$days = Day::orderBy('created_at','desc')->paginate(10);
        /*return view('days.index')->with('days',$days);*/
       /* $id = $request->id;
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $day = Day::find($id);
        if($user_id == $day->user_id['id']){
        return view('days.index')->with('days', $user->days);}
        else{
            return redirect('/')->with('error','Login to see your days');
        }*/
        /*$id = $request->id;
        $day = Day::find($id);
        //$user_id = auth()->user()->id;
        $user_id = Auth::id();
        //$user_id = $request->user()->id;
        print $user_id;
        $user = User::find($user_id);
        /*if(auth()->user()->id !== optional ($day)->user_id){
            return redirect('/')->with('error', 'Login to see your day');
        }*/
       /* if($user_id !== optional ($day)->user_id){
            return redirect('/')->with('error', 'Login to see your day');
        }
        return view('days.index')->with('days', $user->days);*/

        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $days = Day::where('user_id', $user->id)->orderBy('created_at','desc')->paginate(10);
        //$days = $user->days;
        return view('days.index')->with('days', $days);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        return view('days.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'picture' => 'image|nullable|max:1999'
        ]);

        //Handle File Upload
        if($request->hasFile('picture')){
            //Get filename with the extension
            $filenameWithExt = $request->file('picture')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //Get just ext
            $extension = $request->file('picture')->getClientOriginalExtension();
            //filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            //Upload picture
            $path = $request->file('picture')->storeAs('public/pictures', $fileNameToStore);
        }
        else{
            $fileNameToStore = '';
        }

        //Get YT id
        if($request->filled('video')){
        $url = $request->input('video');
        parse_str( parse_url( $url, PHP_URL_QUERY ), $youtube );
        $idvid = $youtube['v'];
        }

        else {
            $idvid = '';
        }
        //Create Post
        $day = new Day;
        $day->title = $request->input('title');
        $day->quote = $request->input('quote');
        $day->notes = $request->input('notes');
        $day->picture = $fileNameToStore;
        $day->picture_caption = $request->input('picture_caption');
        $day->user_id = auth()->user()->id;
        $day->video = $idvid;
        $day->save();

        return redirect('/days')->with('success', 'Entry Created');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $day = Day::find($id);
        
        if(auth()->user()->id !== $day->user_id){
            return redirect('/days')->with('error', 'You can\'t see this post');
        }

        return view('days.show')->with('day',$day);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $day = Day::find($id);

        if(auth()->user()->id !== $day->user_id){
            return redirect('/days')->with('error', 'You can\'t see this post');
        }
        
        return view('days.edit')->with('day', $day);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'picture' => 'image|nullable|max:1999'
        ]);

        //Handle File Upload
        if($request->hasFile('picture')){
            //Get filename with the extension
            $filenameWithExt = $request->file('picture')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //Get just ext
            $extension = $request->file('picture')->getClientOriginalExtension();
            //filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            //Upload picture
            $path = $request->file('picture')->storeAs('public/pictures', $fileNameToStore);
        }
        else{
            $fileNameToStore = '';
        }

        //Get YT id
        if($request->filled('video')){
            $url = $request->input('video');
            parse_str( parse_url( $url, PHP_URL_QUERY ), $youtube );
            $idvid = $youtube['v'];
            }
    
            else {
                $idvid = '';
            }

        //Create Post
        $day = Day::find($id);
        $day->title = $request->input('title');
        $day->quote = $request->input('quote');
        $day->notes = $request->input('notes');
        $day->picture = $fileNameToStore;
        $day->picture_caption = $request->input('picture_caption');
        $day->video = $idvid;
        $day->save();

        //Delete old picture
       /* if($request->hasFile('picture')){
            Storage::delete('public/pictures/'.$day->picture);}*/

        return redirect('/days')->with('success', 'Entry Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $day = Day::find($id);
        if(auth()->user()->id !==$day->user_id){
            return redirect('/days')->with('error', 'Unauthorized Page');
        }
        if(!empty($day->picture))
        {
            Storage::delete('public/pictures/'.$day->picture);
        }
        $day -> delete();
        return redirect('/days')->with('success', 'Entry Removed');
    }

    public function search(Request $request)
    {
        $search = $request->get('search');
        $user_id = auth()->user()->id;
        $user = User::find($user_id);

        $days = DB::Table('days') -> where([['title','like', '%' .$search. '%'],  ['user_id', $user->id]])->get();
       
        return view('days.search')->with('days', $days);
    }
}
