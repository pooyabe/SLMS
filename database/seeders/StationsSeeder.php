<?php

namespace Database\Seeders;

use App\Models\Config;
use App\Models\DataLogger;
use App\Models\Sensor;
use App\Models\Station;
use App\Models\StationSensor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create some sensors
        Sensor::create([
            'type' => 'pressure',
            'model' => 'Nidec',
            'min_height' => '500',
            'max_height' => '5000',
            'color' => 'red',
        ]);

        Sensor::create([
            'type' => 'pressure',
            'model' => 'RBR',
            'min_height' => '100',
            'max_height' => '6000',
            'color' => 'blue',
        ]);

        Sensor::create([
            'type' => 'radar',
            'model' => 'Vega',
            'min_height' => '800',
            'max_height' => '8000',
            'color' => 'black',
        ]);

        // Create some data loggers
        DataLogger::create([
            'brand' => 'Seneca',
            'model' => 'ZGPRS2',
        ]);
        DataLogger::create([
            'brand' => 'Seneca',
            'model' => 'ZGPRS3',
        ]);
        DataLogger::create([
            'brand' => 'YDOC',
            'model' => 'T18',
        ]);

        // Create some stations
        Station::create([
            'name' => 'چمخاله',
            'code' => 'GIL3',
            'state' => 'Gilan',
            'main_contact' => 'NCC',
            'latitude' => '1000',
            'longitude' => '1000',
            'reference_datum' => 'Iran Geoid',
            'is_online' => 1
        ]);
        Station::create([
            'name' => 'انزلی',
            'code' => 'GIL2',
            'state' => 'Gilan',
            'main_contact' => 'NCC',
            'latitude' => '1500',
            'longitude' => '1800',
            'reference_datum' => 'Iran Geoid',
            'is_online' => 1
        ]);
        Station::create([
            'name' => 'اروندکنار',
            'code' => 'KHU4',
            'state' => 'Khuzestan',
            'main_contact' => 'NCC',
            'latitude' => '800',
            'longitude' => '100',
            'reference_datum' => 'Local Geoid',
            'is_online' => 1
        ]);


        // Create some configs
        Config::create([
            'station_id' => 1,
            'datalogger_id' => 2,
            'time_zone' => '+3:30 GMT',
            'sample_rate' => 15,
            'connection_type' => 'FTP',
            'server_folder_name' => 'Chamkhale',
            'simcard_provider' => 'mtnirancell',
            'phone_number' => '09361234567',
        ]);

        Config::create([
            'station_id' => 2,
            'datalogger_id' => 1,
            'time_zone' => '+3:30 GMT',
            'sample_rate' => 15,
            'connection_type' => 'FTP',
            'server_folder_name' => 'Anzali',
            'simcard_provider' => 'irmci',
            'phone_number' => '09102547896',
        ]);

        Config::create([
            'station_id' => 3,
            'datalogger_id' => 3,
            'time_zone' => '+3:30 GMT',
            'sample_rate' => 15,
            'connection_type' => 'FTP',
            'server_folder_name' => 'Arvand',
            'simcard_provider' => 'irmci',
            'phone_number' => '09123678941',
        ]);

        // Seed some station_sensor relates
        StationSensor::create([
            'station_id' => 1,
            'sensor_id' => 3,
            'min_val' => 4000,
            'max_val' => 20000,
            'min_val_height' => 800,
            'max_val_height' => 8000,
            'sensor_data_transfer_type' => 'A',
            'offset' => -21456,
            'gain' => -1,
            'description' => 'سیم زرد به اسلات ۱',
        ]);

        StationSensor::create([
            'station_id' => 2,
            'sensor_id' => 3,
            'min_val' => 4000,
            'max_val' => 20000,
            'min_val_height' => 1000,
            'max_val_height' => 10000,
            'sensor_data_transfer_type' => 'A',
            'offset' => -22365,
            'gain' => -1,
            'description' => '',
        ]);

        StationSensor::create([
            'station_id' => 3,
            'sensor_id' => 2,
            'min_val' => 4000,
            'max_val' => 20000,
            'min_val_height' => 0,
            'max_val_height' => 15000,
            'sensor_data_transfer_type' => 'V',
            'offset' => 5900,
            'gain' => 1,
            'description' => '',
        ]);
    }
}
