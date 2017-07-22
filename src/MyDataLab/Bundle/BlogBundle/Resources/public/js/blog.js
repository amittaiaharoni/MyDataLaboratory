/*global FormData */
(function (window) {
    "use strict";
    var $ = window.jQuery,
        tinymce = window.tinymce,
        FileReader = window.FileReader,
        PopupBlog = function PopupBlog(id, triggers, dataTable) {
            var model = {},
                that = this;
            this.id = id;
            this.popupContainer = $('#' + id);
            this.popupContainerClose = this.popupContainer.find('.close');

            this.popupPostURL = $('#post_slug').removeData('locked').on('input', function () {
                $(this).data('locked', 1);
            });
            this.popupPostTitle = $('#post_title').on('input', function () {
                if (!that.popupPostURL.data('locked')) {
                    that.popupPostURL.val(MDL.slugify(this.value));
                }
            });
            this.popupPostImage = $('#post_image');
            this.popupPostImageText = $('#post-image-value');
            this.popupPostImageValue = '';

//            this.popupPostURLValue = '';
            this.popupPostMetaDescription = $('#post_metaDescription');
//            this.popupPostMetaDescriptionValue = '';

            this.popupPostMetaKeywords = $('#post_keywords');
//            this.popupPostMetaKeywordsValue = '';

            this.popupPostTags = $('#post_tags');
//            this.popupPostTagsValue = '';

            this.popupPostDescription = $('#post_content');

            this.popupPostSave = $('#post_submit');
            this.popupPostSavePrompt = $('#post-save-prompt');
            this.popupPostForm = $('#popup-post-content').on('input', 'input, textarea', function () {
                model._dirty = true;
            });
            this.popupContinueEditing = $('#continue-edit');
            this.popupCloseWithoutSave = $('#close-without-save');
            this.popupSaveAndClose = $('#save-and-close');
            this.popupEditWrapper = $('#popup-post-edit-wrapper');
            this.popupDeletePostWrapper = $('#popup-post-delete-wrapper');
            this.popupButtonConfirmDelete = $('#btn-confirm-delete');
            this.popupButtonCancelDelete = $('#btn-cancel-delete');
            this.popupError = $('#popup-error');
            this.postLangauge = $('#post_language');
            this.postValid = false;
            this.fillPopup = function fillPopup(m) {
                model = m || {};
                this.popupPostTitle.val(model.title || '');
                this.popupPostURL.val(model.slug || '');
                this.popupPostMetaKeywords.val((model.keywords && model.keywords.map(function (keyword) {
                    return keyword.name;
                }).join(', ')) || '');
                this.popupPostTags.val((model.tags && model.tags.map(function (tag) {
                    return tag.name;
                }).join(', ')) || '');
                this.popupPostMetaDescription.val(model.metaDescription || '');
//                this.popupPostDescription.html(model.content || '');
                that.popupPostImageValue = model.image || '';
                this.popupPostImageText.text(model.image || '');
                this.postLangauge.val((model.language && model.language.id) || '');
                tinymce.get('post_content').setContent(model.content || '');
                this.popupPostDescription.html(model.content || '');
                
            };
            this.showPopup = function showPopup(el) {
                var rowData, selector,
                    rowElement = $(el).closest('tr');

                this.popupPostSavePrompt.removeClass('visible');
                this.popupError.hide();

                this.popupPostImage.unbind('change');
                this.popupPostImage.on('change', function () {
                    var parts = that.popupPostImage.val().split(/\\|\//);
                    that.popupPostImageText.text(parts[parts.length - 1]);
                });
                this.popupContinueEditing.unbind('click').on('click', function () {
                    that.hideSavePrompt();
                });

                this.popupCloseWithoutSave.unbind('click').on('click', function () {
                    that.hideSavePrompt();
                    that.hidePopup(true);
                });
                this.popupContainerClose.unbind('click').on('click', function () {
                    that.hidePopup(false);
                });

                if ($(el).data('edit')) {
                    $.ajax({
                        type: 'GET',
                        url: $(el).closest('tr').data('getUrl'),
                        success: function (response) {
                            if (response.data) {
                                that.fillPopup(response.data);
                            }
                        }
                    });
//                    rowData = dataTable.row($(el).closest('tr')).data();
//                    selector = this.popupPostDescription.selector;
//
//                    this.popupPostTitle.val(rowData[0]);
//                    this.popupPostTitleValue = this.popupPostTitle.val();
//
//                    this.popupPostImageText.html(rowData[1]);
//
//                    this.popupPostImageValue = this.popupPostImageText.html();
//
//                    this.popupPostURL.val(rowData[2]);
//                    this.popupPostURLValue = this.popupPostURL.val();
//
//                    this.popupPostMetaDescription.val(rowData[3]);
//                    this.popupPostMetaDescriptionValue = this.popupPostMetaDescription.val();
//
//                    this.popupPostMetaKeywords.val(rowData[4]);
//                    this.popupPostMetaKeywordsValue = this.popupPostMetaKeywords.val();
//
//                    this.popupPostTags.val(rowData[5]);
//                    this.popupPostTagsValue = this.popupPostTags.val();
//
//                    this.popupPostDescription.html(rowData[8]);
//
//                    tinymce.get('post_content').setContent($(selector).html());
//
//                    tinymce.activeEditor.save();
//
                    this.popupEditWrapper.show();
                    this.popupDeletePostWrapper.hide();
//
                    this.popupContainer.addClass('visible');
//
                    this.popupPostTitle.focus();
                    this.initSave(rowElement, false);
                }

                if ($(el).data('delete')) {
                    this.popupEditWrapper.hide();
                    this.popupDeletePostWrapper.show();
                    this.popupContainer.addClass('visible');
                    this.initDelete(rowElement);
                }

                if ($(el).data('add-article')) {
                    this.popupEditWrapper.show();
                    this.popupDeletePostWrapper.hide();
                    this.popupPostImageText.html('');
                    model = {};
//                    this.popupPostTitleValue =
//                        this.popupPostURLValue =
//                        this.popupPostMetaDescriptionValue =
//                        this.popupPostMetaKeywordsValue =
//                        this.popupPostTagsValue =
//                        this.popupPostImageValue = '';
                    this.fillPopup();
                    tinymce.get('post_content').setContent('');
                    tinymce.activeEditor.save();

//                    this.popupPostTitle
//                        .add(this.popupPostURL)
//                        .add(this.popupPostMetaDescription)
//                        .add(this.popupPostMetaKeywords)
//                        .add(this.popupPostTags)
//                        .add(this.popupPostDescription)
//                        .add(this.popupPostImage)
//                        .val('');

                    this.popupContainer.addClass('visible');
                    this.popupPostTitle.focus();
                    this.initSave(rowElement, true);
                }
            };

            this.hidePopup = function hidePopup(saveClicked) {
                if (!saveClicked) {
                    if (tinymce.activeEditor.isDirty() || model._dirty) {
                        this.showSavePrompt();
                    } else {
                        this.popupContainer.removeClass('visible');
                    }
                } else {
                    this.popupContainer.removeClass('visible');
                }
            };

            this.validatePost = function validatePost() {
                //validations
                this.postValid = this.popupPostTitle.val()
                    && tinymce.get('post_content').getContent()
                    && this.popupPostImageText.html()
                    && this.popupPostURL.val()
                    && this.popupPostMetaDescription.val()
                    && this.popupPostMetaKeywords.val()
                    && this.popupPostTags.val();
                this.popupError.toggle(!this.postValid);
            };

            this.initSave = function (row, newArticle) {
                this.popupPostSave.add(this.popupSaveAndClose).unbind('click').on('click', function (e) {
                    e.preventDefault();
                    that.hideSavePrompt();
                    that.validatePost();
                    if (that.postValid) {
                        if (newArticle) {
                            $.ajax({
                                url: that.popupPostForm.data('createUrl'),
                                method: 'POST',
                                data: new FormData(that.popupPostForm.get(0)),//.serializeObject(),
                                success: function (response) {
                            //@todo add a row on success
    //                            dataTable.row.add([
    //                                that.popupPostTitle.val(),
    //                                that.popupPostImage.val(),
    //                                that.popupPostURL.val(),
    //                                that.popupPostMetaDescription.val(),
    //                                that.popupPostMetaKeywords.val(),
    //                                that.popupPostTags.val(),
    //                                date.getDate(),
    //                                date.getDate(),
    //                                tinymce.get('post_content').getContent(),
    //                                ''
    //                            ]).draw();
                                    that.hidePopup(true);
                                    window.location.reload(true);
                                },
                                // Options to tell jQuery not to process data or worry about the content-type
                                cache: false,
                                contentType: false,
                                processData: false
                            });
                        } else {
                            $.ajax({
                                url: row.data().updateUrl,
                                method: 'POST',
                                data: new FormData(that.popupPostForm.get(0)),//.serializeObject(),
                                success: function (response) {
                                    that.hidePopup(true);
                                    window.location.reload(true);
//                                dataTable.cell(row.index(), 0).data(that.popupPostTitle.val());
//                                dataTable.cell(row.index(), 1).data(that.popupPostImageText.text());
//                                dataTable.cell(row.index(), 2).data(that.popupPostURL.val());
//                                dataTable.cell(row.index(), 3).data(that.popupPostMetaDescription.val());
//                                dataTable.cell(row.index(), 4).data(that.popupPostMetaKeywords.val());
//                                dataTable.cell(row.index(), 5).data(that.popupPostTags.val());
//                                dataTable.cell(row.index(), 8).data(tinymce.get('post_content').getContent());
                                },
                                // Options to tell jQuery not to process data or worry about the content-type
                                cache: false,
                                contentType: false,
                                processData: false
                            });
                        }
//                    if (that.postValid) {
//                        that.hidePopup(true);
                    }
                });
            };
            this.initDelete = function initDelete(row) {
                this.popupButtonCancelDelete.on('click', function () {
                    that.hidePopup(true);
                });
                this.popupButtonConfirmDelete.unbind('click');
                this.popupButtonConfirmDelete.on('click', function () {
                    that.hidePopup(true);
                    $.ajax({
                        method: 'DELETE',
                        url: row.data().deleteUrl,
                        success: function (response) {
//                            dataTable.row(row).remove().draw();
                            window.location.reload(true);
                        }
                    });
                });
            };

            this.addTriggers = function addTriggers() {
                triggers.forEach(function (el) {
                    $('body').on('click', el, function (event) {
                        that.showPopup(event.target);
                    });
                });
            };

            this.showSavePrompt = function () {
                this.popupPostSavePrompt.addClass('visible');
            };

            this.hideSavePrompt = function () {
                this.popupPostSavePrompt.removeClass('visible');
            };

            this.init = function () {
                this.addTriggers();
            };

            this.init();
        };
    $.fn.serializeObject = function () {
        var o = {},
            a = this.serializeArray();
        $.each(a, function () {
            if (o[this.name] !== undefined) {
                if (!o[this.name].push) {
                    o[this.name] = [o[this.name]];
                }
                o[this.name].push(this.value || '');
            } else {
                o[this.name] = this.value || '';
            }
        });
        return o;
    };
    $(function () {
        var popupBlog;
//            blogPostsTable = $('#blog-posts').DataTable({
//                ordering: false,
//                columnDefs: [{
//                    targets: [-1],
//                    data: null,
////                    defaultContent: "<button class='btn btn-default edit-post' data-edit='true'>Edit</button>&nbsp;<button class='btn btn-default delete-post' data-delete='true'>Delete</button>",
//                    searchable: false,
//                    sortable: false
//                }]
//            });

        tinymce.init({
            selector: '#post_content',
            height: 250,
            theme: 'modern',
            paste_data_images: true,
            setup: function (editor) {
                editor.on('change', function () {
                    editor.save();
                });
            },
            plugins: [
                'advlist autolink lists link image charmap preview hr anchor pagebreak',
                'searchreplace wordcount visualblocks visualchars code fullscreen',
                'insertdatetime media nonbreaking save table contextmenu directionality',
                'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc youtube'
            ],
            file_picker_callback: function (callback, value, meta) {
                /*jslint unparam: true */
                if (meta.filetype === 'image') {
                    $('#image-upload').trigger('click');
                    $('#image-upload').on('change', function () {
                        var file = this.files[0],
                            reader = new FileReader();
                        reader.onload = function (e) {
                            callback(e.target.result, {
                                alt: ''
                            });
                        };
                        reader.readAsDataURL(file);
                    });
                }

                if (meta.filetype === 'media') {
                    $('#image-upload').trigger('click');
                    $('#image-upload').on('change', function () {
                        var file = this.files[0],
                            reader = new FileReader();
                        reader.onload = function (e) {
                            callback(e.target.result, {
                                alt: ''
                            });
                        };
                        reader.readAsDataURL(file);
                    });
                }
            },
            menubar: false,
            toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent ',
            toolbar2: 'preview | forecolor backcolor emoticons codesample youtube',
            insert_button_items: 'link image charmap hr anchor pagebreak insertdate inserttime nonbreaking',
            image_advtab: true
        });

        popupBlog = new PopupBlog('popup-page', ['.edit-post', '.delete-post', '#add-article']/*, blogPostsTable*/);

    });

        // $(function () {
        //   tinymce.init({ 
        //     selector:'#post-content',
        //     menubar: false
        //   });
        //   var jqxhr,
        //   popup = popup || $('#popup-page'),

        //   blogPostsTable = $('#blog-posts').DataTable({
        //     "columnDefs": [ 
        //         {
        //           "targets": [-1],
        //           "data": null,
        //           "defaultContent": "<button class='btn btn-default edit-post'>Edit</button>&nbsp;<button class='btn btn-default delete-post'>Delete</button>",
        //           "searchable": false,
        //           "sortable": false
        //         },
        //         {
        //           "targets": [3],
        //           visible: false
        //         }  
        //     ]
        //   });


        //   $('#blog-posts').on('click', '.edit-post', function () {
        //   // var d = blogPostsTable.row(this).data();
        //   // console.log(d);

        //         var rowData = blogPostsTable.row( $(this).closest('tr') ).data();

        //         // popup.show({
        //         //   type: 'bla',
        //         //   data: rowData
        //         // })
        //         console.log(popup);

        //         popup.addClass('visible');

        //         console.log(rowData);

        //     });

        /*jqxhr = $.get( "blog-test.json", function() {})
         .done(function(data) {
         var dataSet = data.result,
             
         blogPostsTable = $('#blog-posts').DataTable({
         // data: dataSet,
         "columnDefs": [ 
         {
         "targets": -1,
         "data": null,
         "defaultContent": "<button class='btn btn-default edit-post'>Edit</button>&nbsp;<button class='btn btn-default'>Delete</button>",
         "searchable": false,
         "sortable": false
         },
         {
         "targets": 3,
         visible: false
         }  
         ],
         "initComplete": function() {
             
         }
         })
             
             
             
         $('#blog-posts').on('click', '.edit-post', function () {
         // var d = blogPostsTable.row(this).data();
         // console.log(d);
             
         var rowData = blogPostsTable.row( $(this).closest('tr') ).data();
             
         popup.show({
         type: 'bla',
         data: rowData
         })
             
         console.log(rowData);
             
         });
             
             
             
             
         })
         .fail(function() {        
         throw new Error('incorrect url you asshole');
         })
         .always(function() {
         //  
         });
         */

        // });
}(this));