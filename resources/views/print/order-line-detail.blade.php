<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Order Line Detail - {{ $order->code }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <style>
        body {
            font-size: 12px;
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
        .panel-body {
            border-bottom: 2px dashed black;
            margin-bottom: 2%;
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
            <p align="center">{{ $order->firm }} cde {{ str_replace("(n)", "&", $orderLine->order_id) }}</p>
            
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <table class="table table-striped table-bordered table-dataTable">
                            <tbody>
                                <tr style="background-color: #fff !important">
                                    <td>Code N°</td>
                                    <td>{{ str_replace("(n)", "&", $orderLine->order_id) }}</td>
                                    <td colspan="4">{{ $orderLine->forme }}/{{ $orderLine->article }}{{ isset($orderLine->client) ? " - " . $orderLine->client : '' }}</td>
                                    <td colspan="5">{{ $orderLine->semelle }}/{{ $orderLine->construction }}</td>
                                    <td colspan="4">{{ $orderLine->cuir }}/{{ $orderLine->doublure }}</td>
                                    <td colspan="5">{{ $orderLine->supplement }}</td>
                                </tr>
                                
                                <tr style="background-color: #fff !important">
                                    <th>Date de livraison</th>
                                    <th>{{ $order->livraison ? $order->livraison->format('Y-m-d') : '' }}</th>
                                    <th>{{ $orderLine->pointure ?? 'Pointure' }}</th>
                                    @php
                                        $langue = $orderLine->langue;
                                        $genre = $orderLine->genre;
                                    @endphp
                                    <th>
                                        <span class="anglais" @if($langue == 'français') style="display:none" @endif>5,0</span>
                                        <hr>
                                        <span class="pointure français" @if($langue == 'anglais') style="display:none" @endif>
                                            {{ $genre == 'femme' ? 35 : 39 }}
                                        </span>
                                    </th>
                                    <th>
                                        <span class="anglais" @if($langue == 'français') style="display:none" @endif>5,5</span><hr>
                                        <span class="français" @if($langue == 'anglais') style="display:none" @endif>x</span>
                                    </th>
                                    <th>
                                        <span class="anglais" @if($langue == 'français') style="display:none" @endif>6,0</span><hr>
                                        <span class="pointure français" @if($langue == 'anglais') style="display:none" @endif>
                                            {{ $genre == 'femme' ? 36 : 40 }}
                                        </span>
                                    </th>
                                    <th>
                                        <span class="anglais" @if($langue == 'français') style="display:none" @endif>6,5</span><hr>
                                        <span class="français" @if($langue == 'anglais') style="display:none" @endif>x</span>
                                    </th>
                                    <th>
                                        <span class="anglais" @if($langue == 'français') style="display:none" @endif>7,0</span><hr>
                                        <span class="pointure français" @if($langue == 'anglais') style="display:none" @endif>
                                            {{ $genre == 'femme' ? 37 : 41 }}
                                        </span>
                                    </th>
                                    <th>
                                        <span class="anglais" @if($langue == 'français') style="display:none" @endif>7,5</span><hr>
                                        <span class="français" @if($langue == 'anglais') style="display:none" @endif>x</span>
                                    </th>
                                    <th>
                                        <span class="anglais" @if($langue == 'français') style="display:none" @endif>8,0</span><hr>
                                        <span class="pointure français" @if($langue == 'anglais') style="display:none" @endif>
                                            {{ $genre == 'femme' ? 38 : 42 }}
                                        </span>
                                    </th>
                                    <th>
                                        <span class="anglais" @if($langue == 'français') style="display:none" @endif>8,5</span><hr>
                                        <span class="français" @if($langue == 'anglais') style="display:none" @endif>x</span>
                                    </th>
                                    <th>
                                        <span class="anglais" @if($langue == 'français') style="display:none" @endif>9,0</span><hr>
                                        <span class="pointure français" @if($langue == 'anglais') style="display:none" @endif>
                                            {{ $genre == 'femme' ? 39 : 43 }}
                                        </span>
                                    </th>
                                    <th>
                                        <span class="anglais" @if($langue == 'français') style="display:none" @endif>9,5</span><hr>
                                        <span class="français" @if($langue == 'anglais') style="display:none" @endif>x</span>
                                    </th>
                                    <th>
                                        <span class="anglais" @if($langue == 'français') style="display:none" @endif>10,0</span><hr>
                                        <span class="pointure français" @if($langue == 'anglais') style="display:none" @endif>
                                            {{ $genre == 'femme' ? 40 : 44 }}
                                        </span>
                                    </th>
                                    <th>
                                        <span class="anglais" @if($langue == 'français') style="display:none" @endif>10,5</span><hr>
                                        <span class="français" @if($langue == 'anglais') style="display:none" @endif>x</span>
                                    </th>
                                    <th>
                                        <span class="anglais" @if($langue == 'français') style="display:none" @endif>11,0</span><hr>
                                        <span class="pointure français" @if($langue == 'anglais') style="display:none" @endif>
                                            {{ $genre == 'femme' ? 41 : 45 }}
                                        </span>
                                    </th>
                                    <th>
                                        <span class="anglais" @if($langue == 'français') style="display:none" @endif>11,5</span><hr>
                                        <span class="français" @if($langue == 'anglais') style="display:none" @endif>x</span>
                                    </th>
                                    <th>
                                        <span class="anglais" @if($langue == 'français') style="display:none" @endif>12,0</span><hr>
                                        <span class="pointure français" @if($langue == 'anglais') style="display:none" @endif>
                                            {{ $genre == 'femme' ? 42 : 46 }}
                                        </span>
                                    </th>
                                    <th>
                                        <span class="anglais" @if($langue == 'français') style="display:none" @endif>13,0</span><hr>
                                        <span class="pointure français" @if($langue == 'anglais') style="display:none" @endif>
                                            {{ $genre == 'femme' ? 43 : 47 }}
                                        </span>
                                    </th>
                                    <th>Total</th>
                                </tr>
                               
                                <tr>
                                    <td>Talon</td>
                                    <td>{{ $orderLine->talon }}</td>
                                    <td>{{ $orderLine->vpointure == 0 ? '' : $orderLine->vpointure }}</td>
                                    <td>{{ $orderLine->p5 == 0 ? '' : $orderLine->p5 }}</td>
                                    <td>{{ $orderLine->p5x == 0 ? '' : $orderLine->p5x }}</td>
                                    <td>{{ $orderLine->p6 == 0 ? '' : $orderLine->p6 }}</td>
                                    <td>{{ $orderLine->p6x == 0 ? '' : $orderLine->p6x }}</td>
                                    <td>{{ $orderLine->p7 == 0 ? '' : $orderLine->p7 }}</td>
                                    <td>{{ $orderLine->p7x == 0 ? '' : $orderLine->p7x }}</td>
                                    <td>{{ $orderLine->p8 == 0 ? '' : $orderLine->p8 }}</td>
                                    <td>{{ $orderLine->p8x == 0 ? '' : $orderLine->p8x }}</td>
                                    <td>{{ $orderLine->p9 == 0 ? '' : $orderLine->p9 }}</td>
                                    <td>{{ $orderLine->p9x == 0 ? '' : $orderLine->p9x }}</td>
                                    <td>{{ $orderLine->p10 == 0 ? '' : $orderLine->p10 }}</td>
                                    <td>{{ $orderLine->p10x == 0 ? '' : $orderLine->p10x }}</td>
                                    <td>{{ $orderLine->p11 == 0 ? '' : $orderLine->p11 }}</td>
                                    <td>{{ $orderLine->p11x == 0 ? '' : $orderLine->p11x }}</td>
                                    <td>{{ $orderLine->p12 == 0 ? '' : $orderLine->p12 }}</td>
                                    <td>{{ $orderLine->p13 == 0 ? '' : $orderLine->p13 }}</td>
                                    <td>{{ $orderLine->total_quantity }}</td>
                                </tr>
                                <tr>
                                    <td>Trépointe</td>
                                    <td>
                                        @php
                                            $trepointe = $orderLine->trepointe ?? '';
                                            if($trepointe == "Stormweltm") {
                                                echo "Stormwelt";
                                            } elseif($trepointe == "Platm") {
                                                echo "Plat";
                                            } else {
                                                echo $trepointe;
                                            }
                                        @endphp
                                    </td>
                                    <td colspan="12" rowspan="6" align="center">
                                        @if($orderLine->image)
                                            <img src="{{ asset('storage/images/' . $orderLine->image) }}" style="max-width: 200px;max-height: 150px;">
                                        @endif
                                    </td>
                                    <td colspan="6" rowspan="3" align="center" style="background-color: #ccc">
                                        <label>Logo</label><br>
                                        @if($order->logo1)
                                            <img src="{{ asset('storage/' . $order->logo1) }}" style="max-width: 100px;max-height: 50px;">
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Type de finition</td>
                                    <td>{{ $orderLine->finition }}</td>
                                </tr>
                                <tr>
                                    <td>Lacet</td>
                                    <td>{{ $orderLine->lacet }} {{ $orderLine->lacetx }} cm</td>
                                </tr>          
                                <tr>
                                    <td>Perforation</td>
                                    <td>{{ $orderLine->perforation == 1 ? 'oui' : 'sans' }}</td>
                                    <td colspan="6" rowspan="3" align="center" style="background-color: #ccc">
                                        <label>Logo Semelle</label><br>
                                        @if($order->logo)
                                            <img src="{{ asset('storage/' . $order->logo) }}" style="max-width: 100px;max-height: 50px;">
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Fleur</td>
                                    <td>{{ $orderLine->fleur == 1 ? 'oui' : 'sans' }}</td>
                                </tr>
                                <tr>
                                    <td>Dentlage</td>
                                    <td>{{ $orderLine->dentlage == 1 ? 'oui' : 'sans' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped table-bordered table-dataTable">
                            <tbody>
                                <tr style="background-color: #fff !important">
                                    <td><h4>Semelle</h4></td>
                                    <td><h4>Cuir</h4></td>
                                    <td><h4>Doublure</h4></td>
                                    <td><h4>Trépointe
                                        @php
                                            $trepointe = $orderLine->trepointe ?? '';
                                            if($trepointe == "Stormweltm" || $trepointe == "Platm") {
                                                echo ": Marron";
                                            } elseif($trepointe == "Stormwelt" || $trepointe == "Plat") {
                                                echo ": Naturelle";
                                            }
                                        @endphp
                                    </h4></td>
                                </tr>
                                <tr style="background-color: #fff !important;" align="center">
                                    <td>
                                        @if($orderLine->semelle)
                                            <img src="{{ asset('storage/semelles/' . trim($orderLine->semelle) . '.jpg') }}" style="max-height: 150px;max-width: 150px">
                                        @endif
                                    </td>
                                    <td>
                                        @if($orderLine->cuir)
                                            <img src="{{ asset('storage/cuirs/' . trim($orderLine->cuir) . '.jpg') }}" style="max-height: 150px;max-width: 150px">
                                        @endif
                                    </td>
                                    <td>
                                        @if($orderLine->doublure)
                                            <img src="{{ asset('storage/doublures/' . trim($orderLine->doublure) . '.jpg') }}" style="max-height: 150px;max-width: 150px">
                                        @endif
                                    </td>
                                    <td>
                                        @if($orderLine->trepointe_img ?? false)
                                            <img src="{{ asset('storage/trepointe/' . trim($orderLine->trepointe_img) . '.png') }}" style="max-height: 150px;max-width: 150px">
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped table-bordered table-dataTable">
                            <tbody>
                                <tr style="background-color: #fff !important">
                                    <td colspan="2">Fiche de piquage</td>
                                    <td colspan="4">{{ $orderLine->forme }}/{{ $orderLine->article }}</td>
                                    <td colspan="5">{{ $orderLine->semelle }}/{{ $orderLine->construction }}</td>
                                    <td colspan="4">{{ $orderLine->cuir }}/{{ $orderLine->doublure }}</td>
                                    <td colspan="5">{{ $orderLine->supplement }}</td>
                                </tr>
                                
                                <tr style="background-color: #fff !important">
                                    <th>Code N°</th>
                                    <th>{{ str_replace("(n)", "&", $order->code) }}</th>
                                    <th>{{ $orderLine->pointure ?? 'Pointure' }}</th>
                                    <!-- Size headers repeated -->
                                    <th>
                                        <span class="anglais" @if($langue == 'français') style="display:none" @endif>5,0</span>
                                        <hr>
                                        <span class="pointure français" @if($langue == 'anglais') style="display:none" @endif>
                                            {{ $genre == 'femme' ? 35 : 39 }}
                                        </span>
                                    </th>
                                    <!-- ... repeat all size headers ... -->
                                    <th>Total</th>
                                </tr>
                               
                                <tr>
                                    <td>Date de livraison</td>
                                    <td>{{ $order->livraison ? $order->livraison->format('Y-m-d') : '' }}</td>
                                    <td>{{ $orderLine->vpointure == 0 ? '' : $orderLine->vpointure }}</td>
                                    <td>{{ $orderLine->p5 == 0 ? '' : $orderLine->p5 }}</td>
                                    <td>{{ $orderLine->p5x == 0 ? '' : $orderLine->p5x }}</td>
                                    <td>{{ $orderLine->p6 == 0 ? '' : $orderLine->p6 }}</td>
                                    <td>{{ $orderLine->p6x == 0 ? '' : $orderLine->p6x }}</td>
                                    <td>{{ $orderLine->p7 == 0 ? '' : $orderLine->p7 }}</td>
                                    <td>{{ $orderLine->p7x == 0 ? '' : $orderLine->p7x }}</td>
                                    <td>{{ $orderLine->p8 == 0 ? '' : $orderLine->p8 }}</td>
                                    <td>{{ $orderLine->p8x == 0 ? '' : $orderLine->p8x }}</td>
                                    <td>{{ $orderLine->p9 == 0 ? '' : $orderLine->p9 }}</td>
                                    <td>{{ $orderLine->p9x == 0 ? '' : $orderLine->p9x }}</td>
                                    <td>{{ $orderLine->p10 == 0 ? '' : $orderLine->p10 }}</td>
                                    <td>{{ $orderLine->p10x == 0 ? '' : $orderLine->p10x }}</td>
                                    <td>{{ $orderLine->p11 == 0 ? '' : $orderLine->p11 }}</td>
                                    <td>{{ $orderLine->p11x == 0 ? '' : $orderLine->p11x }}</td>
                                    <td>{{ $orderLine->p12 == 0 ? '' : $orderLine->p12 }}</td>
                                    <td>{{ $orderLine->p13 == 0 ? '' : $orderLine->p13 }}</td>
                                    <td>{{ $orderLine->total_quantity }}</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td colspan="4" align="center">Couleur du fil</td>
                                    <td colspan="5" align="center"></td>
                                    <td colspan="4" align="center">Bout Dur</td>
                                    <td colspan="5" align="center"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped table-bordered table-dataTable">
                            <tbody>
                                <tr style="background-color: #fff !important">
                                    <td colspan="2">Fiche de coupe</td>
                                    <td colspan="4">{{ $orderLine->forme }}/{{ $orderLine->article }}</td>
                                    <td colspan="5">{{ $orderLine->semelle }}/{{ $orderLine->construction }}</td>
                                    <td colspan="4">{{ $orderLine->cuir }}/{{ $orderLine->doublure }}</td>
                                    <td colspan="5">{{ $orderLine->supplement }}</td>
                                </tr>
                                
                                <tr style="background-color: #fff !important">
                                    <th>Code N°</th>
                                    <th>{{ str_replace("(n)", "&", $order->code) }}</th>
                                    <th>{{ $orderLine->pointure ?? 'Pointure' }}</th>
                                    <!-- Size headers repeated -->
                                    <th>Total</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
