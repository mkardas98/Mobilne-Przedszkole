<?php

namespace App\Http\Controllers;


use App\Models\Chat;
use App\Models\Participant;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Collection;

class ChatsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::with([])->get();
        $participant = Participant::with(['chat'])->get();
        $messages = Message::with([])->get();
        $access_chats = $participant->where('user_id', auth()->user()->id);

        $chats_id = [];
        foreach ($access_chats as $access_chat){
            $chats_id[] = $access_chat->chat->id;
        }

        $chats = new Collection();
        foreach ($chats_id as $chat_id){
            $chat = new Collection();
            $chat->chat_id = $chat_id;
            $user_id = $participant->where('chat_id', $chat_id)->where('user_id', '!=', auth()->user()->id)->first();
            if($user_id){
                $user_id = $user_id->user_id;
                $chat->user = $users->where('id', $user_id)->first();
                $chat->last_message = $messages->where('chat_id', $chat_id)->sortByDesc('created_at')->first();
                $chats->push($chat);
            }
        }
        $chats = $chats->sortByDesc(function ($chat){
           return $chat->last_message->created_at;
        });

        return view('chats.index', ['chats'=>$chats]);
    }

    public function newChat()
    {
        $participants = Participant::all();
        $user_login_participants =  $participants->where('user_id', '=', auth()->user()->id);

        $users_active_chats = new Collection();
        foreach ($user_login_participants as $item){
            $_item = $participants->where('chat_id', $item->chat_id)->where('user_id', '!=', auth()->user()->id)->first();
            if($_item){
                $users_active_chats->push($_item->user_id);
            }
        }

        $users = null;
        if (auth()->user()->role == 0) {
           $users = User::where('role', 2)->orderBy('last_name')->get();
        }

        foreach ($users_active_chats as $user_id){
            $users = $users->where('id', '!=', $user_id);
        }

        return view('chats.create', ['users' => $users]);
    }

    public function create(Request $request)
    {
        $post = $request->all();
        $chat = new Chat();
        $chat->save();

        $first_participant = new Participant();
        $first_participant->user_id = auth()->user()->id;
        $chat->participants()->save($first_participant);

        $second_participant = new Participant();
        $second_participant->user_id = $post['user'];
        $chat->participants()->save($second_participant);

        $message = new Message();
        $message->user_id = auth()->user()->id;
        $message->text = $post['message'];

        $chat->messages()->save($message);

        return redirect()->route('chats.show', $chat->id);
    }

    public function show($id, Request $request)
    {
        $logged_user = Participant::where('chat_id', $id)->where('user_id', auth()->user()->id)->first();
        if ($logged_user){


            $chat_user = Participant::where('chat_id', $id)->where('user_id', '!=',auth()->user()->id)->first();
            $chat_user = User::where('id', $chat_user->user_id)->first();

            $messages = Message::where('chat_id', $id)->orderBy('created_at', 'desc')->paginate(7);

            //change read status

            Message::where('chat_id', $id)
                ->where('user_id', '!=', auth()->user()->id)
                ->where('read_status', false)
                ->update([
                    'read_status' => true
                ]);

            if ($request->get('page')) {
                return view('chats.load_messages', [
                    'chat_user' => $chat_user,
                    'messages' => $messages,
                    'chat_id' => $id
                ]);
            }
            return view('chats.show', [
                'chat_user' => $chat_user,
                'messages' => $messages,
                'chat_id' => $id
            ]);
        } else {
            return redirect()->back()->with('error', 'Nie masz dostępu do tej konwersacji!');
        }
    }

    public function addMessage($id, Request $request){
        $chat = Chat::find($id);

        $message = new Message();
        $message->text = $request->get('message');
        $message->user_id = auth()->user()->id;

        $chat->messages()->save($message);

        return redirect()->back()->with('success', 'Wysłano wiadomość.');
    }

    public function infoNewMessage($view){

        $participant = Participant::with(['chat'])->get();
        $user_participant = $participant->where('user_id', auth()->user()->id);
        $chats_id = [];
        foreach ($user_participant as $item){
            $chats_id[] = $item->chat_id;
        }

        $messages = Message::where('user_id', '!=', auth()->user()->id)
            ->whereIn('chat_id', $chats_id)
            ->where('read_status', false)
            ->get();

        $view->countNewMessages = count($messages);


    }


}
