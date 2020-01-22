<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Comments;
use App\Websites;
use App\Images;

class CommentsController extends Controller {

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(int $rank = 1) {

   $website = Websites::where('rank', $rank ?? 1)->first();

   return view('comments', [
    'website' => $website,
    'cover' => Images::where('website_id', $website->id)->where('role', 'cover')->first()->image ?? asset('images/dummyimg.png'),
    'comments' => Comments::where('website_id', $website->id)->paginate(15)
   ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create() {}

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request) {

   $validator = validator($request->all(), [
    'author' => 'required|string|max:191',
    'email' => 'required|email',
    'content' => 'required|string',
    'website_id' => 'required|integer'
   ]);

   if ($validator->fails()) {

    return redirect(url()->previous().'#commentsection')->with('errors', $validator->errors());
   }

   unset($validator);

   $comment = new Comments();
   $comment->fill($request->post())->save();
   unset($comment);

   return redirect(url()->previous().'#commentsection')->with('success', 'Your comment have been added!');
  }

  /**
   * Display the specified resource.
   *
   * @param  Comments $comment
   * @return \Illuminate\Http\Response
   */
  public function show(Comments $comment) {

   $website = Websites::where('id', $comment->website_id)->first();

   return view('comments.show', [
    'comment' => $comment,
    'website' => $website,
    'cover' => Images::where('website_id', $website->id)->where('role', 'cover')->first()->image ?? asset('images/dummyimg.png'),
   ]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  Comments $comment
   * @return \Illuminate\Http\Response
   */
  public function edit(Comments $comment) {

   $website = Websites::where('id', $comment->website_id)->first();

   return view('comments.edit', [
    'comment' => $comment,
    'website' => $website,
    'cover' => Images::where('website_id', $website->id)->where('role', 'cover')->first()->image ?? asset('images/dummyimg.png'),
   ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  Comments $comment
   * @return \Illuminate\Http\Response
   */
  public function update(Comments $comment, Request $request) {

   $website = Websites::where('id', $comment->website_id)->first();
   $currentComment = Comments::where('id', $comment->id)->first();

   // Checks whether the provided email is correct or no
   if ($comment->email !== $request->post('email')) {

    return redirect(url()->previous())
            ->with('error', ($request->post('email'))? "The email you provided was wrong.": "There was no email provided.");
   }

   // Checks whether are there any changes in the comment
   if ($comment->content === $request->post('content') && $comment->title === $request->post('title')) {

    return redirect(url()->previous())
            ->with('error', "You didn't make any changes.");
   }

   // Fills the model with the new data and saves it
   if ($comment->fill($request->post())->save()) {

    return redirect()->route('comments.show', [
     'comment' => $currentComment,
     'success' => 'Your comment is modified!'
    ]);
   }

   /**
    * This is negative case - when fill and sace process fails otherwise this shouldn't be reached
    */
   return redirect(url()->previous())
           ->with('error', "Your comment haven\'t been saved!");
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  Comments $comment
   * @return \Illuminate\Http\Response
   */
  public function destroy(Comments $comment, Request $request) {

   $validator = validator($request->post(), ['email' => 'required|email']);

   if ($validator->fails()) {

    return redirect(url()->previous())
            ->with('errors', $validator->errors());
/*
     return redirect()
      ->route('comments.show', [
       'comments' => $comment,
       'website' => Websites::where('id', $comment->website_id)->first(),
       'errors' => $validator->errors()->all()
       ]);
*/
   }

   if ($comment->email !== $request->post('email')) {

    return redirect(url()->previous())
            ->with('error', ($request->post('email'))? "The comment haven't been created with the email you provided.": "Please provide an email.");
/*
    return redirect()
            ->route('comments.show', [
             'comments' => $comment,
             'website' => Websites::where('id', $comment->website_id)->first(),
             'error' => ($request->post('email'))? "Couldn't find such comment to delete.": "Please provide an email."
            ]);
*/
   }

   $website_id = $comment->website_id;

   if ($comment->delete()) {

    return redirect()->route('comments.index', [
     'comments' => Comments::where('website_id', $website_id),
     'website' => Websites::where('id', $comment->website_id)->first(),
     'success' => "Comment have been deleted successfuly."
    ]);
   }

   return redirect(url()->previous())
           ->with('error', "Couldn't delete the comment. Please try again.");
  }

  /**
   * Handles ajax request for email check
   */
/*
  public function ajaxEmailCheck(Request $request)
  {
   if ($request->ajax())
   {
    if (!validator($request->post(), [
     'email' => 'bail|required|email',
     'item_id' => 'bail|required|int',
     'action' => 'required|in:edit,destroy'
    ])->fails()) {
     $clientemail = Comments::where('email', $request->input('email'))->where('id', $request->input('item_id'))->first('email');

     if ($clientemail)
     {
      $sessionkey = Crypt::encryptString($clientemail.$_SERVER['REMOTE_ADDR']);
      $request->session()->push(substr($sessionkey,0,16), $sessionkey);
      die('yes');
     }
    }

    die('no');
   }
  }
*/
}