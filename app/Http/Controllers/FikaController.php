<?php

namespace App\Http\Controllers;

use App\Fika;
use App\Http\Requests\CreateFikaRequest;
use App\Time;
use Badcow\PhraseGenerator\PhraseGenerator;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\View\View;

class FikaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('fika.create');
    }

//    /**
//     * Show the form for creating a new resource.
//     *
//     * @return Application|Factory|View
//     */
//    public function create()
//    {
//        return view('fika.create');
//    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateFikaRequest $request
     * @return RedirectResponse
     */
    public function store(CreateFikaRequest $request)
    {
        $validated = $request->validated();

        $fika = new Fika([
            'title' => $validated['title'],
            'slug' => Str::snake(PhraseGenerator::generate(), '-')
        ]);

        $fika->save();

        foreach ($validated['times'] as $t) {
            $time = new Time;

            $time->start = $t;
            $time->end = Carbon::parse("$t", 'Europe/Stockholm')->addMinutes(30)->format('H:i');

            $time->fika()->associate($fika);
            $time->save();
        }

        return redirect()->to(route('fika.show', $fika));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Fika  $fika
     * @return Application|Factory|View
     */
    public function show(Fika $fika)
    {
        return view('fika.show', [
            'fika' => $fika->load('times')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Fika  $fika
     * @return Response
     */
    public function edit(Fika $fika)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Fika  $fika
     * @return Response
     */
    public function update(Request $request, Fika $fika)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Fika  $fika
     * @return Response
     */
    public function destroy(Fika $fika)
    {
        //
    }

    public function times(Request $request, Fika $fika)
    {
        $times = $fika->times()->get();

        $filterTimes = $times->filter(function (Time $time) {
            $end = $time->getAttribute('end');
            $date = Carbon::parse("$end", 'Europe/Stockholm');
            return $date->isAfter(now());
        });

        return json_encode($filterTimes->map(function(Time $time) {
            return [
                'start' => $time->getAttribute('start'),
                'end' => $time->getAttribute('end')
            ];
        }));
    }
}
