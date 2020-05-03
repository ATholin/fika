<?php

namespace App\Http\Controllers;

use App\Fika;
use App\Http\Requests\CreateFikaRequest;
use App\Http\Requests\UpdateFikaRequest;
use App\Time;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
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
            'slug' => $validated['slug'],
        ]);

        if (!empty($validated['password'])) {
            $fika->password = Hash::make($validated['password']);
        }

        $fika->save();

        foreach ($validated['times'] as $t) {
            $time = new Time;

            $time->start = $t['start'];
            $time->end = $t['end'];

            $time->fika()->associate($fika);
            $time->save();
        }

        return redirect()->to(route('fika.show', $fika));
    }

    /**
     * Display the specified resource.
     *
     * @param Fika $fika
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
     * @param Request $request
     * @param Fika $fika
     * @return RedirectResponse|View
     */
    public function auth(Request $request, Fika $fika)
    {
        if (empty($fika->password)) {
            return view('fika.show', [
                'fika' => $fika,
            ]);
        }

        $validated = $request->validate([
            'password' => function ($attribute, $value, $fail) use ($fika) {
                if (! Hash::check($value, $fika->password)) {
                    $fail('Password is incorrect.');
                }
            },
        ]);

        session([
            'fikas' => [...session('fikas', []), $fika->slug]
        ]);

        return redirect()->to(route('fika.edit', $fika));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Fika $fika
     * @return Application|Factory|View|RedirectResponse
     */
    public function edit(Fika $fika)
    {
        if (empty($fika->password)) {
            return back();
        }

        $pages = session('fikas', []);

        if (! in_array($fika->slug, $pages)) {
            return redirect()->to(route('fika.edit.auth', $fika));
        }

        return view('fika.edit', [
            'fika' => $fika
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateFikaRequest $request
     * @param Fika $fika
     * @return RedirectResponse
     */
    public function update(UpdateFikaRequest $request, Fika $fika)
    {
        $pages = session('fikas', []);

        if (! in_array($fika->slug, $pages)) {
            return redirect()->to(route('fika.edit.auth', $fika));
        }

        $validated = $request->validated();

        if ($request->has('password')) {
            $validated['password'] = Hash::make($validated['password']);
        }

        $fika->update($validated);

        return redirect()->to(route('fika.show', $fika));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return void
     */
    public function destroy()
    {
        return;
    }

    public function times(Fika $fika)
    {
        $times = $fika->times()->get(['start', 'end']);
        return json_encode($times);

//        $filterTimes = $times->filter(function (Time $time) {
//            $end = $time->getAttribute('end');
//            $date = Carbon::parse("$end", 'Europe/Stockholm');
//            return $date->isAfter(now());
//        });
//
//        return json_encode($filterTimes->map(function(Time $time) {
//            return [
//                'start' => $time->getAttribute('start'),
//                'end' => $time->getAttribute('end')
//            ];
//        }));
    }
}
