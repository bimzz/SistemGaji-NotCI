<?php
	include 'includes/session.php';
	
	$range = $_POST['date_range'];
	$ex = explode(' - ', $range);
	$from = date('Y-m-d', strtotime($ex[0]));
	$to = date('Y-m-d', strtotime($ex[1]));

	$from_title = date('d M Y', strtotime($ex[0]));
	$to_title = date('d M Y', strtotime($ex[1]));

	require_once('../tcpdf/tcpdf.php');  
    $pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
    $pdf->SetCreator(PDF_CREATOR);  
    $pdf->SetTitle('Payslip: '.$from_title.' - '.$to_title);  
    $pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
    $pdf->SetDefaultMonospacedFont('helvetica');  
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
    $pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);  
    $pdf->setPrintHeader(false);  
    $pdf->setPrintFooter(false);  
    $pdf->SetAutoPageBreak(TRUE, 10);  
    $pdf->SetFont('helvetica', '', 11);  
    $pdf->AddPage(); 
    $contents = '';

	$sql = "SELECT *, SUM(jam_kerja) AS total_jam_kerja, COUNT(jam_kerja) AS hari_kerja, absen.id_pegawai AS empid FROM absen LEFT JOIN pegawai ON pegawai.id=absen.id_pegawai LEFT JOIN jabatan ON jabatan.id=pegawai.id_jabatan WHERE tanggal BETWEEN '$from' AND '$to' GROUP BY absen.id_pegawai";

        $query = $conn->query($sql);
                    $total = 0;
                    $totalg = 0;
                    while($row = $query->fetch_assoc()){
                      $empid = $row['empid'];
                      
                      $casql = "SELECT *, SUM(jumlah) AS jumlah_hutang FROM hutang WHERE id_pegawai='$empid' AND tanggal_hutang BETWEEN '$from' AND '$to'";
                      
                      $caquery = $conn->query($casql);
                      $carow = $caquery->fetch_assoc();
                      $hutang = $carow['jumlah_hutang'];

                      $hutangsql = "SELECT *, SUM(jam) AS jam_lembur FROM lembur WHERE id_pegawai='$empid' AND tanggal_lembur BETWEEN '$from' AND '$to'";

                      $hutangquery = $conn->query($hutangsql);
                      $hutangrow = $hutangquery->fetch_assoc();
                      $jam_lembur = $hutangrow['jam_lembur'];
                      $rate = $hutangrow['rate'];

                      $lembur = $jam_lembur * $rate;
                      $gajiperjam = $row['gaji'] / 173;
                      $hari_kerja = $row['hari_kerja'];
                      $gajikotor = $hari_kerja * $row['total_jam_kerja'] * $gajiperjam;
                      $total = $gajikotor - $hutang;
                      $totalg += $total;

		$contents .= '
			<h2 align="center">Slip Gaji</h2>
			<h4 align="center">'.$from_title." - ".$to_title.'</h4>
			<table cellspacing="0" cellpadding="3">  
    	       	<tr>  
            		<td width="25%" align="right">Nama Pegawai: </td>
                 	<td width="25%"><b>'.$row['nama'].'</b></td>
				 	<td width="25%" align="right">Gaji per Jam: </td>
                 	<td width="25%" align="right">Rp '.number_format($gajiperjam, 2,',','.').'</td>
    	    	</tr>
    	    	<tr>
    	    		<td width="25%" align="right">ID Pegawai: </td>
				 	<td width="25%">'.$row['id_pegawai'].'</td>   
				 	<td width="25%" align="right">Total Jam Kerja: </td>
				 	<td width="25%" align="right">'.$row['total_jam_kerja'].'</td> 
    	    	</tr>
    	    	<tr> 
    	    		<td></td> 
    	    		<td></td>
				 	<td width="25%" align="right"><b>Gaji Kotor: </b></td>
				 	<td width="25%" align="right"><b>Rp '.number_format($gajikotor, 2,',','.').'</b></td> 
    	    	</tr>
    	    	<tr> 
    	    		<td></td> 
    	    		<td></td>
				 	<td width="25%" align="right">Hutang: </td>
				 	<td width="25%" align="right">Rp '.number_format($hutang, 2,',','.').'</td> 
    	    	</tr>
    	    	<tr> 
    	    		<td></td> 
    	    		<td></td>
				 	<td width="25%" align="right"><b>Total Gaji:</b></td>
				 	<td width="25%" align="right"><b>Rp '.number_format($total, 2,',','.').'</b></td> 
    	    	</tr>
    	    </table>
    	    <br><hr>
		';
	}
    $pdf->writeHTML($contents);  
    $pdf->Output('payslip.pdf', 'I');

?>