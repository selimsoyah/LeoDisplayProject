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
    $type_base = $_POST['option3'];
    $q_base = $_POST['quantity3'];
    // $html = '<h1 style="color:green">Example</h1>';
    // $html .= "Hello <em> hello  </em>";
    // $html .='<img src="" alt="logo">';
    // $html .= "Type: $type $taille";

    

    $options = new Options;
    $options->setChroot(__DIR__);
    $options->setIsRemoteEnabled(true);


    $dompdf = new Dompdf($options);

    $dompdf->setPaper(array(0, 0, 283.4644, 283.4644), 'custom');

    $html = file_get_contents("template_pdf.html");

    $html = str_replace(["{{ type }}", "{{ taille }}", "{{ quantity }}", "{{ bare }}", "{{ q_base }}", "{{ type_base }}"], [$type, $taille, $quantity, $bare, $q_base, $type_base], $html);

    $dompdf->loadHtml($html); 

    $dompdf->render();

    $dompdf ->addInfo("Title", "An example PDF");

    $dompdf->stream("BAT.pdf", ["Attachment" => 0]);

    // $output = $dompdf->output();
    // file_put_contents("file.pdf", $output);



}

?>