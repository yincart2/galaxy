(function($) {

  "use strict";

	/**
	 *
	 * RoyalSlider Deep Linking Module
	 * @version 1.0.6 + jQuery hashchange plugin v1.3 Copyright (c) 2010 Ben Alman:
   *
   * 1.0.1:
   * - Added timeout before hash changes to 750ms to avoid reloading animation.
   *
   * 1.0.2:
   * - Added multiple slider with hash support
   *
   * 1.0.3
   * - Removed hashchange listener on destroy()
   *
   * 1.0.4
   * - Decreased timeout from 750 to 400ms
   *
   * 1.0.5
   * - History state is now replaced instead of pushing to avoid back button confusion
   * - jQuery 1.9.0 compability
   *
   * 1.0.6
   * - Namespaced hashchange event
   *
   * 1.0.7
   * - Multiple sliders on one page
	 */ 
	$.extend($.rsProto, {
		_initDeeplinking: function() {
			var self = this,
        isBlocked,
        hashTimeout,
        hashChangeTimeout;
			
			self._hashDefaults = {
				enabled: false,
				change: false,
				prefix: ''
			};

			self.st.deeplinking = $.extend({}, self._hashDefaults, self.st.deeplinking);

			if(self.st.deeplinking.enabled) {

				var hashChange = self.st.deeplinking.change,
            pText = self.st.deeplinking.prefix,
				    prefix = '#' + pText,
				    getSlideIdByHash = function() {
    					var hash = window.location.hash;
    					if(hash && hash.indexOf(pText) > 0) {
    						hash = parseInt( hash.substring(prefix.length), 10 ); 
    						if(hash >= 0) {
    							return hash - 1;
    						}
    					}
    					return -1;
    				};


				var id = getSlideIdByHash();
				if(id !== -1) {
					self.st.startSlideId = id;
				}

				if(hashChange) {
					$(window).on('hashchange'+self.ns, function(e){
						if(!isBlocked) {
							var id = getSlideIdByHash();
              if(id < 0) {
                return;
              }
              if(id > self.numSlides - 1)
                id = self.numSlides - 1;
              self.goTo( id );
						}
					});
          self.ev.on('rsBeforeAnimStart', function() {
            if(hashTimeout) {
              clearTimeout(hashTimeout);
            }
            if(hashChangeTimeout) {
              clearTimeout(hashChangeTimeout);
            }
          });

  				self.ev.on('rsAfterSlideChange', function() {
  					if(hashTimeout) {
  						clearTimeout(hashTimeout);
  					}
            if(hashChangeTimeout) {
              clearTimeout(hashChangeTimeout);
            }
            hashChangeTimeout = setTimeout(function() {
              isBlocked = true;
              window.location.replace( (''+window.location).split('#')[0] + prefix + (self.currSlideId + 1) );
              hashTimeout = setTimeout(function() {
                isBlocked = false;
                hashTimeout = null;
              }, 60);
            }, 400);
  				
  				});
        }
        self.ev.on('rsBeforeDestroy', function() {
          hashChangeTimeout = null;
          hashTimeout = null;
          if(hashChange) {
            $(window).off('hashchange' + self.ns);
          }
        });
				
			}
		}
	});
	$.rsModules.deeplinking = $.rsProto._initDeeplinking;
})(jQuery);

/*!
 * jQuery hashchange event - v1.3 - 7/21/2010
 * http://benalman.com/projects/jquery-hashchange-plugin/
 * 
 * Copyright (c) 2010 "Cowboy" Ben Alman
 * Dual licensed under the MIT and GPL licenses.
 * http://benalman.com/about/license/
 */
(function($,window,undefined){
  '$:nomunge'; // Used by YUI compressor.
  
  // Reused string.
  var str_hashchange = 'hashchange',
    
    // Method / object references.
    doc = document,
    fake_onhashchange,
    special = $.event.special,
    
    // Does the browser support window.onhashchange? Note that IE8 running in
    // IE7 compatibility mode reports true for 'onhashchange' in window, even
    // though the event isn't supported, so also test document.documentMode.
    doc_mode = doc.documentMode,
    supports_onhashchange = 'on' + str_hashchange in window && ( doc_mode === undefined || doc_mode > 7 );
  
  // Get location.hash (or what you'd expect location.hash to be) sans any
  // leading #. Thanks for making this necessary, Firefox!
  function get_fragment( url ) {
    url = url || location.href;
    return '#' + url.replace( /^[^#]*#?(.*)$/, '$1' );
  };
 
  $.fn[ str_hashchange ] = function( fn ) {
    return fn ? this.bind( str_hashchange, fn ) : this.trigger( str_hashchange );
  };
  
  $.fn[ str_hashchange ].delay = 50;
 
  special[ str_hashchange ] = $.extend( special[ str_hashchange ], {
    
    // Called only when the first 'hashchange' event is bound to window.
    setup: function() {
      // If window.onhashchange is supported natively, there's nothing to do..
      if ( supports_onhashchange ) { return false; }
      
      // Otherwise, we need to create our own. And we don't want to call this
      // until the user binds to the event, just in case they never do, since it
      // will create a polling loop and possibly even a hidden Iframe.
      $( fake_onhashchange.start );
    },
    
    // Called only when the last 'hashchange' event is unbound from window.
    teardown: function() {
      // If window.onhashchange is supported natively, there's nothing to do..
      if ( supports_onhashchange ) { return false; }
      
      // Otherwise, we need to stop ours (if possible).
      $( fake_onhashchange.stop );
    }
    
  });
  
  // fake_onhashchange does all the work of triggering the window.onhashchange
  // event for browsers that don't natively support it, including creating a
  // polling loop to watch for hash changes and in IE 6/7 creating a hidden
  // Iframe to enable back and forward.
  fake_onhashchange = (function(){
    var self = {},
      timeout_id,
      
      // Remember the initial hash so it doesn't get triggered immediately.
      last_hash = get_fragment(),
      
      fn_retval = function(val){ return val; },
      history_set = fn_retval,
      history_get = fn_retval;
    
    // Start the polling loop.
    self.start = function() {
      timeout_id || poll();
    };
    
    // Stop the polling loop.
    self.stop = function() {
      timeout_id && clearTimeout( timeout_id );
      timeout_id = undefined;
    };
    
    // This polling loop checks every $.fn.hashchange.delay milliseconds to see
    // if location.hash has changed, and triggers the 'hashchange' event on
    // window when necessary.
    function poll() {
      var hash = get_fragment(),
        history_hash = history_get( last_hash );
      
      if ( hash !== last_hash ) {
        history_set( last_hash = hash, history_hash );
        
        $(window).trigger( str_hashchange );
        
      } else if ( history_hash !== last_hash ) {
        location.href = location.href.replace( /#.*/, '' ) + history_hash;
      }
      
      timeout_id = setTimeout( poll, $.fn[ str_hashchange ].delay );
    };
    
    window.attachEvent && !window.addEventListener && !supports_onhashchange && (function(){
      // Not only do IE6/7 need the "magical" Iframe treatment, but so does IE8
      // when running in "IE7 compatibility" mode.
      
      var iframe,
        iframe_src;
      
      // When the event is bound and polling starts in IE 6/7, create a hidden
      // Iframe for history handling.
      self.start = function(){
        if ( !iframe ) {
          iframe_src = $.fn[ str_hashchange ].src;
          iframe_src = iframe_src && iframe_src + get_fragment();
          
          // Create hidden Iframe. Attempt to make Iframe as hidden as possible
          // by using techniques from http://www.paciellogroup.com/blog/?p=604.
          iframe = $('<iframe tabindex="-1" title="empty"/>').hide()
            
            // When Iframe has completely loaded, initialize the history and
            // start polling.
            .one( 'load', function(){
              iframe_src || history_set( get_fragment() );
              poll();
            })
            
            // Load Iframe src if specified, otherwise nothing.
            .attr( 'src', iframe_src || 'javascript:0' )
            
            // Append Iframe after the end of the body to prevent unnecessary
            // initial page scrolling (yes, this works).
            .insertAfter( 'body' )[0].contentWindow;
          
          // Whenever `document.title` changes, update the Iframe's title to
          // prettify the back/next history menu entries. Since IE sometimes
          // errors with "Unspecified error" the very first time this is set
          // (yes, very useful) wrap this with a try/catch block.
          doc.onpropertychange = function(){
            try {
              if ( event.propertyName === 'title' ) {
                iframe.document.title = doc.title;
              }
            } catch(e) {}
          };
          
        }
      };
      
      // Override the "stop" method since an IE6/7 Iframe was created. Even
      // if there are no longer any bound event handlers, the polling loop
      // is still necessary for back/next to work at all!
      self.stop = fn_retval;
      
      // Get history by looking at the hidden Iframe's location.hash.
      history_get = function() {
        return get_fragment( iframe.location.href );
      };
      
      // Set a new history item by opening and then closing the Iframe
      // document, *then* setting its location.hash. If document.domain has
      // been set, update that as well.
      history_set = function( hash, history_hash ) {
        var iframe_doc = iframe.document,
          domain = $.fn[ str_hashchange ].domain;
        
        if ( hash !== history_hash ) {
          // Update Iframe with any initial `document.title` that might be set.
          iframe_doc.title = doc.title;
          
          // Opening the Iframe's document after it has been closed is what
          // actually adds a history entry.
          iframe_doc.open();
          
          // Set document.domain for the Iframe document as well, if necessary.
          domain && iframe_doc.write( '<script>document.domain="' + domain + '"</script>' );
          
          iframe_doc.close();
          
          // Update the Iframe's hash, for great justice.
          iframe.location.hash = hash;
        }
      };
      
    })();
    
    return self;
  })();
  
})(jQuery,this);
