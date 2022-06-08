
  <tr id="myTr"> 
       <td>{{ $eqv_data['id'] }}</td> 
       <td tabindex="2">
        <input type="text" class="tableInput title" id="title_{{ $eqv_data['id'] }}" value="{{ $eqv_data['title'] }}" readonly >
        <input type="hidden" class="start_date" value="{{ $eqv_data['start_date'] }}">
        <input type="hidden" class="end_date" value="{{ $eqv_data['end_date'] }}">
        <input type="hidden" class="location" value="{{ $eqv_data['location'] }}">
      </td>
       <td tabindex="2">
         <input type="number" class="tableInput" id="stander_price" value="{{ $eqv_data['stander_price'] }}" readonly >
       </td>
       <td tabindex="2">
          <div class="d-flex">
            <button class="btn" type="button" id="decrement">-</button>
            <input class="current_value"   type="number" min="1" value="{{ $eqv_data['working_days'] }}" readonly  data-daily_price="{{ $eqv_data['price_per_day'] }}"/>
            <button class="btn" type="button"  id="increment">+</button>
          </div>
       </td>
       <td tabindex="2">
         <input type="number" class="total_price tableInput" value="{{ $eqv_data['price_per_day']??"" }}" readonly >
       </td>
       <td tabindex="2">
          <input type="number" class="fooding_cost tableInput" value="{{ $eqv_data['operator_fooding_cost'] }}" readonly >
       </td>
       <td tabindex="2">
         
         <input type="text" class="insallation_cost tableInput" value="{{ $eqv_data['insallation_cost'] }}" readonly >
        </td>
       <td><label class="m--font-bold m--font-primary">{{ $eqv_data['status']??''}}</label></td>
        <td nowrap="" align="center">
            @if((auth()->user()->can('quotations-delete') || auth()->user()->can('page-edit')))
            <span class="dropdown">
                <a href="#" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="true"> <i class="la la-ellipsis-h"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                  <a class="dropdown-item delItem edit" id=""><i class="la la-edit"></i> Edite </a>
                  <a class="dropdown-item delItem" href="#"><i class="la la-trash"></i>Delete</a>
                </div>
            </span>
            @endif
        </td>
</tr> 
<script>
       $('#decrement').click(function(e){
        var obj = $(this).closest('tr');
        var curentItem = obj.find('.current_value');
        var workingDays = curentItem.val(); 
        var pardayValue = curentItem.data('daily_price'); 

        if(workingDays > 1){
            var wdays = parseInt(workingDays - 1); 
            var totalPrice =  parseInt(wdays * pardayValue); 
            curentItem.val(wdays)
            obj.find('.total_price').val(totalPrice);
        }
 
 
    });
       $('#increment').click(function(e){
        var obj = $(this).closest('tr');
        var curentItem = obj.find('.current_value');
        var workingDays = parseInt(curentItem.val()); 
        var pardayValue = curentItem.data('daily_price'); 

       
            var wdays = parseInt(workingDays + 1); 
            var totalPrice =  parseInt(wdays * pardayValue); 
            curentItem.val(wdays)
            obj.find('.total_price').val(totalPrice); 
    });

    $('.edit').click(function(e){
      var obj = $(this).closest('tr');
    var eqv_name = obj.find('.title').val();
    var location = obj.find('.location').val();
    var start_date = obj.find('.start_date').val();
    var end_date = obj.find('.end_date').val();
    

    ///set value
    $('#end_date').val(end_date);
    $('#start_date').val(start_date);
    $('#location').val(location);
    // $('#storeData').data('obj', obj);
    $('#storeData').hide();
    $('#update').removeClass( "d-none" );
    });


    $('').click(function(e){
       
        // var location = ("#title"+id).val();
        // var start_date = $("#start_date").val();
        // var end_date = $("#end_date").val(); 
       

        // var eqv_name = obj.find('.title').val();
        // console.log(eqv_name);
    
         
    });

</script>
