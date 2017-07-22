(function() {    
    var ElementSelector = function(siteId, iframeId, layerId, layerPropertyId, menuId) {
        'use strict';
        //constants
        var that = this;
        this.SITE_ID = 'www.site.com/' + siteId;
        this.$iframe = $('#' + iframeId);
        this.$iframeBody = this.$iframe.contents().find('body');
        this.$layerSelector = $('#' + layerId);
        this.$layerPropertySelector = $('#' + layerPropertyId)
        this.$elementsMenu = $('#' + menuId);
        this.siteProperties = {};
        this.$iframeWindow = $(document.getElementById(iframeId).contentWindow);
        this.iframeDocument = document.getElementById(iframeId).contentWindow.document;
        this.activeSelectorSet = false;
        this.scrollTop = 0;

        this.initHover = function() {
            var timeout, timeout2, $target, target;     

            this.$iframeBody.on('mouseover', '*', function(e) {
                $target = $(e.target);
                target = e.target;

                clearTimeout(timeout);

                timeout = setTimeout(function() {

                    that.scrollTop = that.$iframeBody.scrollTop();

                    $target = $(that.iframeDocument.elementFromPoint(e.pageX, e.pageY - that.scrollTop));

                    that.$layerSelector.css({
                        display: 'block',
                        top: $target.offset().top - that.scrollTop,
                        left: $target.offset().left,
                        width: $target.outerWidth(),
                        height: $target.outerHeight()
                    });
                    
                }, 300);


            });

            this.$layerSelector
                .on('mousemove', function() {
                    clearTimeout(timeout2);

                    timeout2 = setTimeout(function() {
                        that.$layerSelector.hide();
                    }, 250);
                })
                .on('click', function(e) {
                    var elementXpath = that.getXpath(target);
                    that.activeSelectorSet = true; 
                    var $activeItem = that.$elementsMenu.find('.active');
                    
                    $activeItem.attr('data-xpath', elementXpath).data('xpath', elementXpath);

                    if (!$activeItem.data('image')) {
                        $activeItem.find('input').val(
                            that.getText( $(target) ) 
                        );
                    } else {
                        $activeItem.find('img').attr( 'src', $(target).attr('src') );
                    }
                    
                    that.setActiveSelector(elementXpath);
                });
        };

        this.getText = function(el) {
            var text = $.trim( $(el).text() ),
            nodes =  $(el).find('*');
            
            nodes.each(function(element) {
                text += $.trim( $(element).text() );
            });

            return $.trim(text).replace(/  /g,'');
        }
        
        this.getXpath = function(el) {
            if (typeof el == 'string') return that.iframeDocument.evaluate(el, document, null, 0, null);
            if (!el || el.nodeType != 1) return '';
            if (el.id) return "//*[@id='" + el.id + "']";
            var sames = [].filter.call(el.parentNode.children, function (x) { return x.tagName == el.tagName });
            return this.getXpath(el.parentNode) + '/' + el.tagName.toLowerCase() + (sames.length > 1 ? '['+([].indexOf.call(sames, el)+1)+']' : '');
        }

        this.initMenu = function() { 
            this.$elementsMenu.find('li').each(function(index, el) {
                var selectorID = $(this).data('selectorid');

                that.siteProperties[selectorID] = $(this).data('xpath');

                $(this).on('click', function(e) {        

                    if (!$(this).hasClass('active')) {
                        that.$elementsMenu.find('.active').removeClass('active');
                    }

                    $(this).addClass('active');
                
                    that.activeSelectorSet = false;
                    that.setActiveSelector($(this).data('xpath'));
                    that.initHover();

                });                
            });

            this.$elementsMenu.find('.btn').on('click', function() {
                that.$elementsMenu.toggleClass('active');
            });

        }

        this.setActiveSelector = function(elxpath) {

            if (elxpath) {
                var element = $(that.iframeDocument.evaluate(elxpath, that.iframeDocument, null, XPathResult.FIRST_ORDERED_NODE_TYPE, null).singleNodeValue);
                that.scrollTop = that.$iframeWindow.scrollTop();
                if (!this.activeSelectorSet) {
                    //when menu item is clicked
                    this.activeSelectorSet = true;

                    this.$layerPropertySelector.show().css({
                        top: element.offset().top - that.scrollTop,
                        left: element.offset().left,
                        width: element.outerWidth(),
                        height: element.outerHeight()
                    });
                } else {
                    //when site element is clicked
                    this.$layerPropertySelector.show().css({
                        top: that.$layerSelector.offset().top,
                        left: that.$layerSelector.offset().left,
                        width: that.$layerSelector.outerWidth(),
                        height: that.$layerSelector.outerHeight()
                    });   
                }
            } else {
                that.$layerPropertySelector.hide();
            }

            $(document.getElementById(iframeId).contentWindow).scroll(function() {
                that.scrollTop = that.$iframeWindow.scrollTop();
                that.$layerPropertySelector.css({
                    top: element.offset().top - that.scrollTop
                });
            });

            //TODO ajax
            
        }

        this.init = function() {
            this.initMenu();
        }

        this.init();
    }

    $(function() {
        var iframe = document.getElementById('iframeSite'),
        elementSelector,
        URL = 'testsite/index.html';
        iframe.src = URL;

        $('#iframeSite').on('load',function(){
            elementSelector =  new ElementSelector(1, 'iframeSite', 'layerSelector', 'layerPropertySelector', 'elementsMenu');
        });

    });

}());