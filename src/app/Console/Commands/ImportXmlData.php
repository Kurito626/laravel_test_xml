<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Category;
use App\Models\Product;
use App\Models\Extrop;
use SimpleXMLElement;

class ImportXmlData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:xml {path : Path to the XML file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import data from XML file to database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $path = storage_path($this->argument('path'));

        if (!file_exists($path)) {
            $this->error("File not found: {$path}");
            return;
        }

        $xmlString = file_get_contents($path);
        $xml = new SimpleXMLElement($xmlString);

        try {
            $this->importCategories($xml);
            $this->importProducts($xml);
            $this->info('Data imported successfully!');
        } catch (\Throwable $e) {
            $this->error("Error during import: " . $e->getMessage());
        }

    }

    private function importCategories(SimpleXMLElement $xml): void
    {
        foreach ($xml->shop->categories->category as $category) {
            Category::updateOrCreate(
                ['id' => (int)$category['id']],
                [
                    'name' => (string)$category,
                    'parent_id' => isset($category['parentId']) ? (int)$category['parentId'] : null,
                ]
            );
        }
    }

    private function importProducts(SimpleXMLElement $xml): void
    {
        foreach ($xml->shop->offers->offer as $offer) {
            $extprop = Extrop::updateOrCreate(
                [
                    'name' => (string)$offer->extprops->name,
                    'season' => (string)$offer->extprops->season,
                ]
            );

            Product::updateOrCreate(
                ['articul' => (string)$offer->articul],
                [
                    'name' => (string)$offer->name,
                    'url' => (string)$offer->url,
                    'price' => (float)$offer->price,
                    'opt_price' => (float)$offer->optprice,
                    'picture' => (string)$offer->picture,
                    'articul' => (string)$offer->articul,
                    'vendor' => (string)$offer->vendor,
                    'description' => (string)$offer->description,
                    'available' => (string)$offer['available'] === 'true',
                    'status_new' => (string)$offer->statusNew === 'true',
                    'status_action' => (string)$offer->statusAction === 'true',
                    'status_top' => (string)$offer->statusTop === 'true',
                    'extprop_id' => $extprop->id,
                    'category_id' => (int)$offer->categoryId,
                ]
            );
        }
    }

}
