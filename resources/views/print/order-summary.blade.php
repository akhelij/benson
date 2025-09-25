<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Order Summary - {{ $order->code }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <style>
        body {
            font-size: 10px;
            font-family: Arial, sans-serif;
        }
        th {
            text-align: center;
        }
        hr {
            margin-top: -3%;
            margin-bottom: -3%;
        }
        td, th {
            padding: 3px !important;
        }
        .fad, .fac {
            display: none;
        }
        @media print {
            .table-striped > tbody > tr:nth-of-type(odd) {
                background-color: #f9f9f9 !important;
                -webkit-print-color-adjust: exact; 
            }        
        }
        .panel-body {
            padding: 0px !important;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table td, .table th {
            border: 1px solid #ddd;
            padding: 3px;
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f9f9f9;
        }
    </style>
</head>

<body>
    <div class="">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <table class="table table-striped table-bordered table-dataTable">
                            <tbody>
                                <tr style="background-color: #fff !important">
                                    <td colspan="8" rowspan="6">
                                        <h2>Benson Shoes</h2>
                                        <p>Mohamed Benamour</p>
                                        <p>22, rue le Catelet</p>
                                        <p>20300 Casablanca</p>
                                        <p>Tel. : +212(0)22246485
                                        <a class="pull-right">www.benson-shoes.com</a>
                                        </p>
                                        <p>Fax. : +212(0)22248667
                                        <a class="pull-right">mail@benson-shoes.com</a>
                                        </p>
                                    </td>
                                    <td colspan="4">Date</td> 
                                    <td colspan="4">{{ $order->created_at->format('Y-m-d') }}</td> 
                                    <td colspan="4">Code N°</td> 
                                    <td colspan="4">{{ str_replace("(n)", "&", $order->code) }}</td> 
                                </tr>
                                <tr style="background-color: #fff !important">
                                    <td colspan="8">FIRM</td>
                                    <td colspan="8">{{ $order->firm }}</td>
                                </tr>
                                <tr style="background-color: #fff !important">  
                                    <td colspan="4">Téléphone</td>
                                    <td colspan="4">{{ $order->telephone }}</td>
                                    <td colspan="4">Ville/NAT.</td>
                                    <td colspan="4">{{ $order->ville }}</td>
                                </tr>
                                <tr style="background-color: #fff !important">
                                    <td colspan="8">Livraison prévue le</td>
                                    <td colspan="8">{{ $order->livraison ? $order->livraison->format('Y-m-d') : '' }}</td>
                                </tr>
                                <tr style="background-color: #fff !important">  
                                    <td colspan="4">Transporteur</td>
                                    <td colspan="4">{{ $order->transporteur }}</td>
                                    <td colspan="4">Boites</td>
                                    <td colspan="4">{{ $order->boite }}</td>
                                </tr> 
                                <tr style="background-color: #fff !important">  
                                    <td colspan="3">Logo</td>
                                    <td colspan="4" align="center">
                                        @if($order->logo)
                                            <img src="{{ asset('storage/' . $order->logo) }}" style="max-width:100px;max-height: 50px">
                                        @endif
                                    </td>
                                    <td colspan="3" align="center"><b><i><u>Made in MOROCCO</u></i></b></td>
                                    <td colspan="3">Logo Semelle</td>
                                    <td colspan="4" align="center">
                                        @if($order->logo1)
                                            <img src="{{ asset('storage/' . $order->logo1) }}" style="max-width:100px;max-height: 50px">
                                        @endif
                                    </td>
                                </tr> 
                            </tbody>
                        </table>

                        <table class="table table-striped table-bordered">
                            <tbody>
                                <tr>
                                    <td colspan="11">Note : {{ $order->notes }}</td>
                                    <td colspan="14">Transport terms : {{ $order->transort }}</td>
                                </tr>
                                
                                @php
                                    $currentLanguage = null;
                                    $currentGenre = null;
                                    $cmp = 0;
                                @endphp
                                
                                @foreach ($order->orderLines as $ligne)
                                    @if($cmp == 0 || ($cmp != 0 && $currentLanguage != $ligne->langue) || ($cmp != 0 && $currentGenre != $ligne->genre))
                                        @php
                                            $currentLanguage = $ligne->langue;
                                            $currentGenre = $ligne->genre;
                                            $cmp++;
                                        @endphp
                                        
                                        <tr style="background-color: #fff !important">
                                            <th rowspan="2">Article</th>
                                            <th rowspan="2">Semelle</th>
                                            <th rowspan="2">Cuir dessus</th>
                                            <th rowspan="2" class="pointure"></th>
                                            <th rowspan="2">
                                                <span class="anglais" @if($currentLanguage == 'français') style="display:none" @endif>4,0</span>
                                                <hr>
                                                <span class="pointure français" @if($currentLanguage == 'anglais') style="display:none" @endif>
                                                    {{ $currentGenre == 'femme' ? 35 : 38 }}
                                                </span>
                                            </th>
                                            <th rowspan="2">
                                                <span class="anglais" @if($currentLanguage == 'français') style="display:none" @endif>4,5</span><hr>
                                                <span class="français" @if($currentLanguage == 'anglais') style="display:none" @endif>x</span>
                                            </th>
                                            <th rowspan="2">
                                                <span class="anglais" @if($currentLanguage == 'français') style="display:none" @endif>5,0</span><hr>
                                                <span class="pointure français" @if($currentLanguage == 'anglais') style="display:none" @endif>
                                                    {{ $currentGenre == 'femme' ? 36 : 39 }}
                                                </span>
                                            </th>
                                            <th rowspan="2">
                                                <span class="anglais" @if($currentLanguage == 'français') style="display:none" @endif>5,5</span><hr>
                                                <span class="français" @if($currentLanguage == 'anglais') style="display:none" @endif>x</span>
                                            </th>
                                            <th rowspan="2">
                                                <span class="anglais" @if($currentLanguage == 'français') style="display:none" @endif>6,0</span><hr>
                                                <span class="pointure français" @if($currentLanguage == 'anglais') style="display:none" @endif>
                                                    {{ $currentGenre == 'femme' ? 37 : 40 }}
                                                </span>
                                            </th>
                                            <th rowspan="2">
                                                <span class="anglais" @if($currentLanguage == 'français') style="display:none" @endif>6,5</span><hr>
                                                <span class="français" @if($currentLanguage == 'anglais') style="display:none" @endif>x</span>
                                            </th>
                                            <th rowspan="2">
                                                <span class="anglais" @if($currentLanguage == 'français') style="display:none" @endif>7,0</span><hr>
                                                <span class="pointure français" @if($currentLanguage == 'anglais') style="display:none" @endif>
                                                    {{ $currentGenre == 'femme' ? 38 : 41 }}
                                                </span>
                                            </th>
                                            <th rowspan="2">
                                                <span class="anglais" @if($currentLanguage == 'français') style="display:none" @endif>7,5</span><hr>
                                                <span class="français" @if($currentLanguage == 'anglais') style="display:none" @endif>x</span>
                                            </th>
                                            <th rowspan="2">
                                                <span class="anglais" @if($currentLanguage == 'français') style="display:none" @endif>8,0</span><hr>
                                                <span class="pointure français" @if($currentLanguage == 'anglais') style="display:none" @endif>
                                                    {{ $currentGenre == 'femme' ? 39 : 42 }}
                                                </span>
                                            </th>
                                            <th rowspan="2">
                                                <span class="anglais" @if($currentLanguage == 'français') style="display:none" @endif>8,5</span><hr>
                                                <span class="français" @if($currentLanguage == 'anglais') style="display:none" @endif>x</span>
                                            </th>
                                            <th rowspan="2">
                                                <span class="anglais" @if($currentLanguage == 'français') style="display:none" @endif>9,0</span><hr>
                                                <span class="pointure français" @if($currentLanguage == 'anglais') style="display:none" @endif>
                                                    {{ $currentGenre == 'femme' ? 40 : 43 }}
                                                </span>
                                            </th>
                                            <th rowspan="2">
                                                <span class="anglais" @if($currentLanguage == 'français') style="display:none" @endif>9,5</span><hr>
                                                <span class="français" @if($currentLanguage == 'anglais') style="display:none" @endif>x</span>
                                            </th>
                                            <th rowspan="2">
                                                <span class="anglais" @if($currentLanguage == 'français') style="display:none" @endif>10,0</span><hr>
                                                <span class="pointure français" @if($currentLanguage == 'anglais') style="display:none" @endif>
                                                    {{ $currentGenre == 'femme' ? 41 : 44 }}
                                                </span>
                                            </th>
                                            <th rowspan="2">
                                                <span class="anglais" @if($currentLanguage == 'français') style="display:none" @endif>10,5</span><hr>
                                                <span class="français" @if($currentLanguage == 'anglais') style="display:none" @endif>x</span>
                                            </th>
                                            <th rowspan="2">
                                                <span class="anglais" @if($currentLanguage == 'français') style="display:none" @endif>11,0</span><hr>
                                                <span class="pointure français" @if($currentLanguage == 'anglais') style="display:none" @endif>
                                                    {{ $currentGenre == 'femme' ? 42 : 45 }}
                                                </span>
                                            </th>
                                            <th rowspan="2">
                                                <span class="anglais" @if($currentLanguage == 'français') style="display:none" @endif>12,0</span><hr>
                                                <span class="pointure français" @if($currentLanguage == 'anglais') style="display:none" @endif>
                                                    {{ $currentGenre == 'femme' ? 43 : 46 }}
                                                </span>
                                            </th>
                                            <th rowspan="2">Total</th>
                                            <th colspan="4">Avancement</th>
                                        </tr>
                                        <tr>
                                            <th>CP</th>
                                            <th>PQ</th>
                                            <th>MO</th>
                                            <th>FI</th>
                                        </tr>
                                    @endif
                                    
                                    <tr>
                                        <td>{{ $ligne->forme }}/{{ $ligne->article }}</td>
                                        <td>{{ $ligne->semelle }} {{ $ligne->construction }}</td>
                                        <td>{{ $ligne->cuir }}</td>
                                        <td>{{ $ligne->vpointure ?? '' }}</td>
                                        <td>{{ $ligne->p5 == 0 ? '' : $ligne->p5 }}</td>
                                        <td>{{ $ligne->p5x == 0 ? '' : $ligne->p5x }}</td>
                                        <td>{{ $ligne->p6 == 0 ? '' : $ligne->p6 }}</td>
                                        <td>{{ $ligne->p6x == 0 ? '' : $ligne->p6x }}</td>
                                        <td>{{ $ligne->p7 == 0 ? '' : $ligne->p7 }}</td>
                                        <td>{{ $ligne->p7x == 0 ? '' : $ligne->p7x }}</td>
                                        <td>{{ $ligne->p8 == 0 ? '' : $ligne->p8 }}</td>
                                        <td>{{ $ligne->p8x == 0 ? '' : $ligne->p8x }}</td>
                                        <td>{{ $ligne->p9 == 0 ? '' : $ligne->p9 }}</td>
                                        <td>{{ $ligne->p9x == 0 ? '' : $ligne->p9x }}</td>
                                        <td>{{ $ligne->p10 == 0 ? '' : $ligne->p10 }}</td>
                                        <td>{{ $ligne->p10x == 0 ? '' : $ligne->p10x }}</td>
                                        <td>{{ $ligne->p11 == 0 ? '' : $ligne->p11 }}</td>
                                        <td>{{ $ligne->p11x == 0 ? '' : $ligne->p11x }}</td>
                                        <td>{{ $ligne->p12 == 0 ? '' : $ligne->p12 }}</td>
                                        <td>{{ $ligne->p13 == 0 ? '' : $ligne->p13 }}</td>
                                        <td>{{ $ligne->total_quantity }}</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>{{ $ligne->client }}</td>
                                        <td></td>
                                        <td>{{ $ligne->supplement }}</td>
                                        <td colspan="22"></td>
                                    </tr>
                                @endforeach
                                
                                <tr>
                                    <td colspan="18"></td>
                                    <td colspan="2">Total des paires :</td>
                                    <td colspan="5">{{ $totalPairs }}</td>
                                </tr>
                            </tbody>    
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Set the pointure header dynamically
        document.addEventListener('DOMContentLoaded', function() {
            var pointureElements = document.getElementsByClassName("pointure");
            if (pointureElements.length > 0 && {{ $order->orderLines->count() }} > 0) {
                pointureElements[0].innerHTML = "{{ $order->orderLines->first()->pointure ?? 'Pointure' }}";
            }
        });
    </script>
</body>
</html>
