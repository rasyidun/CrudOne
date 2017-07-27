<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AdminChartsController extends Controller
{
  public function index()
  {

      $users = User::all();

      return view('admin.charts.index', compact('users'));
  }
}
