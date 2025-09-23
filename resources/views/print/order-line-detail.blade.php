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
            padding: 8px !important;
            min-height: 40px;
            height: auto;
        }
        .fad, .fac {
            display: none;
        }
        .panel-body {
            border-bottom: 2px dashed black;
            margin-bottom: 0.5%;
            padding: 0px !important;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table td, .table th {
            border: 1px solid #ddd;
            padding: 8px;
            min-height: 40px;
            height: auto;
            vertical-align: middle;
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f9f9f9;
        }
        .size-header {
            font-size: 10px;
            text-align: center;
        }
        .material-img {
            max-height: 150px;
            max-width: 150px;
        }
        .product-img {
            max-width: 200px;
            max-height: 150px;
        }
        .logo-img {
            max-width: 100px;
            max-height: 50px;
        }
    </style>
</head>

<body>
    <div class="">
        <div class="row">
            <p align="center">{{ $order->firm }} cde {{ str_replace("(n)", "&", $order->code) }}</p>
            
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <table class="table table-striped table-bordered table-dataTable" style="height: 25%;">
                            <tbody>
                                <tr style="background-color: #fff !important">
                                    <td>Code N°</td>
                                    <td>{{ str_replace("(n)", "&", $order->code) }}</td>
                                    <td colspan="4">{{ $orderLine->formeItem->nom ?? $orderLine->forme }}/{{ $orderLine->articleItem->nom ?? $orderLine->article }}{{ isset($orderLine->client) ? " - " . $orderLine->client : '' }}</td>
                                    <td colspan="5">{{ $orderLine->semelleItem->nom ?? $orderLine->semelle }}/{{ $orderLine->constructionItem->nom ?? $orderLine->construction }}</td>
                                    <td colspan="4">{{ $orderLine->cuirItem->nom ?? $orderLine->cuir }}/{{ $orderLine->doublureItem->nom ?? $orderLine->doublure }}</td>
                                    <td colspan="5">{{ $orderLine->supplementItem->nom ?? $orderLine->supplement }}</td>
                                </tr>
                                
                                <tr style="background-color: #fff !important">
                                    <th>Date de livraison</th>
                                    <th>{{ $order->livraison ? $order->livraison->format('Y-m-d') : '' }}</th>
                                    <th>{{ $orderLine->pointure ?? 'Pointure' }}</th>
                                    @php
                                        $langue = $orderLine->langue ?? 'français';
                                        $genre = $orderLine->genre ?? 'homme';
                                    @endphp
                                    <th class="size-header">
                                        <span class="anglais" @if($langue == 'français') style="display:none" @endif>5,0</span>
                                        <hr>
                                        <span class="pointure français" @if($langue == 'anglais') style="display:none" @endif>
                                            {{ $genre == 'femme' ? 35 : 38 }}
                                        </span>
                                    </th>
                                    <th class="size-header">
                                        <span class="anglais" @if($langue == 'français') style="display:none" @endif>5,5</span><hr>
                                        <span class="français" @if($langue == 'anglais') style="display:none" @endif>x</span>
                                    </th>
                                    <th class="size-header">
                                        <span class="anglais" @if($langue == 'français') style="display:none" @endif>6,0</span><hr>
                                        <span class="pointure français" @if($langue == 'anglais') style="display:none" @endif>
                                            {{ $genre == 'femme' ? 36 : 39 }}
                                        </span>
                                    </th>
                                    <th class="size-header">
                                        <span class="anglais" @if($langue == 'français') style="display:none" @endif>6,5</span><hr>
                                        <span class="français" @if($langue == 'anglais') style="display:none" @endif>x</span>
                                    </th>
                                    <th class="size-header">
                                        <span class="anglais" @if($langue == 'français') style="display:none" @endif>7,0</span><hr>
                                        <span class="pointure français" @if($langue == 'anglais') style="display:none" @endif>
                                            {{ $genre == 'femme' ? 37 : 40 }}
                                        </span>
                                    </th>
                                    <th class="size-header">
                                        <span class="anglais" @if($langue == 'français') style="display:none" @endif>7,5</span><hr>
                                        <span class="français" @if($langue == 'anglais') style="display:none" @endif>x</span>
                                    </th>
                                    <th class="size-header">
                                        <span class="anglais" @if($langue == 'français') style="display:none" @endif>8,0</span><hr>
                                        <span class="pointure français" @if($langue == 'anglais') style="display:none" @endif>
                                            {{ $genre == 'femme' ? 38 : 41 }}
                                        </span>
                                    </th>
                                    <th class="size-header">
                                        <span class="anglais" @if($langue == 'français') style="display:none" @endif>8,5</span><hr>
                                        <span class="français" @if($langue == 'anglais') style="display:none" @endif>x</span>
                                    </th>
                                    <th class="size-header">
                                        <span class="anglais" @if($langue == 'français') style="display:none" @endif>9,0</span><hr>
                                        <span class="pointure français" @if($langue == 'anglais') style="display:none" @endif>
                                            {{ $genre == 'femme' ? 39 : 42 }}
                                        </span>
                                    </th>
                                    <th class="size-header">
                                        <span class="anglais" @if($langue == 'français') style="display:none" @endif>9,5</span><hr>
                                        <span class="français" @if($langue == 'anglais') style="display:none" @endif>x</span>
                                    </th>
                                    <th class="size-header">
                                        <span class="anglais" @if($langue == 'français') style="display:none" @endif>10,0</span><hr>
                                        <span class="pointure français" @if($langue == 'anglais') style="display:none" @endif>
                                            {{ $genre == 'femme' ? 40 : 43 }}
                                        </span>
                                    </th>
                                    <th class="size-header">
                                        <span class="anglais" @if($langue == 'français') style="display:none" @endif>10,5</span><hr>
                                        <span class="français" @if($langue == 'anglais') style="display:none" @endif>x</span>
                                    </th>
                                    <th class="size-header">
                                        <span class="anglais" @if($langue == 'français') style="display:none" @endif>11,0</span><hr>
                                        <span class="pointure français" @if($langue == 'anglais') style="display:none" @endif>
                                            {{ $genre == 'femme' ? 41 : 44 }}
                                        </span>
                                    </th>
                                    <th class="size-header">
                                        <span class="anglais" @if($langue == 'français') style="display:none" @endif>11,5</span><hr>
                                        <span class="français" @if($langue == 'anglais') style="display:none" @endif>x</span>
                                    </th>
                                    <th class="size-header">
                                        <span class="anglais" @if($langue == 'français') style="display:none" @endif>12,0</span><hr>
                                        <span class="pointure français" @if($langue == 'anglais') style="display:none" @endif>
                                            {{ $genre == 'femme' ? 42 : 45 }}
                                        </span>
                                    </th>
                                    <th class="size-header">
                                        <span class="anglais" @if($langue == 'français') style="display:none" @endif>13,0</span><hr>
                                        <span class="pointure français" @if($langue == 'anglais') style="display:none" @endif>
                                            {{ $genre == 'femme' ? 43 : 46 }}
                                        </span>
                                    </th>
                                    <th>Total</th>
                                </tr>
                               
                                <tr>
                                    <td>Talon</td>
                                    <td>{{ $orderLine->talon }}</td>
                                    <td></td> {{-- Pointure column is always empty --}}
                                    @if($genre == 'femme')
                                        {{-- For women: sizes 35-43 use columns p5 to p13 --}}
                                        <td>{{ $orderLine->p5 == 0 ? '' : $orderLine->p5 }}</td> {{-- 35 --}}
                                        <td>{{ $orderLine->p5x == 0 ? '' : $orderLine->p5x }}</td> {{-- 35.5 --}}
                                        <td>{{ $orderLine->p6 == 0 ? '' : $orderLine->p6 }}</td> {{-- 36 --}}
                                        <td>{{ $orderLine->p6x == 0 ? '' : $orderLine->p6x }}</td> {{-- 36.5 --}}
                                        <td>{{ $orderLine->p7 == 0 ? '' : $orderLine->p7 }}</td> {{-- 37 --}}
                                        <td>{{ $orderLine->p7x == 0 ? '' : $orderLine->p7x }}</td> {{-- 37.5 --}}
                                        <td>{{ $orderLine->p8 == 0 ? '' : $orderLine->p8 }}</td> {{-- 38 --}}
                                        <td>{{ $orderLine->p8x == 0 ? '' : $orderLine->p8x }}</td> {{-- 38.5 --}}
                                        <td>{{ $orderLine->p9 == 0 ? '' : $orderLine->p9 }}</td> {{-- 39 --}}
                                        <td>{{ $orderLine->p9x == 0 ? '' : $orderLine->p9x }}</td> {{-- 39.5 --}}
                                        <td>{{ $orderLine->p10 == 0 ? '' : $orderLine->p10 }}</td> {{-- 40 --}}
                                        <td>{{ $orderLine->p10x == 0 ? '' : $orderLine->p10x }}</td> {{-- 40.5 --}}
                                        <td>{{ $orderLine->p11 == 0 ? '' : $orderLine->p11 }}</td> {{-- 41 --}}
                                        <td>{{ $orderLine->p11x == 0 ? '' : $orderLine->p11x }}</td> {{-- 41.5 --}}
                                        <td>{{ $orderLine->p12 == 0 ? '' : $orderLine->p12 }}</td> {{-- 42 --}}
                                        <td>{{ $orderLine->p13 == 0 ? '' : $orderLine->p13 }}</td> {{-- 43 --}}
                                    @else
                                        {{-- For men: sizes 38-46 use columns p7 to p15 --}}
                                        <td>{{ $orderLine->p7 == 0 ? '' : $orderLine->p7 }}</td> {{-- 38 --}}
                                        <td>{{ $orderLine->p7x == 0 ? '' : $orderLine->p7x }}</td> {{-- 38.5 --}}
                                        <td>{{ $orderLine->p8 == 0 ? '' : $orderLine->p8 }}</td> {{-- 39 --}}
                                        <td>{{ $orderLine->p8x == 0 ? '' : $orderLine->p8x }}</td> {{-- 39.5 --}}
                                        <td>{{ $orderLine->p9 == 0 ? '' : $orderLine->p9 }}</td> {{-- 40 --}}
                                        <td>{{ $orderLine->p9x == 0 ? '' : $orderLine->p9x }}</td> {{-- 40.5 --}}
                                        <td>{{ $orderLine->p10 == 0 ? '' : $orderLine->p10 }}</td> {{-- 41 --}}
                                        <td>{{ $orderLine->p10x == 0 ? '' : $orderLine->p10x }}</td> {{-- 41.5 --}}
                                        <td>{{ $orderLine->p11 == 0 ? '' : $orderLine->p11 }}</td> {{-- 42 --}}
                                        <td>{{ $orderLine->p11x == 0 ? '' : $orderLine->p11x }}</td> {{-- 42.5 --}}
                                        <td>{{ $orderLine->p12 == 0 ? '' : $orderLine->p12 }}</td> {{-- 43 --}}
                                        <td>{{ $orderLine->p12x == 0 ? '' : $orderLine->p12x }}</td> {{-- 43.5 --}}
                                        <td>{{ $orderLine->p13 == 0 ? '' : $orderLine->p13 }}</td> {{-- 44 --}}
                                        <td>{{ $orderLine->p13x == 0 ? '' : $orderLine->p13x }}</td> {{-- 44.5 --}}
                                        <td>{{ $orderLine->p14 == 0 ? '' : $orderLine->p14 }}</td> {{-- 45 --}}
                                        <td>{{ $orderLine->p15 == 0 ? '' : $orderLine->p15 }}</td> {{-- 46 --}}
                                    @endif
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
                                            <img src="{{ asset('storage/images/' . $orderLine->image) }}" class="product-img" alt="Product Image">
                                        @else
                                            <div style="width: 200px; height: 150px; border: 1px dashed #ccc; display: flex; align-items: center; justify-content: center; font-size: 12px;">Image Produit</div>
                                        @endif
                                    </td>
                                    <td colspan="6" rowspan="3" align="center" style="background-color: #ccc">
                                        <label>Logo 1ere</label><br>
                                        @if($order->logo1)
                                            <img src="{{ asset('storage/' . $order->logo1) }}" class="logo-img" alt="Logo 1">
                                        @else
                                            <div style="width: 100px; height: 50px; border: 1px dashed #999; display: flex; align-items: center; justify-content: center; font-size: 8px;">Logo</div>
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
                                            <img src="{{ asset('storage/' . $order->logo) }}" class="logo-img" alt="Logo Semelle">
                                        @else
                                            <div style="width: 100px; height: 50px; border: 1px dashed #999; display: flex; align-items: center; justify-content: center; font-size: 8px;">Logo</div>
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

                    <div class="panel-body" style="margin-top: -10px;">
                        <table class="table table-striped table-bordered table-dataTable" style="height: 25%;">
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
                                        @if($orderLine->semelleItem && $orderLine->semelleItem->getFirstMediaUrl('images'))
                                            <img src="{{ $orderLine->semelleItem->getFirstMediaUrl('images') }}" class="material-img" alt="{{ $orderLine->semelleItem->nom }}">
                                        @else
                                            <div style="width: 150px; height: 150px; border: 1px dashed #ccc; display: flex; align-items: center; justify-content: center; font-size: 10px;">Semelle</div>
                                        @endif
                                    </td>
                                    <td>
                                        @if($orderLine->cuirItem && $orderLine->cuirItem->getFirstMediaUrl('images'))
                                            <img src="{{ $orderLine->cuirItem->getFirstMediaUrl('images') }}" class="material-img" alt="{{ $orderLine->cuirItem->nom }}">
                                        @else
                                            <div style="width: 150px; height: 150px; border: 1px dashed #ccc; display: flex; align-items: center; justify-content: center; font-size: 10px;">Cuir</div>
                                        @endif
                                    </td>
                                    <td>
                                        @if($orderLine->doublureItem && $orderLine->doublureItem->getFirstMediaUrl('images'))
                                            <img src="{{ $orderLine->doublureItem->getFirstMediaUrl('images') }}" class="material-img" alt="{{ $orderLine->doublureItem->nom }}">
                                        @else
                                            <div style="width: 150px; height: 150px; border: 1px dashed #ccc; display: flex; align-items: center; justify-content: center; font-size: 10px;">Doublure</div>
                                        @endif
                                    </td>
                                    <td>
                                        @if($orderLine->trepointe_img ?? false)
                                            <img src="{{ asset('storage/trepointe/' . trim($orderLine->trepointe_img) . '.png') }}" class="material-img" alt="Trépointe">
                                        @else
                                            <div style="width: 150px; height: 150px; border: 1px dashed #ccc; display: flex; align-items: center; justify-content: center; font-size: 10px;">Trépointe</div>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="panel-body" style="margin-top: -10px;">
                        <table class="table table-striped table-bordered table-dataTable" style="height: 25%;">
                            <tbody>
                                <tr style="background-color: #fff !important">
                                    <td colspan="2">Fiche de piquage</td>
                                    <td colspan="4">{{ $orderLine->formeItem->nom ?? $orderLine->forme }}/{{ $orderLine->articleItem->nom ?? $orderLine->article }}</td>
                                    <td colspan="5">{{ $orderLine->semelleItem->nom ?? $orderLine->semelle }}/{{ $orderLine->constructionItem->nom ?? $orderLine->construction }}</td>
                                    <td colspan="4">{{ $orderLine->cuirItem->nom ?? $orderLine->cuir }}/{{ $orderLine->doublureItem->nom ?? $orderLine->doublure }}</td>
                                    <td colspan="5">{{ $orderLine->supplementItem->nom ?? $orderLine->supplement }}</td>
                                </tr>
                                
                                <tr style="background-color: #fff !important">
                                    <th>Code N°</th>
                                    <th>{{ str_replace("(n)", "&", $order->code) }}</th>
                                    <th>{{ $orderLine->pointure ?? 'Pointure' }}</th>
                                    <th class="size-header">
                                        <span class="anglais" @if($langue == 'français') style="display:none" @endif>5,0</span>
                                        <hr>
                                        <span class="pointure français" @if($langue == 'anglais') style="display:none" @endif>
                                            {{ $genre == 'femme' ? 35 : 38 }}
                                        </span>
                                    </th>
                                    <th class="size-header">
                                        <span class="anglais" @if($langue == 'français') style="display:none" @endif>5,5</span><hr>
                                        <span class="français" @if($langue == 'anglais') style="display:none" @endif>x</span>
                                    </th>
                                    <th class="size-header">
                                        <span class="anglais" @if($langue == 'français') style="display:none" @endif>6,0</span><hr>
                                        <span class="pointure français" @if($langue == 'anglais') style="display:none" @endif>
                                            {{ $genre == 'femme' ? 36 : 39 }}
                                        </span>
                                    </th>
                                    <th class="size-header">
                                        <span class="anglais" @if($langue == 'français') style="display:none" @endif>6,5</span><hr>
                                        <span class="français" @if($langue == 'anglais') style="display:none" @endif>x</span>
                                    </th>
                                    <th class="size-header">
                                        <span class="anglais" @if($langue == 'français') style="display:none" @endif>7,0</span><hr>
                                        <span class="pointure français" @if($langue == 'anglais') style="display:none" @endif>
                                            {{ $genre == 'femme' ? 37 : 40 }}
                                        </span>
                                    </th>
                                    <th class="size-header">
                                        <span class="anglais" @if($langue == 'français') style="display:none" @endif>7,5</span><hr>
                                        <span class="français" @if($langue == 'anglais') style="display:none" @endif>x</span>
                                    </th>
                                    <th class="size-header">
                                        <span class="anglais" @if($langue == 'français') style="display:none" @endif>8,0</span><hr>
                                        <span class="pointure français" @if($langue == 'anglais') style="display:none" @endif>
                                            {{ $genre == 'femme' ? 38 : 41 }}
                                        </span>
                                    </th>
                                    <th class="size-header">
                                        <span class="anglais" @if($langue == 'français') style="display:none" @endif>8,5</span><hr>
                                        <span class="français" @if($langue == 'anglais') style="display:none" @endif>x</span>
                                    </th>
                                    <th class="size-header">
                                        <span class="anglais" @if($langue == 'français') style="display:none" @endif>9,0</span><hr>
                                        <span class="pointure français" @if($langue == 'anglais') style="display:none" @endif>
                                            {{ $genre == 'femme' ? 39 : 42 }}
                                        </span>
                                    </th>
                                    <th class="size-header">
                                        <span class="anglais" @if($langue == 'français') style="display:none" @endif>9,5</span><hr>
                                        <span class="français" @if($langue == 'anglais') style="display:none" @endif>x</span>
                                    </th>
                                    <th class="size-header">
                                        <span class="anglais" @if($langue == 'français') style="display:none" @endif>10,0</span><hr>
                                        <span class="pointure français" @if($langue == 'anglais') style="display:none" @endif>
                                            {{ $genre == 'femme' ? 40 : 43 }}
                                        </span>
                                    </th>
                                    <th class="size-header">
                                        <span class="anglais" @if($langue == 'français') style="display:none" @endif>10,5</span><hr>
                                        <span class="français" @if($langue == 'anglais') style="display:none" @endif>x</span>
                                    </th>
                                    <th class="size-header">
                                        <span class="anglais" @if($langue == 'français') style="display:none" @endif>11,0</span><hr>
                                        <span class="pointure français" @if($langue == 'anglais') style="display:none" @endif>
                                            {{ $genre == 'femme' ? 41 : 44 }}
                                        </span>
                                    </th>
                                    <th class="size-header">
                                        <span class="anglais" @if($langue == 'français') style="display:none" @endif>11,5</span><hr>
                                        <span class="français" @if($langue == 'anglais') style="display:none" @endif>x</span>
                                    </th>
                                    <th class="size-header">
                                        <span class="anglais" @if($langue == 'français') style="display:none" @endif>12,0</span><hr>
                                        <span class="pointure français" @if($langue == 'anglais') style="display:none" @endif>
                                            {{ $genre == 'femme' ? 42 : 45 }}
                                        </span>
                                    </th>
                                    <th class="size-header">
                                        <span class="anglais" @if($langue == 'français') style="display:none" @endif>13,0</span><hr>
                                        <span class="pointure français" @if($langue == 'anglais') style="display:none" @endif>
                                            {{ $genre == 'femme' ? 43 : 46 }}
                                        </span>
                                    </th>
                                    <th>Total</th>
                                </tr>
                               
                                <tr>
                                    <td>Date de livraison</td>
                                    <td>{{ $order->livraison ? $order->livraison->format('Y-m-d') : '' }}</td>
                                    <td></td> {{-- Pointure column is always empty --}}
                                    @if($genre == 'femme')
                                        {{-- For women: sizes 35-43 use columns p5 to p13 --}}
                                        <td>{{ $orderLine->p5 == 0 ? '' : $orderLine->p5 }}</td> {{-- 35 --}}
                                        <td>{{ $orderLine->p5x == 0 ? '' : $orderLine->p5x }}</td> {{-- 35.5 --}}
                                        <td>{{ $orderLine->p6 == 0 ? '' : $orderLine->p6 }}</td> {{-- 36 --}}
                                        <td>{{ $orderLine->p6x == 0 ? '' : $orderLine->p6x }}</td> {{-- 36.5 --}}
                                        <td>{{ $orderLine->p7 == 0 ? '' : $orderLine->p7 }}</td> {{-- 37 --}}
                                        <td>{{ $orderLine->p7x == 0 ? '' : $orderLine->p7x }}</td> {{-- 37.5 --}}
                                        <td>{{ $orderLine->p8 == 0 ? '' : $orderLine->p8 }}</td> {{-- 38 --}}
                                        <td>{{ $orderLine->p8x == 0 ? '' : $orderLine->p8x }}</td> {{-- 38.5 --}}
                                        <td>{{ $orderLine->p9 == 0 ? '' : $orderLine->p9 }}</td> {{-- 39 --}}
                                        <td>{{ $orderLine->p9x == 0 ? '' : $orderLine->p9x }}</td> {{-- 39.5 --}}
                                        <td>{{ $orderLine->p10 == 0 ? '' : $orderLine->p10 }}</td> {{-- 40 --}}
                                        <td>{{ $orderLine->p10x == 0 ? '' : $orderLine->p10x }}</td> {{-- 40.5 --}}
                                        <td>{{ $orderLine->p11 == 0 ? '' : $orderLine->p11 }}</td> {{-- 41 --}}
                                        <td>{{ $orderLine->p11x == 0 ? '' : $orderLine->p11x }}</td> {{-- 41.5 --}}
                                        <td>{{ $orderLine->p12 == 0 ? '' : $orderLine->p12 }}</td> {{-- 42 --}}
                                        <td>{{ $orderLine->p13 == 0 ? '' : $orderLine->p13 }}</td> {{-- 43 --}}
                                    @else
                                        {{-- For men: sizes 38-46 use columns p7 to p15 --}}
                                        <td>{{ $orderLine->p7 == 0 ? '' : $orderLine->p7 }}</td> {{-- 38 --}}
                                        <td>{{ $orderLine->p7x == 0 ? '' : $orderLine->p7x }}</td> {{-- 38.5 --}}
                                        <td>{{ $orderLine->p8 == 0 ? '' : $orderLine->p8 }}</td> {{-- 39 --}}
                                        <td>{{ $orderLine->p8x == 0 ? '' : $orderLine->p8x }}</td> {{-- 39.5 --}}
                                        <td>{{ $orderLine->p9 == 0 ? '' : $orderLine->p9 }}</td> {{-- 40 --}}
                                        <td>{{ $orderLine->p9x == 0 ? '' : $orderLine->p9x }}</td> {{-- 40.5 --}}
                                        <td>{{ $orderLine->p10 == 0 ? '' : $orderLine->p10 }}</td> {{-- 41 --}}
                                        <td>{{ $orderLine->p10x == 0 ? '' : $orderLine->p10x }}</td> {{-- 41.5 --}}
                                        <td>{{ $orderLine->p11 == 0 ? '' : $orderLine->p11 }}</td> {{-- 42 --}}
                                        <td>{{ $orderLine->p11x == 0 ? '' : $orderLine->p11x }}</td> {{-- 42.5 --}}
                                        <td>{{ $orderLine->p12 == 0 ? '' : $orderLine->p12 }}</td> {{-- 43 --}}
                                        <td>{{ $orderLine->p12x == 0 ? '' : $orderLine->p12x }}</td> {{-- 43.5 --}}
                                        <td>{{ $orderLine->p13 == 0 ? '' : $orderLine->p13 }}</td> {{-- 44 --}}
                                        <td>{{ $orderLine->p13x == 0 ? '' : $orderLine->p13x }}</td> {{-- 44.5 --}}
                                        <td>{{ $orderLine->p14 == 0 ? '' : $orderLine->p14 }}</td> {{-- 45 --}}
                                        <td>{{ $orderLine->p15 == 0 ? '' : $orderLine->p15 }}</td> {{-- 46 --}}
                                    @endif
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

                    <div class="panel-body" style="margin-top: -10px;">
                        <table class="table table-striped table-bordered table-dataTable" style="height: 25%;">
                            <tbody>
                                <tr style="background-color: #fff !important">
                                    <td colspan="2">Fiche de coupe</td>
                                    <td colspan="4">{{ $orderLine->formeItem->nom ?? $orderLine->forme }}/{{ $orderLine->articleItem->nom ?? $orderLine->article }}</td>
                                    <td colspan="5">{{ $orderLine->semelleItem->nom ?? $orderLine->semelle }}/{{ $orderLine->constructionItem->nom ?? $orderLine->construction }}</td>
                                    <td colspan="4">{{ $orderLine->cuirItem->nom ?? $orderLine->cuir }}/{{ $orderLine->doublureItem->nom ?? $orderLine->doublure }}</td>
                                    <td colspan="5">{{ $orderLine->supplementItem->nom ?? $orderLine->supplement }}</td>
                                </tr>
                                
                                <tr style="background-color: #fff !important">
                                    <th>Code N°</th>
                                    <th>{{ str_replace("(n)", "&", $order->code) }}</th>
                                    <th>{{ $orderLine->pointure ?? 'Pointure' }}</th>
                                    <th class="size-header">
                                        <span class="anglais" @if($langue == 'français') style="display:none" @endif>5,0</span>
                                        <hr>
                                        <span class="pointure français" @if($langue == 'anglais') style="display:none" @endif>
                                            {{ $genre == 'femme' ? 35 : 38 }}
                                        </span>
                                    </th>
                                    <th class="size-header">
                                        <span class="anglais" @if($langue == 'français') style="display:none" @endif>5,5</span><hr>
                                        <span class="français" @if($langue == 'anglais') style="display:none" @endif>x</span>
                                    </th>
                                    <th class="size-header">
                                        <span class="anglais" @if($langue == 'français') style="display:none" @endif>6,0</span><hr>
                                        <span class="pointure français" @if($langue == 'anglais') style="display:none" @endif>
                                            {{ $genre == 'femme' ? 36 : 39 }}
                                        </span>
                                    </th>
                                    <th class="size-header">
                                        <span class="anglais" @if($langue == 'français') style="display:none" @endif>6,5</span><hr>
                                        <span class="français" @if($langue == 'anglais') style="display:none" @endif>x</span>
                                    </th>
                                    <th class="size-header">
                                        <span class="anglais" @if($langue == 'français') style="display:none" @endif>7,0</span><hr>
                                        <span class="pointure français" @if($langue == 'anglais') style="display:none" @endif>
                                            {{ $genre == 'femme' ? 37 : 40 }}
                                        </span>
                                    </th>
                                    <th class="size-header">
                                        <span class="anglais" @if($langue == 'français') style="display:none" @endif>7,5</span><hr>
                                        <span class="français" @if($langue == 'anglais') style="display:none" @endif>x</span>
                                    </th>
                                    <th class="size-header">
                                        <span class="anglais" @if($langue == 'français') style="display:none" @endif>8,0</span><hr>
                                        <span class="pointure français" @if($langue == 'anglais') style="display:none" @endif>
                                            {{ $genre == 'femme' ? 38 : 41 }}
                                        </span>
                                    </th>
                                    <th class="size-header">
                                        <span class="anglais" @if($langue == 'français') style="display:none" @endif>8,5</span><hr>
                                        <span class="français" @if($langue == 'anglais') style="display:none" @endif>x</span>
                                    </th>
                                    <th class="size-header">
                                        <span class="anglais" @if($langue == 'français') style="display:none" @endif>9,0</span><hr>
                                        <span class="pointure français" @if($langue == 'anglais') style="display:none" @endif>
                                            {{ $genre == 'femme' ? 39 : 42 }}
                                        </span>
                                    </th>
                                    <th class="size-header">
                                        <span class="anglais" @if($langue == 'français') style="display:none" @endif>9,5</span><hr>
                                        <span class="français" @if($langue == 'anglais') style="display:none" @endif>x</span>
                                    </th>
                                    <th class="size-header">
                                        <span class="anglais" @if($langue == 'français') style="display:none" @endif>10,0</span><hr>
                                        <span class="pointure français" @if($langue == 'anglais') style="display:none" @endif>
                                            {{ $genre == 'femme' ? 40 : 43 }}
                                        </span>
                                    </th>
                                    <th class="size-header">
                                        <span class="anglais" @if($langue == 'français') style="display:none" @endif>10,5</span><hr>
                                        <span class="français" @if($langue == 'anglais') style="display:none" @endif>x</span>
                                    </th>
                                    <th class="size-header">
                                        <span class="anglais" @if($langue == 'français') style="display:none" @endif>11,0</span><hr>
                                        <span class="pointure français" @if($langue == 'anglais') style="display:none" @endif>
                                            {{ $genre == 'femme' ? 41 : 44 }}
                                        </span>
                                    </th>
                                    <th class="size-header">
                                        <span class="anglais" @if($langue == 'français') style="display:none" @endif>11,5</span><hr>
                                        <span class="français" @if($langue == 'anglais') style="display:none" @endif>x</span>
                                    </th>
                                    <th class="size-header">
                                        <span class="anglais" @if($langue == 'français') style="display:none" @endif>12,0</span><hr>
                                        <span class="pointure français" @if($langue == 'anglais') style="display:none" @endif>
                                            {{ $genre == 'femme' ? 42 : 45 }}
                                        </span>
                                    </th>
                                    <th class="size-header">
                                        <span class="anglais" @if($langue == 'français') style="display:none" @endif>13,0</span><hr>
                                        <span class="pointure français" @if($langue == 'anglais') style="display:none" @endif>
                                            {{ $genre == 'femme' ? 43 : 46 }}
                                        </span>
                                    </th>
                                    <th>Total</th>
                                </tr>
                                <tr>
                                    <td>Date de livraison</td>
                                    <td>{{ $order->livraison ? $order->livraison->format('Y-m-d') : '' }}</td>
                                    <td></td> {{-- Pointure column is always empty --}}
                                    @if($genre == 'femme')
                                        {{-- For women: sizes 35-43 use columns p5 to p13 --}}
                                        <td>{{ $orderLine->p5 == 0 ? '' : $orderLine->p5 }}</td> {{-- 35 --}}
                                        <td>{{ $orderLine->p5x == 0 ? '' : $orderLine->p5x }}</td> {{-- 35.5 --}}
                                        <td>{{ $orderLine->p6 == 0 ? '' : $orderLine->p6 }}</td> {{-- 36 --}}
                                        <td>{{ $orderLine->p6x == 0 ? '' : $orderLine->p6x }}</td> {{-- 36.5 --}}
                                        <td>{{ $orderLine->p7 == 0 ? '' : $orderLine->p7 }}</td> {{-- 37 --}}
                                        <td>{{ $orderLine->p7x == 0 ? '' : $orderLine->p7x }}</td> {{-- 37.5 --}}
                                        <td>{{ $orderLine->p8 == 0 ? '' : $orderLine->p8 }}</td> {{-- 38 --}}
                                        <td>{{ $orderLine->p8x == 0 ? '' : $orderLine->p8x }}</td> {{-- 38.5 --}}
                                        <td>{{ $orderLine->p9 == 0 ? '' : $orderLine->p9 }}</td> {{-- 39 --}}
                                        <td>{{ $orderLine->p9x == 0 ? '' : $orderLine->p9x }}</td> {{-- 39.5 --}}
                                        <td>{{ $orderLine->p10 == 0 ? '' : $orderLine->p10 }}</td> {{-- 40 --}}
                                        <td>{{ $orderLine->p10x == 0 ? '' : $orderLine->p10x }}</td> {{-- 40.5 --}}
                                        <td>{{ $orderLine->p11 == 0 ? '' : $orderLine->p11 }}</td> {{-- 41 --}}
                                        <td>{{ $orderLine->p11x == 0 ? '' : $orderLine->p11x }}</td> {{-- 41.5 --}}
                                        <td>{{ $orderLine->p12 == 0 ? '' : $orderLine->p12 }}</td> {{-- 42 --}}
                                        <td>{{ $orderLine->p13 == 0 ? '' : $orderLine->p13 }}</td> {{-- 43 --}}
                                    @else
                                        {{-- For men: sizes 38-46 use columns p7 to p15 --}}
                                        <td>{{ $orderLine->p7 == 0 ? '' : $orderLine->p7 }}</td> {{-- 38 --}}
                                        <td>{{ $orderLine->p7x == 0 ? '' : $orderLine->p7x }}</td> {{-- 38.5 --}}
                                        <td>{{ $orderLine->p8 == 0 ? '' : $orderLine->p8 }}</td> {{-- 39 --}}
                                        <td>{{ $orderLine->p8x == 0 ? '' : $orderLine->p8x }}</td> {{-- 39.5 --}}
                                        <td>{{ $orderLine->p9 == 0 ? '' : $orderLine->p9 }}</td> {{-- 40 --}}
                                        <td>{{ $orderLine->p9x == 0 ? '' : $orderLine->p9x }}</td> {{-- 40.5 --}}
                                        <td>{{ $orderLine->p10 == 0 ? '' : $orderLine->p10 }}</td> {{-- 41 --}}
                                        <td>{{ $orderLine->p10x == 0 ? '' : $orderLine->p10x }}</td> {{-- 41.5 --}}
                                        <td>{{ $orderLine->p11 == 0 ? '' : $orderLine->p11 }}</td> {{-- 42 --}}
                                        <td>{{ $orderLine->p11x == 0 ? '' : $orderLine->p11x }}</td> {{-- 42.5 --}}
                                        <td>{{ $orderLine->p12 == 0 ? '' : $orderLine->p12 }}</td> {{-- 43 --}}
                                        <td>{{ $orderLine->p12x == 0 ? '' : $orderLine->p12x }}</td> {{-- 43.5 --}}
                                        <td>{{ $orderLine->p13 == 0 ? '' : $orderLine->p13 }}</td> {{-- 44 --}}
                                        <td>{{ $orderLine->p13x == 0 ? '' : $orderLine->p13x }}</td> {{-- 44.5 --}}
                                        <td>{{ $orderLine->p14 == 0 ? '' : $orderLine->p14 }}</td> {{-- 45 --}}
                                        <td>{{ $orderLine->p15 == 0 ? '' : $orderLine->p15 }}</td> {{-- 46 --}}
                                    @endif
                                    <td>{{ $orderLine->total_quantity }}</td>
                                </tr>
                                <tr>
                                    <td>Nom du coupeur</td>
                                    <td colspan="2"></td>
                                    <td colspan="4" align="center">Surface allouée</td>
                                    <td colspan="5" align="center">Retour cuir</td>
                                    <td colspan="4" align="center">Consommation</td>
                                    <td colspan="5" align="center"></td>
                                </tr>
                                <tr>
                                    <td><strong>P.C.E.P</strong></td>
                                    <td colspan="2"></td>
                                    <td colspan="2" align="center" style="border-right: 1px solid #ddd;">Cuir Tige</td>
                                    <td colspan="2" align="center">Doublure</td>
                                    <td colspan="2" align="center" style="border-right: 1px solid #ddd;">Cuir Tige</td>
                                    <td colspan="3" align="center">Doublure</td>
                                    <td colspan="2" align="center" style="border-right: 1px solid #ddd;">Cuir Tige</td>
                                    <td colspan="2" align="center">Doublure</td>
                                    <td colspan="5" align="center"></td>
                                </tr>
                                <tr>
                                    <td><strong>P.C.M</strong></td>
                                    <td colspan="2"></td>
                                    <td colspan="2" align="center" style="border-right: 1px solid #ddd;"></td>
                                    <td colspan="2" align="center"></td>
                                    <td colspan="2" align="center" style="border-right: 1px solid #ddd;"></td>
                                    <td colspan="3" align="center"></td>
                                    <td colspan="2" align="center" style="border-right: 1px solid #ddd;"></td>
                                    <td colspan="2" align="center"></td>
                                    <td colspan="5" align="center"></td>
                                </tr>
                            </tbody>
                        </table>
                        <div style="text-align: center; margin-top: 20px; font-size: 16px; font-weight: bold;">
                            {{ str_replace("(n)", "&", $order->code) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
