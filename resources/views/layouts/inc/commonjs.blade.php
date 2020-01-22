<script>
"use strict";

var Comment = {
//  successCallback: null,
//  errorCallback: null,
 currentAction: null,
 currentTarget: null,
 currentCommentID: NaN,
 currentDeleteForm: null,
 emailTarget: null,
 emailSource: null,
//  accessKey: null,
 emailCheckURL: null,
 modalActionImages: {

		destroy: 'destroy',
		edit: 'edit'
	},

 /**
  * Changes modal action-image
  */
 modalActionImage: function() {

  $('#comment_id').text(Comment.currentCommentID);

  var doChange = function(index, item) {

   $(item).css('display', 'none');

   if ($(item).attr('data-action-image') === Comment.currentAction) {

    $(item).css('display', 'inline-block');
   }
  };

  $('#emailmodal img').each(doChange);
 },

 /**
  * Initializes the delete request
  * @param integer currentCommentId
  * @param string emailSource
  * @param string emailTarget
  * @param string modalActionImage
  */
 initRequest: function(currentCommentId, currentDeleteForm, emailSource, emailTarget, modalActionImage) {

		Comment.currentCommentID = currentCommentId;
		Comment.setCurrentDeleteForm(currentDeleteForm);
		Comment.setEmailSources(emailSource, emailTarget);
		Comment.currentAction = modalActionImage;
		Comment.modalActionImage();
 },

 /**
  * Assigns new value to the Comment.currentAction
  */
 setCurrentAction: function(action) {

  Comment.currentAction = action;
 },

 /**
  * Current sets delete form
  * @param jquery object deleteForm
  */
 setCurrentDeleteForm: function(deleteForm) {

		Comment.currentDeleteForm = deleteForm;
 },

 /**
  * Sets the currentCommentID
  */
 setCommentId: function(id)	{

  Comment.currentCommentID = id;
 },

 /**
  *  This method takes the email from the modal that was provided
  * by the client and sets it as value of the form email field that will
  * be posted.
  * @param {string} emailSource The source email css selector
  * @param {string} emailTarget The target email css selector
  */
 setEmailSources: function(emailSource, emailTarget) {

  Comment.emailSource = emailSource;
  Comment.emailTarget = emailTarget;
 },


 /**
  *
  *
  */
 destroy: function() {

  $(Comment.emailTarget).val($(Comment.emailSource).val());

  document.querySelector(Comment.currentDeleteForm).submit();
 },

 /**
  * doEmailCheck
  *
  * Does email check
  */
 doEmailCheck: function(targetObject) {

  Comment.currentTarget = targetObject;

  /**
   * Does destroy request
   */
  function destroy() {

   document.querySelector(Comment.currentDeleteForm).submit();
  }

  /**
   * Does edit request
   */
  function edit() {

   location.href = '/comments/' + Comment.currentCommentID + '/edit';
  }

  function message(msgtext) {

   $('#emailredtxt').attr({
    'id': 'messages',
    'class': 'alert bg-info m-2'
   })
   .text(msgtext)
   .show(500)
   .delay(1000)
   .hide(500, function() {

    $('#emailredtxt').text('');
   });
  }

  /**
   * Ajax success callback
   */
  function success(data, status, xhr) {

   if (data === 'no') alert("You were refused do modify the comment.");
   else if (data === 'yes')
    if (Comment.currentAction === 'destroy') destroy(Comment.currentCommentID);
    else if (Comment.currentAction === 'edit') edit(Comment.currentCommentID);
  }

  /**
   * Ajax error callback
   */
  function error(xhr, status, error) {

   message('Could not realize ' + Comment.currentAction + ' operation. Please try again!');
  }

  /**
   * Does ajax email-check
   */
  $.ajax({
   'url': Comment.emailCheckURL,
   'method': 'post',
   'data': {
    'email': $('#modalwrapper [type="email"]').val(),
    'item_id': Comment.currentCommentID
   },
   'dataType': 'json',
   'success': success,
   'error': error,
   'headers': {
     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
   }
  });
 }
};
</script>