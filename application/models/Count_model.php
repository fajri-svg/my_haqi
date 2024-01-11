<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Count_model extends CI_Model
{
    public function calculateLanguagePercentage()
    {
        $projectPath = '\xampp\htdocs\my_haqi'; // Sesuaikan dengan path proyek Anda
        $totalFiles = count(glob("$projectPath/*.php")) + count(glob("$projectPath/*.js")) + count(glob("$projectPath/*.html"));

        $phpFiles = count(glob("$projectPath/*.php"));
        $javascriptFiles = count(glob("$projectPath/*.js"));
        $htmlFiles = count(glob("$projectPath/*.html"));

        $phpPercentage = ($phpFiles / $totalFiles) * 100;
        $javascriptPercentage = ($javascriptFiles / $totalFiles) * 100;
        $htmlPercentage = ($htmlFiles / $totalFiles) * 100;

        return [
            'phpPercentage' => $phpPercentage,
            'javascriptPercentage' => $javascriptPercentage,
            'htmlPercentage' => $htmlPercentage,
        ];
    }
}
