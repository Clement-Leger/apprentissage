<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilmRequest;
use App\Models\{Film, Category, Actor};
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($slug = null): View
    {
        $model = null;

        if($slug){
            if(Route::currentRouteName() == 'films.category') {
                $model = new Category;
            } else {
                $model = new Actor;
            }
        }
        $query = $model ? $model->whereSlug($slug)->firstOrFail()->films() : Film::query();
        $films = $query->withTrashed()->oldest('title')->paginate(5);
        return view('index', compact('films', 'slug'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FilmRequest $request): RedirectResponse
    {
        $film = Film::create($request->all());
        $film->categories()->attach($request->cats);
        $film->actors()->attach($request->acts);

        return redirect()->route('films.index')->with('info', 'Le film a bien été créé.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Film $film): View
    {
        // $film->with('categories')->get();    
        return view('show', compact('film'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Film $film)
    {
        return view('edit', compact('film'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FilmRequest $filmRequest, Film $film): RedirectResponse
    {
        $film->update($filmRequest->all());
        $film->categories()->sync($filmRequest->cats);
        $film->actors()->sync($filmRequest->acts);
        return redirect()->route('films.index')->with('info', 'Le film a bien été modifié');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Film $film): RedirectResponse
    {
        $film->delete();

        return back()->with('info', 'Le film a bien été mis dans la corbeille.');
    }

    public function forceDestroy($id): RedirectResponse
{
    Film::withTrashed()->whereId($id)->firstOrFail()->forceDelete();

    return back()->with('info', 'Le film a bien été supprimé définitivement dans la base de données.');
}

public function restore($id): RedirectResponse
{
    Film::withTrashed()->whereId($id)->firstOrFail()->restore();

    return back()->with('info', 'Le film a bien été restauré.');
}
}
