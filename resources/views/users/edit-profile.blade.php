@extends('layouts.app') 

{{-- Main content aection --}}
@section('content')
    <section class="info-bar">
      <div class="container">
        <div class="welocme">
          <h3>Buy Credits</h3> 
        </div>
      </div>
    </section>
     <section class="process-section">
          <div class="breadcumb-section">
            <div class="container">
              <ul>
                <li><a href="#">MY CREDITS</a></li>
                <li><a href="#">Buy Credits</a></li>
              </ul>
            </div>
          </div>
          <div class="container">
            <div class="notice notice--neutral"> <i class="fa fa-info-circle"></i> NOTE: There are now two types of credits for file services: master and slave. 
            </div>
            
            @if( $errors->has('package_id') )
              <div class="notice ntice--error"> <i class="fa fa-info-circle"></i>  You did not select a package </div>
            @endif

            <form class="BuycreditsForm" name="formBuycredits" method="POST" data-cart="#cart/" action="{{route('customers.buy-credits-process')}}">
              @csrf
              
              @if(!empty($package_category))
                @foreach($package_category as $category)
                  <div class="block-row">
                    <div class="block__header">{{$category->title??''}}</div>
                    <div class="block__content">
                      <p>{{$category->description??''}}</p>

                      @if(!empty($category->packages))  
                        <table class="datatable-grid">
                          <thead>
                            <th class="choose-package">Choose your package</th>
                            <th class="order-subtotal">Order subtotal</th>
                          </thead>
                          <tbody>
                             @foreach($category->packages as $key => $package)
                              <tr> 
                                <td><span class="credit-input"><input type="radio" name="package_id" value="{{$package->id??''}}" id="product_{{$package->id??''}}"></span><label for="product_{{$package->id??''}}">{{$package->number_of_credits??''}} {{$package->title??''}}</label></td>
                                <td>

                                  <span class="buyCredits__price">€ {{number($package->price??0)}}</span>

                                  @if($key==0)
                                    @php($fileCredit = floatval($package->number_of_credits??0))
                                  @endif
                                  
                                  @if($key > 0 && $package->number_of_credits > 0)
                                    @php($perfile = floatval(($package->price/$package->number_of_credits)*$fileCredit))
                                    <span><div class="btn btn-sm btn-brand">Per file: € {{number($perfile??0)}}</div></span>
                                  @endif

                                </td>
                              </tr> 
                             @endforeach 
                          </tbody>
                        </table>
                      @endif 
                    </div>
                  </div> 
                @endforeach
              @endif  

              <!-- <h3>Tuning Tools</h3>              
              <div class="block-row">
                <div class="block__header">TUNING TOOLS   </div>
                <div class="block__content"> 
                  <table class="datatable-grid">
                    <thead>
                      <tr>
                        <th colspan="2">Choose your package</th>
                        <th>Order subtotal</th>
                      </tr>
                    </thead>
                    <tbody> 
                       <tr>
                        <td width="30">
                          <input type="radio" name="product_id" value="27" id="highlighted-product-27">
                        </td>
                        <td><label for="highlighted-product-27">WinOLS software OLS501 full version</label></td>
                        <td>€ 981,00</td>
                      </tr> 
                    </tbody>                  
                  </table>
                  <table class="datatable-grid">
                    <thead>
                      <th>Order on Chiptuning</th> 
                    </thead>
                    <tbody>
                      <tr> 
                        <td><a href="#" target="_blank">Alientech Dealerpackage</a></td>
                      </tr>
                      <tr>
                        <td><a href="#" target="_blank">CMD Dealerpackage</a></td>
                      </tr>  
                    </tbody>                  
                  </table>
                </div>
              </div>  -->

          

            <div class="FormButtons">
              <div class="row">
                <div class="col-md-6"><p><i>Please note that your order subtotal does not include applicable taxes.These will be added in the next step.</i></p></div>
                <div class="col-md-6 text-right">
                  <button type="submit" class="btn btn--right" title="Next Step">Next Step &nbsp;&nbsp; <i class="fa fa-angle-right"> </i></button></div>
              </div>
            </div>

          </form>
 
          </div>            
      </section> 
    
@endsection
{{-- End main content section --}}

@push('scripts')
    <script></script>
@endpush


