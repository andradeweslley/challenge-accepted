<?php

namespace App\Http\Controllers;

use App\Models\Locale;
use App\Repository\SearchRepository;

class LocaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SearchRepository $searchRepository)
    {
        return response()->json(
            request()->has('q')
                ? $searchRepository->search(request('q'))
                : Locale::all()
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $locale = Locale::findOrFail($id);

        return response()->json($locale);
    }
}
