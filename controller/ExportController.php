<?php 
require_once 'Controller.php';
require_once '../assets/helpers.php';
require_once '../model/settings.config.php';
require_once '../model/Candidate.php';

Class ExportController extends Controller{

  private $candidate;

  public function __construct($dbconfig){
    parent::__construct($dbconfig);
    $this->candidate = new Candidate($dbconfig);
  }

  /* Function validateSession
     * Checks if a session is valid or redirects
     */
  public function validateSession(){
    parent::validateSession();
  }

  /* Function array2CSV
   * Transform array into a CSV file
   * @param $array a array with candidates data
   * @return CSV file
   */
  private function array2CSV(array &$array){
    if (count($array) == 0) {
      return null;
    }
    ob_start();
    $df = fopen("php://output", 'w');
    fprintf($df, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) )); //Encodes to UTF-8 in Excel files
    fputcsv($df, array_keys(reset($array)));
    foreach ($array as $row) {
      fputcsv($df, $row);
    }
    fclose($df);
    return ob_get_clean();
  }

  /* Function downloadSendHeaders
   * Sends header information to the browser
   * @param $filename the file name to download
   */
  private function downloadSendHeaders($filename) {
    // disable caching
    $now = gmdate("D, d M Y H:i:s");
    header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
    header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
    header("Last-Modified: {$now} GMT");

    // force download  
    header("Content-Type: application/force-download");
    header("Content-Type: application/octet-stream");
    header("Content-Type: application/download");

    // disposition / encoding on response body
    header("Content-Disposition: attachment;filename={$filename}");
    header("Content-Transfer-Encoding: binary");
  }

  /* Function gerCSV
   * Generate a CVS file with candidates of current year inscription
   */
  public function gerCSV($year){
    if (isset($year)) {

      $filename = "data_export_".date("Y-m-d").".csv";
      $this->downloadSendHeaders($filename);

      $stDate = date($year)."-01-01";
      $endDate = date($year)."-12-31";
      $candidates = $this->candidate->getInscriptions($stDate,$endDate);
      echo $this->array2csv($candidates);
      exit;
    }
    /*$dados = array('msg' => 'Ocorreu um erro ao exportar os dados, tente novamente', 'type' => parent::$error);
    $_SESSION['data'] = $dados;
    header("Location: ../view/export.php");
    exit;*/
  }
}
//--------------------------------------------------------------
session_start();
$controller = new ExportController($dbconfig);
$controller->validateSession();

if (isset($_POST['export']) && $_POST['export']=='export') {
  $controller->gerCSV($_POST['insc-date']);
}