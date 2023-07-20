<?php
    session_start();
    include('../server/connection.php');
    require __DIR__. "/../vendor/autoload.php";

    use Dompdf\Dompdf;
    use Dompdf\Options;

    
if(isset($_POST['download-bat'])){
    $type= $_POST['option1'];
    $taille= $_POST['option2'];
    $quantity= $_POST['quantity2'];
    $bare = $_POST['quantity5'];
    $base = $_POST['quantity3'];
    // $html = '<h1 style="color:green">Example</h1>';
    // $html .= "Hello <em> hello  </em>";
    // $html .='<img src="" alt="logo">';
    // $html .= "Type: $type $taille";

    

    $options = new Options;
    $options->setChroot(__DIR__);
    $options->setIsRemoteEnabled(true);


    $dompdf = new Dompdf($options);

    $dompdf -> setPaper("A4", "landscape");

    $html = file_get_contents("template_pdf.html");

    $html = str_replace(["{{ type }}", "{{ taille }}", "{{ quantity }}", "{{ bare }}", "{{ base }}"], [$type, $taille, $quantity, $bare, $base], $html);

    $dompdf->loadHtml($html); 

    $dompdf->render();

    $dompdf ->addInfo("Title", "An example PDF");

    $dompdf->stream("BAT.pdf", ["Attachment" => 0]);

    // $output = $dompdf->output();
    // file_put_contents("file.pdf", $output);



}

?>