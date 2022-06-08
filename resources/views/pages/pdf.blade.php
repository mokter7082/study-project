<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Invoice</title>
	<style>
		body{ 
			text-align: center;
			padding:0;
			margin: 0;
			font-size: 11px;
		}
		 
		.content-area{
			padding: 10px 40px;
			background: #fff;
			text-align: left;
			font-size: 11px;
			font-family:Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;
			font-style:normal;
		} 
		table{
			width: 100%; 
		}
		table td, p{
			font-size: 11px;
			line-height: 1.6;
			margin-top: 0;
		}
		h2{
			font-size: 16px;
			margin: 20px 0 0;
		}
		h4{
			font-size: 12px
		}
		strong{
			font-weight: bold;
			font-weight: 900;
			color: #000;
		}
		h5{
			font-weight: 900;
			font-size: 11px
		}
	</style>
</head>
<body>
	<table class="main-table" style="width: 650px;
			background: #fff;
			margin: 0 auto;
			border-collapse: collapse;
			text-align: left;">
		<tr>
			<td class="content-area">
				<table style="width: 650px">
					<tr>
						<td style="width: 350px">
							<table>
								<tr>
									<td><img src="{{asset('images/dancezone-logo.jpg')}}" alt=""></td>
								</tr>
							</table>
						</td>
						<td colspan="2" valign="top" style="width: 300px">
							<h4>Dancezone – Tanzschule & Salsaschule</h4>
							<p>Seemattstrasse 2 <br>8180 Bülach</p>
							<p>Tel. 079 243 03 03 <br> E-Mail: info@dancezone.ch</p>
						</td> 
					</tr>
					<tr>
						<td colspan="3">
							<h2>RECHNUNG</h2> 
						</td> 
					</tr>
					<tr>
						<td>
							<p>Dutch Bangla Limited <br> 230, North South Road, Bangshal <br>
								Dhaka <br> 1200</p>
						</td>
						<td colspan="2" valign="top">
							<p>Rechnungs-Nr.: 15 <br> Rechnungsdatum: 28.08.2020 <br>
								Bestell-Nr.: 1308 <br> Bestelldatum: 28.08.2020 <br>Zahlungsmethode: Banküberweisung</p>
						</td> 
					</tr> 
				</table>
			</td>
		</tr>
		<tr>
			<td class="content-area"  style="height: 300px; vertical-align: top;">
				<table style="width: 650px; border-collapse: collapse;">
					<thead style="background: #222; color: #fff;">
						<tr>
							<th style="width: 350px; padding: 5px 10px; background: #222; color: #fff;">Tanzkurs</th>
							<th style="padding: 5px 10px; background: #222; color: #fff;">Anzahl</th>
							<th style="padding: 5px 10px; background: #222; color: #fff;">Preis</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td style="border-bottom: 1px solid #ddd; padding: 5px 10px">Salsa 1 Anfänger - Paar</td>
							<td style="border-bottom: 1px solid #ddd; padding: 5px 10px">1</td>
							<td style="border-bottom: 1px solid #ddd; padding: 5px 10px">376.00 CHF</td>
						</tr>
					</tbody>
					<tfoot>
						<tr>
							<td style="border: none;"></td>
							<td colspan="2" style="border-bottom: 1px solid #ddd; padding: 5px 10px">&nbsp;</td>
						</tr>
						<tr>
							<td style="border: none;"></td>
							<td  style="border-bottom: 1px solid #ddd; padding: 5px 10px"> <strong>Zwischensumme</strong></td>
							<td  style="border-bottom: 1px solid #ddd; padding: 5px 10px">376.00 CHF</td>
						</tr>
						<tr>
							<td style="border: none;"></td>
							<td  style="border-bottom: 1px solid #ddd; padding: 5px 10px"><strong>Gesamt</strong></td>
							<td  style="border-bottom: 1px solid #ddd; padding: 5px 10px"><strong>376.00 CHF</strong></td>
						</tr>
					</tfoot>
				</table>
			</td>
		</tr> 
		<tr>
			<td class="content-area" colspan="3">
				<h5>Bankdaten:</h5>
				<p><strong>Kontoinhaber: </strong> Franziska Greuter / Dancezone <br>
					<strong>Bank:</strong> Zürcher Kantonalbank, 8010 Zürich<br>
					<strong>IBAN Nr.:</strong> CH71 0070 0110 0054 7478 9<br>
					<strong>BIC/SWIFT:</strong> ZKBKCHZZ80A<br>
					<strong>PC-Konto:</strong> 80-151-4 
				</p>
				<p>Es gelten die AGB von Dancezone</p>
			</td>
		</tr>
	</table>
</body>
</html>