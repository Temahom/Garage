@extends('layout.index')
@php
setlocale(LC_TIME, "fr_FR", "French");
$date = new DateTime('now', new DateTimeZone('UTC'));

@endphp
@section('content')
<style>
    #cercle .card {
        width: 200px;
        height: 200px;
        border: 2px solid #1891ea;
        border-radius: 50% !important;
        justify-content: center;
      
    }
    .clw{
        color: white !important;
    }
    #block-1 .card{
        background-color: #cc00cc !important;
        color: white !important;
    
    }
    #block-2 .card{
        background-color: #e0103d !important;
        color: white !important;
    
    }
     .history{
        background-color: #1891ea;
        justify-content: center;
        text-align: center;
        border-radius: 15px;
        width: auto;
        height:45px;

       
    }
    .history h4{
        color: white;
        text-align: center;
        padding: 10px;
    }
    
    
</style>
<div class="row">
    
    <div class="col-xl-3 col-md-6  col-lg-4 col-sm-12 " id="cercle">
        <div class="card">
            <div class="card-body">
                    <h1 class="text-center mt-3  ">{{Date('d')}}</h1>
                    <h5 class="text-center" style="text-transform: capitalize;">{{strftime("%A %d %B %Y", strtotime( $date->format('d/m/Y h:i:s A')))}}</h5>
                </div> 
               
          
           
        </div>
    </div>
    <div class="col-xl-3 col-md-6 col-lg-4 col-sm-12 col-12" id="block-1">
        <div class="card">
            <div class="card-body " >
                <div class="metric-value d-inline-block">
                    <p>
                    <span class="clw" style="font-weight: bold; font-size:40px;">120</span>
                    <span class="clw" style="font-weight: bold;margin-left: 10px;">Total Lorem,</span>
                </p>
            </div>
                
    
            </div>
          <p style="margin:10px">Lorem ipsum dolor  iste exercitationem aperiam 
              consequuntur aspernatur distinctio similique recusandae. Non quasi saepe dolore ullam perferendis
               nulla ab consequatur nobis?</p>
        </div>
    </div>
    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 col-12" id="block-2">
        <div class="card">
            <div class="card-body " >
                <div class="metric-value d-inline-block">
                    <p>
                    <span class="clw" style="font-weight: bold; font-size:40px;">120</span>
                    <span class="clw" style="font-weight: bold;margin-left: 10px;">Total Lorem, </span>
                </p>
            </div>
                
    
            </div>
            <p style="margin:10px">Lorem ipsum dolor  iste exercitationem aperiam 
                consequuntur aspernatur distinctio similique recusandae. Non quasi saepe dolore ullam perferendis
                 nulla ab consequatur nobis?</p>
        </div>
    </div>
    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 col-12" id="block-2">
        <div class="card">
            <div class="card-body " >
                <div class="metric-value d-inline-block">
                    <p>
                    <span class="clw" style="font-weight: bold; font-size:40px;">120</span>
                    <span class="clw" style="font-weight: bold;margin-left: 10px;">Total Lorem, </span>
                </p>
            </div>
                
    
            </div>
            <p style="margin:10px">Lorem ipsum dolor  iste exercitationem aperiam 
                consequuntur aspernatur distinctio similique recusandae. Non quasi saepe dolore ullam perferendis
                 nulla ab consequatur nobis?</p>
        </div>
    </div>
</div>
<div class="row">
    <span class="history">
        <h4 >Lorem ipsum dolor</h4>
    </span>

    
</div>
<div class="row mt-3">
    <div class="accordion" id="accordionExample">
        <div class="card">
          <div class="card-header" id="headingOne">
            <h2 class="mb-0">
              <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                &RightAngleBracket;     Lorem ipsum dolor 
              </button>
            </h2>
        </div>
          <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
            <div class="card-body">
                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nostrum necessitatibus nemo assumenda vel quasi officia quas doloremque possimus suscipit ab cum itaque laudantium totam, reprehenderit neque error. Facere, corporis error?
            </div>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header" id="headingTwo">
          <h2 class="mb-0">
            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                Lorem ipsum dolor 
            </button>
          </h2>
        </div>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
          <div class="card-body">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor repudiandae aperiam in blanditiis odio iusto odit voluptates ratione! Eos pariatur aspernatur ad aliquid iusto quam assumenda ipsum repudiandae numquam sunt.
        </div>
        </div>
      </div>
</div>
@endsection
        
     