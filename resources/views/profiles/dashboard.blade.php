@extends('layouts.app') 

{{-- Main content aection --}}
@section('content') 
<section class="dashboard-section">
    <div class="container">
         <div class="row">
             <div class="col-sm-3">
                @include('includes.frontend.leftbar')
             </div>
             <div class="col-sm-9">
                <div class="page-title">Dashbaord</div> 

                <div class="page-content">
                    <p>Hallo {{ Auth::user()->name }}  (nicht admin? <a href="{{ route('logout') }}"> Abmelden</a>)</p>
                    <p>In deiner Konto-Übersicht kannst du deine <a href="{{route('customers.bestellungen')}}">letzten Bestellungen </a> ansehen, deine <a href="{{route('customers.adressen')}}">Liefer- und Rechnungsadresse</a> verwalten und dein <a  href="{{route('customers.konto-details')}}">Passwort und die Kontodetails bearbeiten.</a></p>
                </div>
             </div>
         </div> 
    </div>        
</section>
@endsection
 
 

