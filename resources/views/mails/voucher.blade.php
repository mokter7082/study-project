<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Verschenke Tanzspass</title>
	<style>
		body{
			background: #f2f2f2;
			text-align: center;
			padding: 30px;
		}
		.main-table{
			width:100%;
			max-width: 700px;
			background: #fff;
			margin: 0 auto;
			border-collapse: collapse;
		}
		.top-header{
			background:#9d0038;
			text-align: center;
			padding: 30px;
		}
		.content-area{
			padding: 30px;
			background: #fff;
			text-align: left;
			font-size: 13px;
			font-family:Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;
			font-style:normal;
		}
		h1{
			font-size: 24px;
			margin-bottom: 20px;
		}
		ul>li{
			font-size: 13px;
			line-height: 1.7
		}
		table.msg{
			border-collapse: collapse;
			width: 100%;
		}
		table.msg td{
			color:#5c5c5c;
		    border: 1px solid #e5e5e5;
		    background: #fff;
		    padding:8px 12px;
		    border-color: #fff; 
		    border-style: solid;
		    text-align: left; 
		    border: 1px solid #e5e5e5;
		}
		table.msg td.withbg{  
    		background: #eeeeee;
		}
	</style>
</head>
<body>
	<table class="main-table">
		<tr>
			<td class="top-header">
				<img width="130" src="http://m4yours.com/dancezone/images/logo.png" alt="">
			</td>
		</tr>
		<tr>
			<td class="content-area">
				<h1>Verschenke Tanzspass bei Dancezone</h1>
 
				<table class="msg">
					<tr>
						<td class="withbg" width="200px"> <strong>Vorname</strong></td>
						<td> <strong>{{$vorname??""}}</strong></td>
					</tr>
					<tr>
						<td class="withbg"> <strong>Nachname</strong></td>
						<td> <strong>{{$nachname??""}}</strong></td>
					</tr>
					<tr>
						<td class="withbg"> <strong>E-Mail-Adresse</strong></td>
						<td> <strong>{{$email??""}}</strong></td>
					</tr>
					<tr>
						<td class="withbg"> <strong>Telefon</strong></td>
						<td> <strong>{{$telefon??''}}</strong></td>
					</tr>
					<tr>
						<td class="withbg"> <strong>Strasse, Nr.</strong></td>
						<td> <strong>{{$strasse??''}}</strong></td>
					</tr>
					<tr>
						<td class="withbg"> <strong>PLZ</strong></td>
						<td> <strong>{{$plz??''}}</strong></td>
					</tr>
					<tr>
						<td class="withbg"> <strong>Ort</strong></td>
						<td> <strong>{{$ort??''}}</strong></td>
					</tr>
					<tr>
						<td class="withbg"> <strong>Gutscheinbetrag in CHF</strong></td>
						<td> <strong>{{$gutscheinbetrag??''}}</strong></td>
					</tr>
					<tr>
						<td class="withbg"> <strong>Deine Nachricht</strong></td>
						<td> <strong>{{$nachricht}}</strong></td>
					</tr> 
				</table> 
			 
				<div style="line-height:1.5;border-top:2px solid #eeeeee;padding-top:30px">
					<strong>Dancezone</strong><br> Tanzschule &amp; Salsaschule<br>
					Seemattstrasse 2 – 8180 Bülach
					<p style="color:#444444">Telefon &amp; WhatsApp: <a href="tel:0041792430303" style="font-weight:normal;text-decoration:underline;color:#9d0038" target="_blank">079 243 03 03</a><br>
						Web: <a href="https://dancezone.ch" style="font-weight:normal;text-decoration:underline;color:#9d0038" target="_blank">www.dancezone.ch</a><br>
						E-Mail: <a href="mailto:info@dancezone.ch" style="font-weight:normal;text-decoration:underline;color:#9d0038" target="_blank">info@dancezone.ch</a>
					</p>
					<p style="color:#444444">Folge uns auch auf <a href="https://www.facebook.com/dancezone.tanzschule/" style="font-weight:normal;text-decoration:underline;color:#9d0038" target="_blank">Facebook</a>!</p>
					<div style="font-size:12px">
						<a href="https://dancezone.ch/agb/" style="font-weight:normal;text-decoration:underline;color:#9d0038" target="_blank">AGB</a> 
						– <a href="https://dancezone.ch/datenschutz/" style="font-weight:normal;text-decoration:underline;color:#9d0038" target="_blank">Datenschutz</a> 
						– <a href="https://dancezone.ch/impressum/" style="font-weight:normal;text-decoration:underline;color:#9d0038" target="_blank">Impressum</a>
					</div>
				</div> 
			</td>
		</tr>
	</table>
</body>
</html>