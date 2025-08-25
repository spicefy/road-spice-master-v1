jQuery(document).ready(function($) {
    // Initialize repeater controls
    $('.repeater-fields').each(function() {
        var $container = $(this);
        var rowLabel = $container.data('row-label');
        var fields = $container.data('fields');
        var $input = $container.siblings('.repeater-data');
        
        // Add new row
        $container.siblings('.repeater-add').on('click', function() {
            var newRow = {};
            $.each(fields, function(fieldId, field) {
                newRow[fieldId] = '';
            });
            $container.append(createRow(newRow));
            updateData();
        });
        
        // Remove row
        $container.on('click', '.repeater-row-remove', function() {
            $(this).closest('.repeater-row').remove();
            updateData();
        });
        
        // Media uploader
        $container.on('click', '.repeater-media-upload', function(e) {
            e.preventDefault();
            var $button = $(this);
            var $preview = $button.siblings('.repeater-media-preview');
            var $input = $button.siblings('.repeater-media-id');
            var $remove = $button.siblings('.repeater-media-remove');
            
            var frame = wp.media({
                title: 'Select or Upload Media',
                button: {
                    text: 'Use this media'
                },
                multiple: false
            });
            
            frame.on('select', function() {
                var attachment = frame.state().get('selection').first().toJSON();
                $input.val(attachment.id);
                $preview.html('<img src="' + attachment.url + '" style="max-width: 100px; height: auto;">');
                $remove.show();
                updateData();
            });
            
            frame.open();
        });
        
        // Media remove
        $container.on('click', '.repeater-media-remove', function(e) {
            e.preventDefault();
            var $button = $(this);
            var $preview = $button.siblings('.repeater-media-preview');
            var $input = $button.siblings('.repeater-media-id');
            
            $input.val('');
            $preview.html('');
            $button.hide();
            updateData();
        });
        
        // Field changes
        $container.on('change keyup', '.repeater-field-input', function() {
            updateData();
        });
        
        // Make rows sortable
        $container.sortable({
            handle: '.repeater-row-title',
            update: function() {
                updateData();
            }
        });
        
        function createRow(values) {
            var rowHtml = '<li class="repeater-row" data-row=\'' + JSON.stringify(values) + '\'>';
            rowHtml += '<div class="repeater-row-header">';
            
            // Row label
            var rowLabelText = '';
            if (rowLabel.type === 'field' && values[rowLabel.field]) {
                rowLabelText = values[rowLabel.field];
            } else if (rowLabel.type === 'text') {
                rowLabelText = rowLabel.value;
            }
            
            rowHtml += '<span class="repeater-row-title">' + rowLabelText + '</span>';
            rowHtml += '<button type="button" class="button repeater-row-remove">Remove</button>';
            rowHtml += '</div>';
            
            // Fields
            rowHtml += '<div class="repeater-row-fields">';
            $.each(fields, function(fieldId, field) {
                rowHtml += '<div class="repeater-field repeater-field-' + field.type + '">';
                
                if (field.label) {
                    rowHtml += '<label class="repeater-field-label">' + field.label + '</label>';
                }
                
                var fieldValue = values[fieldId] || '';
                
                switch (field.type) {
                    case 'text':
                    case 'url':
                    case 'email':
                    case 'number':
                        rowHtml += '<input type="' + field.type + '" class="repeater-field-input" data-field="' + fieldId + '" value="' + fieldValue + '">';
                        break;
                        
                    case 'textarea':
                        rowHtml += '<textarea class="repeater-field-input" data-field="' + fieldId + '">' + fieldValue + '</textarea>';
                        break;
                        
                    case 'select':
                        rowHtml += '<select class="repeater-field-input" data-field="' + fieldId + '">';
                        $.each(field.choices, function(choiceValue, choiceLabel) {
                            rowHtml += '<option value="' + choiceValue + '"' + (fieldValue == choiceValue ? ' selected' : '') + '>' + choiceLabel + '</option>';
                        });
                        rowHtml += '</select>';
                        break;
                        
                    case 'checkbox':
                        rowHtml += '<input type="checkbox" class="repeater-field-input" data-field="' + fieldId + '" value="1"' + (fieldValue ? ' checked' : '') + '>';
                        break;
                        
                    case 'image':
                    case 'media':
                        var imageUrl = '';
                        if (fieldValue && $.isNumeric(fieldValue)) {
                            imageUrl = wp.media.attachment(fieldValue).get('url');
                        }
                        
                        rowHtml += '<div class="repeater-media-container">';
                        rowHtml += '<div class="repeater-media-preview">';
                        if (imageUrl) {
                            rowHtml += '<img src="' + imageUrl + '" style="max-width: 100px; height: auto;">';
                        }
                        rowHtml += '</div>';
                        rowHtml += '<input type="hidden" class="repeater-field-input repeater-media-id" data-field="' + fieldId + '" value="' + fieldValue + '">';
                        rowHtml += '<button type="button" class="button repeater-media-upload">Select</button>';
                        rowHtml += '<button type="button" class="button repeater-media-remove"' + (imageUrl ? '' : ' style="display:none;"') + '>Remove</button>';
                        rowHtml += '</div>';
                        break;
                        
                    default:
                        rowHtml += '<input type="text" class="repeater-field-input" data-field="' + fieldId + '" value="' + fieldValue + '">';
                }
                
                if (field.description) {
                    rowHtml += '<p class="description">' + field.description + '</p>';
                }
                
                rowHtml += '</div>';
            });
            
            rowHtml += '</div></li>';
            return rowHtml;
        }
        
        function updateData() {
            var data = [];
            $container.find('.repeater-row').each(function() {
                var rowData = {};
                var $row = $(this);
                var storedData = $row.data('row');
                
                // Get current values from inputs
                $row.find('.repeater-field-input').each(function() {
                    var $input = $(this);
                    var fieldId = $input.data('field');
                    var value;
                    
                    if ($input.attr('type') === 'checkbox') {
                        value = $input.is(':checked') ? 1 : 0;
                    } else {
                        value = $input.val();
                    }
                    
                    rowData[fieldId] = value;
                });
                
                // Preserve any data not in inputs
                if (storedData) {
                    $.each(storedData, function(key, val) {
                        if (typeof rowData[key] === 'undefined') {
                            rowData[key] = val;
                        }
                    });
                }
                
                data.push(rowData);
                $row.attr('data-row', JSON.stringify(rowData));
                
                // Update row title if needed
                if (rowLabel.type === 'field' && rowData[rowLabel.field]) {
                    $row.find('.repeater-row-title').text(rowData[rowLabel.field]);
                }
            });
            
            $input.val(JSON.stringify(data)).trigger('change');
        }
    });
});