//
// Edited by *Speedy* www.rwtools.de for www.phpbb2.de
//
// added:   * Workaround for Opera, Netscape and Firefox (Mozilla)
//      * Fallback alternates, if any of Code in Browser are not understand
//      * Marked Text will automatic added to the prompt. Only in any prompts
//
// tested:   * Opera 7.54 - is the hardest Browser... the most works not currently!
//      * Netscape - the most works now
//      * Internet-Explorer 6 - all Code works
//      * Firefox 1.0 - the most Code works
//
//

var theSelection = false;

var clientPC = navigator.userAgent.toLowerCase();
var clientVer = parseInt(navigator.appVersion);

var is_ie = ((clientPC.indexOf("msie") != -1) && (clientPC.indexOf("opera") == -1));
var is_nav  = ((clientPC.indexOf('mozilla')!=-1) && (clientPC.indexOf('spoofer')==-1)
                && (clientPC.indexOf('compatible') == -1) && (clientPC.indexOf('opera')==-1)
                && (clientPC.indexOf('webtv')==-1) && (clientPC.indexOf('hotjava')==-1));

var is_win   = ((clientPC.indexOf("win")!=-1) || (clientPC.indexOf("16bit") != -1));
var is_mac    = (clientPC.indexOf("mac")!=-1);

b_help = "Bold: [B]text[/B]";
i_help = "Italic: [I]text[/I]";
u_help = "Under Line: [U]text[/U]";
quote_help = "Quote: [quote]text[/quote]";
code_help = "Code: [code]code[/code]";
img_help = "Insert Image: [img]http://image path[/img]";
url_help = "Insert URL: [url]http://Site URL[/url] or [url=http://Site URL]Site Name[/url]";
fc_help = "Font Color: [color=red]text[/color] You can use HTML color=#FF0000";
fs_help = "Font Size: [size=9]Very Small[/size]";
ft_help = "Font type: [font=Andalus]text[/font]";
rtl_help = "Make message box align from Right to Left";
ltr_help = "Make message box align from Left to Right";
mail_help = "Insert Email: [email]Email Here[/email]";
grad_help="Insert gradient text";
right_help="set text align to right: [align=right]text[/align]";
left_help="set text align to left: [align=left]text[/align]";
center_help="set text align to center: [align=center]text[/align]";
justify_help="justify text: [align=justify]text[/align]";
marqr_help="Marque text to Right: [marq=right]text[/marq]";
marql_help="Marque text to Left: [marq=left]text[/marq]";
marqu_help="Marque text to up: [marq=up]text[/marq]";
marqd_help="Marque text to down: [marq=down]text[/marq]";
stream_help="Insert stream file: [stream]File URL[/stream]";
ram_help="Insert Real Media file: [ram]File URL[/ram]";
plain_help="Remove bbcodes from the selected text";
hr_help="Insert H-Line [hr]";
video_help="Insert video file: [video width=# height=#]file URL[/video]";
flash_help="Insert flash file: [flash width=# height=#]flash URL[/flash]";
fade_help = "Fade text: [fade]text[/fade]";
php_help = "PHP Code: [php]phpcode[/php]";
glow_help = "Glowing Text: [glow=color]Text[/glow]";
shadow_help = "Shadowed Text: [shadow=color]Text[/shadow]";
smile_help = "Smilie Creator: [schild=1]Text[/schild] Generates a Shield Smilie";
highlight_help = "Highlighted text: [highlight=color]text[/highlight]";
s_help = "Strikethrough: [s]text[/s]";
google_help = "Google: [google]String to search for[/google]";
imgl_help = "Left Image Tag [left]Image to align left[/left]";
imgr_help = "Right Image Tag [right]Image to align right[/right]";

var Quote = 0;
var Bold  = 0;
var Italic = 0;
var Underline = 0;
var Code = 0;
var flash = 0;
var fc = 0;
var fs = 0;
var ft = 0;
var center = 0;
var right = 0;
var left = 0;
var justify = 0;
var fade = 0;
var marqd = 0;
var marqu = 0;
var marql = 0;
var marqr = 0;
var mail = 0;
var video = 0;
var stream = 0;
var ram = 0;
var hr = 0;
var grad = 0;
var plain = 0;
var PHP = 0;
var Glow = 0;
var Shadow = 0;
var Smile = 0;
var Highlight = 0;
var Strik = 0;
var Google = 0;
var imgl = 0;
var imgr = 0;


function BBCplain() {
   var txtarea = document.post.message;
   theSelection = getSelectedText(txtarea);
       if (theSelection != '') {
          temp = theSelection;
           temp = temp.replace(/\[FLASH=([^\]]*)\]WIDTH=[0-9]{0,4} HEIGHT=[0-9]{0,4}\[\/FLASH\]/gi,"$1");
           temp = temp.replace(/\[VIDEO=([^\]]*)\]WIDTH=[0-9]{0,4} HEIGHT=[0-9]{0,4}\[\/VIDEO\]/gi,"$1");
        replaceAll(temp.replace(/\[[^\]]*\]/gi,""));
   }
}

function BBCgrad() {
   //i dont know how the oSelectRange does works in grad.htm
   //added only a message does this only works with IE
   if(is_ie && clientVer >= 4)
   {
      var oSelect,oSelectRange;
      document.post.message.focus();
      oSelect = document.selection;
          oSelectRange = oSelect.createRange();
         if (oSelectRange.text.length < 1)
         {
             alert("Please select the text first");
         return;
      }
          if (oSelectRange.text.length > 120)
          {   
               alert("This only works for less than 120 letters");
               return;
          }
             showModalDialog("bbcode_box/grad.htm",oSelectRange,"help:no; center:yes; status:no; dialogHeight:50px; dialogWidth:50px");
       }
       else
       {
          alert("Works only with Internet-Explorer 4 or higher");
       }
}

function BBChr() {
   document.post.message.value+="[hr]";
   document.post.message.focus();
}

function BBCram() {
        var FoundErrors = '';
        var enterURL   = prompt("Please write real media file URL","http://");
        if (!enterURL) {
                FoundErrors += "You didn't write the file URL";
        }
        if (FoundErrors) {
                alert("Error :"+FoundErrors);
                return;
        }
        var ToAdd = "[ram]"+enterURL+"[/ram]";
        document.post.message.value+=ToAdd;
        document.post.message.focus();
}

function BBCstream() {
        var FoundErrors = '';
        var enterURL   = prompt("Please write stream file URL","http://");
        if (!enterURL) {
                FoundErrors += "You didn't write the file URL";
        }
        if (FoundErrors) {
                alert("Error :"+FoundErrors);
                return;
        }
        var ToAdd = "[stream]"+enterURL+"[/stream]";
        document.post.message.value+=ToAdd;
        document.post.message.focus();
}

function BBCvideo() {
   var FoundErrors = '';
   var enterFURL   = prompt("Please Enter the video file URL", "http://");
   if (!enterFURL)    {
      FoundErrors += "You didn't write the file URL";
   }
      var enterW   = prompt("Enter the video file width", "400");
   if (!enterW)    {
      FoundErrors += "You didn't enter the video file width";
   }
   var enterH   = prompt("Enter the video file height", "350");
   if (!enterH)    {
      FoundErrors += "You didn't enter the video file height";
   }
   if (FoundErrors)  {
      alert("Error :"+FoundErrors);
      return;
   }
   var ToAdd = "[video width="+enterW+" height="+enterH+"]"+enterFURL+"[/video]";
   document.post.message.value+=ToAdd;
   document.post.message.focus();
}

function BBCmail() {
   var txtarea = document.post.message;
        var FoundErrors = '';
        var entermail   = prompt("Enter the Email Address", getSelectedText(txtarea));
        if (!entermail) {
                FoundErrors += "You didn't write the Email Address";
        }
        if (FoundErrors) {
                alert("Error :"+FoundErrors);
                return;
        }
        if(getSelectedText(txtarea).length > 0 && getSelectedText(txtarea) == entermail)
        {
           mozWrap(txtarea, "[email]", "[/email]");
           document.post.message.focus();
           return;
        }
        var ToAdd = "[email]"+entermail+"[/email]";
        document.post.message.value+=ToAdd;
        document.post.message.focus();
}

function BBCmarqu() {
   var txtarea = document.post.message;
   if ((clientVer >= 4) && is_ie && is_win) {
      theSelection = document.selection.createRange().text;
      if (theSelection != '') {
      document.selection.createRange().text = "[marq=up]" + theSelection + "[/marq]";
      document.post.message.focus();
      return;
      }
   }
   else
   {
      if(getSelectedText(txtarea).length > 0)
      {
         mozWrap(txtarea, "[marq=up]", "[/marq]");
         document.post.message.focus();
         return;
      }
   }
   if (marqu == 0) {
      ToAdd = "[marq=up]";
      document.post.marqu.src = "bbcode_box/images/marqu1.gif";
      marqu = 1;
   } else {
      ToAdd = "[/marq]";
      document.post.marqu.src = "bbcode_box/images/marqu.gif";
      marqu = 0;
   }
   PostWrite(ToAdd);
}

function BBCmarql() {
   if ((clientVer >= 4) && is_ie && is_win) {
      theSelection = document.selection.createRange().text;
      if (theSelection != '') {
      document.selection.createRange().text = "[marq=left]" + theSelection + "[/marq]";
      document.post.message.focus();
      return;
      }
   }
   else
   {
      var txtarea = document.post.message;
      if(getSelectedText(txtarea).length > 0)
      {
         mozWrap(txtarea, "[marq=left]", "[/marq]");
         document.post.message.focus();
         return;
      }
   }
   if (marql == 0) {
      ToAdd = "[marq=left]";
      document.post.marql.src = "bbcode_box/images/marql1.gif";
      marql = 1;
   } else {
      ToAdd = "[/marq]";
      document.post.marql.src = "bbcode_box/images/marql.gif";
      marql = 0;
   }
   PostWrite(ToAdd);
}

function BBCmarqr() {
   if ((clientVer >= 4) && is_ie && is_win) {
      theSelection = document.selection.createRange().text;
      if (theSelection != '') {
      document.selection.createRange().text = "[marq=right]" + theSelection + "[/marq]";
      document.post.message.focus();
      return;
      }
   }
   else
   {
      var txtarea = document.post.message;
      if(getSelectedText(txtarea).length > 0)
      {
         mozWrap(txtarea, "[marq=right]", "[/marq]");
         document.post.message.focus();
         return;
      }
   }
   if (marqr == 0) {
      ToAdd = "[marq=right]";
      document.post.marqr.src = "bbcode_box/images/marqr1.gif";
      marqr = 1;
   } else {
      ToAdd = "[/marq]";
      document.post.marqr.src = "bbcode_box/images/marqr.gif";
      marqr = 0;
   }
   PostWrite(ToAdd);
}

function BBCdir(dirc) {
       document.post.message.dir=(dirc);
}

function BBCfade() {
   if ((clientVer >= 4) && is_ie && is_win) {
      theSelection = document.selection.createRange().text;
      if (theSelection != '') {
      document.selection.createRange().text = "[fade]" + theSelection + "[/fade]";
      document.post.message.focus();
      return;
      }
   }
   else
   {
      var txtarea = document.post.message;
      if(getSelectedText(txtarea).length > 0)
      {
         mozWrap(txtarea, "[fade]", "[/fade]");
         document.post.message.focus();
         return;
      }
   }
   if (fade == 0) {
      ToAdd = "[fade]";
      document.post.fade.src = "bbcode_box/images/fade1.gif";
      fade = 1;
   } else {
      ToAdd = "[/fade]";
      document.post.fade.src = "bbcode_box/images/fade.gif";
      fade = 0;
   }
   PostWrite(ToAdd);
}

function BBCjustify() {
   if ((clientVer >= 4) && is_ie && is_win) {
      theSelection = document.selection.createRange().text;
      if (theSelection != '') {
      document.selection.createRange().text = "[align=justify]" + theSelection + "[/align]";
      document.post.message.focus();
      return;
      }
   }
   else
   {
      var txtarea = document.post.message;
      if(getSelectedText(txtarea).length > 0)
      {
         mozWrap(txtarea, "[align=justify]", "[/align]");
         document.post.message.focus();
         return;
      }
   }
   if (justify == 0) {
      ToAdd = "[align=justify]";
      document.post.justify.src = "bbcode_box/images/justify1.gif";
      justify = 1;
   } else {
      ToAdd = "[/align]";
      document.post.justify.src = "bbcode_box/images/justify.gif";
      justify = 0;
   }
   PostWrite(ToAdd);
}

function BBCleft() {
   if ((clientVer >= 4) && is_ie && is_win) {
      theSelection = document.selection.createRange().text;
      if (theSelection != '') {
      document.selection.createRange().text = "[align=left]" + theSelection + "[/align]";
      document.post.message.focus();
      return;
      }
   }
   else
   {
      var txtarea = document.post.message;
      if(getSelectedText(txtarea).length > 0)
      {
         mozWrap(txtarea, "[align=left]", "[/align]");
         document.post.message.focus();
         return;
      }
   }
   if (left == 0) {
      ToAdd = "[align=left]";
      document.post.left.src = "bbcode_box/images/left1.gif";
      left = 1;
   } else {
      ToAdd = "[/align]";
      document.post.left.src = "bbcode_box/images/left.gif";
      left = 0;
   }
   PostWrite(ToAdd);
}

function BBCright() {
   if ((clientVer >= 4) && is_ie && is_win) {
      theSelection = document.selection.createRange().text;
      if (theSelection != '') {
      document.selection.createRange().text = "[align=right]" + theSelection + "[/align]";
      document.post.message.focus();
      return;
      }
   }
   else
   {
      var txtarea = document.post.message;
      if(getSelectedText(txtarea).length > 0)
      {
         mozWrap(txtarea, "[align=right]", "[/align]");
         document.post.message.focus();
         return;
      }
   }
   if (right == 0) {
      ToAdd = "[align=right]";
      document.post.right.src = "bbcode_box/images/right1.gif";
      right = 1;
   } else {
      ToAdd = "[/align]";
      document.post.right.src = "bbcode_box/images/right.gif";
      right = 0;
   }
   PostWrite(ToAdd);
}

function BBCcenter() {
   if ((clientVer >= 4) && is_ie && is_win) {
      theSelection = document.selection.createRange().text;
      if (theSelection != '') {
      document.selection.createRange().text = "[align=center]" + theSelection + "[/align]";
      document.post.message.focus();
      return;
      }
   }
   else
   {
      var txtarea = document.post.message;
      if(getSelectedText(txtarea).length > 0)
      {
         mozWrap(txtarea, "[align=center]", "[/align]");
         document.post.message.focus();
         return;
      }
   }
   if (center == 0) {
      ToAdd = "[align=center]";
      document.post.center.src = "bbcode_box/images/center1.gif";
      center = 1;
   } else {
      ToAdd = "[/align]";
      document.post.center.src = "bbcode_box/images/center.gif";
      center = 0;
   }
   PostWrite(ToAdd);
}

function BBCft() {
   if ((clientVer >= 4) && is_ie && is_win) {
      theSelection = document.selection.createRange().text;
      if (theSelection != '') {
      document.selection.createRange().text = "[font="+document.post.ft.value+"]" + theSelection + "[/font]";
      document.post.message.focus();
      return;
      }
   }
   else
   {
      var txtarea = document.post.message;
      if(getSelectedText(txtarea).length > 0)
      {
         mozWrap(txtarea, "[font="+document.post.ft.value+"]", "[/font]");
         document.post.message.focus();
         return;
      }
   }
   ToAdd = "[font="+document.post.ft.value+"]"+" "+"[/font]";
   PostWrite(ToAdd);
}

function BBCfs() {
   if ((clientVer >= 4) && is_ie && is_win) {
      theSelection = document.selection.createRange().text;
      if (theSelection != '') {
      document.selection.createRange().text = "[size="+document.post.fs.value+"]" + theSelection + "[/size]";
      document.post.message.focus();
      return;
      }
   }
   else
   {
      var txtarea = document.post.message;
      if(getSelectedText(txtarea).length > 0)
      {
         mozWrap(txtarea, "[size="+document.post.fs.value+"]", "[/size]");
         document.post.message.focus();
         return;
      }
   }
   ToAdd = "[size="+document.post.fs.value+"]"+" "+"[/size]";
   PostWrite(ToAdd);
}

function BBCfc() {
   if ((clientVer >= 4) && is_ie && is_win) {
      theSelection = document.selection.createRange().text;
      if (theSelection != '') {
      document.selection.createRange().text = "[color="+document.post.fc.value+"]" + theSelection + "[/color]";
      document.post.message.focus();
      return;
      }
   }
   else
   {
      var txtarea = document.post.message;
      if(getSelectedText(txtarea).length > 0)
      {
         mozWrap(txtarea, "[color="+document.post.fc.value+"]", "[/color]");
         document.post.message.focus();
         return;
      }
   }
   ToAdd = "[color="+document.post.fc.value+"]"+" "+"[/color]";
   PostWrite(ToAdd);
}

function BBCmarqd() {
   if ((clientVer >= 4) && is_ie && is_win) {
      theSelection = document.selection.createRange().text;
      if (theSelection != '') {
      document.selection.createRange().text = "[marq=down]" + theSelection + "[/marq]";
      document.post.message.focus();
      return;
      }
   }
   else
   {
      var txtarea = document.post.message;
      if(getSelectedText(txtarea).length > 0)
      {
         mozWrap(txtarea, "[marq=down]", "[/marq]");
         document.post.message.focus();
         return;
      }
   }
   if (marqd == 0) {
      ToAdd = "[marq=down]";
      document.post.marqd.src = "bbcode_box/images/marqd1.gif";
      marqd = 1;
   } else {
      ToAdd = "[/marq]";
      document.post.marqd.src = "bbcode_box/images/marqd.gif";
      marqd = 0;
   }
   PostWrite(ToAdd);
}

function BBCflash() {
   var FoundErrors = '';
   var enterFURL   = prompt("Enter the flash file URL", "http://");
   if (!enterFURL)    {
      FoundErrors += "You didn't write the flash file URL";
   }
      var enterW   = prompt("Enter the flash width", "250");
   if (!enterW)    {
      FoundErrors += "You didn't write the flash width";
   }
   var enterH   = prompt("Enter the flash height", "250");
   if (!enterH)    {
      FoundErrors += "You didn't write the flash height";
   }
   if (FoundErrors)  {
      alert("Error :"+FoundErrors);
      return;
   }
   var ToAdd = "[flash width="+enterW+" height="+enterH+"]"+enterFURL+"[/flash]";
   document.post.message.value+=ToAdd;
   document.post.message.focus();
}

function emoticon(text) {
   text = ' ' + text + ' ';
   PostWrite(text);
}

function bbfontstyle(bbopen, bbclose) {
   if ((clientVer >= 4) && is_ie && is_win) {
      theSelection = document.selection.createRange().text;
      if (!theSelection) {
         document.post.message.value += bbopen + bbclose;
         document.post.message.focus();
         return;
      }
      document.selection.createRange().text = bbopen + theSelection + bbclose;
      document.post.message.focus();
      return;
   }
   else
   {
      var txtarea = document.post.message;
      if(getSelectedText(txtarea).length > 0)
      {
         mozWrap(txtarea, bbopen, bbclose);
         document.post.message.focus();
         return;
      }
      else
      {
         var ToAdd = bbopen+bbclose;
         document.post.message.value+=ToAdd;
         document.post.message.focus();
      }
   }

   storeCaret(document.post.message);
}

function BBCcode() {
   if ((clientVer >= 4) && is_ie && is_win) {
      theSelection = document.selection.createRange().text;
      if (theSelection != '') {
      document.selection.createRange().text = "[code]" + theSelection + "[/code]";
      document.post.message.focus();
      return;
      }
   }
   else
   {
      var txtarea = document.post.message;
      if(getSelectedText(txtarea).length > 0)
      {
         mozWrap(txtarea, "[code]", "[/code]");
         document.post.message.focus();
         return;
      }
   }
   if (Code == 0) {
      ToAdd = "[code]";
      document.post.code.src = "bbcode_box/images/code1.gif";
      Code = 1;
   } else {
      ToAdd = "[/code]";
      document.post.code.src = "bbcode_box/images/code.gif";
      Code = 0;
   }
   PostWrite(ToAdd);
}

function BBCphp() {
   if ((clientVer >= 4) && is_ie && is_win) {
      theSelection = document.selection.createRange().text;
      if (theSelection != '') {
      document.selection.createRange().text = "[php]" + theSelection + "[/php]";
      document.post.message.focus();
      return;
      }
   }
   else
   {
      var txtarea = document.post.message;
      if(getSelectedText(txtarea).length > 0)
      {
         mozWrap(txtarea, "[php]", "[/php]");
         document.post.message.focus();
         return;
      }
   }
   if (PHP == 0) {
      ToAdd = "[php]";
      document.post.php.src = "bbcode_box/images/phpcode1.gif";
      PHP = 1;
   } else {
      ToAdd = "[/php]";
      document.post.php.src = "bbcode_box/images/phpcode.gif";
      PHP = 0;
   }
   PostWrite(ToAdd);
}

function BBCquote() {
   if ((clientVer >= 4) && is_ie && is_win) {
      theSelection = document.selection.createRange().text;
      if (theSelection != '') {
      document.selection.createRange().text = "[quote]" + theSelection + "[/quote]";
      document.post.message.focus();
      return;
      }
   }
   else
   {
      var txtarea = document.post.message;
      if(getSelectedText(txtarea).length > 0)
      {
         mozWrap(txtarea, "[quote]", "[/quote]");
         document.post.message.focus();
         return;
      }
   }
   if (Quote == 0) {
      ToAdd = "[quote]";
      document.post.quote.src = "bbcode_box/images/quote1.gif";
      Quote = 1;
   } else {
      ToAdd = "[/quote]";
      document.post.quote.src = "bbcode_box/images/quote.gif";
      Quote = 0;
   }
   PostWrite(ToAdd);
}

function BBCbold() {
   if ((clientVer >= 4) && is_ie && is_win) {
      theSelection = document.selection.createRange().text;
      if (theSelection != '') {
      document.selection.createRange().text = "[B]" + theSelection + "[/B]";
      document.post.message.focus();
      return;
      }
   }
   else
   {
      var txtarea = document.post.message;
      if(getSelectedText(txtarea).length > 0)
      {
         mozWrap(txtarea, "[B]", "[/B]");
         document.post.message.focus();
         return;
      }
   }
   if (Bold == 0) {
      ToAdd = "[B]";
      document.post.bold.src = "bbcode_box/images/bold1.gif";
      Bold = 1;
   } else {
      ToAdd = "[/B]";
      document.post.bold.src = "bbcode_box/images/bold.gif";
      Bold = 0;
   }
   PostWrite(ToAdd);
}

function BBCitalic() {
   if ((clientVer >= 4) && is_ie && is_win) {
      theSelection = document.selection.createRange().text;
      if (theSelection != '') {
      document.selection.createRange().text = "[I]" + theSelection + "[/I]";
      document.post.message.focus();
      return;
      }
   }
   else
   {
      var txtarea = document.post.message;
      if(getSelectedText(txtarea).length > 0)
      {
         mozWrap(txtarea, "[I]", "[/I]");
         document.post.message.focus();
         return;
      }
   }
   if (Italic == 0) {
      ToAdd = "[I]";
      document.post.italic.src = "bbcode_box/images/italic1.gif";
      Italic = 1;
   } else {
      ToAdd = "[/I]";
      document.post.italic.src = "bbcode_box/images/italic.gif";
      Italic = 0;
   }
   PostWrite(ToAdd);
}

function BBCunder() {
   if ((clientVer >= 4) && is_ie && is_win) {
      theSelection = document.selection.createRange().text;
      if (theSelection != '') {
      document.selection.createRange().text = "[U]" + theSelection + "[/U]";
      document.post.message.focus();
      return;
      }
   }
   else
   {
      var txtarea = document.post.message;
      if(getSelectedText(txtarea).length > 0)
      {
         mozWrap(txtarea, "[U]", "[/U]");
         document.post.message.focus();
         return;
      }
   }
   if (Underline == 0) {
      ToAdd = "[U]";
      document.post.under.src = "bbcode_box/images/under1.gif";
      Underline = 1;
   } else {
      ToAdd = "[/U]";
      document.post.under.src = "bbcode_box/images/under.gif";
      Underline = 0;
   }
   PostWrite(ToAdd);
}

function BBCstrik() {
   if ((clientVer >= 4) && is_ie && is_win) {
      theSelection = document.selection.createRange().text;
      if (theSelection != '') {
      document.selection.createRange().text = "[s]" + theSelection + "[/s]";
      document.post.message.focus();
      return;
      }
   }
   else
   {
      var txtarea = document.post.message;
      if(getSelectedText(txtarea).length > 0)
      {
         mozWrap(txtarea, "[S]", "[/S]");
         document.post.message.focus();
         return;
      }
   }
   if (Strik == 0) {
      ToAdd = "[s]";
      document.post.strik.src = "bbcode_box/images/strike1.gif";
      Strik = 1;
   } else {
      ToAdd = "[/s]";
      document.post.strik.src = "bbcode_box/images/strike.gif";
      strike = 0;
   }
   PostWrite(ToAdd);
}

function BBCglow() {
   if ((clientVer >= 4) && is_ie && is_win) {
      theSelection = document.selection.createRange().text;
      if (theSelection != '') {
      document.selection.createRange().text = "[glow=red]" + theSelection + "[/glow]";
      document.post.message.focus();
      return;
      }
   }
   else
   {
      var txtarea = document.post.message;
      if(getSelectedText(txtarea).length > 0)
      {
         mozWrap(txtarea, "[glow=red]", "[/glow]");
         document.post.message.focus();
         return;
      }
   }
   if (Glow == 0) {
      ToAdd = "[glow=red]";
      document.post.glow.src = "bbcode_box/images/glow1.gif";
      Glow = 1;
   } else {
      ToAdd = "[/glow]";
      document.post.glow.src = "bbcode_box/images/glow.gif";
      Glow = 0;
   }
   PostWrite(ToAdd);
}

function BBCshadow() {
   if ((clientVer >= 4) && is_ie && is_win) {
      theSelection = document.selection.createRange().text;
      if (theSelection != '') {
      document.selection.createRange().text = "[shadow=red]" + theSelection + "[/shadow]";
      document.post.message.focus();
      return;
      }
   }
   else
   {
      var txtarea = document.post.message;
      if(getSelectedText(txtarea).length > 0)
      {
         mozWrap(txtarea, "[shadow=red]", "[/shadow]");
         document.post.message.focus();
         return;
      }
   }
   if (Shadow == 0) {
      ToAdd = "[shadow=red]";
      document.post.shadow.src = "bbcode_box/images/shadow1.gif";
      Shadow = 1;
   } else {
      ToAdd = "[/shadow]";
      document.post.shadow.src = "bbcode_box/images/shadow.gif";
      Shadow = 0;
   }
   PostWrite(ToAdd);
}

function BBChighlight() {
   if ((clientVer >= 4) && is_ie && is_win) {
      theSelection = document.selection.createRange().text;
      if (theSelection != '') {
      document.selection.createRange().text = "[highlight=red]" + theSelection + "[/highlight]";
      document.post.message.focus();
      return;
      }
   }
   else
   {
      var txtarea = document.post.message;
      if(getSelectedText(txtarea).length > 0)
      {
         mozWrap(txtarea, "[highlight=red]", "[/highlight]");
         document.post.message.focus();
         return;
      }
   }
   if (Highlight == 0) {
      ToAdd = "[highlight=red]";
      document.post.highlight.src = "bbcode_box/images/highl1.gif";
      Highlight = 1;
   } else {
      ToAdd = "[/highlight]";
      document.post.highlight.src = "bbcode_box/images/highl.gif";
      Highlight = 0;
   }
   PostWrite(ToAdd);
}

function BBCgoogle() {
   if ((clientVer >= 4) && is_ie && is_win) {
      theSelection = document.selection.createRange().text;
      if (theSelection != '') {
      document.selection.createRange().text = "[google]" + theSelection + "[/google]";
      document.post.message.focus();
      return;
      }
   }
   else
   {
      var txtarea = document.post.message;
      if(getSelectedText(txtarea).length > 0)
      {
         mozWrap(txtarea, "[google]", "[/google]");
         document.post.message.focus();
         return;
      }
   }
   if (Google == 0) {
      ToAdd = "[google]";
      document.post.google.src = "bbcode_box/images/google1.gif";
      Google = 1;
   } else {
      ToAdd = "[/google]";
      document.post.google.src = "bbcode_box/images/google.gif";
      Google = 0;
   }
   PostWrite(ToAdd);
}

function BBCurl() {
   var FoundErrors = '';
   var enterURL   = prompt("Enter the URL", "http://");
   var enterTITLE = prompt("Enter the page name", "Web Page Name");
   if (!enterURL)    {
      FoundErrors += "You didn't write the URL";
   }
   if (!enterTITLE)  {
      FoundErrors += "You didn't write the page name";
   }
   if (FoundErrors)  {
      alert("Error :"+FoundErrors);
      return;
   }
   var ToAdd = "[url="+enterURL+"]"+enterTITLE+"[/url]";
   document.post.message.value+=ToAdd;
   document.post.message.focus();
}

function BBCimg() {
   var FoundErrors = '';
   var enterURL   = prompt("Enter the image URL","http://");
   if (!enterURL) {
      FoundErrors += "You didn't write the image URL";
   }
   if (FoundErrors) {
      alert("Error :"+FoundErrors);
      return;
   }
   var ToAdd = "[img]"+enterURL+"[/img]";
   document.post.message.value+=ToAdd;
   document.post.message.focus();
}

function BBCimgl() {
   var FoundErrors = '';
   var enterURL   = prompt("Enter the image URL","http://");
   if (!enterURL) {
      FoundErrors += "You didn't write the image URL";
   }
   if (FoundErrors) {
      alert("Error :"+FoundErrors);
      return;
   }
   var ToAdd = "[left]"+enterURL+"[/left]";
   document.post.message.value+=ToAdd;
   document.post.message.focus();
}

function BBCimgr() {
   var FoundErrors = '';
   var enterURL   = prompt("Enter the image URL","http://");
   if (!enterURL) {
      FoundErrors += "You didn't write the image URL";
   }
   if (FoundErrors) {
      alert("Error :"+FoundErrors);
      return;
   }
   var ToAdd = "[right]"+enterURL+"[/right]";
   document.post.message.value+=ToAdd;
   document.post.message.focus();
}

//____________________ End BBfunctions
//Support functions
function helpline(help) {
   document.post.helpbox.value = eval(help + "_help");
   document.post.helpbox.readOnly = "true";
}

function checkForm() {
   formErrors = false;   
   if (document.post.message.value.length < 2) {
      formErrors = "You must enter a message when posting";
   }
   if (formErrors) {
      alert(formErrors);
      return false;
   } else {
      //formObj.preview.disabled = true;
      //formObj.submit.disabled = true;
      return true;
   }
}

function storeCaret(textEl) {
   if (textEl.createTextRange) textEl.caretPos = document.selection.createRange().duplicate();
}

function PostWrite(text) {
   if (document.post.message.createTextRange && document.post.message.caretPos) {
      var caretPos = document.post.message.caretPos;
      caretPos.text = caretPos.text.charAt(caretPos.text.length - 1) == ' ' ?   text + ' ' : text;
   }
   else document.post.message.value += text;
   document.post.message.focus(caretPos)
}


// From http://www.massless.org/mozedit/
function mozWrap(txtarea, open, close)
{
   if(is_ie)
   {
      theSelection = getSelectedText(txtarea);
      document.selection.createRange().text = open + theSelection + close;
      return;
   }
   else
   {
      if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
      {      
         var selLength = txtarea.textLength;
         var selStart = txtarea.selectionStart;
         var selEnd = txtarea.selectionEnd;
         if (selEnd == 1 || selEnd == 2)
            selEnd = selLength;

         var s1 = (txtarea.value).substring(0,selStart);
         var s2 = (txtarea.value).substring(selStart, selEnd)
         var s3 = (txtarea.value).substring(selEnd, selLength);
         txtarea.value = s1 + open + s2 + close + s3;
         return;
      }
      PostWrite(open+close);
   }
   return;
}

function replaceAll(text)
{
   document.post.message.value = text;
}

function getSelectedText(txtarea)
{
   if ((clientVer >= 4) && is_ie && is_win)
   {
      return document.selection.createRange().text; // Get text selection
   }
   else
   {
      var selLength = txtarea.textLength;
      var selStart = txtarea.selectionStart;
      var selEnd = txtarea.selectionEnd;
      if (selEnd == 1 || selEnd == 2)
         selEnd = selLength;

      var s2 = (txtarea.value).substring(selStart, selEnd);
      return s2;
   }
   return;
}