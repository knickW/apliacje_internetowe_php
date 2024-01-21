<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Get the initial query builder without paginating
        $query = Post::latest();

        // Sortowanie i filtrowanie
        $sortOptions = ['created_at', 'likes_ratio'];
        $orderOptions = ['desc', 'asc'];

        $sort = in_array($request->sort, $sortOptions) ? $request->sort : 'created_at';
        $order = in_array($request->order, $orderOptions) ? $request->order : 'desc';

        // Apply orderBy to the query builder
        $query->orderBy($sort, $order);

        // Pobieranie wyników i paginacja
        $posts = $query->paginate(10);

        return view('home', compact('posts', 'sort', 'order'));
    }

}
