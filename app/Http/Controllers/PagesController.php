<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class PagesController extends Controller
{
  public function index()
  {
  	$title = 'Inertia';
  	return Inertia::render('Home', [
  		'title' => $title
  	]);
  }

  public function about()
  {
  	$title = 'Tentang Kami';
  	return Inertia::render('About', [
  		'name' => $title
  	]);
  }
}
