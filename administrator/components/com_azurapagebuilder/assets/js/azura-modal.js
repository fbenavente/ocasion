/*!
 * Bootstrap v3.3.1 (http://getbootstrap.com)
 * Copyright 2011-2014 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 */

/*!
 * Generated using the Bootstrap Customizer (http://getbootstrap.com/customize/?id=89cc7d44326b239ab657)
 * Config saved to config.json and https://gist.github.com/89cc7d44326b239ab657
 */
if (typeof jQuery === 'undefined') {
  throw new Error('Bootstrap\'s JavaScript requires jQuery')
}
+function ($) {
  var version = $.fn.jquery.split(' ')[0].split('.')
  if ((version[0] < 2 && version[1] < 9) || (version[0] == 1 && version[1] == 9 && version[2] < 1)) {
    throw new Error('Bootstrap\'s JavaScript requires jQuery version 1.9.1 or higher')
  }
}(jQuery);

/* ========================================================================
 * Bootstrap: modal.js v3.3.1
 * http://getbootstrap.com/javascript/#modals
 * ========================================================================
 * Copyright 2011-2014 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 * ======================================================================== */


+function ($) {
  'use strict';

  // MODAL CLASS DEFINITION
  // ======================

  var AzuraModal = function (element, options) {
    this.options        = options
    this.$body          = $(document.body)
    this.$element       = $(element)
    this.$backdrop      =
    this.isShown        = null
    this.scrollbarWidth = 0

    if (this.options.remote) {
      this.$element
        .find('.azura-modal-content')
        .load(this.options.remote, $.proxy(function () {
          this.$element.trigger('loaded.bs.azuramodal')
        }, this))
    }
  }

  AzuraModal.VERSION  = '3.3.1'

  AzuraModal.TRANSITION_DURATION = 300
  AzuraModal.BACKDROP_TRANSITION_DURATION = 150

  AzuraModal.DEFAULTS = {
    backdrop: true,
    keyboard: true,
    show: true
  }

  AzuraModal.prototype.toggle = function (_relatedTarget) {
    return this.isShown ? this.hide() : this.show(_relatedTarget)
  }

  AzuraModal.prototype.show = function (_relatedTarget) {
    var that = this
    var e    = $.Event('show.bs.azuramodal', { relatedTarget: _relatedTarget })

    this.$element.trigger(e)

    if (this.isShown || e.isDefaultPrevented()) return

    this.isShown = true

    this.checkScrollbar()
    this.setScrollbar()
    this.$body.addClass('azura-modal-open')

    this.escape()
    this.resize()

    this.$element.on('click.dismiss.bs.azuramodal', '[data-dismiss="azura-modal"]', $.proxy(this.hide, this))

    this.backdrop(function () {
      var transition = $.support.transition && that.$element.hasClass('fade')

      if (!that.$element.parent().length) {
        that.$element.appendTo(that.$body) // don't move modals dom position
      }

      that.$element
        .show()
        .scrollTop(0)

      if (that.options.backdrop) that.adjustBackdrop()
      that.adjustDialog()

      if (transition) {
        that.$element[0].offsetWidth // force reflow
      }

      that.$element
        .addClass('in')
        .attr('aria-hidden', false)

      that.enforceFocus()

      var e = $.Event('shown.bs.azuramodal', { relatedTarget: _relatedTarget })

      transition ?
        that.$element.find('.azura-modal-dialog') // wait for modal to slide in
          .one('bsTransitionEnd', function () {
            that.$element.trigger('focus').trigger(e)
          })
          .emulateTransitionEnd(AzuraModal.TRANSITION_DURATION) :
        that.$element.trigger('focus').trigger(e)
    })
  }

  AzuraModal.prototype.hide = function (e) {
    if (e) e.preventDefault()

    e = $.Event('hide.bs.azuramodal')

    this.$element.trigger(e)

    if (!this.isShown || e.isDefaultPrevented()) return

    this.isShown = false

    this.escape()
    this.resize()

    $(document).off('focusin.bs.azuramodal')

    this.$element
      .removeClass('in')
      .attr('aria-hidden', true)
      .off('click.dismiss.bs.azuramodal')

    $.support.transition && this.$element.hasClass('fade') ?
      this.$element
        .one('bsTransitionEnd', $.proxy(this.hideModal, this))
        .emulateTransitionEnd(AzuraModal.TRANSITION_DURATION) :
      this.hideModal()
  }

  AzuraModal.prototype.enforceFocus = function () {
    $(document)
      .off('focusin.bs.azuramodal') // guard against infinite focus loop
      .on('focusin.bs.azuramodal', $.proxy(function (e) {
        if (this.$element[0] !== e.target && !this.$element.has(e.target).length) {
          this.$element.trigger('focus')
        }
      }, this))
  }

  AzuraModal.prototype.escape = function () {
    if (this.isShown && this.options.keyboard) {
      this.$element.on('keydown.dismiss.bs.azuramodal', $.proxy(function (e) {
        e.which == 27 && this.hide()
      }, this))
    } else if (!this.isShown) {
      this.$element.off('keydown.dismiss.bs.azuramodal')
    }
  }

  AzuraModal.prototype.resize = function () {
    if (this.isShown) {
      $(window).on('resize.bs.azuramodal', $.proxy(this.handleUpdate, this))
    } else {
      $(window).off('resize.bs.azuramodal')
    }
  }

  AzuraModal.prototype.hideModal = function () {
    var that = this
    this.$element.hide()
    this.backdrop(function () {
      that.$body.removeClass('azura-modal-open')
      that.resetAdjustments()
      that.resetScrollbar()
      that.$element.trigger('hidden.bs.azuramodal')
    })
  }

  AzuraModal.prototype.removeBackdrop = function () {
    this.$backdrop && this.$backdrop.remove()
    this.$backdrop = null
  }

   AzuraModal.prototype.backdrop = function (callback) {
      var that = this
      var animate = this.$element.hasClass('fade') ? 'fade' : ''

      if (this.isShown && this.options.backdrop) {
         var doAnimate = $.support.transition && animate

         this.$backdrop = $('<div class="azura-modal-backdrop ' + animate + '" />')
            .prependTo(this.$element)
            .on('click.dismiss.bs.azuramodal', $.proxy(function (e) {
               if (e.target !== e.currentTarget) return
               this.options.backdrop == 'static'
               ? this.$element[0].focus.call(this.$element[0])
               : this.hide.call(this)
            }, this))

         if (doAnimate) this.$backdrop[0].offsetWidth // force reflow

         this.$backdrop.addClass('in')

         if (!callback) return

         doAnimate ?
         this.$backdrop
            .one('bsTransitionEnd', callback)
            .emulateTransitionEnd(AzuraModal.BACKDROP_TRANSITION_DURATION) :
         callback()

      } else if (!this.isShown && this.$backdrop) {
         this.$backdrop.removeClass('in')

         var callbackRemove = function () {
            that.removeBackdrop()
            callback && callback()
         }
         $.support.transition && this.$element.hasClass('fade') ?
         this.$backdrop
            .one('bsTransitionEnd', callbackRemove)
            .emulateTransitionEnd(AzuraModal.BACKDROP_TRANSITION_DURATION) :
         callbackRemove()

      } else if (callback) {
         callback()
      }
   }

  // these following methods are used to handle overflowing modals

  AzuraModal.prototype.handleUpdate = function () {
    if (this.options.backdrop) this.adjustBackdrop()
    this.adjustDialog()
  }

  AzuraModal.prototype.adjustBackdrop = function () {
    this.$backdrop
      .css('height', 0)
      .css('height', this.$element[0].scrollHeight)
  }

  AzuraModal.prototype.adjustDialog = function () {
    var modalIsOverflowing = this.$element[0].scrollHeight > document.documentElement.clientHeight

    this.$element.css({
      paddingLeft:  !this.bodyIsOverflowing && modalIsOverflowing ? this.scrollbarWidth : '',
      paddingRight: this.bodyIsOverflowing && !modalIsOverflowing ? this.scrollbarWidth : ''
    })
  }

  AzuraModal.prototype.resetAdjustments = function () {
    this.$element.css({
      paddingLeft: '',
      paddingRight: ''
    })
  }

  AzuraModal.prototype.checkScrollbar = function () {
    this.bodyIsOverflowing = document.body.scrollHeight > document.documentElement.clientHeight
    this.scrollbarWidth = this.measureScrollbar()
  }

  AzuraModal.prototype.setScrollbar = function () {
    var bodyPad = parseInt((this.$body.css('padding-right') || 0), 10)
    if (this.bodyIsOverflowing) this.$body.css('padding-right', bodyPad + this.scrollbarWidth)
  }

  AzuraModal.prototype.resetScrollbar = function () {
    this.$body.css('padding-right', '')
  }

  AzuraModal.prototype.measureScrollbar = function () { // thx walsh
    var scrollDiv = document.createElement('div')
    scrollDiv.className = 'azura-modal-scrollbar-measure'
    this.$body.append(scrollDiv)
    var scrollbarWidth = scrollDiv.offsetWidth - scrollDiv.clientWidth
    this.$body[0].removeChild(scrollDiv)
    return scrollbarWidth
  }


  // MODAL PLUGIN DEFINITION
  // =======================

  function Plugin(option, _relatedTarget) {
    return this.each(function () {
      var $this   = $(this)
      var data    = $this.data('bs.auzramodal')
      var options = $.extend({}, AzuraModal.DEFAULTS, $this.data(), typeof option == 'object' && option)

      if (!data) $this.data('bs.azuramodal', (data = new AzuraModal(this, options)))
      if (typeof option == 'string') data[option](_relatedTarget)
      else if (options.show) data.show(_relatedTarget)
    })
  }

  var old = $.fn.azuramodal

  $.fn.azuramodal             = Plugin
  $.fn.azuramodal.Constructor = AzuraModal


  // MODAL NO CONFLICT
  // =================

  $.fn.azuramodal.noConflict = function () {
    $.fn.azuramodal = old
    return this
  }


  // MODAL DATA-API
  // ==============

  $(document).on('click.bs.azuramodal.data-api', '[data-toggle="azura-modal"]', function (e) {
    var $this   = $(this)
    var href    = $this.attr('href')
    var $target = $($this.attr('data-target') || (href && href.replace(/.*(?=#[^\s]+$)/, ''))) // strip for ie7
    var option  = $target.data('bs.azuramodal') ? 'toggle' : $.extend({ remote: !/#/.test(href) && href }, $target.data(), $this.data())

    if ($this.is('a')) e.preventDefault()

    $target.one('show.bs.azuramodal', function (showEvent) {
      if (showEvent.isDefaultPrevented()) return // only register focus restorer if modal will actually get shown
      $target.one('hidden.bs.azuramodal', function () {
        $this.is(':visible') && $this.trigger('focus')
      })
    })
    Plugin.call($target, option, this)
  })

}(jQuery);

/* ========================================================================
 * Bootstrap: transition.js v3.3.1
 * http://getbootstrap.com/javascript/#transitions
 * ========================================================================
 * Copyright 2011-2014 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 * ======================================================================== */


+function ($) {
  'use strict';

  // CSS TRANSITION SUPPORT (Shoutout: http://www.modernizr.com/)
  // ============================================================

  function transitionEnd() {
    var el = document.createElement('bootstrap')

    var transEndEventNames = {
      WebkitTransition : 'webkitTransitionEnd',
      MozTransition    : 'transitionend',
      OTransition      : 'oTransitionEnd otransitionend',
      transition       : 'transitionend'
    }

    for (var name in transEndEventNames) {
      if (el.style[name] !== undefined) {
        return { end: transEndEventNames[name] }
      }
    }

    return false // explicit for ie8 (  ._.)
  }

  // http://blog.alexmaccaw.com/css-transitions
  $.fn.emulateTransitionEnd = function (duration) {
    var called = false
    var $el = this
    $(this).one('bsTransitionEnd', function () { called = true })
    var callback = function () { if (!called) $($el).trigger($.support.transition.end) }
    setTimeout(callback, duration)
    return this
  }

  $(function () {
    $.support.transition = transitionEnd()

    if (!$.support.transition) return

    $.event.special.bsTransitionEnd = {
      bindType: $.support.transition.end,
      delegateType: $.support.transition.end,
      handle: function (e) {
        if ($(e.target).is(this)) return e.handleObj.handler.apply(this, arguments)
      }
    }
  })

}(jQuery);
