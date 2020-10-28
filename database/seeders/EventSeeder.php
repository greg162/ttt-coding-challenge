<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;

class EventSeeder extends Seeder
{
    /**
     * This seeder will import the events from resources/seed_data/events_summary.csv.
     * The CSV should contain 4 columns: id, name, date, info. The id column should be unique.
     * If this seeder is run more than once, the event data will be updated, not created for a second time.
     * @return void
     */

    private $eventCsvFilePath = "resources/seed_data/events_summary.csv";

    function __construct() {
        $this->eventCsvFilePath = base_path($this->eventCsvFilePath);
    }

    public function run() {
        //TODO: Data is being imported in the main database seeder for now. Would recommend separating out if app expands.
        $file          = fopen($this->eventCsvFilePath,"r");

        $i       = 0;
        $headers = [];
        while (($csvRow = fgetcsv($file)) !== FALSE) {
            if($i === 0) { $headers = $csvRow; }
            else {
                $csvRow     = array_combine($headers, $csvRow);
                $insertData = [
                    'event_date'  => $csvRow['date'],
                    'name'        => $csvRow['name'],
                    'information' => $csvRow['info']
                ];
                if(Event::where('id', $csvRow['id'])->count()) {
                    Event::where('id', $csvRow['id'])->update($insertData);
                } else {
                    $insertData['id'] = $csvRow['id'];
                    $event            = Event::create($insertData);
                }
            }
            $i++;
        }
        fclose($file);
    }
}
