<table class="forumline" width="100%" cellspacing="1" cellpadding="3" border="0">
  <tr><th>{TITLE}</th></tr>
  <tr>
    <td>
<!-- BEGIN pagination -->
    <div class="nav" style="float: right;text-align: right; padding: 10px; margin: 10px 0 10px 20px; clear: both;">
      {pagination.PAGINATION}
    </div>
<!-- END pagination -->
    <div class="nav" style=" padding: 0; margin: 10px 0;">
    <a href="{INDEX_FILE}" alt="Index">{L_INDEX}</a> |
    <a href="{INDEX_FILE}?news=categories" alt="Index">{L_CATEGORIES}</a> |
    <a href="{INDEX_FILE}?news=archives" alt="Index">{L_ARCHIVES}</a>
    </div>

<!-- BEGIN categories -->
    <div style="border: #ddd solid 1px; float: left; padding: 10px; margin: 10px;">
    <a href="{INDEX_FILE}?cat_id={categories.ID}"><img style="border: 0" src="{categories.IMAGE}" alt="{articles.TITLE}" /></a>
    </div>
<!-- END categories -->
<!-- BEGIN arch -->
    <ul style=" padding: 0 1.3em; margin: 10px 0;">
    <!-- BEGIN year -->
      <li class="gen"><a href="{INDEX_FILE}?news=archives&amp;year={arch.year.YEAR}">{arch.year.YEAR}</a></li>
      <!-- BEGIN month -->
      <li class="gen" style="margin-left: 1em;"> <a href="{INDEX_FILE}?news=archives&amp;year={arch.year.YEAR}&amp;month={arch.year.month.MONTH}">{arch.year.month.L_MONTH} {arch.year.month.POST_COUNT} </a></li>
      <!-- BEGIN day -->
      <li class="gen" style="margin-left: 2em;"> <a href="{INDEX_FILE}?news=archives&amp;year={arch.year.YEAR}&amp;month={arch.year.month.MONTH}&amp;day={arch.year.month.day.DAY}">{arch.year.month.day.L_DAY} {arch.year.month.day.POST_COUNT}</a></li>
      <!-- END day -->
      <!-- END month -->
    <!-- END year -->
    </ul>
<!-- END arch -->
<!-- BEGIN articles -->
  <div style="border: #ddd solid 1px; padding: 10px; margin-bottom: 10px; clear: both;">
    <div style="float: right; padding: 5px; margin: 5px;">
    <a href="{INDEX_FILE}?cat_id={articles.CAT_ID}"><img src="{articles.CAT_IMG}" alt="{articles.CATEGORY}" style="border: 0" /></a>
    </div>
    <div class="topictitle"><a href="{INDEX_FILE}?topic_id={articles.ID}">{articles.L_TITLE}</a></div>
    <div class="postdetails">{articles.POST_DATE} by {articles.L_POSTER} | <a href="{articles.U_COMMENTS}">{articles.L_COMMENTS}</a></div>
    <hr />
    <div class="postbody">
    {articles.BODY}{articles.ATTACHMENTS} {articles.READ_MORE_LINK}
    </div>
    <div style="clear:both; height: 0; margin:0; padding: 0;">&nbsp;</div>
  </div>
<!-- END articles -->
<!-- BEGIN comments -->
  <hr />
  <div style="border: #ddd solid 1px; padding: 10px; margin: 10px 0 10px 20px; clear: both;">
    <div class="topictitle">{comments.L_TITLE}</div>
    <div class="postdetails">{comments.POST_DATE} by {comments.L_POSTER}</div>
    <hr />
    <div class="postbody">
    {comments.BODY}
    </div>
  </div>
<!-- END comments -->
<!-- BEGIN pagination -->
  <hr />
  <div class="nav" style="text-align: right; padding: 10px; margin: 10px 0 10px 20px; clear: both;">
    {pagination.PAGINATION}
  </div>
<!-- END pagination -->
    </td>
  </tr>
</table>
