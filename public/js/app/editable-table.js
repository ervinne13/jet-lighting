"use strict";

class EditableTable {
    constructor(rowsContainerSel, rowRenderer, rowDataId) {
        this.rowsContainerSel = rowsContainerSel;        
        this.setRowRenderer(rowRenderer);        

        if (rowDataId !== undefined) {
            this.setRowDataId(rowDataId);
        } else {
            this.setRowDataId(this.getIdFromRowDefaultImpl);
        }

        this.rowMap = [];
        this.deletedRows = [];
        this.addedRows = [];
        this.updatedRows = [];        

        this.rowSpan = 1;

        this.autoRefreshTableOnChange = true;

        this.detailForm = null;

        this.initEvents();
    }

    initEvents() {
        let currentInstance = this;
        $(document).on('click', '[action=create-row]', function() {
            currentInstance.refreshRowsView();
            currentInstance.detailForm.create();
        });

        $(document).on('click', '[action=edit-row]', function() {
            currentInstance.refreshRowsView();
            let id = $(this).data('id');
            let rowData = currentInstance.getRowDataWithId(id);

            let rowSel = currentInstance.getRowSelectorFromData(rowData);

            $(rowSel).addClass('selected');
            currentInstance.detailForm.edit(rowData);
        });

        $(document).on('click', '[action=delete-row]', function() {
            let id = $(this).data('id');
            currentInstance.removeRow(id);
        });
    }

    setDetailForm(detailForm) {
        if ( !(detailForm && detailForm instanceof EditableTableForm)) {
            throw "Detail form must implement EditableTableForm";
        }

        this.detailForm = detailForm;        
        this.detailForm.setOnSaveListener((saveMode, data) => {
            if (saveMode == 'store') {
                this.addRow(data);
            }
    
            if (saveMode == 'update') {
                this.updateRow(data);
            }
        });

        this.detailForm.setParentTable(this);
    }

    setAutoRefreshTableOnChange(autoRefreshTableOnChange) {
        this.autoRefreshTableOnChange = autoRefreshTableOnChange;
    };

    setRowSpan(rowSpan) {
        this.rowSpan = rowSpan;
    }

    /**
     * Sets which function is resposible for rendering rows when they need to
     * be displayed.
     */
    setRowRenderer(rowRenderer) {
        if (typeof rowRenderer === 'function') {
            this.rowRenderer = rowRenderer;
        }  else {
            throw "Row Renderer must be a function";
        }
    };

    /**
     * Sets the identifier of each row. The user may also specify a function
     * to determine the row id for complex ids.
     */
    setRowDataId(rowDataId) {
        if (typeof rowDataId === "function") {
            this.getIdFromRow = rowDataId;
        } else {
            this.getIdFromRow = (row) => {
                return row[rowDataId];
            };
        }
    };

    getRowDataWithId(id) {
        return this.rowMap[id];
    }    

    getTableData() {
        return { addedRows, updatedRows, deletedRows };
    }

    setRows(rows) {
        rows.forEach(row => {
            //  we won't use addRow as we don't want the addedRows data filled yet
            let key = this.getIdFromRow(row);
            row = this.assignRowDataDefaults(row, key);
            this.rowMap[key] = row;
        });

        this.refreshRowsView();
    }

    addRow(row) {
        let key = this.getIdFromRow(row);
        if (key in this.rowMap) {
            throw "Row already exists";
        }

        row = this.assignRowDataDefaults(row, key);

        this.rowMap[key] = row;
        this.addedRows[key] = row;

        this.refreshRowsView();
    }   

    updateRow(row) {
        let key = this.getIdFromRow(row);
        if ((!key in this.rowMap)) {
            throw "Row does not exists";
        }

        row = this.assignRowDataDefaults(row, key);

        this.rowMap[key] = row;
        this.updatedRows[key] = row;

        this.refreshRowsView();
    }

    assignRowDataDefaults(row, key) {
        //  make sure that the identifier is provided in the id key
        //  some row data may not use "id" as the identifier row
        row.id = key;

        if (row.editable === undefined) {
            row.editable = true;
        }

        if (row.deletable === undefined) {
            row.deletable = true;
        }

        return row;
    }

    removeRow(id) {
        this.deletedRows.push(this.rowMap[id]);
        delete this.rowMap[id];

        this.refreshRowsView();
    }

    refreshRowsView() {
        let container = this.rowsContainerSel;
        $(this.rowsContainerSel).html('');
            
        for (let code in this.rowMap) {
            let viewData = this.rowMap[code];            
            $(this.rowsContainerSel).append(this.rowRenderer(viewData));
        }
    }

    getRowSelectorFromData(data) {
        let id = this.getIdFromRow(data);
        return `tr[data-id="${id}"]`;
    }

    //  ==============================================================
    //  Default Utility Functions

    getIdFromRowDefaultImpl(row) {
        return row.id;
    };

}