<!DOCTYPE html>
<html>
	<head>
		<title>NAMETAG</title>
		<style type="text/css">
			@page { 
				margin: 0cm 4.3cm 2cm 1cm; 
			}
			#cutting{
				padding:10px;
				margin: 0.5cm 0.5cm 0.5cm 0.5cm;
				border:1.5px dashed #000000;
			}
			
			#outtable{
        		padding:0px;
				margin: 0.2cm 0.2cm 0.2cm 0.2cm;
				border:5px solid #000000;
			}
			#watermark { 
				position: fixed;
				top: 6.35cm; 
				margin-top: .5cm;
				left: 6.25%;
				/* right: 17px; */
				width: 500px; 
				height: 450px; 
				opacity: .1; 
				text-align: center;
			}
			body {
				margin-bottom: 1cm;
				padding:0px;
			}
				
			table.tabel1{
				width : 100%;
				font-family:  "Times New Roman", Times, serif;
				text-align: center;
				color:#000000;
				margin-left:6px;
				
			}
			table.tabel1 td{
				font-size: 18px;
				font-style:normal; 
				font-weight:bold
			}
			
			table.tabel2{
				width : 100%;
				font-family:  "Times New Roman", Times, serif;
				color:#000000;
			}
			table.tabel2 td{
				font-size: 17px;
				font-weight: bold;
			}
			table.tabel2 td.td1{
				font-size: 17px;
				font-weight: bold;
			}
			
			table.tabel3{
				width : 100%;
				font-family:  "Times New Roman", Times, serif;
				font-size: 16px;
				text-align: left;
				margin-bottom: 1.3cm;
				color:#000000;
				text-transform: uppercase;
			}
			table.tabel3 td {
				text-transform: uppercase;
				font-size: 16px;
				vertical-align: middle;
				font-weight: bold;
			}
			table.tabel3 td.td1 {
				text-transform: uppercase;
				font-size: 16px;
				font-weight: bold;
				height: 30px;
				vertical-align: middle;
			}
			table.tabel3 td.td2 {
				text-transform: uppercase;
				font-size: 16px;
				height: 30px;
				font-weight: bold;
				text-align: left;
				vertical-align: middle;
			}
		</style>
	</head>
	<body>
	<br>
	<br>
	<div id="cutting">
		<div id="outtable">
			<div id="watermark"><img src="img/logo-sd-2020-black.png" height="90%" width="90%"></div>		
			<table class="tabel1">
				<tr>
					<td rowspan="4"><img src="img/UNUD.png" alt="" height=80 width=80></td>
					<td style='width: 326px; font-size: 10px;'>&nbsp;</td>
					<td rowspan="4"><img src="img/TEKNIK_1.png" alt="" height=80 width=80></td>
				</tr>
				<tr>
					<td style='font-size: 24px; padding: 0px 0px 0px 0px;'>STUDENT DAY 2020</td>
				</tr>
				<tr>
					<td style='font-size: 18px; padding: 8px 0px 0px 0px;'>FAKULTAS TEKNIK</td>   
				</tr>
				<tr>
					<td style='font-size: 18px; padding: 10px 0px 0px 0px;'>UNIVERSITAS UDAYANA</td>
				</tr>
				
				<tr>
					<td colspan="3" style='width: 100%; font-size: 3px; '>&nbsp;</td>
				</tr>
				<tr>
					<td colspan="3" style='width: 100%; font-size: 2px; border-top: 4px solid #000000; border-bottom: 2px solid #000000;' >&nbsp;</td>
				</tr>
				<tr>
					<td colspan="3", style='width: 100%; font-size: 1px; '>&nbsp;</td>
				</tr>
			</table>
			<table class="tabel3">
				<tr>
					<td colspan="4", style=' font-weight: bold; text-align: center; font-size: 17px; padding-right: 15px;padding-top:15px;'>BIODATA</td>
				</tr>
				<tr> 
					<td style='font-size: 8px; width: 10px;'>&nbsp;</td>
					<td rowspan="1" style='height: 2px; width: 170px;'>&nbsp;</td>
					<td style='font-size: 8px;width: 5px;'>&nbsp;</td>
					<td rowspan="1" style='height: 2px; width: 300px;'>&nbsp;</td>
					{{-- <td style='font-size: 8px; width: 10px;'>&nbsp;</td> --}}
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td class="td2" >&nbsp;NAMA LENGKAP</td>
					<td> : </td>
					<td style="padding-right:10px;">{{ $data->nama }}</td>
					{{-- <td>&nbsp;</td> --}}
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td class="td2">&nbsp;NAMA PANGGILAN</td>
					<td>:</td>
					<td style="padding-right:10px;">{{ $data->nama_panggilan }}</td>
					{{-- <td>&nbsp;</td> --}}
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td class="td2" >&nbsp;NIM</td>
					<td>:</td>
					<td style="padding-right:10px;">{{ $data->nim }}</td>
					{{-- <td>&nbsp;</td>     --}}
				</tr> 
				<tr>
					<td>&nbsp;</td>
					<td class="td2">&nbsp;TEMPAT/TGL LAHIR</td>
					<td>:</td>
					<td style="padding-right:10px;">{{ $data->tempat_lahir }}, {{ date('d F Y', strtotime($data->tanggal_lahir)) }}</td>
					{{-- <td>&nbsp;</td> --}}
				</tr>
				<tr>
				<td>&nbsp;</td>
					<td class="td2">&nbsp;ALAMAT</td>
					<td>:</td>
					<td style="padding-right:10px;">{{ $data->alamat_sekarang }}</td>
					{{-- <td>&nbsp;</td> --}}
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td class="td2">&nbsp;PRODI</td>
					<td>:</td>
					<td style='padding-right:5px; text-transform: uppercase;'>{{ $data->prodi }}</td>
					{{-- <td>&nbsp;</td> --}}
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td class="td2">&nbsp;HOBI</td>
					<td>:</td>
					<td style="padding-right:10px;">{{ $data->hobi }}</td>
					{{-- <td>&nbsp;</td> --}}
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td class="td2">&nbsp;CITA-CITA</td>
					<td>:</td>
					<td style="padding-right:10px;">{{ $data->cita_cita }}</td>
					{{-- <td>&nbsp;</td> --}}
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td class="td2">&nbsp;MOTTO</td>
					<td>:</td>
					<td style="padding-right:10px;">{{ $data->moto }}</td>
					{{-- <td>&nbsp;</td> --}}
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td style='height: 200px; width: 44%; text-align: left; padding-left: 5px;'><img src="img/foto3x4.jpg" alt="" height=168 width=128></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					{{-- <td>&nbsp;</td> --}}
				</tr>
			</table>
			</div>
		</div>
	</body>
</html>
