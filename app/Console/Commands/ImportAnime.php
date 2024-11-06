<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Anime;
use Illuminate\Support\Str;

class ImportAnime extends Command
{
    protected $signature = 'import:anime';
    protected $description = 'Imports top 100 popular anime from Jikan API and saves to the database';

    public function handle()
    {
        $this->info("Starting import of top 100 anime...");

        try {
            $animeData = [];
            $pagesToFetch = 4; // We need 4 pages of 25 items each to get 100 items

            // Loop through the first 4 pages
            for ($page = 1; $page <= $pagesToFetch; $page++) {
                $this->info("Fetching page $page...");

                // Fetch data from Jikan API
                $response = Http::get('https://api.jikan.moe/v4/top/anime', [
                    'page' => $page
                ]);

                // Check if the response is successful
                if ($response->failed()) {
                    $this->error("Failed to fetch data from Jikan API on page $page.");
                    return Command::FAILURE;
                }

                $animeData = array_merge($animeData, $response->json('data'));
            }

            foreach ($animeData as $anime) {
                // Prepare data for storage
                $malId = $anime['mal_id'];
                $synopsis = $anime['synopsis'];
                $titles = [
                    'en' => [
                        'title' => $anime['title_english'] ?? null,
                        'slug' =>  Str::slug($anime['title_english'] ?? null)
                    ],
                    'pl' => [
                        'title' => $anime['title_polish'] ?? null,
                        'slug' =>  Str::slug($anime['title_polish'] ?? null)
                    ]
                ];

                Anime::updateOrCreate(
                    ['mal_id' => $malId],
                    ['titles' => $titles,
                        'synopsis' => $synopsis],
                );

                $this->info("Imported: " . $titles['en']['title']);
            }

            $this->info("Import completed successfully.");
            return Command::SUCCESS;

        } catch (\Exception $e) {
            $this->error("An error occurred: " . $e->getMessage());
            return Command::FAILURE;
        }
    }
}
