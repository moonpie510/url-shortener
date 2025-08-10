<?php

namespace App\Services;

use App\Models\Link;
use Illuminate\Support\Str;

class LinkService
{
    private static int $shortLinkLength = 10;

    public function generateShortLink(string $link): string
    {
       $linkModel = Link::query()->where('full_link', $link)->first();

       if ($linkModel !== null) {
           return $linkModel->short_link;
       }

        do {
            $shortCode = Str::random(self::$shortLinkLength);
        } while (Link::query()->where('short_link', $shortCode)->exists());

        $linkModel = Link::query()->create([
            'short_link' => $shortCode,
            'full_link' => $link,
        ]);

        return $linkModel->short_link;
    }

    public function getByShortLink(string $shortLink): ?Link
    {
        return Link::query()->where('short_link', $shortLink)->first();
    }
}
