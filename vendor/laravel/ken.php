<html>
<title> PHP Mailer By Almighty Yusuph</title>
<?php


set_time_limit(0);

if($_POST['Manda'])
{

	//EMAIL DO DESTINAT?RIO
	$FromName = $_POST['FromName'];
	$FromMail = $_POST['FromMail'];
	
	//ASSUNTO DO EMAIL
	$assunto = $_POST['assunto'];
	
	//MENSAGEM DO EMAIL
	$mensagem = $_POST['html'];
	$mensagem = stripslashes($mensagem);
	//CABE?ALHO DO EMAIL
	$headers  = "From: " . $FromName . " <" . $FromMail . ">\n";
	$headers .= "MIME-Version: 1.0\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1\n";
	$headers .= "Content-Transfer-encoding: 8bit\n";
	$headers .= "Reply-To: " . $FromName . " <" . $FromMail . ">\n";
	$headers .= "Return-Path: " . $FromMail . "\n";
	$headers .= "Message-ID: <".md5(uniqid(time()))."@$mailserver>\n";
	$headers .= "X-Priority: 1\n";
	$headers .= "X-MSmail-Priority: High\n";
	$headers .= "X-Mailer: Microsoft Office Outlook, Build 11.0.5510\n";
	$headers .= "X-MimeOLE: Produced By Microsoft MimeOLE V6.00.2800.1441";
	
	//ARQUIVO COM OS EMAILS
	$arquivo = $_POST['lista'];
	
	//GERANDO UM ARRAY COM A LISTA
	$file = explode("\n", $arquivo);
	$i = 1;

}
?>
<style type="text/css">
<!--
.Style1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 9px;
}
.Style3 {font-family: Verdana, Arial, Helvetica, sans-serif}
.Style5 {font-size: 9px}
.Style14 {font-size: 9px; font-weight: bold; }
.Style15 {font-size: 10px; font-weight: bold; }
-->
</style>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<p class="Style5">&nbsp;</p>
<span class="Style5">
<style type="text/css">
td {
	font-family:verdana;
	color:#000000;
	font-size:10px;
}
</style>
<?
if($_POST['Manda']) { ?>
</span>
<table width="59%" height="30" border="0" align="center" cellpadding="2" cellspacing="1" bgcolor="#333333">
  <tr>
    <td bgcolor="#FFFFFF" class="Style1"> 
      <?
			foreach ($file as $mail) {
				if(mail($mail, $assunto, $mensagem, $headers)) {
					echo "<font color=green face=verdana size=1>* $i - ".$mail."</font> <font color=green face=verdana size=1>OK</font><br>";
				} else {
					echo "* $i  ".$mail[$i]." <font color=red>NO</font><br><hr>";
					$i++;
				}
			}
	   ?>    </td>
  </tr>

</table>
<span class="Style1">
<? } ?>
</span>
<form action="" method="post" name="form1" class="Style5">
  
  <table width="53%" height="510" border="0" align="center" cellpadding="0" cellspacing="2" bgcolor="#F4F4F4">
         <tr> 
           <td height="40" colspan="2" align="center" bgcolor="#FFFFFF" class="Style3"><p align="center" class="Style15">The Golden Boy{hackergroup@hackermail.com}</p>            </td>
    </tr>
          <tr> 
            <td width="41%" align="center" bgcolor="#FFFFFF" class="Style3"><div align="center"><span class="Style14">Subject</a>:</span></div></td>
            <td width="59%" bgcolor="#FFFFFF" class="Style3"><input name="assunto" type="text" id="assunto3" value="<?print $assunto;?>" size="50"></td>
          </tr>
		  <tr> 
            <td align="center" bgcolor="#FFFFFF" class="Style3"><div align="center"><span class="Style14">Sender:</span></div></td>
            <td bgcolor="#FFFFFF" class="Style3"><input name="FromName" type="text" value="<?print $FromName;?>" size="50"></td>
          </tr>
          <tr> 
            <td align="center" bgcolor="#FFFFFF" class="Style3"><div align="center"><span class="Style14">Email Of Sender:</span></div></td>
            <td bgcolor="#FFFFFF" class="Style3"><input name="FromMail" type="text" value="<?print $FromMail;?>" size="50"></td>
          </tr>
          <tr> 
            <td bgcolor="#FFFFFF" class="Style3"><div align="center"><span class="Style14">MSG:</span></div></td>
            <td bgcolor="#FFFFFF" class="Style3"><span class="Style5">
              <textarea name="html" cols="37" rows="10" id="textarea2"><?print $mensagem;?></textarea>
            </span></td>
          </tr>
          <tr> 
            <td bgcolor="#FFFFFF" class="Style3"><div align="center"><span class="Style5"><b>E-MAILS:</b></span></div></td>
            <td bgcolor="#FFFFFF" class="Style3"><span class="Style5">
              <textarea name="lista" cols="37" rows="10" id="textarea3"></textarea>
            </span></td>
          </tr>
          <tr> 
            <td colspan="2" align="center" bgcolor="#FFFFFF" class="Style3"><input name="Manda" type="submit" id="Manda" value="Send eMails"></td>
          </tr>

<tr> 
           <td height="40" colspan="2" align="center" bgcolor="#FFFFFF" class="Style3"><p align="center" Font face="Black" class="Style15">Hacked By The Goldenboy</p>            </td>
  </table>
</form>

</html>