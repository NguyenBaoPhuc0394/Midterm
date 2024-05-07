<?php 
    session_start();
    require_once('Controller/process.php');
    $page_title = "Điểm số";
    include("sidebar.php");
    include("header.php");
    $infor = getInformation($_SESSION['maHS']);
    $subjects = getSubjects();
    $averScore = array();
    function averSub($a,$b,$c){
        return ($a + $b + $c) / 3;
    }
    function averAll($array){
        $s = 0;
        foreach($array as $arr){
            $s += $arr;
        }
        return $s / count($array);
    }
?>
<style>
    .card-header{
        background-color: #153448;
        color: white;
    }

    thead{
        background-color: #153448;
    }
    /* .tb span{
        font-size: large;
    } */
    #aver{
        text-align: center;
    }
    #export{
        background-color: #153448;
        color: white;
    }
</style>
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3>Study results</h3>
        </div>
        <div class="card-body">
            <table class="table table-responsive table-bordered border-dark table-hover table-striped text-center text-capitalize" id="table">
                    <thead>
                        <tr class="table-active text-uppercase text-white">
                            <th>Tên môn</th>
                            <th>Quá trình</th>
                            <th>Giữa kỳ</th>
                            <th>Cuối kỳ</th>
                            <th>Trung bình</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            if($infor['error'] == ''){
                                foreach($subjects as $sub){
                                    if($sub['error'] == ''){
                                        $result = getResults($infor['maHS'],$sub['mamon']);
                                        if($result['error'] == ''){
                                            $score = averSub($result['qt'],$result['gk'],$result['ck']);
                                            $averScore[] = $score;
                                            echo '<tr>';
                                            echo '<td>'.$sub['temon'].'</td>';
                                            echo '<td>'.$result['qt'].'</td>';
                                            echo '<td>'.$result['gk'].'</td>';
                                            echo '<td>'.$result['ck'].'</td>';
                                            echo '<td>'.$score.'</td>';
                                            echo '</tr>';
                                        }
                                    }
                                }
                                echo '<tr>';
                                echo '<td>'.'Điểm trung bình'.'</td>';
                                echo '<td colspan ="4" id = "aver">'.averAll($averScore).'</td>';
                                echo '</tr>';
                            }
                        ?>
                    </tbody>
            </table>
            <div class="row justify-content-end a">
                <div class="col-md-2">
                    <button id="export" type="button" class="btn mt-1" onclick="exportDate()">Export</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.sheetjs.com/xlsx-0.20.2/package/dist/xlsx.full.min.js"></script>
<script lang="javascript" src="https://cdn.sheetjs.com/xlsx-0.20.2/package/dist/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.0/FileSaver.min.js"></script>
<script>
    function toArrBuffer(s) {
        var buf = new ArrayBuffer(s.length);
        var view = new Uint8Array(buf);
        for (var i=0; i<s.length; i++) view[i] = s.charCodeAt(i) & 0xFF;
        return buf;
    }
    function exportDate(){
        var table = document.getElementById('table')
        var book = XLSX.utils.table_to_book(table)
        XLSX.utils.book_append_sheet(book, book.Sheets['Data'], 'Data')
        var file = XLSX.write(book, { bookType: 'xlsx', type: 'binary'})
        var sfe = window.saveAs
        const blob = new Blob([toArrBuffer(file)], { type: "application/octet-stream" });
        sfe(blob, 'data.xlsx')
    }
</script>
<?php 
    include("footer.php");
?>
