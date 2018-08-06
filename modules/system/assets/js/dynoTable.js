$(document).ready(function() {
    (function($){
        $.fn.extend({
            dynoTable: function(options) {

                var defaults = {
                    removeClass: '.row-remover',
                    cloneClass: '.row-cloner',
                    addRowTemplateId: '#add-template',
                    addRowButtonId: '#add-row',
                    lastRowRemovable: true,
                    orderable: true,
                    dragHandleClass: ".drag-handle",
                    insertFadeSpeed: "slow",
                    removeFadeSpeed: "fast",
                    hideTableOnEmpty: true,
                    onRowRemove: function(){},
                    onRowClone: function(clonedRow){},
                    onRowAdd: function(){},
                    onTableEmpty: function(){},
                    onRowReorder: function(){}
                };

                options = $.extend(defaults, options);

                var cloneRow = function(btn) {
                    var clonedRow = $(btn).closest('tr').clone();
                    var tbod = $(btn).closest('tbody');
                    insertRow(clonedRow, tbod);
                    options.onRowClone(clonedRow);
                }

                var insertRow = function(clonedRow, tbod) {
                    var numRows = $(tbod).children("tr").length;
                    if(options.hideTableOnEmpty && numRows == 0) {
                        $(tbod).parents("table").first().show();
                    }

                    $(clonedRow).find('*').andSelf().filter('[id]').each( function() {
                        //change to something else so we don't have ids with the same name
                        this.id += '__c';
                    });

                    //finally append new row to end of table
                    $(tbod).append( clonedRow );
                    bindActions(clonedRow);
                    $(tbod).children("tr:last").hide().fadeIn(options.insertFadeSpeed);
                }

                var removeRow = function(btn) {
                    var tbod = $(btn).parents("tbody:first");
                    var numRows = $(tbod).children("tr").length;

                    if(numRows > 1 || options.lastRowRemovable === true) {
                        var trToRemove = $(btn).parents("tr:first");
                        $(trToRemove).fadeOut(options.removeFadeSpeed, function() {
                            $(trToRemove).remove();
                            options.onRowRemove();
                            if(numRows == 1) {
                                if(options.hideTableOnEmpty) {
                                    $(tbod).parents('table').first().hide();
                                }
                                options.onTableEmpty();
                            }
                        });
                    }
                }

                var bindClick = function(elem, fn) {
                    $(elem).click(fn);
                }

                var bindCloneLink = function(lnk) {
                    bindClick(lnk, function(){
                        var btn = $(this);
                        cloneRow(btn);
                        return false;
                    });
                }

                var bindRemoveLink = function(lnk) {
                    bindClick(lnk, function(){
                        var btn = $(this);
                        removeRow(btn);
                        return false;
                    });
                }

                var bindActions = function(obj) {
                    obj.find(options.removeClass).each(function() {
                        bindRemoveLink($(this));
                    });

                    obj.find(options.cloneClass).each(function() {
                        bindCloneLink($(this));
                    });
                }

                return this.each(function() {
                    //Sanity check to make sure we are dealing with a single case
                    if(this.nodeName.toLowerCase() == 'table') {
                        var table = $(this);
                        var tbody = $(table).children("tbody").first();

                        if(options.orderable && jQuery().sortable) {
                            $(tbody).sortable({
                                handle : options.dragHandleClass,
                                helper:  function(e, ui) {
                                    ui.children().each(function() {
                                        $(this).width($(this).width());
                                    });
                                    return ui;
                                },
                                items: "tr",
                                update : function (event, ui) {
                                    options.onRowReorder();
                                }
                            });
                        }

                        $(table).find(options.addRowTemplateId).each(function(){
                            $(this).removeAttr("id");
                            var tmpl = $(this);
                            tmpl.remove();
                            bindClick($(options.addRowButtonId), function(){
                                var newTr = tmpl.clone();
                                insertRow(newTr, tbody);
                                options.onRowAdd();
                                return false;
                            });
                        });
                        bindActions(table);

                        var numRows = $(tbody).children("tr").length;
                        if(options.hideTableOnEmpty && numRows == 0) {
                            $(table).hide();
                        }
                    }
                });
            }
        });
    })(jQuery);

    /*
     * dynoTable configuration options
     * These are the options that are available with their default values
     */
    $('#add_prop').dynoTable({
        removeClass: '.row-remover', //class for the clickable row remover
        cloneClass: '.row-cloner', //class for the clickable row cloner
        addRowTemplateId: '#add-template', //id for the "add row template"
        addRowButtonId: '#add-row', //id for the clickable add row button, link, etc
        lastRowRemovable: true, //If true, ALL rows in the table can be removed, otherwise there will always be at least one row
        orderable: true, //If true, table rows can be rearranged
        dragHandleClass: ".drag-handle", //class for the click and draggable drag handle
        insertFadeSpeed: "slow", //Fade in speed when row is added
        removeFadeSpeed: "fast", //Fade in speed when row is removed
        hideTableOnEmpty: true, //If true, table is completely hidden when empty
        onRowRemove: function() {
            //Do something when a row is removed
        },
        onRowClone: function(clonedRow) {
            //Do something when a row is cloned
            clonedRow.find('input[name="SettingFiles[setting_files_id][]"]').val("");
        },
        onRowAdd: function() {
            //Do something when a row is added
        },
        onTableEmpty: function() {
            //Do something when ALL rows have been removed
        },
        onRowReorder: function() {
            //Do something when table rows have been rearranged
        }
    });
});