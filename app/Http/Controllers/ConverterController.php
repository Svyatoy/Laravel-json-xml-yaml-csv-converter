<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConverterRequest;
use Carbon\Carbon;

use App\Http\Requests;
use Response;
use Storage;
use SoapBox\Formatter\Formatter;

class ConverterController extends Controller
{
    public function storeFile(ConverterRequest $request)
    {
        $availableFormats = array(  'JSON',
                                    'CSV',
                                    'XML',
                                    'YAML');

        $originalFileName = $request->file('file')->getClientOriginalName();
        $originalFileExtension = strtoupper($request->file('file')->getClientOriginalExtension());

        //is format available check
        if (!in_array($originalFileExtension, $availableFormats)) {
            return 'Wrong file extension used';
        }

        //is formats different check
        if ($originalFileExtension == $request['to']) {
            return 'Nothing to convert';
        }

        //get the file content before
        $contentBefore = file_get_contents($request->file('file'));

        //get the converted content
        $contentAfter = $this->convert($contentBefore, $originalFileExtension, $request['to']);

        //create new file for user
        $filename = Carbon::now()->toDateTimeString().
                    $originalFileName.
                    '.'.
                    strtolower($request['to']);

        Storage::put($filename, $contentAfter);

        $pathToFile = storage_path('app').'/'.$filename;

        return Response::download($pathToFile);
    }

    private function convert($data, $fromType, $toType) {
        $formatter = null;

        switch ($fromType) {
            case 'JSON':
                $formatter = Formatter::make($data, Formatter::JSON); break;
            case 'XML':
                $formatter = Formatter::make($data, Formatter::XML); break;
            case 'YAML':
                $formatter = Formatter::make($data, Formatter::YAML); break;
            case 'CSV':
                $formatter = Formatter::make($data, Formatter::CSV); break;
        }

        $result = null;

        switch ($toType) {
            case 'JSON':
                $result = $formatter->toJson(); break;
            case 'XML':
                $result = $formatter->toXml(); break;
            case 'YAML':
                $result = $formatter->toYaml(); break;
            case 'CSV':
                $result = $formatter->toCsv(); break;
        }

        return $result;
    }
}
