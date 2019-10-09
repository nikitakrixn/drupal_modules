(function ($, Drupal) {

  'use strict';

  // Setting the status message display form.
  Drupal.behaviors.modal_form = {
    attach: function (context, settings) {

      // Exports settings.
      var modalMessage = settings.modal_form;

      // Status message box.
      var message_box = $('.message-popup-container');

      // Customize the form using local settings.
      message_box.css({
          'min-width' : modalMessage.width + 'px',
          'min-height' : modalMessage.height + 'px'});

      // Appearance in the center of the screen.
      $.fn.center = function() {
        this.css({
          'position': 'fixed',
          'left': '50%',
          'top': '50%'
        });

        this.css({
          'margin-left': -this.outerWidth() / 2 + 'px',
          'margin-top': -this.outerHeight() / 2 + 'px'
        });

        return this;
      };

      message_box.center();

      // Closing this by clicking overlay.
      $('.message-popup').on('click', function(event){
        if( $(event.target).is('.message-popup-close') || $(event.target).is('.message-popup') ) {
          event.preventDefault();
          $(this).addClass('is-hidden');
        }
      });

      // Move form.
      $.fn.drags = function(opt) {

        opt = $.extend({handle:'',cursor:'move'}, opt);

        if (opt.handle === '') {
          var $el = this;
        }
        else {
          var $el = this.find(opt.handle);
        }

        return $el.css('cursor', opt.cursor).on('mousedown', function(e) {

          // Add class for message box.
          if (opt.handle === '') {
            var $drag = $(this).addClass('draggable');
            message_box.addClass('draggable');
          }
          else {
            var $drag = $(this).addClass('active-handle').parent().addClass('draggable');
            message_box.addClass('active-handle').parent().addClass('draggable');
          }

          // Screen Position.
          var z_idx = $drag.css('z-index'),
            drg_h = $drag.outerHeight(),
            drg_w = $drag.outerWidth(),
            pos_y = $drag.offset().top + drg_h - e.pageY,
            pos_x = $drag.offset().left + drg_w - e.pageX;

          // Add moving for this form.
          $drag.css('z-index', 1000).parents().on('mousemove', function(e) {
            $('.draggable').offset({
              top:e.pageY + pos_y - drg_h,
              left:e.pageX + pos_x - drg_w
            }).on('mouseup', function() {
              $(this).removeClass('draggable').css('z-index', z_idx);
            });
          });

          // Disable selection.
          e.preventDefault();
        }).on('mouseup', function() {

          // Remove class.
          if (opt.handle === '') {
            $(this).removeClass('draggable');
          }
          else {
            $(this).removeClass('active-handle').parent().removeClass('draggable');
          }
        });

      };

      $('.message-popup-title').drags();

    }
  }

})(jQuery, Drupal, drupalSettings);
