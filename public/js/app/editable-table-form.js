/**
 * Abstract Class
 */
class EditableTableForm {
    constructor() {
        if (this.constructor === EditableTableForm) {
            throw new TypeError('Abstract class "EditableTableForm" cannot be instantiated directly.'); 
        }

        if (typeof this.display !== 'function') {
            throw new TypeError('The display function must be implemented');
        }

        if (typeof this.getBlankData !== 'function') {
            throw new TypeError('The getBlankData function must be implemented');
        }        
        
        this.onSaveListener = null;
        this.saveMode = null;

        this.initEvents();
    }

    initEvents() {
        let currentInstance = this;
        $(document).on('click', '.detail-action[action=close-detail]', function() {
            currentInstance.close();
        });

        $(document).on('click', '.detail-action[action=save-detail]', function() {
            if (currentInstance.onSaveListener) {                
                currentInstance.onSaveListener(currentInstance.saveMode, currentInstance.getFormData());
                currentInstance.close();
            } else {
                throw "On Save Listener not set in an EditableTableForm instance.";
            }    
        });
    }

    setOnSaveListener(onSaveListener) {
        this.onSaveListener = onSaveListener;
    }

    view(data) {
        this.saveMode = null;
        this.display(data);
    }

    edit(data) {
        this.saveMode = 'update';
        this.display(data);
    }

    create() {
        this.saveMode = 'store';        
        this.display(this.getBlankData());
    }

    close() {
        $('tr.form-row').remove();
    }

    getFormData(baseData) {
        let data = {};
        if (baseData === undefined) {
            data = this.getBlankData();
        }

        $(':input').each(function() {
            let mapsTo = $(this).attr('auto-maps-value-to');

            if (mapsTo) {
                data[mapsTo] = $(this).val();
            }
        });

        return data;
    }
}