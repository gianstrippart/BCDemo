<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

use App\Link;
use App\Hit;
use App\User;

class LinkController extends Controller
{
    public function index()
    {
        $id = '';
        $guest = '';
        if (Auth::check()){
            $id = Auth::user()->id;
        }
        else{
            if($guest = session('guestUser') == ''){
                $guest = session(['guestUser' => 'guest'. Str::random(6)]);
            }
            else{
                $guest = session('guestUser');
            }
        }

        return view('home', [
            'guest' => $guest = session('guestUser'),
            'userLinks' => Link::where('user_id', $id)->get(),
            'guestLinks' => Link::where('name', $guest)->get(),
            'user' => User::all(),
            'hit' => Hit::all(),
        ]);
    }

    public function browsers()
    {
        $browsers = DB::table('links')
        ->select('user_agent')
        ->groupBy('user_agent')
        ->get();
        foreach ($browsers as $browser){
            echo '<p><b>'.$browser->user_agent.'</b></p>';
       }
    }
    public function links()
    {
        $links = Link::all();
        foreach ($links as $link){
            echo '<a target="_blank" href="http://127.0.0.1:8000/links/'.$link->link_id.'">'.$link->shortlink.'</a><br>';
       }
    }

    public function topBrowsers($id)
    {
        $i = 1;
        $browsers = DB::table('hits')
                 ->select('user_agent', DB::raw('count(*) as browser'))
                 ->groupBy('user_agent')
                 ->orderBy('browser','DESC')
                 ->limit($id)
                 ->get();
       foreach ($browsers as $browser){
            echo '<p><b>'.$i.' - '.$browser->user_agent.'</b></p>';
            $i++;
       }
    }

    public function topLinks($id)
    {
        $i = 1;
        $links = DB::table('hits')
                 ->select('link_id', DB::raw('count(*) as hits'))
                 ->groupBy('link_id')
                 ->orderBy('hits','DESC')
                 ->limit($id)
                 ->get();
       foreach ($links as $link){
           $shortlink = Link::findOrFail($link->link_id);
           $shortlink = $shortlink->shortlink;
            echo '<a target="_blank" href="http://127.0.0.1:8000/links/'.$link->link_id.'">'.$i.' - '.$shortlink.'</a><br>';
            $i++;
       }
    }

    public function store(Request $request)
    {
        $link = new Link;
        if (Auth::check()){
            $link->user_id = Auth::user()->id;
            $link->name = Auth::user()->name;
        }
        else
            $link->name = session('guestUser');
        $longlink = $request->input('longlink');
        $validation = Validator::make($request->all(), [
            'longlink' => 'required|url'
        ]);
        if ($validation->fails())
        {
            return back()->with('error','Please, provide a valid URL format');
        }
        /*
        // Manual algorithm //
        $data = 'abcdefghijklmnopqrstuvwxyz';
        $data = substr(str_shuffle($data), 0, 6);
        for ($i=0;$i<6;$i++){
            if($i%2 == 0){
                $data[$i] = strtoupper($data[$i]);
            }
        }
        // End of Manual algorithm //
        */
        $shortlink = 'https://shr.tn/'.Str::random(6);
        $link->longlink = $longlink;
        $link->shortlink = $shortlink;
        $link->user_agent = $request->header('User-Agent');
        $link->save();
        return back()->with('success','Link was shortened successfully!');
    }

    public function redir($id, Request $request)
    {
        $hit = new Hit;
        if (Auth::check()){
            $hit->user_id = Auth::user()->id;
            $hit->name = Auth::user()->name;
        }
        else{
            $hit->name = $guest = session('guestUser');
        }
        $hit->user_agent = $request->header('User-Agent');
        $hit->link_id = $id;
        //dd($hit);
        $hit->save();
        $find = Link::where('id', $id)->first();
        return redirect($find->longlink);
    }
}
