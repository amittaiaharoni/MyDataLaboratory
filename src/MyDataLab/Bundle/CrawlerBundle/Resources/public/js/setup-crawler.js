/*jslint browser: true */
/*global $, XPathResult */
(function () {
    "use strict";
    var ElementSelector = function (siteId, iframeId, layerId, layerPropertyId, menuId) {
        //constants
        var that = this;
        this.SITE_ID = siteId;
        this.$iframe = $('#' + iframeId);
        this.$iframeBody = this.$iframe.contents().find('body');
        this.$layerSelector = $('#' + layerId);
        this.$layerPropertySelector = $('#' + layerPropertyId);
        this.$elementsMenu = $('#' + menuId);
        this.siteProperties = {};
        this.$iframeWindow = $(document.getElementById(iframeId).contentWindow);
        this.iframeDocument = document.getElementById(iframeId).contentWindow.document;
        this.activeSelectorSet = false;
        this.scrollTop = 0;
        this.getElementByXPath = function getElementByXPath(xpath) {
            if (!xpath) {
                return null;
            }
            return $(that.iframeDocument.evaluate(xpath, that.iframeDocument, null, XPathResult.FIRST_ORDERED_NODE_TYPE, null).singleNodeValue);
        };
        this.initHover = function initHover() {
            var timeout, timeout2, $target, target;
            this.$iframeBody.on('mouseover', '*', function (e) {
                $target = $(e.target);
                target = e.target;
                clearTimeout(timeout);
                timeout = setTimeout(function () {
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
                .on('mousemove', function () {
                    clearTimeout(timeout2);
                    timeout2 = setTimeout(function () {
                        that.$layerSelector.hide();
                    }, 250);
                })
                .on('click', function () {
                    var elementXpath = that.getXpath(target),
                        $activeItem = that.$elementsMenu.find('.active');
                    that.activeSelectorSet = true;
                    $activeItem.attr('data-xpath', elementXpath).data('xpath', elementXpath);

                    if (!$activeItem.data('image')) {
                        $activeItem.find('input').val(
                            that.getText($(target))
                        );
                    } else {
                        $activeItem.find('img').attr('src', $(target).attr('src'));
                    }
                    that.setActiveSelector(elementXpath);
                });
        };

        this.getText = function getText(el) {
            var text = $.trim($(el).text()),
                $nodes =  $(el).find('*');
            $nodes.each(function (element) {
                text += $.trim($(element).text());
            });
            return $.trim(text).replace(/'\s{2,}/g, '');
        };

        this.getXpath = function getXpath(el) {
            if (typeof el === 'string') {
                return that.iframeDocument.evaluate(el, document, null, 0, null);
            }
            if (!el || el.nodeType !== 1) {
                return '';
            }
            if (el.id) {
                return "//*[@id='" + el.id + "']";
            }
            var sames = [].filter.call(el.parentNode.children, function (x) {
                return x.tagName === el.tagName;
            });
            return this.getXpath(el.parentNode) + '/' + el.tagName.toLowerCase() + (sames.length > 1 ? '[' + ([].indexOf.call(sames, el) + 1) + ']' : '');
        };

        this.initMenu = function () {
            this.$elementsMenu.find('li').each(function () {
                var selectorID = $(this).data('selectorid');

                that.siteProperties[selectorID] = $(this).data('xpath');

                $(this).on('click', function () {
                    if ($(this).hasClass('active')) {
                        $(this).removeClass('active');
                        that.setActiveSelector(null);
                        return;
                    }
                    $(this).addClass('active').siblings('.active').removeClass('active');
                    that.activeSelectorSet = false;
                    that.setActiveSelector($(this).data('xpath'));
                    that.initHover();
                });
            });
            this.$elementsMenu.find('.btn').on('click', function () {
                that.$elementsMenu.toggleClass('active');
            });
        };
        this.setActiveSelector = function setActiveSelector(elxpath) {
            var element;
            if (elxpath) {
                element = that.getElementByXPath(elxpath);
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
                $(document.getElementById(iframeId).contentWindow).scroll(function () {
                    that.scrollTop = that.$iframeWindow.scrollTop();
                    that.$layerPropertySelector.css({
                        top: element.offset().top - that.scrollTop
                    });
                });
            } else {
                that.$layerPropertySelector.hide();
            }
            //TODO ajax
            $.ajax({
                type: 'POST',
                url: that.$iframe.data('submitUrl'),
                data: {
                    retailerId: that.SITE_ID,
                    settings: this.$elementsMenu.find('li').map(function () {
                        var $t = $(this);
                        return {
                            xpath: $t.data('xpath'),
                            selectorId: $t.data('selectorid')
                        };
                    }).get()
                }
            });
        };

        this.initValues = function initValues() {
            this.$elementsMenu.find('li').each(function () {
                var $t = $(this),
                    xpath = $t.data('xpath'),
                    $el = that.getElementByXPath(xpath);
                if ($t.data('image')) {
                    $t.find('img').attr('src', $el.attr('src'));
                } else {
                    $t.find('input').val(that.getText($el));
                }
            });
        };
        this.init = function init() {
            this.initMenu();
            this.initValues();
        };
        
        this.init();
    };

    $(function () {
        $('#iframeSite').on('load', function () {
            var s = document.location.href.split('/'),
                elementSelector =  new ElementSelector(parseInt(s[s.length - 2], 10), 'iframeSite', 'layerSelector', 'layerPropertySelector', 'elementsMenu');
        });
    });
}());