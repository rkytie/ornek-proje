@extends('front.app')

@section('title', 'Om Oss ')

@section('content')
    <div class="container-fluid pt-5 pb-5" style="background-color:#98c9ff">
        <div class="row ">
            <div class="col-lg-12 text-center">
                <h4 class="h2" style="font-weight: bold; color:#064890">Om Oss</h4>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12  pt-5 pb-5">
<p>
            Företaget, som är etableringen av familjen Fönstersida, som sysslar med handel med skogsprodukter som går tillbaka 100 år, har gjort investeringar för att öka kapacitet, kvalitet och variation i produktionen. <br><br>

Idag, i sitt produktionssortiment, fönstersystem, trämöbler, dörrar, laminerade balkar, paneler, golv, trappplattformar, trädgårdssatser, kamelia, pergolor, sommar- och vinterträdgårdar, använder vårt företag material som lämpar sig för hälsotillstånd i varje steg av produktionen . <br><br>

Vårt företag, vars huvudsakliga syfte är att utveckla produktionsmetoder som inte skadar människors hälsa genom att skydda våra underjordiska och ytliga resurser, har som mål att växa och skapa nya sysselsättningsområden genom att följa den utvecklande teknologin och att bidra till landets ekonomi. <br><br>
</p>
            </div>
            <div class="col-lg-6 pt-5 pb-5">
                <img class="img-fluid rounded" src="{{ asset('images/au.png')}} "
                    alt="Fönstersida Omm Oss">
            </div>
            
            
        </div>
    </div>

@endsection
