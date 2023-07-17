<?php
    session_start();
    include('../server/connection.php');
    require __DIR__. "/../vendor/autoload.php";

    use Dompdf\Dompdf;
    use Dompdf\Options;

    
if(isset($_POST['generate'])){
    $option= $_POST['option1'];
    $html = '<h1 style="color:green">Example</h1>';
    $html .= "Hello <em> hello  </em>";
    $html .='<img src="" alt="logo">';
    $html .= "Quantity: ";
    $html .= $option;

    $options = new Options;
    // $options = setChroot(__DIR__);


    $dompdf = new Dompdf($options);

    $dompdf -> setPaper("A4", "landscape");

    $dompdf->loadHtml($html); 

    $dompdf->render();

    $dompdf ->addInfo("Title", "An example PDF");

    $dompdf->stream("BAT.pdf", ["Attachment" => 0]);



}

?>