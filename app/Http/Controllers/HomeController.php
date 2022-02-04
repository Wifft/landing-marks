<?php
namespace App\Http\Controllers;

use Illuminate\View\View;

use App\Models\Map;

final class HomeController extends Controller
{
    public function index() : View
    {
        $maps = Map::orderBy('updated_at', 'desc')->get();

        return view('pages.home', compact('maps'));
    }
}
