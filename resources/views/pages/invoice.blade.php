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
							<p>{{ $order_info->anrede?? '' }} {{ $order_info->first_name??'' }} {{ $order_info->last_name??'' }} <br> {{ $order_info->address??'' }}<br>
								{{ $order_info->city??'' }} <br> {{ $order_info->postcode??'' }}</p>
						</td>
						<td colspan="2" valign="top">
							<p>Rechnungs-Nr.: {{ $order_info->invoice_number??'' }}<br>
							 Rechnungsdatum: @if(!empty($order_info->order_date)) {{ date('d.m.Y', strtotime($order_info->order_date))  }} @endif<br>
							 Bestell-Nr.: {{ $order_info->order_code??''}}  <br> Bestelldatum: @if(!empty($order_info->order_date)) {{ date('d.m.Y', strtotime($order_info->order_date))  }} @endif <br>
							Zahlungsmethode: {{ ucfirst($order_info->payment_method??'')}}</p>
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
							<td style="border-bottom: 1px solid #ddd; padding: 5px 10px">{{$order_info->course->title??''}} - {{ ucfirst($order_info->ticket_type??'')}}</td>
							<td style="border-bottom: 1px solid #ddd; padding: 5px 10px">1</td>
							<td style="border-bottom: 1px solid #ddd; padding: 5px 10px">{{$order_info->price??''}} CHF</td>
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
							<td  style="border-bottom: 1px solid #ddd; padding: 5px 10px">{{number_format($order_info->price??0,2)}} CHF</td>
						</tr>
						@if(isset($order_info->discount) && $order_info->discount > 0)
						<tr>
							<td style="border: none;"></td>
							<td  style="border-bottom: 1px solid #ddd; padding: 5px 10px"> <strong>Rabatt</strong></td>
							<td  style="border-bottom: 1px solid #ddd; padding: 5px 10px">{{number_format($order_info->discount??0,2)}} CHF</td>
						</tr>
						@endif
						<tr>
							<td style="border: none;"></td>
							<td  style="border-bottom: 1px solid #ddd; padding: 5px 10px"><strong>Gesamt</strong></td>
							<td  style="border-bottom: 1px solid #ddd; padding: 5px 10px"><strong>{{ number_format($order_info->total_pay??0, 2)}} CHF</strong></td>
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