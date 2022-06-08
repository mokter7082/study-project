 <section class="info-bar">
    <div class="container">
        <div class="welocme">
            <div class="row">
                <div class="col-md-5"> 
                    @if(isset($title))<h3> {{$title}} </h3> @endif
                    @if(isset($sub_title)) <p> {{$sub_title}}</p> @endif  
                </div>
                <div class="col-md-7 text-right">
                    <ul class="admin-topnav"> 
                        <li>
                            <a href="javascript:void(0);">hellow</a>
                            <ul>
                                <li><a> English </a></li>
                                <li><a> Deutsch </a></li>
                            </ul>
                        </li>
                         
                    </ul>
                </div>
            </div> 
        </div>
    </div>
</section>