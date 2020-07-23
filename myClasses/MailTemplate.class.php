<?php 
namespace myClasses;
include 'myClasses/Mail.class.php';

/**
 * Undocumented class
 */
class MailTemplate extends Mail{
    /**
     * Undocumented function
     *
     * @param string $to - Empfänger-Email-Adresse
     * @param string $hashed_email - der email-spezifische Hash-Code zur Identifikation der betr. Person.
     */

    public $link;
    public $image;
    public $html;

    public function __construct(string $to, string $hashed_email){
        
        //auch wenn ev. im Konstruktor von Email nix passiert... (vielleicht ja später...)
        parent::__construct();

        //$link = $_SERVER('HOST_NAME') . "/leaflet2020/$hashed_email";
        $this->link = 'http://' . $_SERVER['SERVER_NAME'] . '/leaflet2020/confirm.php?hsh=' . $hashed_email;

        $this->set_bodyText('Ihre email-Adresse wurde in eines unserer Formulare auf ' . $_SERVER['SERVER_NAME'] . ' eingegeben.' . "\n" . 
        'Um die Richtigkeit dieser Angabe zu bestätigen, klicken Sie bitte folgenden Link an:' . "\n" . $this->link . "\n" . 'Oder kopieren Sie den Link in die Adresszeile ihres Browsers.' . 
        'Ihr Beitrag erscheint anschließend auf unserer Karte!' . "\n" .
        'Vielen Dank für Ihren Beitrag!');

        $this->set_to($to);

        $this->set_from('christian.schaefer@vcoe.at');

        $this->set_subject('Bestätigungslink VCÖ-Karten-Tool');

        $image = '';

        $html = <<<HEREDOC
<!DOCTYPE HTML><html lang="de"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"><meta http-equiv="Content-Language" content="de-at">

<meta http-equiv="expires" content="0">
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="x-ua-compatible" content="IE=edge">

<style>
body {
width: 100%;
font-family: "Verdana", sans-serif;
background-color: #ededed;
margin: 0;
padding: 0;
}

a, a:link, a:visited {
color: #155B80;
text-decoration: underline;
}

@media only screen and (max-width: 500px) {
.fullWidth {
display: block !important;
width: auto !important;
float: none;
}

.fullWidthImg {
width: 100% !important;
float: none;
text-align: center;
}

.fullWidthImg img {
width: auto !important;
}

.logo {
width: 100%;
}
}

@media only screen and (max-width: 820px) {
#wrapper {
width: 100% !important;
}
}

.fullWidth a {
color: #155b80 !important;
}

.footer a {
color: #ffffff !important;
}
</style>
<title>Newsletter</title>
</head>
<body>

<table bgcolor="#ededed" border="0" cellpadding="0" cellspacing="0" style="background: #ededed;" width="100%">
<tbody>
<tr>
<td style="font-family: Verdana, sans-serif; font-size: 14px; line-height: 24px;">
<table align="center" border="0" cellpadding="0" cellspacing="0" id="wrapper" width="700">
<tbody>
<tr>
<td align="left" class="left" style="font-family: Verdana, sans-serif; font-size: 14px; line-height: 24px; padding: 12px 15px; background: #3188b6;" valign="middle"><img alt="VCÖ-Mobilität mit Zukunft" id="logo" src="$image" style="max-width: 243px; width: 100%; min-width: 150px;" width="243"></td>
</tr>

<tr>
<td bgcolor="#ffffff" style="width: 100% !important; font-family: Verdana, sans-serif; font-size: 14px; line-height: 24px; background: #ffffff;" valign="top" width="100%">
<table align="center" bgcolor="white" border="0" cellpadding="0" cellspacing="0" class="main" style="background: white; padding-bottom: 24px;" width="100%">
<tbody>
<tr>
<td align="left" class="welcome" style="color: #000000; font-family: Verdana, sans-serif; font-size: 14px; line-height: 24px; padding: 12px 15px;" valign="middle">
<h1 style="font-size: 21px; font-weight: normal; color: #2d7ca6; margin: 12px 0;">
Nur noch ein Klick und Ihr Beitrag ist veröffentlicht!</h1>

<p>Danke für Ihren Beitrag zum VCÖ-Check &quot;Hindernisse für Bewegungsaktive Mobilität&quot;.</p>

<p>Bitte bestätigen Sie mit einem Klick auf den folgenden Link Ihre E-Mail-Adresse</p>

<p><a>$this->link</a></p>

<p>Ihr Beitrag wird gleich anschließend veröffentlicht und ist für alle anderen sichtbar.</p>

<p>Der VCÖ prüft alle neuen Einträge in regelmäßigen Abständen und löscht Einträge, die Anstandsregeln verletzen oder keinen sinnvollen Beitrag leisten.</p>

<p>Falls Sie Ihrem Beitrag&nbsp;ein Foto hinzugefügt haben, erklären Sie mit der Bestätigung Ihrer E-Mail-Adresse, dass Sie damit keine Urheber- oder Persönlichkeitsrechte verletzen.</p>

<p>Für Fragen zu Ihrem Eintrag und zum VCÖ-Check allgemein steht Ihnen das VCÖ-Team unter vcoe@vcoe.at gerne zur Verfügung.</p>

<p>Herzlichen Dank für Ihren Beitrag und herzliche Grüße!</p>

<p>Christoh Hörhan<br>
Für das VCÖ-Team</p>

<p>VCÖ - Mobilität mit Zukunft<br>
Bräuhausgasse 7-9<br>
1050 Wien<br>
ZVR-Zahl: 674059554<br>
Tel.: &#43;43-(0)1-893 26 97<br>
E-Mail: vcoe@vcoe.at<br>
www.vcoe.at</p>

<p>Unter www.vcoe.at/zusendungen erfahren Sie, warum Sie diese Nachricht erreicht hat. Die ausführliche Datenschutzerklärung des VCÖ finden Sie auf www.vcoe.at/datenschutz.</p>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td bgcolor="#42809d" style="font-family: Verdana, sans-serif; font-size: 14px; line-height: 24px; background: #42809d;" valign="top" width="100%">                

</td>
</tr>

</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</body>
</html>
HEREDOC;

        $this->set_bodyHTML($html);

    }
}
?>
