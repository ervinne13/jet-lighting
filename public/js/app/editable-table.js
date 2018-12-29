
let EditableTable = (function () {

    let rowMap = [];
    let deletedRows = [];
    let addedRows = [];
    let updatedRows = [];

    let rowTmplId = 'tmpl-detail-row';
    let containerSel = '#detail-rows-container';

    function init(rowsContainerSelRef) {
        containerSel = rowsContainerSelRef;
    }

})();