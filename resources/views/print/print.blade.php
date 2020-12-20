<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.3.0/paper.css">
  <title>Document</title>
  <style>
    @page { size: A5 }
  </style>
</head>

<?php 
    use Milon\Barcode\Facades\DNS1DFacade;
?>

<body class="A5">
    <div class="container sheet padding-10mm">
        <div class="border border-secondary p-2 text-center">
            <p class="h1">NEDCO &nbsp; الوطنية للتوصيل السريع</p>
        </div>
        
        <div class="mt-3">
            <p class="h2"><span class="font-weight-bold">Sender Name:</span> &nbsp; {{ $order->SenderName }}</p>
        </div>
        
        <div class="mt-3">
            <p class="h2"><span class="font-weight-bold">Sender Number:</span> &nbsp; {{ $order->SenderNumber }}</p>
        </div>
            
        <div class="mt-3">
            <p class="h2"><span class="font-weight-bold">Recipient Name:</span> &nbsp; {{ $order->RecipientName }}</p>
        </div>
        
        <div class="mt-3">
            <p class="h2"><span class="font-weight-bold">Recipient Number:</span> &nbsp; {{ $order->RecipientNumber }}</p>
        </div>
        
        <div class="mt-3">
            <p class="h2"><span class="font-weight-bold">Region:</span> &nbsp; {{ $region->Region }}</p>
        </div>
        
        <div class="mt-3">
            <p class="h2"><span class="font-weight-bold">City:</span> &nbsp; {{ $order->city }}</p>
        </div>
        
        <div class="mt-3">
            <p class="h2"><span class="font-weight-bold">Destrict:</span> &nbsp; {{ $destrict->name }}</p>
        </div>
            
        <div class="mt-3">
            <p class="h2"><span class="font-weight-bold">Recipient Address:</span> &nbsp; {{ $order->RecipientAddress }}</p>
        </div>
        
        <div class="mt-3">
            <p class="h2"><span class="font-weight-bold">Item Price:</span> &nbsp; {{ $order->itemPrice }}</p>
        </div>
        
        <div class="mt-3">
            <p class="h2"><span class="font-weight-bold">Delivery Price:</span> &nbsp; {{ $order->deliveryPrice }}</p>
        </div>
            
        <div class="mt-3">
            <p class="h2"><span class="font-weight-bold">Total Price:</span> &nbsp; {{ $order->totalPrice }}</p>
        </div>
        
        <div class="mt-3">
            <p class="h2"><span class="font-weight-bold">Notes:</span> &nbsp; {{ $order->notes }}</p>
        </div>
        
        <div class="text-center">
            <?php 
                echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($order->barcode, 'C39+') . '" alt="barcode"   />';
            ?>
            <p class="h2 text-center">{{ $city->city_code }}{{ $order->barcode }}</p>
        </div>
    </div>
</body>
</html>