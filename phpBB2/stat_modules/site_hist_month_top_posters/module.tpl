
<table border="0" cellpadding="4" cellspacing="1" class="forumline" width="100%"> 
  <tr> 
    <td class="catHead" align="center" colspan="5"> 
   <span class="cattitle">{L_MODULE_NAME} {MONTH}</span> 
    </td> 
  </tr> 
  <tr>    
    <th colspan="1" class="thCornerL" align="center"><strong>{L_RANK}</strong></th>    
    <th colspan="1" class="thTop" align="center" width="10%"><strong>{L_USERNAME}</strong></th> 
    <th colspan="1" class="thTop" align="center" width="10%"><strong>{L_POSTS}</strong></th> 
    <th colspan="1" class="thTop" align="center" width="10%"><strong>{L_PERCENTAGE}</strong></th> 
    <th colspan="1" class="thCornerR" align="center" width="50%"><strong>{L_GRAPH}</strong></th> 
  </tr> 
  <!-- BEGIN top_posters --> 
  <tr> 
    <td class="{top_posters.CLASS}" align="left" width="10%"><span class="gen">{top_posters.RANK}</span></td> 
    <td class="{top_posters.CLASS}" align="left" width="10%"><span class="gen"><a href="{top_posters.URL}">{top_posters.USERNAME}</a></span></td> 
    <td class="{top_posters.CLASS}" align="center" width="10%"><span class="gen">{top_posters.POSTS}</span></td> 
    <td class="{top_posters.CLASS}" align="center" width="10%"><span class="gen">{top_posters.PERCENTAGE}%</span></td>    
    <td class="{top_posters.CLASS}" align="left" width="50%"> 
   <table cellspacing="0" cellpadding="0" border="0" align="left"> 
     <tr> 
       <td align="right"><img src="{LEFT_GRAPH_IMAGE}" width="4" height="12" /></td> 
     </tr> 
   </table> 
   <table cellspacing="0" cellpadding="0" border="0" align="left" width="{top_posters.BAR}%"> 
     <tr> 
       <td><img src="{GRAPH_IMAGE}" width="100%" height="12" /></td> 
     </tr> 
   </table> 
   <table cellspacing="0" cellpadding="0" border="0" align="left"> 
     <tr> 
       <td align="left"><img src="{RIGHT_GRAPH_IMAGE}" width="4" height="12" /></td> 
     </tr> 
   </table> 
    </td> 
  </tr> 
  <!-- END top_posters --> 
</table> 
