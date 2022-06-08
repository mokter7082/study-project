<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Invoice</title>
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
				<h1>Deine Kursanmeldung ist eingegangen</h1>

				<p style="margin:0 0 16px">Hallo {{ $order_info->anrede?? '' }} {{ $order_info->first_name??'' }}</p>

				<p style="margin:0 0 16px">Es freut uns, dass Du Dich für einen Tanzkurs bei Dancezone entschieden hast. Wir haben Dich für den untenstehenden Kurs eingeschrieben.</p>

				<p style="margin:0 0 16px"> Sobald der Kurs genügend Anmeldungen hat, bestätigen wir Dir per <strong>E-Mail oder WhatsApp</strong>  die definitive Kursdurchführung. Anderenfalls würden wir Dich kontaktieren, um mit Dir eine andere Lösung zu finden.</p>

				<p style="margin:0 0 16px">Im Anhang findest Du unsere <strong>Rechnung (PDF)</strong> zum Tanzkurs. Es gelten die <a href="{{url('agb')}}" style="font-weight:normal;text-decoration:underline;color:#9d0038" target="_blank">AGB</a> von Dancezone.</p>

				<p style="margin:0 0 16px">Bitte zahle den Kursbeitrag vorab per Banküberweisung auf das unten angegebene Bankkonto.</p>

				<h2 style="display:block;margin:0 0 18px;font-size:20px;line-height:30px;padding-top:10px;padding-bottom:10px;margin-top:0px;margin-bottom:10px; font-weight:600;text-transform:none;color:#444444;text-align:left">Unsere Bankverbindung</h2>

				<h3 style="display:block; margin:0px 0 8px; text-align:left; font-size:18px;line-height:26px; font-weight:500;color:#444444">Franziska Greuter / Dancezone:</h3>

				<ul>
					<li>Bank: <strong>Zürcher Kantonalbank, 8010 Zürich</strong> </li>
					<li>IBAN: <strong>CH71 0070 0110 0054 7478 9</strong> </li>
					<li>BIC: <strong>ZKBKCHZZ80A</strong></li>
				</ul>

				<div style="margin-bottom:40px">
					<table cellspacing="0" cellpadding="6" width="100%" border="1" style="color:#5c5c5c; border:1px solid #e5e5e5; border-color:#eeeeee;background-color:#f6f6f6;border-width:1px;border-style:solid;width:100%">
						<thead>
							<tr style="background-color:#f6f6f6">
								<th scope="col" style="color:#5c5c5c;border:1px solid #e5e5e5;padding:12px; border-color:#eeeeee;border-width:1px;border-style:solid;padding-top:14px;padding-bottom:14px;padding-left:20px;padding-right:20px;text-align:left">Produkt</th>
								<th scope="col" style="color:#5c5c5c;border:1px solid #e5e5e5;padding:12px; border-color:#eeeeee;border-width:1px;border-style:solid;padding-top:14px;padding-bottom:14px;padding-left:20px;padding-right:20px;text-align:left">Preis</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td style="color:#5c5c5c;border:1px solid #e5e5e5;padding:12px; border-color:#eeeeee;min-width:60px;border-width:1px;border-style:solid;padding-top:14px;padding-bottom:14px;padding-left:20px;padding-right:20px;text-align:left;vertical-align:middle;word-wrap:break-word">
									<p style="margin:0 0 16px;margin-bottom:0"><strong>{{$order_info->course->title??''}} - {{ ucfirst($order_info->ticket_type)??''}}</strong></p>
									<p style="margin:0 0 16px;margin-bottom:0">Quantity: 1</p>
								</td>
								<td style="color:#5c5c5c;border:1px solid #e5e5e5;padding:12px; border-color:#eeeeee;min-width:60px;border-width:1px;border-style:solid;padding-top:14px;padding-bottom:14px;padding-left:20px;padding-right:20px;text-align:left;vertical-align:middle">
									<span>{{$order_info->price??''}}&nbsp;<span>CHF</span></span>
								</td>
							</tr>
							<tr style="background-color:#f6f6f6">
								<th scope="row" colspan="1" style="color:#5c5c5c;border:1px solid #e5e5e5;padding:12px; border-color:#eeeeee;border-width:1px;border-style:solid;padding-top:14px;padding-bottom:14px;padding-left:20px;padding-right:20px;text-align:left">Zwischensumme:</th>
								<td style="color:#5c5c5c;border:1px solid #e5e5e5;padding:12px; border-color:#eeeeee;min-width:60px;border-width:1px;border-style:solid;padding-top:14px;padding-bottom:14px;padding-left:20px;padding-right:20px;text-align:left"><span>{{number_format($order_info->price,2)??''}}&nbsp;<span>CHF</span></span></td>
							</tr>

							<tr>
								<th scope="row" colspan="1" style="color:#5c5c5c;border:1px solid #e5e5e5;padding:12px;padding-bottom:14px;padding-left:20px;padding-right:20px;text-align:left">Zahlungsmethode:</th>
								<td style="color:#5c5c5c;border:1px solid #e5e5e5;padding:12px;border-color:#eeeeee;min-width:60px;border-width:1px;border-style:solid;padding-top:14px;padding-bottom:14px;padding-left:20px;padding-right:20px;text-align:left">{{ ucfirst($order_info->payment_method)??''}}</td>
							</tr>

							<tr style="background-color:#f6f6f6">
								<th scope="row" colspan="1" style="color:#5c5c5c;border:1px solid #e5e5e5;padding:12px;border-color:#eeeeee;border-width:1px;border-style:solid;padding-top:14px;padding-bottom:14px;padding-left:20px;padding-right:20px;text-align:left">Gesamt:</th>
								<td style="color:#5c5c5c;border:1px solid #e5e5e5;padding:12px;border-color:#eeeeee;min-width:60px;border-width:1px;border-style:solid;padding-top:14px;padding-bottom:14px;padding-left:20px;padding-right:20px;text-align:left"><span>{{ number_format($order_info->total_pay, 2)}} &nbsp;<span>CHF</span></span></td>
							</tr>
						</tbody>
					</table>
				</div>
				<h2 style="display:block;margin:0 0 18px;font-size:20px;line-height:30px;padding-top:10px;padding-bottom:10px;margin-top:0px;margin-bottom:10px; font-weight:600;text-transform:none;color:#444444;text-align:left">Rechnungsadresse</h2>

				<table style="width: 100%">
					<tr>
						<td valign="top" style="border:1px solid #e5e5e5;background-color:#f6f6f6;padding:20px;border-width:2px;border-color:#eeeeee;border-style:solid;color:#444444;text-align:left;min-width:60px; font-size: 14px; line-height: 1.6">
							{{ $order_info->anrede?? '' }} {{ $order_info->first_name??'' }} {{ $order_info->last_name??'' }} <br> 
							{{ $order_info->address??'' }}<br>
								{{ $order_info->city??'' }} <br> 
								{{ $order_info->postcode??'' }} 

							<br><a href="tel:{{ $order_info->phone??''}}" style="font-weight:normal;text-decoration:underline;color:#9d0038" target="_blank">{{ $order_info->phone??''}}</a>
							<p style="margin:0"><a href="mailto:{{ $order_info->email??''}}" target="_blank">{{ $order_info->email??''}}</a></p>
						</td>
					</tr>
				</table>
				
				<p style="margin:30px 0 16px">Wir danken Dir für Deine Anmeldung und freuen uns, Dich bei uns unterrichten zu dürfen. Wenn Du Fragen zur Anmeldung oder zum Kurs hast, kontaktiere uns bitte unter den untenstehenden Kontaktdaten.</p>
				<p style="margin:0 0 16px">Viele Grüsse</p>
				<p style="margin:0 0 16px"><img src="http://m4yours.com/dancezone/images/teacher.png" style="border:none;display:inline;font-weight:bold;height:auto;outline:none;text-decoration:none;text-transform:capitalize;font-size:15px;line-height:22px;width:140px;max-width:140px" class="CToWUd"><br>
					Franziska Greuter<br>
				dipl. Tanzlehrerin</p>

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