<?php
header('P3P: CP="CAO PSA OUR"');
session_start();
include('les_config.php');
if(!empty($_SESSION['Username']) && $_SESSION['LoggedIn'] == 1)  
{
  ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<?php
if(preg_match('/(?i)msie [7-8]/',$_SERVER['HTTP_USER_AGENT'])==1)
{
?>
<link rel="stylesheet" href="css/GFE_old.css" type="text/css" />
<style>li{float:left;display:inline;}</style>
<?php
}
else{
?>
<link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
<?php
}
?>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<?php
if(isset($_SESSION['state'])){echo '<script>$("document").ready(function(){$("#state").val("'.$_SESSION['state'].'");})</script>';}
if(isset($_SESSION['county'])){echo '<script>$("document").ready(function(){$("#county").val("'.$_SESSION['county'].'");})</script>';}
if(isset($_SESSION['township'])){echo '<script>$("document").ready(function(){$("#township").val("'.$_SESSION['township'].'");})</script>';}
?>
<!-- <link rel="stylesheet" href="stylesheets/datepicker.css" />   -->
<script>$(function() {    $( "#datepicker" ).datepicker();  });  </script>
<!--[if lt IE 9]>
<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
<script src="js/respond.js"></script>
<![endif]-->
<script>
//
//function addOption(value, text ) {
//  var optn = document.createElement("OPTION");
//  optn.text = text;
//  optn.value = value;
//  document.CALC.county.options.add(optn);
//}
//
//function addTownship(value, text ) {
//  var optn = document.createElement("OPTION");
//  optn.text = text;
//  optn.value = value;
//  document.CALC.township.options.add(optn);
//}
//
//function removeAllOptions()
//{
//while(document.CALC.county.options.length >0)
//{document.CALC.county.remove(0);}
//}
//
//function clearTownships()
//{
//while(document.CALC.township.options.length >0)
//{document.CALC.township.remove(0);}
//}


function fetchcounties(state){
        $.ajax({
                 url:"fetchcounty.php",
                 type: "post",
                 async:false,
                 data:{
                    'state':state
                    },
                 success: function(data) 
	        {
                 $("#county").html(data);
                 fetchtownships($('#county').val(),$('#state').val());
                 
	        }});
        
        
    }
    
    function fetchtownships(county,state){
        
        $.ajax({
                 url:"fetchtownship.php",
                 type: "post",
                 async:false,
                 data:{
                    'county':county,
                    'state': state
                    },
                 success: function(data) 
	        {
                 $("#township").html(data);
	        }});
        
        
    }

function OrderTitle()
{
if (document.CALC.state.value == "NJ" || document.CALC.state.value == "NY"){ window.location = "ordertitle_nj.php";}
else {window.location = "ordertitle.php";}
                  
}

//
//function townSwitch(){
//  switch(document.CALC.state.value){
//    
//      case "CA":
//            clearTownships();
//              switch(document.CALC.county.value){
//                case "Alameda":
//                  clearTownships();
//                  addTownship('Albany','Albany');
//                  addTownship('Oakland','Oakland');
//                  addTownship('Berkeley','Berkeley');
//                  addTownship('Alameda','Alameda');
//                  addTownship('San Leandro','San Leandro');
//                  addTownship('Hayward','Hayward');
//                  addTownship('Piedmont','Piedmont');
//                  addTownship('NA','All Other Townships');
//                break;
//                
//                case "Contra Costa":
//                  clearTownships();
//                  addTownship('Richmond','Richmond');
//                  addTownship('NA','All Other Townships');
//                  break;
//                
//                case "Los Angeles":
//                  clearTownships();
//                  addTownship('Culver City','Culver City');
//                  addTownship('Los Angeles','Los Angeles');
//                  addTownship('Pomona','Pomona');
//                  addTownship('Redondo Beach','Redondo Beach');
//                  addTownship('Santa Monica','Santa Monica');
//                  addTownship('NA','All Other Townships');
//                  break;
//                
//                case "Marin":
//                  clearTownships();
//                  addTownship('San Rafael','San Rafael');
//                  addTownship('NA','All Other Townships');
//                  break;                  
//               
//                case "Riverside":
//                  clearTownships();
//                  addTownship('Riverside','Riverside');
//                  addTownship('NA','All Other Townships');
//                  break;
//                
//                case "Sacramento":
//                  clearTownships();
//                  addTownship('Sacramento','Sacramento');
//                  addTownship('NA','All Other Townships');
//                  break;
//                
//                case "San Mateo":
//                  clearTownships();
//                  addTownship('San Mateo','San Mateo');
//                  addTownship('NA','All Other Townships');
//                  break;
//                
//                case "Santa Clara":
//                  clearTownships();
//                  addTownship('Palo Alto','Palo Alto');
//                  addTownship('San Jose','San Jose');
//                  addTownship('Mountain View','Mountain View');
//                  addTownship('NA','All Other Townships');
//                  break;
//                
//                case "Solano":
//                  clearTownships();
//                  addTownship('Vallejo','Vallejo');
//                  addTownship('NA','All Other Townships');
//                  break;
//                
//                case "Sonoma":
//                  clearTownships();
//                  addTownship('Santa Rosa','Santa Rosa');
//                  addTownship('Petaluma','Petaluma');
//                  addTownship('NA','All Other Townships');
//                  break;
//                
//                case "Yolo":
//                  clearTownships();
//                  addTownship('Woodland','Woodland');
//                  addTownship('NA','All Other Townships');
//                  break;
//                  
//              default:
//               clearTownships();
//               addTownship('NA','All Townships');
//
//              }//end switch
//      break; //End CA
//    
//              case "CO":
//                clearTownships();
//              switch(document.CALC.county.value){
//                  case "Eagle":
//                    clearTownships();
//                    addTownship('Vail','Vail');
//                    addTownship('Avon','Avon');
//                    addTownship('Gypsum','Gypsum');
//                    addTownship('Minturn','Minturn');
//                    addTownship('NA','All Other Townships');  
//                  break;
// 
//                  case "Grand":
//                    clearTownships();
//                    addTownship('Winter Park','Winter Park');
//                    addTownship('NA','All Other Townships');  
//                  break;
// 
//                  case "Gunnison":
//                    clearTownships();
//                    addTownship('Crested Butte','Crested Butte');
//                    addTownship('NA','All Other Townships');  
//                  break;
// 
//                  case "Pitkin":
//                    clearTownships();
//                    addTownship('Aspen','Aspen');
//                    addTownship('Snowmass Village','Snowmass Village');
//                    addTownship('NA','All Other Townships');  
//                  break;
// 
//                  case "San Miguel":
//                    clearTownships();
//                    addTownship('Ophir','Ophir');
//                    addTownship('Telluride','Telluride');
//                    addTownship('NA','All Other Townships');  
//                  break;
// 
//                  case "Summit":
//                    clearTownships();
//                    addTownship('Breckenridge','Breckenridge');
//                    addTownship('Frisco','Frisco');
//                    addTownship('NA','All Other Townships');  
//                  break;
// 
//               default:
//               clearTownships();
//               addTownship('NA','All Townships');
//
//              }//end switch
//            break; //End CO
//    
//          case "CT":
//            clearTownships();
//
//              switch(document.CALC.county.value){
//                case "fairfield":
//                    clearTownships();
//                    addTownship('bethel','Bethel');
//                    addTownship('bridgeport','Bridgeport');
//                    addTownship('brookfield','Brookfield');
//                    addTownship('danbury','Danbury');
//                    addTownship('darien','Darien');
//                    addTownship('easton','Easton');
//                    addTownship('fairfield','Fairfield');
//                    addTownship('greenwich','Greenwich');
//                    addTownship('monroe','Monroe');
//                    addTownship('newcanaan','New Canaan');
//                    addTownship('newfairfield','New Fairfield');
//                    addTownship('newtown','Newtown');
//                    addTownship('norwalk','Norwalk');
//                    addTownship('redding','Redding');
//                    addTownship('ridgefield','Ridgefield');
//                    addTownship('shelton','Shelton');
//                    addTownship('sherman','Sherman');
//                    addTownship('stamford','Stamford');
//                    addTownship('stratford','Stratford');
//                    addTownship('trumbull','Trumbull');
//                    addTownship('weston','Weston');
//                    addTownship('westport','Westport');
//                    addTownship('wilton','Wilton');
//                    addTownship('NA','All Other Townships');
//                  break;
//
//                case "hartford":
//                    clearTownships();
//                    addTownship('avon','Avon');
//                    addTownship('berlin','Berlin');
//                    addTownship('bloomfield','Bloomfield');
//                    addTownship('bristol','Bristol');
//                    addTownship('burlington','Burlington');
//                    addTownship('canton','Canton');
//                    addTownship('eastgranby','East Granby');
//                    addTownship('easthartford','East Hartford');
//                    addTownship('eastwindsor','East Windsor');
//                    addTownship('enfield','Enfield');
//                    addTownship('farmington','Farmington');
//                    addTownship('glastonbury','Glastonbury');
//                    addTownship('granby','Granby');
//                    addTownship('hartford','Hartford');
//                    addTownship('hartland','Hartland');
//                    addTownship('manchester','Manchester');
//                    addTownship('marlborough','Marlborough');
//                    addTownship('newbritain','New Britain');
//                    addTownship('newington','Newington');
//                    addTownship('plainville','Plainville');
//                    addTownship('rockyhill','Rocky Hill');
//                    addTownship('simsbury','Simsbury');
//                    addTownship('southwindsor','South Windsor');
//                    addTownship('southington','Southington');
//                    addTownship('suffield','Suffield');
//                    addTownship('westhartford','West Hartford');
//                    addTownship('wethersfield','Wethersfield');
//                    addTownship('windsor','Windsor');
//                    addTownship('windsorlocks','Windsor Locks');
//                    addTownship('NA','All Other Townships');
//                break;
//              
//                case "litchfield":
//                    clearTownships();
//                    addTownship('barkhamsted','Barkhamsted');
//                    addTownship('bethlehem','Bethlehem');
//                    addTownship('bridgewater','Bridgewater');
//                    addTownship('canaan','Canaan');
//                    addTownship('colebrook','Colebrook');
//                    addTownship('cornwall','Cornwall');
//                    addTownship('goshen','Goshen');
//                    addTownship('harwinton','Harwinton');
//                    addTownship('kent','Kent');
//                    addTownship('lisbon','Lisbon');
//                    addTownship('litchfield','Litchfield');
//                    addTownship('morris','Morris');
//                    addTownship('newhartford','New Hartford');
//                    addTownship('newmilford','New Milford');
//                    addTownship('norfolk','Norfolk');
//                    addTownship('northcanaan','North Canaan');
//                    addTownship('plymouth','Plymouth');
//                    addTownship('roxbury','Roxbury');
//                    addTownship('salisbury','Salisbury');
//                    addTownship('sharon','Sharon');
//                    addTownship('thomaston','Thomaston');
//                    addTownship('torrington','Torrington');
//                    addTownship('warren','Warren');
//                    addTownship('washington','Washington');
//                    addTownship('watertown','Watertown');
//                    addTownship('winchester','Winchester');
//                    addTownship('woodbury','Woodbury');
//                    addTownship('NA','All Other Townships');
//                  break;
//                
//                case "middlesex":
//                    clearTownships();
//                    addTownship('chester','Chester');
//                    addTownship('clinton','Clinton');
//                    addTownship('cromwell','Cromwell');
//                    addTownship('deepriver','Deep River');
//                    addTownship('durham','Durham');
//                    addTownship('easthaddam','East Haddam');
//                    addTownship('easthampton','East Hampton');
//                    addTownship('essex','Essex');
//                    addTownship('haddam','Haddam');
//                    addTownship('killingworth','Killingworth');
//                    addTownship('middlefield','Middlefield');
//                    addTownship('middletown','Middletown');
//                    addTownship('oldsaybrook','Old Saybrook');
//                    addTownship('portland','Portland');
//                    addTownship('westbrook','Westbrook');
//                    addTownship('NA','All Other Townships');
//                  break;
//                
//                case "newhaven":
//                    clearTownships();
//                    addTownship('ansonia','Ansonia');
//                    addTownship('beaconfalls','Beacon Falls');
//                    addTownship('bethany','Bethany');
//                    addTownship('branford','Branford');
//                    addTownship('cheshire','Cheshire');
//                    addTownship('derby','Derby');
//                    addTownship('easthaven','East Haven');
//                    addTownship('guilford','Guilford');
//                    addTownship('hamden','Hamden');
//                    addTownship('madison','Madison');
//                    addTownship('meriden','Meriden');
//                    addTownship('middlebury','Middlebury');
//                    addTownship('milford','Milford');
//                    addTownship('naugatuck','Naugatuck');
//                    addTownship('newhaven','New Haven');
//                    addTownship('northbranford','North Branford');
//                    addTownship('northhaven','North Haven');
//                    addTownship('orange','Orange');
//                    addTownship('oxford','Oxford');
//                    addTownship('prospect','Prospect');
//                    addTownship('seymour','Seymour');
//                    addTownship('southbury','Southbury');
//                    addTownship('wallingford','Wallingford');
//                    addTownship('waterbury','Waterbury');
//                    addTownship('westhaven','West Haven');
//                    addTownship('wolcott','Wolcott');
//                    addTownship('woodbridge','Woodbridge');
//                    addTownship('NA','All Other Townships');
//                  break;
//
//                case "newlondon":
//                  clearTownships();
//                  addTownship('bozrah','Bozrah');
//                  addTownship('colchester','Colchester');
//                  addTownship('eastlyme','East Lyme');
//                  addTownship('franklin','Franklin');
//                  addTownship('griswold','Griswold');
//                  addTownship('groton','Groton');
//                  addTownship('lebanon','Lebanon');
//                  addTownship('ledyard','Ledyard');
//                  addTownship('lyme','Lyme');
//                  addTownship('montville','Montville');
//                  addTownship('newlondon','New London');
//                  addTownship('northstonington','North Stonington');
//                  addTownship('norwich','Norwich');
//                  addTownship('oldlyme','Old Lyme');
//                  addTownship('preston','Preston');
//                  addTownship('salem','Salem');
//                  addTownship('sprague','Sprague');
//                  addTownship('stonington','Stonington');
//                  addTownship('voluntown','Voluntown');
//                  addTownship('waterford','Waterford');
//                  addTownship('NA','All Other Townships');
//                break;
//
//                case "tolland":
//                  clearTownships();
//                  addTownship('andover','Andover');
//                  addTownship('bolton','Bolton');
//                  addTownship('columbia','Columbia');
//                  addTownship('coventry','Coventry');
//                  addTownship('ellington','Ellington');
//                  addTownship('hebron','Hebron');
//                  addTownship('mansfield','Mansfield');
//                  addTownship('somers','Somers');
//                  addTownship('stafford','Stafford');
//                  addTownship('tolland','Tolland');
//                  addTownship('union','Union');
//                  addTownship('vernon','Vernon');
//                  addTownship('willington','Willington');
//                  addTownship('NA','All Other Townships');
//                break;
//                
//                case "windham":
//                  clearTownships();
//                  addTownship('ashford','Ashford');
//                  addTownship('brooklyn','Brooklyn');
//                  addTownship('canterbury','Canterbury');
//                  addTownship('chaplin','Chaplin');
//                  addTownship('eastford','Eastford');
//                  addTownship('hampton','Hampton');
//                  addTownship('killingly','Killingly');
//                  addTownship('plainfield','Plainfield');
//                  addTownship('pomfret','Pomfret');
//                  addTownship('putnam','Putnam');
//                  addTownship('scotland','Scotland');
//                  addTownship('sterling','Sterling');
//                  addTownship('thompson','Thompson');
//                  addTownship('windham','Windham');
//                  addTownship('woodstock','Woodstock');
//                  addTownship('NA','All Other Townships');
//                break;
//                
//              default:
//                clearTownships();
//                addTownship('All Townships','All Townships');
//              }//end CT switch
//          break;
//          
//         case "DE":
//            clearTownships();
//
//              switch(document.CALC.county.value){
//                case "kent":
//                  clearTownships();
//                  addTownship('Bowers','Bowers');
//                  addTownship('Camden','Camden');
//                  addTownship('Cheswold','Cheswold');
//                  addTownship('Clayton','Clayton');
//                  addTownship('Dover','Dover');
//                  addTownship('Farmington','Farmington');
//                  addTownship('Felton','Felton');
//                  addTownship('Frederica','Frederica');
//                  addTownship('Harrington','Harrington');
//                  addTownship('Hartly','Hartly');
//                  addTownship('Houston','Houston');
//                  addTownship('Kenton','Kenton');
//                  addTownship('Leipsic','Leipsic');
//                  addTownship('Little Creek','Little Creek');
//                  addTownship('Magnolia','Magnolia');
//                  addTownship('Milford','Milford');
//                  addTownship('Smyrna','Smyrna');
//                  addTownship('Viola','Viola');
//                  addTownship('Woodside','Woodside');
//                  addTownship('Wyoming','Wyoming');
//                  addTownship('NA','All Other Townships');
//                  break;
//
//                case "newcastle":
//                  clearTownships();
//                  addTownship('Arden','Arden');
//                  addTownship('Ardencroft','Ardencroft');
//                  addTownship('Ardentown','Ardentown');
//                  addTownship('Bellefonte','Bellefonte');
//                  addTownship('Clayton','Clayton');
//                  addTownship('Delaware City','Delaware City');
//                  addTownship('Elsmere','Elsmere');
//                  addTownship('Middletown','Middletown');
//                  addTownship('New Castle','New Castle');
//                  addTownship('Newark','Newark');
//                  addTownship('Newport','Newport');
//                  addTownship('Odessa','Odessa');
//                  addTownship('Smyrna','Smyrna');
//                  addTownship('Townsend','Townsend');
//                  addTownship('Wilmington','Wilmington');
//                  addTownship('NA','All Other Townships');
//                  break;
//
//                case "sussex":
//                  clearTownships();
//                  addTownship('Bethany Beach','Bethany Beach');
//                  addTownship('Bethel','Bethel');
//                  addTownship('Blades','Blades');
//                  addTownship('Bridgeville','Bridgeville');
//                  addTownship('Dagsboro','Dagsboro');
//                  addTownship('Delmar','Delmar');
//                  addTownship('Dewey Beach','Dewey Beach');
//                  addTownship('Ellendale','Ellendale');
//                  addTownship('Fenwick Island','Fenwick Island');
//                  addTownship('Frankford','Frankford');
//                  addTownship('Georgetown','Georgetown');
//                  addTownship('Greenwood','Greenwood');
//                  addTownship('Henlopen Acres','Henlopen Acres');
//                  addTownship('Laurel','Laurel');
//                  addTownship('Lewes','Lewes');
//                  addTownship('Milford','Milford');
//                  addTownship('Millsboro','Millsboro');
//                  addTownship('Millville','Millville');
//                  addTownship('Milton','Milton');
//                  addTownship('Ocean View','Ocean View');
//                  addTownship('Rehoboth Beach','Rehoboth Beach');
//                  addTownship('Seaford','Seaford');
//                  addTownship('Selbyville','Selbyville');
//                  addTownship('Slaughter Beach','Slaughter Beach');
//                  addTownship('South Bethany','South Bethany');
//                  addTownship('NA','All Other Townships');
//                  break;
//
//                default:
//                  clearTownships();
//                  addTownship('NA','All Townships');
//
//              }//end switch
//      break;
//
//              case "IA":
//                clearTownships();
//                
//              switch(document.CALC.county.value){
//                  case "Lee":
//                    clearTownships();
//                    addTownship('Northern District','Northern District');
//                    addTownship('Southern District','Southern District');
//                  break;
// 
//               default:
//               clearTownships();
//               addTownship('NA','All Townships');
//
//              }//end switch
//             break; //End IA
//            
//              case "IL":
//                clearTownships();
//              switch(document.CALC.county.value.toLowerCase()){
//                  case "cook":
//                    clearTownships();
//                    addTownship('Alsip','Alsip');
//                    addTownship('Bartlett','Bartlett');
//                    addTownship('Bedford Park','Bedford Park');
//                    addTownship('Bellwood','Bellwood');
//                    addTownship('Berkeley','Berkeley');
//                    addTownship('Berwyn','Berwyn');
//                    addTownship('Buffalo Grove','Buffalo Grove');
//                    addTownship('Burbank','Burbank');
//                    addTownship('Burnham','Burnham');
//                    addTownship('Calumet City','Calumet City');
//                    addTownship('Calumet Park','Calumet Park');
//                    addTownship('Chicago City','Chicago City');
//                    addTownship('Chicago Heights','Chicago Heights');
//                    addTownship('Cicero','Cicero');
//                    addTownship('Country Club Hills','Country Club Hills');
//                    addTownship('Countryside','Countryside');
//                    addTownship('DesPlaines','DesPlaines');
//                    addTownship('Dolton','Dolton');
//                    addTownship('East Hazel Crest','East Hazel Crest');
//                    addTownship('Elk Grove Village','Elk Grove Village');
//                    addTownship('Elmhurst','Elmhurst');
//                    addTownship('Elmwood Park','Elmwood Park');
//                    addTownship('Evanston','Evanston');
//                    addTownship('Evergreen Park','Evergreen Park');
//                    addTownship('Franklin Park','Franklin Park');
//                    addTownship('Glenwood','Glenwood');
//                    addTownship('Golf','Golf');
//                    addTownship('Hanover Park','Hanover Park');
//                    addTownship('Harvey','Harvey');
//                    addTownship('Harwood Heights','Harwood Heights');
//                    addTownship('Hillside','Hillside');
//                    addTownship('Hoffman Estates','Hoffman Estates');
//                    addTownship('Maywood','Maywood');
//                    addTownship('McCook','McCook');
//                    addTownship('Morton Grove','Morton Grove');
//                    addTownship('Mount Prospect','Mount Prospect');
//                    addTownship('Niles','Niles');
//                    addTownship('Norridge','Norridge');
//                    addTownship('Northlake','Northlake');
//                    addTownship('Oak Lawn','Oak Lawn');
//                    addTownship('Oak Park','Oak Park');
//                    addTownship('Park Forest','Park Forest');
//                    addTownship('Park Ridge','Park Ridge');
//                    addTownship('River Forest','River Forest');
//                    addTownship('River Grove','River Grove');
//                    addTownship('Robbins','Robbins');
//                    addTownship('Rolling Meadows','Rolling Meadows');
//                    addTownship('Schaumburg','Schaumburg');
//                    addTownship('Skokie','Skokie');
//                    addTownship('Stickney','Stickney');
//                    addTownship('Stone Park','Stone Park');
//                    addTownship('Streamwood','Streamwood');
//                    addTownship('University Park','University Park');
//                    addTownship('West Chester','West Chester');
//                    addTownship('Wilmette','Wilmette');
//                    addTownship('NA','All Other Townships');  
//                  break;
// 
//                  case "dekalb":
//                    clearTownships();
//                    addTownship('Sycamore','Sycamore');
//                    addTownship('NA','All Other Townships');  
//                  break;
// 
//                  case "dupage":
//                    clearTownships();
//                    addTownship('Addison','Addison');
//                    addTownship('Aurora','Aurora');
//                    addTownship('Bartlett','Bartlett');
//                    addTownship('Bolingbrook','Bolingbrook');
//                    addTownship('Carol Stream','Carol Stream');
//                    addTownship('Chicago City','Chicago City');
//                    addTownship('Elk Grove Village','Elk Grove Village');
//                    addTownship('Elmhurst','Elmhurst');
//                    addTownship('Glen Ellyn','Glen Ellyn');
//                    addTownship('Glendale Heights','Glendale Heights');
//                    addTownship('Hanover Park','Hanover Park');
//                    addTownship('Napervlle','Napervlle');
//                    addTownship('Schaumburg','Schaumburg');
//                    addTownship('Wheaton','Wheaton');
//                    addTownship('Woodbridge','Woodbridge');
//                    addTownship('NA','All Other Townships');  
//                  break;
// 
//                  case "grundy":
//                    clearTownships();
//                    addTownship('Channahon','Channahon');
//                    addTownship('NA','All Other Townships');  
//                  break;
//                
//
//                  case "kane":
//                    clearTownships();
//                    addTownship('Aurora','Aurora');
//                    addTownship('Bartlett','Bartlett');
//                    addTownship('NA','All Other Townships');  
//                  break;
//
//                  case "kendall":
//                    clearTownships();
//                    addTownship('Aurora','Aurora');
//                    addTownship('Joliet','Joliet');
//                    addTownship('NA','All Other Townships');  
//                  break;
//
//                  case "lake":
//                    clearTownships();
//                    addTownship('Buffalo Grove','Buffalo Grove');
//                    addTownship('City of Lake Forest','City of Lake Forest');
//                    addTownship('Highland Park','Highland Park');
//                    addTownship('Lincolnshire','Lincolnshire');
//                    addTownship('Mettawa','Mettawa');
//                    addTownship('North Chicago','North Chicago');
//                    addTownship('NA','All Other Townships');  
//                  break;                  
//                  
//                  case "peoria":
//                    clearTownships();
//                    addTownship('Peoria City Limits','Peoria City Limits');
//                    addTownship('NA','All Other Townships');  
//                  break;                  
//                  
//                   case "stephenson":
//                    clearTownships();
//                    addTownship('Freeport','Freeport');
//                    addTownship('NA','All Other Townships');  
//                  break;
//                 
//                  case "will":
//                    clearTownships();
//                    addTownship('Aurora','Aurora');
//                    addTownship('Bolingbrook','Bolingbrook');
//                    addTownship('Channahon','Channahon');
//                    addTownship('Joliet','Joliet');
//                    addTownship('Naperville','Naperville');
//                    addTownship('Park Forest','Park Forest');
//                    addTownship('Romeoville','Romeoville');
//                    addTownship('University Park','University Park');
//                    addTownship('Woodridge','Woodridge');
//                    addTownship('NA','All Other Townships');  
//                  break;
//                 
//                  default:
//               clearTownships();
//               addTownship('NA','All Townships');
//
//              }//end switch
//              break;
//
//              case "KY":
//                clearTownships();
//              switch(document.CALC.county.value){
//                  case "Campbell":
//                    clearTownships();
//                    addTownship('Alexandria','Alexandria');
//                    addTownship('Newport','Newport');
//                    addTownship('NA','All Other Townships');  
//                  break;
//                  
//                  case "Kenton":
//                    clearTownships();
//                    addTownship('Covington','Covington');
//                    addTownship('Independence','Independence');
//                    addTownship('NA','All Other Townships');  
//                  break;
// 
//               default:
//               clearTownships();
//               addTownship('NA','All Townships');
//
//              }//end switch
//              break;
//  
//                case "ME":
//                clearTownships();
//              switch(document.CALC.county.value){
//                  case "Aroostook":
//                    clearTownships();
//                    addTownship('Northern District','Northern District');
//                    addTownship('Southern District','Southern District');
//                    addTownship('NA','All Other Townships');  
//                  break;
//                 
//                  case "Oxford":
//                    clearTownships();
//                    addTownship('Eastern District','Eastern District');
//                    addTownship('Western District','Western District');
//                    addTownship('NA','All Other Townships');  
//                  break;
//    
//                  default:
//                  clearTownships();
//                  addTownship('NA','All Townships');
//
//              }//end switch
//              break;                        
// 
//              case "MO":
//                clearTownships();
//              switch(document.CALC.county.value){
//                  case "Jackson":
//                    clearTownships();
//                    addTownship('Independence','Independence');
//                    addTownship('Kansas City','Kansas City');
//                    addTownship('NA','All Other Townships');  
//                  break;
// 
//               default:
//               clearTownships();
//               addTownship('NA','All Townships');
//
//              }//end switch
//              break;
//                        
//                     
//    case "NY":
//       clearTownships();
//  
//      switch(document.CALC.county.value.toLowerCase()){
//          case "albany":
//          addTownship('NA','Select Township');
//          addTownship('albany','Albany');
//          addTownship('coeymans','Coeymans');
//          addTownship('eastberne','East Berne');
//          addTownship('latham','Latham');
//          addTownship('menands','Menands');
//          addTownship('rensselaerville','Rensselaerville');
//          break;
//         
//          case "allegheny":
//          addTownship('NA','Select Township');
//          addTownship('fillmore','Fillmore');
//          break;
//     
//          case "bronx":
//          addTownship('NA','Select Township');
//          addTownship('bronx','Bronx');
//          addTownship('cityisland','City Island');
//          addTownship('newyork','New York');
//          addTownship('riverdale','Riverdale');
//          break;
//          
//          case "broome":
//          addTownship('NA','Select Township');
//          addTownship('binghamton','Binghamton');
//          addTownship('fenton','Fenton');
//          addTownship('vestel','Vestel');
//          addTownship('windsor','Windsor');
//          break;     
//          
//          case "cattaraugus":
//          addTownship('NA','Select Township');
//          addTownship('bedfordcorners','Bedford Corners');
//          addTownship('yorkshire','Yorkshire');
//          break;     
//          
//          case "cayuga":
//          addTownship('NA','Select Township');
//          addTownship('auburn','Auburn');
//          addTownship('sennett','Sennett');
//          break;     
//          
//          case "chautauqua":
//          addTownship('NA','Select Township');
//          addTownship('busti','Busti');
//          addTownship('carroll','Carroll');
//          addTownship('dunkirk','Dunkirk');
//          addTownship('jamestown','Jamestown');
//          addTownship('kiantone','Kiantone');
//          addTownship('mayville','Mayville');
//          addTownship('portland','Portland');
//          break;     
//     
//          case "chemung":
//          addTownship('NA','Select Township');
//          addTownship('elmira','Elmira');
//          addTownship('elmiraheights','Elmira Heights');
//          addTownship('horseheads','Horseheads');
//          break;     
//     
//          case "chenango":
//          addTownship('NA','Select Township');
//          addTownship('guilford','Guilford');
//          addTownship('lincklaen','Lincklaen');
//          addTownship('oxford','Oxford');
//          addTownship('sherburne','Sherburne');
//          addTownship('smithvilleflats','Smithville Flats');
//          addTownship('southplymouth','South Plymouth');
//          break;     
//      
//          case "clinton":
//          addTownship('NA','Select Township');
//          addTownship('blackbrook','Black Brook');
//          break;
//          
//         case "columbia":
//          addTownship('NA','Select Township');
//          addTownship('ancram','Ancram');
//          addTownship('ancramdale','Ancramdale');
//          addTownship('austerlitz','Austerlitz');
//          addTownship('canaan','Canaan');
//          addTownship('copake','Copake');
//          addTownship('craryville','Craryville');
//          addTownship('elizaville','Elizaville');
//          addTownship('germantown','Germantown');
//          addTownship('ghent','Ghent');
//          addTownship('hillsdale','Hillsdale');
//          addTownship('hudson','Hudson');
//          addTownship('kinderhook','Kinderhook');
//          addTownship('newlebanon','New Lebanon');
//          addTownship('oldchatham','Old Chatham');
//          addTownship('philmont','Philmont');
//          addTownship('stuyvesant','Stuyvesant');
//          addTownship('taghkanic','Taghkanic');
//          addTownship('valatie','Valatie');
//          break;
//         
//          case "cortland":
//          addTownship('NA','Select Township');
//          addTownship('cortlandville','Cortlandville');
//          break;    
//         
//          case "delaware":
//          addTownship('NA','Select Township');
//          addTownship('andes','Andes');
//          addTownship('bovina','Bovina');
//          addTownship('colchester','Colchester');
//          addTownship('davenport','Davenport');
//          addTownship('fleishmanns','Fleishmanns');
//          addTownship('franklin','Franklin');
//          addTownship('hamden','Hamden');
//          addTownship('hancock','Hancock');
//          addTownship('harpersfield','Harpersfield');
//          addTownship('kortright','Kortright');
//          addTownship('margaretville','Margaretville');
//          addTownship('meredith','Meredith');
//          addTownship('middletown','Middletown');
//          addTownship('newkingston','New Kingston');
//          addTownship('sidney','Sidney');
//          addTownship('walton','Walton');
//          break;
//         
//          case "dutchess":
//          addTownship('NA','Select Township');
//          addTownship('amenia','Amenia');
//          addTownship('beacon','Beacon');
//          addTownship('beekman','Beekman');
//          addTownship('chestnutridge','Chestnut Ridge');
//          addTownship('clinton','Clinton');
//          addTownship('clintoncorners','Clinton Corners');
//          addTownship('dover','Dover');
//          addTownship('doverplains','Dover');
//          addTownship('eastfishkill','East Fishkill');
//          addTownship('fishkill','Fishkill');
//          addTownship('glenham','Glenham');
//          addTownship('holmes','Holmes');
//          addTownship('hopewelljunction','Hopewell Junction');
//          addTownship('hydepark','Hyde Park');
//          addTownship('kentlakes','Kent Lakes');
//          addTownship('lagrange','LaGrange');
//          addTownship('lagrangeville','LaGrangeville');
//          addTownship('milan','Milan');
//          addTownship('millbrook','Millbrook');
//          addTownship('millerton','Millerton');
//          addTownship('newhamburg','New Hamburg');
//          addTownship('northeast','North East');
//          addTownship('pawling','Pawling');
//          addTownship('pineplains','Pine Plains');
//          addTownship('pleasantvalley','Pleasant Valley');
//          addTownship('poughkeepsie','Poughkeepsie');
//          addTownship('poughquag','Poughquag');
//          addTownship('redhook','Red Hook');
//          addTownship('rhinebeck','Rhinebeck');
//          addTownship('rhinecliff','Rhinecliff');
//          addTownship('saltpoint','Salt Point');
//          addTownship('shekomeko','Shekomeko');
//          addTownship('staatsburg','Staatsburg');
//          addTownship('stanford','Stanford');
//          addTownship('stanfordville','Stanfordville');
//          addTownship('stormville','Stormville');
//          addTownship('tivoli','Tivoli');
//          addTownship('unionvale','Unionvale');
//          addTownship('wappinger','Wappinger');
//          addTownship('wappingersfalls','Wappinger Falls');
//          addTownship('washington','Washington');
//          addTownship('wassaic','Wassaic');
//          addTownship('wingdale','Wingdale');
//          break;      
//     
//          case "erie":
//          addTownship('NA','Select Township');
//          addTownship('buffalo','Buffalo');
//          addTownship('cheektowaga','Cheektowaga');
//          addTownship('clarence','Clarence');
//          addTownship('collins','Collins');
//          addTownship('eden','Eden');
//          addTownship('grandisland','Grand Island');
//          addTownship('hamburg','Hamburg');
//          addTownship('lancaster','Lancaster');
//          addTownship('orchardpark','Orchard Park');
//          addTownship('tonawanda','Tonawanda');
//          addTownship('westseneca','West Seneca');
//          break;
//         
//          case "essex":
//          addTownship('NA','Select Township');
//          addTownship('bloomfield','Bloomfield');
//          addTownship('eastorange','East Orange');
//          addTownship('mtclare','Mt. Clare');
//          addTownship('newcomb','Newcomb');
//          addTownship('northelba','North Elba');
//          addTownship('schroonlake','Schroon Lake');
//          break;
//         
//          case "franklin":
//          addTownship('NA','Select Township');
//          addTownship('bellmont','Bellmont');
//          addTownship('saranaclake','Saranac Lake');
//          break;
//         
//          case "fulton":
//          addTownship('NA','Select Township');
//          addTownship('broadalbin','Broadalbin');
//          addTownship('northville','Northville');
//          addTownship('oppenheim','Oppenheim');
//          break;      
//         
//          case "genesee":
//          addTownship('NA','Select Township');
//          addTownship('batavia','Batavia');
//          break;
//         
//          case "greene":
//          addTownship('NA','Select Township');
//          addTownship('ashland','Ashland');
//          addTownship('athens','Athens');
//          addTownship('catskill','Catskill');
//          addTownship('coxsackie','Coxsackie');
//          addTownship('durham','Durham');
//          addTownship('earlton','Earlton');
//          addTownship('eastdurham','East Durham');
//          addTownship('freehold','Freehold');
//          addTownship('hancroix','Hancroix');
//          addTownship('hunter','Hunter');
//          addTownship('lexington','Lexington');
//          addTownship('maplecrest','Maplecrest');
//          addTownship('roundtop','Round Top');
//          addTownship('tannersville','Tannersville');
//          addTownship('windham','Windham');
//          break;      
//         
//          case "hamilton":
//          addTownship('NA','Select Township');
//          addTownship('indianlake','Indian Lake');
//          addTownship('littlefalls','Little Falls');
//          addTownship('longlake','Long Lake');
//          addTownship('speculator','Speculator');
//          break;      
//     
//          case "herkimer":
//          addTownship('NA','Select Township');
//          addTownship('littlefalls','Little Falls');
//          addTownship('westwinfield','West Winfield');
//          break;   
//     
//          case "jefferson":
//          addTownship('NA','Select Township');
//          addTownship('blackriver','Black River');
//          addTownship('watertown','Watertown');
//          break;   
//         
//          case "kings":
//          addTownship('NA','Select Township');
//          addTownship('bedstuy','Bedstuy');
//          addTownship('brook','Brook');
//          addTownship('brooklyn','Brooklyn');
//          addTownship('cypresshills','Cypress Hills');
//          addTownship('flatbush','Flatbush');
//          addTownship('greenpoint','Greenpoint');
//          addTownship('newyork','New York');
//          addTownship('parkslope','Park Slope');
//          addTownship('ridgewood','Ridgewood');
//          addTownship('rockawaypoint','Rockaway Point');
//          addTownship('seagate','Seagate');
//          break;
//     
//          case "livingston":
//          addTownship('NA','Select Township');
//          addTownship('geneseo','Geneseo');
//          addTownship('mountmoris','Mount Morris');
//          break;
//         
//          case "lowerwestchester":
//          addTownship('NA','Select Township');
//          addTownship('mountvernon','Mount Vernon');
//          addTownship('yonkers','Yonkers');
//          break;   
//      
//          case "monroe":
//          addTownship('NA','Select Township');
//          addTownship('brockport','Brockport');
//          addTownship('chili','Chili');
//          addTownship('greece','Greece');
//          addTownship('irondequoit','Irondequoit');
//          addTownship('perinton','Perinton');
//          addTownship('spencerport','Spencerport');
//          addTownship('westhenrietta','West Henrietta');
//          break;
//     
//          case "montgomery":
//          addTownship('NA','Select Township');
//          addTownship('amsterdam','Amsterdam');
//          addTownship('fonda','Fonda');
//          addTownship('fortplain','Fort Plain');
//          addTownship('saintjohnsville','Saint Johnsville');
//          break;
//      
//         
//          case "nassau":
//          addTownship('NA','Select Township');
//          addTownship('albertson','Albertson');
//          addTownship('amityville','Amityville');
//          addTownship('atlanticbeach','Atlantic Beach');
//          addTownship('baldwin','Baldwin');
//          addTownship('baldwinharbor','Baldwin Harbor');
//          addTownship('baldwinmanor','Baldwin Manor');
//          addTownship('bayville','Bayville');
//          addTownship('bellerose','Bellerose');
//          addTownship('belleroseterrace','Bellerose Terrace');
//          addTownship('bellmore','Bellmore');
//          addTownship('bellport','Bellport');
//          addTownship('bellrosevillage','Bellrose Village');
//          addTownship('bethpage','Bethpage');
//          addTownship('brookville','Brookville');
//          addTownship('carleplace','Carle Place');
//          addTownship('cedarhurst','Cedarhurst');
//          addTownship('centreisland','Centre Island');
//          addTownship('coldspringharbor','Cold Spring Harbor');
//          addTownship('coveneck','Cove Neck');
//          addTownship('eastatlanticbeach','East Atlantic Beach');
//          addTownship('easthills','East Hills');
//          addTownship('eastmassapequa','East Massapequa');
//          addTownship('eastmeadow','East Meadow');
//          addTownship('eastnorwich','East Norwich');
//          addTownship('eastrockaway','East Rockaway');
//          addTownship('eastwilliston','East Williston');
//          addTownship('elmont','elmont');
//          addTownship('farmingdale','Farmingdale');
//          addTownship('floralpark','Floral Park');
//          addTownship('flowerhill','Flower Hill');
//          addTownship('franklinsquare','Franklin Square');
//          addTownship('freeport','Freeport');
//          addTownship('gardencity','Garden City');
//          addTownship('gardencitypark','Garden City Park');
//          addTownship('gardencitysouth','Garden City South');
//          addTownship('glencove','Glen Cove');
//          addTownship('glenhead','Glen Head');
//          addTownship('glenoaks','Glen Oaks');
//          addTownship('glenwoodlanding','Glenwood Landing');
//          addTownship('greatneck','Great Neck');
//          addTownship('greatneckestates','Great Neck Estates');
//          addTownship('greenvale','Greenvale');
//          addTownship('hempstead','Hempstead');
//          addTownship('herricks','Herricks');
//          addTownship('hewlett','Hewlett');
//          addTownship('hewlettbaypark','Hewlett Bay Park');
//          addTownship('hewlettharbor','Hewlett Harbor');
//          addTownship('hewlettneck','Hewlett Neck');
//          addTownship('hicksville','Hicksville');
//          addTownship('inwood','Inwood');
//          addTownship('islandpark','Island Park');
//          addTownship('jericho','Jericho');
//          addTownship('kensington','Kensington');
//          addTownship('kingspoint','Kings Point');
//          addTownship('lakesuccess','Lake Success');
//          addTownship('lakeview','Lakeview');
//          addTownship('lattingtown','Lattingtown');
//          addTownship('laurelhollow','Laurel Hollow');
//          addTownship('lawrence','Lawrence');
//          addTownship('levittown','Levittown');
//          addTownship('lidobeach','Lido Beach');
//          addTownship('locustvalley','Locust Valley');
//          addTownship('longbeach','Long Beach');
//          addTownship('lynbrook','Lynbrook');
//          addTownship('malverne','Malverne');
//          addTownship('manhasset','Manhasset');
//          addTownship('manhassethills','Manhasset Hills');
//          addTownship('manorhaven','Manorhaven');
//          addTownship('massapequa','Massapequa');
//          addTownship('massapequapark','Massapequa Park');
//          addTownship('matinecock','Matinecock');
//          addTownship('merrick','Merrick');
//          addTownship('millneck','Millneck');
//          addTownship('mineola','Mineola');
//          addTownship('munseypark','Muney Park');
//          addTownship('muttontown','Muttontown');
//          addTownship('nassau','Nassau');
//          addTownship('newcassel','New Cassel');
//          addTownship('newhydepark','New Hyde Park');
//          addTownship('northbaldwin','North Baldwin');
//          addTownship('northbellmore','North Bellmore');
//          addTownship('northhempstead','North Hempstead');
//          addTownship('northhills','North Hills');
//          addTownship('northmassapequa','North Massapequa');
//          addTownship('northmerrick','North Merrick');
//          addTownship('northplainview','North Plainview');
//          addTownship('northvalleystream','North Valley Stream');
//          addTownship('northwoodmere','North Woodmere');
//          addTownship('oceanside','Oceanside');
//          addTownship('oldbethpage','Old Bethpage');
//          addTownship('oldbrookville','Old Brookville');
//          addTownship('oldwestbury','Old Westbury');
//          addTownship('oysterbay','Oyster Bay');
//          addTownship('oysterbaycove','OysterBay Cove');
//          addTownship('plainedge','Plainedge');
//          addTownship('plainview','Plainview');
//          addTownship('plandome','Plandome');
//          addTownship('plandomeheights','Plandome Heights');
//          addTownship('pointlookout','Point Lookout');
//          addTownship('portwashinton','Port Washington');
//          addTownship('rockvillecentre','Rockville Centre');
//          addTownship('roosevelt','Roosevelt');
//          addTownship('roslyn','Roslyn');
//          addTownship('roslynestates','Roslyn Estates');
//          addTownship('roslynharbor','Roslyn Harbor');
//          addTownship('roslynheights','Roslyn Heights');
//          addTownship('sandspoint','Sands Point');
//          addTownship('seacliff','Sea Cliff');
//          addTownship('seaford','Seaford');
//          addTownship('searingtown','Searingtown');
//          addTownship('southbellmore','South Bellmore');
//          addTownship('southfarmingdale','South Farmingdale');
//          addTownship('southfloralpark','South Floral Park');
//          addTownship('southhempstead','South Hempstead');
//          addTownship('stkingspark','St. Kings Park');
//          addTownship('stewartmanor','Stewart Manor');
//          addTownship('syosset','Syosset');
//          addTownship('thomaston','Thomaston');
//          addTownship('townofhempstead','Town of Hempstead');
//          addTownship('uniondale','Uniondale');
//          addTownship('upperbrookville','Upper Brookville');
//          addTownship('valleystream','Valley Stream');
//          addTownship('wantagh','Wantagh');
//          addTownship('westelmont','West Elmont');
//          addTownship('westhempstead','West Hempstead');
//          addTownship('westsayville','West Sayville');
//          addTownship('westbury','Westbury');
//          addTownship('wheatley','Wheatley');
//          addTownship('willistonpark','Williston Park');
//          addTownship('woodbury','Woodbury');
//          addTownship('woodmere','Woodmere');
//          break;      
//         
//          case "newyork":
//          addTownship('NA','Select Township');
//          addTownship('manhattan','Manhattan');
//          addTownship('newyork','New York');
//          addTownship('newyorkcity','New York City');
//          addTownship('rooseveltisland','Roosevelt Island');
//          break;
//     
//          case "niagara":
//          addTownship('NA','Select Township');
//          addTownship('chestnutridge','Chestnut Ridge');
//          addTownship('lockport','Lockport');
//          addTownship('niagara','Niagara');
//          addTownship('northtonawanda','North Tonawanda');
//          addTownship('wheatfield','Wheatfield');
//          break;    
//     
//          case "oneida":
//          addTownship('NA','Select Township');
//          addTownship('Clinton','clinton');
//          addTownship('Utica','utica');
//          break;    
//     
//          case "onondaga":
//          addTownship('NA','Select Township');
//          addTownship('cicero','Cicero');
//          addTownship('clay','Clay');
//          addTownship('dewitt','Dewitt');
//          addTownship('manlius','Manlius');
//          addTownship('mattydale','Mattydale');
//          addTownship('northsyracuse','North Syracuse');
//          addTownship('syracuse','Syracuse');
//          break;    
//     
//          case "ontario":
//          addTownship('NA','Select Township');
//          addTownship('geneva','Geneva');
//          addTownship('shortsville','Shortsville');
//          addTownship('stanley','Stanley');
//          addTownship('victor','Victor');
//          break;    
//      
//         case "orange":
//          addTownship('NA','Select Township');
//          addTownship('bellvale','Bellvale');
//          addTownship('bloominggrove','Blooming Grove');
//          addTownship('bloomingburg','Bloomingburg');
//          addTownship('bullville','Bullvill');
//          addTownship('campbellhall','Campbell Hall');
//          addTownship('centralvalley','Central Valley');
//          addTownship('chester','Chester');
//          addTownship('circleville','Circleville');
//          addTownship('cornwall','Cornwall');
//          addTownship('cornwallonhudson','Cornwall-On-Hudson');
//          addTownship('crawford','Crawford');
//          addTownship('cuddebackville','Cuddebackville');
//          addTownship('deerpark','Deerpark');
//          addTownship('florida','Florida');
//          addTownship('fortmontgomery','Fort Montgomery');
//          addTownship('glenwoodhills','Glenwood Hills');
//          addTownship('goshen','Goshen');
//          addTownship('greenville','Greenville');
//          addTownship('greenwoodlake','Greenwood Lake');
//          addTownship('hamptonburgh','Hamptonburgh');
//          addTownship('harriman','Harriman');
//          addTownship('highlandfalls','Highland Falls');
//          addTownship('highlandmills','Highland Mills');
//          addTownship('highlands','Highlands');
//          addTownship('howells','Howells');
//          addTownship('huguenot','Huguenot');
//          addTownship('johnson','Johnson');
//          addTownship('kiryasjoel','Kiryas Joel');
//          addTownship('maybrook','Maybrook');
//          addTownship('middletown','Middletown');
//          addTownship('minisink','Minisink');
//          addTownship('monroe','Monroe');
//          addTownship('montgomery','Montgomery');
//          addTownship('mounthope','Mount Hope');
//          addTownship('mountainville','Mountainville');
//          addTownship('newhampton','New Hampton');
//          addTownship('newwindsor','New Windsor');
//          addTownship('newburgh','Newburgh');
//          addTownship('otisville','Otisville');
//          addTownship('pinebush','Pinebush');
//          addTownship('pineisland','Pine Island');
//          addTownship('portjervis','Port Jervis');
//          addTownship('rocktavern','Rock Tavern');
//          addTownship('salisburymills','Salisbury Mills');
//          addTownship('slatehill','Slate Hill');
//          addTownship('southfields','Southfields');
//          addTownship('sparrowbush','Sparrowbush');
//          addTownship('sugarloaf','Sugar Loaf');
//          addTownship('thompsonridge','Thompson Ridge');
//          addTownship('tuxedo','Tuxedo');
//          addTownship('tuxedopark','Tuxedo Park');
//          addTownship('unionville','Unionville');
//          addTownship('walden','Walden');
//          addTownship('wallkill','Wallkill');
//          addTownship('warwick','Warwick');
//          addTownship('washingtonville','Washingtonville');
//          addTownship('wawayanda','Wawayanda');
//          addTownship('westtown','Westtown');
//          addTownship('woodbury','Woodbury');
//          break;    
//     
//          case "orleans":
//          addTownship('NA','Select Township');
//          addTownship('medina','Medina');
//          break; 
//     
//          case "oswego":
//          addTownship('NA','Select Township');
//          addTownship('bernardsbay',"Bernard's Bay");
//          addTownship('huguenot','Huguenot');
//          break;
//         
//          case "otsego":
//          addTownship('NA','Select Township');
//          addTownship('cherryvalley','Cherry Valley');
//          addTownship('cooperstown','Cooperstown');
//          addTownship('laurens','Laurens');
//          addTownship('oneonta','Oneonta');
//          addTownship('unadilla','Unadilla');
//          break;     
//         
//          case "putnam":
//          addTownship('NA','Select Township');
//          addTownship('baldwinplace','Baldwin Place');
//          addTownship('brewster','Brewster');
//          addTownship('carmel','Carmel');
//          addTownship('coldspring','Cold Spring');
//          addTownship('cooperstown','Cooperston');
//          addTownship('garrison','Garrison');
//          addTownship('kent','Kent');
//          addTownship('kentlakes','Kent Lakes');
//          addTownship('lakecarmel','Lake Carmel');
//          addTownship('lakepeeskill','Lake Peeskill');
//          addTownship('mahopac','Mahopac');
//          addTownship('mahopacfalls','Mahopac Falls');
//          addTownship('nelsonville','Nelsonville');
//          addTownship('patterson','Patterson');
//          addTownship('philipstown','Philipstown');
//          addTownship('putnamvalley','Putnam Valley');
//          addTownship('southeast','South East');
//          break;     
//         
//          case "queens":
//          addTownship('NA','Select Township');
//          addTownship('arverne','Arverne');
//          addTownship('astoria','Astoria');
//          addTownship('bayside','Bayside');
//          addTownship('beechhurst','Beechhurst');
//          addTownship('belleharbor','Belle Harbor');
//          addTownship('bellerose','Bellerose');
//          addTownship('bellerosemanor','Bellerose Manor');
//          addTownship('breezypoint','Breezy Point');
//          addTownship('briarwood','Briarwood');
//          addTownship('broadchannel','Broad Channel');
//          addTownship('cambriaheights','Cambria Heights');
//          addTownship('collegepoint','College Point');
//          addTownship('corona','Corona');
//          addTownship('douglaston','Douglaston');
//          addTownship('eastelmhurst','East Elmhurst');
//          addTownship('eastrockaway','East Rockaway');
//          addTownship('edgemere','Edgemere');
//          addTownship('elmhurst','Elmhurst');
//          addTownship('elmont','Elmont');
//          addTownship('farrockaway','Far Rockaway');
//          addTownship('floralpark','Floral Park');
//          addTownship('flushing','Flushing');
//          addTownship('foresthills','Forest Hills');
//          addTownship('freshmeadows','Fresh Meadows');
//          addTownship('glenoaks','Glen Oaks');
//          addTownship('glendale','Glendale');
//          addTownship('hamiltonbeach','Hamilton Beach');
//          addTownship('hollis','Hollis');
//          addTownship('hollishills','Hollis Hills');
//          addTownship('holliswood','Holliswood');
//          addTownship('howardbeach','Howard Beach');
//          addTownship('jacksonheights','Jackson Heights');
//          addTownship('jamaica','Jamaica');
//          addTownship('jamaicaestates','Jamaica Estates');
//          addTownship('jamaicahills','Jamaica Hills');
//          addTownship('kewgardens','Kew Gardens');
//          addTownship('kewgardenshills','Kew Gardens Hills');
//          addTownship('laurelton','Laurelton');
//          addTownship('laureltonestates','Laurelton Estates');
//          addTownship('littleneck','Littleneck');
//          addTownship('longislandcity','LongIsland City');
//          addTownship('malba','Malba');
//          addTownship('maspeth','Maspeth');
//          addTownship('middlevillage','Middle Village');
//          addTownship('neponsit','Neponsit');
//          addTownship('newhydepark','New Hyde Park');
//          addTownship('newyork','New York');
//          addTownship('oaklandgardens','Oakland Gardens');
//          addTownship('oceanside','Oceanside');
//          addTownship('ozonepark','Ozone Park');
//          addTownship('queens','Queens');
//          addTownship('queensvillage','Queens Village');
//          addTownship('regopark','Rego Park');
//          addTownship('richmondhill','Richmond Hill');
//          addTownship('ridgewood','Ridgewood');
//          addTownship('rochdalevillage','Rochdale Village');
//          addTownship('rockaway','Rockaway');
//          addTownship('rockawaybeach','Rockaway Bach');
//          addTownship('rockawaypark','Rockaway Park');
//          addTownship('rosedale','Rosedale');
//          addTownship('southjamaica','South Jamaica');
//          addTownship('southozonepark','South Ozone Park');
//          addTownship('southrichmondhill','South Richmond Hill');
//          addTownship('springfield','Springfield');
//          addTownship('springfieldgardens','Springfield Gardens');
//          addTownship('stalbans','St. Albans');
//          addTownship('sunnyside','Sunnyside');
//          addTownship('whitestone','Whitestone');
//          addTownship('woodhaven','Woodhaven');
//          addTownship('woodside','Woodside');
//          break; 
//         
//          case "rensselaer":
//          addTownship('NA','Select Township');
//          addTownship('eastgreenbush','East Greenbush');
//          addTownship('hoosickfalls','Hoosick Falls');
//          addTownship('stephentown','Stephentown');
//          addTownship('troy','Troy');
//          break;
//         
//          case "richmond":
//          addTownship('NA','Select Township');
//          addTownship('newyork','New York');
//          addTownship('richmond','Richmond');
//          addTownship('statenisland','Staten Island');
//          break;   
//         
//         case "rockland":
//          addTownship('NA','Select Township');
//          addTownship('airmont','Airmont');
//          addTownship('bardonia','Bardonia');
//          addTownship('blauvelt','Blauvelt');
//          addTownship('centralnyack','Central Nyack');
//          addTownship('chestnutridge','Chestnut Ridge');
//          addTownship('clarkstown','Clarkstown');
//          addTownship('congers','Congers');
//          addTownship('garnerville','Garnerville');
//          addTownship('grandview','Grandview');
//          addTownship('grandviewonhudson','Grandview-on-Hudson');
//          addTownship('haverstraw','Haverstraw');
//          addTownship('hillburn','Hillburn');
//          addTownship('hillcrest','Hillcrest');
//          addTownship('jonespoint','Jones Point');
//          addTownship('monsey','Monsey');
//          addTownship('montebello','Montebello');
//          addTownship('nanuet','Nanuet');
//          addTownship('newcity','New City');
//          addTownship('newhempstead','New Hempstead');
//          addTownship('nyack','Nyack');
//          addTownship('orangeburg','Orangeburg');
//          addTownship('orangetown','Orangetown');
//          addTownship('palisades','Palisades');
//          addTownship('pallma','Pallma');
//          addTownship('pearlriver','Pearl River');
//          addTownship('piermont','Piermont');
//          addTownship('pomona','Pomona');
//          addTownship('ramapo','Ramapo');
//          addTownship('sloatsburg','Sloatsburg');
//          addTownship('somers','Somers');
//          addTownship('southmonsey','South Monsey');
//          addTownship('southnyack','South Nyack');
//          addTownship('sparkill','Sparkill');
//          addTownship('springvalley','Spring Valley');
//          addTownship('stonypoint','Stony Point');
//          addTownship('suffern','Suffern');
//          addTownship('tallman','Tallman');
//          addTownship('tappan','Tappan');
//          addTownship('thiells','Thiells');
//          addTownship('tomkinscove','Tomkins Cove');
//          addTownship('uppergrandview','Upper Grandview');
//          addTownship('uppernyack','Upper Nyack');
//          addTownship('valleycottage','Valley Cottage');
//          addTownship('wesleyhills','Wesley Hills');
//          addTownship('westhaverstraw','West Haverstraw');
//          addTownship('westnyack','West Nyack');
//          break;
//         
//          case "saratoga":
//          addTownship('NA','Select Township');
//          addTownship('ballstonspa','Ballston Spa');
//          addTownship('burnthills','Burnt Hills');
//          addTownship('greenfieldcenter','Greenfield Center');
//          addTownship('malta','Malta');
//          addTownship('saratogasprings','Saratoga Springs');
//          break;
//       
//          case "schenectady":
//          addTownship('NA','Select Township');
//          addTownship('glenville','Glenville');
//          addTownship('rotterdam','Rotterdam');
//          addTownship('schenectady','Schenectady');
//          break;
//            
//          case "schoharie":
//          addTownship('NA','Select Township');
//          addTownship('broome','Broome');
//          addTownship('cobleskill','Cobleskill');
//          addTownship('conesville','Conesville');
//          addTownship('jefferson','Jefferson');
//          addTownship('sharon','Sharon');
//          addTownship('summit','Summit');
//          break;
//                  
//          case "stlawrence":
//          addTownship('NA','Select Township');
//          addTownship('brasherfalls','Brasher Falls');
//          addTownship('massena','Massena');
//          addTownship('potsdam','Potsdam');
//          addTownship('stlawrence','St. Lawrence');
//          break;
//                
//          case "steuben":
//          addTownship('NA','Select Township');
//          addTownship('bath','Bath');
//          addTownship('hornellsville','Hornellsville');
//          break;
//              
//          case "suffolk":
//          addTownship('NA','Select Township');
//          addTownship('amagansett','Amagansett');
//          addTownship('amityharbor','Amity Harbor');
//          addTownship('amityville','Amityville');
//          addTownship('aqueboque','Aqueboque');
//          addTownship('asharoken','Asharoken');
//          addTownship('babylon','Babylon');
//          addTownship('babylonvillage','Babylon Village');
//          addTownship('baitinghollow','Baiting Hollow');
//          addTownship('baltaire','Baltaire');
//          addTownship('bayshore','Bay Shore');
//          addTownship('bayport','Bayport');
//          addTownship('belleterre','Belle Terre');
//          addTownship('bellport','Bellport');
//          addTownship('bluepoint','Blue Point');
//          addTownship('bohemia','Bohemia');
//          addTownship('brentwood','Brentwood');
//          addTownship('bridgehampton','Bridgehampton');
//          addTownship('brightwaters','Brightwaters');
//          addTownship('brookhaven','Brookhaven');
//          addTownship('calverton','Calverton');
//          addTownship('centermoriches','Center Moriches');
//          addTownship('centereach','Centereach');
//          addTownship('centerport','Centerport');
//          addTownship('centralislip','Central Islip');
//          addTownship('cherrygrove','Cherry Grove');
//          addTownship('coldspringharbor','Cold Spring Harbor');
//          addTownship('commack','Commack');
//          addTownship('copiague','Copiague');
//          addTownship('coram','Coram');
//          addTownship('cutchogue','Cutchoque');
//          addTownship('deerpark','Deer Park');
//          addTownship('deringharbor','Dering Harbor');
//          addTownship('dixhills','Dix Hills');
//          addTownship('dunewood','Dunewood');
//          addTownship('eastcoram','East Coram');
//          addTownship('eastfarmingdale','East Farmingdale');
//          addTownship('easthampton','East Hampton');
//          addTownship('eastislip','East Islip');
//          addTownship('eastmarion','East Marion');
//          addTownship('eastmoriches','East Moriches');
//          addTownship('eastnorthport','East Northport');
//          addTownship('eastpatchogue','East Patchogue');
//          addTownship('eastquogue','East Quogue');
//          addTownship('eastsetauket','East Setauket');
//          addTownship('eastport','Eastport');
//          addTownship('eatonsneck','Eatons Neck');
//          addTownship('fairharbor','Fair Harbor');
//          addTownship('farmingdale','Farmingdale');
//          addTownship('farmingville','Farmingville');
//          addTownship('fireisland','Fire Island');
//          addTownship('fireislandpines','Fire Island Pines');
//          addTownship('flanders','Flanders');
//          addTownship('fortsalonga','Fort Salonga');
//          addTownship('greatriver','Great River');
//          addTownship('greenlawn','Green Lawn');
//          addTownship('greenport','Green Port');
//          addTownship('halesite','Halesite');
//          addTownship('hamptonbays','Hampton Bays');
//          addTownship('hauppauge','Hauppauge');
//          addTownship('headoftheharbor','Head of the Harbor');
//          addTownship('holbrook','Holbrook');
//          addTownship('holtsville','Holtsville');
//          addTownship('huntington','Huntington');
//          addTownship('huntingtonbay','Huntington Bay');
//          addTownship('huntingtonstation','Huntington Station');
//          addTownship('islandia','Islandia');
//          addTownship('islip','Islip');
//          addTownship('islipterrace','Islip Terrace');
//          addTownship('jamesport','Jamesport');
//          addTownship('kingspark','Kings Park');
//          addTownship('kismet','Kismet');
//          addTownship('lakegrove','Lake Grove');
//          addTownship('lakepanamoka','Lake Panamoka');
//          addTownship('lakeronkonkoma','Lake Ronkonkoma');
//          addTownship('laurel','Laurel');
//          addTownship('lindenhurst','Lindenhurst');
//          addTownship('lloydharbor','Lloyd Harbor');
//          addTownship('loneyville','Loneyville');
//          addTownship('manorville','Manorville');
//          addTownship('mastic','Mastic');
//          addTownship('masticbeach','Mastic Beach');
//          addTownship('mattituck','Mattituck');
//          addTownship('medford','Medford');
//          addTownship('melville','Melville');
//          addTownship('middleisland','Middle Island');
//          addTownship('millerplace','Miller Place');
//          addTownship('montauk','Montauk');
//          addTownship('moriches','Moriches');
//          addTownship('mountsinai','Mount Sinai');
//          addTownship('nesconset','Nesconset');
//          addTownship('newsuffolk','New Suffolk');
//          addTownship('nissequogue','Nissequogue');
//          addTownship('northamityville','North Amityville');
//          addTownship('northbabylon','North Babylon');
//          addTownship('northbayshore','North Bayshore');
//          addTownship('northbellport','North Bellport');
//          addTownship('northgreatriver','North Great River');
//          addTownship('northhaven','North Haven');
//          addTownship('northlindenhurst','North Lindenhurst');
//          addTownship('northpatchogue','North Patchogue');
//          addTownship('northport','Northport');
//          addTownship('northville','Northville');
//          addTownship('noyack','Noyack');
//          addTownship('oakdale','Oakdale');
//          addTownship('oceanbaypark','Ocean Bay Park');
//          addTownship('oceanbeach','Ocean Beach');
//          addTownship('oldfield','Old Field');
//          addTownship('orient','Orient');
//          addTownship('orientpoint','Orient Point');
//          addTownship('patchogue','Patchogue');
//          addTownship('peconic','Peconic');
//          addTownship('poquott','Poquott');
//          addTownship('portjefferson','Port Jefferson');
//          addTownship('portjeffersonstation','Port Jefferson Station');
//          addTownship('quogue','Quogue');
//          addTownship('remsenburg','Remsenburg');
//          addTownship('ridge','Ridge');
//          addTownship('riverhead','Riverhead');
//          addTownship('rockypoint','Rocky Point');
//          addTownship('ronkonkoma','Ronkonkoma');
//          addTownship('sagharbor','Sag Harbor');
//          addTownship('sagaponack','Sagaponack');
//          addTownship('saltaire','Saltaire');
//          addTownship('sayville','Sayville');
//          addTownship('seaview','Seaview');
//          addTownship('selden','Selden');
//          addTownship('setauket','Setauket');
//          addTownship('shelterisland','Shelter Island');
//          addTownship('shirley','Shirley');
//          addTownship('shoreham','Shoreham');
//          addTownship('smithtown','Smithtown');
//          addTownship('soundbeach','Sound Beach');
//          addTownship('southhuntington','South Huntington');
//          addTownship('southjamesport','South Jamesport');
//          addTownship('southsetauket','South Setauket');
//          addTownship('southampton','Southampton');
//          addTownship('southold','Southold');
//          addTownship('southshore','Southshore');
//          addTownship('speonk','Speonk');
//          addTownship('stjames','St. James');
//          addTownship('stonybrook','Stony Brook');
//          addTownship('terryville','Terryville');
//          addTownship('wadingriver','Wading River');
//          addTownship('wainscott','Wainscott');
//          addTownship('waterisland','Water Island');
//          addTownship('watermill','Watermill');
//          addTownship('westbabylon','West Babylon');
//          addTownship('westbayshore','West Bay Shore');
//          addTownship('westislip','West Islip');
//          addTownship('westsayville','West Sayville');
//          addTownship('westyaphank','West Yaphank');
//          addTownship('westhampton','West Hampton');
//          addTownship('westhamptonbeach','Westhampton Beach');
//          addTownship('wheatleyheights','Wheatley Heights');
//          addTownship('wyandanch','Wyandanch');
//          addTownship('yaphank','Yaphank');
//          break;   
//     
//     case "sullivan":
//          addTownship('NA','Select Township');
//          addTownship('barryville','Barryville');
//          addTownship('bethel','Bethel');
//          addTownship('bloomingburg','Bloomingburg');
//          addTownship('callicoon','Callicoon');
//          addTownship('cochecton','Cochecton');
//          addTownship('cuddebackville','Cuddebackville');
//          addTownship('delaware','Delaware');
//          addTownship('eldred','Eldred');
//          addTownship('fallsburg','Fallsburg');
//          addTownship('ferndale','Fernale');
//          addTownship('forestburg','Forestburg');
//          addTownship('freemont','Freemont');
//          addTownship('glenspy','Glen Spy');
//          addTownship('glenwild','Glen Wild');
//          addTownship('harris','Harris');
//          addTownship('highland','Highland');
//          addTownship('hurleyville','Hurleyville');
//          addTownship('jeffersonville','Jeffersonville');
//          addTownship('kauneongalake','Kauneonga Lake');
//          addTownship('kenozalake','Kenona Lake');
//          addTownship('kiameshalake','Kiamesha Lake');
//          addTownship('liberty','Liberty');
//          addTownship('livingstonmanor','Livingston Manor');
//          addTownship('lochsheldrake','Loch Sheldrake');
//          addTownship('lumberland','Lumberland');
//          addTownship('mamakating','Mamakating');
//          addTownship('monticello','Monticello');
//          addTownship('mountaindale','Mountain Dale');
//          addTownship('narrowsburg','Narrowsburg');
//          addTownship('neversink','Neversink');
//          addTownship('northbranch','North Branch');
//          addTownship('parksville','Parksville');
//          addTownship('rockhill','Rock Hill');
//          addTownship('rockland','Rockland');
//          addTownship('roscoe','Roscoe');
//          addTownship('southfallsburg','South Fallsburg');
//          addTownship('sullivan','Sullivan');
//          addTownship('summitville','Summitville');
//          addTownship('swanlake','Swan Lake');
//          addTownship('thompson','Thompson');
//          addTownship('thompsonville','Thompsonville');
//          addTownship('tusten','Tusten');
//          addTownship('westbrookville','Westbrookville');
//          addTownship('whitelake','White Lake');
//          addTownship('woodbourne','Woodbourne');
//          addTownship('woodridge','Woodridge');
//          addTownship('wurtsboro','Wurtsboro');
//          addTownship('youngsville','Youngsville');
//          addTownship('yulan','Yulan');
//          break;
//       
//         case "tioga":
//          addTownship('NA','Select Township');
//          addTownship('barton','Barton');
//          break;
//       
//         case "tompkins":
//          addTownship('NA','Select Township');
//          addTownship('dryden','Dryden');
//          addTownship('ithaca','Ithaca');
//          break;
//       
//        case "ulster":
//          addTownship('NA','Select Township');
//          addTownship('accord','Accord');
//          addTownship('bearsville','Bearsville');
//          addTownship('boiceville','Boiceville');
//          addTownship('chichester','Chichester');
//          addTownship('clintondale','Clintondale');
//          addTownship('cottekill','Cottekill');
//          addTownship('crawford','Crawford');
//          addTownship('denning','Denning');
//          addTownship('ellenville','Ellenville');
//          addTownship('esopus','Esopus');
//          addTownship('gardiner','Gardiner');
//          addTownship('glenford','Glenford');
//          addTownship('hardenburgh','Hardenburgh');
//          addTownship('highfalls','High Falls');
//          addTownship('highland','Highland');
//          addTownship('hurley','Hurley');
//          addTownship('kerhonkson','Kerhonkson');
//          addTownship('kingston','Kingston');
//          addTownship('lakekatrine','Lake Katrine');
//          addTownship('lloyd','Lloyd');
//          addTownship('marbletown','Marbletown');
//          addTownship('marlboro','Marlboro');
//          addTownship('marlborough','Marlborough');
//          addTownship('milton','Milton');
//          addTownship('modena','Modena');
//          addTownship('mountpleasant','Mount Pleasant');
//          addTownship('mounttremper','Mount Tremper');
//          addTownship('newpaltz','New Paltz');
//          addTownship('olive','Olive');
//          addTownship('olivebridge','Olivebridge');
//          addTownship('phoenicia','Phoenicia');
//          addTownship('pinebush','Pine Bush');
//          addTownship('pinehill','Pine Hill');
//          addTownship('plattekill','Plattekill');
//          addTownship('portewen','Port Ewen');
//          addTownship('rochester','Rochester');
//          addTownship('rosendale','Rosendale');
//          addTownship('ruby','Ruby');
//          addTownship('saugerties','Saugerties');
//          addTownship('shandaken','Shandaken');
//          addTownship('shawangunk','Shawangunk');
//          addTownship('stoneridge','Stone Ridge');
//          addTownship('ulster','Ulster');
//          addTownship('ulsterpark','Ulster Park');
//          addTownship('walkervalley','Walker Valley');
//          addTownship('wallkill','Wallkill');
//          addTownship('wawarswing','Wawarsing');
//          addTownship('westhurley','West Hurley');
//          addTownship('westschokan','West Schokan');
//          addTownship('willow','Willow');
//          addTownship('woodstock','Woodstock');
//          break;
//         
//          case "warren":
//          addTownship('NA','Select Township');
//          addTownship('bolton','Bolton');
//          addTownship('brantlake','Brant Lake');
//          addTownship('chestertown','Chestertown');
//          addTownship('hague','Hague');
//          addTownship('johnsburg','Johnsburg');
//          addTownship('lakegeorge','Lake George');
//          addTownship('lakeluzerne','Lake Luzerne');
//          addTownship('queensbury','Queensbury');
//          addTownship('warrensburg','Warrensburg');
//          break;
//          
//          case "washington":
//          addTownship('NA','Select Township');
//          addTownship('greenwich','Greenwich');
//          addTownship('hebron','Hebron');
//          break;
//         
//           case "wayne":
//          addTownship('NA','Select Township');
//          addTownship('lyons','Lyons');
//          addTownship('newark','Newark');
//          addTownship('wolcott','Wolcott');
//          break;
//     
//        case "westchester":
//          addTownship('NA','Select Township');
//          addTownship('amawalk','Amawalk');
//          addTownship('ardsley','Ardsley');
//          addTownship('ardsleyonhudson','Ardsley-on-Hudson');
//          addTownship('armonk','Armonk');
//          addTownship('baldwinplace','Baldwin Place');
//          addTownship('banksville','Banksville');
//          addTownship('bedford','Bedford');
//          addTownship('bedfordcorners','Bedford Corners');
//          addTownship('bedfordhills','Bedford Hills');
//          addTownship('briarcliff','Briar Cliff');
//          addTownship('briarcliffmanor','Briar Cliff Manor');
//          addTownship('briarcliffmanorwest','Briarcliff Manor West');
//          addTownship('bronxville','Bronxville');
//          addTownship('buchanan','Buchanan');
//          addTownship('chappaqua','Chappaqua');
//          addTownship('cortlandt','Cortlandt');
//          addTownship('cortlandtmanor','Cortlandt Manor');
//          addTownship('crestwood','Crestwood');
//          addTownship('crompond','Crompond');
//          addTownship('crossriver','Cross River');
//          addTownship('croton','Croton');
//          addTownship('crotonfalls','Croton Falls');
//          addTownship('crotononhudson','Croton-on-Hudson');
//          addTownship('crugers','Crugers');
//          addTownship('dobbsferry','Dobbs Ferry');
//          addTownship('eastirvington','East Irvington');
//          addTownship('eastchester','Eastchester');
//          addTownship('elmsford','Elmsford');
//          addTownship('garnerville','Garnerville');
//          addTownship('goldensbridge','Goldens Bridge');
//          addTownship('granitesprings','Granite Springs');
//          addTownship('greenburgh','Greenburgh');
//          addTownship('harrison','Harrison');
//          addTownship('hartsdale','Hartsdale');
//          addTownship('hastings','Hastings');
//          addTownship('hastingsonhudson','Hastings-on-Hudson');
//          addTownship('hawthorne','Hawthrone');
//          addTownship('irvington','Irvington');
//          addTownship('jeffersonvalley','Jefferson Valley');
//          addTownship('katonah','Katonah');
//          addTownship('lakemohegan','Lake Mohegan');
//          addTownship('lakepurdy','Lake Purdy');
//          addTownship('larchmont','Larchmont');
//          addTownship('lewisboro','Lewisboro');
//          addTownship('lincolndale','Lincolndale');
//          addTownship('mamaroneck','Mamaroneck');
//          addTownship('mamroneckvillage','Mamaroneck Village');
//          addTownship('millwood','Millwood');
//          addTownship('moheganlake','Mohegan Lake');
//          addTownship('montrose','Montrose');
//          addTownship('mountkisco','Mount Kisco');
//          addTownship('mountkiscovillage','Mount Kisco Village');
//          addTownship('mountpleasant','Mount Pleasant');
//          addTownship('mountvernon','Mount Vernon');
//          addTownship('newcastle','New Castle');
//          addTownship('newrochelle','New Rochelle');
//          addTownship('northcastle','North Castle');
//          addTownship('northpelham','North Pelham');
//          addTownship('northsalem','North Salem');
//          addTownship('northtarrytown','North Tarrytown');
//          addTownship('northwhiteplains','North White Plains');
//          addTownship('ossining','Ossining');
//          addTownship('ossiningvillage','Ossining Village');
//          addTownship('peekskill','Peekskill');
//          addTownship('pelham','Pelham');
//          addTownship('pelhammanor','Pelham Manor');
//          addTownship('pelhamvillage','Pelham Village');
//          addTownship('pleasantville','Pleasantville');
//          addTownship('portchester','Port Chester');
//          addTownship('poundridge','Pound Ridge');
//          addTownship('purchase','Purchase');
//          addTownship('purdys','Purdys');
//          addTownship('purdysstation','Purdys Station');
//          addTownship('rye','Rye');
//          addTownship('ryebrook','Rye Brook');
//          addTownship('ryecity','Rye City');
//          addTownship('ryeneck','Ryeneck');
//          addTownship('scarbourough','Scarborough');
//          addTownship('scarsdale','Scarsdale');
//          addTownship('scarsdalevillage','Scarsdale Village');
//          addTownship('shenorock','Shenorock');
//          addTownship('shruboak','Shrub Oak');
//          addTownship('sleepyhollow','Sleepy Hollow');
//          addTownship('somers','Somers');
//          addTownship('southsalem','South Salem');
//          addTownship('tarrytown','Tarrytown');
//          addTownship('thornwood','Thornwood');
//          addTownship('tuckahoe','Tuckahoe');
//          addTownship('valhalla','Valhalla');
//          addTownship('verplanck','Verplanck');
//          addTownship('waccabuc','Waccabuc');
//          addTownship('westharrison','West Harrison');
//          addTownship('whiteplains','White Plains');
//          addTownship('yonkers','Yonkers');
//          addTownship('yorktown','Yorktown');
//          addTownship('yorktownheights','Yorktown Heights');     
//          break;
//         
//         case "washington":
//          addTownship('NA','Select Township');
//          addTownship('pennyan','Penn Yan');
//          break;
//         
//         default:
//         addTownship('NA','Select Township');
//         
//         }// end NY
//         
//case "PA":
//        clearTownships();
//            switch(document.CALC.county.value.toLowerCase()){
//                case "allegheny":
//                  clearTownships();
//                  addTownship('bellevue','Bellevue');
//                  addTownship('bethelpark','Bethel Park');
//                  addTownship('greentree','Greentree');
//                  addTownship('hampton','Hampton');
//                  addTownship('mccandless','McCandless');
//                  addTownship('mckeesport','McKeesport');
//                  addTownship('monroeville','Monroeville');
//                  addTownship('mtlebanon','Mt. Lebanon');
//                  addTownship('mtoliver','Mt. Oliver');
//                  addTownship('ohara',"O'Hara");
//                  addTownship('pennhills','Penn Hills');
//                  addTownship('pine','Pine');
//                  addTownship('pittsburgh','Pittsburgh');
//                  addTownship('upperstclair','Upper St. Clair');
//                  addTownship('westdeer','West Deer');
//                  addTownship('whitehall','Whitehall');
//                  addTownship('NA','All Other Townships');
//                  break;
//
//                case "beaver":
//                  clearTownships();
//                  addTownship('georgetown','Georgetown');
//                  addTownship('hookstown','Hookstown');
//                  addTownship('NA','All Other Townships');
//                  break;
//
//                case "berks":
//                  clearTownships();
//                  addTownship('reading','Reading');
//                  addTownship('NA','All Other Townships');
//                  break;
//
//                case "bucks":
//                  clearTownships();
//                  addTownship('Buckingham Township','Buckingham Township');
//                  addTownship('Doylestown Borough','Doylestown Borough');
//                  addTownship('Doylestown Township','Doylestown Township');
//                  addTownship('Durham Township','Durham Township');
//                  addTownship('Lower Southampton Township','Lower Southampton Township');
//                  addTownship('Morrisville Borough','Morrisville Borough');
//                  addTownship('New Britain Borough','New Britain Borough');
//                  addTownship('New Britain Township','New Britain Township');
//                  addTownship('Newtown Borough','Newtown Borough');
//                  addTownship('Perkasie Borough','Perkasie Borough');
//                  addTownship('Quakertown Borough','Quakertown Borough');
//                  addTownship('Sellersville Borough','Sellersville Borough');
//                  addTownship('Warwick Township','Warwick Township');
//                  addTownship('West Rockhill Township','West Rockhill Township');
//                  addTownship('Wrightstown Township','Wrightstown Township');
//                  addTownship('NA','All Other Townships');
//                  break;
//
//                case "cambria":
//                  clearTownships();
//                  addTownship('City of Johnston','City of Johnston');
//                  addTownship('Hastings Borough','Hastings Borough');
//                  addTownship('Nanty Glo Borough','Nanty Glo Borough');
//                  addTownship('Westmont Borough','Westmont Borough');
//                  addTownship('NA','All Other Townships');
//                  break;
//                
//                case "centre":
//                  clearTownships();
//                  addTownship('ferguson','Ferguson');
//                  addTownship('statecollege','State College');
//                  addTownship('Taylor Township','Taylor Township');
//                  addTownship('NA','All Other Townships');
//                  break;
//
//                case "chester":
//                  clearTownships();
//                  addTownship('coatesville','Coatesville City');
//                  addTownship('tredyffrin','Tredyffrin');
//                  addTownship('NA','All Other Townships');
//                  break;
//
//                case "clinton":
//                  clearTownships();
//                  addTownship('colebrook','Colebrook');
//                  addTownship('eastkating','East Kating');
//                  addTownship('NA','All Other Townships');
//                  break;
//
//                case "cumberland":
//                  clearTownships();
//                  addTownship('Camp Hill Borough','Camp Hill Borough');
//                  addTownship('Lemoyne Borough','Lemoyne Borough');
//                  addTownship('New Cumberland Borough','New Cumberland Borough');
//                  addTownship('NA','All Other Townships');
//                  break;
//                  
//                case "dauphin":
//                  clearTownships();
//                  addTownship('Harrisburg City','Harrisburg City');
//                  addTownship('NA','All Other Townships');
//                  break;
//                  
//                  
//                  case "delaware":
//                  clearTownships();
//                  addTownship('radnor','Radnor');
//                  addTownship('upperprovidence','Upper Providence');
//                  addTownship('NA','All Other Townships');
//                  break;
//
//                case "erie":
//                  clearTownships();
//                  addTownship('edinboro','Edinboro');
//                  addTownship('NA','All Other Townships');
//                  break;
//
//                case "lackawanna":
//                  clearTownships();
//                  addTownship('scranton','Scranton');
//                  addTownship('NA','All Other Townships');
//                  break;
//
//                case "luzerne":
//                  clearTownships();
//                  addTownship('kingston','Kingston');
//                  addTownship('wilkesbarre','Wilkes-Barre');
//                  addTownship('NA','All Other Townships');
//                  break;
//
//                case "mercer":
//                  clearTownships();
//                  addTownship('farrell','Farrell');
//                  addTownship('hermitage','Hermitage');
//                  addTownship('sheakleyville','Sheakleyville');
//                  addTownship('NA','All Other Townships');
//                  break;
//
//                case "somerset":
//                  clearTownships();
//                  addTownship('wellersburg','Wellersburg');
//                  addTownship('NA','All Other Townships');
//                  break;
//
//                case "washington":
//                  clearTownships();
//                  addTownship('peters','Peters');
//                  addTownship('NA','All Other Townships');
//                  break;
//            
//	        default:
//		   clearTownships();
//                   addTownship('All Townships','All Townships');	
//	    }
//            break; //End PA                  
//
//              case "RI":
//                clearTownships();
//              switch(document.CALC.county.value){
//                  case "Bristol":
//                    clearTownships();
//                    addTownship('Barrington','Barrington');
//                    addTownship('Bristol','Bristol');
//                    addTownship('Warren','Warren');
//                    addTownship('NA','All Other Townships');  
//                  break;
//                 
//                  case "Kent":
//                    clearTownships();
//                    addTownship('Coventry','Coventry');
//                    addTownship('East Greenwich','East Greenwich');
//                    addTownship('Warwick','Warwick');
//                    addTownship('West Greenwich','West Greenwich');
//                    addTownship('West Warwick','West Warwick');
//                    addTownship('NA','All Other Townships');  
//                  break;
//
//                  case "Newport":
//                    clearTownships();
//                    addTownship('Jamestown','Jamestown');
//                    addTownship('Little Compton','Little Compton');
//                    addTownship('Middletown','Middletown');
//                    addTownship('Newport','Newport');
//                    addTownship('Portsmouth','Portsmouth');
//                    addTownship('Tiverton','Tiverton');
//                    addTownship('NA','All Other Townships');  
//                  break;
//                 
//                  case "Providence":
//                    clearTownships();
//                    addTownship('Burrillville','Burrillville');
//                    addTownship('Central Falls','Central Falls');
//                    addTownship('Cranston','Cranston');
//                    addTownship('Cumberland','Cumberland');
//                    addTownship('East Providence','East Providence');
//                    addTownship('Foster','Foster');
//                    addTownship('Glocester','Glocester');
//                    addTownship('Johnston','Johnston');
//                    addTownship('Lincoln','Lincoln');
//                    addTownship('North Providence','North Providence');
//                    addTownship('North Smithfield','North Smithfield');
//                    addTownship('Pawtucket','Pawtucket');
//                    addTownship('Providence','Providence');
//                    addTownship('Scituate','Scituate');
//                    addTownship('Smithfield','Smithfield');
//                    addTownship('Woonsocket','Woonsocket');     
//                    addTownship('NA','All Other Townships');  
//                  break;
// 
//                  case "Washington":
//                    clearTownships();
//                    addTownship('Charlestown','Charlestown');
//                    addTownship('Exeter','Exeter');
//                    addTownship('Hopkinton','Hopkinton');
//                    addTownship('Narragansett','Narragansett');
//                    addTownship('New Shoreham (Block Island)','New Shoreham (Block Island)');
//                    addTownship('North Kingstown','North Kingstown');
//                    addTownship('Richmond','Richmond');
//                    addTownship('South Kingstown','South Kingstown');
//                    addTownship('Westerly','Westerly');
//                    addTownship('NA','All Other Townships');  
//                  break;
//  
//               default:
//               clearTownships();
//               addTownship('NA','All Townships');
//
//              }//end switch
//              break;
//               
//             case "SC":
//                clearTownships();
//              switch(document.CALC.county.value.toLowerCase()){
//                  case "beaufort":
//                    clearTownships();
//                    addTownship('Hilton Head','Hilton Head');
//                    addTownship('NA','All Other Townships');  
//                  break;
//
//               default:
//               clearTownships();
//               addTownship('NA','All Townships');
//
//              }//end switch
//              break;
//              
//               case "VT":
//                clearTownships();
//              switch(document.CALC.county.value){
//                  case "Addison":
//                    clearTownships();
//                    addTownship('Addison','Addison');
//                    addTownship('Bridport','Bridport');
//                    addTownship('Bristol','Bristol');
//                    addTownship('Cornwall','Cornwall');
//                    addTownship('Ferrisburgh','Ferrisburgh');
//                    addTownship('Goshen','Goshen');
//                    addTownship('Granville','Granville');
//                    addTownship('Hancock','Hancock');
//                    addTownship('Leicester','Leicester');
//                    addTownship('Lincoln','Lincoln');
//                    addTownship('Middlebury','Middlebury');
//                    addTownship('Monkton','Monkton');
//                    addTownship('New Haven','New Haven');
//                    addTownship('Orwell','Orwell');
//                    addTownship('Panton','Panton');
//                    addTownship('Ripton','Ripton');
//                    addTownship('Salisbury','Salisbury');
//                    addTownship('Shoreham','Shoreham');
//                    addTownship('Starksboro','Starksboro');
//                    addTownship('Vergennes','Vergennes');
//                    addTownship('Waltham','Waltham');
//                    addTownship('Weybridge','Weybridge');
//                    addTownship('Whiting','Whiting');
//                    addTownship('NA','All Other Townships');  
//                  break;
//                 
//                  case "Bennington":
//                    clearTownships();
//                    addTownship('Arlington','Arlington');
//                    addTownship('Bennington','Bennington');
//                    addTownship('Dorset','Dorset');
//                    addTownship('Landgrove','Landgrove');
//                    addTownship('Manchester','Manchester');
//                    addTownship('Peru','Peru');
//                    addTownship('Pownal','Pownal');
//                    addTownship('Readsboro','Readsboro');
//                    addTownship('Rupert','Rupert');
//                    addTownship('Sandgate','Sandgate');
//                    addTownship('Searsburg','Searsburg');
//                    addTownship('Shaftsbury','Shaftsbury');
//                    addTownship('Stamford','Stamford');
//                    addTownship('Sunderland','Sunderland');
//                    addTownship('Winhall','Winhall');
//                    addTownship('Woodford','Woodford');
//                    addTownship('NA','All Other Townships');  
//                  break;
// 
//                 case "Caledonia":
//                    clearTownships();
//                    addTownship('Barnet','Barnet');
//                    addTownship('Burke','Burke');
//                    addTownship('Danville','Danville');
//                    addTownship('Groton','Groton');
//                    addTownship('Hardwick','Hardwick');
//                    addTownship('Kirby','Kirby');
//                    addTownship('Lyndon','Lyndon');
//                    addTownship('Newark','Newark');
//                    addTownship('Peacham','Peacham');
//                    addTownship('Ryegate','Ryegate');
//                    addTownship('Sheffield','Sheffield');
//                    addTownship('St. Johnsbury','St. Johnsbury');
//                    addTownship('Stannard','Stannard');
//                    addTownship('Sutton','Sutton');
//                    addTownship('Walden','Walden');
//                    addTownship('Waterford','Waterford');
//                    addTownship('Wheelock','Wheelock');
//                    addTownship('NA','All Other Townships');  
//                  break;
//                 
//                  case "Chittenden":
//                    clearTownships();
//                    addTownship('Bolton','Bolton');
//                    addTownship('Burlington','Burlington');
//                    addTownship('Charlotte','Charlotte');
//                    addTownship('Colchester','Colchester');
//                    addTownship('Essex','Essex');
//                    addTownship('Hinesburg','Hinesburg');
//                    addTownship('Huntington','Huntington');
//                    addTownship('Jericho','Jericho');
//                    addTownship('Milton','Milton');
//                    addTownship('Richmond','Richmond');
//                    addTownship('Shelburne','Shelburne');
//                    addTownship('South Burlington','South Burlington');
//                    addTownship('St. George','St. George');
//                    addTownship('Underhill','Underhill');
//                    addTownship('Westford','Westford');
//                    addTownship('Williston','Williston');
//                    addTownship('Winooski','Winooski');
//                    addTownship('NA','All Other Townships');  
//                  break;
// 
//                 case "Essex":
//                    clearTownships();
//                    addTownship('Bloomfield','Bloomfield');
//                    addTownship('Brighton','Brighton');
//                    addTownship('Brunswick','Brunswick');
//                    addTownship('Canaan','Canaan');
//                    addTownship('Concord','Concord');
//                    addTownship('East Haven','East Haven');
//                    addTownship('Granby','Granby');
//                    addTownship('Guildhall','Guildhall');
//                    addTownship('Lemington','Lemington');
//                    addTownship('Lunenburg','Lunenburg');
//                    addTownship('Maidstone','Maidstone');
//                    addTownship('Norton','Norton');
//                    addTownship('Victory','Victory');
//                    addTownship('NA','All Other Townships');  
//                  break;
//                 
//                  case "Franklin":
//                    clearTownships();
//                    addTownship('Bakersfield','Bakersfield');
//                    addTownship('Berkshire','Berkshire');
//                    addTownship('Enosburg','Enosburg');
//                    addTownship('Fairfax','Fairfax');
//                    addTownship('Fairfield','Fairfield');
//                    addTownship('Fletcher','Fletcher');
//                    addTownship('Franklin','Franklin');
//                    addTownship('Georgia','Georgia');
//                    addTownship('Highgate','Highgate');
//                    addTownship('Montgomery','Montgomery');
//                    addTownship('Richford','Richford');
//                    addTownship('Sheldon','Sheldon');
//                    addTownship('St. Albans City','St. Albans City');
//                    addTownship('St. Albans Town','St. Albans Town');
//                    addTownship('Swanton','Swanton');
//                    addTownship('NA','All Other Townships');  
//                  break;
//
//                 case "Grand Isle":
//                    clearTownships();
//                    addTownship('Alburg','Alburg');
//                    addTownship('Grand Isle','Grand Isle');
//                    addTownship('Isle La Motte','Isle La Motte');
//                    addTownship('North Hero','North Hero');
//                    addTownship('South Hero','South Hero');
//                    addTownship('NA','All Other Townships');  
//                  break;
//                 
//                  case "Lamoille":
//                    clearTownships();
//                    addTownship('Belvidere','Belvidere');
//                    addTownship('Cambridge','Cambridge');
//                    addTownship('Eden','Eden');
//                    addTownship('Elmore','Elmore');
//                    addTownship('Hyde Park','Hyde Park');
//                    addTownship('Johnson','Johnson');
//                    addTownship('Morristown','Morristown');
//                    addTownship('Stowe','Stowe');
//                    addTownship('Waterville','Waterville');
//                    addTownship('Wolcott','Wolcott');
//                    addTownship('NA','All Other Townships');  
//                  break;
//                
//                 case "Orange":
//                    clearTownships();
//                    addTownship('Bradford','Bradford');
//                    addTownship('Braintree','Braintree');
//                    addTownship('Brookfield','Brookfield');
//                    addTownship('Chelsea','Chelsea');
//                    addTownship('Corinth','Corinth');
//                    addTownship('Fairlee','Fairlee');
//                    addTownship('Newbury','Newbury');
//                    addTownship('Orange','Orange');
//                    addTownship('Randolph','Randolph');
//                    addTownship('Strafford','Strafford');
//                    addTownship('Thetford','Thetford');
//                    addTownship('Topsham','Topsham');
//                    addTownship('Tunbridge','Tunbridge');
//                    addTownship('Vershire','Vershire');
//                    addTownship('Washington','Washington');
//                    addTownship('West Fairlee','West Fairlee');
//                    addTownship('Williamstown','Williamstown');
//                    addTownship('NA','All Other Townships');  
//                  break;
//                 
//                  case "Orleans":
//                    clearTownships();
//                    addTownship('Albany','Albany');
//                    addTownship('Barton','Barton');
//                    addTownship('Brownington','Brownington');
//                    addTownship('Charleston','Charleston');
//                    addTownship('Coventry','Coventry');
//                    addTownship('Craftsbury','Craftsbury');
//                    addTownship('Derby','Derby');
//                    addTownship('Glover','Glover');
//                    addTownship('Greensboro','Greensboro');
//                    addTownship('Holland','Holland');
//                    addTownship('Irasburg','Irasburg');
//                    addTownship('Jay','Jay');
//                    addTownship('Lowell','Lowell');
//                    addTownship('Morgan','Morgan');
//                    addTownship('Newport City','Newport City');
//                    addTownship('Newport Town','Newport Town');
//                    addTownship('Troy','Troy');
//                    addTownship('Westfield','Westfield');
//                    addTownship('Westmore','Westmore');
//                    addTownship('NA','All Other Townships');  
//                  break;
//
//                  case "Rutland":
//                    clearTownships();
//                    addTownship('Benson','Benson');
//                    addTownship('Brandon','Brandon');
//                    addTownship('Castleton','Castleton');
//                    addTownship('Chittenden','Chittenden');
//                    addTownship('Clarendon','Clarendon');
//                    addTownship('Danby','Danby');
//                    addTownship('Fair Haven','Fair Haven');
//                    addTownship('Hubbardton','Hubbardton');
//                    addTownship('Ira','Ira');
//                    addTownship('Killington','Killington');
//                    addTownship('Mendon','Mendon');
//                    addTownship('Middletown Springs','Middletown Springs');
//                    addTownship('Mount Holly','Mount Holly');
//                    addTownship('Mount Tabor','Mount Tabor');
//                    addTownship('Pawlet','Pawlet');
//                    addTownship('Pittsfield','Pittsfield');
//                    addTownship('Pittsford','Pittsford');
//                    addTownship('Poultney','Poultney');
//                    addTownship('Proctor','Proctor');
//                    addTownship('Rutland City','Rutland City');
//                    addTownship('Rutland Town','Rutland Town');
//                    addTownship('Shrewsbury','Shrewsbury');
//                    addTownship('Sudbury','Sudbury');
//                    addTownship('Tinmouth','Tinmouth');
//                    addTownship('Wallingford','Wallingford');
//                    addTownship('Wells','Wells');
//                    addTownship('West Haven','West Haven');
//                    addTownship('West Rutland','West Rutland');
//                    addTownship('NA','All Other Townships');  
//                  break;
//                 
//                  case "Washington":
//                    clearTownships();
//                    addTownship('Barre City','Barre City');
//                    addTownship('Barre Town','Barre Town');
//                    addTownship('Berlin','Berlin');
//                    addTownship('Cabot','Cabot');
//                    addTownship('Calais','Calais');
//                    addTownship('Duxbury','Duxbury');
//                    addTownship('East Montpelier','East Montpelier');
//                    addTownship('Fayston','Fayston');
//                    addTownship('Marshfield','Marshfield');
//                    addTownship('Middlesex','Middlesex');
//                    addTownship('Montpelier','Montpelier');
//                    addTownship('Moretown','Moretown');
//                    addTownship('Northfield','Northfield');
//                    addTownship('Plainfield','Plainfield');
//                    addTownship('Roxbury','Roxbury');
//                    addTownship('Waitsfield','Waitsfield');
//                    addTownship('Warren','Warren');
//                    addTownship('Waterbury','Waterbury');
//                    addTownship('Woodbury','Woodbury');
//                    addTownship('Worcester','Worcester');
//                    addTownship('NA','All Other Townships');  
//                  break;
//
//                 case "Windham":
//                    clearTownships();
//                    addTownship('Athens','Athens');
//                    addTownship('Brattleboro','Brattleboro');
//                    addTownship('Brookline','Brookline');
//                    addTownship('Dover','Dover');
//                    addTownship('Dummerston','Dummerston');
//                    addTownship('Grafton','Grafton');
//                    addTownship('Guilford','Guilford');
//                    addTownship('Halifax','Halifax');
//                    addTownship('Jamaica','Jamaica');
//                    addTownship('Londonderry','Londonderry');
//                    addTownship('Marlboro','Marlboro');
//                    addTownship('Newfane','Newfane');
//                    addTownship('Putney','Putney');
//                    addTownship('Rockingham','Rockingham');
//                    addTownship('Stratton','Stratton');
//                    addTownship('Townshend','Townshend');
//                    addTownship('Vernon','Vernon');
//                    addTownship('Wardsboro','Wardsboro');
//                    addTownship('Westminster','Westminster');
//                    addTownship('Whitingham','Whitingham');
//                    addTownship('Wilmington','Wilmington');
//                    addTownship('Windham','Windham');
//                    addTownship('NA','All Other Townships');  
//                  break;
//                 
//                  case "Windsor":
//                    clearTownships();
//                    addTownship('Andover','Andover');
//                    addTownship('Baltimore','Baltimore');
//                    addTownship('Barnard','Barnard');
//                    addTownship('Bethel','Bethel');
//                    addTownship('Bridgewater','Bridgewater');
//                    addTownship('Cavendish','Cavendish');
//                    addTownship('Hartford','Hartford');
//                    addTownship('Hartland','Hartland');
//                    addTownship('Ludlow','Ludlow');
//                    addTownship('Norwich','Norwich');
//                    addTownship('Plymouth','Plymouth');
//                    addTownship('Pomfret','Pomfret');
//                    addTownship('Reading','Reading');
//                    addTownship('Rochester','Rochester');
//                    addTownship('Royalton','Royalton');
//                    addTownship('Sharon','Sharon');
//                    addTownship('Springfield','Springfield');
//                    addTownship('Stockbridge','Stockbridge');
//                    addTownship('Weathersfield','Weathersfield');
//                    addTownship('West Windsor','West Windsor');
//                    addTownship('Weston','Weston');
//                    addTownship('Windsor','Windsor');
//                    addTownship('Woodstock','Woodstock');
//                    addTownship('NA','All Other Townships');  
//                  break;                  
//                
//               default:
//               clearTownships();
//               addTownship('NA','All Townships');
//
//              }//end switch
//              break;  // End VT
//                             
//               case "WA":
//                clearTownships();
//              switch(document.CALC.county.value){
//                  case "Asotin":
//                    clearTownships();
//                    addTownship('Asotin','Asotin');
//                    addTownship('NA','All Other Townships');  
//                  break;
//                 
//                  case "Benton":
//                    clearTownships();
//                    addTownship('Kennewick','Kennewick');
//                    addTownship('Prosser','Prosser');
//                    addTownship('Richland','Richland');
//                    addTownship('West Richland','West Richland');
//                    addTownship('NA','All Other Townships');  
//                  break;
//
//                  case "Chelan":
//                    clearTownships();
//                    addTownship('Cashmere','Cashmere');
//                    addTownship('Chelan','Chelan');
//                    addTownship('Entiat','Entiat');
//                    addTownship('Leavenworth','Leavenworth');
//                    addTownship('Wenatchee','Wenatchee');
//                    addTownship('NA','All Other Townships');  
//                  break;
//                 
//                  case "Clallam":
//                    clearTownships();
//                    addTownship('Forks','Forks');
//                    addTownship('NA','All Other Townships');  
//                  break;
//
//                  case "Clark":
//                    clearTownships();
//                    addTownship('Yacolt','Yacolt');
//                    addTownship('NA','All Other Townships');  
//                  break;
//                 
//                  case "Columbia":
//                    clearTownships();
//                    addTownship('Dayton','Dayton');
//                    addTownship('Starbuck','Starbuck');
//                    addTownship('NA','All Other Townships');  
//                  break;
//
//                 case "Cowlitz":
//                    clearTownships();
//                    addTownship('Woodland','Woodland');
//                    addTownship('NA','All Other Townships');  
//                  break;
//                 
//                  case "Douglas":
//                    clearTownships();
//                    addTownship('East Wenatchee','East Wenatchee');
//                    addTownship('Mansfield','Mansfield');
//                    addTownship('Waterville','Waterville');
//                    addTownship('NA','All Other Townships');  
//                  break;
//
//                  case "Franklin":
//                    clearTownships();
//                    addTownship('Connell','Connell');
//                    addTownship('Kahlotus','Kahlotus');
//                    addTownship('Mesa','Mesa');
//                    addTownship('Pasco','Pasco');
//                    addTownship('NA','All Other Townships');  
//                  break;
//                 
//                  case "Grant":
//                    clearTownships();
//                    addTownship('Coulee City','Coulee City');
//                    addTownship('Electric City','Electric City');
//                    addTownship('Ephrata','Ephrata');
//                    addTownship('George','George');
//                    addTownship('Grand Coulee','Grand Coulee');
//                    addTownship('Hartline','Hartline');
//                    addTownship('Krupp','Krupp');
//                    addTownship('Mattawa','Mattawa');
//                    addTownship('Moses Lake','Moses Lake');
//                    addTownship('Quincy','Quincy');
//                    addTownship('Royal City','Royal City');
//                    addTownship('Soap Lake','Soap Lake');
//                    addTownship('Warden','Warden');
//                    addTownship('Wilson Creek','Wilson Creek');
//                    addTownship('NA','All Other Townships');  
//                  break;
//                
//                  case "King":
//                    clearTownships();
//                    addTownship('Skykomish','Skykomish');
//                    addTownship('NA','All Other Townships');  
//                  break;
//                 
//                  case "Klickitat":
//                    clearTownships();
//                    addTownship('Bingen','Bingen');
//                    addTownship('Goldendale','Goldendale');
//                    addTownship('White Salmon','White Salmon');
//                    addTownship('NA','All Other Townships');  
//                  break;
//                
//                  case "Lewis":
//                    clearTownships();
//                    addTownship('Centralia','Centralia');
//                    addTownship('Chehalis','Chehalis');
//                    addTownship('Morton','Morton');
//                    addTownship('Mossyrock','Mossyrock');
//                    addTownship('Napavine','Napavine');
//                    addTownship('Pe Ell','Pe Ell');
//                    addTownship('Toledo','Toledo');
//                    addTownship('Vader','Vader');
//                    addTownship('Winlock','Winlock');
//                    addTownship('NA','All Other Townships');  
//                  break;
//                 
//                  case "Okanogan":
//                    clearTownships();
//                    addTownship('Coulee Dam','Coulee Dam');
//                    addTownship('Elmer City','Elmer City');
//                    addTownship('Nespelem','Nespelem');
//                    addTownship('NA','All Other Townships');  
//                  break;
//
//                  case "Pend Oreille":
//                    clearTownships();
//                    addTownship('Metaline','Metaline');
//                    addTownship('Newport','Newport');
//                    addTownship('NA','All Other Townships');  
//                  break;
//                 
//                  case "Pierce":
//                    clearTownships();
//                    addTownship('Eatonville','Eatonville');
//                    addTownship('Wilkeson','Wilkeson');
//                    addTownship('NA','All Other Townships');  
//                  break;
//
//                  case "Snohomish":
//                    clearTownships();
//                    addTownship('Darrington','Darrington');
//                    addTownship('NA','All Other Townships');  
//                  break;
//                 
//                  case "Spokane":
//                    clearTownships();
//                    addTownship('Fairfield','Fairfield');
//                    addTownship('Latah','Latah');
//                    addTownship('Medical Lake','Medical Lake');
//                    addTownship('Rockford','Rockford');
//                    addTownship('Spangle','Spangle');
//                    addTownship('Waverly','Waverly');
//                    addTownship('NA','All Other Townships');  
//                  break;
//
//                  case "Thurston":
//                    clearTownships();
//                    addTownship('Rainier','Rainier');
//                    addTownship('Yelm','Yelm');
//                    addTownship('NA','All Other Townships');  
//                  break;
//                 
//                  case "Walla Walla":
//                    clearTownships();
//                    addTownship('Prescott','Prescott');
//                    addTownship('Waitsburg','Waitsburg');
//                    addTownship('NA','All Other Townships');  
//                  break;
// 
//                  case "Whitman":
//                    clearTownships();
//                    addTownship('Lamont','Lamont');
//                    addTownship('NA','All Other Townships');  
//                  break;
//                 
//                  case "Yakima":
//                    clearTownships();
//                    addTownship('City of Yakima','City of Yakima');
//                    addTownship('Grandview','Grandview');
//                    addTownship('Mabton','Mabton');
//                    addTownship('Sunnyside','Sunnyside');
//                    addTownship('Zillah','Zillah');
//                    addTownship('NA','All Other Townships');  
//                  break;
//                
//               default:
//               clearTownships();
//               addTownship('NA','All Townships');
//
//              }//end switch
//              break;
//                                              
//   default:
//      clearTownships();
//     addTownship('NA','All Townships');
//  }//end switch
//
//}
//
//
//function countyswitch(){
//
////document.CALC.outputtext.value=""; //=clears text area
//
//switch(document.CALC.state.value){
//     case "AK":
//      removeAllOptions();     
//      addOption('Anchorage','Anchorage');
//      addOption('Bethel','Bethel');
//      addOption('Bristol Bay','Bristol Bay');
//      addOption('Dillingham','Dillingham');
//      addOption('Fairbanks North Star','Fairbanks North Star');
//      addOption('Haines','Haines');
//      addOption('Juneau','Juneau');
//      addOption('Kenai Peninsula','Kenai Peninsula');
//      addOption('Ketchikan Gateway','Ketchikan Gateway');
//      addOption('Kodiak Island','Kodiak Island');
//      addOption('Matanuska-Susitna','Matanuska-Susitna');
//      addOption('Nome','Nome');
//      addOption('North Slope','North Slope');
//      addOption('Prince of Wales-Outer Ketchikan','Prince of Wales-Outer Ketchikan');
//      addOption('Sitka','Sitka');
//      addOption('Skagway-Hoonah-Angoon','Skagway-Hoonah-Angoon');
//      addOption('Southeast Fairbank','Southeast Fairbank');
//      addOption('Valdez-Cordova','Valdez-Cordova');
//      addOption('Wade Hampton','Wade Hampton');
//      addOption('Wrangell-Petersburg','Wrangell-Petersburg');
//      addOption('Yakutat','Yakutat');
//      addOption('Yukon-Koyukuk','Yukon-Koyukuk');
//     break;
//     
//     case "AL":
//      removeAllOptions();
//      addOption('autauga','Autauga');
//      addOption('baldwin','Baldwin');
//      addOption('babour','Babour');
//      addOption('bibb','Bibb');
//      addOption('blount','Blount');
//      addOption('bullock','Bullock');
//      addOption('butler','Butler');
//      addOption('calhoun','Calhoun');
//      addOption('chambers','Chambers');
//      addOption('cherokee','Cherokee');
//      addOption('chilton','Chilton');
//      addOption('choctaw','Choctaw');
//      addOption('clarke','Clarke');
//      addOption('clay','Clay');
//      addOption('cleburne','Cleburne');
//      addOption('crenshaw','Crenshaw');
//      addOption('cullman','Cullman');
//      addOption('covington','Covington');
//      addOption('coffee','Coffee');
//      addOption('conecuh','Conecuh');
//      addOption('coosa','Coosa');
//      addOption('dale','Dale');
//      addOption('dallas','Dallas');
//      addOption('dekalb','De Kalb');
//      addOption('elmore','Elmore');
//      addOption('escambia','Escambia');
//      addOption('etowah','Etowah');
//      addOption('fayette','Fayette');
//      addOption('franklin','Franklin');
//      addOption('geneva','Geneva');
//      addOption('greene','Greene');
//      addOption('hale','Hale');
//      addOption('henry','Henry');
//      addOption('houston','Houston');
//      addOption('jackson','Jackson');
//      addOption('jefferson','Jefferson');
//      addOption('lamar','Lamar');
//      addOption('lauderdale','Lauderdale');
//      addOption('lee','Lee');
//      addOption('limestone','Limestone');
//      addOption('lowndes','Lowndes');
//      addOption('macon','Macon');
//      addOption('madison','Madison');
//      addOption('marengo','Marengo');
//      addOption('marshall','Marshall');
//      addOption('mobile','Mobile');
//      addOption('monroe','Monroe');
//      addOption('montogomery','Montogomery');
//      addOption('morgan','Morgan');
//      addOption('perry','Perry');
//      addOption('pickens','Pickens');
//      addOption('pike','Pike');
//      addOption('randolph','Randolph');
//      addOption('russell','Russell');
//      addOption('shelby','Shelby');
//      addOption('stclair','St. Clair');
//      addOption('sumter','Sumter');
//      addOption('talladega','Talladega');
//      addOption('tallapoosa','Tallapoosa');
//      addOption('walker','Walker');
//      addOption('washington','Washington');
//      addOption('wilcox','Wilcox');
//      addOption('winston','Winston');
//     break;
//
//    case "AR":
//      removeAllOptions();
//      addOption('Arkansas','Arkansas');
//      addOption('Ashley','Ashley');
//      addOption('Baxter','Baxter');
//      addOption('Benton','Benton');
//      addOption('Boone','Boone');
//      addOption('Bradley','Bradley');
//      addOption('Calhoun','Calhoun');
//      addOption('Carroll','Carroll');
//      addOption('Chicot','Chicot');
//      addOption('Clark','Clark');
//      addOption('Clay','Clay');
//      addOption('Cleburne','Cleburne');
//      addOption('Cleveland','Cleveland');
//      addOption('Columbia','Columbia');
//      addOption('Conway','Conway');
//      addOption('Craighead','Craighead');
//      addOption('Crawford','Crawford');
//      addOption('Crittenden','Crittenden');
//      addOption('Cross','Cross');
//      addOption('Dallas','Dallas');
//      addOption('Desha','Desha');
//      addOption('Drew','Drew');
//      addOption('Faulkner','Faulkner');
//      addOption('Franklin','Franklin');
//      addOption('Fulton','Fulton');
//      addOption('Garland','Garland');
//      addOption('Grant','Grant');
//      addOption('Greene','Greene');
//      addOption('Hempstead','Hempstead');
//      addOption('Hot Spring','Hot Spring');
//      addOption('Howard','Howard');
//      addOption('Independence','Independence');
//      addOption('Izard','Izard');
//      addOption('Jackson','Jackson');
//      addOption('Jefferson','Jefferson');
//      addOption('Johnson','Johnson');
//      addOption('Lafayette','Lafayette');
//      addOption('Lawrence','Lawrence');
//      addOption('Lee','Lee');
//      addOption('Lincoln','Lincoln');
//      addOption('Little River','Little River');
//      addOption('Logan','Logan');
//      addOption('Lonoke','Lonoke');
//      addOption('Madison','Madison');
//      addOption('Marion','Marion');
//      addOption('Miller','Miller');
//      addOption('Mississippi','Mississippi');
//      addOption('Monroe','Monroe');
//      addOption('Montgomery','Montgomery');
//      addOption('Nevada','Nevada');
//      addOption('Newton','Newton');
//      addOption('Ouachita','Ouachita');
//      addOption('Perry','Perry');
//      addOption('Phillips','Phillips');
//      addOption('Pike','Pike');
//      addOption('Poinsett','Poinsett');
//      addOption('Polk','Polk');
//      addOption('Pope','Pope');
//      addOption('Prairie','Prairie');
//      addOption('Pulaski','Pulaski');
//      addOption('Randolph','Randolph');
//      addOption('Saline','Saline');
//      addOption('Scott','Scott');
//      addOption('Searcy','Searcy');
//      addOption('Sebastian','Sebastian');
//      addOption('Sevier','Sevier');
//      addOption('Sharp','Sharp');
//      addOption('St. Francis','St. Francis');
//      addOption('Stone','Stone');
//      addOption('Union','Union');
//      addOption('Van Buren','Van Buren');
//      addOption('Washington','Washington');
//      addOption('White','White');
//      addOption('Woodruff','Woodruff');
//      addOption('Yell','Yell');
//    break;
//    
//    case "AZ":
//      removeAllOptions();
//      addOption('Apache','Apache');
//      addOption('Cochise','Cochise');
//      addOption('Coconino','Coconino');
//      addOption('Gila','Gila');
//      addOption('Graham','Graham');
//      addOption('Greenlee','Greenlee');
//      addOption('La Paz','La Paz');
//      addOption('Maricopa','Maricopa');
//      addOption('Mohave','Mohave');
//      addOption('Navajo','Navajo');
//      addOption('Pima','Pima');
//      addOption('Pinal','Pinal');
//      addOption('Santa Cruz','Santa Cruz');
//      addOption('Yavapai','Yavapai');
//      addOption('Yuma','Yuma');
//    break;
//
//    case "CA":
//      removeAllOptions();  
//      addOption('Alameda','Alameda');
//      addOption('Alpine','Alpine');
//      addOption('Amador','Amador');
//      addOption('Butte','Butte');
//      addOption('Calaveras','Calaveras');
//      addOption('Colusa','Colusa');
//      addOption('Contra Costa','Contra Costa');
//      addOption('Del Norte','Del Norte');
//      addOption('El Dorado','El Dorado');
//      addOption('Fresno','Fresno');
//      addOption('Glenn','Glenn');
//      addOption('Humboldt','Humboldt');
//      addOption('Imperial','Imperial');
//      addOption('Inyo','Inyo');
//      addOption('Kern','Kern');
//      addOption('Kings','Kings');
//      addOption('Lake','Lake');
//      addOption('Lassen','Lassen');
//      addOption('Los Angeles','Los Angeles');
//      addOption('Madera','Madera');
//      addOption('Marin','Marin');
//      addOption('Mariposa','Mariposa');
//      addOption('Mendocino','Mendocino');
//      addOption('Merced','Merced');
//      addOption('Modoc','Modoc');
//      addOption('Mono','Mono');
//      addOption('Monterey','Monterey');
//      addOption('Napa','Napa');
//      addOption('Nevada','Nevada');
//      addOption('Orange','Orange');
//      addOption('Placer','Placer');
//      addOption('Plumas','Plumas');
//      addOption('Riverside','Riverside');
//      addOption('Sacramento','Sacramento');
//      addOption('San Benito','San Benito');
//      addOption('San Bernardino','San Bernardino');
//      addOption('San Diego','San Diego');
//      addOption('San Francisco','San Francisco');
//      addOption('San Joaquin','San Joaquin');
//      addOption('San Luis Obispo','San Luis Obispo');
//      addOption('San Mateo','San Mateo');
//      addOption('Santa Barbara','Santa Barbara');
//      addOption('Santa Clara','Santa Clara');
//      addOption('Santa Cruz','Santa Cruz');
//      addOption('Shasta','Shasta');
//      addOption('Sierra','Sierra');
//      addOption('Siskiyou','Siskiyou');
//      addOption('Solano','Solano');
//      addOption('Sonoma','Sonoma');
//      addOption('Stanislaus','Stanislaus');
//      addOption('Sutter','Sutter');
//      addOption('Tehama','Tehama');
//      addOption('Trinity','Trinity');
//      addOption('Tulare','Tulare');
//      addOption('Tuolumne','Tuolumne');
//      addOption('Ventura','Ventura');
//      addOption('Yolo','Yolo');
//      addOption('Yuba','Yuba');
//    break;
//  
//    case "CO":
//      removeAllOptions();
//      addOption('Adams','Adams');
//      addOption('Alamosa','Alamosa');
//      addOption('Arapahoe','Arapahoe');
//      addOption('Archuleta','Archuleta');
//      addOption('Baca','Baca');
//      addOption('Bent','Bent');
//      addOption('Boulder','Boulder');
//      addOption('Broomfield','Broomfield');
//      addOption('Chaffee','Chaffee');
//      addOption('Cheyenna','Cheyenna');
//      addOption('Clear Creek','Clear Creek');
//      addOption('Conejos','Conejos');
//      addOption('Costilla','Costilla');
//      addOption('Crowley','Crowley');
//      addOption('Custer','Custer');
//      addOption('Delta','Delta');
//      addOption('Denver','Denver');
//      addOption('Dolores','Dolores');
//      addOption('Douglas','Douglas');
//      addOption('Eagle','Eagle');
//      addOption('El Paso','El Paso');
//      addOption('Elbert','Elbert');
//      addOption('Fremont','Fremont');
//      addOption('Garfield','Garfield');
//      addOption('Gilpin','Gilpin');
//      addOption('Grand','Grand');
//      addOption('Gunnison','Gunnison');
//      addOption('Hinsdale','Hinsdale');
//      addOption('Huerfano','Huerfano');
//      addOption('Jackson','Jackson');
//      addOption('Jefferson','Jefferson');
//      addOption('Kiowa','Kiowa');
//      addOption('Kit Carson','Kit Carson');
//      addOption('LaPlata','LaPlata');
//      addOption('Lake','Lake');
//      addOption('Larimer','Larimer');
//      addOption('Las Animas','Las Animas');
//      addOption('Lincoln','Lincoln');
//      addOption('Logan','Logan');
//      addOption('Mesa','Mesa');
//      addOption('Mineral','Mineral');
//      addOption('Moffat','Moffat');
//      addOption('Montezuma','Montezuma');
//      addOption('Montrose','Montrose');
//      addOption('Morgan','Morgan');
//      addOption('Otero','Otero');
//      addOption('Ouray','Ouray');
//      addOption('Park','Park');
//      addOption('Phillips','Phillips');
//      addOption('Pitkin','Pitkin');
//      addOption('Prowers','Prowers');
//      addOption('Pueblo','Pueblo');
//      addOption('Rio Blanco','Rio Blanco');
//      addOption('Rio Grande','Rio Grande');
//      addOption('Routt','Routt');
//      addOption('Saguache','Saguache');
//      addOption('San Juan','San Juan');
//      addOption('San Miguel','San Miguel');
//      addOption('Sedgwick','Sedgwick');
//      addOption('Summit','Summit');
//      addOption('Teller','Teller');
//      addOption('Washington','Washington');
//      addOption('Weld','Weld');
//      addOption('Yuma','Yuma');
//     break;
//     
//    case "CT":
//        removeAllOptions();
//        addOption('fairfield','Fairfield');
//	addOption('hartford','Hartford');
//	addOption('litchfield','Litchfield');
//	addOption('middlesex','Middlesex');
//	addOption('newhaven','New Haven');
//	addOption('newlondon','New London');
//	addOption('tolland','Tolland');
//	addOption('windham','Windham'); 
//     break;     
//          
//     case "DE":
//        removeAllOptions();
//        addOption('kent','Kent');
//        addOption('newcastle','New Castle');
//        addOption('sussex','Sussex');
//     break;
//    
//    case "FL":
//      removeAllOptions();
//      addOption('Alachua','Alachua');
//      addOption('Baker','Baker');
//      addOption('Bay','Bay');
//      addOption('Bradford','Bradford');
//      addOption('Brevard','Brevard');
//      addOption('Broward','Broward');
//      addOption('Calhoun','Calhoun');
//      addOption('Charlotte','Charlotte');
//      addOption('Citrus','Citrus');
//      addOption('Clay','Clay');
//      addOption('Collier','Collier');
//      addOption('Columbia','Columbia');
//      addOption('DeSoto','DeSoto');
//      addOption('Dixie','Dixie');
//      addOption('Duval','Duval');
//      addOption('Escambia','Escambia');
//      addOption('Flagler','Flagler');
//      addOption('Franklin','Franklin');
//      addOption('Gadsden','Gadsden');
//      addOption('Gilchrist','Gilchrist');
//      addOption('Glades','Glades');
//      addOption('Gulf','Gulf');
//      addOption('Hamilton','Hamilton');
//      addOption('Hardee','Hardee');
//      addOption('Hendry','Hendry');
//      addOption('Hernando','Hernando');
//      addOption('Highlands','Highlands');
//      addOption('Hillsborough','Hillsborough');
//      addOption('Holmes','Holmes');
//      addOption('Indian River','Indian River');
//      addOption('Jackson','Jackson');
//      addOption('Jefferson','Jefferson');
//      addOption('Lafayette','Lafayette');
//      addOption('Lake','Lake');
//      addOption('Lee','Lee');
//      addOption('Leon','Leon');
//      addOption('Levy','Levy');
//      addOption('Liberty','Liberty');
//      addOption('Madison','Madison');
//      addOption('Manatee','Manatee');
//      addOption('Marion','Marion');
//      addOption('Martin','Martin');
//      addOption('Miami-Dade','Miami-Dade');
//      addOption('Monroe','Monroe');
//      addOption('Nassau','Nassau');
//      addOption('Okaloosa','Okaloosa');
//      addOption('Okeechobee','Okeechobee');
//      addOption('Orange','Orange');
//      addOption('Osceola','Osceola');
//      addOption('Palm Beach','Palm Beach');
//      addOption('Pasco','Pasco');
//      addOption('Pinellas','Pinellas');
//      addOption('Polk','Polk');
//      addOption('Putnam','Putnam');
//      addOption('Santa Rosa','Santa Rosa');
//      addOption('Sarasota','Sarasota');
//      addOption('Seminole','Seminole');
//      addOption('St. Johns','St. Johns');
//      addOption('St. Lucie','St. Lucie');
//      addOption('Sumter','Sumter');
//      addOption('Suwannee','Suwannee');
//      addOption('Taylor','Taylor');
//      addOption('Union','Union');
//      addOption('Volusia','Volusia');
//      addOption('Wakulla','Wakulla');
//      addOption('Walton','Walton');
//      addOption('Washington','Washington');
//    break;
//
//     case "GA":
//        removeAllOptions();
//        addOption('Appling','Appling');
//        addOption('Atkinson','Atkinson');
//        addOption('Bacon','Bacon');
//        addOption('Baker','Baker');
//        addOption('Baldwin','Baldwin');
//        addOption('Banks','Banks');
//        addOption('Barrow','Barrow');
//        addOption('Bartow','Bartow');
//        addOption('Ben Hill','Ben Hill');
//        addOption('Berrien','Berrien');
//        addOption('Bibb','Bibb');
//        addOption('Bleckley','Bleckley');
//        addOption('Brantley','Brantley');
//        addOption('Brooks','Brooks');
//        addOption('Bryan','Bryan');
//        addOption('Bulloch','Bulloch');
//        addOption('Burke','Burke');
//        addOption('Butts','Butts');
//        addOption('Calhoun','Calhoun');
//        addOption('Camden','Camden');
//        addOption('Candler','Candler');
//        addOption('Carroll','Carroll');
//        addOption('Catoosa','Catoosa');
//        addOption('Charlton','Charlton');
//        addOption('Chatham','Chatham');
//        addOption('Chattahoochee','Chattahoochee');
//        addOption('Chattooga','Chattooga');
//        addOption('Cherokee','Cherokee');
//        addOption('Clarke','Clarke');
//        addOption('Clay','Clay');
//        addOption('Clayton','Clayton');
//        addOption('Clinch','Clinch');
//        addOption('Cobb','Cobb');
//        addOption('Coffee','Coffee');
//        addOption('Colquitt','Colquitt');
//        addOption('Columbia','Columbia');
//        addOption('Cook','Cook');
//        addOption('Coweta','Coweta');
//        addOption('Crawford','Crawford');
//        addOption('Crisp','Crisp');
//        addOption('Dade','Dade');
//        addOption('Dawson','Dawson');
//        addOption('Decatur','Decatur');
//        addOption('DeKalb','DeKalb');
//        addOption('Dodge','Dodge');
//        addOption('Dooly','Dooly');
//        addOption('Dougherty','Dougherty');
//        addOption('Douglas','Douglas');
//        addOption('Early','Early');
//        addOption('Echols','Echols');
//        addOption('Effingham','Effingham');
//        addOption('Elbert','Elbert');
//        addOption('Emanuel','Emanuel');
//        addOption('Evans','Evans');
//        addOption('Fannin','Fannin');
//        addOption('Fayette','Fayette');
//        addOption('Floyd','Floyd');
//        addOption('Forsyth','Forsyth');
//        addOption('Franklin','Franklin');
//        addOption('Fulton','Fulton');
//        addOption('Gilmer','Gilmer');
//        addOption('Glascock','Glascock');
//        addOption('Glynn','Glynn');
//        addOption('Gordon','Gordon');
//        addOption('Grady','Grady');
//        addOption('Greene','Greene');
//        addOption('Gwinnett','Gwinnett');
//        addOption('Habersham','Habersham');
//        addOption('Hall','Hall');
//        addOption('Hancock','Hancock');
//        addOption('Haralson','Haralson');
//        addOption('Harris','Harris');
//        addOption('Hart','Hart');
//        addOption('Heard','Heard');
//        addOption('Henry','Henry');
//        addOption('Houston','Houston');
//        addOption('Irwin','Irwin');
//        addOption('Jackson','Jackson');
//        addOption('Jasper','Jasper');
//        addOption('Jeff Davis','Jeff Davis');
//        addOption('Jefferson','Jefferson');
//        addOption('Jenkins','Jenkins');
//        addOption('Johnson','Johnson');
//        addOption('Jones','Jones');
//        addOption('Lamar','Lamar');
//        addOption('Lanier','Lanier');
//        addOption('Laurens','Laurens');
//        addOption('Lee','Lee');
//        addOption('Liberty','Liberty');
//        addOption('Lincoln','Lincoln');
//        addOption('Long','Long');
//        addOption('Lowndes','Lowndes');
//        addOption('Lumpkin','Lumpkin');
//        addOption('Macon','Macon');
//        addOption('Madison','Madison');
//        addOption('Marion','Marion');
//        addOption('McDuffie','McDuffie');
//        addOption('McIntosh','McIntosh');
//        addOption('Meriwether','Meriwether');
//        addOption('Miller','Miller');
//        addOption('Mitchell','Mitchell');
//        addOption('Monroe','Monroe');
//        addOption('Montgomery','Montgomery');
//        addOption('Morgan','Morgan');
//        addOption('Murray','Murray');
//        addOption('Muscogee','Muscogee');
//        addOption('Newton','Newton');
//        addOption('Oconee','Oconee');
//        addOption('Oglethorpe','Oglethorpe');
//        addOption('Paulding','Paulding');
//        addOption('Peach','Peach');
//        addOption('Pickens','Pickens');
//        addOption('Pierce','Pierce');
//        addOption('Pike','Pike');
//        addOption('Polk','Polk');
//        addOption('Pulaski','Pulaski');
//        addOption('Putnam','Putnam');
//        addOption('Quitman','Quitman');
//        addOption('Rabun','Rabun');
//        addOption('Randolph','Randolph');
//        addOption('Richmond','Richmond');
//        addOption('Rockdale','Rockdale');
//        addOption('Schley','Schley');
//        addOption('Screven','Screven');
//        addOption('Seminole','Seminole');
//        addOption('Spalding','Spalding');
//        addOption('Stephens','Stephens');
//        addOption('Stewart','Stewart');
//        addOption('Sumter','Sumter');
//        addOption('Talbot','Talbot');
//        addOption('Taliaferro','Taliaferro');
//        addOption('Tattnall','Tattnall');
//        addOption('Taylor','Taylor');
//        addOption('Telfair','Telfair');
//        addOption('Terrell','Terrell');
//        addOption('Thomas','Thomas');
//        addOption('Tift','Tift');
//        addOption('Toombs','Toombs');
//        addOption('Towns','Towns');
//        addOption('Treutlen','Treutlen');
//        addOption('Troup','Troup');
//        addOption('Turner','Turner');
//        addOption('Twiggs','Twiggs');
//        addOption('Union','Union');
//        addOption('Upson','Upson');
//        addOption('Walker','Walker');
//        addOption('Walton','Walton');
//        addOption('Ware','Ware');
//        addOption('Warren','Warren');
//        addOption('Washington','Washington');
//        addOption('Wayne','Wayne');
//        addOption('Webster','Webster');
//        addOption('Wheeler','Wheeler');
//        addOption('White','White');
//        addOption('Whitfield','Whitfield');
//        addOption('Wilcox','Wilcox');
//        addOption('Wilkes','Wilkes');
//        addOption('Wilkinson','Wilkinson');
//        addOption('Worth','Worth');
//     break;
//
//    case "HI":
//      removeAllOptions();
//      addOption('Hawaii','Hawaii');
//      addOption('Honolulu','Honolulu');
//      addOption('Kalawao','Kalawao');
//      addOption('Kauai','Kauai');
//      addOption('Maui','Maui');
//    break;
//
//    case "IA":
//      removeAllOptions();
//      addOption('Adair','Adair');
//      addOption('Adams','Adams');
//      addOption('Allamakee','Allamakee');
//      addOption('Appanoose','Appanoose');
//      addOption('Audubon','Audubon');
//      addOption('Benton','Benton');
//      addOption('Black Hawk','Black Hawk');
//      addOption('Boone','Boone');
//      addOption('Bremer','Bremer');
//      addOption('Buchanan','Buchanan');
//      addOption('Buena Vista','Buena Vista');
//      addOption('Butler','Butler');
//      addOption('Calhoun','Calhoun');
//      addOption('Carroll','Carroll');
//      addOption('Cass','Cass');
//      addOption('Cedar','Cedar');
//      addOption('Cerro Gordo','Cerro Gordo');
//      addOption('Cherokee','Cherokee');
//      addOption('Chickasaw','Chickasaw');
//      addOption('Clarke','Clarke');
//      addOption('Clay','Clay');
//      addOption('Clayton','Clayton');
//      addOption('Clinton','Clinton');
//      addOption('Crawford','Crawford');
//      addOption('Dallas','Dallas');
//      addOption('Davis','Davis');
//      addOption('Decatur','Decatur');
//      addOption('Delaware','Delaware');
//      addOption('Des Moines','Des Moines');
//      addOption('Dickinson','Dickinson');
//      addOption('Dubuque','Dubuque');
//      addOption('Emmet','Emmet');
//      addOption('Fayette','Fayette');
//      addOption('Floyd','Floyd');
//      addOption('Franklin','Franklin');
//      addOption('Fremont','Fremont');
//      addOption('Greene','Greene');
//      addOption('Grundy','Grundy');
//      addOption('Guthrie','Guthrie');
//      addOption('Hamilton','Hamilton');
//      addOption('Hancock','Hancock');
//      addOption('Hardin','Hardin');
//      addOption('Harrison','Harrison');
//      addOption('Henry','Henry');
//      addOption('Howard','Howard');
//      addOption('Humboldt','Humboldt');
//      addOption('Ida','Ida');
//      addOption('Iowa','Iowa');
//      addOption('Jackson','Jackson');
//      addOption('Jasper','Jasper');
//      addOption('Jefferson','Jefferson');
//      addOption('Johnson','Johnson');
//      addOption('Jones','Jones');
//      addOption('Keokuk','Keokuk');
//      addOption('Kossuth','Kossuth');
//      addOption('Lee','Lee');
//      addOption('Linn','Linn');
//      addOption('Louisa','Louisa');
//      addOption('Lucas','Lucas');
//      addOption('Lyon','Lyon');
//      addOption('Madison','Madison');
//      addOption('Mahaska','Mahaska');
//      addOption('Marion','Marion');
//      addOption('Marshall','Marshall');
//      addOption('Mills','Mills');
//      addOption('Mitchell','Mitchell');
//      addOption('Monona','Monona');
//      addOption('Monroe','Monroe');
//      addOption('Montgomery','Montgomery');
//      addOption('Muscatine','Muscatine');
//      addOption('OBrien','OBrien');
//      addOption('Osceola','Osceola');
//      addOption('Page','Page');
//      addOption('Palo Alto','Palo Alto');
//      addOption('Plymouth','Plymouth');
//      addOption('Pocahontas','Pocahontas');
//      addOption('Polk','Polk');
//      addOption('Pottawattamie','Pottawattamie');
//      addOption('Poweshiek','Poweshiek');
//      addOption('Ringgold','Ringgold');
//      addOption('Sac','Sac');
//      addOption('Scott','Scott');
//      addOption('Shelby','Shelby');
//      addOption('Sioux','Sioux');
//      addOption('Story','Story');
//      addOption('Tama','Tama');
//      addOption('Taylor','Taylor');
//      addOption('Union','Union');
//      addOption('Van Buren','Van Buren');
//      addOption('Wapello','Wapello');
//      addOption('Warren','Warren');
//      addOption('Washington','Washington');
//      addOption('Wayne','Wayne');
//      addOption('Webster','Webster');
//      addOption('Winnebago','Winnebago');
//      addOption('Winneshiek','Winneshiek');
//      addOption('Woodbury','Woodbury');
//      addOption('Worth','Worth');
//      addOption('Wright','Wright');
//    break;
//  
//     case "ID":
//      removeAllOptions();
//      addOption('Ada','Ada');
//      addOption('Adams','Adams');
//      addOption('Bannock','Bannock');
//      addOption('Bear Lake','Bear Lake');
//      addOption('Benewah','Benewah');
//      addOption('Bingham','Bingham');
//      addOption('Blaine','Blaine');
//      addOption('Boise','Boise');
//      addOption('Bonner','Bonner');
//      addOption('Bonneville','Bonneville');
//      addOption('Boundary','Boundary');
//      addOption('Butte','Butte');
//      addOption('Camas','Camas');
//      addOption('Canyon','Canyon');
//      addOption('Caribou','Caribou');
//      addOption('Cassia','Cassia');
//      addOption('Clark','Clark');
//      addOption('Clearwater','Clearwater');
//      addOption('Custer','Custer');
//      addOption('Elmore','Elmore');
//      addOption('Franklin','Franklin');
//      addOption('Fremont','Fremont');
//      addOption('Gem','Gem');
//      addOption('Gooding','Gooding');
//      addOption('Idaho','Idaho');
//      addOption('Jefferson','Jefferson');
//      addOption('Jerome','Jerome');
//      addOption('Kootenai','Kootenai');
//      addOption('Latah','Latah');
//      addOption('Lemhi','Lemhi');
//      addOption('Lewis','Lewis');
//      addOption('Lincoln','Lincoln');
//      addOption('Madison','Madison');
//      addOption('Minidoka','Minidoka');
//      addOption('Nez Perce','Nez Perce');
//      addOption('Oneida','Oneida');
//      addOption('Owyhee','Owyhee');
//      addOption('Payette','Payette');
//      addOption('Power','Power');
//      addOption('Shoshone','Shoshone');
//      addOption('Teton','Teton');
//      addOption('Twin Falls','Twin Falls');
//      addOption('Valley','Valley');
//      addOption('Washington','Washington');
//     break;  
//  
//    case "IL":
//      removeAllOptions();
//      addOption('Adams','Adams');
//      addOption('Alexander','Alexander');
//      addOption('Bond','Bond');
//      addOption('Boone','Boone');
//      addOption('Brown','Brown');
//      addOption('Bureau','Bureau');
//      addOption('Calhoun','Calhoun');
//      addOption('Carroll','Carroll');
//      addOption('Cass','Cass');
//      addOption('Champaign','Champaign');
//      addOption('Christian','Christian');
//      addOption('Clark','Clark');
//      addOption('Clay','Clay');
//      addOption('Clinton','Clinton');
//      addOption('Coles','Coles');
//      addOption('Cook','Cook');
//      addOption('Crawford','Crawford');
//      addOption('Cumberland','Cumberland');
//      addOption('De Witt','De Witt');
//      addOption('dekalb','DeKalb');
//      addOption('Douglas','Douglas');
//      addOption('DuPage','DuPage');
//      addOption('Edgar','Edgar');
//      addOption('Edwards','Edwards');
//      addOption('Effingham','Effingham');
//      addOption('Fayette','Fayette');
//      addOption('Ford','Ford');
//      addOption('Franklin','Franklin');
//      addOption('Fulton','Fulton');
//      addOption('Gallatin','Gallatin');
//      addOption('Greene','Greene');
//      addOption('Grundy','Grundy');
//      addOption('Hamilton','Hamilton');
//      addOption('Hancock','Hancock');
//      addOption('Hardin','Hardin');
//      addOption('Henderson','Henderson');
//      addOption('Henry','Henry');
//      addOption('Iroquois','Iroquois');
//      addOption('Jackson','Jackson');
//      addOption('Jasper','Jasper');
//      addOption('Jefferson','Jefferson');
//      addOption('Jersey','Jersey');
//      addOption('Jo Daviess','Jo Daviess');
//      addOption('Johnson','Johnson');
//      addOption('Kane','Kane');
//      addOption('Kankakee','Kankakee');
//      addOption('Kendall','Kendall');
//      addOption('Knox','Knox');
//      addOption('La Salle','La Salle');
//      addOption('Lake','Lake');
//      addOption('Lawrence','Lawrence');
//      addOption('Lee','Lee');
//      addOption('Livingston','Livingston');
//      addOption('Logan','Logan');
//      addOption('Macon','Macon');
//      addOption('Macoupin','Macoupin');
//      addOption('Madison','Madison');
//      addOption('Marion','Marion');
//      addOption('Marshall','Marshall');
//      addOption('Mason','Mason');
//      addOption('Massac','Massac');
//      addOption('McDonough','McDonough');
//      addOption('McHenry','McHenry');
//      addOption('McLean','McLean');
//      addOption('Menard','Menard');
//      addOption('Mercer','Mercer');
//      addOption('Monroe','Monroe');
//      addOption('Montgomery','Montgomery');
//      addOption('Morgan','Morgan');
//      addOption('Moultrie','Moultrie');
//      addOption('Ogle','Ogle');
//      addOption('Peoria','Peoria');
//      addOption('Perry','Perry');
//      addOption('Piatt','Piatt');
//      addOption('Pike','Pike');
//      addOption('Pope','Pope');
//      addOption('Pulaski','Pulaski');
//      addOption('Putnam','Putnam');
//      addOption('Randolph','Randolph');
//      addOption('Richland','Richland');
//      addOption('Rock Island','Rock Island');
//      addOption('Saline','Saline');
//      addOption('Sangamon','Sangamon');
//      addOption('Schuyler','Schuyler');
//      addOption('Scott','Scott');
//      addOption('Shelby','Shelby');
//      addOption('St. Clair','St. Clair');
//      addOption('Stark','Stark');
//      addOption('Stephenson','Stephenson');
//      addOption('Tazewell','Tazewell');
//      addOption('Union','Union');
//      addOption('Vermilion','Vermilion');
//      addOption('Wabash','Wabash');
//      addOption('Warren','Warren');
//      addOption('Washington','Washington');
//      addOption('Wayne','Wayne');
//      addOption('White','White');
//      addOption('Whiteside','Whiteside');
//      addOption('Will','Will');
//      addOption('Williamson','Williamson');
//      addOption('Winnebago','Winnebago');
//      addOption('Woodford','Woodford');  
//    break;
//  
//    case "IN":
//      removeAllOptions();
//      addOption('Adams','Adams');
//      addOption('Allen','Allen');
//      addOption('Bartholomew','Bartholomew');
//      addOption('Benton','Benton');
//      addOption('Blackford','Blackford');
//      addOption('Boone','Boone');
//      addOption('Brown','Brown');
//      addOption('Carroll','Carroll');
//      addOption('Cass','Cass');
//      addOption('Clark','Clark');
//      addOption('Clay','Clay');
//      addOption('Clinton','Clinton');
//      addOption('Crawford','Crawford');
//      addOption('Daviess','Daviess');
//      addOption('De Kalb','De Kalb');
//      addOption('Dearborn','Dearborn');
//      addOption('Decatur','Decatur');
//      addOption('Delaware','Delaware');
//      addOption('Dubois','Dubois');
//      addOption('Elkhart','Elkhart');
//      addOption('Fayette','Fayette');
//      addOption('Floyd','Floyd');
//      addOption('Fountain','Fountain');
//      addOption('Franklin','Franklin');
//      addOption('Fulton','Fulton');
//      addOption('Gibson','Gibson');
//      addOption('Grant','Grant');
//      addOption('Greene','Greene');
//      addOption('Hamilton','Hamilton');
//      addOption('Hancock','Hancock');
//      addOption('Harrison','Harrison');
//      addOption('Hendricks','Hendricks');
//      addOption('Henry','Henry');
//      addOption('Howard','Howard');
//      addOption('Huntington','Huntington');
//      addOption('Jackson','Jackson');
//      addOption('Jasper','Jasper');
//      addOption('Jay','Jay');
//      addOption('Jefferson','Jefferson');
//      addOption('Jennings','Jennings');
//      addOption('Johnson','Johnson');
//      addOption('Knox','Knox');
//      addOption('Kosciusko','Kosciusko');
//      addOption('La Porte','La Porte');
//      addOption('Lagrange','Lagrange');
//      addOption('Lake','Lake');
//      addOption('Lawrence','Lawrence');
//      addOption('Madison','Madison');
//      addOption('Marion','Marion');
//      addOption('Marshall','Marshall');
//      addOption('Martin','Martin');
//      addOption('Miami','Miami');
//      addOption('Monroe','Monroe');
//      addOption('Montgomery','Montgomery');
//      addOption('Morgan','Morgan');
//      addOption('Newton','Newton');
//      addOption('Noble','Noble');
//      addOption('Ohio','Ohio');
//      addOption('Orange','Orange');
//      addOption('Owen','Owen');
//      addOption('Parke','Parke');
//      addOption('Perry','Perry');
//      addOption('Pike','Pike');
//      addOption('Porter','Porter');
//      addOption('Posey','Posey');
//      addOption('Pulaski','Pulaski');
//      addOption('Putnam','Putnam');
//      addOption('Randolph','Randolph');
//      addOption('Ripley','Ripley');
//      addOption('Rush','Rush');
//      addOption('Scott','Scott');
//      addOption('Shelby','Shelby');
//      addOption('Spencer','Spencer');
//      addOption('St. Joseph','St. Joseph');
//      addOption('Starke','Starke');
//      addOption('Steuben','Steuben');
//      addOption('Sullivan','Sullivan');
//      addOption('Switzerland','Switzerland');
//      addOption('Tippecanoe','Tippecanoe');
//      addOption('Tipton','Tipton');
//      addOption('Union','Union');
//      addOption('Vanderburgh','Vanderburgh');
//      addOption('Vermillion','Vermillion');
//      addOption('Vigo','Vigo');
//      addOption('Wabash','Wabash');
//      addOption('Warren','Warren');
//      addOption('Warrick','Warrick');
//      addOption('Washington','Washington');
//      addOption('Wayne','Wayne');
//      addOption('Wells','Wells');
//      addOption('White','White');
//      addOption('Whitley','Whitley');
//    break;
//
//     case "KS":
//        removeAllOptions();
//        addOption('Allen','Allen');
//        addOption('Anderson','Anderson');
//        addOption('Atchison','Atchison');
//        addOption('Barber','Barber');
//        addOption('Barton','Barton');
//        addOption('Bourbon','Bourbon');
//        addOption('Brown','Brown');
//        addOption('Butler','Butler');
//        addOption('Chase','Chase');
//        addOption('Chautauqua','Chautauqua');
//        addOption('Cherokee','Cherokee');
//        addOption('Cheyenne','Cheyenne');
//        addOption('Clark','Clark');
//        addOption('Clay','Clay');
//        addOption('Cloud','Cloud');
//        addOption('Coffey','Coffey');
//        addOption('Comanche','Comanche');
//        addOption('Cowley','Cowley');
//        addOption('Crawford','Crawford');
//        addOption('Decatur','Decatur');
//        addOption('Dickinson','Dickinson');
//        addOption('Doniphan','Doniphan');
//        addOption('Douglas','Douglas');
//        addOption('Edwards','Edwards');
//        addOption('Elk','Elk');
//        addOption('Ellis','Ellis');
//        addOption('Ellsworth','Ellsworth');
//        addOption('Finney','Finney');
//        addOption('Ford','Ford');
//        addOption('Franklin','Franklin');
//        addOption('Geary','Geary');
//        addOption('Gove','Gove');
//        addOption('Graham','Graham');
//        addOption('Grant','Grant');
//        addOption('Gray','Gray');
//        addOption('Greeley','Greeley');
//        addOption('Greenwood','Greenwood');
//        addOption('Hamilton','Hamilton');
//        addOption('Harper','Harper');
//        addOption('Harvey','Harvey');
//        addOption('Haskell','Haskell');
//        addOption('Hodgeman','Hodgeman');
//        addOption('Jackson','Jackson');
//        addOption('Jefferson','Jefferson');
//        addOption('Jewell','Jewell');
//        addOption('Johnson','Johnson');
//        addOption('Kearny','Kearny');
//        addOption('Kingman','Kingman');
//        addOption('Kiowa','Kiowa');
//        addOption('Labette','Labette');
//        addOption('Lane','Lane');
//        addOption('Leavenworth','Leavenworth');
//        addOption('Lincoln','Lincoln');
//        addOption('Linn','Linn');
//        addOption('Logan','Logan');
//        addOption('Lyon','Lyon');
//        addOption('Marion','Marion');
//        addOption('Marshall','Marshall');
//        addOption('McPherson','McPherson');
//        addOption('Meade','Meade');
//        addOption('Miami','Miami');
//        addOption('Mitchell','Mitchell');
//        addOption('Montgomery','Montgomery');
//        addOption('Morris','Morris');
//        addOption('Morton','Morton');
//        addOption('Nemaha','Nemaha');
//        addOption('Neosho','Neosho');
//        addOption('Ness','Ness');
//        addOption('Norton','Norton');
//        addOption('Osage','Osage');
//        addOption('Osborne','Osborne');
//        addOption('Ottawa','Ottawa');
//        addOption('Pawnee','Pawnee');
//        addOption('Phillips','Phillips');
//        addOption('Pottawatomie','Pottawatomie');
//        addOption('Pratt','Pratt');
//        addOption('Rawlins','Rawlins');
//        addOption('Reno','Reno');
//        addOption('Republic','Republic');
//        addOption('Rice','Rice');
//        addOption('Riley','Riley');
//        addOption('Rooks','Rooks');
//        addOption('Rush','Rush');
//        addOption('Russell','Russell');
//        addOption('Saline','Saline');
//        addOption('Scott','Scott');
//        addOption('Sedgwick','Sedgwick');
//        addOption('Seward','Seward');
//        addOption('Shawnee','Shawnee');
//        addOption('Sheridan','Sheridan');
//        addOption('Sherman','Sherman');
//        addOption('Smith','Smith');
//        addOption('Stafford','Stafford');
//        addOption('Stanton','Stanton');
//        addOption('Stevens','Stevens');
//        addOption('Sumner','Sumner');
//        addOption('Thomas','Thomas');
//        addOption('Trego','Trego');
//        addOption('Wabaunsee','Wabaunsee');
//        addOption('Wallace','Wallace');
//        addOption('Washington','Washington');
//        addOption('Wichita','Wichita');
//        addOption('Wilson','Wilson');
//        addOption('Woodson','Woodson');
//        addOption('Wyandotte','Wyandotte');
//     break;
//
//     case "KY":
//        removeAllOptions();
//        addOption('Adair','Adair');
//        addOption('Allen','Allen');
//        addOption('Anderson','Anderson');
//        addOption('Ballard','Ballard');
//        addOption('Barren','Barren');
//        addOption('Bath','Bath');
//        addOption('Bell','Bell');
//        addOption('Boone','Boone');
//        addOption('Bourbon','Bourbon');
//        addOption('Boyd','Boyd');
//        addOption('Boyle','Boyle');
//        addOption('Bracken','Bracken');
//        addOption('Breathitt','Breathitt');
//        addOption('Breckenridge','Breckenridge');
//        addOption('Bullitt','Bullitt');
//        addOption('Butler','Butler');
//        addOption('Caldwell','Caldwell');
//        addOption('Calloway','Calloway');
//        addOption('Campbell','Campbell');
//        addOption('Carlisle','Carlisle');
//        addOption('Carroll','Carroll');
//        addOption('Carter','Carter');
//        addOption('Casey','Casey');
//        addOption('Christian','Christian');
//        addOption('Clark','Clark');
//        addOption('Clay','Clay');
//        addOption('Clinton','Clinton');
//        addOption('Crittenden','Crittenden');
//        addOption('Cumberland','Cumberland');
//        addOption('Daviess','Daviess');
//        addOption('Edmonson','Edmonson');
//        addOption('Elliott','Elliott');
//        addOption('Estill','Estill');
//        addOption('Fayette','Fayette');
//        addOption('Fleming','Fleming');
//        addOption('Floyd','Floyd');
//        addOption('Franklin','Franklin');
//        addOption('Fulton','Fulton');
//        addOption('Gallatin','Gallatin');
//        addOption('Garrard','Garrard');
//        addOption('Grant','Grant');
//        addOption('Graves','Graves');
//        addOption('Grayson','Grayson');
//        addOption('Green','Green');
//        addOption('Greenup','Greenup');
//        addOption('Hancock','Hancock');
//        addOption('Hardin','Hardin');
//        addOption('Harlan','Harlan');
//        addOption('Harrison','Harrison');
//        addOption('Hart','Hart');
//        addOption('Henderson','Henderson');
//        addOption('Henry','Henry');
//        addOption('Hickman','Hickman');
//        addOption('Hopkins','Hopkins');
//        addOption('Jackson','Jackson');
//        addOption('Jefferson','Jefferson');
//        addOption('Jessamine','Jessamine');
//        addOption('Johnson','Johnson');
//        addOption('Kenton','Kenton');
//        addOption('Knott','Knott');
//        addOption('Knox','Knox');
//        addOption('Larue','Larue');
//        addOption('Laurel','Laurel');
//        addOption('Lawrence','Lawrence');
//        addOption('Lee','Lee');
//        addOption('Leslie','Leslie');
//        addOption('Letcher','Letcher');
//        addOption('Lewis','Lewis');
//        addOption('Lincoln','Lincoln');
//        addOption('Livingston','Livingston');
//        addOption('Logan','Logan');
//        addOption('Lyon','Lyon');
//        addOption('Madison','Madison');
//        addOption('Magoffin','Magoffin');
//        addOption('Marion','Marion');
//        addOption('Marshall','Marshall');
//        addOption('Martin','Martin');
//        addOption('Mason','Mason');
//        addOption('McCracken','McCracken');
//        addOption('McCreary','McCreary');
//        addOption('McLean','McLean');
//        addOption('Meade','Meade');
//        addOption('Menifee','Menifee');
//        addOption('Mercer','Mercer');
//        addOption('Metcalfe','Metcalfe');
//        addOption('Monroe','Monroe');
//        addOption('Montgomery','Montgomery');
//        addOption('Morgan','Morgan');
//        addOption('Muhlenberg','Muhlenberg');
//        addOption('Nelson','Nelson');
//        addOption('Nicholas','Nicholas');
//        addOption('Ohio','Ohio');
//        addOption('Oldham','Oldham');
//        addOption('Owen','Owen');
//        addOption('Owsley','Owsley');
//        addOption('Pendleton','Pendleton');
//        addOption('Perry','Perry');
//        addOption('Pike','Pike');
//        addOption('Powell','Powell');
//        addOption('Pulaski','Pulaski');
//        addOption('Robertson','Robertson');
//        addOption('Rockcastle','Rockcastle');
//        addOption('Rowan','Rowan');
//        addOption('Russell','Russell');
//        addOption('Scott','Scott');
//        addOption('Shelby','Shelby');
//        addOption('Simpson','Simpson');
//        addOption('Spencer','Spencer');
//        addOption('Taylor','Taylor');
//        addOption('Todd','Todd');
//        addOption('Trigg','Trigg');
//        addOption('Trimble','Trimble');
//        addOption('Union','Union');
//        addOption('Warren','Warren');
//        addOption('Washington','Washington');
//        addOption('Wayne','Wayne');
//        addOption('Webster','Webster');
//        addOption('Whitley','Whitley');
//        addOption('Wolfe','Wolfe');
//        addOption('Woodford','Woodford');
//     break;
//    
//     case "LA":
//        removeAllOptions();
//        addOption('Acadia','Acadia');
//        addOption('Allen','Allen');
//        addOption('Ascension','Ascension');
//        addOption('Assumption','Assumption');
//        addOption('Avoyelles','Avoyelles');
//        addOption('Beauregard','Beauregard');
//        addOption('Bienville','Bienville');
//        addOption('Bossier','Bossier');
//        addOption('Caddo','Caddo');
//        addOption('Calcasieu','Calcasieu');
//        addOption('Caldwell','Caldwell');
//        addOption('Cameron','Cameron');
//        addOption('Catahoula','Catahoula');
//        addOption('Claiborne','Claiborne');
//        addOption('Concordia','Concordia');
//        addOption('De Sota','De Sota');
//        addOption('East Baton Rouge','East Baton Rouge');
//        addOption('East Carroll','East Carroll');
//        addOption('East Feliciana','East Feliciana');
//        addOption('Evangeline','Evangeline');
//        addOption('Franklin','Franklin');
//        addOption('Grant','Grant');
//        addOption('Iberia','Iberia');
//        addOption('Iberville','Iberville');
//        addOption('Jackson','Jackson');
//        addOption('Jefferson','Jefferson');
//        addOption('Jefferson Davis','Jefferson Davis');
//        addOption('LaSalle','LaSalle');
//        addOption('Lafayette','Lafayette');
//        addOption('Lafourche','Lafourche');
//        addOption('Lincoln','Lincoln');
//        addOption('Livingston','Livingston');
//        addOption('Madison','Madison');
//        addOption('Morehouse','Morehouse');
//        addOption('Natchitoches','Natchitoches');
//        addOption('Orleans','Orleans');
//        addOption('Ouachita','Ouachita');
//        addOption('Plaquemines','Plaquemines');
//        addOption('Pointe Coupe','Pointe Coupe');
//        addOption('Rapides','Rapides');
//        addOption('Red River','Red River');
//        addOption('Richland','Richland');
//        addOption('Sabine','Sabine');
//        addOption('St. Bernard','St. Bernard');
//        addOption('St. Charles','St. Charles');
//        addOption('St. Helena','St. Helena');
//        addOption('St. James','St. James');
//        addOption('St. John the Baptist','St. John the Baptist');
//        addOption('St. Landry','St. Landry');
//        addOption('St. Martin','St. Martin');
//        addOption('St. Mary','St. Mary');
//        addOption('St. Tammany','St. Tammany');
//        addOption('Tangipahoa','Tangipahoa');
//        addOption('Tensas','Tensas');
//        addOption('Terrebonne','Terrebonne');
//        addOption('Union','Union');
//        addOption('Vermillion','Vermillion');
//        addOption('Vernon','Vernon');
//        addOption('Washington','Washington');
//        addOption('Webster','Webster');
//        addOption('West Baton Rouge','West Baton Rouge');
//        addOption('West Carroll','West Carroll');
//        addOption('West Feliciana','West Feliciana');
//        addOption('Winn','Winn');
//     break;  
//
//     case "MA":
//        removeAllOptions();
//        addOption('Barnstable','Barnstable');
//        addOption('Berkshire','Berkshire');
//        addOption('Bristol','Bristol');
//        addOption('Dukes','Dukes');
//        addOption('Essex','Essex');
//        addOption('Franklin','Franklin');
//        addOption('Hampden','Hampden');
//        addOption('Hampshire','Hampshire');
//        addOption('Middlesex','Middlesex');
//        addOption('Nantucket','Nantucket');
//        addOption('Norfolk','Norfolk');
//        addOption('Plymouth','Plymouth');
//        addOption('Suffolk','Suffolk');
//        addOption('Worcester','Worcester');
//      break;
//
//     case "MD":
//      removeAllOptions();
//      addOption('allegany','Allegany');
//      addOption('annearundel','Anne Arundel');
//      addOption('baltimore','Baltimore');
//      addOption('baltimorecity','Baltimore City');
//      addOption('calvert','Calvert');
//      addOption('caroline','Caroline');
//      addOption('carroll','Carroll');
//      addOption('cecil','Cecil');
//      addOption('charles','Charles');
//      addOption('dorchester','Dorchester');
//      addOption('frederick','Frederick');
//      addOption('garrett','Garrett');
//      addOption('harford','Harford');
//      addOption('howard','Howard');
//      addOption('kent','Kent');
//      addOption('montgomery','Montgomery');
//      addOption('princegeorge','Prince George');
//      addOption('queenanne','Queen Anne');
//      addOption('stmarys','St. Marys');
//      addOption('somerset','Somerset');
//      addOption('talbot','Talbot');
//      addOption('washington','Washington');
//      addOption('wicomico','Wicomico');
//      addOption('worcester','Worcester');
//      break;
//    
//     case "ME":
//      removeAllOptions();
//      addOption('Androscoggin','Androscoggin');
//      addOption('Aroostook','Aroostook');
//      addOption('Cumberland','Cumberland');
//      addOption('Franklin','Franklin');
//      addOption('Hancock','Hancock');
//      addOption('Kennebec','Kennebec');
//      addOption('Knox','Knox');
//      addOption('Lincoln','Lincoln');
//      addOption('Oxford','Oxford');
//      addOption('Penobscot','Penobscot');
//      addOption('Piscataquis','Piscataquis');
//      addOption('Sagadahoc','Sagadahoc');
//      addOption('Somerset','Somerset');
//      addOption('Waldo','Waldo');
//      addOption('Washington','Washington');
//      addOption('York','York');
//     break; 
//    
//     case "MI":
//      removeAllOptions();
//      addOption('Alcona','Alcona');
//      addOption('Alger','Alger');
//      addOption('Allegan','Allegan');
//      addOption('Alpena','Alpena');
//      addOption('Antrim','Antrim');
//      addOption('Arenac','Arenac');
//      addOption('Baraga','Baraga');
//      addOption('Barry','Barry');
//      addOption('Bay','Bay');
//      addOption('Benzie','Benzie');
//      addOption('Berrien','Berrien');
//      addOption('Branch','Branch');
//      addOption('Calhoun','Calhoun');
//      addOption('Cass','Cass');
//      addOption('Charlevoix','Charlevoix');
//      addOption('Cheboygan','Cheboygan');
//      addOption('Chippewa','Chippewa');
//      addOption('Clare','Clare');
//      addOption('Clinton','Clinton');
//      addOption('Crawford','Crawford');
//      addOption('Delta','Delta');
//      addOption('Dickinson','Dickinson');
//      addOption('Eaton','Eaton');
//      addOption('Emmet','Emmet');
//      addOption('Genesee','Genesee');
//      addOption('Gladwin','Gladwin');
//      addOption('Gogebic','Gogebic');
//      addOption('Grand Traverse','Grand Traverse');
//      addOption('Gratiot','Gratiot');
//      addOption('Hillsdale','Hillsdale');
//      addOption('Houghton','Houghton');
//      addOption('Huron','Huron');
//      addOption('Ingham','Ingham');
//      addOption('Ionia','Ionia');
//      addOption('Iosco','Iosco');
//      addOption('Iron','Iron');
//      addOption('Isabella','Isabella');
//      addOption('Jackson','Jackson');
//      addOption('Kalamazoo','Kalamazoo');
//      addOption('Kalkaska','Kalkaska');
//      addOption('Kent','Kent');
//      addOption('Keweenaw','Keweenaw');
//      addOption('Lake','Lake');
//      addOption('Lapeer','Lapeer');
//      addOption('Leelanau','Leelanau');
//      addOption('Lenawee','Lenawee');
//      addOption('Livingston','Livingston');
//      addOption('Luce','Luce');
//      addOption('Mackinac','Mackinac');
//      addOption('Macomb','Macomb');
//      addOption('Manistee','Manistee');
//      addOption('Marquette','Marquette');
//      addOption('Mason','Mason');
//      addOption('Mecosta','Mecosta');
//      addOption('Menominee','Menominee');
//      addOption('Midland','Midland');
//      addOption('Missaukee','Missaukee');
//      addOption('Monroe','Monroe');
//      addOption('Montcalm','Montcalm');
//      addOption('Montmorency','Montmorency');
//      addOption('Muskegon','Muskegon');
//      addOption('Newaygo','Newaygo');
//      addOption('Oakland','Oakland');
//      addOption('Oceana','Oceana');
//      addOption('Ogemaw','Ogemaw');
//      addOption('Ontonagon','Ontonagon');
//      addOption('Osceola','Osceola');
//      addOption('Oscoda','Oscoda');
//      addOption('Otsego','Otsego');
//      addOption('Ottawa','Ottawa');
//      addOption('Presque Isle','Presque Isle');
//      addOption('Roscommon','Roscommon');
//      addOption('Saginaw','Saginaw');
//      addOption('Sanilac','Sanilac');
//      addOption('Schoolcraft','Schoolcraft');
//      addOption('Shiawassee','Shiawassee');
//      addOption('St. Clair','St. Clair');
//      addOption('St. Joseph','St. Joseph');
//      addOption('Tuscola','Tuscola');
//      addOption('Van Buren','Van Buren');
//      addOption('Washtenaw','Washtenaw');
//      addOption('Wayne','Wayne');
//      addOption('Wexford','Wexford');
//      break;      
//      
//
//
//     case "MN":
//      removeAllOptions();
//      addOption('Aitkin','Aitkin');
//      addOption('Anoka','Anoka');
//      addOption('Becker','Becker');
//      addOption('Beltrami','Beltrami');
//      addOption('Benton','Benton');
//      addOption('Big Stone','Big Stone');
//      addOption('Blue Earth','Blue Earth');
//      addOption('Brown','Brown');
//      addOption('Carlton','Carlton');
//      addOption('Carver','Carver');
//      addOption('Cass','Cass');
//      addOption('Chippewa','Chippewa');
//      addOption('Chisago','Chisago');
//      addOption('Clay','Clay');
//      addOption('Clearwater','Clearwater');
//      addOption('Cook','Cook');
//      addOption('Cottonwood','Cottonwood');
//      addOption('Crow Wing','Crow Wing');
//      addOption('Dakota','Dakota');
//      addOption('Dodge','Dodge');
//      addOption('Douglas','Douglas');
//      addOption('Faribault','Faribault');
//      addOption('Fillmore','Fillmore');
//      addOption('Freeborn','Freeborn');
//      addOption('Goodhue','Goodhue');
//      addOption('Grant','Grant');
//      addOption('Hennepin','Hennepin');
//      addOption('Houston','Houston');
//      addOption('Hubbard','Hubbard');
//      addOption('Isanti','Isanti');
//      addOption('Itasca','Itasca');
//      addOption('Jackson','Jackson');
//      addOption('Kanabec','Kanabec');
//      addOption('Kandiyohi','Kandiyohi');
//      addOption('Kittson','Kittson');
//      addOption('Koochiching','Koochiching');
//      addOption('Lac qui Parle','Lac qui Parle');
//      addOption('Lake of the Woods','Lake of the Woods');
//      addOption('Lake','Lake');
//      addOption('Le Sueur','Le Sueur');
//      addOption('Lincoln','Lincoln');
//      addOption('Lyon','Lyon');
//      addOption('Mahnomen','Mahnomen');
//      addOption('Marshall','Marshall');
//      addOption('Martin','Martin');
//      addOption('McLeod','McLeod');
//      addOption('Meeker','Meeker');
//      addOption('Mille Lacs','Mille Lacs');
//      addOption('Morrison','Morrison');
//      addOption('Mower','Mower');
//      addOption('Murray','Murray');
//      addOption('Nicollet','Nicollet');
//      addOption('Nobles','Nobles');
//      addOption('Norman','Norman');
//      addOption('Olmsted','Olmsted');
//      addOption('Otter Tail','Otter Tail');
//      addOption('Pennington','Pennington');
//      addOption('Pine','Pine');
//      addOption('Pipestone','Pipestone');
//      addOption('Polk','Polk');
//      addOption('Pope','Pope');
//      addOption('Ramsey','Ramsey');
//      addOption('Red Lake','Red Lake');
//      addOption('Redwood','Redwood');
//      addOption('Renville','Renville');
//      addOption('Rice','Rice');
//      addOption('Rock','Rock');
//      addOption('Roseau','Roseau');
//      addOption('Scott','Scott');
//      addOption('Sherburne','Sherburne');
//      addOption('Sibley','Sibley');
//      addOption('St. Louis','St. Louis');
//      addOption('Stearns','Stearns');
//      addOption('Steele','Steele');
//      addOption('Stevens','Stevens');
//      addOption('Swift','Swift');
//      addOption('Todd','Todd');
//      addOption('Traverse','Traverse');
//      addOption('Wabasha','Wabasha');
//      addOption('Wadena','Wadena');
//      addOption('Waseca','Waseca');
//      addOption('Washington','Washington');
//      addOption('Watonwan','Watonwan');
//      addOption('Wilkin','Wilkin');
//      addOption('Winona','Winona');
//      addOption('Wright','Wright');
//      addOption('Yellow Medicine','Yellow Medicine');
//     break;
//
//     case "MO":
//      removeAllOptions();
//      addOption('Adair','Adair');
//      addOption('Andrew','Andrew');
//      addOption('Atchinson','Atchinson');
//      addOption('Audrain','Audrain');
//      addOption('Barry','Barry');
//      addOption('Barton','Barton');
//      addOption('Bates','Bates');
//      addOption('Benton','Benton');
//      addOption('Bollinger','Bollinger');
//      addOption('Boone','Boone');
//      addOption('Buchanan','Buchanan');
//      addOption('Butler','Butler');
//      addOption('Caldwell','Caldwell');
//      addOption('Callaway','Callaway');
//      addOption('Camden','Camden');
//      addOption('Cape Girardeau','Cape Girardeau');
//      addOption('Carroll','Carroll');
//      addOption('Carter','Carter');
//      addOption('Cass','Cass');
//      addOption('Cedar','Cedar');
//      addOption('Chariton','Chariton');
//      addOption('Christian','Christian');
//      addOption('Clark','Clark');
//      addOption('Clay','Clay');
//      addOption('Clinton','Clinton');
//      addOption('Cole','Cole');
//      addOption('Cooper','Cooper');
//      addOption('Crawford','Crawford');
//      addOption('Dade','Dade');
//      addOption('Dallas','Dallas');
//      addOption('Daviess','Daviess');
//      addOption('DeKalb','DeKalb');
//      addOption('Dent','Dent');
//      addOption('Douglas','Douglas');
//      addOption('Dunklin','Dunklin');
//      addOption('Franklin','Franklin');
//      addOption('Gasconade','Gasconade');
//      addOption('Gentry','Gentry');
//      addOption('Greene','Greene');
//      addOption('Grundy','Grundy');
//      addOption('Harrison','Harrison');
//      addOption('Henry','Henry');
//      addOption('Hickory','Hickory');
//      addOption('Holt','Holt');
//      addOption('Howard','Howard');
//      addOption('Howell','Howell');
//      addOption('Howard','Howard');
//      addOption('Jackson','Jackson');
//      addOption('Jackson','Jackson');
//      addOption('Jasper','Jasper');
//      addOption('Jefferson','Jefferson');
//      addOption('Johnson','Johnson');
//      addOption('Knox','Knox');
//      addOption('Laclede','Laclede');
//      addOption('Lafayette','Lafayette');
//      addOption('Lawrence','Lawrence');
//      addOption('Lewis','Lewis');
//      addOption('Lincoln','Lincoln');
//      addOption('Linn','Linn');
//      addOption('Livingston','Livingston');
//      addOption('Macon','Macon');
//      addOption('Madison','Madison');
//      addOption('Maries','Maries');
//      addOption('Marion','Marion');
//      addOption('McDonald','McDonald');
//      addOption('Mercer','Mercer');
//      addOption('Miller','Miller');
//      addOption('Mississippi','Mississippi');
//      addOption('Moniteau','Moniteau');
//      addOption('Monroe','Monroe');
//      addOption('Montgomery','Montgomery');
//      addOption('Morgan','Morgan');
//      addOption('New Madrid','New Madrid');
//      addOption('Newton','Newton');
//      addOption('Nodaway','Nodaway');
//      addOption('Oregon','Oregon');
//      addOption('Osage','Osage');
//      addOption('Ozark','Ozark');
//      addOption('Pemiscot','Pemiscot');
//      addOption('Perry','Perry');
//      addOption('Pettis','Pettis');
//      addOption('Phelps','Phelps');
//      addOption('Pike','Pike');
//      addOption('Platte','Platte');
//      addOption('Polk','Polk');
//      addOption('Pulaski','Pulaski');
//      addOption('Putnam','Putnam');
//      addOption('Ralls','Ralls');
//      addOption('Randolph','Randolph');
//      addOption('Ray','Ray');
//      addOption('Reynolds','Reynolds');
//      addOption('Ripley','Ripley');
//      addOption('Saline','Saline');
//      addOption('Schuyler','Schuyler');
//      addOption('Scotland','Scotland');
//      addOption('Scott','Scott');
//      addOption('Shannon','Shannon');
//      addOption('Shelby','Shelby');
//      addOption('St. Charles','St. Charles');
//      addOption('St. Clair','St. Clair');
//      addOption('St. Francois','St. Francois');
//      addOption('St. Louis','St. Louis');
//      addOption('St. Louis City','St. Louis City');
//      addOption('St. Genevieve','St. Genevieve');
//      addOption('Stoddard','Stoddard');
//      addOption('Stone','Stone');
//      addOption('Sullivan','Sullivan');
//      addOption('Taney','Taney');
//      addOption('Texas','Texas');
//      addOption('Vernon','Vernon');
//      addOption('Warren','Warren');
//      addOption('Washington','Washington');
//      addOption('Wayne','Wayne');
//      addOption('Webster','Webster');
//      addOption('Worth','Worth');
//      addOption('Wright','Wright');
//      addOption('NA','All Other Counties');
//     break;    
//     
//     case "MS":
//      removeAllOptions();
//      addOption('Adams','Adams');
//      addOption('Alcorn','Alcorn');
//      addOption('Amite','Amite');
//      addOption('Attala','Attala');
//      addOption('Benton','Benton');
//      addOption('Bolivar','Bolivar');
//      addOption('Calhoun','Calhoun');
//      addOption('Carroll','Carroll');
//      addOption('Chickasaw','Chickasaw');
//      addOption('Choctaw','Choctaw');
//      addOption('Claiborne','Claiborne');
//      addOption('Clarke','Clarke');
//      addOption('Clay','Clay');
//      addOption('Coahoma','Coahoma');
//      addOption('Copiah','Copiah');
//      addOption('Covington','Covington');
//      addOption('De Soto','De Soto');
//      addOption('Forrest','Forrest');
//      addOption('Franklin','Franklin');
//      addOption('George','George');
//      addOption('Greene','Greene');
//      addOption('Grenada','Grenada');
//      addOption('Hancock','Hancock');
//      addOption('Harrison','Harrison');
//      addOption('Hinds','Hinds');
//      addOption('Holmes','Holmes');
//      addOption('Humphreys','Humphreys');
//      addOption('Issaquena','Issaquena');
//      addOption('Itawamba','Itawamba');
//      addOption('Jackson','Jackson');
//      addOption('Jasper','Jasper');
//      addOption('Jefferson','Jefferson');
//      addOption('Jefferson Davis','Jefferson Davis');
//      addOption('Jones','Jones');
//      addOption('Kemper','Kemper');
//      addOption('Lafayette','Lafayette');
//      addOption('Lamar','Lamar');
//      addOption('Lauderdale','Lauderdale');
//      addOption('Lawrence','Lawrence');
//      addOption('Leake','Leake');
//      addOption('Lee','Lee');
//      addOption('Leflore','Leflore');
//      addOption('Lincoln','Lincoln');
//      addOption('Lowndes','Lowndes');
//      addOption('Madison','Madison');
//      addOption('Marion','Marion');
//      addOption('Marshall','Marshall');
//      addOption('Monroe','Monroe');
//      addOption('Montgomery','Montgomery');
//      addOption('Neshoba','Neshoba');
//      addOption('Newton','Newton');
//      addOption('Noxubee','Noxubee');
//      addOption('Oktibbeha','Oktibbeha');
//      addOption('Panola','Panola');
//      addOption('Pearl River','Pearl River');
//      addOption('Perry','Perry');
//      addOption('Pike','Pike');
//      addOption('Pontotoc','Pontotoc');
//      addOption('Prentiss','Prentiss');
//      addOption('Quitman','Quitman');
//      addOption('Rankin','Rankin');
//      addOption('Scott','Scott');
//      addOption('Sharkey','Sharkey');
//      addOption('Simpson','Simpson');
//      addOption('Smith','Smith');
//      addOption('Stone','Stone');
//      addOption('Sunflower','Sunflower');
//      addOption('Tallahatchie','Tallahatchie');
//      addOption('Tate','Tate');
//      addOption('Tippah','Tippah');
//      addOption('Tishomingo','Tishomingo');
//      addOption('Tunica','Tunica');
//      addOption('Union','Union');
//      addOption('Walthall','Walthall');
//      addOption('Warren','Warren');
//      addOption('Washington','Washington');
//      addOption('Wayne','Wayne');
//      addOption('Webster','Webster');
//      addOption('Wilkinson','Wilkinson');
//      addOption('Winston','Winston');
//      addOption('Yalobusha','Yalobusha');
//      addOption('Yazoo','Yazoo');
//    break;
//
//    case "MT":
//      removeAllOptions();
//      addOption('Beaverhead','Beaverhead');
//      addOption('Big Horn','Big Horn');
//      addOption('Blaine','Blaine');
//      addOption('Broadwater','Broadwater');
//      addOption('Carbon ','Carbon ');
//      addOption('Carter','Carter');
//      addOption('Cascade','Cascade');
//      addOption('Chouteau','Chouteau');
//      addOption('Custer','Custer');
//      addOption('Daniels','Daniels');
//      addOption('Dawson','Dawson');
//      addOption('Deer Lodge','Deer Lodge');
//      addOption('Fallon','Fallon');
//      addOption('Fergus','Fergus');
//      addOption('Flathead','Flathead');
//      addOption('Gallatin','Gallatin');
//      addOption('Garfield','Garfield');
//      addOption('Glacier','Glacier');
//      addOption('Golden Valley','Golden Valley');
//      addOption('Granite','Granite');
//      addOption('Hill','Hill');
//      addOption('Jefferson','Jefferson');
//      addOption('Judith Basin','Judith Basin');
//      addOption('Lake','Lake');
//      addOption('Lewis and Clark','Lewis and Clark');
//      addOption('Liberty','Liberty');
//      addOption('Lincoln','Lincoln');
//      addOption('Madison','Madison');
//      addOption('McCone','McCone');
//      addOption('Meagher','Meagher');
//      addOption('Mineral','Mineral');
//      addOption('Missoula','Missoula');
//      addOption('Musselshell','Musselshell');
//      addOption('Park','Park');
//      addOption('Petroleum','Petroleum');
//      addOption('Phillips','Phillips');
//      addOption('Pondera','Pondera');
//      addOption('Powder River','Powder River');
//      addOption('Powell','Powell');
//      addOption('Prairie','Prairie');
//      addOption('Ravalli','Ravalli');
//      addOption('Richland','Richland');
//      addOption('Roosevelt','Roosevelt');
//      addOption('Rosebud','Rosebud');
//      addOption('Sanders','Sanders');
//      addOption('Sheridan','Sheridan');
//      addOption('Butte-Silver Bow','Butte-Silver Bow');
//      addOption('Stillwater','Stillwater');
//      addOption('Sweet Grass','Sweet Grass');
//      addOption('Teton','Teton');
//      addOption('Toole','Toole');
//      addOption('Treasure','Treasure');
//      addOption('Valley','Valley');
//      addOption('Wheatland','Wheatland');
//      addOption('Wibaux','Wibaux');
//      addOption('Yellowstone','Yellowstone');
//    break;
//
//    case "NC":
//       removeAllOptions();
//       addOption('Alamance','Alamance');
//       addOption('Alexander','Alexander');
//       addOption('Alleghany','Alleghany');
//       addOption('Anson','Anson');
//       addOption('Ashe','Ashe');
//       addOption('Avery','Avery');
//       addOption('Beaufort','Beaufort');
//       addOption('Bertie','Bertie');
//       addOption('Bladen','Bladen');
//       addOption('Brunswick','Brunswick');
//       addOption('Buncombe','Buncombe');
//       addOption('Burke','Burke');
//       addOption('Cabarrus','Cabarrus');
//       addOption('Caldwell','Caldwell');
//       addOption('Camden','Camden');
//       addOption('Carteret','Carteret');
//       addOption('Caswell','Caswell');
//       addOption('Catawba','Catawba');
//       addOption('Chatham','Chatham');
//       addOption('Cherokee','Cherokee');
//       addOption('Chowan','Chowan');
//       addOption('Clay','Clay');
//       addOption('Cleveland','Cleveland');
//       addOption('Columbus','Columbus');
//       addOption('Craven','Craven');
//       addOption('Cumberland','Cumberland');
//       addOption('Currituck','Currituck');
//       addOption('Dare','Dare');
//       addOption('Davidson','Davidson');
//       addOption('Davie','Davie');
//       addOption('Duplin','Duplin');
//       addOption('Durham','Durham');
//       addOption('Edgecombe','Edgecombe');
//       addOption('Forsyth','Forsyth');
//       addOption('Franklin','Franklin');
//       addOption('Gaston','Gaston');
//       addOption('Gates','Gates');
//       addOption('Graham','Graham');
//       addOption('Granville','Granville');
//       addOption('Greene','Greene');
//       addOption('Guilford','Guilford');
//       addOption('Halifax','Halifax');
//       addOption('Harnett','Harnett');
//       addOption('Haywood','Haywood');
//       addOption('Henderson','Henderson');
//       addOption('Hertford','Hertford');
//       addOption('Hoke','Hoke');
//       addOption('Hyde','Hyde');
//       addOption('Iredell','Iredell');
//       addOption('Jackson','Jackson');
//       addOption('Johnston','Johnston');
//       addOption('Jones','Jones');
//       addOption('Lee','Lee');
//       addOption('Lenoir','Lenoir');
//       addOption('Lincoln','Lincoln');
//       addOption('Macon','Macon');
//       addOption('Madison','Madison');
//       addOption('Martin','Martin');
//       addOption('McDowell','McDowell');
//       addOption('Mecklenburg','Mecklenburg');
//       addOption('Mitchell','Mitchell');
//       addOption('Montgomery','Montgomery');
//       addOption('Moore','Moore');
//       addOption('Nash','Nash');
//       addOption('New Hanover','New Hanover');
//       addOption('Northampton','Northampton');
//       addOption('Onslow','Onslow');
//       addOption('Orange','Orange');
//       addOption('Pamlico','Pamlico');
//       addOption('Pasquotank','Pasquotank');
//       addOption('Pender','Pender');
//       addOption('Perquimans','Perquimans');
//       addOption('Person','Person');
//       addOption('Pitt','Pitt');
//       addOption('Polk','Polk');
//       addOption('Randolph','Randolph');
//       addOption('Richmond','Richmond');
//       addOption('Robeson','Robeson');
//       addOption('Rockingham','Rockingham');
//       addOption('Rowan','Rowan');
//       addOption('Rutherford','Rutherford');
//       addOption('Sampson','Sampson');
//       addOption('Scotland','Scotland');
//       addOption('Stanly','Stanly');
//       addOption('Stokes','Stokes');
//       addOption('Surry','Surry');
//       addOption('Swain','Swain');
//       addOption('Transylvania','Transylvania');
//       addOption('Tyrrell','Tyrrell');
//       addOption('Union','Union');
//       addOption('Vance','Vance');
//       addOption('Wake','Wake');
//       addOption('Warren','Warren');
//       addOption('Washington','Washington');
//       addOption('Watauga','Watauga');
//       addOption('Wayne','Wayne');
//       addOption('Wilkes','Wilkes');
//       addOption('Wilson','Wilson');
//       addOption('Yadkin','Yadkin');
//       addOption('Yancey','Yancey');  
//    break;
//  
//      case "ND":
//        removeAllOptions();
//        addOption('Adams','Adams');
//        addOption('Barnes','Barnes');
//        addOption('Benson','Benson');
//        addOption('Billings','Billings');
//        addOption('Bottineau','Bottineau');
//        addOption('Bowman','Bowman');
//        addOption('Burke','Burke');
//        addOption('Burleigh','Burleigh');
//        addOption('Cass','Cass');
//        addOption('Cavalier','Cavalier');
//        addOption('Dickey','Dickey');
//        addOption('Divide','Divide');
//        addOption('Dunn','Dunn');
//        addOption('Eddy','Eddy');
//        addOption('Emmons','Emmons');
//        addOption('Foster','Foster');
//        addOption('Golden Valley','Golden Valley');
//        addOption('Grand Forks','Grand Forks');
//        addOption('Grant','Grant');
//        addOption('Griggs','Griggs');
//        addOption('Hettinger','Hettinger');
//        addOption('Kidder','Kidder');
//        addOption('LaMoure','LaMoure');
//        addOption('Logan','Logan');
//        addOption('McHenry','McHenry');
//        addOption('McIntosh','McIntosh');
//        addOption('McKenzie','McKenzie');
//        addOption('McLean','McLean');
//        addOption('Mercer','Mercer');
//        addOption('Morton','Morton');
//        addOption('Mountrail','Mountrail');
//        addOption('Nelson','Nelson');
//        addOption('Oliver','Oliver');
//        addOption('Pembina','Pembina');
//        addOption('Pierce','Pierce');
//        addOption('Ramsey','Ramsey');
//        addOption('Ransom','Ransom');
//        addOption('Renville','Renville');
//        addOption('Richland','Richland');
//        addOption('Rolette','Rolette');
//        addOption('Sargent','Sargent');
//        addOption('Sheridan','Sheridan');
//        addOption('Sioux','Sioux');
//        addOption('Slope','Slope');
//        addOption('Stark','Stark');
//        addOption('Steele','Steele');
//        addOption('Stutsman','Stutsman');
//        addOption('Towner','Towner');
//        addOption('Traill','Traill');
//        addOption('Walsh','Walsh');
//        addOption('Ward','Ward');
//        addOption('Wells','Wells');
//        addOption('Williams','Williams');       
//      break;
//
//      case "NE":
//        removeAllOptions();
//        addOption('Adams','Adams');
//        addOption('Antelope','Antelope');
//        addOption('Arthur','Arthur');
//        addOption('Banner','Banner');
//        addOption('Blaine','Blaine');
//        addOption('Boone','Boone');
//        addOption('Box Butte','Box Butte');
//        addOption('Boyd','Boyd');
//        addOption('Brown','Brown');
//        addOption('Buffalo','Buffalo');
//        addOption('Burt','Burt');
//        addOption('Butler','Butler');
//        addOption('Cass','Cass');
//        addOption('Cedar','Cedar');
//        addOption('Chase','Chase');
//        addOption('Cherry','Cherry');
//        addOption('Cheyenne','Cheyenne');
//        addOption('Clay','Clay');
//        addOption('Colfax','Colfax');
//        addOption('Cuming','Cuming');
//        addOption('Custer','Custer');
//        addOption('Dakota','Dakota');
//        addOption('Dawes','Dawes');
//        addOption('Dawson','Dawson');
//        addOption('Deuel','Deuel');
//        addOption('Dixon','Dixon');
//        addOption('Dodge','Dodge');
//        addOption('Douglas','Douglas');
//        addOption('Dundy','Dundy');
//        addOption('Fillmore','Fillmore');
//        addOption('Franklin','Franklin');
//        addOption('Frontier','Frontier');
//        addOption('Furnas','Furnas');
//        addOption('Gage','Gage');
//        addOption('Garden','Garden');
//        addOption('Garfield','Garfield');
//        addOption('Gosper','Gosper');
//        addOption('Grant','Grant');
//        addOption('Greeley','Greeley');
//        addOption('Hall','Hall');
//        addOption('Hamilton','Hamilton');
//        addOption('Harlan','Harlan');
//        addOption('Hayes','Hayes');
//        addOption('Hitchcock','Hitchcock');
//        addOption('Holt','Holt');
//        addOption('Hooker','Hooker');
//        addOption('Howard','Howard');
//        addOption('Jefferson','Jefferson');
//        addOption('Johnson','Johnson');
//        addOption('Kearney','Kearney');
//        addOption('Keith','Keith');
//        addOption('Keya Paha','Keya Paha');
//        addOption('Kimball','Kimball');
//        addOption('Knox','Knox');
//        addOption('Lancaster','Lancaster');
//        addOption('Lincoln','Lincoln');
//        addOption('Logan','Logan');
//        addOption('Loup','Loup');
//        addOption('Madison','Madison');
//        addOption('McPherson','McPherson');
//        addOption('Merrick','Merrick');
//        addOption('Morrill','Morrill');
//        addOption('Nance','Nance');
//        addOption('Nemaha','Nemaha');
//        addOption('Nuckolls','Nuckolls');
//        addOption('Otoe','Otoe');
//        addOption('Pawnee','Pawnee');
//        addOption('Perkins','Perkins');
//        addOption('Phelps','Phelps');
//        addOption('Pierce','Pierce');
//        addOption('Platte','Platte');
//        addOption('Polk','Polk');
//        addOption('Red Willow','Red Willow');
//        addOption('Richardson','Richardson');
//        addOption('Rock','Rock');
//        addOption('Saline','Saline');
//        addOption('Sarpy','Sarpy');
//        addOption('Saunders','Saunders');
//        addOption('Scotts Bluffs','Scotts Bluffs');
//        addOption('Seward','Seward');
//        addOption('Sheridan','Sheridan');
//        addOption('Sherman','Sherman');
//        addOption('Sioux','Sioux');
//        addOption('Stanton','Stanton');
//        addOption('Thayer','Thayer');
//        addOption('Thomas','Thomas');
//        addOption('Thurston','Thurston');
//        addOption('Valley','Valley');
//        addOption('Washington','Washington');
//        addOption('Wayne','Wayne');
//        addOption('Webster','Webster');
//        addOption('Wheeler','Wheeler');
//        addOption('York','York');
//
//      break;
//
//      case "NH":
//      removeAllOptions();
//      addOption('Belknap','Belknap');
//      addOption('Carroll','Carroll');
//      addOption('Cheshire','Cheshire');
//      addOption('Coos','Coos');
//      addOption('Grafton','Grafton');
//      addOption('Hillsboro','Hillsboro');
//      addOption('Merrimack','Merrimack');
//      addOption('Rockingham','Rockingham');
//      addOption('Strafford','Strafford');
//      addOption('Sullivan','Sullivan');
//      break;      
//        
//      case "NJ":
//        removeAllOptions();
//        addOption('Atlantic','Atlantic');
//        addOption('Bergen','Bergen');
//        addOption('Burlington','Burlington');
//        addOption('Camden','Camden');
//        addOption('Cape May','Cape May');
//        addOption('Cumberland','Cumberland');
//        addOption('Essex','Essex');
//        addOption('Gloucester','Gloucester');
//        addOption('Hudson','Hudson');
//        addOption('Hunterdon','Hunterdon');
//        addOption('Mercer','Mercer');
//        addOption('Middlesex','Middlesex');
//        addOption('Monmouth','Monmouth');
//        addOption('Morris','Morris');
//        addOption('Ocean','Ocean');
//        addOption('Passaic','Passaic');
//        addOption('Salem','Salem');
//        addOption('Somerset','Somerset');
//        addOption('Sussex','Sussex');
//        addOption('Union','Union');
//        addOption('Warren','Warren');     
//      break;         
// 
//      case "NM":
//        removeAllOptions();        
//        addOption('Bernalillo','Bernalillo');
//        addOption('Catron','Catron');
//        addOption('Chaves','Chaves');
//        addOption('Cibola','Cibola');
//        addOption('Colfax','Colfax');
//        addOption('Curry','Curry');
//        addOption('DeBaca','DeBaca');
//        addOption('Dona Ana','Dona Ana');
//        addOption('Eddy','Eddy');
//        addOption('Grant','Grant');
//        addOption('Guadalupe','Guadalupe');
//        addOption('Harding','Harding');
//        addOption('Hidalgo','Hidalgo');
//        addOption('Lea','Lea');
//        addOption('Lincoln','Lincoln');
//        addOption('Los Alamos','Los Alamos');
//        addOption('Luna','Luna');
//        addOption('McKinley','McKinley');
//        addOption('Mora','Mora');
//        addOption('Otero','Otero');
//        addOption('Quay','Quay');
//        addOption('Rio Arriba','Rio Arriba');
//        addOption('Roosevelt','Roosevelt');
//        addOption('San Juan','San Juan');
//        addOption('San Miguel','San Miguel');
//        addOption('Sandoval','Sandoval');
//        addOption('Santa Fe','Santa Fe');
//        addOption('Sierra','Sierra');
//        addOption('Socorro','Socorro');
//        addOption('Taos','Taos');
//        addOption('Torrance','Torrance');
//        addOption('Union','Union');
//        addOption('Valencia','Valencia');
//      break;
//    
//      case "NV":
//        removeAllOptions();
//        addOption('Churchill','Churchill');
//        addOption('Clark','Clark');
//        addOption('Douglas','Douglas');
//        addOption('Elko','Elko');
//        addOption('Esmeralda','Esmeralda');
//        addOption('Eureka','Eureka');
//        addOption('Humboldt','Humboldt');
//        addOption('Lander','Lander');
//        addOption('Lincoln','Lincoln');
//        addOption('Lyon','Lyon');
//        addOption('Mineral','Mineral');
//        addOption('Nye','Nye');
//        addOption('Pershing','Pershing');
//        addOption('Storey','Storey');
//        addOption('Washoe','Washoe');
//        addOption('White Pine','White Pine');
//      break;  
//                
//     case "NY":
//
////Redirect to CEMA
////alert("You are being redirected to our New York Specific calculator");
////window.location.assign("CEMA_main.php");
//
//      removeAllOptions();
//      addOption('albany','Albany');
//      addOption('allegany','Allegany');
//      addOption('bronx','Bronx');
//      //addOption('brooklyn','Brooklyn');
//      addOption('broome','Broome');
//      addOption('cattaraugus','Cattaraugus');
//      addOption('cayuga','Cayuga');
//      addOption('chautauqua','Chautauqua');
//      addOption('chemung','Chemung');
//      addOption('chenango','Chenango');
//      addOption('clinton','Clinton');
//      addOption('columbia','Columbia');
//      addOption('cortland','Cortland');
//      addOption('delaware','Delaware');
//      addOption('dutchess','Dutchess');
//      addOption('erie','Erie');
//      addOption('essex','Essex');
//      addOption('franklin','Franklin');
//      addOption('fulton','Fulton');
//      addOption('genesee','Genesee');
//      addOption('greene','Greene');
//      addOption('hamilton','Hamilton');
//      addOption('herkimer','Herkimer');
//      addOption('jefferson','Jefferson');
//      addOption('kings','Kings');
//      addOption('lewis','Lewis');
//      addOption('livingston','Livingston');
//      addOption('madison','Madison');
//     // addOption('manhattan','Manhattan');
//      addOption('monroe','Monroe');
//      addOption('montgomery','Montgomery');
//      addOption('nassau','Nassau');
//      addOption('newyork','New York');
//      addOption('niagara','Niagara');
//      addOption('oneida','Oneida');
//      addOption('onondaga','Onondaga');
//      addOption('ontario','Ontario');
//      addOption('orange','Orange');
//      addOption('orleans','Orleans');
//      addOption('oswego','Oswego');
//      addOption('otsego','Otsego');
//      addOption('putnam','Putnam');
//      addOption('queens','Queens');
//      addOption('rensselaer','Rensselaer');
//      addOption('richmond','Richmond');
//      addOption('rockland','Rockland');
//      addOption('stlawrence','St. Lawrence');
//      addOption('saratoga','Saratoga');
//      addOption('schenectady','Schenectady');
//      addOption('schoharie','Schoharie');
//      addOption('schuyler','Schuyler');
//      addOption('seneca','Seneca');
//      //addOption('statenisland','Staten Island');
//      addOption('steuben','Steuben');
//      addOption('suffolk','Suffolk');
//      addOption('sullivan','Sullivan');
//      addOption('tioga','Tioga');
//      addOption('tompkins','Tompkins');
//      addOption('ulster','Ulster');
//      addOption('warren','Warren');
//      addOption('washington','Washington');
//      addOption('wayne','Wayne');
//      addOption('westchester','Westchester');
//      addOption('wyoming','Wyoming');
//      addOption('yates','Yates');
//      break;
//      
//    case "OH":
//      removeAllOptions();      
//      addOption('Adams','Adams');
//      addOption('Allen','Allen');
//      addOption('Ashland','Ashland');
//      addOption('Ashtabula','Ashtabula');
//      addOption('Athens','Athens');
//      addOption('Auglaize','Auglaize');
//      addOption('Belmont','Belmont');
//      addOption('Brown','Brown');
//      addOption('Butler','Butler');
//      addOption('Carroll','Carroll');
//      addOption('Champaign','Champaign');
//      addOption('Clark','Clark');
//      addOption('Clermont','Clermont');
//      addOption('Clinton','Clinton');
//      addOption('Columbiana','Columbiana');
//      addOption('Coshocton','Coshocton');
//      addOption('Crawford','Crawford');
//      addOption('Cuyahoga','Cuyahoga');
//      addOption('Darke','Darke');
//      addOption('Defiance','Defiance');
//      addOption('Delaware','Delaware');
//      addOption('Erie','Erie');
//      addOption('Fairfield','Fairfield');
//      addOption('Fayette','Fayette');
//      addOption('Franklin','Franklin');
//      addOption('Fulton','Fulton');
//      addOption('Gallia','Gallia');
//      addOption('Geauga','Geauga');
//      addOption('Greene','Greene');
//      addOption('Guernsey','Guernsey');
//      addOption('Hamilton','Hamilton');
//      addOption('Hancock','Hancock');
//      addOption('Hardin','Hardin');
//      addOption('Harrison','Harrison');
//      addOption('Henry','Henry');
//      addOption('Highland','Highland');
//      addOption('Hocking','Hocking');
//      addOption('Holmes','Holmes');
//      addOption('Huron','Huron');
//      addOption('Jackson','Jackson');
//      addOption('Jefferson','Jefferson');
//      addOption('Knox','Knox');
//      addOption('Lake','Lake');
//      addOption('Lawrence','Lawrence');
//      addOption('Licking','Licking');
//      addOption('Logan','Logan');
//      addOption('Lorain','Lorain');
//      addOption('Lucas','Lucas');
//      addOption('Madison','Madison');
//      addOption('Mahoning','Mahoning');
//      addOption('Marion','Marion');
//      addOption('Medina','Medina');
//      addOption('Meigs','Meigs');
//      addOption('Mercer','Mercer');
//      addOption('Miami','Miami');
//      addOption('Monroe','Monroe');
//      addOption('Montgomery','Montgomery');
//      addOption('Morgan','Morgan');
//      addOption('Morrow','Morrow');
//      addOption('Muskingum','Muskingum');
//      addOption('Noble','Noble');
//      addOption('Ottawa','Ottawa');
//      addOption('Paulding','Paulding');
//      addOption('Perry','Perry');
//      addOption('Pickaway','Pickaway');
//      addOption('Pike','Pike');
//      addOption('Portage','Portage');
//      addOption('Preble','Preble');
//      addOption('Putnam','Putnam');
//      addOption('Richland','Richland');
//      addOption('Ross','Ross');
//      addOption('Sandusky','Sandusky');
//      addOption('Scioto','Scioto');
//      addOption('Seneca','Seneca');
//      addOption('Shelby','Shelby');
//      addOption('Stark','Stark');
//      addOption('Summit','Summit');
//      addOption('Trumbull','Trumbull');
//      addOption('Tuscarawas','Tuscarawas');
//      addOption('Union','Union');
//      addOption('Van Wert','Van Wert');
//      addOption('Vinton','Vinton');
//      addOption('Warren','Warren');
//      addOption('Washington','Washington');
//      addOption('Wayne','Wayne');
//      addOption('Williams','Williams');
//      addOption('Wood','Wood');
//      addOption('Wyandot','Wyandot');
//      break;
//
//    case "OK":
//      removeAllOptions();
//      addOption('Adair','Adair');
//      addOption('Alfalfa','Alfalfa');
//      addOption('Atoka','Atoka');
//      addOption('Beaver','Beaver');
//      addOption('Beckham','Beckham');
//      addOption('Blaine','Blaine');
//      addOption('Bryan','Bryan');
//      addOption('Caddo','Caddo');
//      addOption('Canadian','Canadian');
//      addOption('Carter','Carter');
//      addOption('Cherokee','Cherokee');
//      addOption('Choctaw','Choctaw');
//      addOption('Cimarron','Cimarron');
//      addOption('Cleveland','Cleveland');
//      addOption('Coal','Coal');
//      addOption('Comanche','Comanche');
//      addOption('Cotton','Cotton');
//      addOption('Craig','Craig');
//      addOption('Creek','Creek');
//      addOption('Custer','Custer');
//      addOption('Delaware','Delaware');
//      addOption('Dewey','Dewey');
//      addOption('Ellis','Ellis');
//      addOption('Garfield','Garfield');
//      addOption('Garvin','Garvin');
//      addOption('Grady','Grady');
//      addOption('Grant','Grant');
//      addOption('Greer','Greer');
//      addOption('Harmon','Harmon');
//      addOption('Harper','Harper');
//      addOption('Haskell','Haskell');
//      addOption('Hughes','Hughes');
//      addOption('Jackson','Jackson');
//      addOption('Jefferson','Jefferson');
//      addOption('Johnston','Johnston');
//      addOption('Kay','Kay');
//      addOption('Kingfisher','Kingfisher');
//      addOption('Kiowa','Kiowa');
//      addOption('Latimer','Latimer');
//      addOption('Le Flore','Le Flore');
//      addOption('Lincoln','Lincoln');
//      addOption('Logan','Logan');
//      addOption('Love','Love');
//      addOption('Major','Major');
//      addOption('Marshall','Marshall');
//      addOption('Mayes','Mayes');
//      addOption('McClain','McClain');
//      addOption('McCurtain','McCurtain');
//      addOption('McIntosh','McIntosh');
//      addOption('Murray','Murray');
//      addOption('Muskogee','Muskogee');
//      addOption('Noble','Noble');
//      addOption('Nowata','Nowata');
//      addOption('Okfuskee','Okfuskee');
//      addOption('Oklahoma','Oklahoma');
//      addOption('Okmulgee','Okmulgee');
//      addOption('Osage','Osage');
//      addOption('Ottawa','Ottawa');
//      addOption('Pawnee','Pawnee');
//      addOption('Payne','Payne');
//      addOption('Pittsburg','Pittsburg');
//      addOption('Pontotoc','Pontotoc');
//      addOption('Pottawatomie','Pottawatomie');
//      addOption('Pushmataha','Pushmataha');
//      addOption('Roger Mills','Roger Mills');
//      addOption('Rogers','Rogers');
//      addOption('Seminole','Seminole');
//      addOption('Sequoyah','Sequoyah');
//      addOption('Stephens','Stephens');
//      addOption('Texas','Texas');
//      addOption('Tillman','Tillman');
//      addOption('Tulsa','Tulsa');
//      addOption('Wagoner','Wagoner');
//      addOption('Washington','Washington');
//      addOption('Washita','Washita');
//      addOption('Woods','Woods');
//      addOption('Woodward','Woodward');  
//    break;
//
//    case "OR":
//      removeAllOptions();
//      addOption('Baker','Baker');
//      addOption('Benton','Benton');
//      addOption('Clackamas','Clackamas');
//      addOption('Clatsop','Clatsop');
//      addOption('Columbia','Columbia');
//      addOption('Coos','Coos');
//      addOption('Crook','Crook');
//      addOption('Curry','Curry');
//      addOption('Deschutes','Deschutes');
//      addOption('Douglas','Douglas');
//      addOption('Gilliam','Gilliam');
//      addOption('Grant','Grant');
//      addOption('Harney','Harney');
//      addOption('Hood River','Hood River');
//      addOption('Jackson','Jackson');
//      addOption('Jefferson','Jefferson');
//      addOption('Josephine','Josephine');
//      addOption('Klamath','Klamath');
//      addOption('Lake','Lake');
//      addOption('Lane','Lane');
//      addOption('Lincoln','Lincoln');
//      addOption('Linn','Linn');
//      addOption('Malheur','Malheur');
//      addOption('Marion','Marion');
//      addOption('Morrow','Morrow');
//      addOption('Multnomah','Multnomah');
//      addOption('Polk','Polk');
//      addOption('Sherman','Sherman');
//      addOption('Tillamook','Tillamook');
//      addOption('Umatilla','Umatilla');
//      addOption('Union','Union');
//      addOption('Wallowa','Wallowa');
//      addOption('Wasco','Wasco');
//      addOption('Washington','Washington');
//      addOption('Wheeler','Wheeler');
//      addOption('Yamhill','Yamhill');
//    break;
//  
//    case "PA":
//      removeAllOptions();
//      addOption('adams','Adams');
//      addOption('allegheny','Allegheny');
//      addOption('armstrong','Armstrong');
//      addOption('beaver','Beaver');
//      addOption('bedford','Bedford');
//      addOption('berks','Berks');
//      addOption('blair','Blair');
//      addOption('bradford','Bradford');
//      addOption('bucks','Bucks');
//      addOption('butler','Butler');
//      addOption('cambria','Cambria');
//      addOption('cameron','Cameron');
//      addOption('carbon','Carbon');
//      addOption('centre','Centre');
//      addOption('chester','Chester');
//      addOption('clarion','Clarion');
//      addOption('clearfield','Clearfield');
//      addOption('clinton','Clinton');
//      addOption('columbia','Columbia');
//      addOption('crawford','Crawford');
//      addOption('cumberland','Cumberland');
//      addOption('dauphin','Dauphin');
//      addOption('delaware','Delaware');
//      addOption('elk','Elk');
//      addOption('erie','Erie');
//      addOption('fayette','Fayette');
//      addOption('forest','Forest');
//      addOption('franklin','Franklin');
//      addOption('fulton','Fulton');
//      addOption('greene','Greene');
//      addOption('huntingdon','Huntingdon');
//      addOption('indiana','Indiana');
//      addOption('jefferson','Jefferson');
//      addOption('juniata','Juniata');
//      addOption('lackawanna','Lackawanna');
//      addOption('lancaster','Lancaster');
//      addOption('lawrence','Lawrence');
//      addOption('lebanon','Lebanon');
//      addOption('lehigh','Lehigh');
//      addOption('luzerne','Luzerne');
//      addOption('lycoming','Lycoming');
//      addOption('mckean','McKean');
//      addOption('mercer','Mercer');
//      addOption('mifflin','Mifflin');
//      addOption('monroe','Monroe');
//      addOption('montgomery','Montgomery');
//      addOption('montour','Montour');
//      addOption('northampton','Northampton');
//      addOption('northumberland','Northumberland');
//      addOption('perry','Perry');
//      addOption('philadelphia','Philadelphia');
//      addOption('pike','Pike');
//      addOption('potter','Potter');
//      addOption('schuylkill','Schuylkill');
//      addOption('snyder','Snyder');
//      addOption('somerset','Somerset');
//      addOption('sullivan','Sullivan');
//      addOption('susquehanna','Susquehanna');
//      addOption('tioga','Tioga');
//      addOption('union','Union');
//      addOption('venango','Venango');
//      addOption('warren','Warren');
//      addOption('washington','Washington');
//      addOption('wayne','Wayne');
//      addOption('westmoreland','Westmoreland');
//      addOption('wyoming','Wyoming');
//      addOption('york','York');
//      break;
//
//      case "RI":
//      removeAllOptions();
//      addOption('Bristol','Bristol');
//      addOption('Kent','Kent');
//      addOption('Newport','Newport');
//      addOption('Providence','Providence');
//      addOption('Washington','Washington');
//      break;
//      
//      case "SC":
//      removeAllOptions();
//      addOption('Abbeville','Abbeville');
//      addOption('Aiken','Aiken');
//      addOption('Allendale','Allendale');
//      addOption('Anderson','Anderson');
//      addOption('Bamberg','Bamberg');
//      addOption('Barnwell','Barnwell');
//      addOption('Beaufort','Beaufort');
//      addOption('Berkeley','Berkeley');
//      addOption('Calhoun','Calhoun');
//      addOption('Charleston','Charleston');
//      addOption('Cherokee','Cherokee');
//      addOption('Chester','Chester');
//      addOption('Chesterfield','Chesterfield');
//      addOption('Clarendon','Clarendon');
//      addOption('Colleton','Colleton');
//      addOption('Darlington','Darlington');
//      addOption('Dillon','Dillon');
//      addOption('Dorchester','Dorchester');
//      addOption('Edgefield','Edgefield');
//      addOption('Fairfield','Fairfield');
//      addOption('Florence','Florence');
//      addOption('Georgetown','Georgetown');
//      addOption('Greenville','Greenville');
//      addOption('Greenwood','Greenwood');
//      addOption('Hampton','Hampton');
//      addOption('Horry','Horry');
//      addOption('Jasper','Jasper');
//      addOption('Kershaw','Kershaw');
//      addOption('Lancaster','Lancaster');
//      addOption('Laurens','Laurens');
//      addOption('Lee','Lee');
//      addOption('Lexington','Lexington');
//      addOption('Marion','Marion');
//      addOption('Marlboro','Marlboro');
//      addOption('McCormick','McCormick');
//      addOption('Newberry','Newberry');
//      addOption('Oconee','Oconee');
//      addOption('Orangeburg','Orangeburg');
//      addOption('Pickens','Pickens');
//      addOption('Richland','Richland');
//      addOption('Saluda','Saluda');
//      addOption('Spartanburg','Spartanburg');
//      addOption('Sumter','Sumter');
//      addOption('Union','Union');
//      addOption('Williamsburg','Williamsburg');
//      addOption('York','York');
//      break;
//      
//      case "SD":
//      removeAllOptions();
//      addOption('Aurora','Aurora');
//      addOption('Beadle','Beadle');
//      addOption('Bennett','Bennett');
//      addOption('Bon Homme','Bon Homme');
//      addOption('Brookings','Brookings');
//      addOption('Brown','Brown');
//      addOption('Brule','Brule');
//      addOption('Buffalo','Buffalo');
//      addOption('Butte','Butte');
//      addOption('Campbell','Campbell');
//      addOption('Charles Mix','Charles Mix');
//      addOption('Clark','Clark');
//      addOption('Clay','Clay');
//      addOption('Codington','Codington');
//      addOption('Corson','Corson');
//      addOption('Custer','Custer');
//      addOption('Davison','Davison');
//      addOption('Day','Day');
//      addOption('Deuel','Deuel');
//      addOption('Dewey','Dewey');
//      addOption('Douglas','Douglas');
//      addOption('Edmunds','Edmunds');
//      addOption('Fall River','Fall River');
//      addOption('Faulk','Faulk');
//      addOption('Grant','Grant');
//      addOption('Gregory','Gregory');
//      addOption('Haakon','Haakon');
//      addOption('Hamlin','Hamlin');
//      addOption('Hand','Hand');
//      addOption('Hanson','Hanson');
//      addOption('Harding','Harding');
//      addOption('Hughes','Hughes');
//      addOption('Hutchinson','Hutchinson');
//      addOption('Hyde','Hyde');
//      addOption('Jackson','Jackson');
//      addOption('Jerauld','Jerauld');
//      addOption('Jones','Jones');
//      addOption('Kingsbury','Kingsbury');
//      addOption('Lake','Lake');
//      addOption('Lawrence','Lawrence');
//      addOption('Lincoln','Lincoln');
//      addOption('Lyman','Lyman');
//      addOption('Marshall','Marshall');
//      addOption('McCook','McCook');
//      addOption('McPherson','McPherson');
//      addOption('Meade','Meade');
//      addOption('Mellette','Mellette');
//      addOption('Miner','Miner');
//      addOption('Minnehaha','Minnehaha');
//      addOption('Moody','Moody');
//      addOption('Pennington','Pennington');
//      addOption('Perkins','Perkins');
//      addOption('Potter','Potter');
//      addOption('Roberts','Roberts');
//      addOption('Sanborn','Sanborn');
//      addOption('Shannon','Shannon');
//      addOption('Spink','Spink');
//      addOption('Stanley','Stanley');
//      addOption('Sully','Sully');
//      addOption('Todd','Todd');
//      addOption('Tripp','Tripp');
//      addOption('Turner','Turner');
//      addOption('Union','Union');
//      addOption('Walworth','Walworth');
//      addOption('Yankton','Yankton');
//      addOption('Ziebach','Ziebach');
//      break;
//      
//      case "TN":
//      removeAllOptions();
//      addOption('Anderson','Anderson');
//      addOption('Bedford','Bedford');
//      addOption('Benton','Benton');
//      addOption('Bledsoe','Bledsoe');
//      addOption('Blount','Blount');
//      addOption('Bradley','Bradley');
//      addOption('Campbell','Campbell');
//      addOption('Cannon','Cannon');
//      addOption('Carroll','Carroll');
//      addOption('Carter','Carter');
//      addOption('Cheatham','Cheatham');
//      addOption('Chester','Chester');
//      addOption('Claiborne','Claiborne');
//      addOption('Clay','Clay');
//      addOption('Cocke','Cocke');
//      addOption('Coffee','Coffee');
//      addOption('Crockett','Crockett');
//      addOption('Cumberland','Cumberland');
//      addOption('Davidson','Davidson');
//      addOption('Decatur','Decatur');
//      addOption('dekalb','DeKalb');
//      addOption('Dickson','Dickson');
//      addOption('Dyer','Dyer');
//      addOption('Fayette','Fayette');
//      addOption('Fentress','Fentress');
//      addOption('Franklin','Franklin');
//      addOption('Gibson','Gibson');
//      addOption('Giles','Giles');
//      addOption('Grainger','Grainger');
//      addOption('Greene','Greene');
//      addOption('Grundy','Grundy');
//      addOption('Hamblen','Hamblen');
//      addOption('Hamilton','Hamilton');
//      addOption('Hancock','Hancock');
//      addOption('Hardeman','Hardeman');
//      addOption('Hardin','Hardin');
//      addOption('Hawkins','Hawkins');
//      addOption('Haywood','Haywood');
//      addOption('Henderson','Henderson');
//      addOption('Henry','Henry');
//      addOption('Hickman','Hickman');
//      addOption('Houston','Houston');
//      addOption('Humphreys','Humphreys');
//      addOption('Jackson','Jackson');
//      addOption('Jefferson','Jefferson');
//      addOption('Johnson','Johnson');
//      addOption('Knox','Knox');
//      addOption('Lake','Lake');
//      addOption('Lauderdale','Lauderdale');
//      addOption('Lawrence','Lawrence');
//      addOption('Lewis','Lewis');
//      addOption('Lincoln','Lincoln');
//      addOption('Loudon','Loudon');
//      addOption('Macon','Macon');
//      addOption('Madison','Madison');
//      addOption('Marion','Marion');
//      addOption('Marshall','Marshall');
//      addOption('Maury','Maury');
//      addOption('McMinn','McMinn');
//      addOption('McNairy','McNairy');
//      addOption('Meigs','Meigs');
//      addOption('Monroe','Monroe');
//      addOption('Montgomery','Montgomery');
//      addOption('Moore','Moore');
//      addOption('Morgan','Morgan');
//      addOption('Obion','Obion');
//      addOption('Overton','Overton');
//      addOption('Perry','Perry');
//      addOption('Pickett','Pickett');
//      addOption('Polk','Polk');
//      addOption('Putnam','Putnam');
//      addOption('Rhea','Rhea');
//      addOption('Roane','Roane');
//      addOption('Robertson','Robertson');
//      addOption('Rutherford','Rutherford');
//      addOption('Scott','Scott');
//      addOption('Sequatchie','Sequatchie');
//      addOption('Sevier','Sevier');
//      addOption('Shelby','Shelby');
//      addOption('Smith','Smith');
//      addOption('Stewart','Stewart');
//      addOption('Sullivan','Sullivan');
//      addOption('Sumner','Sumner');
//      addOption('Tipton','Tipton');
//      addOption('Trousdale','Trousdale');
//      addOption('Unicoi','Unicoi');
//      addOption('Union','Union');
//      addOption('Van Buren','Van Buren');
//      addOption('Warren','Warren');
//      addOption('Washington','Washington');
//      addOption('Wayne','Wayne');
//      addOption('Weakley','Weakley');
//      addOption('White','White');
//      addOption('Williamson','Williamson');
//      addOption('Wilson','Wilson');
//      break;
//
//      case "TX":
//        removeAllOptions();
//        addOption('Anderson','Anderson');
//        addOption('Andrews','Andrews');
//        addOption('Angelina','Angelina');
//        addOption('Aransas','Aransas');
//        addOption('Archer','Archer');
//        addOption('Armstrong','Armstrong');
//        addOption('Atascosa','Atascosa');
//        addOption('Austin','Austin');
//        addOption('Bailey','Bailey');
//        addOption('Bandera','Bandera');
//        addOption('Bastrop','Bastrop');
//        addOption('Baylor','Baylor');
//        addOption('Bee','Bee');
//        addOption('Bell','Bell');
//        addOption('Bexar','Bexar');
//        addOption('Blanco','Blanco');
//        addOption('Borden','Borden');
//        addOption('Bosque','Bosque');
//        addOption('Bowie','Bowie');
//        addOption('Brazoria','Brazoria');
//        addOption('Brazos','Brazos');
//        addOption('Brewster','Brewster');
//        addOption('Briscoe','Briscoe');
//        addOption('Brooks','Brooks');
//        addOption('Brown','Brown');
//        addOption('Burleson','Burleson');
//        addOption('Burnet','Burnet');
//        addOption('Caldwell','Caldwell');
//        addOption('Calhoun','Calhoun');
//        addOption('Callahan','Callahan');
//        addOption('Cameron','Cameron');
//        addOption('Camp','Camp');
//        addOption('Carson','Carson');
//        addOption('Cass','Cass');
//        addOption('Castro','Castro');
//        addOption('Chambers','Chambers');
//        addOption('Cherokee','Cherokee');
//        addOption('Childress','Childress');
//        addOption('Clay','Clay');
//        addOption('Cochran','Cochran');
//        addOption('Coke','Coke');
//        addOption('Coleman','Coleman');
//        addOption('Collin','Collin');
//        addOption('Collingsworth','Collingsworth');
//        addOption('Colorado','Colorado');
//        addOption('Comal','Comal');
//        addOption('Comanche','Comanche');
//        addOption('Concho','Concho');
//        addOption('Cooke','Cooke');
//        addOption('Coryell','Coryell');
//        addOption('Cottle','Cottle');
//        addOption('Crane','Crane');
//        addOption('Crockett','Crockett');
//        addOption('Crosby','Crosby');
//        addOption('Culberson','Culberson');
//        addOption('Dallam','Dallam');
//        addOption('Dallas','Dallas');
//        addOption('Dawson','Dawson');
//        addOption('Deaf Smith','Deaf Smith');
//        addOption('Delta','Delta');
//        addOption('Denton','Denton');
//        addOption('DeWitt','DeWitt');
//        addOption('Dickens','Dickens');
//        addOption('Dimmit','Dimmit');
//        addOption('Donley','Donley');
//        addOption('Duval','Duval');
//        addOption('Eastland','Eastland');
//        addOption('Ector','Ector');
//        addOption('Edwards','Edwards');
//        addOption('El Paso','El Paso');
//        addOption('Ellis','Ellis');
//        addOption('Erath','Erath');
//        addOption('Falls','Falls');
//        addOption('Fannin','Fannin');
//        addOption('Fayette','Fayette');
//        addOption('Fisher','Fisher');
//        addOption('Floyd','Floyd');
//        addOption('Foard','Foard');
//        addOption('Fort Bend','Fort Bend');
//        addOption('Franklin','Franklin');
//        addOption('Freestone','Freestone');
//        addOption('Frio','Frio');
//        addOption('Gaines','Gaines');
//        addOption('Galveston','Galveston');
//        addOption('Garza','Garza');
//        addOption('Gillespie','Gillespie');
//        addOption('Glasscock','Glasscock');
//        addOption('Goliad','Goliad');
//        addOption('Gonzales','Gonzales');
//        addOption('Gray','Gray');
//        addOption('Grayson','Grayson');
//        addOption('Gregg','Gregg');
//        addOption('Grimes','Grimes');
//        addOption('Guadalupe','Guadalupe');
//        addOption('Hale','Hale');
//        addOption('Hall','Hall');
//        addOption('Hamilton','Hamilton');
//        addOption('Hansford','Hansford');
//        addOption('Hardeman','Hardeman');
//        addOption('Hardin','Hardin');
//        addOption('Harris','Harris');
//        addOption('Harrison','Harrison');
//        addOption('Hartley','Hartley');
//        addOption('Haskell','Haskell');
//        addOption('Hays','Hays');
//        addOption('Hemphill','Hemphill');
//        addOption('Henderson','Henderson');
//        addOption('Hidalgo','Hidalgo');
//        addOption('Hill','Hill');
//        addOption('Hockley','Hockley');
//        addOption('Hood','Hood');
//        addOption('Hopkins','Hopkins');
//        addOption('Houston','Houston');
//        addOption('Howard','Howard');
//        addOption('Hudspeth','Hudspeth');
//        addOption('Hunt','Hunt');
//        addOption('Hutchinson','Hutchinson');
//        addOption('Irion','Irion');
//        addOption('Jack','Jack');
//        addOption('Jackson','Jackson');
//        addOption('Jasper','Jasper');
//        addOption('Jeff Davis','Jeff Davis');
//        addOption('Jefferson','Jefferson');
//        addOption('Jim Hogg','Jim Hogg');
//        addOption('Jim Wells','Jim Wells');
//        addOption('Johnson','Johnson');
//        addOption('Jones','Jones');
//        addOption('Karnes','Karnes');
//        addOption('Kaufman','Kaufman');
//        addOption('Kendall','Kendall');
//        addOption('Kenedy','Kenedy');
//        addOption('Kent','Kent');
//        addOption('Kerr','Kerr');
//        addOption('Kimble','Kimble');
//        addOption('King','King');
//        addOption('Kinney','Kinney');
//        addOption('Kleberg','Kleberg');
//        addOption('Knox','Knox');
//        addOption('La Salle','La Salle');
//        addOption('Lamar','Lamar');
//        addOption('Lamb','Lamb');
//        addOption('Lampasas','Lampasas');
//        addOption('Lavaca','Lavaca');
//        addOption('Lee','Lee');
//        addOption('Leon','Leon');
//        addOption('Liberty','Liberty');
//        addOption('Limestone','Limestone');
//        addOption('Lipscomb','Lipscomb');
//        addOption('Live Oak','Live Oak');
//        addOption('Llano','Llano');
//        addOption('Loving','Loving');
//        addOption('Lubbock','Lubbock');
//        addOption('Lynn','Lynn');
//        addOption('Madison','Madison');
//        addOption('Marion','Marion');
//        addOption('Martin','Martin');
//        addOption('Mason','Mason');
//        addOption('Matagorda','Matagorda');
//        addOption('Maverick','Maverick');
//        addOption('McCulloch','McCulloch');
//        addOption('McLennan','McLennan');
//        addOption('McMullen','McMullen');
//        addOption('Medina','Medina');
//        addOption('Menard','Menard');
//        addOption('Midland','Midland');
//        addOption('Milam','Milam');
//        addOption('Mills','Mills');
//        addOption('Mitchell','Mitchell');
//        addOption('Montague','Montague');
//        addOption('Montgomery','Montgomery');
//        addOption('Moore','Moore');
//        addOption('Morris','Morris');
//        addOption('Motley','Motley');
//        addOption('Nacogdoches','Nacogdoches');
//        addOption('Navarro','Navarro');
//        addOption('Newton','Newton');
//        addOption('Nolan','Nolan');
//        addOption('Nueces','Nueces');
//        addOption('Ochiltree','Ochiltree');
//        addOption('Oldham','Oldham');
//        addOption('Orange','Orange');
//        addOption('Palo Pinto','Palo Pinto');
//        addOption('Panola','Panola');
//        addOption('Parker','Parker');
//        addOption('Parmer','Parmer');
//        addOption('Pecos','Pecos');
//        addOption('Polk','Polk');
//        addOption('Potter','Potter');
//        addOption('Presidio','Presidio');
//        addOption('Rains','Rains');
//        addOption('Randall','Randall');
//        addOption('Reagan','Reagan');
//        addOption('Real','Real');
//        addOption('Red River','Red River');
//        addOption('Reeves','Reeves');
//        addOption('Refugio','Refugio');
//        addOption('Roberts','Roberts');
//        addOption('Robertson','Robertson');
//        addOption('Rockwall','Rockwall');
//        addOption('Runnels','Runnels');
//        addOption('Rusk','Rusk');
//        addOption('Sabine','Sabine');
//        addOption('San Augustine','San Augustine');
//        addOption('San Jacinto','San Jacinto');
//        addOption('San Patricio','San Patricio');
//        addOption('San Saba','San Saba');
//        addOption('Schleicher','Schleicher');
//        addOption('Scurry','Scurry');
//        addOption('Shackelford','Shackelford');
//        addOption('Shelby','Shelby');
//        addOption('Sherman','Sherman');
//        addOption('Smith','Smith');
//        addOption('Somervell','Somervell');
//        addOption('Starr','Starr');
//        addOption('Stephens','Stephens');
//        addOption('Sterling','Sterling');
//        addOption('Stonewall','Stonewall');
//        addOption('Sutton','Sutton');
//        addOption('Swisher','Swisher');
//        addOption('Tarrant','Tarrant');
//        addOption('Taylor','Taylor');
//        addOption('Terrell','Terrell');
//        addOption('Terry','Terry');
//        addOption('Throckmorton','Throckmorton');
//        addOption('Titus','Titus');
//        addOption('Tom Green','Tom Green');
//        addOption('Travis','Travis');
//        addOption('Trinity','Trinity');
//        addOption('Tyler','Tyler');
//        addOption('Upshur','Upshur');
//        addOption('Upton','Upton');
//        addOption('Uvalde','Uvalde');
//        addOption('Val Verde','Val Verde');
//        addOption('Van Zandt','Van Zandt');
//        addOption('Victoria','Victoria');
//        addOption('Walker','Walker');
//        addOption('Waller','Waller');
//        addOption('Ward','Ward');
//        addOption('Washington','Washington');
//        addOption('Webb','Webb');
//        addOption('Wharton','Wharton');
//        addOption('Wheeler','Wheeler');
//        addOption('Wichita','Wichita');
//        addOption('Wilbarger','Wilbarger');
//        addOption('Willacy','Willacy');
//        addOption('Williamson','Williamson');
//        addOption('Wilson','Wilson');
//        addOption('Winkler','Winkler');
//        addOption('Wise','Wise');
//        addOption('Wood','Wood');
//        addOption('Yoakum','Yoakum');
//        addOption('Young','Young');
//        addOption('Zapata','Zapata');
//        addOption('Zavala','Zavala');
//      break;
//
//      case "UT":
//        removeAllOptions();
//        addOption('Beaver','Beaver');
//        addOption('Box Elder','Box Elder');
//        addOption('Cache','Cache');
//        addOption('Carbon','Carbon');
//        addOption('Daggett','Daggett');
//        addOption('Davis','Davis');
//        addOption('Duchesne','Duchesne');
//        addOption('Emery','Emery');
//        addOption('Garfield','Garfield');
//        addOption('Grand','Grand');
//        addOption('Iron','Iron');
//        addOption('Juab','Juab');
//        addOption('Kane','Kane');
//        addOption('Millard','Millard');
//        addOption('Morgan','Morgan');
//        addOption('Piute','Piute');
//        addOption('Rich','Rich');
//        addOption('Salt Lake','Salt Lake');
//        addOption('San Juan','San Juan');
//        addOption('Sanpete','Sanpete');
//        addOption('Sevier','Sevier');
//        addOption('Summit','Summit');
//        addOption('Tooele','Tooele');
//        addOption('Uintah','Uintah');
//        addOption('Utah','Utah');
//        addOption('Wasatch','Wasatch');
//        addOption('Washington','Washington');
//        addOption('Wayne','Wayne');
//        addOption('Weber','Weber');
//      break;
//      
//      case "VA":
//      removeAllOptions();      
//      addOption('Accomack','Accomack');
//      addOption('Albemarle','Albemarle');
//      addOption('Alexandria City','Alexandria City');
//      addOption('Alleghany','Alleghany');
//      addOption('Amelia','Amelia');
//      addOption('Amherst','Amherst');
//      addOption('Appomattox','Appomattox');
//      addOption('Arlington','Arlington');
//      addOption('Augusta','Augusta');
//      addOption('Bath','Bath');
//      addOption('Bedford','Bedford');
//      addOption('Bland','Bland');
//      addOption('Botetourt','Botetourt');
//      addOption('Bristol','Bristol');
//      addOption('Brunswick','Brunswick');
//      addOption('Buchanan','Buchanan');
//      addOption('Buckingham','Buckingham');
//      addOption('Buena Vista City','Buena Vista City');
//      addOption('Campbell','Campbell');
//      addOption('Caroline','Caroline');
//      addOption('Carroll','Carroll');
//      addOption('Charles City','Charles City');
//      addOption('Charlotte','Charlotte');
//      addOption('Charlottesville City','Charlottesville City');
//      addOption('Chesapeake City','Chesapeake City');
//      addOption('Chesterfield','Chesterfield');
//      addOption('Clarke','Clarke');
//      addOption('Colonial Heights City','Colonial Heights City');
//      addOption('Covington City','Covington City');
//      addOption('Craig','Craig');
//      addOption('Culpeper','Culpeper');
//      addOption('Cumberland','Cumberland');
//      addOption('Danville City','Danville City');
//      addOption('Dickenson','Dickenson');
//      addOption('Dinwiddie','Dinwiddie');
//      addOption('Emporia City','Emporia City');
//      addOption('Essex','Essex');
//      addOption('Fairfax','Fairfax');
//      addOption('Fairfax City','Fairfax City');
//      addOption('Falls Church City','Falls Church City');
//      addOption('Fauquier','Fauquier');
//      addOption('Floyd','Floyd');
//      addOption('Fluvanna','Fluvanna');
//      addOption('Franklin','Franklin');
//      addOption('Franklin City','Franklin City');
//      addOption('Frederick','Frederick');
//      addOption('Fredericksburg City','Fredericksburg City');
//      addOption('Galax City','Galax City');
//      addOption('Giles','Giles');
//      addOption('Gloucester','Gloucester');
//      addOption('Goochland','Goochland');
//      addOption('Grayson','Grayson');
//      addOption('Greene','Greene');
//      addOption('Greensville','Greensville');
//      addOption('Halifax','Halifax');
//      addOption('Hampton City','Hampton City');
//      addOption('Hanover','Hanover');
//      addOption('Harrisonburg City','Harrisonburg City');
//      addOption('Henrico','Henrico');
//      addOption('Henry','Henry');
//      addOption('Highland','Highland');
//      addOption('Hopewell City','Hopewell City');
//      addOption('Isle of Wight','Isle of Wight');
//      addOption('James City','James City');
//      addOption('King and Queen','King and Queen');
//      addOption('King George','King George');
//      addOption('King William','King William');
//      addOption('Lancaster','Lancaster');
//      addOption('Lee','Lee');
//      addOption('Lexington City','Lexington City');
//      addOption('Loudoun','Loudoun');
//      addOption('Louisa','Louisa');
//      addOption('Lunenburg','Lunenburg');
//      addOption('Lynchburg City','Lynchburg City');
//      addOption('Madison','Madison');
//      addOption('Manassas City','Manassas City');
//      addOption('Manassas Park City','Manassas Park City');
//      addOption('Martinsville City','Martinsville City');
//      addOption('Mathews','Mathews');
//      addOption('Mecklenburg','Mecklenburg');
//      addOption('Middlesex','Middlesex');
//      addOption('Montgomery','Montgomery');
//      addOption('Nelson','Nelson');
//      addOption('New Kent','New Kent');
//      addOption('Newport News City','Newport News City');
//      addOption('Norfolk City','Norfolk City');
//      addOption('Northampton','Northampton');
//      addOption('Northumberland','Northumberland');
//      addOption('Norton City','Norton City');
//      addOption('Nottoway','Nottoway');
//      addOption('Orange','Orange');
//      addOption('Page','Page');
//      addOption('Patrick','Patrick');
//      addOption('Petersburg City','Petersburg City');
//      addOption('Pittsylvania','Pittsylvania');
//      addOption('Poquoson City','Poquoson City');
//      addOption('Portsmouth City','Portsmouth City');
//      addOption('Powhatan','Powhatan');
//      addOption('Prince Edward','Prince Edward');
//      addOption('Prince George','Prince George');
//      addOption('Prince William','Prince William');
//      addOption('Pulaski','Pulaski');
//      addOption('Radford City','Radford City');
//      addOption('Rappahannock','Rappahannock');
//      addOption('Richmond','Richmond');
//      addOption('Richmond City','Richmond City');
//      addOption('Roanoke','Roanoke');
//      addOption('Roanoke City','Roanoke City');
//      addOption('Rockbridge','Rockbridge');
//      addOption('Rockingham','Rockingham');
//      addOption('Russell','Russell');
//      addOption('Salem','Salem');
//      addOption('Scott','Scott');
//      addOption('Shenandoah','Shenandoah');
//      addOption('Smyth','Smyth');
//      addOption('Southampton','Southampton');
//      addOption('Spotsylvania','Spotsylvania');
//      addOption('Stafford','Stafford');
//      addOption('Staunton City','Staunton City');
//      addOption('Suffolk City','Suffolk City');
//      addOption('Surry','Surry');
//      addOption('Sussex','Sussex');
//      addOption('Tazewell','Tazewell');
//      addOption('Virginia Beach City','Virginia Beach City');
//      addOption('Warren','Warren');
//      addOption('Washington','Washington');
//      addOption('Waynesboro City','Waynesboro City');
//      addOption('Westmoreland','Westmoreland');
//      addOption('Williamsburg City','Williamsburg City');
//      addOption('Winchester City','Winchester City');
//      addOption('Wise','Wise');
//      addOption('Wythe','Wythe');
//      addOption('York','York');
//      break;
//
//      case "VT":
//        removeAllOptions();
//        addOption('Addison','Addison');
//        addOption('Bennington','Bennington');
//        addOption('Caledonia','Caledonia');
//        addOption('Chittenden','Chittenden');
//        addOption('Essex','Essex');
//        addOption('Franklin','Franklin');
//        addOption('Grand Isle','Grand Isle');
//        addOption('Lamoille','Lamoille');
//        addOption('Orange','Orange');
//        addOption('Orleans','Orleans');
//        addOption('Rutland','Rutland');
//        addOption('Washington','Washington');
//        addOption('Windham','Windham');
//        addOption('Windsor','Windsor');
//      break;
//
//      case "WA":
//        removeAllOptions();
//        addOption('Adams','Adams');
//        addOption('Asotin','Asotin');
//        addOption('Benton','Benton');
//        addOption('Chelan','Chelan');
//        addOption('Clallam','Clallam');
//        addOption('Clark','Clark');
//        addOption('Columbia','Columbia');
//        addOption('Cowlitz','Cowlitz');
//        addOption('Douglas','Douglas');
//        addOption('Ferry','Ferry');
//        addOption('Franklin','Franklin');
//        addOption('Garfield','Garfield');
//        addOption('Grant','Grant');
//        addOption('Grays Harbor','Grays Harbor');
//        addOption('Island','Island');
//        addOption('Jefferson','Jefferson');
//        addOption('King','King');
//        addOption('Kitsap','Kitsap');
//        addOption('Kittitas','Kittitas');
//        addOption('Klickitat','Klickitat');
//        addOption('Lewis','Lewis');
//        addOption('Lincoln','Lincoln');
//        addOption('Mason','Mason');
//        addOption('Okanogan','Okanogan');
//        addOption('Pacific','Pacific');
//        addOption('Pend Oreille','Pend Oreille');
//        addOption('Pierce','Pierce');
//        addOption('San Juan','San Juan');
//        addOption('Skagit','Skagit');
//        addOption('Skamania','Skamania');
//        addOption('Snohomish','Snohomish');
//        addOption('Spokane','Spokane');
//        addOption('Stevens','Stevens');
//        addOption('Thurston','Thurston');
//        addOption('Wahkiakum','Wahkiakum');
//        addOption('Walla Walla','Walla Walla');
//        addOption('Whatcom','Whatcom');
//        addOption('Whitman','Whitman');
//        addOption('Yakima','Yakima');
//      break;
//      
//      case "WI":
//      removeAllOptions();   
//      addOption('Adams','Adams');
//      addOption('Ashland','Ashland');
//      addOption('Barron','Barron');
//      addOption('Bayfield','Bayfield');
//      addOption('Brown','Brown');
//      addOption('Buffalo','Buffalo');
//      addOption('Burnett','Burnett');
//      addOption('Calumet','Calumet');
//      addOption('Chippewa','Chippewa');
//      addOption('Clark','Clark');
//      addOption('Columbia','Columbia');
//      addOption('Crawford','Crawford');
//      addOption('Dane','Dane');
//      addOption('Dodge','Dodge');
//      addOption('Door','Door');
//      addOption('Douglas','Douglas');
//      addOption('Dunn','Dunn');
//      addOption('Eau Claire','Eau Claire');
//      addOption('Florence','Florence');
//      addOption('Fond du Lac','Fond du Lac');
//      addOption('Forest','Forest');
//      addOption('Grant','Grant');
//      addOption('Green','Green');
//      addOption('Green Lake','Green Lake');
//      addOption('Iowa','Iowa');
//      addOption('Iron','Iron');
//      addOption('Jackson','Jackson');
//      addOption('Jefferson','Jefferson');
//      addOption('Juneau','Juneau');
//      addOption('Kenosha','Kenosha');
//      addOption('Kewaunee','Kewaunee');
//      addOption('La Crosse','La Crosse');
//      addOption('Lafayette','Lafayette');
//      addOption('Langlade','Langlade');
//      addOption('Lincoln','Lincoln');
//      addOption('Manitowoc','Manitowoc');
//      addOption('Marathon','Marathon');
//      addOption('Marinette','Marinette');
//      addOption('Marquette','Marquette');
//      addOption('Menominee','Menominee');
//      addOption('Milwaukee','Milwaukee');
//      addOption('Monroe','Monroe');
//      addOption('Oconto','Oconto');
//      addOption('Oneida','Oneida');
//      addOption('Outagamie','Outagamie');
//      addOption('Ozaukee','Ozaukee');
//      addOption('Pepin','Pepin');
//      addOption('Pierce','Pierce');
//      addOption('Polk','Polk');
//      addOption('Portage','Portage');
//      addOption('Price','Price');
//      addOption('Racine','Racine');
//      addOption('Richland','Richland');
//      addOption('Rock','Rock');
//      addOption('Rusk','Rusk');
//      addOption('Sauk','Sauk');
//      addOption('Sawyer','Sawyer');
//      addOption('Shawano','Shawano');
//      addOption('Sheboygan','Sheboygan');
//      addOption('St. Croix','St. Croix');
//      addOption('Taylor','Taylor');
//      addOption('Trempealeau','Trempealeau');
//      addOption('Vernon','Vernon');
//      addOption('Vilas','Vilas');
//      addOption('Walworth','Walworth');
//      addOption('Washburn','Washburn');
//      addOption('Washington','Washington');
//      addOption('Waukesha','Waukesha');
//      addOption('Waupaca','Waupaca');
//      addOption('Waushara','Waushara');
//      addOption('Winnebago','Winnebago');
//      addOption('Wood','Wood');
//      break;
//      
//      case "WV":
//      removeAllOptions();
//      addOption('Barbour','Barbour');
//      addOption('Berkeley','Berkeley');
//      addOption('Boone','Boone');
//      addOption('Braxton','Braxton');
//      addOption('Brooke','Brooke');
//      addOption('Cabell','Cabell');
//      addOption('Calhoun','Calhoun');
//      addOption('Clay','Clay');
//      addOption('Doddridge','Doddridge');
//      addOption('Fayette','Fayette');
//      addOption('Gilmer','Gilmer');
//      addOption('Grant','Grant');
//      addOption('Greenbrier','Greenbrier');
//      addOption('Hampshire','Hampshire');
//      addOption('Hancock','Hancock');
//      addOption('Hardy','Hardy');
//      addOption('Harrison','Harrison');
//      addOption('Jackson','Jackson');
//      addOption('Jefferson','Jefferson');
//      addOption('Kanawha','Kanawha');
//      addOption('Lewis','Lewis');
//      addOption('Lincoln','Lincoln');
//      addOption('Logan','Logan');
//      addOption('Marion','Marion');
//      addOption('Marshall','Marshall');
//      addOption('Mason','Mason');
//      addOption('McDowell','McDowell');
//      addOption('Mercer','Mercer');
//      addOption('Mineral','Mineral');
//      addOption('Mingo','Mingo');
//      addOption('Monongalia','Monongalia');
//      addOption('Monroe','Monroe');
//      addOption('Morgan','Morgan');
//      addOption('Nicholas','Nicholas');
//      addOption('Ohio','Ohio');
//      addOption('Pendleton','Pendleton');
//      addOption('Pleasants','Pleasants');
//      addOption('Pocahontas','Pocahontas');
//      addOption('Preston','Preston');
//      addOption('Putnam','Putnam');
//      addOption('Raleigh','Raleigh');
//      addOption('Randolph','Randolph');
//      addOption('Ritchie','Ritchie');
//      addOption('Roane','Roane');
//      addOption('Summers','Summers');
//      addOption('Taylor','Taylor');
//      addOption('Tucker','Tucker');
//      addOption('Tyler','Tyler');
//      addOption('Upshur','Upshur');
//      addOption('Wayne','Wayne');
//      addOption('Webster','Webster');
//      addOption('Wetzel','Wetzel');
//      addOption('Wirt','Wirt');
//      addOption('Wood','Wood');
//      addOption('Wyoming','Wyoming');
//      break;
//
//      case "WY":
//        removeAllOptions();      
//        addOption('Albany','Albany');
//        addOption('Big Horn','Big Horn');
//        addOption('Campbell','Campbell');
//        addOption('Carbon','Carbon');
//        addOption('Converse','Converse');
//        addOption('Crook','Crook');
//        addOption('Fremont','Fremont');
//        addOption('Goshen','Goshen');
//        addOption('Hot Springs','Hot Springs');
//        addOption('Johnson','Johnson');
//        addOption('Laramie','Laramie');
//        addOption('Lincoln','Lincoln');
//        addOption('Natrona','Natrona');
//        addOption('Niobrara','Niobrara');
//        addOption('Park','Park');
//        addOption('Platte','Platte');
//        addOption('Sheridan','Sheridan');
//        addOption('Sublette','Sublette');
//        addOption('Sweetwater','Sweetwater');
//        addOption('Teton','Teton');
//        addOption('Uinta','Uinta');
//        addOption('Washakie','Washakie');
//        addOption('Weston','Weston');
//      break;
//      
//     default:
//      removeAllOptions();
//     addOption('allcounties','All Counties');
//}//end of switch
//
//townSwitch();
//}//end of county switch

function ValidateGFE(){
  var result="";
  
  //checks loan amount
  if(document.CALC.loan_amount.value >=0 && document.CALC.loan_amount.value < 100000000){}
  else {alert("Please enter a valid loan amount"); document.CALC.loan_amount.value=0; return false;}
  
  //checks purchase price
  if(document.CALC.purchase_price.value >=0 &&  document.CALC.purchase_price.value < 100000000){}
  else {alert("Please enter a valid purchase price"); document.CALC.purchase_price.value=0; return false;}
  
  //checks existing debt
  if(document.CALC.exdebt.value >=0 && document.CALC.exdebt.value < 100000000){}
  else {alert("Please enter a valid existing debt amount"); document.CALC.exdebt.value=0; return false;}
  
 

  
 // alert(document.CALC.ReissueRate.checked);
  //ReIssue Rate check
 // if(document.CALC.ReissueRate.value != "" && document.CALC.loantype[0].checked && document.CALC.state.value != "ME")
 // {alert("Reissue rates in "+document.CALC.state.value+" are only applicable for refinances"); return false;}
  

}// end form validation funtion

function ClearGFE(){
  clearTownships();
  removeAllOptions();
  document.CALC.state.value = "NA";
  document.CALC.purchase_price.value = 0;
  document.CALC.exdebt.value = 0;
  document.CALC.loan_amount.value = 0;
  document.CALC.filename.value = "";
  document.CALC.loanid.value = "";
  
  document.CALC.TitleOrderOnly.checked = false;
  document.CALC.FirstTime.checked = false;
  document.CALC.loantype[0].checked = true;
}
	</script>
</head>

<body style="background: #efeee9;">
<div class="container">
 
  <?php
if(preg_match('/(?i)msie [7-8]/',$_SERVER['HTTP_USER_AGENT'])==1)
{
?>
<ul>
<!--<li><a href="GFE_main.php" class="navbutton">GFE</a></li>
<li><a href="AC_main.php" class="navbutton">Affordability</a></li>
<li><a href="COMM_main.php" class="navbutton">Commercial</a></li>
<li><a href="CEMA_main.php" class="navbutton">New York Calculator</a></li>-->
 <?php if($gfe=="1"){?><li><a href="GFE_main.php" class="navbutton">GFE</a></li><?php } ?>
 <?php if($ac=="1"){?><li><a href="AC_main.php" class="navbutton">Affordability</a></li><?php } ?>
 <?php if($nyc=="1"){?><li><a href="CEMA_main.php" class="navbutton">New York</a></li><?php } ?>
 <?php if($ctic=="1"){?><li class="active"><a href="COMM_main.php" class="navbutton">Commercial</a></li><?php } ?>
<li><a href="history.php" class="navbutton">Search History</a></li>
<li><a href="ordertitle.php" class="navbutton">Order Title</a></li>
<li><a href="myprofile.php" class="navbutton">My Profile</a></li>
<li><a href="logout.php" class="navbutton">Log Out</a></li>
</ul>  
<?php
}
else{
?>

<nav class="navbar navbar-default" role="navigation">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="http://lssoftwaresolutions.com/" target="_blank"><img class="img-responsive" src="./Images/lode_star_logo.png" style="height:50px;width:102px" alt="Responsive image"></a>
  </div>

  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav">
<!--      <li><a href="GFE_main.php">GFE</a></li>
      <li><a href="AC_main.php">Affordability</a></li>
      <li><a href="CEMA_main.php">New York</a></li>
      <li class="active"><a href="COMM_main.php">Commercial</a></li>
-->
 <?php if($gfe=="1"){?><li><a href="GFE_main.php" class="navbutton">GFE</a></li><?php } ?>
 <?php if($ac=="1"){?><li><a href="AC_main.php" class="navbutton">Affordability</a></li><?php } ?>
 <?php if($nyc=="1"){?><li><a href="CEMA_main.php" class="navbutton">New York</a></li><?php } ?>
 <?php if($ctic=="1"){?><li class="active"><a href="COMM_main.php" class="navbutton">Commercial</a></li><?php } ?>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="ordertitle.php">Order Title</a></li>
      <li><a href="myprofile.php">My Profile</a></li>
      <li><a href="history.php">My Searches</a></li>
      <li><a href="logout.php">Log Out</a></li>
    </ul>
  </div><!-- /.navbar-collapse -->

</nav>

<?php
}
?>

</div>
<div class='middle'>

<div class="container">
        <p STYLE= margin-left:15px;font-family:arial;color:grey;font-size:30px;">Commercial Title Insurance Calculator
        <br/>
        <!-- #Implement -->
	<form name="CALC" method="post" action="COMM_results.php" target="COMM_iframe" onsubmit="return ValidateGFE()">
	<table class="table table-hover" STYLE=margin-left:15px border="0" cellspacing="2" cellpadding="10">

	 <tr><td colspan="1"><b>Loan Type:</td>
	<td width="256"><input type="radio" name="purpose" value="1" <?php if($_SESSION['purpose']=='1'){echo "checked";}else{echo "checked";}?> /> Purchase &nbsp;
	<input type="radio" name="purpose" value="0" <?php if($_SESSION['purpose']=='0'){echo "checked";}?> /> Refinance
	</b></td>
	<td><b>Purchase Price:</b></td><td><input type="text" name="purchase_price" size=10 value="<?php if(isset($_SESSION['purchase_price'])){echo $_SESSION['purchase_price'];} else{echo"0";} ?>" ></td></tr>
	<tr><td></td><td></td>
	<td><b>Loan Amount:</b></td><td><input type="text" name="loan_amount" size=10 value="<?php if(isset($_SESSION['loan_amount'])){echo $_SESSION['loan_amount'];} else{echo"0";} ?>" ></td></tr>	
	<tr><td><b>State:</b></td>
	<td><select name="state" id="state" value="NA" onchange= "fetchcounties(this.value)">
		 <option value="NA">Please Select a State</option>
        <?php   
         foreach($GLOBALS['states'] as $state)
        {
            
            echo '<option value="'.$state.'">'.$state.'</option>';
        }
        
        ?>
	 <!--<option value="AK" <?php if($_SESSION['state']=='AK'){echo "selected";}?>>AK</option>
         <option value="AL" <?php if($_SESSION['state']=='AL'){echo "selected";}?>>AL</option>
         <option value="AR" <?php if($_SESSION['state']=='AR'){echo "selected";}?>>AR</option>
         <option value="AZ" <?php if($_SESSION['state']=='AZ'){echo "selected";}?>>AZ</option>
         <option value="CA" <?php if($_SESSION['state']=='CA'){echo "selected";}?>>CA</option>
         <option value="CO" <?php if($_SESSION['state']=='CO'){echo "selected";}?>>CO</option>
         <option value="CT" <?php if($_SESSION['state']=='CT'){echo "selected";}?>>CT</option>
         <option value="DC" <?php if($_SESSION['state']=='DC'){echo "selected";}?>>DC</option>
         <option value="DE" <?php if($_SESSION['state']=='DE'){echo "selected";}?>>DE</option>
         <option value="FL" <?php if($_SESSION['state']=='FL'){echo "selected";}?>>FL</option>
         <option value="GA" <?php if($_SESSION['state']=='GA'){echo "selected";}?>>GA</option>
         <option value="HI" <?php if($_SESSION['state']=='HI'){echo "selected";}?>>HI</option>
         <option value="IA" <?php if($_SESSION['state']=='IA'){echo "selected";}?>>IA</option>
	 <option value="ID" <?php if($_SESSION['state']=='ID'){echo "selected";}?>>ID</option>
	 <option value="IL" <?php if($_SESSION['state']=='IL'){echo "selected";}?>>IL</option>
	 <option value="IN" <?php if($_SESSION['state']=='IN'){echo "selected";}?>>IN</option>
         <option value="KS" <?php if($_SESSION['state']=='KS'){echo "selected";}?>>KS</option>
         <option value="KY" <?php if($_SESSION['state']=='KY'){echo "selected";}?>>KY</option>
         <option value="LA" <?php if($_SESSION['state']=='LA'){echo "selected";}?>>LA</option>
         <option value="MA" <?php if($_SESSION['state']=='MA'){echo "selected";}?>>MA</option>
         <option value="MD" <?php if($_SESSION['state']=='MD'){echo "selected";}?>>MD</option>
         <option value="ME" <?php if($_SESSION['state']=='ME'){echo "selected";}?>>ME</option>
         <option value="MI" <?php if($_SESSION['state']=='MI'){echo "selected";}?>>MI</option>
         <option value="MN" <?php if($_SESSION['state']=='MN'){echo "selected";}?>>MN</option>
         <option value="MO" <?php if($_SESSION['state']=='MO'){echo "selected";}?>>MO</option>
         <option value="MS" <?php if($_SESSION['state']=='MS'){echo "selected";}?>>MS</option>
         <option value="MT" <?php if($_SESSION['state']=='MT'){echo "selected";}?>>MT</option>
         <option value="NC" <?php if($_SESSION['state']=='NC'){echo "selected";}?>>NC</option>
         <option value="ND" <?php if($_SESSION['state']=='ND'){echo "selected";}?>>ND</option>
         <option value="NE" <?php if($_SESSION['state']=='NE'){echo "selected";}?>>NE</option>
         <option value="NH" <?php if($_SESSION['state']=='NH'){echo "selected";}?>>NH</option>
         <option value="NJ" <?php if($_SESSION['state']=='NJ'){echo "selected";}?>>NJ</option>
         <option value="NM" <?php if($_SESSION['state']=='NM'){echo "selected";}?>>NM</option>
         <option value="NV" <?php if($_SESSION['state']=='NV'){echo "selected";}?>>NV</option>
         <option value="NY" <?php if($_SESSION['state']=='NY'){echo "selected";}?>>NY</option>
         <option value="OH" <?php if($_SESSION['state']=='OH'){echo "selected";}?>>OH</option>
         <option value="OK" <?php if($_SESSION['state']=='OK'){echo "selected";}?>>OK</option>
         <option value="OR" <?php if($_SESSION['state']=='OR'){echo "selected";}?>>OR</option>
         <option value="PA" <?php if($_SESSION['state']=='PA'){echo "selected";}?>>PA</option>
         <option value="RI" <?php if($_SESSION['state']=='RI'){echo "selected";}?>>RI</option>
         <option value="SC" <?php if($_SESSION['state']=='SC'){echo "selected";}?>>SC</option>
         <option value="SD" <?php if($_SESSION['state']=='SD'){echo "selected";}?>>SD</option>
         <option value="TN" <?php if($_SESSION['state']=='TN'){echo "selected";}?>>TN</option>
         <option value="TX" <?php if($_SESSION['state']=='TX'){echo "selected";}?>>TX</option>
         <option value="UT" <?php if($_SESSION['state']=='UT'){echo "selected";}?>>UT</option>
         <option value="VA" <?php if($_SESSION['state']=='VA'){echo "selected";}?>>VA</option>
         <option value="VT" <?php if($_SESSION['state']=='VT'){echo "selected";}?>>VT</option>
         <option value="WA" <?php if($_SESSION['state']=='WA'){echo "selected";}?>>WA</option>
         <option value="WI" <?php if($_SESSION['state']=='WI'){echo "selected";}?>>WI</option>
         <option value="WV" <?php if($_SESSION['state']=='WV'){echo "selected";}?>>WV</option>
         <option value="WY" <?php if($_SESSION['state']=='WY'){echo "selected";}?>>WY</option>-->
	 </select> </td>
	<td> <b>Existing Debt:</b><br/>(Refis in FL,MD & NJ only)</td><td><input type="text" name="exdebt" size=10 value=<?php if(isset($_SESSION['exdebt'])){echo $_SESSION['exdebt'];} else{echo"0";} ?>></td></tr>
	<tr><td><b>County:</b></td>
	<td><select name="county" id="county" onchange= "fetchtownships(this.value,state.value)">
	 <option value="NA">Please select a county</option> 
	 </select></td>
	<td><b> LoanID: </b></td>
        <td><input type="text" name="loanid" size=20 value="<?= $_SESSION['loanid'] ?>"></td>
	</tr>
	<tr><td><b>Township:</b></td><td> <select name="township" id="township" >
	 <option value="NA">Please select a township</option> 
	</select></td>
	<td><b>File Name:</b></td><td><input type="text" name="filename" size=20 value="<?= $_SESSION['filename'] ?>"></td>
	</tr>
	
	<tr><td><input type="submit" class="btn btn-default"  name="CalculateRate" value= "Calculate Rate" /></td>
	<td><input type="submit"  class="btn btn-default"   name="ReissueRate" value= "Reissue Rate" />&nbsp;
        <input type="submit" class="btn btn-default"  name="EmailQuote" value= "Email Quote"/></td>
	<td><input type="button" class="btn btn-default"  name="command"  value= "Order Title" onclick=OrderTitle() /> </td>
	<td><input type="submit" class="btn btn-default" name="ClearValues" value="Clear Values" align="right" onclick=ClearGFE() /></td>
        <td></td></tr>
        </table></form><br/>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	
        <!-- #Implement -->
	<iframe name="COMM_iframe" src="COMM_results.php" width="700" height="550" seamless style="border:none"></iframe>
	</div>
        </div>

	<!-- End of Rate calculator -->


 <script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-15305208-3']);
  _gaq.push(['_trackPageview']);

 (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();


//resets county and town fields when session variable is pulled in
  //window.onload=countyswitch();
  //window.onload=townSwitch();

</script>

<?php	
  
 } else{

$_SESSION['lastref'] = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$_SESSION['target']="GFE";
// #Implement
if(preg_match('/(?i)msie [1-8]/',$_SERVER['HTTP_USER_AGENT'])==1)
{
  echo "<meta http-equiv='refresh' content='0;url=http://www.jimboindustries.com/ResTitle_Old_Test/GFEcalc_main.php'>";
}
else{
echo "<meta http-equiv='refresh' content='0;url=http://www.jimboindustries.com/ResTitle_Test/Login/index.php'>";
 }

}
?>

</body>
</html>
