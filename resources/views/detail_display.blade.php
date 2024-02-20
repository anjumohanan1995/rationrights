<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>How to check disk space in laravel</title>
</head>
<body class="text-center mt-5">
    <h2 class="mb-5">How to check disk space in laravel</h2>
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h5>Disk Space</h5>
            <div class="progress progress-micro mb-10">
                <div class="progress-bar bg-indigo-500" style="width: {{$diskuse}}">
                    <span class="sr-only">{{$diskuse}}</span>
                </div>
            </div>
            <span class="pull-right">{{round($disk_used_size,2)}} GB / {{round($total_disk_size,2)}} GB ({{$diskuse}})</span>
        </div>
    </div>
</body>
</html>
