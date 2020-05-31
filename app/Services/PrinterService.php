<?php
namespace App\Service;

use App\Exports\Export;
use Excel;

class PrinterService
{
    public function exportCSV($data, $headers)
    {
        // dd($data,$headers);
        $view = view('export.newslist', [
            'data'=>$data,
            'headers'=>$headers
        ]);
        return Excel::download(new Export($view), 'news_list.csv');
    }

    public function exportEXCEL($data, $headers)
    {
        // dd($data,$headers);
        $view = view('export.newslist', [
            'data'=>$data,
            'headers'=>$headers
        ]);
        return Excel::download(new Export($view), 'news_list.xlsx');
    }
}
