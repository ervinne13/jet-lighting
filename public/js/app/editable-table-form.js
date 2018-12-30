/**
 * Abstract Class
 */
class EditableTableForm {
    constructor() {
        if (this.constructor === EditableTableForm) {
            throw new TypeError('Abstract class "EditableTableForm" cannot be instantiated directly.'); 
        }

        if (typeof this.getDisplayView !== 'function') {
            throw new TypeError('The getDisplayView function must be implemented');
        }

        if (typeof this.getBlankData !== 'function') {
            throw new TypeError('The getBlankData function must be implemented');
        }        
        
        this.onSaveListener = null;
        this.saveMode = null;

        this.parentTable = null;
        this.parentColumnRowSpan = 1;
        this.createFormContainerSelector = '.create-detail-form-container';        

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

    setCreateFormContainerSelector(createFormContainerSelector) {
        this.createFormContainerSelector = createFormContainerSelector;
    }

    setParentTable(parentTable) {
        if (!(parentTable && parentTable instanceof EditableTable)) {
            throw "Parent table must be an instance of EditableTable";
        }

        this.parentTable = parentTable;
        this.parentColumnRowSpan = this.parentTable.rowSpan;
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
        $(this.createFormContainerSelector).html('');
        $('.update-form-row').remove();
    }

    display(data) {
        let view = this.getDisplayView(data);
        if (this.saveMode === 'store') {
            $(this.createFormContainerSelector).html(view);
        } else if (this.saveMode === 'update') {
            let wrapedView = `<tr class="update-form-row form-row"><td colspan="${this.parentColumnRowSpan}">${view}</td></tr>`;
            let selectedRowSel = this.parentTable.getRowSelectorFromData(data)

            $(selectedRowSel).after(wrapedView);
        }
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