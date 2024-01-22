<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <title>Invoice 1231231231212312312</title>

    <style>

        body{
            font-family: 'DejaVu Sans', sans-serif;
            margin: 40px;
        }
        .company p,h4{
            padding: 0;
            margin: 0;
        }
        .invoice{
            text-align: center;
            font-size: 30px;
        }

        .details p{
            margin: 5px;
        }
        .desc{
            margin-top: 10px;
            margin-bottom: 3px;
        }

    </style>

</head>
<body>
<div class="invoice"><h1>INVOICE </h1></div>
<div class="company">
    <h2>Budget Company</h2>
    <p>Mostowa 13</p>
    <p>Poznań</p>
    <p>60-001</p>
    <p>Poland</p>
    <p>budgetcomapny@email.com</p>
    <br>
</div>
<hr style="margin-bottom: 40px">

<div class="details">
    <h2>Number: {{$invoice->number}}</h2>
    <p>Issue Date: {{$invoice->issue_date}}</p>
    <p>Due Date: {{$invoice->due_date}}</p>
    <p>Title: {{$invoice->transaction->title}}</p>
    <p class="desc">Description:</p><p>
        {{$invoice->transaction->description}}
    </p>
</div>
<h3 style="text-align: center; margin-top: 60px">Total (PLN): {{number_format($invoice->transaction->amount, 2)}}</h3>

<p></p>
</body>
</html>
