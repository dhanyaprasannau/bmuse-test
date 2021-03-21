<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Contracts\SubscriberInterface;
use App\Traits\ApiResponser;
use Mail;

class SubscriberController extends Controller
{
    use ApiResponser;
    public function __construct( 
        SubscriberInterface $subscriberRepo
     ) {
        $this->subscriberRepo = $subscriberRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array(
            'subscribers' => $this->subscriberRepo->getSubscribers()
        );

        return view('subscribers')->with( $data );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if( !$request->input('name') || (!preg_match("/^[a-zA-Z]+$/",$request->input('name')))){
            return $this->errorResponse( 'error', Response::HTTP_BAD_REQUEST );
        }
        if( !$request->input('email') ){
            return $this->errorResponse( 'error', Response::HTTP_BAD_REQUEST );
        }
        $id = $this->subscriberRepo->store($request->input());
        if( $id ){
            return $this->successResponse( 'success');
        }

    }


    /**
     * sendEmail the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    protected function sendEmail(Request $request)
    {
        $res = array();
        if( $request->input('mailValues') && $request->input('message') && $request->input('subject') ) {
            $subscribers = $this->subscriberRepo->getSubscribersById($request->input('mailValues'));
            if( !empty( $subscribers ) ){
                foreach( $subscribers as $row ){
                    Mail::send( 'emails.notification', array(
                        'notes' => $request->input('message'),
                        'name' => $row->name
                    ), function( $message ) use ($row,$request) {
                        $message->to( $row->email, $row->name )->subject( $request->input('subject') );
                    } );
                }

                $res['success'] = 1;
                return response()->json($res);
                exit();
            }

        }
        $res['error'] = 1;
        $res['errormsg'] = "Missing details";
        return response()->json($res);
        exit();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if( $id ) {
            $this->subscriberRepo->destroy($id);
        }
        return redirect('/');
    }

    public function getSubscribers(){
        $subscribers=$this->subscriberRepo->getAllSubscribers();
        return $this->successResponse( $subscribers);
    }

     /**
     * To check email template
     *
     * @return \Illuminate\Http\Response
     */
    public function emailView()
    {
        $data = array(
            'name' => 'TestABC',
            'notes'=>"<p>Hi Test</p><p>Welcome to bMuse</p><h2>Test Content</h2>"
        );

        return view('emails.notification')->with( $data );
    }
}
