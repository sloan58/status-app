<?php namespace App\Http\Controllers;


use Mail;
use App\Project;
use Carbon\Carbon;
use App\Http\Requests;
use Laracasts\Flash\Flash;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\PhpWord;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ReportsController extends Controller {


    /**
     * Require authentication for all methods
     */
    function __construct()
    {
        $this->middleware('auth');
    }

    public function projects()
    {
        $period = \Input::get('period');

        //Get all projects
        $projects = Project::where('updated_at', '>=', Carbon::now()->subWeek($period))->get();

        //Feed projects to the document creator
        $this->createWordDoc($projects);

        Flash::success('The report has been generated.  It was emailed to ' . \Auth::user()->email);
        return redirect()->route('projects.index');

    }

    private function createWordDoc($projects)
    {

        // Creating the new document...
        $phpWord = new PhpWord();

        $phpWord->addFontStyle(
            'statusFont',
            ['name' => 'Tahoma', 'size' => 10, 'color' => '1B2232', 'bold' => true]
        );

        $section = $phpWord->addSection();
        $header = ['size' => 16, 'bold' => true];

        // Create table
        $section->addTextBreak(1);
        $section->addText(htmlspecialchars('NIPT Status Tracker ' . Carbon::now()->subWeek(1)->toDateString() . ' to ' . Carbon::now()->toDateString()), $header);
        $styleTable = ['borderSize' => 6, 'borderColor' => '006699', 'cellMargin' => 80];
        $styleFirstRow = ['borderBottomSize' => 18, 'borderBottomColor' => '0000FF', 'bgColor' => '66BBFF'];
        $styleCell = ['valign' => 'center'];
        $styleCellBTLR = ['valign' => 'center', 'textDirection' => \PhpOffice\PhpWord\Style\Cell::TEXT_DIR_BTLR];
        $fontStyle = ['bold' => true, 'align' => 'center'];
        $phpWord->addTableStyle('Fancy Table', $styleTable, $styleFirstRow);
        $table = $section->addTable('Fancy Table');
        $table->addRow(900);
        $table->addCell(2000, $styleCell)->addText(htmlspecialchars('Project Owner(s)'), $fontStyle);
        $table->addCell(2000, $styleCell)->addText(htmlspecialchars('Project Name'), $fontStyle);
        $table->addCell(2000, $styleCell)->addText(htmlspecialchars('Update(s)'), $fontStyle);

        foreach ($projects as $project) {

            $table->addRow();
            $owners = $table->addCell(2000);

            foreach ($project->user as $owner)
            {
                $owners->addText(htmlspecialchars($owner->name));
            }

            $table->addCell(2000)->addText(htmlspecialchars($project->name));
            $body = $table->addCell(8000);

            if (!isset($project->status[0])) {

                $body->addText(htmlspecialchars('No Status Updates this week'));

                continue;

            }

            $i = 1;
            foreach ($project->status as $status) {
                $body->addText(htmlspecialchars('(' . $i . ')' . ' Added by ' . $status->user->name . ' ' . $status->updated_at->diffForHumans() . ':'));
                $body->addText(htmlspecialchars($status->body), 'statusFont');
                $body->addTextBreak(1);

                ++$i;

            }

        }


        // Saving the document as OOXML file...
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');

        $fileNameAndPath = 'tmp/IED-NIPT_Tracker' . Carbon::now()->toDateString() . '.docx';

        $objWriter->save($fileNameAndPath);

        Mail::send('projects.emails.report', [ ], function($message) use ($fileNameAndPath)
        {
            $message->from('info@laireight.com');
            $message->to(\Auth::user()->email)->subject("IED NIPT Status Tracker Report");
            $message->attach($fileNameAndPath);

        });

//        File::delete($fileNameAndPath);

    }
}
