<?php
include_once "../../../i18n.php";
require('../../../assets/lib/tcpdf/tcpdf.php');
require ('../../../engine/db_config.php');

$setlogo      = 'logo-vpp-ori.png';
$type = $_GET['type'];
$maincategoryid = $_GET['maincategory'];
$categoryid = $_GET['category'];
$datefrom = $_GET['datefrom'];
$dateto = $_GET['dateto'];

// echo $type;
// echo $maincategoryid;
// echo $datefrom;
// echo $dateto;

class MYPDF extends TCPDF
{
  public function Header()
  {
      // NOP! Overrides default header
    $this->Ln(5);
    $this->Image('logo-vpp-ori.png' ,35 ,5 , 25);
    $this->SetFont('Times', 'B', 17);
    $this->MultiCell(40, 8, '', 0, 'L', 0, 0, '', '', true);
    $this->MultiCell(130, 8, 'PT. JAGATMADU NUSANTARA LAND', 0, 'C', 0, 0, '', '', true);
    $this->MultiCell(20, 8, '', 0, 'R', 0, 1, '', '', true);

    $this->SetFont('Times', 'R', 11);
    $this->MultiCell(40, 5, '', 0, 'L', 0, 0, '', '', true);
    $this->MultiCell(130, 5, 'Kantor Pemasaran: Ruko Eboni No.12 Taman Royal - Poris Pelawad', 0, 'C', 0, 0, '', '', true);
    $this->MultiCell(20, 5, '', 0, 'R', 0, 1, '', '', true);

    $this->MultiCell(40, 5, '', 0, 'L', 0, 0, '', '', true);
    $this->MultiCell(130, 5, 'Telp. (021) 2923 8365 Fax. (021) 2943 3580 Tangerang 15141', 0, 'C', 0, 0, '', '', true);
    $this->MultiCell(20, 5, '', 0, 'R', 0, 1, '', '', true);

    $this->Ln(2); 
    $html ='<hr>';
    $this->writeHTML($html, true, false, true, false, '');
    $this->Ln(0); 


    // $this->Ln(); 
    $this->SetFont('Times', 'B', 14);
    $this->MultiCell(10, 5, '', 0, 'L', 0, 0, '', '', true);
    $this->MultiCell(170, 5, $this->SetTitleReport, 0, 'C', 0, 0, '', '', true);
    $this->MultiCell(10, 5, '', 0, 'R', 0, 1, '', '', true);
    $this->SetFont('Times', 'B', 12);
    $this->Ln();

    $this->MultiCell(40, 5, '', 0, 'L', 0, 0, '', '', true);
    $this->MultiCell(110, 5, $this->SetDatePeriod, 0, 'C', 0, 0, '', '', true);
    $this->MultiCell(40, 5, '', 0, 'R', 0, 1, '', '', true);

    $this->Ln();
  }
  public function Footer()
  {
    // Position at 15 mm from bottom
    $this->SetY(-20);
    // Set font
    $this->SetFont('helvetica', 'I', 7);
    $this->Cell(0, 10, 'Developer Management System '.date("Y").' PT. JAGATMADU NUSANTARA LAND', 0, false, 'C', 0, '', 0, false, 'T', 'M');
    $this->Ln(4);
    $this->SetFont('helvetica', 'I', 8);
    // Page number
    $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');

  }

  // Better table
  function ImprovedTableAccount($header, $data, $data1){
    // Column widths
    $w = array(10, 40, 60, 40);
    $tot = 0;

    // Header
    $this->SetFillColor(224, 224, 224);
    $this->SetFont('Times','B',11);

    for($i=0;$i<count($header);$i++)
    // Cell($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=0, $link='', $stretch=0, $ignore_min_height=false, $calign='T', $valign='M')
    $this->Cell($w[$i],8,$header[$i],1,0,'C', 1,'',0,false,'T','M');

    // Data
    $this->SetFont('Times','',11);
    $this->SetFillColor(239, 245, 245);
    $this->SetTextColor(0);
    $this->Ln();

    $fill = 0;
    $i = 0;
    $halaman = 0;
    foreach($data as $row){
      $cellcount = array();
      //write text first
      $startX = $this->GetX();
      $startY = $this->GetY();
      //draw cells and record maximum cellcount
      //cell height is 6 and width is 80

      // $pdf->MultiCell(10, 8, 'No.', 1, 'C', 1, 0, '', '', true, 0, false, true, 8, 'M');

      foreach ($row as $key => $column):
       // Mengatur text menjadi center
        $this->setCellPaddings(1, 1, 1, 1);
        if($key == 0){
          $cellcount[] = $this->MultiCell($w[$key], 8, ($column), 0, 'C', $fill, 0, '', '', true, 0, false, true, 0, "M");
        }else if($key == 3){
          $cellcount[] = $this->MultiCell($w[$key], 8, ($column), 0, 'R', $fill, 0, '', '', true, 0, false, true, 0, "M");
        }else{
          $cellcount[] = $this->MultiCell($w[$key], 8, ($column), 0, 'L', $fill, 0, '', '', true, 0, false, true, 0, "M");
        }
      endforeach;

      $this->SetXY($startX,$startY);

      //now do borders and fill
      //cell height is 6 times the max number of cells
  
      $maxnocells = max($cellcount);
  
      foreach ($row as $key => $column):
        $this->MultiCell($w[$key], $maxnocells * 8, '', 1, 'L', $fill, 0, '', '', true, 0, false, true, 0, "M");
      endforeach;

      $this->Ln();
      // fill equals not fill (flip/flop)
      $fill=!$fill;

      //Membuat auto page next
      $i += $maxnocells;

      if($halaman >= 1){
        if ($i > 32) {
          $this->AddPage('P', 'A4');
          $this->Line(286, 10, 10, 10);
          // $this->Line($xc, $yc-50, $xc, $yc+50);
          $halaman++;
          $i = 0;
        }
      }else{
        if ($i > 23) {
          $this->AddPage('P', 'A4');
          $this->Line(286, 10, 10, 10);
          $halaman++;
          $i = 0;
        }
      }
    }
    //Line Penutub Tabel Akhir
    $this->Cell(array_sum($w), 0, '', 'T');

    //Menghitung Total
    $tott = 0;
    foreach($data1 as $row)
    {
        $row[0];
        $tott += $row[0];
    }
    //End Menghitung Total
    
    $this->SetFont('Times','b', 11);
    $this->setCellPaddings(1, 1, 1, 0);
    $this->Ln(0);
    if ($tott == 0)  $this->Cell(188, 7, 'DATA TIDAK DITEMUKAN', 1, 1, 'C', 0, '', 0);
    $this->SetFillColor(199, 252, 186);
    $this->setCellPaddings(1, 1, 2, 0);
    if ($tott != 0)  $this->MultiCell(110, 7, 'Total', 1, 'R', 1, 0, '', '', true);
    $this->setCellPaddings(2, 1, 1, 0);
    if ($tott != 0)  $this->MultiCell(40, 7, number_format($tott, 0, "", ".") , 1, 'R', 1, 0, '', '', true);
    $this->Ln(5);

    //JIKA i > 20 MAKA ASIGN DI PRINT DI NEXT PAGE
    if($i > 22) $this->AddPage('P', 'A4');
  }

  function ImprovedTableMainCategory($header, $data, $data1){
    // Column widths
    $w = array(10, 40, 40);
    $tot = 0;

    // Header
    $this->SetFillColor(224, 224, 224);
    $this->SetFont('Times','B',12);

    for($i=0;$i<count($header);$i++)
    // Cell($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=0, $link='', $stretch=0, $ignore_min_height=false, $calign='T', $valign='M')
    $this->Cell($w[$i],8,$header[$i],1,0,'C', 1,'',0,false,'T','M');

    // Data
    $this->SetFont('Times','',12);
    $this->SetFillColor(239, 245, 245);
    $this->SetTextColor(0);
    $this->Ln();

    $fill = 0;
    $i = 0;
    $halaman = 0;
    foreach($data as $row){
      $cellcount = array();
      //write text first
      $startX = $this->GetX();
      $startY = $this->GetY();
      //draw cells and record maximum cellcount
      //cell height is 6 and width is 80

      // $pdf->MultiCell(10, 8, 'No.', 1, 'C', 1, 0, '', '', true, 0, false, true, 8, 'M');

      foreach ($row as $key => $column):
       // Mengatur text menjadi center
        $this->setCellPaddings(1, 1, 1, 1);
        if($key == 0){
          $cellcount[] = $this->MultiCell($w[$key], 8, ($column), 0, 'C', $fill, 0, '', '', true, 0, false, true, 0, "M");
        }else if($key == 2){
          $cellcount[] = $this->MultiCell($w[$key], 8, ($column), 0, 'R', $fill, 0, '', '', true, 0, false, true, 0, "M");
        }else{
          $cellcount[] = $this->MultiCell($w[$key], 8, ($column), 0, 'L', $fill, 0, '', '', true, 0, false, true, 0, "M");
        }
      endforeach;

      $this->SetXY($startX,$startY);

      //now do borders and fill
      //cell height is 6 times the max number of cells
  
      $maxnocells = max($cellcount);
  
      foreach ($row as $key => $column):
        $this->MultiCell($w[$key], $maxnocells * 8, '', 1, 'L', $fill, 0, '', '', true, 0, false, true, 0, "M");
      endforeach;

      $this->Ln();
      // fill equals not fill (flip/flop)
      $fill=!$fill;

      //Membuat auto page next
      $i += $maxnocells;

      if($halaman >= 1){
        if ($i > 32) {
          $this->AddPage('P', 'A4');
          $this->Line(286, 10, 10, 10);
          // $this->Line($xc, $yc-50, $xc, $yc+50);
          $halaman++;
          $i = 0;
        }
      }else{
        if ($i > 23) {
          $this->AddPage('P', 'A4');
          $this->Line(286, 10, 10, 10);
          $halaman++;
          $i = 0;
        }
      }
    }
    //Line Penutub Tabel Akhir
    $this->Cell(array_sum($w), 0, '', 'T');

    //Menghitung Total
    $tott = 0;
    foreach($data1 as $row)
    {
        $row[0];
        $tott += $row[0];
    }
    //End Menghitung Total
    
    $this->SetFont('Times','b', 11);
    $this->setCellPaddings(1, 1, 1, 0);
    $this->Ln(0);
    if ($tott == 0)  $this->Cell(188, 7, 'DATA TIDAK DITEMUKAN', 1, 1, 'C', 0, '', 0);
    $this->SetFillColor(199, 252, 186);
    $this->setCellPaddings(1, 1, 2, 0);
    if ($tott != 0)  $this->MultiCell(50, 7, 'Total', 1, 'R', 1, 0, '', '', true);
    $this->setCellPaddings(2, 1, 1, 0);
    if ($tott != 0)  $this->MultiCell(40, 7, number_format($tott, 0, "", ".") , 1, 'R', 1, 0, '', '', true);
    $this->Ln(5);

    //JIKA i > 20 MAKA ASIGN DI PRINT DI NEXT PAGE
    if($i > 22) $this->AddPage('P', 'A4');
    $this->AddPage('P', 'A4');
  }

  function ImprovedTableCategory($header, $data, $data1){
    // Column widths
    $w = array(10, 40, 90, 40);
    $tot = 0;

    // Header
    $this->SetFillColor(224, 224, 224);
    $this->SetFont('Times','B',12);

    for($i=0;$i<count($header);$i++)
    // Cell($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=0, $link='', $stretch=0, $ignore_min_height=false, $calign='T', $valign='M')
    $this->Cell($w[$i],8,$header[$i],1,0,'C', 1,'',0,false,'T','M');

    // Data
    $this->SetFont('Times','',12);
    $this->SetFillColor(239, 245, 245);
    $this->SetTextColor(0);
    $this->Ln();

    $fill = 0;
    $i = 0;
    $halaman = 0;
    foreach($data as $row){
      $cellcount = array();
      //write text first
      $startX = $this->GetX();
      $startY = $this->GetY();
      //draw cells and record maximum cellcount
      //cell height is 6 and width is 80

      // $pdf->MultiCell(10, 8, 'No.', 1, 'C', 1, 0, '', '', true, 0, false, true, 8, 'M');

      foreach ($row as $key => $column):
       // Mengatur text menjadi center
        $this->setCellPaddings(1, 1, 1, 1);
        if($key == 0){
          $cellcount[] = $this->MultiCell($w[$key], 8, ($column), 0, 'C', $fill, 0, '', '', true, 0, false, true, 0, "M");
        }else if($key == 3){
          $cellcount[] = $this->MultiCell($w[$key], 8, ($column), 0, 'R', $fill, 0, '', '', true, 0, false, true, 0, "M");
        }else{
          $cellcount[] = $this->MultiCell($w[$key], 8, ($column), 0, 'L', $fill, 0, '', '', true, 0, false, true, 0, "M");
        }
      endforeach;

      $this->SetXY($startX,$startY);

      //now do borders and fill
      //cell height is 6 times the max number of cells
  
      $maxnocells = max($cellcount);
  
      foreach ($row as $key => $column):
        $this->MultiCell($w[$key], $maxnocells * 8, '', 1, 'L', $fill, 0, '', '', true, 0, false, true, 0, "M");
      endforeach;

      $this->Ln();
      // fill equals not fill (flip/flop)
      $fill=!$fill;

      //Membuat auto page next
      $i += $maxnocells;

      if($halaman >= 1){
        if ($i > 32) {
          $this->AddPage('P', 'A4');
          $this->Line(100, 10, 10, 10);
          // $this->Line($xc, $yc-50, $xc, $yc+50);
          $halaman++;
          $i = 0;
        }
      }else{
        if ($i > 30) {
          $this->AddPage('P', 'A4');
          $this->Line(100, 10, 10, 10);
          $halaman++;
          $i = 0;
        }
      }
    }
    //Line Penutub Tabel Akhir
    $this->Cell(array_sum($w), 0, '', 'T');

    //Menghitung Total
    $tott = 0;
    foreach($data1 as $row)
    {
        $row[0];
        $tott += $row[0];
    }
    //End Menghitung Total
    
    $this->SetFont('Times','b', 11);
    $this->setCellPaddings(1, 1, 1, 0);
    $this->Ln(0);
    if ($tott == 0)  $this->Cell(188, 7, 'DATA TIDAK DITEMUKAN', 1, 1, 'C', 0, '', 0);
    $this->SetFillColor(199, 252, 186);
    $this->setCellPaddings(1, 1, 2, 0);
    if ($tott != 0)  $this->MultiCell(140, 7, 'Total', 1, 'R', 1, 0, '', '', true);
    $this->setCellPaddings(2, 1, 1, 0);
    if ($tott != 0)  $this->MultiCell(40, 7, number_format($tott, 0, "", ".") , 1, 'R', 1, 0, '', '', true);
    $this->Ln(5);

    //JIKA i > 20 MAKA ASIGN DI PRINT DI NEXT PAGE
    if($i > 30) $this->AddPage('P', 'A4');
  }

  function ImprovedTableProject($header, $data, $data1){
    // Column widths
    $w = array(10, 30, 60, 50, 40);
    $tot = 0;

    // Header
    $this->SetFillColor(224, 224, 224);
    $this->SetFont('Times','B',11);

    for($i=0;$i<count($header);$i++)
    // Cell($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=0, $link='', $stretch=0, $ignore_min_height=false, $calign='T', $valign='M')
    $this->Cell($w[$i],8,$header[$i],1,0,'C', 1,'',0,false,'T','M');

    // Data
    $this->SetFont('Times','',11);
    $this->SetFillColor(239, 245, 245);
    $this->SetTextColor(0);
    $this->Ln();

    $fill = 0;
    $i = 0;
    $halaman = 0;
    foreach($data as $row){
      $cellcount = array();
      //write text first
      $startX = $this->GetX();
      $startY = $this->GetY();
      //draw cells and record maximum cellcount
      //cell height is 6 and width is 80

      // $pdf->MultiCell(10, 8, 'No.', 1, 'C', 1, 0, '', '', true, 0, false, true, 8, 'M');

      foreach ($row as $key => $column):
       // Mengatur text menjadi center
        $this->setCellPaddings(1, 1, 1, 1);
        if($key == 0){
          $cellcount[] = $this->MultiCell($w[$key], 8, ($column), 0, 'C', $fill, 0, '', '', true, 0, false, true, 0, "M");
        }else if($key == 4){
          $cellcount[] = $this->MultiCell($w[$key], 8, ($column), 0, 'R', $fill, 0, '', '', true, 0, false, true, 0, "M");
        }else{
          $cellcount[] = $this->MultiCell($w[$key], 8, ($column), 0, 'L', $fill, 0, '', '', true, 0, false, true, 0, "M");
        }
      endforeach;

      $this->SetXY($startX,$startY);

      //now do borders and fill
      //cell height is 6 times the max number of cells
  
      $maxnocells = max($cellcount);
  
      foreach ($row as $key => $column):
        $this->MultiCell($w[$key], $maxnocells * 8, '', 1, 'L', $fill, 0, '', '', true, 0, false, true, 0, "M");
      endforeach;

      $this->Ln();
      // fill equals not fill (flip/flop)
      $fill=!$fill;

      //Membuat auto page next
      $i += $maxnocells;

      if($halaman >= 1){
        if ($i > 28) {
          $this->AddPage('P', 'A4');
          $this->Line(286, 10, 10, 10);
          // $this->Line($xc, $yc-50, $xc, $yc+50);
          $halaman++;
          $i = 0;
        }
      }else{
        if ($i > 28) {
          $this->AddPage('P', 'A4');
          $this->Line(286, 10, 10, 10);
          $halaman++;
          $i = 0;
        }
      }
    }
    //Line Penutub Tabel Akhir
    $this->Cell(array_sum($w), 0, '', 'T');

    //Menghitung Total
    $tott = 0;
    foreach($data1 as $row)
    {
        $row[0];
        $tott += $row[0];
    }
    //End Menghitung Total
    
    $this->SetFont('Times','b', 11);
    $this->setCellPaddings(1, 1, 1, 0);
    $this->Ln(0);
    if ($tott == 0)  $this->Cell(190, 7, 'DATA TIDAK DITEMUKAN', 1, 1, 'C', 0, '', 0);
    $this->SetFillColor(199, 252, 186);
    $this->setCellPaddings(1, 1, 2, 0);
    if ($tott != 0)  $this->MultiCell(150, 7, 'Total', 1, 'R', 1, 0, '', '', true);
    $this->setCellPaddings(2, 1, 1, 0);
    if ($tott != 0)  $this->MultiCell(40, 7, number_format($tott, 0, "", ".") , 1, 'R', 1, 0, '', '', true);
    $this->Ln(5);

    //JIKA i > 20 MAKA ASIGN DI PRINT DI NEXT PAGE
    if($i > 28) $this->AddPage('P', 'A4');
  }

  function ImprovedTableDetail($header, $data, $data1){
    // Column widths
    $w = array(18, 30, 40, 70, 30);
    $tot = 0;

    // Header
    $this->SetFillColor(224, 224, 224);
    $this->SetFont('Times','B',10);

    for($i=0;$i<count($header);$i++)
    // Cell($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=0, $link='', $stretch=0, $ignore_min_height=false, $calign='T', $valign='M')
    $this->Cell($w[$i],8,$header[$i],1,0,'C', 1,'',0,false,'T','M');

    // Data
    $this->SetFont('Times','',11);
    $this->SetFillColor(239, 245, 245);
    $this->SetTextColor(0);
    $this->Ln();

    $fill = 0;
    $i = 0;
    $halaman = 0;
    foreach($data as $row){
      $cellcount = array();
      //write text first
      $startX = $this->GetX();
      $startY = $this->GetY();
      //draw cells and record maximum cellcount
      //cell height is 6 and width is 80

      // $pdf->MultiCell(10, 8, 'No.', 1, 'C', 1, 0, '', '', true, 0, false, true, 8, 'M');

      foreach ($row as $key => $column):
       // Mengatur text menjadi center
        $this->setCellPaddings(1, 1, 1, 1);
        if($key == 0){
          $cellcount[] = $this->MultiCell($w[$key], 8, ($column), 0, 'C', $fill, 0, '', '', true, 0, false, true, 0, "M");
        }else if($key == 4){
          $cellcount[] = $this->MultiCell($w[$key], 8, ($column), 0, 'R', $fill, 0, '', '', true, 0, false, true, 0, "M");
        }else{
          $cellcount[] = $this->MultiCell($w[$key], 8, ($column), 0, 'L', $fill, 0, '', '', true, 0, false, true, 0, "M");
        }
      endforeach;

      $this->SetXY($startX,$startY);

      //now do borders and fill
      //cell height is 6 times the max number of cells
  
      $maxnocells = max($cellcount);
  
      foreach ($row as $key => $column):
        $this->MultiCell($w[$key], $maxnocells * 8, '', 1, 'L', $fill, 0, '', '', true, 0, false, true, 0, "M");
      endforeach;

      $this->Ln();
      // fill equals not fill (flip/flop)
      $fill=!$fill;

      //Membuat auto page next
      $i += $maxnocells;

      if($halaman >= 1){
        if ($i > 24) {
          $this->AddPage('P', 'A4');
          
          // $this->Line(286, 10, 10, 10);
          $this->Ln(40);
          // $this->Line($xc, $yc-50, $xc, $yc+50);
          $halaman++;
          $i = 0;
        }
      }else{
        if ($i > 24) {
          $this->AddPage('P', 'A4');
          $this->Ln(40);
          // $this->Line(286, 10, 10, 10);
          $halaman++;
          $i = 0;
        }
      }
    }
    //Line Penutub Tabel Akhir
    $this->Cell(array_sum($w), 0, '', 'T');

    //Menghitung Total
    $tott = 0;
    foreach($data1 as $row)
    {
        $row[0];
        $tott += $row[0];
    }
    //End Menghitung Total
    
    $this->SetFont('Times','b', 11);
    $this->setCellPaddings(1, 1, 1, 0);
    $this->Ln(0);
    if ($tott == 0)  $this->Cell(188, 7, 'DATA TIDAK DITEMUKAN', 1, 1, 'C', 0, '', 0);
    $this->SetFillColor(199, 252, 186);
    $this->setCellPaddings(1, 1, 2, 0);
    if ($tott != 0)  $this->MultiCell(158, 7, 'Total', 1, 'R', 1, 0, '', '', true);
    $this->setCellPaddings(2, 1, 1, 0);
    if ($tott != 0)  $this->MultiCell(30, 7, number_format($tott, 0, "", ".") , 1, 'R', 1, 0, '', '', true);
    $this->Ln(5);

    //JIKA i > 20 MAKA ASIGN DI PRINT DI NEXT PAGE
    if($i > 24) $this->AddPage('P', 'A4');
  }
}


// $pdf = new PDF();
$pdf = new MYPDF('p','mm','A4');

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Dekki Timur Sanyoto');
$pdf->SetTitle($arrLang[$defaultLanguage]['expense_report'].' PT. JAGATMADU NUSANTARA LAND');
$pdf->SetSubject($arrLang[$defaultLanguage]['expense_report'].' PT. JAGATMADU NUSANTARA LAND');
$pdf->SetKeywords($arrLang[$defaultLanguage]['expense_report'].' PT. JAGATMADU NUSANTARA LAND');

//Filter Maincategory ID and Value
if($maincategoryid =='0'){
  $maincategoryvalue = $arrLang[$defaultLanguage]['all'];
}else{
  if($type=='GROUP'){
    $sql_maincategory_data = "SELECT * FROM maincategory WHERE MAINCATEGORYID = $maincategoryid"; 
    $result_sql_maincategory_data = $mysqli->query($sql_maincategory_data);
    $row_maincategory_dt = mysqli_fetch_row($result_sql_maincategory_data);
    $maincategoryvalue = $row_maincategory_dt[1];
  }else if($type=='DETAIL'){
    $sql_maincategory_data = "SELECT * FROM maincategory WHERE MAINCATEGORYID = $maincategoryid"; 
    $result_sql_maincategory_data = $mysqli->query($sql_maincategory_data);
    $row_maincategory_dt = mysqli_fetch_row($result_sql_maincategory_data);
    $maincategoryvalue = $row_maincategory_dt[1];
    if($categoryid =='0'){
      $categoryvalue = $arrLang[$defaultLanguage]['all'];
    }else{
      $sql_category_data = "SELECT * FROM category WHERE CATEGORYID = $categoryid"; 
      $result_sql_category_data = $mysqli->query($sql_category_data);
      $row_category_dt = mysqli_fetch_row($result_sql_category_data);
      $categoryvalue = $row_category_dt[2];
    }
  }else if($type=='PROJECT'){
    $sql_maincategory_data = "SELECT * FROM project WHERE PROJECTID = $maincategoryid"; 
    $result_sql_maincategory_data = $mysqli->query($sql_maincategory_data);
    $row_maincategory_dt = mysqli_fetch_row($result_sql_maincategory_data);
    $maincategoryvalue = $row_maincategory_dt[1];
  }else{  
    $sql_maincategory_data = "SELECT * FROM account WHERE ACCOUNTID = $maincategoryid"; 
    $result_sql_maincategory_data = $mysqli->query($sql_maincategory_data);
    $row_maincategory_dt = mysqli_fetch_row($result_sql_maincategory_data);
    $maincategoryvalue = $row_maincategory_dt[1];
  }
}

if($type=='GROUP'){
  $pdf->SetTitleReport = $arrLang[$defaultLanguage]['expense_report'].' '.$arrLang[$defaultLanguage]['group_by'].' '.$arrLang[$defaultLanguage]['master_main_category'].' '.$maincategoryvalue;
}else if($type=='DETAIL'){
  if($maincategoryid =='0'){
    $pdf->SetTitleReport = $arrLang[$defaultLanguage]['expense_report'].' '.$arrLang[$defaultLanguage]['detail'].' '.$arrLang[$defaultLanguage]['group_by'].' '.$arrLang[$defaultLanguage]['master_main_category'].': '.$maincategoryvalue;
  }else{
    $pdf->SetTitleReport = $arrLang[$defaultLanguage]['expense_report'].' '.$arrLang[$defaultLanguage]['detail'].' '.$arrLang[$defaultLanguage]['group_by'].' '.$arrLang[$defaultLanguage]['master_main_category'].': '.$maincategoryvalue.' '.$arrLang[$defaultLanguage]['and'].' '.$arrLang[$defaultLanguage]['master_category'].': '.$categoryvalue;
  }
  
}else if($type=='PROJECT'){
  $pdf->SetTitleReport = $arrLang[$defaultLanguage]['expense_report'].' '.$arrLang[$defaultLanguage]['group_by'].' '.$arrLang[$defaultLanguage]['master_project'].' '.$maincategoryvalue;
}else{
  $pdf->SetTitleReport = $arrLang[$defaultLanguage]['expense_report'].' '.$arrLang[$defaultLanguage]['group_by'].' '.$arrLang[$defaultLanguage]['master_account'].' '.$maincategoryvalue;
}

if($datefrom=="" & $dateto==""){
  $pdf->SetDatePeriod = $arrLang[$defaultLanguage]['period'].': '.$arrLang[$defaultLanguage]['all'];
}else{
  $pdf->SetDatePeriod = $arrLang[$defaultLanguage]['period'].': '.tanggal_indo($datefrom).' - '.tanggal_indo($dateto);
}


$pdf->AddPage();

// $pdf->Ln(-3); 

// $pdf->SetFont('Times', '', 7);
// $pdf->MultiCell(25, 5, 'TIPE LAPORAN', 0, 'L', 0, 0, '', '', true);
// $pdf->MultiCell(150, 5, ': GROUP', 0, 'L', 0, 0, '', '', true);
// $pdf->Ln(); 
// $pdf->MultiCell(25, 5, 'KATEGORI UTAMA', 0, 'L', 0, 0, '', '', true);



//Reformat Margin
// $pdf->MultiCell(20, 5, '', 1, 'L', 0, 0, '', '', true);
// $pdf->MultiCell(150, 5, '', 1, 'C', 0, 0, '', '', true);
// $pdf->MultiCell(20, 5, '', 1, 'R', 0, 1, '', '', true);

//Filter Date Between
$valdatebetween ="";
if($datefrom =="" || $datefrom =="null"){
  $valdatebetween ="";
}else{
  $valdatebetween ="AND (DATE BETWEEN \"".$datefrom."\" AND \"".$dateto."\")";
}

if($type=="GROUP"){

  //Filter Pengaturan MainCategory
  $valmaincategoryid="";
  if($maincategoryid=="" || $maincategoryid=="0" || $maincategoryid=="null"){
    $valmaincategoryid = "";
  }else{
    $valmaincategoryid = "AND MAINCATEGORYID = \"".$maincategoryid."\"";
  }

  //START GET DATA MAIN CATEGORY
  $sql_maincategory = "SELECT SUM(AMOUNT) as AMT, MAINCATEGORYNAME, MAINCATEGORYID
  FROM transaction
  WHERE GROUPS= 'Cost' $valmaincategoryid  $valdatebetween 
  GROUP BY MAINCATEGORYID";
  $result_maincategory = $mysqli->query($sql_maincategory);
  $json_maincategory = [];
  $json_total_maincategory = [];
  $no_maincategory = 1;
  while($row = $result_maincategory->fetch_assoc()){
    $json_maincategory[] = [$no_maincategory, $row["MAINCATEGORYNAME"], number_format($row["AMT"], 0, "", ".")];
    $json_total_maincategory[] = [$row["AMT"]];
    $no_maincategory++;
  }
  $data_maincategory = $json_maincategory;
  $data_total_maincategory = $json_total_maincategory;
  //END GET DATA MAIN CATEGORY
  //Group By Main Category
  $pdf->Ln(40); 
  $pdf->SetFont('Times', '', 11);
  // $pdf->MultiCell(100, 6, 'GROUP BY MAIN CATEGORY', 0, 'L', 0, 1, '', '', true);
  $headermaincategory = array( 'No.', $arrLang[$defaultLanguage]['main_category_name'], $arrLang[$defaultLanguage]['value']);
  $pdf->ImprovedTableMainCategory($headermaincategory, $data_maincategory, $data_total_maincategory);


  //START GET DATA CATEGORY
  $sql_category = "SELECT SUM(AMOUNT) as AMT, MAINCATEGORYNAME, CATEGORYNAME
  FROM transaction
  WHERE GROUPS= 'Cost' $valmaincategoryid  $valdatebetween 
  GROUP BY CATEGORYNAME
  ORDER BY MAINCATEGORYNAME ASC";
  $result_category = $mysqli->query($sql_category);
  $json_category = [];
  $json_total_category = [];
  $no_category = 1;
  while($row = $result_category->fetch_assoc()){
    $json_category[] = [$no_category, $row["MAINCATEGORYNAME"], $row["CATEGORYNAME"], number_format($row["AMT"], 0, "", ".")];
    $json_total_category[] = [$row["AMT"]];
    $no_category++;
  }
  $data_category = $json_category;
  $data_total_category = $json_total_category;
  //END GET DATA CATEGORY
  //Group By Category
  $pdf->Ln(40); 
  $pdf->SetFont('Times', '', 11);
  // $pdf->MultiCell(100, 6, 'GROUP BY CATEGORY', 0, 'L', 0, 1, '', '', true);
  $headercategory = array( 'No.', $arrLang[$defaultLanguage]['main_category_name'], $arrLang[$defaultLanguage]['category_name'], $arrLang[$defaultLanguage]['value']);
  $pdf->ImprovedTableCategory($headercategory, $data_category, $data_total_category);

}else if($type=="DETAIL"){

  //Filter Pengaturan MainCategory
  $valmaincategoryid  ="";
  if($maincategoryid=="" || $maincategoryid=="0" || $maincategoryid=="null"){
    $valmaincategoryid = "";
  }else{
    $valmaincategoryid = "AND MAINCATEGORYID = \"".$maincategoryid."\"";
  }

  //Filter Pengaturan Category
  $valcategoryid  ="";
  if($categoryid=="" || $categoryid=="0" || $categoryid=="null"){
    $valcategoryid = "";
  }else{
    $valcategoryid = "AND CATEGORYID = \"".$categoryid."\"";
  }

  //START GET DATA DETAIL
  $sql_detail = "SELECT TRANSACTIONID, MAINCATEGORYNAME, CATEGORYNAME, TRANSACTIONTITLE, AMOUNT
  FROM transaction 
  WHERE GROUPS = 'Cost' $valmaincategoryid $valcategoryid $valdatebetween 
  ORDER BY TRANSACTIONID ASC";
  $result_detail = $mysqli->query($sql_detail);
  $json_detail = [];
  $json_total_detail = [];
  $no_detail = 1;
  while($row = $result_detail->fetch_assoc()){
    $json_detail[] = [$row["TRANSACTIONID"], $row["MAINCATEGORYNAME"], $row["CATEGORYNAME"], $row["TRANSACTIONTITLE"], number_format($row["AMOUNT"], 0, "", ".")];
    $json_total_detail[] = [$row["AMOUNT"]];
    $no_detail++;
  }
  $data_detail = $json_detail;
  $data_total_detail = $json_total_detail;
  //END GET DATA DETAIL
  //Group By Main Category
  $pdf->Ln(40); 
  $pdf->SetFont('Times', '', 11);
  // $pdf->MultiCell(100, 6, 'GROUP BY DETAIL', 0, 'L', 0, 1, '', '', true);
  $headeraccount = array( 'No.', $arrLang[$defaultLanguage]['main_category_name'], $arrLang[$defaultLanguage]['category_name'], $arrLang[$defaultLanguage]['transaction_title'], $arrLang[$defaultLanguage]['value']);
  $pdf->ImprovedTableDetail($headeraccount, $data_detail, $data_total_detail);

}else if($type=="PROJECT"){

  //Filter Pengaturan MainCategory
  $valmaincategoryid  ="";
  if($maincategoryid=="" || $maincategoryid=="0" || $maincategoryid=="null"){
    $valmaincategoryid = "";
  }else{
    $valmaincategoryid = "AND PROJECTID = \"".$maincategoryid."\"";
  }

  //START GET DATA PROJECT
  $sql_project = "SELECT MAINCATEGORYNAME, CATEGORYNAME, PROJECTID, PROJECTNAME, SUM(AMOUNT) AS AMT
  FROM transaction
  WHERE GROUPS= 'Cost' $valmaincategoryid  $valdatebetween 
  GROUP BY CATEGORYNAME
  ORDER BY MAINCATEGORYNAME ASC";
  $result_project = $mysqli->query($sql_project);
  $json_project = [];
  $json_total_project = [];
  $no_project = 1;
  while($row = $result_project->fetch_assoc()){
    $json_project[] = [$no_project, $row["MAINCATEGORYNAME"], $row["CATEGORYNAME"], $row["PROJECTNAME"], number_format($row["AMT"], 0, "", ".")];
    $json_total_project[] = [$row["AMT"]];
    $no_project++;
  }
  $data_project = $json_project;
  $data_total_project = $json_total_project;
  //END GET DATA PROJECT
  //Group By Bank Account
  $pdf->Ln(40); 
  $pdf->SetFont('Times', '', 11);
  // $pdf->MultiCell(100, 6, 'GROUP BY PROYEK', 0, 'L', 0, 1, '', '', true);
  $headerproyek = array( 'No.', 'Main Kategori', 'Kategori', 'Proyek', 'Nilai');
  $pdf->ImprovedTableProject($headerproyek, $data_project, $data_total_project);
}else if($type=="ACCOUNT"){

  //Filter Pengaturan MainCategory
  $valmaincategoryid  ="";
  if($maincategoryid=="" || $maincategoryid=="0" || $maincategoryid=="null"){
    $valmaincategoryid = "";
  }else{
    $valmaincategoryid = "AND ACCOUNTID = \"".$maincategoryid."\"";
  }

  //START GET DATA BANK ACCOUNT
  $sql_accountbank = "SELECT SUM(AMOUNT) as AMT, ACCOUNTBANKNO, ACCOUNTNAME 
  FROM transaction 
  WHERE GROUPS = 'Cost' $valmaincategoryid  $valdatebetween 
  GROUP BY ACCOUNTNAME";
  $result_accountbank = $mysqli->query($sql_accountbank);
  $json_accountbank = [];
  $json_total_accountbank = [];
  $no_accountbank = 1;
  while($row = $result_accountbank->fetch_assoc()){
    $json_accountbank[] = [$no_accountbank, $row["ACCOUNTBANKNO"], $row["ACCOUNTNAME"], number_format($row["AMT"], 0, "", ".")];
    $json_total_accountbank[] = [$row["AMT"]];
    $no_accountbank++;
  }
  $data_accountbank = $json_accountbank;
  $data_total_accountbank = $json_total_accountbank;
  //END GET DATA BANK ACCOUNT
  //Group By Bank Account
  $pdf->Ln(40); 
  $pdf->SetFont('Times', '', 11);
  // $pdf->MultiCell(100, 6, 'GROUP BY AKUN BANK', 0, 'L', 0, 1, '', '', true);
  $headeraccount = array( 'No.', 'No. Akun Bank', 'Nama Bank', 'Nilai');
  $pdf->ImprovedTableAccount($headeraccount, $data_accountbank, $data_total_accountbank);
}

$pdf->Output();

function tanggal_indo($tanggal){
  $bulan = array (1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
      );
  $split = explode('-', $tanggal);
  return $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
}

?>





