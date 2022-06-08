@php($sigment_parent = Request::segment(1))
@php($sigment_sub = Request::segment(2))

 <section class="left-bar">
    {{-- <h2 class="left-header">Important Link</h2> --}}
    <div class="left-nav">
        <ul> 
            <li @if($sigment_parent == 'dashboard' && $sigment_sub=='') class="current" @endif><a href="{{route('customers.dashboard')}}">Dashboard</a></li>

            <li @if($sigment_parent == 'dashboard' && $sigment_sub=='bestellungen') class="current" @endif><a href="{{route('customers.bestellungen')}}">Bestellungen</a></li>
            <li @if($sigment_parent == 'dashboard' && $sigment_sub=='adressen') class="current" @endif><a href="{{route('customers.adressen')}}">Adressen</a></li>

            <li @if($sigment_parent == 'dashboard' && $sigment_sub=='konto-details') class="current" @endif><a href="{{route('customers.konto-details')}}">Konto-Details</a></li> 

            <li @if($sigment_parent == 'dashboard' && $sigment_sub=='kennwort-andern') class="current" @endif><a href="{{route('customers.kennwort-andern')}}">Kennwort ändern</a></li> 
            <li><a href="{{route('logout')}}">Abmelden</a></li>
        </ul>
    </div>
</section>