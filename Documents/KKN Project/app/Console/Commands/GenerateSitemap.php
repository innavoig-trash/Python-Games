<?php

namespace App\Console\Commands;

use App\Models\Plant;
use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-sitemap';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $sitemap = Sitemap::create();

        // Static pages
        $sitemap->add('/');
        $sitemap->add('/scanner');
        $sitemap->add('/plants');

        // Dynamic pages
        $sitemap->add(Plant::all());
        $sitemap->writeToFile(public_path('sitemap.xml'));
    }
}
