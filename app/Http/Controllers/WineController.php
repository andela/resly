<?php

namespace Resly\Http\Controllers;

use Auth;
use Request;
use Resly\Wine;
use Resly\Restaurateur;
use Resly\Http\Requests\WineRequest;

class WineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wines = Wine::personalize()->get();

        return view('wine.index', ['wines' => $wines]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('wine.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(WineRequest $request)
    {
        $wine = new Wine();
        $wine->restaurateur_id = Auth::restaurateur()->get()->id;
        $wine->name = $request['name'];
        $wine->year = $request['year'];
        $wine->description = $request['description'];
        $wine->price = $request['price'];
        $wine->save();

        return redirect('wines');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('wine.show', ['wine' => $this->findById($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('wine.edit', ['wine' => $this->findById($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $wineUpdateValues = Request::all();

        $this->findById($id)->update($wineUpdateValues);

        return redirect('wines');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->findById($id)->delete();

        return redirect('wines');
    }

    private function findById($id)
    {
        return Wine::find($id);
    }
}
