<?php 
  session_start();
  require_once('Controller/getTuition.php');
  $page_title = "Học phí";
  include("sidebar.php");
  include("header.php");
  require_once 'vendor/autoload.php';
  use PhpOffice\PhpSpreadsheet\IOFactory;

?>

<div class="container mt-5">
    <h2 class="mb-4 text-center">Học phí</h2>
    
    <!-- Display all tuition fees (Static Data for Demonstration) -->
    <div class="mb-5">
        <h3>All Tuition Fees</h3>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Date</th>
                        <th>Tuition Details</th>
                        <th>Station</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $tuition;
                    if(count($inforTuition) > 0 && !array_key_exists('error', $inforTuition)){
                        foreach($inforTuition as $inforItem){
                            if($inforItem['error'] == ''){
                                $tuition = getTuition($inforItem['thoigian']);
                                if($tuition['error'] == ''){
                                    echo '<tr>';
                                    echo "<td>{$tuition['thoigian']}</td>";
                                    echo "<td>".getsum($tuition['thongtin'])."</td>";
                                    echo "<td>{$inforItem['tinhtrang']}</td>";
                                    echo '</tr>';
                                }
                            }
                        }
                    }
                    function getSum($filename){
                        $filepath = '../Admin_backend/tuition/'.$filename;
                        $sum = 0;
                        $spreadsheet = IOFactory::load($filepath);
                        $sheet = $spreadsheet->getActiveSheet();
                        $data = $sheet->toArray();
                        $allRows = array();
                        foreach ($data as $index => $row) {
                            if ($index === 0) {
                                continue;
                            }
                            $allRows[] = $row;
                        }
                        foreach($allRows as $row){
                            $sum += $row[1];
                        }
                        return $sum;
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<?php 
  include("footer.php");
?>
