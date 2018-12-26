
let DetailTable = (function() {

    let rowMap = [];
    let deletedRows = [];
    let addedRows = [];
    let updatedRows = [];

    let tmplId = 'tmpl-detail-row';
    let containerSel = '#detail-rows-container';

    function getIdFromRow(row) {
        return row.item.code;
    }

    function getTableData() {
        return { addedRows, updatedRows, deletedRows };
    }

    function setRows(rows) {
        rows.forEach(row => {
            rowMap[getIdFromRow(row)] = row;
        });
    }

    function addRow(row) {
        let key = getIdFromRow(row);
        if (key in rowMap) {
            throw "Row already exists";
        }

        rowMap[key] = row;
        addedRows[key] = row;
    }

    function updateRow(row) {
        let key = getIdFromRow(row);
        if ((!key in rowMap)) {
            throw "Row does not exists";
        }

        rowMap[key] = row;
        updatedRows[key] = row;
    }

    function removeRow(id) {
        deletedRows.push(rowMap[id]);
        delete rowMap[id];
    }

    function refreshRowsView() {
        $(containerSel).html('');        
        for (let code in rowMap) {
            let viewData = rowMap[code];
            viewData.id = code;
            viewData.badgeClass = getRowBadgeClass(rowMap[code]);
            $(containerSel).append(tmpl(tmplId, viewData));
        }
    }

    function getRowData(id) {
        return rowMap[id];
    }

    function getRowBadgeClass(row) {
        if (row.status == 'Incomplete / Out of Stock') {
            return 'badge-danger';
        }

        return 'badge-primary';
    }

    return { setRows, addRow, updateRow, refreshRowsView, getRowData, removeRow, getTableData };

})();