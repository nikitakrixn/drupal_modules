(function ($, Drupal, drupalSettings) {

  'use strict';

  Drupal.behaviors.modal_form = {
    attach: function (context, settings) {
      var modal = Drupal.dialog('#modal_window',{
        title: 'Status Message',
        minWidth: drupalSettings.statusMessage.modalWindow.width,
        minHeight: drupalSettings.statusMessage.modalWindow.height,
        // Closing a window through an overlay
        open: function(event, ui) {
          jQuery('.ui-widget-overlay').on('click', function() {
            jQuery('#modal_window').dialog('close');
          });
        },
        close: function (event) {
          $(event.target).remove();
        },
        show: {
          effect: 'fade',
          duration: 250,

        },
        hide: {
          effect: 'fade',
          duration: 250
        },

      });
      // Displays a modal window with an overlay.
      modal.showModal();
      modal.draggable();
    }
  }

})(jQuery, Drupal, drupalSettings);
