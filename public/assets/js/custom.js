$(document).ready(function () {
    $('.f_button1').click(function () {
        $('.top_cotent_di1').toggle('slow');
    });
    $('.f_button2').click(function () {
        $('.top_cotent_di2').toggle('slow');
    });
    $('.f_button3').click(function () {
        $('.top_cotent_di3').toggle('slow');
    });
    $('.f_button4').click(function () {
        $('.top_cotent_di4').toggle('slow');
    });
    $('.f_button5').click(function () {
        $('.top_cotent_di5').toggle('slow');
    });
    $('.f_button6').click(function () {
        $('.top_cotent_di6').toggle('slow');
    });
});
/* custom js */
$(window).load(function () {
    setTimeout($('#myModal').modal('show'), 30000);
});
(function () {
    var Util,
            __bind = function (fn, me) {
                return function () {
                    return fn.apply(me, arguments);
                };
            };

    Util = (function () {
        function Util() {}

        Util.prototype.extend = function (custom, defaults) {
            var key, value;
            for (key in custom) {
                value = custom[key];
                if (value != null) {
                    defaults[key] = value;
                }
            }
            return defaults;
        };

        Util.prototype.isMobile = function (agent) {
            return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(agent);
        };

        return Util;

    })();

    this.WOW = (function () {
        WOW.prototype.defaults = {
            boxClass: 'wow',
            animateClass: 'animated',
            offset: 0,
            mobile: true
        };

        function WOW(options) {
            if (options == null) {
                options = {};
            }
            this.scrollCallback = __bind(this.scrollCallback, this);
            this.scrollHandler = __bind(this.scrollHandler, this);
            this.start = __bind(this.start, this);
            this.scrolled = true;
            this.config = this.util().extend(options, this.defaults);
        }

        WOW.prototype.init = function () {
            var _ref;
            this.element = window.document.documentElement;
            if ((_ref = document.readyState) === "interactive" || _ref === "complete") {
                return this.start();
            } else {
                return document.addEventListener('DOMContentLoaded', this.start);
            }
        };

        WOW.prototype.start = function () {
            var box, _i, _len, _ref;
            this.boxes = this.element.getElementsByClassName(this.config.boxClass);
            if (this.boxes.length) {
                if (this.disabled()) {
                    return this.resetStyle();
                } else {
                    _ref = this.boxes;
                    for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                        box = _ref[_i];
                        this.applyStyle(box, true);
                    }
                    window.addEventListener('scroll', this.scrollHandler, false);
                    window.addEventListener('resize', this.scrollHandler, false);
                    return this.interval = setInterval(this.scrollCallback, 50);
                }
            }
        };

        WOW.prototype.stop = function () {
            window.removeEventListener('scroll', this.scrollHandler, false);
            window.removeEventListener('resize', this.scrollHandler, false);
            if (this.interval != null) {
                return clearInterval(this.interval);
            }
        };

        WOW.prototype.show = function (box) {
            this.applyStyle(box);
            return box.className = "" + box.className + " " + this.config.animateClass;
        };

        WOW.prototype.applyStyle = function (box, hidden) {
            var delay, duration, iteration;
            duration = box.getAttribute('data-wow-duration');
            delay = box.getAttribute('data-wow-delay');
            iteration = box.getAttribute('data-wow-iteration');
            return box.setAttribute('style', this.customStyle(hidden, duration, delay, iteration));
        };

        WOW.prototype.resetStyle = function () {
            var box, _i, _len, _ref, _results;
            _ref = this.boxes;
            _results = [];
            for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                box = _ref[_i];
                _results.push(box.setAttribute('style', 'visibility: visible;'));
            }
            return _results;
        };

        WOW.prototype.customStyle = function (hidden, duration, delay, iteration) {
            var style;
            style = hidden ? "visibility: hidden; -webkit-animation-name: none; -moz-animation-name: none; animation-name: none;" : "visibility: visible;";
            if (duration) {
                style += "-webkit-animation-duration: " + duration + "; -moz-animation-duration: " + duration + "; animation-duration: " + duration + ";";
            }
            if (delay) {
                style += "-webkit-animation-delay: " + delay + "; -moz-animation-delay: " + delay + "; animation-delay: " + delay + ";";
            }
            if (iteration) {
                style += "-webkit-animation-iteration-count: " + iteration + "; -moz-animation-iteration-count: " + iteration + "; animation-iteration-count: " + iteration + ";";
            }
            return style;
        };

        WOW.prototype.scrollHandler = function () {
            return this.scrolled = true;
        };

        WOW.prototype.scrollCallback = function () {
            var box;
            if (this.scrolled) {
                this.scrolled = false;
                this.boxes = (function () {
                    var _i, _len, _ref, _results;
                    _ref = this.boxes;
                    _results = [];
                    for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                        box = _ref[_i];
                        if (!(box)) {
                            continue;
                        }
                        if (this.isVisible(box)) {
                            this.show(box);
                            continue;
                        }
                        _results.push(box);
                    }
                    return _results;
                }).call(this);
                if (!this.boxes.length) {
                    return this.stop();
                }
            }
        };

        WOW.prototype.offsetTop = function (element) {
            var top;
            top = element.offsetTop;
            while (element = element.offsetParent) {
                top += element.offsetTop;
            }
            return top;
        };

        WOW.prototype.isVisible = function (box) {
            var bottom, offset, top, viewBottom, viewTop;
            offset = box.getAttribute('data-wow-offset') || this.config.offset;
            viewTop = window.pageYOffset;
            viewBottom = viewTop + this.element.clientHeight - offset;
            top = this.offsetTop(box);
            bottom = top + box.clientHeight;
            return top <= viewBottom && bottom >= viewTop;
        };

        WOW.prototype.util = function () {
            return this._util || (this._util = new Util());
        };

        WOW.prototype.disabled = function () {
            return !this.config.mobile && this.util().isMobile(navigator.userAgent);
        };

        return WOW;

    })();

}).call(this);


wow = new WOW(
        {
            animateClass: 'animated',
            offset: 100
        }
);
wow.init();

$(window).scroll(function () {
    if ($(document).scrollTop() > 50) {
        $('nav').addClass('shrink');
    } else {
        $('nav').removeClass('shrink');
    }
});

// Idoag scripts

idoag = {
    addMoreWorkSamples: function(){
        var html_to_append = '<br/><div class="inenr_child row">\n\
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">\n\
                                        <input type="text" name="sample_name[]" placeholder="Work sample title"/>\n\
                                    </div>\n\
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">\n\
                                        <input type="text" name="sample_url[]" placeholder="Work sample data"/>\n\
                                    </div></div>';        
        $(".add_more_sample_works").append(html_to_append);
    },
    
    removeCustomSamples: function(ref){        
        $(ref).parent('p').parent('.inenr_child').remove();
    },
    
    addMoreAdditionalDetail: function(){
        var html_to_append = '<div class="inenr_child row">\n\
                                <p>Title</p>\n\
                                <input type="text" name="title[]" class="width_div">\n\
                                </div><div class="inenr_child row">\n\
                                <p>Details </p>\n\
                                <textarea rows="10" name="detail[]" class="with_border"></textarea>\n\
                                </div>';
        $(".more_additional_details_add").append(html_to_append);
    },
    
    removeAdditionalDetails: function(ref){
        $(ref).parent('p').parent('.inenr_child').parent('.single_add_detail').remove();
    },
    
    addproject: function(){
        var html_to_add = '<div class="inenr_child row">\n\
                        <p>Project Name</p>\n\
                        <input type="text" name="project_name[]" class="width_div">\n\
                     </div>\n\
                     <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">\n\
                        <div class="row personal_detail_inenr_child_left">\n\
                           <p>Duration</p>\n\
                           <input type="text" name="project_duration[]" class="width_div">\n\
                        </div>\n\
                     </div>\n\
                     <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">\n\
                        <div class="row personal_detail_inenr_child_right">\n\
                           <p>Guide/Indtructor Name</p>\n\
                           <input type="text" name="project_guide[]" class="width_div">\n\
                        </div>\n\
                     </div>\n\
                     <div class="clearfix"></div>\n\
                     <div class="inenr_child row">\n\
                        <p>Institute Name</p>\n\
                        <input type="text" name="project_institute_name[]" class="width_div">\n\
                     </div>\n\
                     <div class="inenr_child row">\n\
                        <p>Project Details </p>\n\
                        <textarea rows="10" name="project_details[]" class="with_border"></textarea>\n\
                     </div>';
        
        $(".add_more_projects").append(html_to_add);
    },
    
    addInternships: function(){
        var html_to_add = "<div class='inenr_child row'>\n\
                        <p>Profile/Job Title</p>\n\
                        <input type='text' name='internship_title[]' class='width_div'>\n\
                     </div>\n\
                     <div class='col-lg-6 col-md-6  col-sm-12 col-xs-12 '>\n\
                        <div class='personal_detail_inenr_child_left'>\n\
                           <div class='row  personal_detail_inenr_child'>\n\
                              <p>Joining Date</p>\n\
                              <div class='form-group'>\n\
                                  <input type='date' name='internship_joining_date[]' class='form-control' />\n\
                              </div>\n\
                           </div>\n\
                        </div>\n\
                     </div>\n\
                     <div class='col-lg-6 col-md-6 col-sm-12 col-xs-12 '>\n\
                        <div class='personal_detail_inenr_child_right'>\n\
                           <div class='row  personal_detail_inenr_child'>\n\
                              <p>Leaving Date</p>\n\
                              <div class='form-group'>\n\
                                 <input type='date' name='internship_leaving_date[]' class='form-control' />\n\
                              </div>\n\
                              <div class='xcxc'><input name='internship_currently_working[]' value='yes' type='checkbox' class='list-inline'><span class='list-inline'><b>Currently working here</b></span></label></div>\n\
                           </div>\n\
                        </div>\n\
                     </div>\n\
                     <div class='clearfix'></div>\n\
                     <div class='col-lg-6 col-md-6 col-sm-12 col-xs-12 '>\n\
                        <div class='row personal_detail_inenr_child_left'>\n\
                           <p>Company Name</p>\n\
                           <input type='text' name='internship_company_name[]' class='width_div'>\n\
                        </div>\n\
                     </div>\n\
                     <div class='col-lg-6 col-md-6 col-sm-12 col-xs-12 '>\n\
                        <div class='row personal_detail_inenr_child_right'>\n\
                           <p>Location</p>\n\
                           <input type='text' name='internship_location[]' class='width_div'>\n\
                        </div>\n\
                     </div>\n\
                     <div class='clearfix'></div>\n\
                     <div class='inenr_child row'>\n\
                        <p>Project Details </p>\n\
                        <textarea rows='10' name='internship_project_details[]' class='with_border'></textarea>\n\
                     </div>";
        $(".add_more_internships").append(html_to_add);
    },
    
    addMoreJobs: function(){
        var html_to_add = "<div class='inenr_child row '>\n\
                        <p>Profile/Job Title</p>\n\
                        <input type='text' name='job_title[]' class='width_div'>\n\
                     </div>\n\
                     <div class='col-lg-6 col-md-6  col-sm-12 col-xs-12 '>\n\
                        <div class='personal_detail_inenr_child_left'>\n\
                           <div class='row  personal_detail_inenr_child'>\n\
                              <p>Joining Date</p>\n\
                              <div class='form-group'>\n\
                                 <input type='date' name='job_joining_date[]' class='form-control' />\n\
                              </div>\n\
                           </div>\n\
                        </div>\n\
                     </div>\n\
                     <div class='col-lg-6 col-md-6 col-sm-12 col-xs-12 '>\n\
                        <div class='personal_detail_inenr_child_right'>\n\
                           <div class='row  personal_detail_inenr_child'>\n\
                              <p>Leaving Date</p>\n\
                              <div class='form-group'>\n\
                                 <input type='date' name='job_leaving_date[]' class='form-control' />\n\
                              </div>\n\
                              <input type='hidden' name='job_cureently_working[]' value='no'>\n\
                              <div class='xcxc'><input onclick='idoag.jobCurrentWorking(this)' type='checkbox' class='list-inline'><span class='list-inline'><b>Currently working here</b></span></label></div>\n\
                           </div>\n\
                        </div>\n\
                     </div>\n\
                     <div class='clearfix'></div>\n\
                     <div class='col-lg-6 col-md-6 col-sm-12 col-xs-12 '>\n\
                        <div class='row personal_detail_inenr_child_left'>\n\
                           <p>Company Name</p>\n\
                           <input type='text' name='job_company_name[]' class='width_div'>\n\
                        </div>\n\
                     </div>\n\
                     <div class='col-lg-6 col-md-6 col-sm-12 col-xs-12 '>\n\
                        <div class='row personal_detail_inenr_child_right'>\n\
                           <p>Location</p>\n\
                           <input type='text' name='job_location[]' class='width_div'>\n\
                        </div>\n\
                     </div>\n\
                     <div class='clearfix'></div>\n\
                     <div class='inenr_child row'>\n\
                        <p>Project Details </p>\n\
                        <textarea rows='10' name='job_project_details[]' class='with_border'></textarea>\n\
                     </div>";
        $(".add_more_jobs").append(html_to_add);
    },
    
    removeProject: function(ref){
        $(ref).parent('.inenr_child').parent('.inenr_child_title_row').parent('.single_project_detail').remove();
    },
    
    removeInternship: function(ref){
        $(ref).parent('.inenr_child').parent('.inenr_child_title_row').parent('.single_internship').remove();
    },
    
    removeJob: function(ref){
        $(ref).parent('.inenr_child').parent('.inenr_child_title_row').parent('.single_job_display').remove();
    },
    
    jobCurrentWorking: function(ref){
        if($(ref).prop('checked') == true)
            $(ref).parent('.xcxc').prev('input[type="hidden"]').val('yes');
        else
            $(ref).parent('.xcxc').prev('input[type="hidden"]').val('no');
    },
};