<?php 
  session_start();
  require_once('Controller/process.php');
  $page_title = "Học phí";
  include("sidebar.php");
  include("header.php");
  require_once 'vendor/autoload.php';
  use PhpOffice\PhpSpreadsheet\IOFactory;
  if(isset($_SESSION['status']) && $_SESSION['status'] == 'login success'){
    $id = $_SESSION['maHS'];
    $inforTuition = getInforTuition($id);   
}
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
<style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f4f4; /* Slightly gray background */
    }
    .container {
        max-width: 80%;
        margin: 40px auto;
        background-color: #fff;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 6px 20px rgba(0,0,0,.15);
    }
    .header {
        background: #003C43;
        color: white;
        padding: 15px;
        font-size: 24px;
        text-align: center;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        box-shadow: 0 2px 4px rgba(0,0,0,.1);
    }
    .custom-table {
        margin-top: 20px;
        box-shadow: 0 2px 10px rgba(0,0,0,.1);
    }
    .custom-table th, .custom-table td {
        padding: 12px 15px;
        text-align: left;
        vertical-align: middle;
        border-bottom: 2px solid #dee2e6;
    }
    .custom-table th {
        background-color: black;
        color: white;
    }
    .custom-table tbody tr:nth-child(even) {
        background-color: #f8f9fa;
    }
    .custom-table tbody tr:hover {
        background-color: #e2e6ea;
        cursor: pointer;
    }
</style>

<div class="container">
    <div class="header">Học phí</div>
    <table class="table align-middle custom-table">
        <thead>
            <tr>
                <th scope="col">Ngày</th>
                <th scope="col">Chi tiết học phí</th>
                <th scope="col">Trạng thái</th>
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
                        $filepath = '../Admin/modal/tuition/'.$filename;
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
