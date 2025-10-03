<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Admin\PollingStation;
use Illuminate\Support\Facades\DB;


class ImportVoters extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:voters {file} {--queue}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'To import voters';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $file = $this->argument('file');
        $fields = [
            'surname' => 'surname',
            'forename' => 'forename',
            'fname' => 'forename',
            'lname' => 'surname',
            'address' => 'address',
            'dl' => 'dl',
            'conno' => 'con_no',
            'pollingstation' =>  'polling_station',
            'party' => 'party',
            'religion' => 'religion',
            'voterid' => 'voter_id',
            'nid' => 'nid',
            'customfield1' => 'custom_field_1',
            'customfield2' => 'custom_field_2',
            'customfield3' => 'custom_field_3'
        ];
        
        $fileEx = explode('.', $file);
        $extension = end($fileEx);
        if( in_array( $extension,  array('csv', 'xls', 'xlsx') ) )
        {
            if($file)
            {
                if('csv' == $extension) {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                } 
                elseif('xls' == $extension) {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                }
                else {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                }
                $spreadsheet = $reader->load(public_path($file));
                $sheetData = $spreadsheet->getActiveSheet()->toArray();
                if(count($sheetData) >= 2)
                {
                    $createRows = [];
                    foreach($sheetData as $k => $data)
                    {
                        if($k < 1) continue;
                        
                        $data = $this->sanitize($data);
                        if(count(array_filter($data)) < 1) continue;
                        
                        $final = [];
                        foreach($data as $k => $v)
                        {
                            $key = strtolower(str_replace([' ', '_', '-', '.'], '', trim($sheetData[0][$k])));
                            $key = isset($fields[ $key ]) && $fields[ $key ] ? $fields[ $key ] : null;
                            if($key)
                                $final[$key] = $v;
                        }
                        
                        $final = $this->makeRelations($final);
                        $createRows[] = $final;
                    }
                    $count = count($createRows);
                    if($count > 0)
                    {
                        $rows = ceil($count/200);
                        for($i = 0; $i <= $rows; $i++)
                        {
                            $insert = array_slice($createRows, ($i*200), 200);
                            DB::table('voters')->insert($insert);
                            echo ($i*200) . ' is done. <br>';
                        }
                    }
                    echo $count . '<br>'; die;
                }
                // unlink(public_path($file));
            }
        }
    }

    protected function sanitize($rows){
        foreach($rows as $k => $line)
        {
           $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $line); // attempt to translate similar characters
           // $clean = preg_replace('/[^\w]/', '', $clean); // drop anything but ASCII
           $line = $clean;
           $map = [ 
                // corrupted chars sequence -> fixed chars
                "\xC3\xA8" => 'č',
                "\xC3\x88" => 'Č',
                "\xC3\xB9" => 'ů',
                "\xC3\x99" => 'Ů',
                "\xC3\xAC" => 'ě',
                "\xC3\x8C" => 'Ě',
                "\xC3\xB8" => 'ř',
                "\xC3\x98" => 'Ř',
                "\x53\xC2\x8D" => 'Š',
                "\xC2\xA9" => 'Š',
            ];
            $line = str_replace(array_keys($map), $map, $line);
            $line = trim($line);
            $rows[$k] = $line;
        }

        return $rows;
    }

    protected function makeRelations($row)
    {
        $poll = PollingStation::where('poll_station_id', 'LIKE', $row['dl'])->limit(1)->first();
        $row['religion'] = strtolower($poll->religion);
        $row['polling_station'] = $poll->title;
        $row['polling_station_id'] = $poll->id;
        $row['constituency_id'] = $poll->constituency ? $poll->constituency->id : null;
        $row['region'] = $poll->constituency ? $poll->constituency->region : null;
        $row['created'] = date('Y-m-d H:i:s');
        $row['modified'] = date('Y-m-d H:i:s');
        return $row;
    }
}
