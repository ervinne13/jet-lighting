
let FormPage = (function() {

    let inquiry;
    let DetailForm;
    let DetailTable;

    function init(inquiryRef, DetailTableRef, DetailFormRef) {
        inquiry = inquiryRef;
        DetailForm = DetailFormRef;
        DetailTable = DetailTableRef;

        DetailTable.setRows(inquiry.details);
        DetailTable.refreshRowsView();

        DetailForm.setOnSaveListener(function(saveMode, data) {
            console.log('data', data);
            if (saveMode == 'store') {
                DetailTable.addRow(data);
            }

            if (saveMode == 'update') {
                DetailTable.updateRow(data);
            }

            DetailTable.refreshRowsView();
        });

        initEvents();
    }

    function initEvents() {
        //  TODO: move this to detail table
        $(document).on('click', '[action=create-row]', function() {
            DetailTable.refreshRowsView();
            DetailForm.create();
        });

        $(document).on('click', '[action=view-row]', function() {
            DetailTable.refreshRowsView();
            let id = $(this).data('id');
            $(`tr[data-id="${id}"]`).addClass('selected');
            DetailForm.view(DetailTable.getRowData(id));
        });

        $(document).on('click', '[action=edit-row]', function() {
            DetailTable.refreshRowsView();
            let id = $(this).data('id');
            $(`tr[data-id="${id}"]`).addClass('selected');
            DetailForm.edit(DetailTable.getRowData(id));
        });

        $(document).on('click', '[action=delete-row]', function() {
            let id = $(this).data('id');
            DetailTable.removeRow(id);
            DetailTable.refreshRowsView();
        });

        $(document).on('click', '[action=save]', function() {
            DetailTable.refreshRowsView();
            inquiry.purpose = $('[name=inquiry]').val();
            inquiry.detailUpdates = DetailTable.getTableData();
        });
    }

    return { init };
})();