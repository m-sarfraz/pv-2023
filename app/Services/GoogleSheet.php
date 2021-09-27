<?php
namespace App\Services;

use Config;
use Google_Client;
use PulkitJalan\Google\Facades\Google;
use Revolution\Google\Sheets\Sheets;

class GoogleSheet
{
    private $spreadSheetId;
    private $client;
    private $googleSheetService;

    public function __construct()
    {

        $this->spreadSheetId = config("datastudio.google_sheet_id");
        $this->client = new Google_Client();
        $this->client->setAuthConfig(storage_path("credientials.json"));
        $this->client->addScope("https://www.googleapis.com/auth/spreadsheets");
        $this->googleSheetService = new \Google\Service\Sheets($this->client);
    }
    public function readGoogleSheet($config2)
    {
        try {
            $config = Config::get("datastudio.google_sheet_id");
            // dd($config);
            Config::set('datastudio.google_sheet_id', $config2);
            // $config2 = Config::get("datastudio.google_sheet_id");
            // dd($config2);
            $dimensions = $this->getDimensions($config2);

            $range = 'Sheet1!A1:' . $dimensions['colCount'];
            $data = $this->googleSheetService
                ->spreadsheets_values
                ->batchGet($config2, ['ranges' => $range]);
            return $data->valueRanges;
        } catch (\Exception $e) {
            return $e->getMessage();
        }

    }
    private function getDimensions($spreadSheetId)
    {
        $rowDimensions = $this->googleSheetService->spreadsheets_values->batchGet(
            $spreadSheetId,
            ['ranges' => 'Sheet1!A:A', 'majorDimension' => 'COLUMNS']
        );

        //if data is present at nth row, it will return array till nth row
        //if all column values are empty, it returns null
        $rowMeta = $rowDimensions->getValueRanges()[0]->values;
        if (!$rowMeta) {
            return [
                'error' => true,
                'message' => 'missing row data',
            ];
        }

        $colDimensions = $this->googleSheetService->spreadsheets_values->batchGet(
            $spreadSheetId,
            ['ranges' => 'Sheet1!1:1', 'majorDimension' => 'ROWS']
        );

        //if data is present at nth col, it will return array till nth col
        //if all column values are empty, it returns null
        $colMeta = $colDimensions->getValueRanges()[0]->values;
        if (!$colMeta) {
            return [
                'error' => true,
                'message' => 'missing row data',
            ];
        }

        return [
            'error' => false,
            'rowCount' => count($rowMeta[0]),
            'colCount' => $this->colLengthToColumnAddress(count($colMeta[0])),
        ];
    }

    private function colLengthToColumnAddress($number)
    {
        if ($number <= 0) {
            return null;
        }

        $letter = '';
        while ($number > 0) {
            $temp = ($number - 1) % 26;
            $letter = chr($temp + 65) . $letter;
            $number = ($number - $temp - 1) / 26;
        }
        return $letter;
    }
}
