//**************************************************************************
//                               ajax_core.js
//                            -------------------
//   begin                : Friday, Dec 09, 2005
//   copyright            : (C) 2005 alcaeus
//   email                : mods@alcaeus.org
//
//   $Id: ajax_topicfunctions.js,v 1.5 2006/04/18 20:59:05 alcaeus Exp $
//
//**************************************************************************

//**************************************************************************
//
//   This program is free software; you can redistribute it and/or modify
//   it under the terms of the GNU General Public License as published by
//   the Free Software Foundation; either version 2 of the License, or
//   (at your option) any later version.
//
//**************************************************************************


//
// Edit post subject and topic subject (if necessary - viewtopic.php only)
//
var is_viewtopic = 0;
var is_viewtopic_topictitle = 0;
var highlight = '';

function AJAXTitleEdit(post_id, viewtopic_topictitle)
{
	if (!ajax_core_defined)
	{
		return;
	}
	
	is_viewtopic_topictitle = viewtopic_topictitle;
	
	var topic = getElementById('title_'+post_id);
	var topictitle = getElementById('topictitle_'+post_id);
	var topiclink = getElementById('topiclink_'+post_id);
	if (is_viewtopic_topictitle)
	{
		var top_topiclink = getElementById('topiclink_top');
	}
	
	if ((topictitle == null) || (topiclink == null) || (topic == null))
	{
		if (AJAX_DEBUG_HTML_ERRORS)
		{
			alert('AJAXTitleEdit: some HTML elements could not be found');
		}
		return;
	}
	
	topic.style.display = '';
	topiclink.style.display = 'none';
	
	topictitle.focus();
}

function AJAXEndTitleEdit(post_id)
{
	if (!ajax_core_defined)
	{
		return;
	}
	
	var topictitle = getElementById('topictitle_'+post_id);
	var orig_topictitle = getElementById('orig_topictitle_'+post_id);
	var topiclink = getElementById('topiclink_'+post_id);
	
	if ((topictitle == null) || (orig_topictitle == null) || (topiclink == null))
	{
		if (AJAX_DEBUG_HTML_ERRORS)
		{
			alert('AJAXEndTitleEdit: some HTML elements could not be found');
		}
		return;
	}
	
	if (orig_topictitle.value != topictitle.value)
	{
		var url = 'ajax.' + phpEx;
		var params = 'mode=edit_post_subject';
		if (S_SID != '')
		{
			params += '&sid=' + S_SID;
		}
		params += '&'+ POST_POST_URL + '=' + post_id + '&subject=' + ajax_escape(topictitle.value);
		if (!loadXMLDoc(url, params, 'POST', 'post_subject_change'))
		{
			AJAXFinishTitleEdit(AJAX_ERROR, post_id, '', '', '');
		}
	}
	else
	{
		AJAXFinishTitleEdit(AJAX_ERROR, post_id, '', '', '');
	}
}

function AJAXCancelTitleEdit(post_id)
{
	if (!ajax_core_defined)
	{
		return;
	}
	
	AJAXFinishTitleEdit(AJAX_ERROR, post_id, '', '', '');
}

function AJAXTitleEditKeyUp(eventvar, post_id)
{
	if (!ajax_core_defined)
	{
		return;
	}
	
	if (!eventvar)
	{
		if (!window.event)
		{
			return;
		}
		eventvar = window.event;
	}
	var code = 0;
	
	if (eventvar.keyCode)
	{
		code = eventvar.keyCode;
	}
	else if (eventvar.which)
	{
		code = eventvar.which;
	}
	
	if (code == 13)
	{
		AJAXEndTitleEdit(post_id);
	}
	else if (code == 27)
	{
		AJAXCancelTitleEdit(post_id);
	}
}

function post_subject_change()
{
	//Check if the request is completed, if not, just skip over
	if (request.readyState == 4)
	{
		var result_code = AJAX_OP_COMPLETED;
		var subject = '';
		var raw_subject = '';
		var editmessage = '';
		var post_id = '';
		var error_msg = '';
		//If the request wasn't successful, we just hide any information we have.
		if (request.status == 200)
		{
			var response = request.responseXML.documentElement;
			if (AJAX_DEBUG_RESULTS)
			{
				alert(request.responseText);
			}
			//Don't react if no valid response was received
			if (response != null)
			{
				result_code = getFirstTagValue('result', response);
				post_id = getFirstTagValue('postid', response);
				
				if (result_code == AJAX_POST_SUBJECT_EDITED)
				{
					subject = getFirstTagValue('subject', response);
					raw_subject = getFirstTagValue('rawsubject', response);
					editmessage = getFirstTagValue('editmessage', response);
				}
				else
				{
					error_msg = getFirstTagValue('error_msg', response);
					if (AJAX_DEBUG_REQUEST_ERRORS)
					{
						alert('result_code: '+result_code+'; error: '+error_msg);
					}
				}
			}
		}
		
		AJAXFinishTitleEdit(result_code, post_id, subject, raw_subject, editmessage);
		delete request;
	}
}
function AJAXFinishTitleEdit(result_code, post_id, new_subject, raw_subject, new_editmessage)
{
	if (!ajax_core_defined)
	{
		return;
	}
	
	var topic = getElementById('title_'+post_id);
	var topictitle = getElementById('topictitle_'+post_id);
	var orig_topictitle = getElementById('orig_topictitle_'+post_id);
	var editmessage_not_found = 0;
	if (is_viewtopic)
	{
		var editmessage = getElementById('editmessage_'+post_id);
		if (editmessage == null)
		{
			editmessage_not_found = 1;
		}
	}
	var topiclink = getElementById('topiclink_'+post_id);
	if (is_viewtopic_topictitle)
	{
		var top_topiclink = (is_viewtopic) ? getElementById('topiclink_top') : getElementById('topiclink_top_'+post_id);
	}
	
	if ((topictitle == null) || (orig_topictitle == null) || editmessage_not_found || (topiclink == null) || (topic == null))
	{
		if (AJAX_DEBUG_HTML_ERRORS)
		{
			alert('AJAXFinishTitleEdit: some HTML elements could not be found');
		}
		return;
	}
	
	if (result_code != AJAX_POST_SUBJECT_EDITED)
	{
		topictitle.value = orig_topictitle.value;
	}
	else
	{
		setInnerText(topiclink, new_subject);
		topictitle.value = raw_subject;
		orig_topictitle.value = raw_subject;
		if (is_viewtopic)
		{
			editmessage.innerHTML = new_editmessage;
		}
		if (is_viewtopic_topictitle)
		{
			setInnerText(top_topiclink, new_subject);
		}
	}
	
	topic.style.display = 'none';
	topiclink.style.display = '';
}

//
// Editing of post texts
//
function AJAXPostEdit(post_id)
{
	if (!ajax_core_defined)
	{
		return true;
	}
	
	var postmessage = getElementById('postmessage_'+post_id);
	var posttext = getElementById('posttext_'+post_id);
	var post = getElementById('post_'+post_id);
	
	var editlink = getElementById('editlink_'+post_id);
	var editimg = getElementById('editimg_'+post_id);
	
	if ((postmessage == null) || (posttext == null) || (post == null))
	{
		if (AJAX_DEBUG_HTML_ERRORS)
		{
			alert('AJAXPostEdit: some HTML elements could not be found');
		}
		return true;
	}
	
	posttext.setAttribute('rows', '15', 'false');
	post.style.display = '';
	postmessage.style.display = 'none';
	
	if (editlink != null)
	{
		editlink.style.display = 'none';
	}
	if (editimg != null)
	{
		editimg.style.display = 'none';
	}
	
	posttext.focus();
	
	return false;
}

function AJAXEndPostEdit(post_id, return_chars)
{
	if (!ajax_core_defined)
	{
		return;
	}
	
	var posttext = getElementById('posttext_'+post_id);
	var orig_posttext = getElementById('orig_posttext_'+post_id);
	
	if ((posttext == null) || (orig_posttext == null))
	{
		if (AJAX_DEBUG_HTML_ERRORS)
		{
			alert('AJAXEndPostEdit: some HTML elements could not be found');
		}
		return;
	}
	
	if ((orig_posttext.value != posttext.value) && (trim(posttext.value) != ''))
	{
		var url = 'ajax.' + phpEx;
		var params = 'mode=edit_post_text';
		if (S_SID != '')
		{
			params += '&sid=' + S_SID;
		}
		if (highlight != '')
		{
			params += '&highlight=' + ajax_escape(highlight);
		}
		params += '&'+ POST_POST_URL + '=' + post_id + '&return_chars=' + return_chars + '&message=' + ajax_escape(posttext.value);
		if (!loadXMLDoc(url, params, 'POST', 'post_edit_change'))
		{
			AJAXFinishPostEdit(AJAX_ERROR, post_id, '', '', '');
		}
	}
	else
	{
		AJAXFinishPostEdit(AJAX_ERROR, post_id, '', '', '');
	}
}

function AJAXCancelPostEdit(post_id)
{
	if (!ajax_core_defined)
	{
		return;
	}
	
	AJAXFinishPostEdit(AJAX_ERROR, post_id, '', '', '');
}

function AJAXEnlargePostArea(post_id)
{
	if (!ajax_core_defined)
	{
		return;
	}
	
	var posttext = getElementById('posttext_'+post_id);
	
	if (posttext == null)
	{
		if (AJAX_DEBUG_HTML_ERRORS)
		{
			alert('AJAXEnlargePostArea: some HTML elements could not be found');
		}
		return;
	}
	
	var size = parseInt(posttext.getAttribute('rows', 'false'));
	posttext.setAttribute('rows', size+5, 'false');
}

function AJAXShortenPostArea(post_id)
{
	if (!ajax_core_defined)
	{
		return;
	}
	
	var posttext = getElementById('posttext_'+post_id);
	
	if (posttext == null)
	{
		if (AJAX_DEBUG_HTML_ERRORS)
		{
			alert('AJAXShortenPostArea: some HTML elements could not be found');
		}
		return;
	}
	
	var size = parseInt(posttext.getAttribute('rows', 'false'));
	if (size > 5)
	{
		posttext.setAttribute('rows', size-5, 'false');
	}
}

function AJAXPostEditkeyUp(eventvar, post_id)
{
	if (!ajax_core_defined)
	{
		return;
	}
	
	if (!eventvar)
	{
		if (!window.event)
		{
			return;
		}
		eventvar = window.event;
	}
	var code = 0;
	
	if (eventvar.which)
	{
		code = eventvar.which;
	}
	else if (eventvar.keyCode)
	{
		code = eventvar.keyCode;
	}
	
	if (code == 27)
	{
		AJAXFinishPostEdit(AJAX_ERROR, post_id, '', '', '');
	}
}

function post_edit_change()
{
	//Check if the request is completed, if not, just skip over
	if (request.readyState == 4)
	{
		var result = AJAX_OP_COMPLETED;
		var message = '';
		var rawmessage = '';
		var editmessage = '';
		var postid = '';
		var error_msg = '';
		//If the request wasn't successful, we just hide any information we have.
		if (request.status == 200)
		{
			if (AJAX_DEBUG_RESULTS)
			{
				alert(request.responseText);
			}
			var result_data = parseResult(request.responseText);
			for (var i = 0; i < result_data.length; i++)
			{
				var str = (result_data[i][0] + ' = result_data[i][1];');
				eval(str);
			}
			
			if ((result != AJAX_POST_TEXT_EDITED) && (error_msg != ''))
			{
				if (AJAX_DEBUG_REQUEST_ERRORS)
				{
					alert('result_code: '+result+'; error: '+error_msg);
				}
			}
		}
		
		AJAXFinishPostEdit(result, postid, message, rawmessage, editmessage);
		delete request;
	}
}

function AJAXFinishPostEdit(result_code, post_id, new_message, raw_message, new_editmessage)
{
	if (!ajax_core_defined)
	{
		return;
	}
	
	raw_message = utf8_decode(raw_message);
	
	var postmessage = getElementById('postmessage_'+post_id);
	var editmessage_not_found = 0;
	if (is_viewtopic)
	{
		var editmessage = getElementById('editmessage_'+post_id);
		if (editmessage == null)
		{
			editmessage_not_found = 1;
		}
	}
	var posttext = getElementById('posttext_'+post_id);
	var orig_posttext = getElementById('orig_posttext_'+post_id);
	var post = getElementById('post_'+post_id);
	
	var editlink = getElementById('editlink_'+post_id);
	var editimg = getElementById('editimg_'+post_id);
	
	if ((postmessage == null) || editmessage_not_found || (posttext == null) || (post == null))
	{
		if (AJAX_DEBUG_HTML_ERRORS)
		{
			alert('AJAXFinishPostEdit: some HTML elements could not be found');
		}
		return;
	}
	
	if (result_code != AJAX_POST_TEXT_EDITED)
	{
		posttext.value = orig_posttext.value;
	}
	else
	{
		posttext.value = raw_message;
		orig_posttext.value = raw_message;
		postmessage.innerHTML = new_message;
		if (is_viewtopic)
		{
			editmessage.innerHTML = new_editmessage;
		}
	}
	
	post.style.display = 'none';
	postmessage.style.display = '';
	if (editlink != null)
	{
		editlink.style.display = '';
	}
	if (editimg != null)
	{
		editimg.style.display = '';
	}
}

//
// Poll results
//
var sel_poll_option = 0;

function AJAXSelPollOption(vote_option_id)
{
	if (!ajax_core_defined)
	{
		return;
	}
	
	sel_poll_option = vote_option_id;
}

function AJAXVotePoll(topic_id)
{
	if (!ajax_core_defined || (sel_poll_option == 0))
	{
		return true;
	}
	
	error_handler = 'AJAXShowPollResult';
	var url = 'ajax.' + phpEx;
	var params = 'mode=vote_poll';
	if (S_SID != '')
	{
		params += '&sid=' + S_SID;
	}
	params += '&'+ POST_TOPIC_URL + '=' + topic_id + '&vote_option_id=' + sel_poll_option;
	return !loadXMLDoc(url, params, 'GET', 'error_req_change');
}

function AJAXViewPollResult(topic_id)
{
	if (!ajax_core_defined || (topic_id == 0))
	{
		// Have to return true, that way the link will be used. This will keep the link working just in case something goes wrong
		return true;
	}
	
	error_handler = 'AJAXShowPollResult';
	url = 'ajax.' + phpEx;
	params = 'mode=view_poll';
	if (S_SID != '')
	{
		params += '&sid=' + S_SID;
	}
	params += '&'+ POST_TOPIC_URL + '=' + topic_id;
	return !loadXMLDoc(url, params, 'GET', 'error_req_change');
}

function AJAXViewPollBallot(topic_id)
{
	if (!ajax_core_defined || (topic_id == 0))
	{
		// Have to return true, that way the link will be used. This will keep the link working just in case something goes wrong
		return true;
	}
	
	error_handler = 'AJAXShowPollResult';
	url = 'ajax.' + phpEx;
	params = 'mode=view_ballot';
	if (S_SID != '')
	{
		params += '&sid=' + S_SID;
	}
	params += '&'+ POST_TOPIC_URL + '=' + topic_id;
	return !loadXMLDoc(url, params, 'GET', 'error_req_change');
}

function AJAXShowPollResult(result_code, code)
{
	if (!ajax_core_defined || (result_code != AJAX_POLL_RESULT))
	{
		return;
	}
	
	var pollbox_table = getElementById('pollbox');
	if (pollbox_table == null)
	{
		if (AJAX_DEBUG_HTML_ERRORS)
		{
			alert('AJAXShowPollResult: some HTML elements could not be found');
		}
		return;
	}
	pollbox_table.innerHTML = code;
}

//
// Watch/Unwatch topic
//
function AJAXWatchTopic(topic_id, start, watch_status)
{
	if (!ajax_core_defined || (topic_id == 0))
	{
		// Have to return true, that way the link will be used. This will keep the link working just in case something goes wrong
		return true;
	}
	
	var url = 'ajax.' + phpEx;
	var params = 'mode=watch_topic';
	if (S_SID != '')
	{
		params += '&sid=' + S_SID;
	}
	params += '&'+ POST_TOPIC_URL + '=' + topic_id + '&watch_status=' + watch_status + '&start=' + start;
	return !loadXMLDoc(url, params, 'GET', 'watch_topic_change');
}

function watch_topic_change()
{
	//Check if the request is completed, if not, just skip over
	if (request.readyState == 4)
	{
		var result_code = AJAX_OP_COMPLETED;
		var topic_id = '';
		var linkurl = '';
		var linktext = '';
		var imgurl = '';
		var start = '0';
		var watching = '0';
		var error_msg = '';
		//If the request wasn't successful, we just hide any information we have.
		if (request.status == 200)
		{
			var response = request.responseXML.documentElement;
			if (AJAX_DEBUG_RESULTS)
			{
				alert(request.responseText);
			}
			//Don't react if no valid response was received
			if (response != null)
			{
				result_code = getFirstTagValue('result', response);
				
				if (result_code == AJAX_WATCH_TOPIC)
				{
					topic_id = getFirstTagValue('topicid', response);
					linkurl = getFirstTagValue('linkurl', response);
					linktext = getFirstTagValue('linktext', response);
					imgurl = getFirstTagValue('imgurl', response);
					start = getFirstTagValue('start', response);
					watching = getFirstTagValue('watching', response);
				}
				else
				{
					error_msg = getFirstTagValue('error_msg', response);
					if (AJAX_DEBUG_REQUEST_ERRORS)
					{
						alert('result_code: '+result_code+'; error: '+error_msg);
					}
				}
			}
		}
		
		AJAXFinishWatchTopic(result_code, topic_id, linkurl, linktext, imgurl, start, watching);
		delete request;
	}
}

function AJAXFinishWatchTopic(result_code, topic_id, linkurl, linktext, imgurl, start, watching)
{
	if (!ajax_core_defined || (result_code != AJAX_WATCH_TOPIC))
	{
		return;
	}
	
	var watch_link = getElementById('watchlink');
	var watch_link_img = getElementById('watchlink_img');
	var watch_image = getElementById('watchimage');
	if (watch_link == null)
	{
		if (AJAX_DEBUG_HTML_ERRORS)
		{
			alert('AJAXFinishWatchTopic: some HTML elements could not be found');
		}
		return;
	}
	
	setInnerText(watch_link, linktext);
	watch_link.setAttribute('href', linkurl, 'false');
	var js_event = 'return AJAXWatchTopic(' + topic_id + ', ' + start + ', ' + (1-watching) + ');';
	setClickEventHandler(watch_link, js_event);
	
	if (watch_link_img != null)
	{
		watch_link_img.setAttribute('href', linkurl, 'false');
		setClickEventHandler(watch_link_img, js_event);
		if (watch_image != null)
		{
			watch_image.setAttribute('src', imgurl, 'false');
		}
	}
}

//
// Lock/Unlock topic
//
function AJAXLockTopic(topic_id, lock_status)
{
	if (!ajax_core_defined || (topic_id == 0))
	{
		// Have to return true, that way the link will be used. This will keep the link working just in case something goes wrong
		return true;
	}
	
	var url = 'ajax.' + phpEx;
	var params = 'mode=lock_topic';
	if (S_SID != '')
	{
		params += '&sid=' + S_SID;
	}
	params += '&'+ POST_TOPIC_URL + '=' + topic_id + '&lock_status=' + lock_status;
	return !loadXMLDoc(url, params, 'GET', 'lock_topic_change');
}

function lock_topic_change()
{
	//Check if the request is completed, if not, just skip over
	if (request.readyState == 4)
	{
		var result_code = AJAX_OP_COMPLETED;
		var topic_id = '';
		var linkurl = '';
		var imgurl = '';
		var imgtext = '';
		var replyurl = '';
		var replytext = '';
		var locked = '0';
		var error_msg = '';
		//If the request wasn't successful, we just hide any information we have.
		if (request.status == 200)
		{
			var response = request.responseXML.documentElement;
			if (AJAX_DEBUG_RESULTS)
			{
				alert(request.responseText);
			}
			//Don't react if no valid response was received
			if (response != null)
			{
				result_code = getFirstTagValue('result', response);
				
				if (result_code == AJAX_LOCK_TOPIC)
				{
					topic_id = getFirstTagValue('topicid', response);
					linkurl = getFirstTagValue('linkurl', response);
					imgurl = getFirstTagValue('imgurl', response);
					imgtext = getFirstTagValue('imgtext', response);
					replyurl = getFirstTagValue('replyurl', response);
					replytext = getFirstTagValue('replytext', response);
					locked = getFirstTagValue('locked', response);
				}
				else
				{
					error_msg = getFirstTagValue('error_msg', response);
					if (AJAX_DEBUG_REQUEST_ERRORS)
					{
						alert('result_code: '+result_code+'; error: '+error_msg);
					}
				}
			}
		}
		
		AJAXFinishLockTopic(result_code, topic_id, linkurl, imgurl, imgtext, replyurl, replytext, locked);
		delete request;
	}
}

function AJAXFinishLockTopic(result_code, topic_id, linkurl, imgurl, imgtext, replyurl, replytext, locked)
{
	if (!ajax_core_defined || (result_code != AJAX_LOCK_TOPIC))
	{
		return;
	}
	
	var lock_link = getElementById('topic_locklink');
	var lock_img = getElementById('topic_lockimg');
	var reply_img_top = getElementById('replyimg_top');
	var reply_img_bottom = getElementById('replyimg_bottom');
	if ((lock_link == null) || (lock_img == null))
	{
		if (AJAX_DEBUG_HTML_ERRORS)
		{
			alert('AJAXFinishLockTopic: some HTML elements could not be found');
		}
		return;
	}
	
	lock_link.setAttribute('href', linkurl, 'false');
	var js_event = 'return AJAXLockTopic(' + topic_id + ', ' + (1-locked) + ');';
	setClickEventHandler(lock_link, js_event);
	
	lock_img.setAttribute('src', imgurl, 'false');
	lock_img.setAttribute('alt', imgtext, 'false');
	lock_img.setAttribute('title', imgtext, 'false');
	
	if (reply_img_top != null)
	{
		reply_img_top.setAttribute('src', replyurl, 'false');
		reply_img_top.setAttribute('alt', replytext, 'false');
		reply_img_top.setAttribute('title', replytext, 'false');
	}
	
	if (reply_img_bottom != null)
	{
		reply_img_bottom.setAttribute('src', replyurl, 'false');
		reply_img_bottom.setAttribute('alt', replytext, 'false');
		reply_img_bottom.setAttribute('title', replytext, 'false');
	}
}

//
// Mark a topic as read
//
function AJAXMarkTopic(topic_id)
{
	if (!ajax_core_defined || (topic_id == 0))
	{
		return true;
	}
	
	var url = 'ajax.' + phpEx;
	var params = 'mode=mark_topic';
	if (S_SID != '')
	{
		params += '&sid=' + S_SID;
	}
	params += '&'+ POST_TOPIC_URL + '=' + topic_id;
	return !loadXMLDoc(url, params, 'GET', 'mark_topic_change');
}

function mark_topic_change()
{
	//Check if the request is completed, if not, just skip over
	if (request.readyState == 4)
	{
		var result_code = AJAX_ERROR;
		var topic_id = '';
		var topicimage = '0';
		var imagetext = '0';
		var error_msg = '';
		//If the request wasn't successful, we just hide any information we have.
		if (request.status == 200)
		{
			var response = request.responseXML.documentElement;
			if (AJAX_DEBUG_RESULTS)
			{
				alert(request.responseText);
			}
			//Don't react if no valid response was received
			if (response != null)
			{
				result_code = getFirstTagValue('result', response);
				
				if (result_code == AJAX_MARK_TOPIC)
				{
					topic_id = getFirstTagValue('topicid', response);
					topicimage = getFirstTagValue('topicimage', response);
					imagetext = getFirstTagValue('imagetext', response);
				}
				else
				{
					error_msg = getFirstTagValue('error_msg', response);
					if (AJAX_DEBUG_REQUEST_ERRORS)
					{
						alert('result_code: '+result_code+'; error: '+error_msg);
					}
				}
			}
		}
		
		AJAXFinishMarkTopic(result_code, topic_id, topicimage, imagetext);
		delete request;
	}
}

function AJAXFinishMarkTopic(result_code, topic_id, topicimage, imagetext)
{
	if (!ajax_core_defined || (result_code != AJAX_MARK_TOPIC))
	{
		return;
	}
	
	var topic_image = getElementById('topicimage_'+topic_id);
	var topic_newest = getElementById('topicnewest_'+topic_id);
	if (topic_image == null)
	{
		if (AJAX_DEBUG_HTML_ERRORS)
		{
			alert('AJAXFinishMarkTopic: some HTML elements could not be found');
		}
		return;
	}
	
	topic_image.setAttribute('src', topicimage, 'false');
	topic_image.setAttribute('alt', imagetext, 'false');
	topic_image.setAttribute('title', imagetext, 'false');
	
	if (topic_newest != null)
	{
		topic_newest.style.display = 'none';
	}
}
