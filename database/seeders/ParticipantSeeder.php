<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Participant;

class ParticipantSeeder extends Seeder
{
    /**
     * Import the participants from /resources/import_data/event_enrollment.csv
     * This CSV file should have three columns: first_name, last_name and event_id.
     * Note: There is no validation to check if a user already exists for an event.
     * @return void
     */

    private $participantCsvFilePath = "resources/seed_data/events_enrollment.csv";

    function __construct() {
        $this->participantCsvFilePath = base_path($this->participantCsvFilePath);
    }
    
    public function run() {
        //TODO: Data is being imported in the main database seeder for now. Would recommend separating out if app expands.
        $file    = fopen($this->participantCsvFilePath,"r");
        $i       = 0;
        $headers = [];
        while (($csvRow = fgetcsv($file)) !== FALSE) {
            if($i === 0) { $headers = $csvRow; }
            else {
                $csvRow     = array_combine($headers, $csvRow); //Set the first column as the keys to ensure that data is not mixed up if the order of the columns changes.
                $insertData = [
                    'first_name' => $csvRow['first_name'],
                    'last_name'  => $csvRow['last_name'],
                    'event_id'   => $csvRow['event_id'],
                ];

                $participant = Participant::create($insertData);
            }
            $i++;
        }
        fclose($file);
    }
}
