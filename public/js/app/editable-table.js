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
            $(`tr[data-id="${id}"]`).addClass('selected');
            currentInstance.detailForm.edit(currentInstance.getRowDataWithId(id));
        });

        $(document).on('click', '[action=delete-row]', function() {
            let id = $(this).data('id');
            currentInstance.removeRow(id);
        });
    }

    setDetailFormClass(DetailFormClass, params) {
        this.detailForm = new DetailFormClass(...params);

        this.detailForm.setOnSaveListener(function(saveMode, data) {            
            if (saveMode == 'store') {
                this.addRow(data);
            }
    
            if (saveMode == 'update') {
                this.updateRow(data);
            }
        });
    }

    setAutoRefreshTableOnChange(autoRefreshTableOnChange) {
        this.autoRefreshTableOnChange = autoRefreshTableOnChange;
    };

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

        row = this.assignRowDataDefaults(row);        

        this.rowMap[key] = row;
        this.addedRows[key] = row;
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

    updateRow(row) {
        let key = getIdFromRow(row);
        if ((!key in rowMap)) {
            throw "Row does not exists";
        }

        this.rowMap[key] = row;
        this.updatedRows[key] = row;
    }

    removeRow(id) {
        this.deletedRows.push(rowMap[id]);
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

    //  ==============================================================
    //  Default Utility Functions

    getIdFromRowDefaultImpl(row) {
        return row.id;
    };

}