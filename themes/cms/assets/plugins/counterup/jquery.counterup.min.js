/*!
* jquery.counterup.js 1.0
*
* Copyright 2013, Benjamin Intal http://gambit.ph @bfintal
* Released under the GPL v2 License
*
* Date: Nov 26, 2013
*/
!function(t){"use strict";t.fn.counterUp=function(e){var n=t.extend({time:400,delay:10},e);return this.each(function(){var e=t(this),u=n,a=function(){var t=u.time/u.delay,n=e.text(),a=[n],r=/[0-9]+,[0-9]+/.test(n);n=n.replace(/,/g,"");for(var o=(/^[0-9]+$/.test(n),/^[0-9]+\.[0-9]+$/.test(n)),c=o?(n.split(".")[1]||[]).length:0,i=t;i>=1;i--){var s=parseInt(n/t*i);if(o&&(s=parseFloat(n/t*i).toFixed(c)),r)for(;/(\d+)(\d{3})/.test(s.toString());)s=s.toString().replace(/(\d+)(\d{3})/,"$1,$2");a.unshift(s)}e.data("counterup-nums",a),e.text("0");var d=function(){e.text(e.data("counterup-nums").shift()),e.data("counterup-nums").length?setTimeout(e.data("counterup-func"),u.delay):(delete e.data("counterup-nums"),e.data("counterup-nums",null),e.data("counterup-func",null))};e.data("counterup-func",d),setTimeout(e.data("counterup-func"),u.delay)};e.waypoint(a,{offset:"100%",triggerOnce:!0})})}}(jQuery);