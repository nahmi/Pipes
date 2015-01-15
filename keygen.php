<?php
function keygen($a)
{
    $reloco='WifeHowwouldyoudescribemeHusbandABCDEFGHIJKWifeWhatdoesthatmeanHusbandAdorablebeautifulcutedelightfulelegantfashionablegorgeousandhotWifeAwthankyoubutwhataboutIJKHusbandImjustkiddingQWERTSEJDJFURMCVIRMFVYSLERMNCYDKCVHVYDFJKCYXDIKDFJH';
    
    //Saca letras random de un chiste copado :)

    /* Original para curiosos :
        Wife: "How would you describe me?" 
        Husband: "ABCDEFGHIJK." 
        Wife: "What does that mean?" 
        Husband: "Adorable, beautiful, cute, delightful, elegant, fashionable, gorgeous, and hot." 
        Wife: "Aw, thank you, but what about IJK?" 
        Husband: "I'm just kidding!"
    */

    $relocolargo=strlen($reloco);
    $res="";
    $random=rand ( 2 , 8 );
    $link=$a*$random;
    $largo=strlen($link);
    for($i=0; $i<$largo; $i+=2){
    	$link1=substr($link, $i, 2);

        $ran=rand ( 0 , $relocolargo-1 );
    	$res .= $link1 . substr($reloco, $ran, 1);
    }
return $res.$random;

}
function keyneg($respuesta)
{
	$resultado=null;
    $random = substr($respuesta, -1);
    $respuesta = substr($respuesta, 0, -1);

    for($i=0, $o=0;$i<strlen($respuesta); $i+=2, $o+=1){
	   $resultado.=substr($respuesta, $i+$o, 2);
	}

	$resultado=$resultado/$random;
	return $resultado;
}
?>