<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    public function create()
    {
        $length = 6;

        $old = Link::query()->where('full_link', request('link'))->first();

        if ($old) {
            return route('link.get', [$old->short_link]);
        }

        do {
            $shortCode = substr(str_shuffle(str_repeat(
                '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', $length
            )), 0, $length);
        } while (Link::query()->where('short_link', $shortCode)->exists());

        Link::query()->create([
            'short_link' => $shortCode,
            'full_link' => request('link'),
        ]);

        return route('link.get', [$shortCode]);
    }

    public function show(string $link)
    {
        $link = Link::query()->where('short_link', $link)->value('full_link');

        abort_if(!$link, 404);

        return redirect($link);
    }
}
