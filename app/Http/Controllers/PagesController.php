<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Websites;
use App\Comments;
use App\Articles;
use App\Images;

class PagesController extends Controller {

 public function index(int $rank = 1) {

  $website = Websites::where('rank', $rank)->first();

  return view('index', [
   'website' => $website,
   'articles' => Articles::where('website_id', $website->id)->get(),
   'comments' => Comments::where('website_id', $website->id)->paginate($this->paginationItems),
   'cover' => Images::where('website_id', $website->id)->where('role', 'cover')->first()->image ?? asset('images/dummyimg.png'),
   'intro' => Images::where('website_id', $website->id)->where('role', 'intro')->first()->image ?? asset('images/dummyimg.png'),
   'body' => Images::where('website_id', $website->id)->where('role', 'body')->first()->image ?? asset('images/dummyimg.png'),
   'last' => Images::where('website_id', $website->id)->where('role', 'last')->first()->image ?? asset('images/dummyimg.png')
  ]);
 }
}