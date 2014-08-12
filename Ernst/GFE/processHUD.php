<?php
require '../PHPMailerAutoload.php';

header('P3P: CP="CAO PSA OUR"');
session_start();
ob_flush();

error_reporting(E_ALL ^ E_NOTICE);



//check box
if(isset($_POST['row'][395]))
{
	$check1='Yes';
}
else
{
	$check1='Off';
}

if(isset($_POST['row'][396]))
{
	$check2='Yes';
}
else
{
	$check2='Off';
}

if(isset($_POST['row'][397]))
{
	$check3='Yes';
}
else
{
	$check3='Off';
}

if(isset($_POST['row'][421]))
{
	$check4='Yes';
}
else
{
	$check4='Off';
}

if(isset($_POST['row'][422]))
{
	$check5='Yes';
}
else
{
	$check5='Off';
}

if(isset($_POST['row'][423]))
{
	$check6='Yes';
}
else
{
	$check6='Off';
}

if(isset($_POST['row'][424]))
{
	$check7='Yes';
}
else
{
	$check7='Off';
}

if(isset($_POST['row'][426]))
{
	$check8='Yes';
}
else
{
	$check8='Off';
}

if(isset($_POST['row'][428]))
{
	$check9='Yes';
}
else
{
	$check9='Off';
}
//HUD Output
$data = array (
//checkbox test
//everything else
//'Text426' => $_SESSION['row'][2],
'radio1'=>$_POST['row'][1],
'radio2' => $_POST['row'][146],
'radio3' => $_POST['row'][149],
'radio4' => $_POST['row'][398],
'radio5' => $_POST['row'][406],
'radio6' => $_POST['row'][408],
'radio7' => $_POST['row'][412],
'radio8' => $_POST['row'][414],
'radio9' => $_POST['row'][418],
'check1' => $check1,
'check2' => $check2,
'check3' => $check3,
'check4' => $check4,
'check5' => $check5,
'check6' => $check6,
'check7' => $check7,
'check8' => $check8,
'check9' => $check9,
'Text426' => $_POST['row'][2],
'Text427' => $_POST['row'][3],
'Text428' => $_POST['row'][4],
'Text429' => $_POST['row'][5],
'Text430' => $_POST['row'][6],
'Text431' => $_POST['row'][7],
'Text432' => $_POST['row'][8],
'Text433' => $_POST['row'][9],
'Text434' => $_POST['row'][10],
'Text435' => $_POST['row'][11],
'Text437' => $_POST['row'][12],
'Text510' => $_POST['row'][13],
'Text438' => $_POST['row'][14],
'Text511' => $_POST['row'][15],
'Text439' => $_POST['row'][16],
'Text513' => $_POST['row'][17],
'Text441' => $_POST['row'][18],
'Text515' => $_POST['row'][19],
'Text443' => $_POST['row'][20],
'Text517' => $_POST['row'][21],
'Text445' => $_POST['row'][24],
'Text446' => $_POST['row'][25],
'Text447' => $_POST['row'][26],
'Text519' => $_POST['row'][27],
'Text520' => $_POST['row'][28],
'Text521' => $_POST['row'][29],
'Text448' => $_POST['row'][30],
'Text449' => $_POST['row'][31],
'Text450' => $_POST['row'][32],
'Text522' => $_POST['row'][33],
'Text523' => $_POST['row'][34],
'Text524' => $_POST['row'][35],
'Text451' => $_POST['row'][36],
'Text452' => $_POST['row'][37],
'Text453' => $_POST['row'][38],
'Text525' => $_POST['row'][39],
'Text526' => $_POST['row'][40],
'Text527' => $_POST['row'][41],
'Text454' => $_POST['row'][42],
'Text455' => $_POST['row'][43],
'Text528' => $_POST['row'][44],
'Text529' => $_POST['row'][45],
'Text456' => $_POST['row'][46],
'Text457' => $_POST['row'][47],
'Text530' => $_POST['row'][48],
'Text531' => $_POST['row'][49],
'Text458' => $_POST['row'][50],
'Text459' => $_POST['row'][51],
'Text532' => $_POST['row'][52],
'Text533' => $_POST['row'][53],
'Text460' => $_POST['row'][54],
'Text461' => $_POST['row'][55],
'Text534' => $_POST['row'][56],
'Text535' => $_POST['row'][57],
'Text462' => $_POST['row'][58],
'Text536' => $_POST['row'][59],
'Text464' => $_POST['row'][62],
'Text538' => $_POST['row'][63],
'Text465' => $_POST['row'][64],
'Text539' => $_POST['row'][65],
'Text466' => $_POST['row'][66],
'Text540' => $_POST['row'][67],
'Text467' => $_POST['row'][68],
'Text468' => $_POST['row'][69],
'Text541' => $_POST['row'][70],
'Text469' => $_POST['row'][71],
'Text470' => $_POST['row'][72],
'Text542' => $_POST['row'][73],
'Text471' => $_POST['row'][74],
'Text472' => $_POST['row'][75],
'Text543' => $_POST['row'][76],
'Text544' => $_POST['row'][77],
'Text473' => $_POST['row'][78],
'Text474' => $_POST['row'][79],
'Text545' => $_POST['row'][80],
'Text546' => $_POST['row'][81],
'Text475' => $_POST['row'][82],
'Text476' => $_POST['row'][83],
'Text547' => $_POST['row'][84],
'Text548' => $_POST['row'][85],
'Text477' => $_POST['row'][86],
'Text478' => $_POST['row'][87],
'Text549' => $_POST['row'][88],
'Text550' => $_POST['row'][89],
'Text480' => $_POST['row'][92],
'Text481' => $_POST['row'][93],
'Text482' => $_POST['row'][94],
'Text552' => $_POST['row'][95],
'Text553' => $_POST['row'][96],
'Text554' => $_POST['row'][97],
'Text483' => $_POST['row'][98],
'Text484' => $_POST['row'][99],
'Text485' => $_POST['row'][100],
'Text555' => $_POST['row'][101],
'Text556' => $_POST['row'][102],
'Text557' => $_POST['row'][103],
'Text486' => $_POST['row'][104],
'Text487' => $_POST['row'][105],
'Text488' => $_POST['row'][106],
'Text558' => $_POST['row'][107],
'Text559' => $_POST['row'][108],
'Text560' => $_POST['row'][109],
'Text489' => $_POST['row'][110],
'Text490' => $_POST['row'][111],
'Text561' => $_POST['row'][112],
'Text562' => $_POST['row'][113],
'Text491' => $_POST['row'][114],
'Text492' => $_POST['row'][115],
'Text563' => $_POST['row'][116],
'Text564' => $_POST['row'][117],
'Text493' => $_POST['row'][118],
'Text494' => $_POST['row'][119],
'Text565' => $_POST['row'][120],
'Text566' => $_POST['row'][121],
'Text495' => $_POST['row'][122],
'Text496' => $_POST['row'][123],
'Text567' => $_POST['row'][124],
'Text568' => $_POST['row'][125],
'Text497' => $_POST['row'][126],
'Text498' => $_POST['row'][127],
'Text569' => $_POST['row'][128],
'Text570' => $_POST['row'][129],
'Text499' => $_POST['row'][130],
'Text500' => $_POST['row'][131],
'Text571' => $_POST['row'][132],
'Text572' => $_POST['row'][133],
'Text501' => $_POST['row'][134],
'Text502' => $_POST['row'][135],
'Text573' => $_POST['row'][136],
'Text574' => $_POST['row'][137],
'Text503' => $_POST['row'][138],
'Text575' => $_POST['row'][139],
'Text505' => $_POST['row'][142],
'Text577' => $_POST['row'][143],
'Text506' => $_POST['row'][144],
'Text578' => $_POST['row'][145],
'radio2' => $_POST['row'][146],
'Text509' => $_POST['row'][148],
'radio3' => $_POST['row'][149],
'Text581' => $_POST['row'][151],
'Text4' => $_POST['row'][152],
'Text582' => $_POST['row'][154],
'Text583' => $_POST['row'][155],
'Text589' => $_POST['row'][156],
'Text587' => $_POST['row'][157],
'Text588' => $_POST['row'][158],
'Text590' => $_POST['row'][159],
'Text591' => $_POST['row'][160],
'Text592' => $_POST['row'][161],
'Text593' => $_POST['row'][162],
'Text594' => $_POST['row'][165],
'Text595' => $_POST['row'][166],
'Text601' => $_POST['row'][171],
'Text603' => $_POST['row'][173],
'Text604' => $_POST['row'][175],
'Text606' => $_POST['row'][177],
'Text607' => $_POST['row'][179],
'Text609' => $_POST['row'][181],
'Text610' => $_POST['row'][183],
'Text612' => $_POST['row'][185],
'Text613' => $_POST['row'][187],
'Text615' => $_POST['row'][189],
'Text616' => $_POST['row'][190],
'Text618' => $_POST['row'][192],
'Text619' => $_POST['row'][193],
'Text621' => $_POST['row'][195],
'Text622' => $_POST['row'][196],
'Text624' => $_POST['row'][198],
'Text625' => $_POST['row'][199],
'Text627' => $_POST['row'][201],
'Text628' => $_POST['row'][202],
'Text629' => $_POST['row'][203],
'Text631' => $_POST['row'][205],
'Text633' => $_POST['row'][207],
'Text634' => $_POST['row'][208],
'Text635' => $_POST['row'][209],
'Text637' => $_POST['row'][211],
'Text638' => $_POST['row'][212],
'Text639' => $_POST['row'][213],
'Text641' => $_POST['row'][215],
'Text642' => $_POST['row'][216],
'Text645' => $_POST['row'][219],
'Text647' => $_POST['row'][221],
'Text648' => $_POST['row'][222],
'Text649' => $_POST['row'][223],
'Text7' => $_POST['row'][224],
'Text652' => $_POST['row'][226],
'Text653' => $_POST['row'][227],
'Text654' => $_POST['row'][228],
'Text657' => $_POST['row'][231],
'Text658' => $_POST['row'][232],
'Text659' => $_POST['row'][233],
'Text662' => $_POST['row'][236],
'Text663' => $_POST['row'][237],
'Text664' => $_POST['row'][238],
'Text667' => $_POST['row'][241],
'Text668' => $_POST['row'][242],
'Text669' => $_POST['row'][243],
'Text673' => $_POST['row'][248],
'Text677' => $_POST['row'][251],
'Text679' => $_POST['row'][253],
'Text680' => $_POST['row'][254],
'Text682' => $_POST['row'][256],
'Text683' => $_POST['row'][257],
'Text684' => $_POST['row'][258],
'Text686' => $_POST['row'][260],
'Text687' => $_POST['row'][261],
'Text690' => $_POST['row'][264],
'Text693' => $_POST['row'][267],
'Text696' => $_POST['row'][270],
'Text697' => $_POST['row'][271],
'Text700' => $_POST['row'][274],
'Text701' => $_POST['row'][275],
'Text704' => $_POST['row'][278],
'Text705' => $_POST['row'][279],
'Text706' => $_POST['row'][280],
'Text707' => $_POST['row'][281],
'Text708' => $_POST['row'][282],
'Text709' => $_POST['row'][283],
'Text710' => $_POST['row'][284],
'Text711' => $_POST['row'][285],
'Text712' => $_POST['row'][286],
'Text714' => $_POST['row'][288],
'Text716' => $_POST['row'][290],
'Text717' => $_POST['row'][291],
'Text718' => $_POST['row'][292],
'Text720' => $_POST['row'][294],
'Text722' => $_POST['row'][296],
'Text724' => $_POST['row'][299],
'Text725' => $_POST['row'][300],
'Text727' => $_POST['row'][302],
'Text728' => $_POST['row'][304],
'Text729' => $_POST['row'][305],
'Text731' => $_POST['row'][307],
'Text732' => $_POST['row'][308],
'Text733' => $_POST['row'][309],
'Text734' => $_POST['row'][310],
'Text735' => $_POST['row'][312],
'Text737' => $_POST['row'][314],
'Text738' => $_POST['row'][315],
'Text739' => $_POST['row'][316],
'Text740' => $_POST['row'][317],
'Text741' => $_POST['row'][318],
'Text742' => $_POST['row'][319],
'Text743' => $_POST['row'][320],
'Text744' => $_POST['row'][321],
'Text745' => $_POST['row'][322],
'Text746' => $_POST['row'][323],
'Text747' => $_POST['row'][324],
'Text748' => $_POST['row'][325],
'Text749' => $_POST['row'][326],
'Text750' => $_POST['row'][327],
'Text751' => $_POST['row'][328],
'Text752' => $_POST['row'][329],
'Text753' => $_POST['row'][330],
'Text754' => $_POST['row'][331],
'Text755' => $_POST['row'][332],
'Text756' => $_POST['row'][333],
'Text757' => $_POST['row'][334],
'Text758' => $_POST['row'][335],
'Text759' => $_POST['row'][336],
'Text760' => $_POST['row'][337],
'Text761' => $_POST['row'][338],
'Text762' => $_POST['row'][339],
'Text763' => $_POST['row'][340],
'Text764' => $_POST['row'][341],
'Text765' => $_POST['row'][342],
'Text766' => $_POST['row'][343],
'Text767' => $_POST['row'][344],
'Text768' => $_POST['row'][345],
'Text769' => $_POST['row'][346],
'Text770' => $_POST['row'][347],
'Text771' => $_POST['row'][348],
'Text772' => $_POST['row'][349],
'Text773' => $_POST['row'][350],
'Text774' => $_POST['row'][351],
'Text775' => $_POST['row'][352],
'Text776' => $_POST['row'][353],
'Text777' => $_POST['row'][354],
'Text778' => $_POST['row'][355],
'Text779' => $_POST['row'][356],
'Text780' => $_POST['row'][357],
'Text781' => $_POST['row'][358],
'Text782' => $_POST['row'][359],
'Text783' => $_POST['row'][360],
'Text784' => $_POST['row'][361],
'Text785' => $_POST['row'][362],
'Text786' => $_POST['row'][363],
'Text787' => $_POST['row'][364],
'Text788' => $_POST['row'][365],
'Text789' => $_POST['row'][366],
'Text790' => $_POST['row'][367],
'Text791' => $_POST['row'][368],
'Text792' => $_POST['row'][369],
'Text793' => $_POST['row'][370],
'Text794' => $_POST['row'][371],
'Text795' => $_POST['row'][372],
'Text796' => $_POST['row'][373],
'Text797' => $_POST['row'][374],
'Text798' => $_POST['row'][375],
'Text799' => $_POST['row'][376],
'Text800' => $_POST['row'][377],
'Text801' => $_POST['row'][378],
'Text802' => $_POST['row'][379],
'Text803' => $_POST['row'][380],
'Text804' => $_POST['row'][381],
'Text805' => $_POST['row'][382],
'Text806' => $_POST['row'][383],
'Text807' => $_POST['row'][384],
'Text808' => $_POST['row'][385],
'Text809' => $_POST['row'][386],
'Text810' => $_POST['row'][387],
'Text811' => $_POST['row'][388],
'Text812' => $_POST['row'][389],
'Text813' => $_POST['row'][390],
'Text814' => $_POST['row'][391],
'Text815' => $_POST['row'][392],
'Text816' => $_POST['row'][393],
'Text817' => $_POST['row'][394],
'Text823' => $_POST['row'][399],
'Text824' => $_POST['row'][400],
'Text825' => $_POST['row'][401],
'Text826' => $_POST['row'][402],
'Text827' => $_POST['row'][403],
'Text828' => $_POST['row'][404],
'Text829' => $_POST['row'][405],
'Text832' => $_POST['row'][407],
'Text835' => $_POST['row'][409],
'Text836' => $_POST['row'][410],
'Text837' => $_POST['row'][411],
'Text840' => $_POST['row'][413],
'Text843' => $_POST['row'][415],
'Text844' => $_POST['row'][416],
'Text845' => $_POST['row'][417],
'Text854' => $_POST['row'][419],
'Text855' => $_POST['row'][420],
'Text2' => $_POST['row'][425],
'Text5' => $_POST['row'][427],
'Text6' => $_POST['row'][429],
'Text512' => $_POST['row'][430],
'Text440' => $_POST['row'][431],
'Text514' => $_POST['row'][432],
'Text442' => $_POST['row'][433],
'Text516' => $_POST['row'][434],
'Text584' => $_POST['row'][435],
'Text585' => $_POST['row'][436]);

	$EmailAddress=$_SESSION['Username'];

     //   if ($PrintHUD<>"" ){
     //   $insert = "INSERT INTO `HUD_Generation`(`State`,`SearchType`, `Username`) VALUES ('".$state."','GFE','".$_SESSION['Username']."')";
     //   mysql_query($insert);

	// #Implement
	$pdf_file_url = 'http://www.lssoftwaresolutions.com/Live/Demo/HUD1.pdf';
	//$xfdf = createXFDF( $pdf_file_url, $data );

if(isset($_POST['EmailHUD'])) {

	$_SESSION['EmailHUD']="Yes";

	
//Log Email sent

$insert = "INSERT INTO `Email_Print`(`Username`,`SearchType`,`State`,`LoanType`,`Email` ) VALUES
('".$results['Username']."','".$Search_Type."','".$results['state']."','".$purchase."','".$_POST['EmailQuote']."')";

mysql_query($insert);    

	
    output_fdf($pdf_file_url,$data,'y');


    //Create a new PHPMailer instance
	$mail = new PHPMailer();
	// Set PHPMailer to use the sendmail transport
	$mail->isSendmail();
	//Set who the message is to be sent from
	$mail->setFrom($client_email);
	//Set an alternative reply-to address
	//$mail->addReplyTo('replyto@example.com', 'First Last');

        //Set who the message is to be sent to
        $mail->addAddress($EmailAddress);

        //Set the subject line
	$mail->Subject = 'GFE Calculations: '.$_SESSION['state'].' '.$_SESSION['loantype'];

	$mail->Body = '<table><tr><td>&nbsp;</td><td>&nbsp;</td></tr>'.
	'<tr><td>Buyer</td><td>'.$_SESSION['buyer'].'</td></tr>'.
	'<tr><td>Seller</td><td>'.$_SESSION['seller'].'</td></tr>'.
	'<tr><td>Address</td><td>'.$_SESSION['address'].'</td></tr>'.
	'<tr><td>&nbsp;</td><td>&nbsp;</td></tr>'.
	'<tr><td>Sales Price</td><td>'.PrettyPrint($_SESSION['purchase_price']).'</td></tr>'.
	'<tr><td>Loan Amount</td><td>'.PrettyPrint($_SESSION['loan_amount']).'</td></tr>'.
	'<tr><td>Interest Rate</td><td>'.$_SESSION['InterestRate'].'%'.'</td></tr>'.
	'<tr><td>Loan Term</td><td>'.$_SESSION['LoanTerm'].' Years'.'</td></tr>'.
	'<tr><td>&nbsp;</td><td>&nbsp;</td></tr>'.
	'<tr><td colspan="2" style="text-align: center"><b>Monthly Payments</b></td></tr>'.
	'<tr><td>Principle & Interest Payment</td><td>'.PrettyPrint($_SESSION['MortgagePayment']).'</td></tr>'.
	'<tr><td>Taxes</td><td>'.PrettyPrint($_SESSION['MonthlyTaxes']).'</td></tr>'.
	'<tr><td>Home Owners Insurance</td><td>'.PrettyPrint($_SESSION['MonthlyHomeowners']).'</td></tr>'.
	'<tr><td>PMI (If Applicable)</td><td>'.PrettyPrint($_SESSION['MonthlyPMI']).'</td></tr>'.
	'<tr><td><b>Total Monthly Payment</b></td><td><b>'.PrettyPrint($_SESSION['MonthlyPayment']).'</b></td></tr>'.
	'<tr><td>&nbsp;</td><td>&nbsp;</td></tr>'.
	'<tr><td colspan="2" style="text-align: center"><b>Cash to Close</b></td></tr>'.
	'<tr><td>Deposit</td><td>'.PrettyPrint($_SESSION['deposit']).'</td></tr>'.
	'<tr><td>Cash at Closing</td><td>'.PrettyPrint($_SESSION['Closing_Costs']).'</td></tr>'.
	'<tr><td><b>**Total Cash to Close</b></td><td><b>'.PrettyPrint($_SESSION['Closing_Costs'] + $_SESSION['deposit']).'</b></td></tr>'.
	'<tr><td colspan="2"><i>**Does not include adjustments between buyer and seller at closing</i></td></tr>'.
	'<tr><td>&nbsp;</td><td>&nbsp;</td></tr></table>';


        $mail->AltBody = 'Your GFE results are attached.';
	$string = file_get_contents('HUD1.pdf');
	$mail->AddStringAttachment($string, 'HUD1.pdf', $encoding = 'base64', $type = 'application/pdf');

        if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
	}
    } // End Email Quote Code

else{
	output_fdf($pdf_file_url, $data);
}

function form_spaces ($form_values){
  //remove "_" form submit put into array and add " " space to match PDF form objects
  $temp = explode("_",$form_values);
  $form_values = $temp[0];
  $array_count = count($temp);
  for ( $count = 1; $count < $array_count ; $count++ ) {
    $form_values.= " ".$temp[$count];
  }
  return $form_values;
}
	//window.location = 'HUD1.pdf';}

function output_fdf ($pdf_file, $pdf_data, $emailNeeded = "n") {

$fdf  = "%FDF-1.2\n\n";
$fdf .= "1 0 obj\n";
$fdf .= "<< /FDF << /Fields [\n";

foreach ($pdf_data as $key => $val) {
$key = form_spaces($key);
$fdf .= "<< /V ($val)/T ($key) >>\n";
}

$fdf .= "]/F ($pdf_file) >>\n";
$fdf .= ">>\nendobj\ntrailer\n";
$fdf .= "<</Root 1 0 R >>\n";
$fdf .= "%%EOF";
	if($emailNeeded === "n"){
	$fh = fopen("HUD1.fdf","w");
	$fdf_name = "HUD1.fdf";
	if ($fh){
	fwrite($fh,$fdf);
	//echo "File Written";
	fclose($fh);
	// echo "File Closed";

	header("Content-Type: application/force-download");
	header("Content-Disposition: attachment; filename=HUD1.pdf");
	passthru("/usr/bin/pdftk $pdf_file fill_form $fdf_name output - ");
	exit;
	}
	 else{  echo "File Could Not Be Opened"; } }
	else{
	$fp = fopen("php://temp", 'r+');
	fwrite($fp, $fdf);
	rewind($fp);
	$command = "/usr/bin/pdftk $pdf_file fill_form - output HUD1.pdf";
	$descriptorspec = array(
    0 => $fp, // feed stdin of process from this file descriptor
	//    1 => array('pipe', 'w'), // Note you can also grab stdout from a pipe, no need for temp file
	);
	$prochandle = proc_open($command, $descriptorspec, $pipes);
	// busy-wait until it finishes running
	do {
    usleep(10000);
    $stat = proc_get_status($prochandle);
	} while ($stat and $stat['running']);


	// cleanup
foreach ($pipes as $pipe) {
   fclose($pipe);
}
proc_close($prochandle);

	}
}// End output fdf

//HTML Body
echo "<!DOCTYPE html>";
echo "<html><head><style>";
echo "body { background: #efeee9; }";
echo "html, body { font-family: 'Lucida Grande',arial; font-size: 12px; }";
echo "p {text-indent: 50;}";
echo "</style></head>";
echo "<body>";
echo "<meta http-equiv='refresh' content='0;URL=HUD.php'/>";
echo "</body></html>";

 
function PrettyPrint($number){
    if(isset($number) && $number>=0){    return "$".number_format($number);}
    else {return;}
}//End PrettyPrint()

function SessionClear($name){
    for($i=0;$i<437;$i++){
        $_SESSION[$name][$i]="";
       }
}//end SessionClear()

?>