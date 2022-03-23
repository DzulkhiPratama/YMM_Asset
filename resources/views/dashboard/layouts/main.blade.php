<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>YMM ASSET | HOME</title>

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">
    <!-- Custom styles for this template -->
    <link href="/css/dashboard.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">

    <!-- two bellow are dedicated from graph generating -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
    <script type="text/javascript" src="jscript/graph.js"></script>

    @if($state=='create' or $state=='edit')
    <!-- khusus dipake saat masuk halamann create -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
    <script>
        // for date picker create new asset
        $(function() {
            $("#added_at").datepicker({
                dateFormat: 'yy-mm-dd'
            });

            $("#expired_date").datepicker({
                dateFormat: 'yy-mm-dd'
            });
            $("#estimate_return_at").datepicker({
                dateFormat: 'yy-mm-dd'
            });
        });
    </script>
    @else
    <!-- ketika masuk ke halaman dashboard -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    @endif
</head>

<body>

    @include('dashboard.layouts.header')

    <div class="container-fluid">
        <div class="row">
            @include('dashboard.layouts.sidebar')

        </div>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            @yield('container')


        </main>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('#assetlist').DataTable();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#apporderlist').DataTable();
        });
    </script>
    <script src="/js/dashboard.js"></script>

    <!-- untuk handle responsif thousand separator saat add asset-->
    @if($state=='create')
    <script type="text/javascript">
        var rupiah = document.getElementById('asset_idr_str');
        var rupiax = document.getElementById('asset_price');

        rupiah.addEventListener('change', function(e) {
            originalText = rupiah.value;
            removedDotText = originalText.split(".").join("");
            removedSpacesText = removedDotText.split(" ").join("");
            removedRPText = removedSpacesText.replace('Rp', '');
            var harganya = parseFloat(removedRPText)
            rupiax.value = harganya;
        })

        rupiah.addEventListener('keyup', function(e) {
            rupiah.value = formatRupiah(this.value, 'Rp. ');
        })

        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }
    </script>
    @endif

    @if($state=='detail')
    <script>
        asset_price = "<?php echo $assety[0]->asset_price; ?>";
        var asset_prices = document.getElementById('asset_price_str');
        asset_prices.value = formatRupiah(asset_price, 'Rp. ');

        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }
    </script>
    @endif

    @if($state=='Dashboard')
    <script>
        asset_price = "<?php echo $assets_tot_price[0]; ?>";
        var total_asset_price = document.getElementById('total_asset_price');
        total_asset_price.innerText = "Total Asset's Price: " + formatRupiah(asset_price, 'Rp. ');

        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }
    </script>
    @endif
    <!-- end to handle thousand separator  -->

    <!-- untuk handle chart pada dashboard -->
    @if($state=='Dashboard')
    <script>
        var ctx = document.getElementById("bar-chart").getContext('2d');
        var label = <?php echo json_encode($list_type); ?>;
        var price = <?php echo json_encode($assets_price); ?>;
        var count = <?php echo json_encode($assets_count); ?>;
        var myChart = new Chart(ctx, {
            type: 'bar',

            data: {
                // labels: ["Elektronik", "Furniture", "Cookware", "Book", "Equipment"],
                labels: label,
                datasets: [{
                    label: ["Total Price"],
                    data: price,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',

                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',

                    ],
                    borderWidth: 1
                }]
            },
            options: {
                legend: {
                    display: false
                },

                scales: {
                    xAxes: [{

                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Asset Type',
                            fontStyle: "bold",
                            fontColor: 'black',
                            position: 'outside'
                        }
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Total Prce (IDR)',
                            fontStyle: "bold",
                            fontColor: 'black',
                            position: 'outside'
                        }
                    }]
                }

            },
        });

        var cty = document.getElementById("pie-chart").getContext('2d');
        var piechart = new Chart(cty, {

            type: 'doughnut',
            data: {
                labels: label,
                datasets: [{
                    label: ["Total Price"],
                    data: count,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',

                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',

                    ],
                }],
                text: 'CO2',
                textposition: 'inside',

            },
            options: {

                legend: {
                    display: false,
                    position: "bottom"
                }

            }


        });
    </script>
    @endif

    <!-- untuk handle edit adm action -->
    @if($state=='edit_adm')
    <script>
        document.getElementById('cgfullname').onchange = function() {
            document.getElementById('name').disabled = !this.checked;
        };

        document.getElementById('cgemail').onchange = function() {
            document.getElementById('email').disabled = !this.checked;
        };

        document.getElementById('cgpass').onchange = function() {
            document.getElementById('password').disabled = !this.checked;
        };

        document.getElementById('cguserid').onchange = function() {
            document.getElementById('userid').disabled = !this.checked;
        };
    </script>
    @endif
</body>

</html>