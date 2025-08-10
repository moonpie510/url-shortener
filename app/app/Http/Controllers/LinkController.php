<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateLinkRequest;
use App\Models\Statistic;
use App\Services\LinkService;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    public function __construct(
        private readonly LinkService $linkService,
    )
    {}

    public function create(CreateLinkRequest $request): string
    {
        $shortLink = $this->linkService->generateShortLink(link: $request->link);

        // Сохраняем статистику
        Statistic::query()->create([
            'ip' => $request->ip(),
            'url' => $request->url(),
            'method' => $request->method(),
            'full_link' => $request->link,
            'short_link' => route('links.show', [$shortLink]),
        ]);

        return route('links.show', [$shortLink]);
    }

    public function show(Request $request, string $link)
    {
        $linkModel = $this->linkService->getByShortLink($link);
        abort_if(!$linkModel, 404);

        // Сохраняем статистику
        Statistic::query()->create([
            'ip' => $request->ip(),
            'url' => $request->url(),
            'method' => $request->method(),
            'full_link' => $linkModel->full_link,
            'short_link' => route('links.show', [$link]),
        ]);

        return redirect($linkModel->full_link);
    }
}
