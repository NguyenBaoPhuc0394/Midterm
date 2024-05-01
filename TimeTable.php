<?php 
  session_start();
  $page_title = "Thời khóa biểu";
  require_once('Controller/getTimetable.php');
  // require_once 'vendor/autoload.php';
  // use PhpOffice\PhpSpreadsheet\IOFactory;
  include("sidebar.php");
  include("header.php");
  echo('<link rel="stylesheet" href="css/timetable.css">');
?>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="mb-4">Thời khóa biểu</h3>
            </div>
            <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <?php  
                              foreach($result[0] as $data){
                                echo '<th>'.$data.'</th>';
                              }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                          for($i = 1;$i < count($result);$i++){
                            echo '<tr>';
                            for($j = 0;$j < count($result[$i]);$j++){
                              echo '<td>'.$result[$i][$j].'</td>';
                            }
                            echo '</tr>';
                          }
                        ?>
                        <!-- More rows as needed -->
                    </tbody>
                </table>
            </div>
            </div>
          </div>
        </div>
    </div>
</div>

<?php 
  include("footer.php");
?>
