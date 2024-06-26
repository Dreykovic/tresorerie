<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    {{-- 
    <script>
        var formatMontant = (text) => {
            text = text.trim();
            text = text.split('').reverse().join('');
            var length = text.length;
            var newText = '';
            for (var i = 0; i <= length - 1; i++) {
                if ((i + 1) % 3 === 1 && i != 1) {
                    newText += ' ';
                }
                newText += text[i];
            }
            newText = newText.split('').reverse().join('');

            return newText;
        }
        document.querySelectorAll('.montant').forEach(element => {
            texte = formatMontant(element.innerText);

            element.innerText = texte + ' FCFA';
        });
    </script> --}}
</head>

<body>
    <style>
        * {
            margin: 0px;
            padding: 0px;
            box-sizing: border-box;
            text-decoration: none;
        }

        body {
            padding: 15px;
        }

        header.head-title {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: end;
            padding: 0 10px 0px 10px;


        }






        .titre {
            margin: auto;
            font-weight: 700;
            text-align: center;
            text-transform: uppercase;
        }

        .separateur {
            margin-top: 10px;
            margin-bottom: 5px;
            font-size: 10px;
            font-weight: 500;
            height: 6px;
            min-width: 100%;
            border: #000000 solid 2px;
        }

        .upper {
            text-transform: uppercase;
        }

        .box-title {
            text-align: center;
        }

        main table.table {
            width: 100%;
            border-collapse: collapse;
            margin: 0;

        }

        main table.table th,
        main table.table td {
            border: 2px solid #ddd;
            padding: 3px;
            /* text-align: center; */
        }

        main th {
            background-color: #f2f2f2;
        }


        div.cellule {
            width: 100%;
            text-align: right;

        }



        .capital {
            text-transform: capitalize;
        }
    </style>


    <div class="box-title">
        <h1><span class="upper"></span>
            VILLAGE GATI-SOUN <br>
            QUARTIER DJIGBE <br>
            COTISAITONS <br>
            FILLES ET FILS DE LA MAISON BATO
        </h1>

    </div>
    <div class="separateur">


    </div>

    <main>
        @foreach ($natures as $nature)
            <h1>
                Nature: {{ $nature->designation }}

            </h1>

            <table>
                <tbody>
                    <tr>
                        <td style="text-align: end; font-weight: 900;">
                            Montant Total
                        </td>
                        <td>
                            :
                        </td>
                        <td>
                            {{ $nature->cotisations->sum('montant') }}
                        </td>
                    </tr>

                </tbody>
            </table>


            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Membre</th>
                        <th>Montant</th>
                        <th>Date</th>
                        <th>Moyen de paiement</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($nature->cotisations as $key => $cotisation)
                        <tr>
                            <td class="text-nowrap" style="word-wrap: normal;overflow-wrap: normal;">
                                {{ $key + 1 }}
                            </td>
                            <td>
                                {{ $cotisation->membre->user->last_name . ' ' . $cotisation->membre->user->first_name }}

                            </td>
                            <td>
                                <div class="cellule" style="text-align: right; ">
                                    {{ $cotisation->montant_f }}
                                </div>
                            </td>
                            <td style="text-align: right; ">
                                {{ $cotisation->date_cotisation }}
                            </td>
                            <td style="text-align: right; ">
                                {{ $cotisation->canal }}
                            </td>
                        </tr>
                    @endforeach


                    <!-- Ajoutez d'autres lignes au besoin -->
                </tbody>
            </table>
        @endforeach

    </main>

</body>

</html>
