var ModalImage = function()
{
  var HTMLDiv = '<div></div>';
  var HTMLSpan = '<span></span>';
  var HTMLImg = '<img />';

  /**
    * The wrapper object of the modal (top parent)
    * @var object theWrapper
    */

  var $wrapper = $(HTMLDiv)
                  .attr('class', 'modal-image justify-content-center align-items-center')
                  .mousedown(function(e)
                  {
                    hide$wrapper();
                  }).appendTo($('body'));

  function get$wrapper()
  {
    return $wrapper;
  }

  function hide$wrapper()
  {
    $(get$wrapper())
      .html('')
      .fadeOut()
      .css('max-height', '0vh')
      .removeClass('d-flex');
  }

  /**
    * Adds content
    * @param jquery itemToShow An array of objects or a single jquery object
    */
  this.addContent = function ($itemToShow)
  {
    /**
      * The object that should become event-attached
      * @var object item
      */
    function appendAnObject($item)
    {
      function clickEvent(e)
      {
        var $_item = $(e.target);

        if (e.target.tagName.toLocaleLowerCase() === 'img')
        {
          $_item = $(HTMLImg)
            .attr({
              'src': $(e.target).attr('src'),
              'class': 'img-fluid'
            })
            .click(() => {
              hide$wrapper();
            });
        }

        $(get$wrapper())
          .html($_item)
          .fadeIn()
          .css('max-height', '100vh')
          .addClass('d-flex');
      }

      $($item).mousedown(clickEvent);
    }

    appendAnObject($itemToShow);
  };
};

var $imageModal = new ModalImage();

function get$ImageModal() {

 return $imageModal;
}

$('table.table img').each(function() {

 $(this).click(function(e) {

  get$ImageModal().addContent(e.target);
 });
});